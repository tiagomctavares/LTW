<?php 
interface imyPDO {
	/* Opens the database connection by identifier (defined in config.php)
	* @param (string) database_identifier - the array identifer in config default = db1
	* 			database connection must be saved in global var $config['db'][database_identifier]
	*				array config must be: d1-> sqlite && d2-> mysql
				        'db1' => array(
				            'type'=>'sqlite',
				            'dbname'=>'' // path to db
				            ),
				        'db2' => array(
				            'type'=>'mysql'
				            'dbname' => '',
				            'username' => '',
				            'password' => '',
				            'host' => ''
				        )
	*/
	function __construct($database_identifier);

	/* EXECUTES A QUERY AND RETURNS THE VALUE AS ARRAY OF OBJECTS 
	* @param (string) query - The query to be executed
	* @param (array) args - Array of myPDOparam to be binded to the query
	* @return (array) Array of objects. Each array position represents a database row
	* Example: SELECT * FROM table WHERE id=? AND name like ?;
	*/
	function query($query, $args);
}

interface imyPDOparam {
	/* Used when binding values to stmt
	* @param (mixed) value - value to be binded to query
	* @param (int) type - PDO CONSTANTS http://php.net/manual/en/pdo.constants.php
	*/
	 function __construct($value, $type);
}

class myPDO extends PDO implements imyPDO
{
	private $db;
	private $query;
	private $stmt;

	// Passing by default db1
	function __construct($database_identifier = 'db1') {
		global $config;
		$db_config = $config['db'][$database_identifier];
		

		if($db_config['type']=='sqlite') {
			$this->db = new PDO('sqlite:'.$db_config['dbname']);


		} elseif($db_config['type']=='mysql') {
			try {
				$this->db = new PDO('mysql:host='.$db_config['host'].';dbname='.$db_config['dbname'].';port='.$db_config['port'].';charset=utf8', $db_config['username'], $db_config['password'], 
					array(
						PDO::ATTR_TIMEOUT => "10",
            			PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false,
						PDO::ATTR_EMULATE_PREPARES => false, 
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					)
				);
			} catch(Exception $e) {
				echo $e->getMessage();
				exit;
			}

		} else {
			throw new Exception('Bad Database config');
		}


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