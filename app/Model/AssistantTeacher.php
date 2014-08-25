<?php

App::uses('AppModel', 'Model');

/**
 * AssistantTeacher Model
 *
 * @property User $User
 * @property Course $Course
 */
class AssistantTeacher extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
