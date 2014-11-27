<?php
class UserInfo {

	function __construct() {
		if(!isset($_SESSION['valid_login']))
			$_SESSION['valid_login'] = false;
	}

	function isLogged() {
		return $_SESSION['valid_login'];
	}

	// Object
	function saveInfoLogin($result) {
		$_SESSION['user']['id'] = $result['id'];
		$_SESSION['user']['username'] = $result['username'];

		$_SESSION['valid_login'] = true;

		## COOKIES
		##		identity - user_id
		##		identifier - HASH

		/*global $config;
		$path = $config['urls']['baseDir'];
		$path = ($path=='')?'/':'/'.$path;

		$set = setcookie ('identity', $result->username, time()+28800, $path);
		$set = setcookie ('identifier', $result->cookie, time()+28800, $path);*/
	}

	function __toString() {
		return $this->username();
	}

	function username() {
		if(isset($_SESSION['user']['username']))
			return $_SESSION['user']['username'];
		else
			return '';
	}

	function id() {
		if(isset($_SESSION['user']['id']))
			return $_SESSION['user']['id'];
		else
			return 0;
	}

	function logout() {

		/*global $config;
		$path = $config['urls']['baseDir'];
		$path = ($path=='')?'/':'/'.$path.'/';
		$domain = $config['urls']['baseUrl'];
		
		setcookie ('identity', '', time()-28800, $path, $domain, false, true);
		setcookie ('identifier', '', time()-28800, $path, $domain, false, true);
		*/
		unset($_SESSION['user']);

		$_SESSION['valid_login'] = false;
	}
}
?>