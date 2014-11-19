<?php
require_once(LIB_PATH.'/simpletest/autorun.php');

class AllTests extends TestSuite {
    function __construct() {
    	$tests = array('testM2_actions');

        parent::__construct();
        foreach($tests as $test) {
        	require_once($test.'.php');
        	$this->add((new ReflectionClass($test))->newInstanceArgs());
        }
    }
}
?>