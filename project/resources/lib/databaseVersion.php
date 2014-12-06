<?php
require_once(LIB_PATH.'/mypdo.php');

class databaseVersion {
	private $dbVersion;
	private $dummy_data;
	private $path;

	function __construct($path) {
		$this->dbVersion = 8;
		$this->dummy_data = false;

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
		try {
			# delete all images from upload
			require_once(MODELS_PATH.'/poll.php');
			global $_user;
			$poll = new mPoll();
			$polls = $poll->getPolls();
			foreach ($polls as $poll_) {
				$poll->deletePollImage($poll_->image);
				$_user->destroyAnswerCookie(array('poll'=>$poll_->id));
			}
		} catch(Exception $e) {

		}

		// DELETE DB
		if(file_exists($this->path)) {
			if(unlink($this->path) == false) {
				echo 'Database in use please close it';
				exit;
			}
		}else {
			@touch($this->path);
		}

		// CREATE TABLES
		$this->tableVersion();
		$this->tableUser();
		$this->tablePoll();
		$this->tablePollAnswer();
		$this->tableUserAnswer();

		if($this->dummy_data)
			$this->dummyData();
		else
			$this->presentationData();
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
		# Images for dummy polls
		copy('http://dummyimage.com/600x400/000/fff&text=Poll+1', UPLOAD_PATH.'/5478b2ab7362c_test0.png');
		copy('http://dummyimage.com/600x400/000/fff&text=Poll+2', UPLOAD_PATH.'/5478b2ab7362c_test1.png');
		copy('http://dummyimage.com/600x400/000/fff&text=Poll+3', UPLOAD_PATH.'/5478b2ab7362c_test2.png');
		$pdo->query("INSERT INTO poll VALUES (1, 1, 'MyTi', 'asdads', '5478b2ab7362c_test0.png', 1, 0, '2014-12-01 15:30:30');");
		$pdo->query("INSERT INTO poll VALUES (2, 1, '%My%', 'aeeee', '5478b2ab7362c_test1.png', 1, 0, '2014-12-01 17:30:30');");
		$pdo->query("INSERT INTO poll VALUES (3, 2, 'BLA', 'asdjand', '5478b2ab7362c_test2.png', 1, 0, '2014-12-01 18:30:30');");

		#ANSWERS
		$pdo->query("INSERT INTO poll_answer VALUES (1, 1, 'A1')");
		$pdo->query("INSERT INTO poll_answer VALUES (2, 2, 'A2')");
		$pdo->query("INSERT INTO poll_answer VALUES (3, 2, 'A1')");
		$pdo->query("INSERT INTO poll_answer VALUES (4, 3, 'A1')");
		$pdo->query("INSERT INTO poll_answer VALUES (5, 3, 'A2')");
		$pdo->query("INSERT INTO poll_answer VALUES (6, 3, 'A3')");
	}

	private function presentationData() {
		$pdo = new myPDO();

		#USERS
		$pdo->query("INSERT INTO user VALUES (1, 'andre', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-11-27 04:12:02', null);");
		$pdo->query("INSERT INTO user VALUES (2, 'tiago', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-11-27 04:12:02', null);");
		$pdo->query("INSERT INTO user VALUES (3, 'pedro', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-11-28 13:12:02', null);");
		$pdo->query("INSERT INTO user VALUES (4, 'maria', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-11-29 20:16:08', null);");
		$pdo->query("INSERT INTO user VALUES (5, 'joana', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-12-01 01:56:02', null);");
		$pdo->query("INSERT INTO user VALUES (6, 'paulo', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2014-12-02 22:12:02', null);");

		#POLL
		copy(IMG_PATH.'/OS.gif', UPLOAD_PATH.'/OS.gif');
		copy(IMG_PATH.'/colors.jpg', UPLOAD_PATH.'/colors.jpg');
		copy(IMG_PATH.'/fedVSdjo.jpg', UPLOAD_PATH.'/fedVSdjo.jpg');
		copy(IMG_PATH.'/laptop.jpg', UPLOAD_PATH.'/laptop.jpg');
		copy(IMG_PATH.'/social.jpg', UPLOAD_PATH.'/social.jpg');
		copy(IMG_PATH.'/hobbit.png', UPLOAD_PATH.'/hobbit.png');
		copy(IMG_PATH.'/food.jpg', UPLOAD_PATH.'/food.jpg');
		$pdo->query("INSERT INTO poll VALUES (1, 1, 'Operating Systems (OS)', 'What is your favorite OS?', 'OS.gif', 1, 0, '2014-12-01 15:30:30')");
		$pdo->query("INSERT INTO poll VALUES (2, 1, 'Colors', 'What is your favorite color?', 'colors.jpg', 1, 0, '2014-12-01 17:30:30')");
		$pdo->query("INSERT INTO poll VALUES (3, 1, 'US Open', 'Who do will be the winner of US Open?', 'fedVSdjo.jpg', 1, 0, '2014-11-23 17:30:30')");
		$pdo->query("INSERT INTO poll VALUES (4, 2, 'Programming Languages', 'Which programming language do you prefer?', '', 0, 0, '2014-11-07 10:00:30')");
		$pdo->query("INSERT INTO poll VALUES (5, 2, 'Laptop brands', 'Which brand have less problems with heat?', 'laptop.jpg', 1, 0, '2014-12-02 05:50:30')");
		$pdo->query("INSERT INTO poll VALUES (6, 3, 'Social Networks', 'What social network do you use more?', 'social.jpg', 1, 0, '2014-10-17 9:36:08')");
		$pdo->query("INSERT INTO poll VALUES (7, 4, 'MIEIC classes', 'What is your favorite class?', '', 0, 0, '2014-12-03 06:12:50')");
		$pdo->query("INSERT INTO poll VALUES (8, 5, 'Movies', 'What movie will win the next best movie oscar?', 'hobbit.png', 1, 0, '2014-12-01 07:30:30')");
		$pdo->query("INSERT INTO poll VALUES (9, 5, 'Music', 'What is your favorite music genre?', '', 0, 0, '2014-10-08 16:02:22')");
		$pdo->query("INSERT INTO poll VALUES (10, 1, 'Playing Games', 'Are you a gamer?', '', 1, 0, '2014-10-14 18:54:30')");
		$pdo->query("INSERT INTO poll VALUES (11, 1, 'Food', 'What kind of food do you prefer?', 'food.jpg', 0, 0, '2014-12-03 11:05:30')");
		$pdo->query("INSERT INTO poll VALUES (12, 1, 'Medium Wage', 'Between which values is your mensal wage?', '', 0, 0, '2014-12-04 03:54:48')");

		#ANSWERS
		$pdo->query("INSERT INTO poll_answer VALUES (1, 1, 'Windows')");
		$pdo->query("INSERT INTO poll_answer VALUES (2, 1, 'MacOS')");
		$pdo->query("INSERT INTO poll_answer VALUES (3, 1, 'Linux')");
		$pdo->query("INSERT INTO poll_answer VALUES (4, 2, 'Red')");
		$pdo->query("INSERT INTO poll_answer VALUES (5, 2, 'Blue')");
		$pdo->query("INSERT INTO poll_answer VALUES (6, 2, 'Green')");
		$pdo->query("INSERT INTO poll_answer VALUES (7, 2, 'Black')");
		$pdo->query("INSERT INTO poll_answer VALUES (8, 3, 'Roger Federer')");
		$pdo->query("INSERT INTO poll_answer VALUES (9, 3, 'Novak Djokovic')");
		$pdo->query("INSERT INTO poll_answer VALUES (10, 4, 'C/C++')");
		$pdo->query("INSERT INTO poll_answer VALUES (11, 4, 'Java')");
		$pdo->query("INSERT INTO poll_answer VALUES (12, 4, 'Ruby on Rails')");
		$pdo->query("INSERT INTO poll_answer VALUES (13, 4, 'Lisp')");
		$pdo->query("INSERT INTO poll_answer VALUES (14, 4, 'PHP')");
		$pdo->query("INSERT INTO poll_answer VALUES (15, 5, 'HP')");
		$pdo->query("INSERT INTO poll_answer VALUES (16, 5, 'Acer')");
		$pdo->query("INSERT INTO poll_answer VALUES (17, 5, 'Asus')");
		$pdo->query("INSERT INTO poll_answer VALUES (18, 5, 'Lenovo')");
		$pdo->query("INSERT INTO poll_answer VALUES (19, 6, 'Facebook')");
		$pdo->query("INSERT INTO poll_answer VALUES (20, 6, 'Google+')");
		$pdo->query("INSERT INTO poll_answer VALUES (21, 6, 'Twitter')");
		$pdo->query("INSERT INTO poll_answer VALUES (22, 6, 'Linkedin')");
		$pdo->query("INSERT INTO poll_answer VALUES (23, 7, 'LTW')");
		$pdo->query("INSERT INTO poll_answer VALUES (24, 7, 'LAIG')");
		$pdo->query("INSERT INTO poll_answer VALUES (25, 7, 'PLOG')");
		$pdo->query("INSERT INTO poll_answer VALUES (26, 7, 'RCOM')");
		$pdo->query("INSERT INTO poll_answer VALUES (27, 7, 'IART')");
		$pdo->query("INSERT INTO poll_answer VALUES (28, 8, 'The Hobbit: The battle of the five armies')");
		$pdo->query("INSERT INTO poll_answer VALUES (29, 8, 'Hunger Games Mockingjay')");
		$pdo->query("INSERT INTO poll_answer VALUES (30, 8, 'X-Men: Days of the future past')");
		$pdo->query("INSERT INTO poll_answer VALUES (31, 9, 'Rock')");
		$pdo->query("INSERT INTO poll_answer VALUES (32, 9, 'Pop')");
		$pdo->query("INSERT INTO poll_answer VALUES (33, 9, 'Folk')");
		$pdo->query("INSERT INTO poll_answer VALUES (34, 9, 'R&B')");
		$pdo->query("INSERT INTO poll_answer VALUES (35, 9, 'House')");
		$pdo->query("INSERT INTO poll_answer VALUES (36, 10, 'Yes')");
		$pdo->query("INSERT INTO poll_answer VALUES (37, 10, 'No')");
		$pdo->query("INSERT INTO poll_answer VALUES (38, 11, 'Mediterranean')");
		$pdo->query("INSERT INTO poll_answer VALUES (39, 11, 'Italian')");
		$pdo->query("INSERT INTO poll_answer VALUES (40, 11, 'Japanese')");
		$pdo->query("INSERT INTO poll_answer VALUES (41, 11, 'Indian')");
		$pdo->query("INSERT INTO poll_answer VALUES (42, 12, '<400€')");
		$pdo->query("INSERT INTO poll_answer VALUES (43, 12, 'Between 401 and 600€')");
		$pdo->query("INSERT INTO poll_answer VALUES (44, 12, 'Between 601 and 900€')");
		$pdo->query("INSERT INTO poll_answer VALUES (45, 12, 'Between 901 and 1200€')");
		$pdo->query("INSERT INTO poll_answer VALUES (46, 12, '>1201€')");

		GO();
	}
}
?>