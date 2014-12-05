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

	$search = isset($_POST['searchPoll'])?$_POST['searchPoll']:'';

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPolls(array('search'=>$search));

	$variables['polls'] = $polls; ## Polls
	$variables['user_action'] = ($search=='')?'all':'search'; ## True or false
	$variables['search_value'] = $search; ## Search Value

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
	global $_alert, $_user;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$search = isset($_POST['searchPoll'])?$_POST['searchPoll']:'';

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPolls(array('search'=>$search));
	$counters = $poll->getPollCounters(array('user'=>$_user->id()));

	$variables['polls'] = $polls; ## Polls
	$variables['counters'] = $counters; ## Polls
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
	$data = array('user'=>$user_id);

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser($data);
	$counters = $poll->getUserPollCounters($data);

	$variables['polls'] = $polls;
	$variables['counters'] = $counters;
	$variables['user_action'] = 'user';

	$template = new myTemplate();
	$template->render('viewAllPolls.php', $variables);
}

function page_showPoll() {
	global $_user, $_alert;
	$poll_id = isset($_GET['poll'])?$_GET['poll']:0;
	$variables = array();

	$_user->setAnswerCookie();

	if(is_numeric($poll_id)) {
		$_alert->getArray($variables);
		$_alert->reset();

		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();
		$polls = $poll->getPoll(array('poll'=>$poll_id, 'user'=>$_user->id()));

		if(empty($polls))
			listPolls();

		$variables['previous_page'] = $_user->getPreviousPage();
		$variables['polls'] = $polls;

		$template = new myTemplate();
		$template->render('showPoll.php', $variables);
	} else {

		listPolls();

	}

}

function page_newPoll() {
	global $_user, $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();
	$variables['previous_page'] = $_user->getPreviousPage();

	$template = new myTemplate();
	$template->render('newPoll.php', $variables);
}

function page_editPoll() {
	global $_user, $_alert;
	$poll_id = isset($_GET['poll'])?$_GET['poll']:0;
	$variables = array();

	if(is_numeric($poll_id)) {
		$_alert->getArray($variables);
		$_alert->reset();

		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();
		$polls = $poll->getPoll(array('poll'=>$poll_id, 'user'=>$_user->id()));

		if(empty($polls)) {
			$_alert->error('You don\'t have permissions to edit this poll');
			GO('?page=managePolls');
		}

		$variables['previous_page'] = $_user->getPreviousPage();
		$variables['polls'] = $polls;

		$template = new myTemplate();
		$template->render('editPoll.php', $variables);
	} else {

		listPolls();

	}
}

function page_resultsPoll() {
	global $_user, $_alert;
	$poll_id = isset($_GET['poll'])?$_GET['poll']:0;
	$variables = array();

	$_user->setAnswerCookie();

	if(is_numeric($poll_id)) {
		$_alert->getArray($variables);
		$_alert->reset();

		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();
		$polls = $poll->getPoll(array('poll'=>$poll_id, 'user'=>$_user->id()));

		if(empty($polls))
			listPolls();

		$variables['previous_page'] = $_user->getPreviousPage();
		$variables['polls'] = $polls;

		$template = new myTemplate();
		$template->render('results.php', $variables);
	} else {

		listPolls();

	}	
}

?>