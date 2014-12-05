<?php
function ajax_getUserPolls() {
	global $_user, $_alert;
	$variables = array();
	$_alert->getArray($variables);
	$_alert->reset();

	$user_id = $_user->id();

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser(array($user_id));

	echo json_encode($polls);
}
?>