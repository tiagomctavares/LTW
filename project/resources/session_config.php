<?php
session_start();
if(!isset($_SESSION['valid_login']))
	$_SESSION['valid_login'] = false;
?>