<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Courses Controller
 *
 * @property Course $Course
 * @property PaginatorComponent $Paginator
 */
class CoursesController extends AppController {

    public $components = array('Paginator', 'Session', 'TinymceElfinder.TinymceElfinder', 'Email',
    );
    public $helpers = array('TinymceElfinder.TinymceElfinder', 'PhpExcel');

    public function add() {
        if ($this->request->is('post')) {
            $this->Course->create();
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        }
        $chapters = $this->Course->Chapter->find('list');
        $teachers = $this->Course->Teacher->find('list');
        $this->set(compact('chapters', 'teachers'));
    }

    public function admin_thong_ke() {
        Configure::write('debug', 0);
        $conditions = array();
        $contain = array(
            'Chapter' => array(
                'fields' => array('id', 'name', 'field_id'),
                'Field' => array('fields' => array('id', 'name'))
            ),
            'Teacher' => array('fields' => array('id', 'name')));
        if ($export) {
            $conditions = $this->Session->read('thong_ke_conditions');
            $courses = $this->Course->find('all', array('conditions' => $conditions, 'contain' => $contain, 'fields' => array('id', 'name', 'chapter_id', 'register_student_number', 'pass_number', 'so_buoi', 'created', 'status', 'is_published', 'max_enroll_number')));
            $this->set('courses', $courses);
            $this->render('xuat_thong_ke_course');
        } else {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['Course']['begin']) && !empty($this->request->data['Course']['end'])) {
                    $begin = new DateTime();
                    if ($begin->setDate($this->request->data['Course']['begin']['year'], $this->request->data['Course']['begin']['month'], $this->request->data['Course']['begin']['day'])) {
                        $conditions = Set::merge($conditions, array('Course.created >=' => $begin->format('Y-m-d 00:00:00')));
                        $end = new DateTime();
                        if ($end->setDate($this->request->data['Course']['end']['year'], $this->request->data['Course']['end']['month'], $this->request->data['Course']['end']['day'])) {
                            if ($begin > $end) {
                                return $this->Session->setFlash('Khoảng thống kê không hợp lệ, từ < đến', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
                            } else {
                                $conditions = Set::merge($conditions, array('Course.created <=' => $end->format('Y-m-d 00:00:00')));
                            }
                        }
                    } else {

                        $end = new DateTime();
                        if ($end->setDate($this->request->data['Course']['end']['year'], $this->request->data['Course']['end']['month'], $this->request->data['Course']['end']['day'])) {

                            $conditions = Set::merge($conditions, array('Course.created <=' => $end->format('Y-m-d 00:00:00')));
                        }
                    }
                }

                if (!empty($this->request->data['Course']['chapter_id'])) {
                    $conditions = Set::merge($conditions, array('Course.chapter_id' => $this->request->data['Course']['chapter_id']));
                } else {
                    if (!empty($this->request->data['Course']['field_id'])) {
                        $chapter_id_array = $this->Course->Chapter->getChapterByField_id($this->request->data['Course']['field_id']);
                        $conditions = Set::merge($conditions, array('Course.chapter_id' => $chapter_id_array));
                    }
                }
                if (!empty($this->request->data['Course']['status'])) {
                    $conditions = Set::merge($conditions, array('Course.status' => $this->request->data['Course']['status']));
                }

                if (!empty($this->request->data['Course']['teacher_id'])) {
                    $conditions = Set::merge($conditions, array('Course.teacher_id' => $this->request->data['Course']['teacher_id']));
                }
                if ($this->Session->check('thong_ke_conditions')) {
                    $this->Session->delete('thong_ke_conditions');
                }
                $this->Session->write('thong_ke_conditions', $conditions);

                $this->Paginator->settings = array('conditions' => $conditions);
                $this->set('courses', $this->Paginator->paginate());
                if ($this->request->is('ajax')) {
                    $this->render('ket_qua_thong_ke');
                }
            }
        }
        $fields = $this->Course->Chapter->Field->find('list');
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();

        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('fields', 'teachers'));
    }

    public function manager_thong_ke($export = 0) {
        Configure::write('debug', 0);
        $conditions = array();
        $contain = array(
            'Chapter' => array(
                'fields' => array('id', 'name', 'field_id'),
                'Field' => array('fields' => array('id', 'name'))
            ),
            'Teacher' => array('fields' => array('id', 'name')));
        if ($export) {
            $conditions = $this->Session->read('thong_ke_conditions');
            $courses = $this->Course->find('all', array('conditions' => $conditions, 'contain' => $contain, 'fields' => array('id', 'name', 'chapter_id', 'register_student_number', 'pass_number', 'so_buoi', 'created', 'status', 'is_published', 'max_enroll_number')));
            $this->set('courses', $courses);
            $this->render('xuat_thong_ke_course');
        } else {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['Course']['begin']) && !empty($this->request->data['Course']['end'])) {
                    $begin = new DateTime();
                    if ($begin->setDate($this->request->data['Course']['begin']['year'], $this->request->data['Course']['begin']['month'], $this->request->data['Course']['begin']['day'])) {
                        $conditions = Set::merge($conditions, array('Course.created >=' => $begin->format('Y-m-d 00:00:00')));
                        $end = new DateTime();
                        if ($end->setDate($this->request->data['Course']['end']['year'], $this->request->data['Course']['end']['month'], $this->request->data['Course']['end']['day'])) {
                            if ($begin > $end) {
                                return $this->Session->setFlash('Khoảng thống kê không hợp lệ, từ < đến', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
                            } else {
                                $conditions = Set::merge($conditions, array('Course.created <=' => $end->format('Y-m-d 00:00:00')));
                            }
                        }
                    } else {

                        $end = new DateTime();
                        if ($end->setDate($this->request->data['Course']['end']['year'], $this->request->data['Course']['end']['month'], $this->request->data['Course']['end']['day'])) {

                            $conditions = Set::merge($conditions, array('Course.created <=' => $end->format('Y-m-d 00:00:00')));
                        }
                    }
                }

                if (!empty($this->request->data['Course']['chapter_id'])) {
                    $conditions = Set::merge($conditions, array('Course.chapter_id' => $this->request->data['Course']['chapter_id']));
                } else {
                    if (!empty($this->request->data['Course']['field_id'])) {
                        $chapter_id_array = $this->Course->Chapter->getChapterByField_id($this->request->data['Course']['field_id']);
                        $conditions = Set::merge($conditions, array('Course.chapter_id' => $chapter_id_array));
                    }
                }
                if (!empty($this->request->data['Course']['status'])) {
                    $conditions = Set::merge($conditions, array('Course.status' => $this->request->data['Course']['status']));
                }

                if (!empty($this->request->data['Course']['teacher_id'])) {
                    $conditions = Set::merge($conditions, array('Course.teacher_id' => $this->request->data['Course']['teacher_id']));
                }
                if ($this->Session->check('thong_ke_conditions')) {
                    $this->Session->delete('thong_ke_conditions');
                }
                $this->Session->write('thong_ke_conditions', $conditions);

                $this->Paginator->settings = array('conditions' => $conditions);
                $this->set('courses', $this->Paginator->paginate());
                if ($this->request->is('ajax')) {
                    $this->render('ket_qua_thong_ke');
                }
            }
        }
        $fields = $this->Course->Chapter->Field->find('list');
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();

        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('fields', 'teachers'));
    }

    public function attachment_list($id) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new Exception('Không tồn tại khóa học này');
        }
        $conditions = array('Attachment.model' => 'Course', 'Attachment.foreign_key' => $id);
        $attachments = $this->Course->Attachment->find('all', array('conditions' => $conditions, 'recursive' => -1));
        $this->set('attachments', $attachments);
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('referer', $this->referer());
    }

    public function delete($id = null) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Course->field('status') != COURSE_CANCELLED) {
            $this->Session->setFlash('Khóa học này chưa hủy bạn không thể xóa được', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->request->referer());
        }
        if ($this->Course->delete()) {
            $this->Session->setFlash(__('The course has been deleted.'));
        } else {
            $this->Session->setFlash(__('The course could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->request->referer());
    }

    public function fields_manager_delete($id = null) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Course->field('status') != COURSE_CANCELLED) {
            $this->Session->setFlash('Khóa học này chưa hủy bạn không thể xóa được', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->request->referer());
        }
        if ($this->Course->delete()) {
            $this->Session->setFlash(__('The course has been deleted.'));
        } else {
            $this->Session->setFlash(__('The course could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->request->referer());
    }

    public function admin_delete($id = null) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Course->field('status') != COURSE_CANCELLED) {
            $this->Session->setFlash('Khóa học này chưa hủy bạn không thể xóa được', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->request->referer());
        }
        if ($this->Course->delete()) {
            $this->Session->setFlash(__('The course has been deleted.'));
            return $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash(__('The course could not be deleted. Please, try again.'));
            return $this->redirect($this->request->referer());
        }
    }

    public function download($attachment_id) {
        $path = $this->Course->Attachment->getFilePath($attachment_id, 'attachment');

        $this->response->file(
                $path, array('download' => true, 'name' => $this->Course->Attachment->getFileName($attachment_id))
        );
// Return response object to prevent controller from trying to render
// a view
        return $this->response;
    }

    public function edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
            $this->request->data = $this->Course->find('first', $options);
        }
        $chapters = $this->Course->Chapter->find('list');
        $teachers = $this->Course->Teacher->find('list');
        $this->set(compact('chapters', 'teachers'));
    }

    public function index() {
        $this->Course->recursive = 0;
        $this->set('courses', $this->Paginator->paginate());
    }

    public function guest_view($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array('conditions' => array('CoursesRoom.start is not null'), 'order' => array('CoursesRoom.priority' => 'ASC')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment'
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function manager_view($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array(/* 'conditions' => array('CoursesRoom.start is not null'), */ 'order' => array('CoursesRoom.priority' => 'ASC'), 'Room'),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attend' => array('Student' => array('fields' => array('Student.id', 'Student.name', 'Student.email', 'Student.phone_number'))),
            'Attachment'
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $rooms = $this->Course->CoursesRoom->Room->find('list');
        $course = $this->Course->find('first', $options);

        $this->set(compact('course', 'rooms'));
    }

    public function manager_view1($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array('conditions' => array('CoursesRoom.start is not null'), 'order' => array('CoursesRoom.priority' => 'ASC')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment'
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function guest_cothedangki() {
        $contain = array(
            'User' => array('fields' => array('id', 'name')), //create user
            'Teacher' => array('fields' => array('id', 'name')), //Teacher
            'CoursesRoom' => array('Room' => array('id', 'name')),
            'Attend', //Khoa hoc
            'Chapter' => array('fields' => array('id', 'name'))//Chuyen de
        );
        $today = new DateTime();
        $conditions = array(
            'Course.enrolling_expiry_date >=' => $today->format('Y-m-d H:i:s'),
            'Course.is_published' => 1,
            'Course.status' => COURSE_REGISTERING,
            'Course.max_enroll_number > (SELECT count(id) as Course__register_student_number 
         FROM  attends as Attend 
         where Attend.course_id=Course.id)'
        );
        $course_fields = array('id', 'name', 'decription', 'image_path', 'image', 'chapter_id', 'max_enroll_number', 'enrolling_expiry_date', 'register_student_number', 'session_number');
        $courses_register = $this->Course->find('all', array('conditions' => $conditions, 'contain' => $contain, 'fields' => $course_fields,));
        return $courses_register;
    }

    public function huy($id) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException('Không tìm thấy khóa học này');
        }

        $this->request->onlyAllow('post');
        if ($this->Course->saveField('status', COURSE_CANCELLED)) {
            $this->Session->setFlash('Đã hủy khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            /* Gửi mail thông báo */
            $gui = Configure::read('SEND_MAIL_WHEN_CANCEL_COURSE');
            $ds_sinh_vien = $this->Course->Attend->find('all', array('conditions' => array('Attend.course_id' => $id), 'contain' => array('Student' => array('id', 'name', 'email'))));
            $ten_khoa_hoc = $this->Course->field('name');
            $subject = 'Thông báo HỦY khóa học ' . $ten_khoa_hoc;
            $message = "Vì khóa học {$ten_khoa_hoc} không đủ điều kiện mở lớp nên đã bị hủy. Mọi thắc mắc xin liên hệ 102 để được giải đáp";
            $content = $message;
            if ($gui) {

                foreach ($ds_sinh_vien as $sinh_vien) {
                    $to = $sinh_vien['Student']['email'];
                    $this->__sendMail($to, $subject, $message);
                }
            }
            //Tạo thông báo gủi nội bộ hệ thống
            App::uses('Message', 'Model');
            foreach ($ds_sinh_vien as $sinh_vien) {
                $name = $sinh_vien['Student']['name'];
                $message = 'Xin chào ' . $name . '! ' . $content;
                $data = array(
                    'title' => $subject,
                    'content' => $message,
                    'created_user_id' => AuthComponent::user('id'),
                    'receive_user_id' => $sinh_vien['Student']['id'],
                    'category_id' => NULL
                );
                $message_model = new Message();
                $message_model->create();

                if (!$message_model->save($data)) {
                    $this->Session->setFlash('Gửi thông báo HỦY KHÓA HỌC cho học viên không thành công');
                    $this->redirect($this->request->referer());
                }
            }
            $message_model = new Message();
            /* Gửi thông báo cho Tập huấn viên */
            $teacher_id = $this->Course->field('teacher_id');

            if ($this->Course->Teacher->exists($teacher_id)) {
                $teacher = $this->Course->Teacher->find('first', array('conditions' => array('Teacher.id' => $teacher_id), 'recursive' => -1, 'fields' => array('id', 'name')));
                $message = 'Xin chào ' . $teacher['Teacher']['name'] . '! ' . $content;
                $data = array(
                    'title' => $subject,
                    'content' => $message,
                    'created_user_id' => AuthComponent::user('id'),
                    'receive_user_id' => $teacher['Teacher']['id'],
                    'category_id' => NULL
                );
                $message_model->create();

                if (!$message_model->save($data)) {
                    $this->Session->setFlash('Gửi thông báo HỦY KHÓA HỌC cho tập huấn viên không thành công');
                    $this->redirect($this->request->referer());
                }
            }
        } else {
            $this->Session->setFlash('Hủy không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
        }
        return $this->redirect($this->referer());
    }

    public function new_courses() {
        if ($this->Auth->loggedIn()) {
            $user = $this->Course->User->find('first', array('contain' => array('Group'), 'conditions' => array('User.id' => $this->Auth->user('id'))));
            if (count($user['Group']) == 1) {
                return $this->redirect(array('controller' => 'dashboards', 'action' => $user['Group'][0]['alias'] . '_home'));
            }
//$this->layout = 'group_select';
            $this->set('users', $user);
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')), //create user
            'Teacher' => array('fields' => array('id', 'name')), //Teacher
            'Attend', //Khoa hoc
            'Chapter'//Chuyen de
        );
        $conditions = array('Course.status' => COURSE_REGISTERING);
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions);
        $fields = $this->Course->Chapter->Field->find('list');
        $chapters = $this->Course->Chapter->find('list');
        $this->set(compact('fields', 'chapters'));
        $this->set('courses', $this->Paginator->paginate());
    }

    public function fields_manager_view($id = null) {

        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            //'CoursesRoom' => array('Room' => array('id', 'name'), 'conditions' => array('CoursesRoom.course_id' => $id, 'CoursesRoom.start is null')),
            'CoursesRoom' => array('Room' => array('id', 'name'), 'conditions' => array('CoursesRoom.course_id' => $id)),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment',
            'Attend' => array('Student' => array('fields' => array('id', 'name', 'email', 'phone_number')), 'fields' => array('id', 'student_id', 'course_id'))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $rooms = $this->Course->CoursesRoom->Room->find('list');
        $course = $this->Course->find('first', $options);
        $this->set(compact('course', 'rooms'));
    }

    public function fields_manager_index($status = null) {

        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name'),
            ), 'Chapter'
        );
        $conditions = array('Course.created_user_id' => $this->Auth->user('id'));
        if ($status) {
            $conditions = Set::merge($conditions, array('Course.status' => $status));
            $this->set('status', $status);
        }
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions, 'order' => array('Course.created' => 'DESC'));
        $this->set('courses', $this->Paginator->paginate());
    }

    public function fields_manager_add() {

        if ($this->request->is('post')) {
            $this->Course->create();
            $this->request->data['Course']['created_user_id'] = $this->Auth->user('id');
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('Đã thêm khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index', COURSE_REGISTERING));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        }

        $manage_fields = $this->Course->Chapter->Field->find('all', array('fields' => array('id'), 'recursive' => -1, 'conditions' => array(
                'Field.manage_user_id' => $this->Auth->user('id'))));
        $manage_fields_id_array = array();
        if (!empty($manage_fields)) {
            $manage_fields_id_array = Set::classicExtract($manage_fields, '{n}.Field.id');
        }
        $chapters = $this->Course->Chapter->find('list', array('conditions' => array('Chapter.field_id' => $manage_fields_id_array)));
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();
        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('chapters', 'teachers'));
    }

    public function fields_manager_edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash(__('The course has been saved.'));
                return $this->redirect(array('action' => 'index', COURSE_REGISTERING));
            } else {
                $this->Session->setFlash(__('The course could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array(
                    'Course.' . $this->Course->primaryKey => $id),
                'contain' => array(
                    'Chapter' => array('fields' => array('id', 'name')),
                    'Teacher' => array('fields' => array('id', 'name'))));
            $this->request->data = $this->Course->find('first', $options);
        }

        $manage_fields = $this->Course->Chapter->Field->find('all', array('fields' => array('id'), 'recursive' => -1, 'conditions' => array(
                'Field.manage_user_id' => $this->Auth->user('id'))));

        $manage_fields_id_array = array();
        if (!empty($manage_fields)) {
            $manage_fields_id_array = Set::classicExtract($manage_fields, '{n}.Field.id');
        }
        $chapters = $this->Course->Chapter->find('list', array('conditions' => array('Chapter.field_id' => $manage_fields_id_array)));

        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();
        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('chapters', 'teachers'));
    }

    public function manager_add() {
        if ($this->request->is('post')) {
            $this->Course->create();
            $this->request->data['Course']['created_user_id'] = $this->Auth->user('id');
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('Đã thêm khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index', COURSE_REGISTERING));
            } else {
                $this->Session->setFlash('Đã thêm khóa học không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            }
        }
        $chapters = $this->Course->Chapter->find('list');
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();
        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('chapters', 'teachers'));
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Course->create();
            $this->request->data['Course']['created_user_id'] = $this->Auth->user('id');
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('Đã thêm khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index', COURSE_REGISTERING));
            } else {
                $this->Session->setFlash('Đã thêm khóa học không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $chapters = $this->Course->Chapter->find('list');
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();
        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('chapters', 'teachers'));
    }

    public function manager_index($status = null) {
        $conditions = array();
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name'),
            ), 'Chapter'
        );

        if ($status) {
            $conditions = array('Course.status' => $status);
            $this->set('status', $status);
        }
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions, 'order' => array('Course.created' => 'DESC'));
        $this->set('courses', $this->Paginator->paginate());
    }

    public function admin_index($status = null) {
        $conditions = array();
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name'),
            ), 'Chapter'
        );

        if ($status) {
            $conditions = array('Course.status' => $status);
            $this->set('status', $status);
        }
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions, 'order' => array('Course.created' => 'DESC'));
        $this->set('courses', $this->Paginator->paginate());
    }

    public function manager_edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('Cập nhật khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index', COURSE_REGISTERING));
            } else {
                $this->Session->setFlash('Cập nhật khóa học không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            }
        } else {
            $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => array(
                    'Chapter' => array('fields' => array('id', 'name')),
                    'Teacher' => array('fields' => array('id', 'name'))));
            $this->request->data = $this->Course->find('first', $options);
        }
        $chapters = $this->Course->Chapter->find('list');
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();
        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('chapters', 'teachers'));
    }

    public function admin_edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('Cập nhật khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Cập nhật khóa học không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'index', COURSE_REGISTERING));
            }
        } else {
            $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => array(
                    'Chapter' => array('fields' => array('id', 'name')),
                    'Teacher' => array('fields' => array('id', 'name'))));
            $this->request->data = $this->Course->find('first', $options);
        }
        $chapters = $this->Course->Chapter->find('list');
        $teacher_id_array = $this->Course->Teacher->getTeacherIdArray();
        $teachers = $this->Course->Teacher->find('list', array('conditions' => array('Teacher.id' => $teacher_id_array)));
        $this->set(compact('chapters', 'teachers'));
    }

    public function admin_view($id = null) {

        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            //'CoursesRoom' => array('Room' => array('id', 'name'), 'conditions' => array('CoursesRoom.course_id' => $id, 'CoursesRoom.start is null')),
            'CoursesRoom' => array('Room' => array('id', 'name'), 'conditions' => array('CoursesRoom.course_id' => $id)),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment',
            'Attend' => array('Student' => array('fields' => array('id', 'name', 'email', 'phone_number')))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $rooms = $this->Course->CoursesRoom->Room->find('list');
        $course = $this->Course->find('first', $options);
        $this->set(compact('course', 'rooms'));
    }

    public function manager_score($id) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name')),
            'Chapter' => array('fields' => array('id', 'name')),
            'Attend' => array('Student' => array('fields' => array('id', 'name', 'email', 'phone_number'))),
            'CoursesRoom' => array('fields' => array('CoursesRoom.id'))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain,
            'fields' => array('Course.id', 'Course.name', 'Course.status', 'Course.max_enroll_number', 'enrolling_expiry_date', 'is_published', 'pass_number'));
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function admin_score($id) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name')),
            'Chapter' => array('fields' => array('id', 'name')),
            'Attend' => array('Student' => array('fields' => array('id', 'name', 'email', 'phone_number'))),
            'CoursesRoom' => array('fields' => array('CoursesRoom.id'))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain,
            'fields' => array('Course.id', 'Course.name', 'Course.status', 'Course.max_enroll_number', 'enrolling_expiry_date', 'is_published', 'pass_number'));
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function manager_update_score($course_id) {

        if (!$this->Course->exists($course_id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $this->Course->id = $course_id;
        $chapter_id = $this->Course->field('Course.chapter_id');
        $field_id = $this->Course->Chapter->field('Chapter.field_id', array('Chapter.id' => $chapter_id));
        $this->Course->Chapter->Field->id = $field_id;

        if (!empty($this->request->data['pass_students'])) {
            $pass_students = $this->request->data['pass_students'];
            $last_cert = $this->Course->Attend->find('first', array('recursive' => -1, 'order' => array('created' => 'DESC'), 'conditions' => array('Attend.certificated_number is not null')));

            $explode = ( explode('/', $last_cert['Attend']['certificated_number']));
            $certificated_start_number = $explode[0];
            if (empty($certificated_start_number)) {
                $certificated_start_number = 1;
            }
            $certificated_number_suffix = $this->Course->Chapter->Field->field('Field.certificated_number_suffix');


            $chung_chi_co_so = $this->Course->field('Course.chung_chi_co_so');

            foreach ($pass_students as $key => $value) {

                $certificated_number = ++$certificated_start_number;
                if ($certificated_start_number < 10) {
                    $certificated_number = '0' . $certificated_number;
                }
                $full_certificated_number = "'" . $certificated_number . $certificated_number_suffix . "'";
                debug($full_certificated_number);

                $data = array(
                    'Attend.is_passed' => 1,
                    'Attend.certificated_number' => $full_certificated_number,
                    'Attend.certificated_date' => '"' . date('Y-m-d H:i:s', strtotime('now')) . '"'
                );
                if (!$chung_chi_co_so) {
                    $data = array(
                        'Attend.is_passed' => 1,
                        'Attend.certificated_date' => '"' . date('Y-m-d H:i:s', strtotime('now')) . '"'
                    );
                }
                if ($this->Course->Attend->updateAll(
                                $data, array('Attend.student_id' => $value, 'Attend.course_id' => $course_id, 'Attend.certificated_number is null'))) {
                    //$this->Course->Chapter->Field->saveField('current_certificate_number', $certificated_start_number);
                }
            }
        }
        if (!empty($this->request->data['fail_students'])) {


            $fail_students = $this->request->data['fail_students'];


            if ($this->Course->Attend->updateAll(array('Attend.is_passed' => 0, 'Attend.is_recieved' => 0, 'Attend.recieve_date' => NULL, 'Attend.certificated_date' => NULL, 'Attend.certificated_number' => NULL), array('Attend.student_id' => $fail_students, 'Attend.course_id' => $course_id))) {
                $this->Session->setFlash('Đã cập nhật kết quả thành công bảng điểm!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            } else {
                $this->Session->setFlash('Cập nhật kết quả không thành công!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            }
        }
        $this->redirect(array('manager' => true, 'action' => 'score', $course_id));
    }

    public function admin_update_score($course_id) {
        if (!$this->Course->exists($course_id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $this->Course->id = $course_id;
        $chapter_id = $this->Course->field('Course.chapter_id');
        $field_id = $this->Course->Chapter->field('Chapter.field_id', array('Chapter.id' => $chapter_id));
        $this->Course->Chapter->Field->id = $field_id;

        if (!empty($this->request->data['pass_students'])) {
            $pass_students = $this->request->data['pass_students'];
            $last_cert = $this->Course->Attend->find('first', array('recursive' => -1, 'order' => array('created' => 'DESC'), 'conditions' => array('Attend.certificated_number is not null')));

            $explode = ( explode('/', $last_cert['Attend']['certificated_number']));
            $certificated_start_number = $explode[0];
            if (empty($certificated_start_number)) {
                $certificated_start_number = 1;
            }
            $certificated_number_suffix = $this->Course->Chapter->Field->field('Field.certificated_number_suffix');


            $chung_chi_co_so = $this->Course->field('Course.chung_chi_co_so');

            foreach ($pass_students as $key => $value) {

                $certificated_number = $certificated_start_number + 1;
                if ($certificated_start_number < 10) {
                    $certificated_number = '0' . $certificated_start_number;
                }
                $full_certificated_number = "'" . $certificated_number . $certificated_number_suffix . "'";
                $data = array(
                    'Attend.is_passed' => 1,
                    'Attend.certificated_number' => $full_certificated_number,
                    'Attend.certificated_date' => '"' . date('Y-m-d H:i:s', strtotime('now')) . '"'
                );
                if (!$chung_chi_co_so) {
                    $data = array(
                        'Attend.is_passed' => 1,
                        'Attend.certificated_date' => '"' . date('Y-m-d H:i:s', strtotime('now')) . '"'
                    );
                }
                if ($this->Course->Attend->updateAll(
                                $data, array('Attend.student_id' => $value, 'Attend.course_id' => $course_id, 'Attend.certificated_number is null'))) {
                    //$this->Course->Chapter->Field->saveField('current_certificate_number', $certificated_start_number);
                }
            }
        }
        if (!empty($this->request->data['fail_students'])) {


            $fail_students = $this->request->data['fail_students'];


            if ($this->Course->Attend->updateAll(array('Attend.is_passed' => 0, 'Attend.is_recieved' => 0, 'Attend.recieve_date' => NULL, 'Attend.certificated_date' => NULL, 'Attend.certificated_number' => NULL), array('Attend.student_id' => $fail_students, 'Attend.course_id' => $course_id))) {
                $this->Session->setFlash('Đã cập nhật kết quả thành công bảng điểm!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            } else {
                $this->Session->setFlash('Cập nhật kết quả không thành công!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            }
        }
        $this->redirect(array('manager' => true, 'action' => 'score', $course_id));
    }

    public function manager_xuat_so_chung_nhan($course_id = null) {
        Configure::write('debug', 0);
        if (!$this->Course->exists($course_id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'Chapter' => array('fields' => array('id', 'name')),
            'Attend' => array(
                'Student' => array(
                    'fields' => array('id', 'name', 'phone_number', 'email', 'birthday', 'birthplace'),
                    'Department' => array('fields' => array('id', 'name')))
            ),
            'CoursesRoom' => array('fields' => array('id', 'title', 'start', 'end', 'priority'), 'order' => array('CoursesRoom.priority' => 'ASC'))
        );
        $fields = array('Course.id', 'Course.name');
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $course_id), 'contain' => $contain, 'fields' => $fields);
        $this->set('course', $this->Course->find('first', $options));
    }

    public function manager_open($id) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException('Không tìm thấy khóa học này');
        }

        $this->request->onlyAllow('post');
        if ($this->Course->field('status') == COURSE_UNCOMPLETED) {
            $this->Session->setFlash('Khóa học đã mở rồi!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }

        $enrolling_expiry_date = new DateTime($this->Course->field('enrolling_expiry_date'));
        $today = new DateTime();
        if ($today < $enrolling_expiry_date) {
            $this->Session->setFlash('Khóa học chưa hết hạn đăng ký!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
//
        if ($this->Course->field('so_buoi') < 1) {
            $this->Session->setFlash('Vui lòng thêm buổi học cho khóa.!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }

        if ($this->Course->field('register_student_number') < 1) {
            $this->Session->setFlash('Chưa có ai đăng ký khóa học này!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
        if ($this->Course->saveField('status', COURSE_UNCOMPLETED)) {
            $this->Session->setFlash('Đã mở khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            /* Gửi mail thông báo */
            $gui = Configure::read('SEND_MAIL_WHEN_CANCEL_COURSE');
            if ($gui) {
                $ten_khoa_hoc = $this->Course->field('name');
                $subject = 'Thông báo khóa học ' . $ten_khoa_hoc . ' đã được mở';
                $message = "Khóa học {$ten_khoa_hoc} đã  được mở. Quý học viên vui lòng tham dự đầy đủ. Xin cảm ơn.";
                $ds_sinh_vien = $this->Course->Attend->find('all', array('conditions' => array('Attend.course_id' => $id), 'contain' => array('Student' => array('id', 'name', 'email'))));
                foreach ($ds_sinh_vien as $sinh_vien) {
                    $to = $sinh_vien['Student']['email'];
                    $this->__sendMail($to, $subject, $message);
                }
            }
        } else {
            $this->Session->setFlash('Mở khóa không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
        }
        return $this->redirect($this->referer());
    }

    public function admin_open($id) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException('Không tìm thấy khóa học này');
        }

        $this->request->onlyAllow('post');
        if ($this->Course->field('status') == COURSE_UNCOMPLETED) {
            $this->Session->setFlash('Khóa học đã mở rồi!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }

        $enrolling_expiry_date = new DateTime($this->Course->field('enrolling_expiry_date'));
        $today = new DateTime();
        if ($today < $enrolling_expiry_date) {
            $this->Session->setFlash('Khóa học chưa hết hạn đăng ký!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
//
        if ($this->Course->field('so_buoi') < 1) {
            $this->Session->setFlash('Vui lòng thêm buổi học cho khóa.!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }

        if ($this->Course->field('register_student_number') < 1) {
            $this->Session->setFlash('Chưa có ai đăng ký khóa học này!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
        if ($this->Course->saveField('status', COURSE_UNCOMPLETED)) {
            $this->Session->setFlash('Đã mở khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            /* Gửi mail thông báo */
            $gui = Configure::read('SEND_MAIL_WHEN_CANCEL_COURSE');
            if ($gui) {
                $ten_khoa_hoc = $this->Course->field('name');
                $subject = 'Thông báo khóa học ' . $ten_khoa_hoc . ' đã được mở';
                $message = "Khóa học {$ten_khoa_hoc} đã  được mở. Quý học viên vui lòng tham dự đầy đủ. Xin cảm ơn.";
                $ds_sinh_vien = $this->Course->Attend->find('all', array('conditions' => array('Attend.course_id' => $id), 'contain' => array('Student' => array('id', 'name', 'email'))));
                foreach ($ds_sinh_vien as $sinh_vien) {
                    $to = $sinh_vien['Student']['email'];
                    $this->__sendMail($to, $subject, $message);
                }
            }
        } else {
            $this->Session->setFlash('Mở khóa không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
        }
        return $this->redirect($this->referer());
    }

    public function manager_expired_courses() {
        $expired_courses = $this->Course->getCoursesExpired();
        $conditions = array('Course.id' => $expired_courses);
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'Teacher' => array('fields' => array('id', 'name'),
            ), 'Chapter'
        );
        $this->Paginator->settings = array('contain' => $contain, 'conditions' => $conditions, 'order' => array('Course.created' => 'DESC'));
        $this->set('courses', $this->Paginator->paginate());
    }

    /* end manager */

    public function fields_manager_open($id) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException('Không tìm thấy khóa học này');
        }

        $this->request->onlyAllow('post');
        if ($this->Course->field('status') == COURSE_UNCOMPLETED) {
            $this->Session->setFlash('Khóa học đã mở rồi!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }

        $enrolling_expiry_date = new DateTime($this->Course->field('enrolling_expiry_date'));
        $today = new DateTime();
        if ($today < $enrolling_expiry_date) {
            $this->Session->setFlash('Khóa học chưa hết hạn đăng ký!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
        //
        if ($this->Course->field('so_buoi') < 1) {
            $this->Session->setFlash('Vui lòng thêm buổi học cho khóa.!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
        if ($this->Course->field('register_student_number') < 1) {
            $this->Session->setFlash('Chưa có ai đăng ký khóa học này!', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            return $this->redirect($this->referer());
        }
        if ($this->Course->saveField('status', COURSE_UNCOMPLETED)) {
            $this->Session->setFlash('Đã mở khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
            /* Gửi mail thông báo */
            $gui = Configure::read('SEND_MAIL_WHEN_CANCEL_COURSE');
            if ($gui) {
                $ten_khoa_hoc = $this->Course->field('name');
                $subject = 'Thông báo khóa học ' . $ten_khoa_hoc . ' đã được mở';
                $message = "Khóa học {$ten_khoa_hoc} đã  được mở. Quý học viên vui lòng tham dự đầy đủ. Xin cảm ơn.";
                $ds_sinh_vien = $this->Course->Attend->find('all', array('conditions' => array('Attend.course_id' => $id), 'contain' => array('Student' => array('id', 'name', 'email'))));
                foreach ($ds_sinh_vien as $sinh_vien) {
                    $to = $sinh_vien['Student']['email'];
                    $this->__sendMail($to, $subject, $message);
                }
            }
        } else {
            $this->Session->setFlash('Mở khóa không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
        }
        return $this->redirect($this->referer());
    }

    public function print_student($course_id = null) {
        if (!$this->Course->exists($course_id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number')),
            'Chapter' => array('fields' => array('id', 'name')),
            'Attend' => array(
                'Student' => array(
                    'fields' => array('id', 'name', 'phone_number', 'email', 'birthday', 'birthplace'),
                    'Department' => array('fields' => array('id', 'name')))
            ),
            'CoursesRoom' => array('fields' => array('id', 'title', 'start', 'end'), 'order' => array('CoursesRoom.priority' => 'ASC'))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $course_id), 'contain' => $contain);
        $this->set('course', $this->Course->find('first', $options));
    }

    public function student_khoamoidangki() {
        $contain = array(
            'User' => array('fields' => array('id', 'name')), //create user
            'Teacher' => array('fields' => array('id', 'name')), //Teacher
            'CoursesRoom' => array('Room' => array('id', 'name')),
            'Attend', //Khoa hoc
            'Chapter' => array('fields' => array('id', 'name'))//Chuyen de
        );
        $today = new DateTime();
        $khoa_da_dang_ky = $this->Course->Attend->getEnrolledCourses($this->Auth->user('id'));
        $conditions = array('Course.id' => $khoa_da_dang_ky, 'Course.enrolling_expiry_date >=' => $today->format('Y-m-d H:i:s'), 'Course.status' => COURSE_REGISTERING);
        $courses_register = $this->Course->find('all', array('conditions' => $conditions, 'contain' => $contain));
        return $courses_register;
    }

    public function student_view($id = null) {

        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array('conditions' => array('CoursesRoom.start is not null'), 'order' => array('CoursesRoom.priority' => 'ASC')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment'
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
//$rooms = $this->Course->CoursesRoom->Room->find('list');
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function __sendMail($to, $subject, $message) {
        $email = new CakeEmail();
        $email->config('gmail');
        $email->to($to);
        $email->subject($subject);
        $email->send($message);
    }

    public function teacher_view($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array('conditions' => array('CoursesRoom.start is not null'), 'order' => array('CoursesRoom.priority' => 'ASC')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment',
            'Attend' => array('Student' => array('fields' => array('id', 'name', 'email', 'phone_number')))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function teacher_view1($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array('conditions' => array('CoursesRoom.start is not null'), 'order' => array('CoursesRoom.priority' => 'ASC')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment',
            'Attend' => array('Student' => array('fields' => array('id', 'name', 'email', 'phone_number')))
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

    public function teacher_index() {
        /* Hiển thị tất cả các khóa học đang được tập huấn */
        /* Hiển thị lịch tập huấn trong tháng */
        /* Hiển thị tin nhắn từ người học và hệ thống */
    }

    public function teacher_courses() {
        $contain = array(
            'User' => array('fields' => array('id', 'name')), //create user
            'Teacher' => array('fields' => array('id', 'name')), //Teacher
            'CoursesRoom' => array('Room' => array('id', 'name'), 'fields' => array('id', 'title')),
            'Attend', //Khoa hoc
            'Chapter' => array('fields' => array('id', 'name'))//Chuyen de
        );
        $today = new DateTime();
        $fields = array('id', 'name', 'enrolling_expiry_date', 'register_student_number');
        $teacher_id = $this->Auth->user('id');
        $conditions = array('Course.teacher_id' => $teacher_id,
            'Course.status' => COURSE_REGISTERING,
            'Course.enrolling_expiry_date >=' => $today->format('Y-m-d H:i:s')
        );
        $khoa_dang_dk = $this->Course->find('all', array('conditions' => $conditions, 'contain' => $contain, 'fields' => $fields));
        return $khoa_dang_dk;
    }

    public function teacher_edit($id = null) {
        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        if ($this->request->is(array('post', 'put'))) {
            //debug($this->request->data);die;
            if ($this->Course->save($this->request->data)) {
                $this->Session->setFlash('Lưu thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                return $this->redirect(array('action' => 'view1', $id));
            } else {
                $this->Session->setFlash('Lưu không thành công. Vui lòng thử lại', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
            }
        } else {

            $options = array('conditions' => array(
                    'Course.' . $this->Course->primaryKey => $id),
            );
            $this->request->data = $this->Course->find('first', $options);
        }
    }

    public function uncancel($id = null) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException('Không tìm thấy khóa học này');
        }
        $this->request->onlyAllow('post');
        if ($this->Course->saveField('status', COURSE_REGISTERING)) {
            $this->Session->setFlash('Phục hồi khóa học thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
        } else {
            $this->Session->setFlash('Phục hồi không thành công', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-warning'));
        }
        return $this->redirect($this->referer());
    }

    public function upload($id = null) {
        $this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new Exception('Không tồn tại khóa học này');
        }
        if (!empty($this->request->data)) {
            try {
                if ($this->Course->createWithAttachments($this->request->data)) {
                    echo json_encode(array('status' => 1, 'course_id' => $id));
                    die();
                } else {
                    echo json_encode(array('status' => 0));
                    die();
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else {
            $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
            $this->request->data = $this->Course->find('first', $options);
        }
    }

    public function truongdonvi_view($id = null) {

        if (!$this->Course->exists($id)) {
            throw new NotFoundException(__('Invalid course'));
        }
        $contain = array(
            'User' => array('fields' => array('id', 'name')),
            'CoursesRoom' => array('conditions' => array('CoursesRoom.start is not null'), 'order' => array('CoursesRoom.priority' => 'ASC')),
            'Teacher' => array('fields' => array('id', 'name', 'email', 'phone_number'), 'HocHam', 'HocVi'),
            'Chapter' => array('Attachment'),
            'Attachment'
        );
        $options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id), 'contain' => $contain);
//$rooms = $this->Course->CoursesRoom->Room->find('list');
        $course = $this->Course->find('first', $options);
        $this->set(compact('course'));
    }

}