<?php

App::uses('AppController', 'Controller');

/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 * @property PaginatorComponent $Paginator
 */
class AttachmentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        Configure::write('debug',0);
        if ($this->Attachment->delete(($id))) {
            if ($this->request->is('ajax')) {
                echo json_encode(array('status'=>1));die;
            } else {
                $this->Session->setFlash('Đã xóa.', 'alert', array('plugin' => 'BoostCake', 'class' => 'alert-success'));
                $this->redirect($this->referer());
            }
        }
    }
    
    public function sendFile($id) {
        $this->Attachment->id=$id;
        if ($this->Attachment->exists()) {
            throw new Exception('Không tìm thấy file');
        }
        $dir=$this->Attachment->field('dir');
        $model=$this->Attachment->field('model');
        $this->response->file($path);
        // Return response object to prevent controller from trying to render
        // a view
        return $this->response;
    }

}
