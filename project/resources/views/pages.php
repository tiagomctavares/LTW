<?php
require_once(LIB_PATH.'/renderTemplate.php');

function home() {
	$template = new myTemplate();
	$template->render('home.php');
}
?>