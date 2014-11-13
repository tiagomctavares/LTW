<?php
require_once(VIEWS_PATH.'/user.php');

class testM1_actions extends UnitTestCase {
	function test_register() {
	    $_POST['username'] = '_ttavares';
	    $_POST['password'] = '1234';
	    $this->assertEqual(registerUser(), 1);
	}

	function test_login() {
	    $_POST['username'] = '_ttavares';
	    $_POST['password'] = '1234';
	    $this->assertEqual(loginUser(), 1);
	}

	function test_registerDuplicate() {
	    $_POST['username'] = '_ttavares';
	    $_POST['password'] = '1234';
	    $this->assertEqual(registerUser(), -10);
	}

	function test_registerErrorInput() {
	    $_POST['username'] = 'ttttttttttttttttttttttttttttttttttttttttttttttttttt';
	    $_POST['password'] = '1234';
	    $this->assertEqual(registerUser(), -1);
	}

	function test_loginErrorInput() {
	    $_POST['username'] = 'ttttttttttttttttttttttttttttttttttttttttttttttttttt';
	    $_POST['password'] = '1234';
	    $this->assertEqual(loginUser(), -1);
	}

	function test_loginBadCredentials() {
	    $_POST['username'] = '_ttavares';
	    $_POST['password'] = '12345';
	    $this->assertEqual(loginUser(), -10);
	}

	function test_logout() {
	    $this->assertEqual(logoutUser(), 1);
	}

	function test_logoutError() {
	    $this->assertEqual(logoutUser(), -1);
	}

	function test_cleanDB() {
		require_once(LIB_PATH.'/mypdo.php');
		$pdo = new myPDO();
		$pdo->query('DELETE FROM User WHERE username LIKE "_ttavares";');
	}
}
?>