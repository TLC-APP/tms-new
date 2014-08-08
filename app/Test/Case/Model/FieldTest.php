<?php
App::uses('Field', 'Model');

/**
 * Field Test Case
 *
 */
class FieldTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.field',
		'app.user',
		'app.hoc_ham',
		'app.hoc_vi',
		'app.department',
		'app.course',
		'app.chapter',
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
		$this->Field = ClassRegistry::init('Field');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Field);

		parent::tearDown();
	}

}
