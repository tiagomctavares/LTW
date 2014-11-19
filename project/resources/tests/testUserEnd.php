<?php

class testUserEnd extends UnitTestCase {
	function test_logout() {
	    $this->assertEqual(logoutUser(), 1);
	}

	function test_logoutError() {
	    $this->assertEqual(logoutUser(), -1);
	}

	function test_cleanDB() {
		require_once(LIB_PATH.'/mypdo.php');
		$pdo = new myPDO();
		$user = $_SESSION['user']['id'];
		$data = array(new myPDOparam($user, PDO::PARAM_INT));
		$pdo->query('DELETE FROM User WHERE id=?;', $data);
	    $this->assertTrue(true);
	}
}