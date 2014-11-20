<?php
require_once(LIB_PATH.'/renderTemplate.php');

function home() {
	$template = new myTemplate();
	$template->render('home.php');
}

function listPolls() {
	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPolls();
	$variables = array(
		'polls' => $polls
	);
	$template = new myTemplate();
	$template->render('test_output.php');
}
?>