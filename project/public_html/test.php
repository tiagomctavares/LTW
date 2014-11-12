<?php
# This file is used for tests
session_start();
if(!isset($_SESSION['valid_login']))
	$_SESSION['valid_login'] = false;

require_once realpath(dirname(__FILE__) . "/../resources/config.php");
require_once(VIEWS_PATH.'/user.php');


function testRegister() {
    $_POST['username'] = 'ttavares';
    $_POST['password'] = '1234';
    registerUser();
}

function testLogin() {
    $_POST['username'] = 'ttavares';
    $_POST['password'] = '1234';
    loginUser();
}

function testLogout() {
    logoutUser();
}

# Done!
#testRegister();
#testLogin();
#testLogout();

?>