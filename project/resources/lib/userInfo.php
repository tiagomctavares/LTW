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
	}

	function setAnswerCookie() {
		if(isset($_SESSION['setcookie'])) {
			$params = $_SESSION['setcookie'];
			unset($_SESSION['setcookie']);
			if($this->getAnswerCookie($params) > 0) {
				$this->destroyAnswerCookie($params);
			}

			$path = HOME_URL;
			$path = ($path=='')?'/':$path;
			$set = setcookie ('poll'.$params['poll'], true, time()+604800, $path);
			$set = setcookie ('answer'.$params['poll'], $params['answer'], time()+604800, $path);
			$_COOKIE['poll'.$params['poll']] = true;
			$_COOKIE['answer'.$params['poll']] = $params['answer'];
		}
	}

	function getAnswerCookie($params) {
		# isset cookie
		if(isset($_COOKIE['poll'.$params['poll']])) {
			return $_COOKIE['answer'.$params['poll']];
		} else
			return 0;
	}

	function destroyAnswerCookie($params) {
		$path = HOME_URL;
		$path = ($path=='')?'/':$path;

		$set = setcookie ('poll'.$params['poll'], '', -3600, $path);
		// echo $set;
		$set = setcookie ('answer'.$params['poll'], '', -3600, $path);
	}

	function managePreviousPage() {
		if($_SERVER['HTTP_REFERER'] != $_SESSION['ppage'])
			$_SESSION['ppage'] = $_SERVER['HTTP_REFERER'];
	}

	function getPreviousPage() {
		if(isset($_SESSION['ppage'])) {
			return $_SESSION['ppage'];
		} else {
			$_SERVER['HTTP_REFERER']
		}
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