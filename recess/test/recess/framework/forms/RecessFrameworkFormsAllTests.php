<?php

require_once 'PHPUnit/Framework.php';
require_once 'recess/framework/forms/ModelFormTest.php';

class RecessFrameworkFormsAllTests
{
	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('recess.framework.forms');

		$suite->addTestSuite('ModelFormTest');

		return $suite;
	}
}

?>
