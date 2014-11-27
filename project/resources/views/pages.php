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

function page_login() {
	$template = new myTemplate();
	$template->render('login.php');
}

function listPolls() {
	$search = isset($_POST['search'])?isset($_POST['search']):'';

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPolls(array($search));
	$variables = array(
		'polls' => $polls,
		'search'=> ($search!=''),
		'search_value'=> $search
	);
	$template = new myTemplate();
	$template->render('viewAllPolls.php', $variables);
}

function listPollsUser() {
	$user_id = $_SESSION['user']['id'];

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser(array($user_id));
	$variables = array(
		'polls' => $polls
	);
	$template = new myTemplate();
	$template->render('test_output.php', $variables);
}

function showPoll() {
	# for test - how can i get the position from polls list?
	$poll_id = isset($_GET['poll'])?$_GET['poll']:0;
	if(is_numeric($poll_id)) {

		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();
		$polls = $poll->getPoll(array($poll_id));
		if(empty($polls))
			listPolls();
		$answers = $poll->getPollAnswers(array($poll_id));
		$variables = array(
			'polls' => $polls,
			'answers' => $answers
		);
		$template = new myTemplate();
		$template->render('showPoll.php', $variables);
	} else {
		listPolls();
	}

}
?>