<?php

class testUserStart extends UnitTestCase {
	var $username;

	function test_register() {
		$this->username = '___ttavares';
	    $_POST['username'] = $this->username;
	    $_POST['password'] = '1234';
	    $this->assertEqual(registerUser(), 1);
	}

	function test_login() {
	    $_POST['username'] = $this->username;
	    $_POST['password'] = '1234';
	    $this->assertEqual(loginUser(), 1);
	}

	function test_registerDuplicate() {
	    $_POST['username'] = $this->username;
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
	    $_POST['username'] = $this->username;
	    $_POST['password'] = '12345';
	    $this->assertEqual(loginUser(), -10);
	}
}
?>