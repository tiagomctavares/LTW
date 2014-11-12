<?php
require_once(LIB_PATH.'/mypdo.php');

interface iUser {
	/* Add User in Database
	*  
	* @param (array) with
	* (text) username
	* (text) password
	* @ return (int) 
	*/
	function insertEntry($params);

	/* Check Login Creditials of user in application 
	* 
	* @param (array) with
	* (text) username
	* (text) password
	* @return (int) userId
	*/
	function correctCredentials($params);

	/* Checks if username already exists
	* 
	* @param (text) username
	* @return (bool)
	*/
	function existUsername($username);
}
# Model User
class mUser implements iUser {
	function insertEntry($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_STR);
		var_dump($data);
		$data[] = new myPDOparam(hash('sha256', $params[1]), PDO::PARAM_STR);
		var_dump($data);
		$data[] = new myPDOparam(@date("Y-m-d H:i:s"), PDO::PARAM_STR);
		var_dump($data);

		$result = $pdo->query('INSERT INTO User (username, password, createDate) VALUES(?, ?, ?);', $data);

		var_dump($result);

		return $result[0]==0;

	}

	function correctCredentials($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_STR);
		$data[] = new myPDOparam(hash('sha256', $params[1]), PDO::PARAM_STR);
		
		$result = $pdo->query('SELECT id FROM User WHERE username LIKE ? AND password LIKE ?;', $data);
		
		$result = empty($result)?0:$result[0]->id;

		if($result>0) {
			# Reset Array
			$data = array();
			$data[] = new myPDOparam(@date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$data[] = new myPDOparam($result[0], PDO::PARAM_INT);
			$pdo->query('UPDATE User SET lastLogin=? WHERE id=?', $data);
		}

		return $result;
	}

	function existUsername($username) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($username, PDO::PARAM_STR);

		$result = $pdo->query('SELECT COUNT(*) as res FROM User WHERE username LIKE ?;', $data);
		
		return ($result[0]->res)>0;
	}
}
?>