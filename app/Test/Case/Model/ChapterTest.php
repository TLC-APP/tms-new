<?php
App::uses('Chapter', 'Model');

/**
 * Chapter Test Case
 *
 */
class ChapterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.chapter',
		'app.field',
		'app.user',
		'app.hoc_ham',
		'app.hoc_vi',
		'app.department',
		'app.course',
		'app.attend',
		'app.courses_room',
		'app.room',
		'app.attachment',
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
		$this->Chapter = ClassRegistry::init('Chapter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Chapter);

		parent::tearDown();
	}

/**
 * testCreateWithAttachments method
 *
 * @return void
 */
	public function testCreateWithAttachments() {
		$this->markTestIncomplete('testCreateWithAttachments not implemented.');
	}

/**
 * testIsOwnedBy method
 *
 * @return void
 */
	public function testIsOwnedBy() {
		$this->markTestIncomplete('testIsOwnedBy not implemented.');
	}

/**
 * testGetChapterByFieldId method
 *
 * @return void
 */
	public function testGetChapterByFieldId() {
		$this->markTestIncomplete('testGetChapterByFieldId not implemented.');
	}

}
