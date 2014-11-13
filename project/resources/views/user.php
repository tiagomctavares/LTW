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

	if(!validateUsername($username)) {
		$errors[] = 'Username not valid';
		$return = -1;
	}

	if(!validatePassword($password)) {
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

	if(!validateUsername($username)) {
		$errors[] = 'Username not valid';
		$return = -1;
	}

	if(!validatePassword($password)) {
		$errors[] = 'Password not valid';
		return -2;
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
			$return =1;
		} else {
			$errors[] = 'Wrong Credentials';
			return -10;
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


# Auxiliary Functions
function validateUsername($username) {
	if(empty($username) || strlen($username) > 50)
		return false;

	return true;
}

function validatePassword($password) {
	if(empty($password) || (strlen($password)>20 && strlen($password) < 4))
		return false;

	return true;
}
?>