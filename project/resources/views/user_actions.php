<?php
require_once(LIB_PATH.'/renderTemplate.php');

# User Actions

/* RegisterUser 
* @return Used only for unit Testing
* -1: Username not valid
* -2: Password not valid
* -10: Duplicate User
* 1:  Success
*/
function registerUser() {
	global $_alert;
	$username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?$_POST['password']:'';

	$errors = array();

	if(!validStrLen($username, 50)) {
		$_alert->error('Username not valid');
		$return = -1;
	}

	if(!validStrLen($password, 20)) {
		$_alert->error('Password not valid');
		$return = -2;
	}

	# No errors
	if(empty($_alert->getError())) {
		require_once(MODELS_PATH.'/user.php');
		$user = new mUser();
		# Check if user is duplicate
		if(!$user->existUsername($username)) {
			if(!$user->insertEntry(array($username, $password))) {
				$_alert->error('Error while registering user');
			} else {
				$_alert->success('Register completed with success. You may now Login');
				$return = 1;
			}
		} else {
			$_alert->error('This username already exists in the database');
			$return = -10;
		}
	}
	if($return == 1)
		GO('?page=login');
	else
		GO('?page=register');

	return $return; // Used for unit Testing
}

/* LoginUser 
* @return Used only for unit Testing
* -1: Username not valid
* -2: Password not valid
* -10: Wrong Credentials
* 1:  Success
*/
function loginUser() {
	global $_user, $_alert;
	$username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?$_POST['password']:'';

	if(!validStrLen($username, 50)) {
		$_alert->error('Username not valid');
		$return = -1;
	}

	if(!validStrLen($password, 20)) {
		$_alert->error('Password not valid');
		$return = -2;
	}

	# No errors
	if(empty($_alert->getError())) {
		require_once(MODELS_PATH.'/user.php');
		$user = new mUser();
		$result = $user->correctCredentials(array($username, $password));
		if($result) {
			$data = array(
				'id'=>$result, 
				'username'=>$username
			);
			
			$_user->saveInfoLogin($data);
			$_alert->success('Login with success');

			$return = 1;
		} else {
			$_alert->error('Wrong Credentials');
			$return = -10;
		}
	}

	if($return == 1)
		GO();
	else
		GO("?page=login");

	return $return;
}

/* logoutUser 
* @return Used only for unit Testing
* -1: User not logged in
* 1:  Success
*/
function logoutUser() {
	global $_user, $_alert;
	$return = -1;
	
	if($_user->isLogged()) {
		
		$_user->logout();
		$_alert->success('We will be waiting for you soon');

		$return = 1;
	}
	
	GO();
	return $return;
}

function newPoll() {
	global $_user, $_alert;

	if(!$_user->isLogged()) {
		$_alert->error('Please login to perform this operation');
		$return = -10;
	}
		
	$user = $_user->id();

	$title = isset($_POST['title'])?$_POST['title']:'';
	$question = isset($_POST['question'])?$_POST['question']:'';
	$public = isset($_POST['isPublic'])?$_POST['isPublic']:'';
	$image = isset($_FILES['image'])?$_FILES['image']:'';

	if(!validStrLen($title, 50)) {
		$_alert->error('Title not valid');
		$return = -1;
	}

	if(!validStrLen($question, 500)) {
		$_alert->error('Password not valid');
		$return = -2;
	}

	if($public != 1 && $public != 0) {
		$_alert->error('Visibility not valid');
		$return = -4;
	}
	
	$server_filename = '';
	if($image == '') {
		$_alert->error('Image not valid');
		$return = -3;
	} else {
    	$filename = explode('.', $image['name']);
    	// Check for extension
    	// $filename[1] == 'auth'
    	// build unique name for image server_name
    	$pre = uniqid().'_';
    	$server_filename = $filename[0];
    	$server_filename = $pre.$image['name'];

    	$move_to = UPLOAD_PATH.'/'.$server_filename;
	}

	if(!validStrLen($server_filename, 255)) {
		$_alert->error('Image name not valid');
		$return = -3;
	}


	$answers = array();
	$i = 1;
	do {
		$answer = isset($_POST['answer'.$i])?$_POST['answer'.$i]:'';

		if($answer != '') {
			if(validStrLen($answer, 100)) {
				$answers[] = $answer;
			}
			$i++;
		}
	}while($answer != '');

	# No errors
	if(empty($_alert->getError())) {
		require_once(MODELS_PATH.'/poll.php');
		$poll = new mPoll();
		$data = array(
			'id_user'=>$user, 
			'title'=>$title, 
			'question'=>$question, 
			'image'=>$server_filename, 
			'answers'=>$answers,
			'isPublic'=>$public
		);

		$result = $poll->insertPoll($data);
		if($result > 0) {
			// Upload Image
   			if (move_uploaded_file($image['tmp_name'], $move_to)) {
				$_alert->success('Poll added with success');
   			} else {
   				$_alert->success('Poll added with success');
   				$_alert->error('Error while uploading image');
   			}
			$return = $result;
		} else {
			$_alert->error('Poll Error');
			$return = -99;
		}
	}

	if($return < 1)
		GO('?page=newPoll');
	else
		GO('?page=managePolls');

	return $return;
}

function editPoll() {
	global $_user, $_alert;

	if(!$_user->isLogged()) {
		$errors[] = 'Please login to perform this operation';
		$return = -10;
	} else {
		$user = $_user->id();
	}

	$poll_id = isset($_POST['poll'])?$_POST['poll']:'';
	$title = isset($_POST['title'])?$_POST['title']:'';
	$question = isset($_POST['question'])?$_POST['question']:'';
	$image = isset($_POST['image'])?$_POST['image']:'';
	$public = isset($_POST['isPublic'])?$_POST['isPublic']:'';
	

	if(!is_numeric($poll_id)) {
		$_alert->error('Poll not valid');
		$return = -1;
	}

	if(!validStrLen($title, 50)) {
		$_alert->error('Title not valid');
		$return = -2;
	}

	if(!validStrLen($question, 500)) {
		$_alert->error('Password not valid');
		$return = -3;
	}

	if(!validStrLen($image, 255)) {
		$_alert->error('Password not valid');
		$return = -4;
	}

	if($public != 1 && $public !=0) {
		$_alert->error('Password not valid');
		$return = -4;
	}

	$answers = array();
	$i = 1;
	//print_r($_POST['answer'.$i]);
	//exit;
	do {
		$answer = isset($_POST['answer'.$i])?$_POST['answer'.$i]:'';
		//echo $_POST['answer'.$i];
		if($answer != '') {
			if(validStrLen($answer, 100)) {
				$answers[] = $answer;
			}
			$i++;
		}
	}while($answer != '');

	# No errors
	if(empty($_alert->getError())) {
		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();
		# Check if the entry already exists
		if($poll->existPoll(array($poll_id))) {
			if($poll->userOwnsPoll(array($user, $poll_id))) {
				# All ok update entry
				$data = array(
					'poll_id'=>$poll_id, 
					'title'=>$title, 
					'question'=>$question, 
					'image'=>$image, 
					'answers'=>$answers,
					'isPublic'=>$public
				);
				if(!$poll->updatePoll($data)) {
					$_alert->error('Error while updating poll');
					$return = -102;
				}else {
					$_alert->success('Poll updated with success');
					$return = 1; # Success
				}
			} else {
				$_alert->error('This poll does not belong to the user');
				$return = -101;
			}
		} else {
			$_alert->error('This poll does not exist');
			$return = -100;
		}
	}

	GO();

	return $return;
}

function answerPoll() {
	global $_user, $_alert;

	$errors = array();
	if(!$_user->isLogged()) {
		$user = '';
	} else {
		$user = $_user->id();
	}

	$poll_id = isset($_POST['id'])?$_POST['id']:'';
	$answer = isset($_POST['answer'])?$_POST['answer']:'';

	if(!is_numeric($poll_id)) {
		$_alert->error('Poll not valid');
		$return = -1;
	}

	if(!is_numeric($answer)) {
		$_alert->error('Answer not valid');
		$return = -2;
	}

	if(empty($_alert->getError())) {
		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();

		$data = array('poll'=>$poll_id, 'answer'=>$answer, 'user'=>$user);
		$poll->addUserAnswer($data);
		$_alert->success('Your answer was recorded');
	}

	GO('?page=showPoll&poll='.$poll_id);
	return $return;
}

function deletePoll() {
	global $_user, $_alert;

	$errors = array();
	if(!$_user->isLogged()) {
		$_alert->error('Please login to manage your polls');
		GO('?page=login');
	} else {
		$user = $_user->id();
	}

	$poll_id = isset($_GET['poll'])?$_GET['poll']:'';

	if(!is_numeric($poll_id)) {
		$_alert->error('Poll not valid');
		$return = -1;
	}

	if(empty($_alert->getError())) {
		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();

		$data = array('poll'=>$poll_id, 'user'=>$user);
		$result = $poll->deletePoll($data);
		if($result == 0) {
			$_alert->error('This poll does not belong to you');
		} else {
			$_alert->success('Your poll was deleted with success');
		}
	}

	GO('?page=managePolls');
	return $return;
}

function closePoll() {
	global $_user, $_alert;

	$errors = array();
	if(!$_user->isLogged()) {
		$_alert->error('Please login to manage your polls');
		GO('?page=login');
	} else {
		$user = $_user->id();
	}

	$poll_id = isset($_GET['poll'])?$_GET['poll']:'';

	if(!is_numeric($poll_id)) {
		$_alert->error('Poll not valid');
		$return = -1;
	}

	if(empty($_alert->getError())) {
		require_once MODELS_PATH.'/poll.php';
		$poll = new mPoll();

		$data = array('poll'=>$poll_id, 'user'=>$user);
		$result = $poll->closePoll($data);
		if($result == 0) {
			$_alert->error('This poll does not belong to you');
		} else {
			$_alert->success('Your poll is now closed with success');
		}
	}

	GO('?page=managePolls');
	return $return;
}

# Auxiliary Functions
function validStrLen($str, $size) {
	if(empty($str) || strlen($str) > $size)
		return false;

	return true;
}
?>