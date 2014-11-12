<?php 
interface imyPDO {
	# RECEIVES THE DATABASE CONNECTION IDENTIFIER
	public function __construct($database_identifier);

	# EXECUTES A QUERY AND RETURNS THE VALUE AS ARRAY OF OBJECTS
	# ARGS IS AN ARRAY OF myPDOparam's
	# QUERY EXAMPLE SELECT * FROM table WHERE id=? AND name like ?;
	public function query($query, $args);
}

interface imyPDOparam {
	# Receives the value and the type of param
	# Used when binding values to stmt
	# $type is PDO CONSTANTS http://php.net/manual/en/pdo.constants.php
	public function __construct($value, $type);
}

class myPDO extends PDO implements imyPDO
{
	private $db;
	private $query;
	private $stmt;

	// Passing by default db1
	function __construct($database_identifier = 'db1') {
		global $config;
		// Test if connection is sent
		$this->db = new PDO('sqlite:'.$config['db'][$database_identifier]);
		if($this->db === null)
			throw new Exception('Error opening database');
	}

	function query($query, $args=array()) {
		// REMOVES WHITE SPACES AT THE BEGINNING AND END
		$this->query = trim($query);

		if(empty($args)) {
			$this->stmt = $this->db->query($this->query);
			if($this->stmt === false)
				throw new Exception('Error executing query');
		} else {
			$this->prep($args);
		}

		return $this->fetch();
	}

	function prep($args) {
		$this->stmt = $this->db->prepare($this->query);
		$this->bind($args);
		$this->execQuery();
	}

	function bind($args) {

		if($this->stmt !== false) {
			$i = 1;
			foreach($args as $arg) {
				$this->stmt->bindValue($i, $arg->value, $arg->type);
				$i++;
			}
		} else
			throw 'Error binding parameters';
	}

	function execQuery() {
		try {
			$this->stmt->execute();
		} catch(PDOException $e) {
			throw $e;			
		}
	}

	function fetch() {
		if (preg_match('/^(select|describe|pragma|call)/i', $this->query)) {
			# SELECTING ROWS
			return $this->stmt->fetchAll(PDO::FETCH_CLASS);
		} else if (preg_match('/^(delete|insert|update)/i', $this->query)) {
			# AFFECTED ROWS
			return $this->stmt->rowCount();
		}
	}
}

class myPDOparam implements imyPDOparam
{
	public $value;
	public $type;
	
	# NEW PARAM
	function __construct($value, $type)
	{
		$this->value = $value;
		$this->type = $type;
	}

	# DEBUG QUERY ARGUMENTS
	static function debug_args($args) {
		$debug = '';
		$i = 0;
		foreach($args as $arg) {
			if($i > 0)
				$debug.=', ';

			if($arg->type == PDO::PARAM_STR)
				$debug.="'".$arg->value."'";
			else
				$debug.=$arg->value;

			$i++;
		}

		return $debug;
	}
}
?>