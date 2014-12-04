<?php
require_once(LIB_PATH.'/mypdo.php');
class databaseVersion {
	private $dbVersion;
	private $dummy_data;
	private $path;

	function __construct($path) {
		$this->dbVersion = 7;
		$this->dummy_data = true;

		$this->path = $path;
		$this->checkDBVersion();
	}

	private function checkDBVersion() {
		try {
			$pdo = new myPDO();
			$data[] = new myPDOparam($this->dbVersion, PDO::PARAM_INT);
			
			$result = $pdo->query('SELECT COUNT(*) as number_versions FROM dbVersion WHERE version=?;', $data);
			$result = $result[0];
			if($result->number_versions == 0) {
				unset($pdo);
				$this->createDB();
			}
		} catch(Exception $e) {
			## No tables dbVersion
			unset($pdo);
			$this->createDB();
		}
	}

	private function createDB() {
		// DELETE DB
		if(file_exists($this->path)) {
			if(unlink($this->path) == false) {
				echo 'Database in use please close it';
				exit;
			}
		}else {
			touch($this->path);
		}

		// CREATE TABLES
		$this->tableVersion();
		$this->tableUser();
		$this->tablePoll();
		$this->tablePollAnswer();
		$this->tableUserAnswer();

		if($this->dummy_data)
			$this->dummyData();
	}

	private function tableVersion() {
		$pdo = new myPDO();

		$sql ='
		CREATE TABLE dbVersion (
			version  INTEGER NOT NULL
		)';

		$pdo->query($sql);

		$data[] = new myPDOparam($this->dbVersion, PDO::PARAM_INT);
		$pdo->query("INSERT INTO dbVersion VALUES (?);", $data);
	}

	private function tableUser() {
		$pdo = new myPDO();

		$sql ='
		CREATE TABLE user (
			id  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			username  TEXT(50) NOT NULL UNIQUE,
			password  TEXT(255) NOT NULL,
			createDate  TEXT(19) NOT NULL,
			lastLogin  TEXT(19)
		)';

		$pdo->query($sql);
	}

	private function tablePoll() {
		$pdo = new myPDO();

		$sql ='
		CREATE TABLE poll (
			id  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			id_user  INTEGER NOT NULL,
			title  TEXT(50) NOT NULL,
			question  TEXT(500) NOT NULL,
			image  TEXT(255) NOT NULL,
			isPublic INT NOT NULL,
			isClosed INT DEFAULT 0,
			createDate  TEXT(19)
		);';

		$pdo->query($sql);
	}

	private function tablePollAnswer() {
		$pdo = new myPDO();

		$sql ='
		CREATE TABLE "poll_answer" (
			"id"  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			"id_poll"  INTEGER NOT NULL,
			"answer"  TEXT(100) NOT NULL
		)';

		$pdo->query($sql);
	}

	private function tableUserAnswer() {
		$pdo = new myPDO();

		$sql ='
		CREATE TABLE user_answer (
			id  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			id_user  INTEGER,
			id_answer  INTEGER NOT NULL
		);';

		$pdo->query($sql);
	}

	private function dummyData() {
		$pdo = new myPDO();

		#USERS
		$pdo->query("INSERT INTO user VALUES (1, 'a', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-11-27 04:12:02', null);");
		$pdo->query("INSERT INTO user VALUES (2, 'aa', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-11-27 04:12:02', null);");

		#POLL
		$pdo->query("INSERT INTO poll VALUES (1, 1, 'MyTi', 'asdads', '5478b2ab7362c_test.jpg', 1, 0, '2014-12-01 15:30:30');");
		$pdo->query("INSERT INTO poll VALUES (2, 1, '%My%', 'aeeee', '5478b2ab7362c_test.jpg', 1, 0, '2014-12-01 17:30:30');");
		$pdo->query("INSERT INTO poll VALUES (3, 2, 'BLA', 'asdjand', '5478b2ab7362c_test.jpg', 1, 0, '2014-12-01 18:30:30');");

		#ANSWERS
		$pdo->query("INSERT INTO poll_answer VALUES (1, 1, 'A1')");
		$pdo->query("INSERT INTO poll_answer VALUES (2, 2, 'A2')");
		$pdo->query("INSERT INTO poll_answer VALUES (3, 2, 'A1')");
		$pdo->query("INSERT INTO poll_answer VALUES (4, 3, 'A1')");
		$pdo->query("INSERT INTO poll_answer VALUES (5, 3, 'A2')");
		$pdo->query("INSERT INTO poll_answer VALUES (6, 3, 'A3')");
	}
}
?>