<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array(
        'Session', 'RequestHandler',
        //'DebugKit.Toolbar',
        'Paginator',
        'Acl' => array('habtm' => array(
                'userModel' => 'Users.User',
                'groupAlias' => 'Group'
            )),
        'Auth' => array(
            'authorize' => array(
                'Controller',
                'Actions' => array('actionPath' => 'controllers'),
                'Authorize.Acl' => array('actionPath' => 'Models/')
            ),
            'authError' => 'Tài khoản không được cấp phép.',
            'flash' => array(
                'element' => 'alert',
                'key' => 'auth',
                'params' => array('plugin' => 'BoostCake', 'class' => 'alert-warning')
            ),
            'allowedActions' => array('home', 'guest_cothedangki','fill_selectbox',
                'guest_lich_homnay','guest_unCompleteCourses','guest_completeCourses', 'courses_completed', 'help', 'contact',
                'login', 'new_courses', 'getLastMessage', 'xem_thong_bao',
                'guest_view_teacher', 'guest_view'),
            'logoutRedirect' => '/',
            'unauthorizedRedirect' => '/',
            'loginRedirect' => array(
                'controller' => 'dashboards',
                'action' => 'home',
                'student' => true),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false,
                'plugin' => false
            )
        )
    );
    public $helpers = array('Session',
        'Js',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator')
    );
    public $uses = array('Course', 'CoursesRoom', 'User');

    function beforeFilter() {
        if ($this->Auth->loggedIn()) {
            if (!$this->Auth->user('activated')) {
                $this->Session->setFlash('Tài khoản đã bị khóa!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'), 'auth');
                return $this->redirect($this->Auth->logout());
            }
        }
        $this->__checkCompleteCourse();
    }

    public function beforeRender() {
        parent::beforeRender();
        if (!empty($this->params['prefix']) && !$this->request->is('ajax')) {
            $this->layout = $this->params['prefix'];
        }

        if ($this->Auth->loggedIn() && ($this->User->isAdmin() || $this->User->isManager()) &&
                ($this->request->action != 'manager_expired_courses' && $this->request->prefix != 'student' &&
                $this->request->action != 'admin_expired_courses' && $this->request->action != 'fields_manager_expired_courses')) {
            $this->check_expire_course();
        }
        if ($this->Auth->loggedIn()) {
            $user = $this->User->find('first', array('contain' => array('Group' => array('order' => array('Group.name' => 'asc'))), 'conditions' => array('User.id' => $this->Auth->user('id'))));
            $this->set('loginUser', $user);
        }
    }

    public function isAuthorized($user) {

        return true;
        $acl_check = false;
        try {
            $acl_check = $this->Acl->check(array('User' => array('id' => $user['id'])), $this->request->action);
        } catch (Exception $exc) {
            return false;
        }


        if ($this->Auth->loggedIn() && $acl_check) {
            return true;
        }


        return false;
    }

    public function __checkCompleteCourse() {
        $uncomplete_courses = $this->Course->getCoursesUnCompleted();
        if (!empty($uncomplete_courses)) {
            $khoa_con_buoi = $this->CoursesRoom->layKhoaConBuoi();
            $id_giong = array_intersect($uncomplete_courses, $khoa_con_buoi);

            $khoa_hoan_thanh = Set::diff($uncomplete_courses, $id_giong);
            if (!empty($khoa_hoan_thanh)) {
                $this->Course->updateAll(array('Course.status' => COURSE_COMPLETED), array('Course.id' => $khoa_hoan_thanh));
            }
        }
    }

    public function check_expire_course() {

        $expired_courses = ($this->request->prefix == 'fields_manager') ? $this->Course->getManagerCourse() : $this->Course->getCoursesExpired();
        if (is_null($this->request->prefix)) {
            $this->request->prefix = 'manager';
        }
        if (!empty($expired_courses)) {
            $this->Session->setFlash('Có ' . count($expired_courses) . ' khóa học đã hết hạn đăng ký <a href="' . SUB_DIR . '/' . $this->request->prefix . '/courses/expired_courses"> chi tiết</a>', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning', 'escape' => false));
        }
    }

}
