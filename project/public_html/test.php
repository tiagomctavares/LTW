<?php
# This file is used for tests
define("TESTING", true);
require_once realpath(dirname(__FILE__) . "/../resources/config.php");

require_once(TESTS_PATH.'/all_tests.php');
/*
require_once VIEWS_PATH.'/user_actions.php';

$_SESSION['valid_login'] = true;
$_SESSION['user'] = array('id'=>1);

$_POST['poll'] = 1;
$_POST['title'] = 'Poll 1';
$_POST['question'] = 'What?';
$_POST['image'] = 'myImage';
$_POST['answer1'] = 'a5';
$_POST['answer2'] = 'a2';
$_POST['answer3'] = 'a3';
$_POST['answer4'] = 'a7';
$_POST['answer5'] = 'a8';
managePoll();*/
?>