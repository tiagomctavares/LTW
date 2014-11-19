<?php
require_once(LIB_PATH.'/mypdo.php');

interface iPoll {
	/* Add Poll in Database
	*  
	* @param (array) with
	* (int) user identifier
	* (text) title
	* (text) question
	* (text) image_server_name
	* (array) answers
	*		(text) answer n
	* @ return (int) poll_id
	*/
	function insertEntry($params);
}
# Model Poll
class mPoll implements iPoll {
	function insertEntry($params) {
		$answer_id = array();

		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$data[] = new myPDOparam($params[1], PDO::PARAM_STR);
		$data[] = new myPDOparam($params[2], PDO::PARAM_STR);
		$data[] = new myPDOparam($params[3], PDO::PARAM_STR);
		$result = $pdo->query('INSERT INTO poll (id_user, title, question, image) VALUES(?, ?, ?, ?);', $data);

		if($result == 1) {
			// Select last insert id
			$poll_id = $pdo->last_insert_id();

			foreach($params[4] as $answer) {
				$data = array();
				$data[] = new myPDOparam($poll_id, PDO::PARAM_INT);
				$data[] = new myPDOparam($answer, PDO::PARAM_STR);
				$result = $pdo->query('INSERT INTO poll_answer (id_poll, answer) VALUES(?, ?);', $data);
				if($result == 1)
					$answer_id[] = $pdo->last_insert_id();
			}
		} else {
			return 0;
		}

		// If needed for future development
		//$result = array($poll_id=>$answer_id);

		return $poll_id;
	}

}
?>