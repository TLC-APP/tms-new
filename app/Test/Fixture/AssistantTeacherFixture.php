<?php
/**
 * AssistantTeacherFixture
 *
 */
class AssistantTeacherFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'course_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'lecture_hours' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modifield' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'user_id' => 1,
			'course_id' => 1,
			'lecture_hours' => 1,
			'created' => '2014-08-18 15:13:58',
			'modifield' => '2014-08-18 15:13:58',
			'id' => 1
		),
	);

}
