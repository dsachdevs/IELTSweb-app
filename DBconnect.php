<?php
/**
 * 
 */
class DBconnect
{
	private static $instance = null;
	private $conn;
	private $host='localhost';
	private $dbname = 'project';
	private $user = 'root';
	private $pass = '';

	// private $dsn = "mysql:host=$host;dbname=$dbname";

	
	private function __construct()
	{
		# code...
		$this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->dbname}", $this->user,$this->pass);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	public static function getInstance()
	{
		if(!self::$instance)
		{
		  self::$instance = new DBconnect();
		}

		return self::$instance;
	}

	public function getConnection()
	{
		return $this->conn;
	}
}