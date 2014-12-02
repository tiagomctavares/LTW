<?php
require_once(LIB_PATH.'/renderTemplate.php');

function timeline() {
	global $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$template = new myTemplate();
	$template->render('timeline.php', $variables);
}

function home() {
	global $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$template = new myTemplate();
	$template->render('home.php', $variables);
}

function page_register() {
	global $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$template = new myTemplate();
	$template->render('register.php', $variables);
}

function page_login() {
	global $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$template = new myTemplate();
	$template->render('login.php', $variables);
}

function page_listPolls() {
	global $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$search = isset($_POST['searchPoll'])?$_POST['searchPoll']:'';

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPolls(array($search));

	$variables['polls'] = $polls; ## Polls
	$variables['user_action'] = ($search=='')?'all':'search'; ## True or false
	$variables['search_value'] = $search; ## Search Value

	$template = new myTemplate();
	$template->render('timeline.php', $variables);
}

function page_listPollsUser() {
	global $_user, $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$user_id = $_user->id();

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser(array($user_id));

	$variables['polls'] = $polls;
	$variables['user_action'] = 'user';

	$template = new myTemplate();
	$template->render('viewAllPolls.php', $variables);
}

function page_showPoll() {
	global $_user, $_alert;
	$poll_id = isset($_GET['poll'])?$_GET['poll']:0;
	$variables = array();

	if(is_numeric($poll_id)) {
		$_alert->getArray($variables);
		$_alert->reset();

		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();
		$polls = $poll->getPoll(array('poll'=>$poll_id, 'user'=>$_user->id()));

		if(empty($polls))
			listPolls();

		$variables['polls'] = $polls;

		$template = new myTemplate();
		$template->render('showPoll.php', $variables);
	} else {

		listPolls();

	}

}

function page_newPoll() {
	global $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$template = new myTemplate();
	$template->render('newPoll.php', $variables);
}
?>