<?php

require_once 'PHPUnit/Framework.php';
require_once 'recess/framework/routing/RecessFrameworkRoutingAllTests.php';
require_once 'recess/framework/helpers/RecessFrameworkHelpersAllTests.php';
require_once 'recess/framework/forms/RecessFrameworkFormsAllTests.php';

class RecessFrameworkAllTests
{
	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('recess.framework');

		$suite->addTestSuite(RecessFrameworkRoutingAllTests::suite());
		$suite->addTestSuite(RecessFrameworkHelpersAllTests::suite());
		$suite->addTestSuite(RecessFrameworkFormsAllTests::suite());

		return $suite;
	}
}

?>
