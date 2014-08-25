<?php
App::uses('AssistantTeacher', 'Model');

/**
 * AssistantTeacher Test Case
 *
 */
class AssistantTeacherTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.assistant_teacher',
		'app.user',
		'app.hoc_ham',
		'app.hoc_vi',
		'app.department',
		'app.course',
		'app.chapter',
		'app.field',
		'app.attachment',
		'app.attend',
		'app.courses_room',
		'app.room',
		'app.group',
		'app.users_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AssistantTeacher = ClassRegistry::init('AssistantTeacher');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AssistantTeacher);

		parent::tearDown();
	}

}
