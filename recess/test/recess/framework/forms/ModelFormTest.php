<?php

Library::import('recess.framework.forms.ModelForm');
Library::import('recess.database.orm.Model');
Library::import('recess.http.Methods');

require_once('PHPUnit/Extensions/Database/TestCase.php');

class DefaultValuesModel extends Model {

	public function setSource($source) {
		return self::getClassDescriptor($this)->setSource($source);
	}

	/**
	 * !Column Integer
	 * !DefaultValue '1234'
	 */
	public $int;

	/**
	 * !Column String
	 * !DefaultValue ' A, "difficult", \\default\\ \'value\''
	 */
	public $char;

	/**
	 * !Column DateTime
	 * !DefaultValue NOW
	 */
	public $datetime;

	/**
	 * !Column Timestamp
	 * !DefaultValue NOW
	 */
	public $timestamp;
}

class ModelFormTest extends PHPUnit_Framework_TestCase {

	/** @var DefaultValuesModel */
	protected $model;

	/** @var Form */
	protected $postForm;

	function setUp() {
		$this->model = new DefaultValuesModel;
		$this->model->setSource('dummy');
		$this->postForm = new ModelForm('testDefault', array(), $this->model);
		$this->postForm->to(Methods::POST, '');
	}

	function testDefaultValues() {
		$intValue = (int) $this->postForm->inputs['int']->getValue();
		$charValue = $this->postForm->inputs['char']->getValue();
		$datetimeValue = $this->postForm->inputs['datetime']->getValue();
		$timestampValue = $this->postForm->inputs['timestamp']->getValue();

		$now = time();

		$this->assertEquals($intValue, 1234);
		$this->assertEquals($charValue, ' A, "difficult", \\default\\ \'value\'');

		// Allow a range of 2 seconds
		$this->assertLessThan(2, $now - $datetimeValue);
		$this->assertLessThan(2, $now - $timestampValue);
	}

	function tearDown() {
		unset($this->postForm, $this->model);
	}
}

?>
