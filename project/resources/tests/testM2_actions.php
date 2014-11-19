<?php
require_once(VIEWS_PATH.'/user.php');

class testM2_actions extends UnitTestCase {
	private $poll;

	function test_newPoll() {
	    $_POST['title'] = 'Poll 1';
	    $_POST['question'] = 'What?';
	    $_POST['image'] = 'myImage';
	    $_POST['answer1'] = 'a1';
	    $_POST['answer2'] = 'a2';
	    $_POST['answer3'] = 'a3';
	    $this->poll = newPoll();
	    $poll = $this->poll;
	    $this->assertOutsideMargin($poll, -10, 0);
	}

	/*function test_cleanDB() {
		require_once(LIB_PATH.'/mypdo.php');
		$pdo = new myPDO();
		$data = array(new myPDOparam($this->poll, PDO::PARAM_INT));
		$pdo->query('DELETE FROM poll WHERE id=?;', $data);
		$pdo->query('DELETE FROM poll_answer WHERE id_poll=?;', $data);
		$this->assertTrue(true);
	}*/
}
?>