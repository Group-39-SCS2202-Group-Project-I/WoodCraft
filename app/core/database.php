<?php 


/**
 * database class
 */
class Database
{
	
	// private function connect()
	// {
	// 	$str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
	// 	return new PDO($str,DBUSER,DBPASS);

	// }

	private function connect()
	{
		try {
			$str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
			$con = new PDO($str, DBUSER, DBPASS);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $con;
		} catch (PDOException $e) {
			die("Database connection failed: " . $e->getMessage());
		}
	}
	

	public function query($query,$data = [],$type = 'object')
	{
		$con = $this->connect();

		$stm = $con->prepare($query);
		if($stm)
		{
			$check = $stm->execute($data);
			if($check)
			{
				if($type == 'object')
				{
					$type = PDO::FETCH_OBJ;
				}else{
					$type = PDO::FETCH_ASSOC;
				}

				$result = $stm->fetchAll($type);

				if(is_array($result) && count($result) > 0)
				{
					return $result;
				}
			}

			if (!$check) {
				show($stm->errorInfo());
			}
		}

		return false;
	}

	public function select($table,$where = null,$data = [],$type = 'object')
	{
		$query = "SELECT * FROM $table";
		if($where != null)
		{
			$query .= " WHERE $where";
		}

		return $this->query($query,$data,$type);
	}

	// $db = new Database;
	// $users = $db->select('users','id = 1');

	// public function create_tables()
	// {
	// 	//users table
	// 	$query = "

	// 		CREATE TABLE IF NOT EXISTS `users` (
	// 		 `id` int(11) NOT NULL AUTO_INCREMENT,
	// 		 `email` varchar(100) NOT NULL,
	// 		 `firstname` varchar(30) NOT NULL,
	// 		 `lastname` varchar(30) NOT NULL,
	// 		 `password` varchar(255) NOT NULL,
	// 		 `role` varchar(20) NOT NULL,
	// 		 `date` date DEFAULT NULL,
	// 		 PRIMARY KEY (`id`),
	// 		 KEY `email` (`email`),
	// 		 KEY `firstname` (`email`),
	// 		 KEY `lastname` (`email`),
	// 		 KEY `date` (`date`)
	// 		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

	// 	";

	// 	$this->query($query);
	// }

	//delete

	public function delete($table,$where = null,$data = [])
	{
		$query = "DELETE FROM $table";
		if($where != null)
		{
			$query .= " WHERE $where";
		}

		return $this->query($query,$data);
	}

	public function lastInsertId()
	{
		$con = $this->connect();
		return $con->lastInsertId();
	}
	

	
}