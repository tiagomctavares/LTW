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
	$isPublic = $isClosed = $voted = 2;

	foreach($values as $value) {
		$isPublic = ($value == 'public')?1:$isPublic;
		$isPublic = ($value == 'private')?0:$isPublic;
		$isClosed = ($value == 'open')?0:$isClosed;
		$isClosed = ($value == 'closed')?1:$isClosed;
		$voted = ($value == 'voted')?1:$voted;
		$voted = ($value == 'unvoted')?0:$voted;
	}

	$user_id = $_user->id();
	$data['user'] = $user_id;
	if($isPublic != 2) $data['isPublic'] = $isPublic;
	if($isClosed != 2) $data['isClosed'] = $isClosed;
	if($isPublic != 2) $data['voted'] = $voted;

	require_once MODELS_PATH.'/poll.php';
	$poll = new mPoll();
	$polls = $poll->getPollsUser($data);

	echo json_encode($polls);
}
?>