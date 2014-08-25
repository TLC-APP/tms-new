<?php

App::uses('AppController', 'Controller');

/**
 * AssistantTeachers Controller
 *
 * @property AssistantTeacher $AssistantTeacher
 * @property PaginatorComponent $Paginator
 */
class AssistantTeachersController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->AssistantTeacher->recursive = 0;
        $this->set('assistantTeachers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->AssistantTeacher->exists($id)) {
            throw new NotFoundException(__('Invalid assistant teacher'));
        }
        $options = array('conditions' => array('AssistantTeacher.' . $this->AssistantTeacher->primaryKey => $id));
        $this->set('assistantTeacher', $this->AssistantTeacher->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->AssistantTeacher->create();
            if ($this->AssistantTeacher->save($this->request->data)) {
                return $this->flash(__('The assistant teacher has been saved.'), array('action' => 'index'));
            }
        }
        $users = $this->AssistantTeacher->User->find('list');
        $courses = $this->AssistantTeacher->Course->find('list');
        $this->set(compact('users', 'courses'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->AssistantTeacher->exists($id)) {
            throw new NotFoundException(__('Invalid assistant teacher'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->AssistantTeacher->save($this->request->data)) {
                return $this->flash(__('The assistant teacher has been saved.'), array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('AssistantTeacher.' . $this->AssistantTeacher->primaryKey => $id));
            $this->request->data = $this->AssistantTeacher->find('first', $options);
        }
        $users = $this->AssistantTeacher->User->find('list');
        $courses = $this->AssistantTeacher->Course->find('list');
        $this->set(compact('users', 'courses'));
    }

    public function updateLectureHours($id) {
        if (!$this->AssistantTeacher->exists($id)) {
            throw new NotFoundException(__('Invalid assistant teacher'));
        }
        if (!empty($this->request->data)) {
            if ($this->AssistantTeacher->save($this->request->data)) {
                $response = array('status' => 1, 'id' => $this->AssistantTeacher->id, 'name' => $this->AssistantTeacher->field('lecture_hours'));
                $this->set('response', $response);
                $this->set('_serialize', array('response'));
            } else {
                $response = array('status' => 0, 'message' => '<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Cảnh báo!</strong> Lưu không thành công, vui lòng kiểm tra lại thông tin.</div>');
                $this->set('response', $response);
                $this->set('_serialize', array('response'));
            }
        } else {
            $options = array('conditions' => array('AssistantTeacher.' . $this->AssistantTeacher->primaryKey => $id));
            $this->request->data = $this->AssistantTeacher->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->AssistantTeacher->id = $id;
        if (!$this->AssistantTeacher->exists()) {
            throw new NotFoundException(__('Invalid assistant teacher'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->AssistantTeacher->delete()) {
            $this->Session->setFlash('Đã xóa.','alert',array('plugin'=>'BoostCake','class'=>'alert-success'));
            $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash('Xóa không thành công.','alert',array('plugin'=>'BoostCake','class'=>'alert-warning'));
            $this->redirect($this->request->referer());
        }
    }

    /**
     * guest_index method
     *
     * @return void
     */
    public function manager_index() {
        $this->AssistantTeacher->recursive = 0;
        $this->set('assistantTeachers', $this->Paginator->paginate());
    }

    /**
     * guest_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function manager_view($id = null) {
        if (!$this->AssistantTeacher->exists($id)) {
            throw new NotFoundException(__('Invalid assistant teacher'));
        }
        $options = array('conditions' => array('AssistantTeacher.' . $this->AssistantTeacher->primaryKey => $id));
        $this->set('assistantTeacher', $this->AssistantTeacher->find('first', $options));
    }

    /**
     * guest_add method
     *
     * @return void
     */
    public function manager_add() {
        if ($this->request->is('post')) {
            $this->AssistantTeacher->create();
            if ($this->AssistantTeacher->save($this->request->data)) {
                return $this->flash(__('The assistant teacher has been saved.'), array('action' => 'index'));
            }
        }
        $users = $this->AssistantTeacher->User->find('list');
        $courses = $this->AssistantTeacher->Course->find('list');
        $this->set(compact('users', 'courses'));
    }

    /**
     * guest_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function manager_edit($id = null) {
        if (!$this->AssistantTeacher->exists($id)) {
            throw new NotFoundException(__('Invalid assistant teacher'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->AssistantTeacher->save($this->request->data)) {
                return $this->flash(__('The assistant teacher has been saved.'), array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('AssistantTeacher.' . $this->AssistantTeacher->primaryKey => $id));
            $this->request->data = $this->AssistantTeacher->find('first', $options);
        }
        $users = $this->AssistantTeacher->User->find('list');
        $courses = $this->AssistantTeacher->Course->find('list');
        $this->set(compact('users', 'courses'));
    }

}
