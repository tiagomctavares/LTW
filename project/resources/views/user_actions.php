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
	$username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?$_POST['password']:'';

	$errors = array();

	if(!validStrLen($username, 50)) {
		$errors[] = 'Username not valid';
		$return = -1;
	}

	if(!validStrLen($password, 20)) {
		$errors[] = 'Password not valid';
		$return = -2;
	}

	# No errors
	if(empty($errors)) {
		require_once(MODELS_PATH.'/user.php');
		$user = new mUser();
		# Check if user is duplicate
		if(!$user->existUsername($username)) {
			if(!$user->insertEntry(array($username, $password))) {
				$errors[] = 'Error while registering user';
			} else {
				$variables = array(
					'success'=>'Register completed with success. You may now Login',
					'username'=>$username
				);
				$return = 1;
			}
		} else {
			$errors[] = 'This username already exists in the database';
			$return = -10;
		}
	}

	# No success
	if(!isset($variables)) {
		$variables = array(
			'errors'=>$errors,
			'username'=>$username
		);
	}
	
	$template = new myTemplate();
	$template->render("test_output.php", $variables);
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
	$username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?$_POST['password']:'';
	
	$errors = array();

	if(!validStrLen($username, 50)) {
		$errors[] = 'Username not valid';
		$return = -1;
	}

	if(!validStrLen($password, 20)) {
		$errors[] = 'Password not valid';
		$return = -2;
	}

	# No errors
	if(empty($errors)) {
		require_once(MODELS_PATH.'/user.php');
		$user = new mUser();
		$result = $user->correctCredentials(array($username, $password));
		if($result) {
			$_SESSION['valid_login'] = true;
			$_SESSION['user'] = array('username'=>$username, 'id'=>$result);
			$variables = array(
				'success'=>'Login with success',
			);
			$return = 1;
		} else {
			$errors[] = 'Wrong Credentials';
			$return = -10;
		}
	}
	# No success
	if(!isset($variables))
		$variables = array(
			'errors'=>$errors,
			'username'=>$username
		);

	$template = new myTemplate();
	$template->render("test_output.php", $variables);
	return $return;
}

/* logoutUser 
* @return Used only for unit Testing
* -1: User not logged in
* 1:  Success
*/
function logoutUser() {
	$return = -1;
	$variables = array();
	
	if($_SESSION['valid_login'] == true) {

		$_SESSION['valid_login'] = false;
		unset($_SESSION['user']);

		$variables = array(
			'success'=>'We will be waiting for you soon'
		);
		$return = 1;
	}
	
	$template = new myTemplate();
	$template->render("test_output.php", $variables);
	return $return;
}

function newPoll() {
	/*if(!$_SESSION['valid_login']) {
		$errors[] = 'Please login to perform this operation';
		$return -10;
	}

	$user = $_SESSION['user']['id'];*/

	# FOR TESTING
	$user = 1;

	$title = isset($_POST['title'])?$_POST['title']:'';
	$question = isset($_POST['question'])?$_POST['question']:'';
	$image = isset($_POST['image'])?$_POST['image']:'';
	
	$errors = array();

	if(!validStrLen($title, 50)) {
		$errors[] = 'Title not valid';
		$return = -1;
	}

	if(!validStrLen($question, 500)) {
		$errors[] = 'Password not valid';
		$return = -2;
	}

	if(!validStrLen($image, 255)) {
		$errors[] = 'Password not valid';
		$return = -3;
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
	if(empty($errors)) {
		require_once(MODELS_PATH.'/poll.php');
		$poll = new mPoll();
		$result = $poll->insertEntry(array($user, $title, $question, $image, $answers));
		if($result > 0) {
			$variables = array(
				'success'=>'Poll added with success',
			);
			$return = $result;
		} else {
			$errors[] = 'Poll Error';
			$return = -99;
		}
	}
	# No success
	if(!isset($variables))
		$variables = array(
			'errors'=>$errors
		);

	$template = new myTemplate();
	$template->render("test_output.php", $variables);
	return $return;
}


# Auxiliary Functions
function validStrLen($str, $size) {
	if(empty($str) || strlen($str) > $size)
		return false;

	return true;
}
?>