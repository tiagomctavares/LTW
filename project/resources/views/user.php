<?php
require_once(LIB_PATH.'/template_functions.php');

# User Actions

/* User Register */
function registerUser() {
	$username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?$_POST['password']:'';

	$errors = array();

	if(!validateUsername($username))
		$errors[] = 'Username not valid';

	if(!validatePassword($password))
		$errors[] = 'Password not valid';

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
			}
		} else {
			$errors[] = 'This username already exists in the database';
		}
	}

	# No success
	if(!isset($variables))
		$variables = array(
			'errors'=>$errors,
			'username'=>$username
		);

	renderLayoutWithContentFile("test_output.php", $variables);
}

function loginUser() {
	$username = isset($_POST['username'])?$_POST['username']:'';
	$password = isset($_POST['password'])?$_POST['password']:'';
	
	$errors = array();

	if(!validateUsername($username))
		$errors[] = 'Username not valid';

	if(!validatePassword($password))
		$errors[] = 'Password not valid';

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
		} else {
			$errors[] = 'Wrong Credentials';
		}
	}
	# No success
	if(!isset($variables))
		$variables = array(
			'errors'=>$errors,
			'username'=>$username
		);

	renderLayoutWithContentFile("test_output.php", $variables);
}

function logoutUser() {
	if($_SESSION['valid_login'] == true) {

		$_SESSION['valid_login'] = false;
		unset($_SESSION['user']);

		$variables = array(
			'success'=>'We will be waiting for you soon'
		);
	}

	renderLayoutWithContentFile("test_output.php", $variables);
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