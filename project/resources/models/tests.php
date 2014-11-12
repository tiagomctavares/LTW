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

function getTest($id) {
    try {
	    $pdo = new myPDO();
	    $args[] = new myPDOparam($id, PDO::PARAM_INT);
	    $result = $pdo->query('SELECT * FROM test WHERE id=?;', $args);
	} catch(Exception $e) {
		throw $e->getMessage();
	}

	return $result[0];
}
?>