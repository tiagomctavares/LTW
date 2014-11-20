<?php

class testUserEnd extends UnitTestCase {
	var $user;

	function test_logout() {
		$this->user = $_SESSION['user']['id'];
	    $this->assertEqual(logoutUser(), 1);
	}

	function test_logoutError() {
	    $this->assertEqual(logoutUser(), -1);
	}

	function test_cleanDB() {
		require_once(LIB_PATH.'/mypdo.php');
		$pdo = new myPDO();
		$user = $this->user;
		$data = array(new myPDOparam($user, PDO::PARAM_INT));
		$pdo->query('DELETE FROM User WHERE id=?;', $data);
	    $this->assertTrue(true);
	}
}