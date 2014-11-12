<?php
require_once LIB_PATH."/mypdo.php";

function getAllTests() {
    try {
	    $pdo = new myPDO();
	    $result = $pdo->query('SELECT * FROM test;');
	} catch(Exception $e) {
		throw $e->getMessage();
	}

	return $result;
}
?>