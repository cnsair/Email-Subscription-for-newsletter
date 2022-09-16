<?php 

//class for db connection
//error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class DB
{
	// //OFFLINE
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "db_name";

	public $conn = null;

	//connect to database
	public function getConn()
	{
		try
		{
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password, array(PDO::ATTR_PERSISTENT => false));

			// set the PDO error mode to exception
			//$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $errMsg)
		{
			echo "Connection error: " . $errMsg->getMessage();
		}

		return $this->conn;
	}

}




?>