<?php
App::uses('HocHam', 'Model');

/**
 * HocHam Test Case
 *
 */
class HocHamTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hoc_ham',
		'app.user',
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
		$this->HocHam = ClassRegistry::init('HocHam');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HocHam);

		parent::tearDown();
	}

}
