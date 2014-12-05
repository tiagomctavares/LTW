<?php
function ajax_getUserPolls() {
	global $_user;

	if(!$_user->isLogged()) {
		echo json_encode(array());
		exit;
	}

	$values = isset($_POST['values'])?$_POST['values']:array();

	if(empty($values)) {
		echo json_encode(array());
		exit;
	}

	$options = array();
	$isPublic = $isOpen = $voted = 2;

	foreach($values as $value) {
		$isPublic = ($value == 'public')?1:$isPublic;
		$isPublic = ($value == 'private')?0:$isPublic;
		$isOpen = ($value == 'open')?1:$isOpen;
		$isOpen = ($value == 'closed')?0:$isOpen;
		$voted = ($value == 'voted')?1:$voted;
		$voted = ($value == 'unvoted')?0:$unvoted;
	}

	$user_id = $_user->id();

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser(array('user'=>$user_id, 'isPublic'=>$isPublic, 'isClosed'=>$isClosed, 'voted'=>$voted));

	echo json_encode($polls);
}
?>