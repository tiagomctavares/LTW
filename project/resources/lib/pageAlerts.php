<?php
class pageAlerts {
	function __construct() {
		if(!isset($_SESSION['alert']))
			$this->reset();
	}

	function getArray(&$param) {
		if(isset($_SESSION['alert']['success'][0]))
			$param['success'] = $_SESSION['alert']['success'][0];
		
		$param['errors'] =$_SESSION['alert']['danger'];
	}

	function get() {
		return $_SESSION['alert'];
	}

	function getSuccess() {
		return $_SESSION['alert']['success'];
	}

	function getError() {
		return $_SESSION['alert']['danger'];
	}

	/*

	function warning($value='') {
		$_SESSION['alert']['warning'][] = $value;
	}

	function info($value='') {
		$_SESSION['alert']['info'][] = $value;
	}*/

	function error($value='') {
		$_SESSION['alert']['danger'][] = $value;
	}

	function success($value='') {
		$_SESSION['alert']['success'][] = $value;
	}

	function reset() {
		/*$_SESSION['alert'] = array();
		$_SESSION['info'] = array();*/
		$_SESSION['alert']['success'] = array();
		$_SESSION['alert']['danger'] = array();
	}
}
?>