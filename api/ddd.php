<?php
header('Content-Type: Application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
include("config.php");

class TTT
{

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		try {
			$this->connect = new PDO("mysql:host=".HOST.";dbname=".DB,USR, PWD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

		} catch(PDOException $e) {
			echo "<center><h1>Connection failed</h1><p>Please check Connection Config</p></center>";
			exit;
		}
	}

	function systemName()
	{
		$query = "SELECT * FROM setting WHERE param='system' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				return $data;
			}
		}
	}

}

$ttt = new TTT();

$data = $ttt->systemName();
echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>