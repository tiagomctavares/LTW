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

	/* Checks if a poll with sent identifier exists
	*  
	* @param (array) with
	* (int) poll identifier
	* @ return (boolean)
	*/
	function existEntry($params);

	/* Checks if a poll belongs to User
	*  
	* @param (array) with
	* (int) user identifier
	* (int) poll identifier
	* @ return (boolean)
	*/
	function userOwnsEntry($params);

		/* Manage a Poll in Database
	*  
	* @param (array) with
	* (int) user identifier
	* (int) poll identifier
	* (text) title
	* (text) question
	* (text) image_server_name
	* (array) answers
	*		(text) answer n
	* @ return (int) poll_id
	*/
	function updateEntry($params);
}
# Model Poll
class mPoll implements iPoll {
	function insertEntry($params) {
		$answer_id = array();

		$pdo = new myPDO();
		$data[] = new myPDOparam($params['id_user'], PDO::PARAM_INT);
		$data[] = new myPDOparam($params['title'], PDO::PARAM_STR);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll WHERE id_user=? AND title=?;', $data);
		if($result[0]->result != 0) {
			return 0;
		}

		$data[] = new myPDOparam($params['question'], PDO::PARAM_STR);
		$data[] = new myPDOparam($params['image'], PDO::PARAM_STR);
		$data[] = new myPDOparam($params['isPublic'], PDO::PARAM_INT);
		$result = $pdo->query('INSERT INTO poll (id_user, title, question, image, isPublic) VALUES(?, ?, ?, ?, ?);', $data);

		// Select last insert id
		$poll_id = $pdo->last_insert_id();

		foreach($params['answers'] as $answer)
			$answer_id[] = $this->insertPollAnswer(array($poll_id, $answer));
	

		// If needed for future development
		//$result = array($poll_id=>$answer_id);

		return $poll_id;
	}

	# INSERT POLL ANSWER IF ALREADY EXISTS RETURNS THE ID
	function insertPollAnswer($params) {
		$pdo = new myPDO();
		$data = array();
		# Poll ID
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		# Answer
		$data[] = new myPDOparam($params[1], PDO::PARAM_STR);

		if(!$this->existEntryAnswer($params)) {

			$result = $pdo->query('INSERT INTO poll_answer (id_poll, answer) VALUES(?, ?);', $data);
			return $pdo->last_insert_id();

		} else {

			$result = $pdo->query('SELECT id FROM poll_answer WHERE id_poll=? AND answer=?;', $data);
			return $result[0]->id;

		}
	}

	function removePollAnswer($params) {
		$pdo = new myPDO();
		$data = array();
		# Answer ID
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('DELETE FROM poll_answer WHERE id=?;', $data);
		return $result;
	}

	function existEntryAnswer($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$data[] = new myPDOparam($params[0], PDO::PARAM_STR);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll_answer WHERE id_poll=? AND answer=?;', $data);

		return ($result[0]->result > 0);
	}


	function existEntry($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll WHERE id=?;', $data);

		return $result[0]->result;
	}

	function userOwnsEntry($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$data[] = new myPDOparam($params[1], PDO::PARAM_INT);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll WHERE id_user=? AND id=?;', $data);

		return $result[0]->result;
	}

	function updateEntry($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[1], PDO::PARAM_STR);
		$data[] = new myPDOparam($params[2], PDO::PARAM_STR);
		$data[] = new myPDOparam($params[3], PDO::PARAM_STR);
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('UPDATE poll SET title=?, question=?, image=? WHERE id=?;', $data);


		$answers_id = $this->getPollAnswers(array($params[0]));
		# GET ARRAY OF ID'S
		foreach($answers_id as &$elem)
			$elem = $elem->id;

		$new_answers_id = array();

		foreach($params[4] as $answer)
			$new_answers_id[] = $this->insertPollAnswer(array($params[0], $answer));


		# REMOVE ANSWERS THAT ARE NOT IN NEW ARRAY
		$remove = array_diff($answers_id, $new_answers_id);
		foreach($remove as $remove_id) {
			$this->removePollAnswer(array($remove_id));
		}

		return 1;
	}

	function getPollAnswers($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('SELECT id, answer FROM poll_answer WHERE id_poll=?;', $data);
		return $result;
	}

	function getPolls($params = array()) {
		$pdo = new myPDO();
		$data[] = new myPDOparam("%$params[0]%", PDO::PARAM_STR);
		$result = $pdo->query('SELECT * FROM poll WHERE title LIKE ? AND isPublic=1;', $data);
		return $result;
	}

	function getPollsUser($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('SELECT * FROM poll WHERE id_user=?;', $data);
		return $result;
	}

	function getPoll($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('SELECT * FROM poll WHERE id = ? AND isPublic=1;', $data);
		return $result[0];
	}
}
?>