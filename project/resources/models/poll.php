<?php
require_once(LIB_PATH.'/mypdo.php');

interface iPoll {
	# POLL
	function insertPoll($params);
	function existPoll($params);
	function userOwnsPoll($params);
	function updatePoll($params);
	function getPoll($params);
	function userAnswerPoll($params);

	#POLLS
	function getPolls($params);
	function getPollsUser($params);

	# ANSWER
	function existPollAnswer($params);
	function addUserAnswer($params);
}

# Model Poll
class mPoll implements iPoll {
	/* Add Poll in Database
	*  
	* @param (array) with
	* (int) user identifier
	* (str) title
	* (str) question
	* (int) isPublic
	* (str) image_server_name
	* (array) answers
	*		(str) answer n
	* @ return (int) poll_id
	*/
	function insertPoll($params) {
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

	/* Checks if answer with sent poll identifier exists
	*  
	* @param (array) with
	* (int) poll identifier
	* (str) answer
	* @ return (boolean)
	*/
	function existPollAnswer($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$data[] = new myPDOparam($params[1], PDO::PARAM_STR);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll_answer WHERE id_poll=? AND answer=?;', $data);

		return ($result[0]->result > 0);
	}

	/* Checks if a poll with sent identifier exists
	*  
	* @param (array) with
	* (int) poll identifier
	* @ return (boolean)
	*/
	function existPoll($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll WHERE id=?;', $data);

		return $result[0]->result;
	}

	/* Checks if a poll belongs to User
	*  
	* @param (array) with
	* (int) user identifier
	* (int) poll identifier
	* @ return (boolean)
	*/
	function userOwnsPoll($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$data[] = new myPDOparam($params[1], PDO::PARAM_INT);
		$result = $pdo->query('SELECT COUNT(*) as result FROM poll WHERE id_user=? AND id=?;', $data);

		return $result[0]->result;
	}

	/* Manage a Poll in Database
	*  
	* @param (array) with
	* (int) user identifier
	* (int) poll identifier
	* (str) title
	* (str) question
	* (str) image_server_name
	* (array) answers
	*		(str) answer n
	* @ return (int) poll_id
	*/
	function updatePoll($params) {
		$data = array();
		$pdo = new myPDO();
		$data[] = new myPDOparam($params['title'], PDO::PARAM_STR);
		$data[] = new myPDOparam($params['question'], PDO::PARAM_STR);
		$data[] = new myPDOparam($params['image'], PDO::PARAM_STR);
		$data[] = new myPDOparam($params['poll_id'], PDO::PARAM_INT);
		$result = $pdo->query('UPDATE poll SET title=?, question=?, image=? WHERE id=?;', $data);


		$answers_id = $this->getPollAnswers(array($params['poll_id']));
		# GET ARRAY OF ID'S
		foreach($answers_id as &$elem)
			$elem = $elem->id;

		$new_answers_id = array();

		foreach($params['answers'] as $answer)
			$new_answers_id[] = $this->insertPollAnswer(array($params['poll_id'], $answer));


		# REMOVE ANSWERS THAT ARE NOT IN NEW ARRAY
		$remove = array_diff($answers_id, $new_answers_id);
		foreach($remove as $remove_id) {
			$this->removePollAnswer(array($remove_id));
		}

		return 1;
	}

	/*
	* @param (array) with
	* (text) filter for title - '' for all
	* @return array(objects) objects are polls
	*/
	function getPolls($params = array(0=>'')) {
		$pdo = new myPDO();
		$data[] = new myPDOparam("%$params[0]%", PDO::PARAM_STR);
		$result = $pdo->query('SELECT * FROM poll WHERE title LIKE ? AND isPublic=1 ORDER BY id DESC;', $data);
		return $result;
	}

	/*
	* @param (array) with
	* (int) user_identifier
	* @return array(objects) objects are polls
	*/
	function getPollsUser($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('SELECT * FROM poll WHERE id_user=?;', $data);
		return $result;
	}

	/*
	* @param (array) with
	* (int) poll identifier
	* (int) user identifier
	* @return (object) poll
	*/
	function getPoll($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params['poll'], PDO::PARAM_INT);
		$result = $pdo->query('SELECT * FROM poll WHERE id = ? AND isPublic=1;', $data);
		$result = $result[0];
		if(!empty($result)) {
			$result->answers = $this->getPollAnswers($params);
			$result->userAnswer = $this->userAnswerPoll($params);
		}
		return $result;
	}

	/** GETS THE user_answer id for update
	* @param (array) with
	* (int) poll identifier
	* (int) user identifier
	* @return (object) answer_id
	*/
	function userAnswerPoll($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params['poll'], PDO::PARAM_INT);
		$data[] = new myPDOparam($params['user'], PDO::PARAM_INT);
		$result = $pdo->query('SELECT user_answer.id_answer as result FROM user_answer, poll_answer WHERE id_poll = ? AND user_answer.id_user= ? AND poll_answer.id=user_answer.id_answer;', $data);
		
		if(isset($result[0]->result))
			$result = $result[0]->result;
		else
			$result = 0;

		return $result;
	}

	/** INSERT ANSWER IN THE POLL
	*  
	* @param (array) with
	* (int) poll - poll identifier
	* (int) answer - answer_id
	* (int) user - user id
	* @ return (int) answer_id
	*/
	function addUserAnswer($params) {
		
		if($this->answerInPoll($params)) {

			$pdo = new myPDO();
			
			$poll = $this->userAnsweredPoll($params);
			if($poll == 0) {

				if($params['user'] == '')
					$data[] = new myPDOparam($params['user'], PDO::PARAM_NULL);
				else
					$data[] = new myPDOparam($params['user'], PDO::PARAM_INT);

				$data[] = new myPDOparam($params['answer'], PDO::PARAM_INT);

				$result = $pdo->query('INSERT INTO user_answer(id_user, id_answer) VALUES(?, ?)', $data);
			}
			else {
				$data[] = new myPDOparam($params['answer'], PDO::PARAM_INT);
				$data[] = new myPDOparam($poll, PDO::PARAM_INT);

				$result = $pdo->query('UPDATE user_answer SET id_answer=? WHERE id=?', $data);
			}

			return $result;
		} else {
			return -1;
		}
	}

	/** GETS THE user_answer id for update
	* @param (array) with
	* (int) poll identifier
	* (int) user identifier
	* @return (object) answer_id
	*/
	private function userAnsweredPoll($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params['poll'], PDO::PARAM_INT);
		$data[] = new myPDOparam($params['user'], PDO::PARAM_INT);
		$result = $pdo->query('SELECT user_answer.id as result FROM user_answer, poll_answer WHERE id_poll = ? AND user_answer.id_user= ? AND poll_answer.id=user_answer.id_answer;', $data);
		
		if(isset($result[0]->result))
			$result = $result[0]->result;
		else
			$result = 0;

		return $result;
	}

	/** INSERT POLL ANSWER IF ALREADY EXISTS RETURNS THE ID
	*  
	* @param (array) with
	* (int) poll identifier
	* (str) answer n
	* @ return (int) answer_id
	*/
	private function insertPollAnswer($params) {
		$pdo = new myPDO();
		$data = array();
		# Poll ID
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		# Answer
		$data[] = new myPDOparam($params[1], PDO::PARAM_STR);

		if(!$this->existPollAnswer($params)) {

			$result = $pdo->query('INSERT INTO poll_answer (id_poll, answer) VALUES(?, ?);', $data);
			return $pdo->last_insert_id();

		} else {

			$result = $pdo->query('SELECT id FROM poll_answer WHERE id_poll=? AND answer=?;', $data);
			return $result[0]->id;

		}
	}

	/* Delete poll answer
	*  
	* @param (array) with
	* (str) answer identifier
	* @ return (boolean) 
	*/
	private function removePollAnswer($params) {
		$pdo = new myPDO();
		$data = array();
		# Answer ID
		$data[] = new myPDOparam($params[0], PDO::PARAM_INT);
		$result = $pdo->query('DELETE FROM poll_answer WHERE id=?;', $data);
		return $result==1;
	}

	/*
	* @param (array) with
	* (int) poll_identifier
	* @return array(objects) objects are answers
	*/
	private function getPollAnswers($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params['poll'], PDO::PARAM_INT);
		$result = $pdo->query('SELECT id, answer FROM poll_answer WHERE id_poll=?;', $data);
		return $result;
	}

	/*
	* @param (array) with
	* (int) poll_identifier
	* (int) answer_identifier
	* @return array(objects) objects are answers
	*/
	private function answerInPoll($params) {
		$pdo = new myPDO();
		$data[] = new myPDOparam($params['poll'], PDO::PARAM_INT);
		$data[] = new myPDOparam($params['answer'], PDO::PARAM_INT);
		$result = $pdo->query('SELECT COUNT(*) as number_answer FROM poll_answer WHERE id_poll=? AND id=?;', $data);
		
		return ($result[0]->number_answer)>0;
	}

}
?>