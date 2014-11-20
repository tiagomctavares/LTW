<?php
require_once(LIB_PATH.'/renderTemplate.php');

function home() {
	$template = new myTemplate();
	$template->render('home.php');
}

function page_register() {
	$template = new myTemplate();
	$template->render('register.php');
}

function listPolls() {
	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPolls();
	$variables = array(
		'polls' => $polls
	);
	$template = new myTemplate();
	$template->render('test_output.php', $variables);
}

function listPollsUser() {
	# for test
	$user_id = 1;

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser(array($user_id));
	$variables = array(
		'polls' => $polls
	);
	$template = new myTemplate();
	$template->render('test_output.php', $variables);
}

function listPollsSearch() {
	# for test
	$search = 'My';

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsSearch(array($search));
	$variables = array(
		'polls' => $polls
	);
	$template = new myTemplate();
	$template->render('test_output.php', $variables);
}

function showPoll() {
	# for test
	$poll_id = 1;

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPoll(array($poll_id));
	$answers = $poll->getPollAnswers(array($poll_id));
	$variables = array(
		'polls' => $polls,
		'answers' => $answers
	);
	$template = new myTemplate();
	$template->render('test_output.php', $variables);
}
?>