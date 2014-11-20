<?php
require_once(LIB_PATH.'/simpletest/autorun.php');
require_once(VIEWS_PATH.'/user_actions.php');

class AllTests extends TestSuite {
    function __construct() {
    	$tests = array();
    	$tests[] = 'testUserStart';
    	$tests[] = 'testPoll';
    	$tests[] = 'testUserEnd';

        parent::__construct();

        foreach($tests as $test) {
        	require_once($test.'.php');
        	$this->add((new ReflectionClass($test))->newInstanceArgs());
        }
    }
}
?>