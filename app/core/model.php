<?php

/**
 * main model class
 */
class Model extends Database
{

	protected $table = "";
	protected $allowedColumns = [];

	public function insert($data)
	{

		//remove unwanted columns
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into " . $this->table;
		$query .= " (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";

		$this->query($query, $data);
	}
	public function findAll()
	{
		$query = "select * from " . $this->table;
		//define query to add user data
		$res = $this->query($query);
		if (is_array($res)) {
			return $res;
		}

		return false;
	}

	function join($tables, $columns, $conditions, $order = null, $limit = null)
    {
        // Build the query
        $query = "SELECT " . implode(", ", $columns) . " FROM " . $this->table;

        foreach ($tables as $table) {
            $query .= " JOIN $table";
        }

        // Add conditions
        if (!empty($conditions)) {
            $query .= " ON " . implode(" AND ", $conditions);
        }

        // Add order and limit clauses if provided
        if ($order) {
            $query .= " ORDER BY $order";
        }

        if ($limit) {
            $query .= " LIMIT $limit";
        }

        // Execute the query
       // show($query);
        return $this->query($query);
    }


	public function where($data)
	{

		$keys = array_keys($data);

		$query = "select * from " . $this->table . " where ";

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " && ";
		}

		$query = trim($query, "&& ");
		$res = $this->query($query, $data);

		if (is_array($res)) {
			return $res;
		}

		return false;
	}

	public function first($data)
	{

		$keys = array_keys($data);

		$query = "select * from " . $this->table . " where ";

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " && ";
		}

		$query = trim($query, "&& ");
		$query .= " order by user_id desc limit 1";

		// show($query);

		$res = $this->query($query, $data);

		if (is_array($res)) {
			return $res[0];
		}

		return false;
	}

	// public function first($data)
	// {
	// 	$keys = array_keys($data);

	// 	// Ensure that 'user_id' is a valid column in table
	// 	$primaryKey = in_array('user_id', $keys) ? 'user_id' : 'id';

	// 	$query = "SELECT * FROM " . $this->table . " WHERE ";

	// 	foreach ($keys as $key) {
	// 		$query .= $key . "=:" . $key . " AND ";
	// 	}

	// 	$query = rtrim($query, " AND ");
	// 	$query .= " ORDER BY $primaryKey DESC LIMIT 1";

	// 	// show($query);

	// 	$res = $this->query($query, $data);

	// 	if (is_array($res)) {
	// 		return $res[0];
	// 	}

	// 	return false;
	// }


	// ....update function
	// public function update($id, $data){
    //     //remove unwanted columns
    //     if(!empty($this->allowedColumns))
    //     {
    //         foreach ($data as $key => $value){
    //             if(!in_array($key, $this->allowedColumns)){
    //                 unset($data[$key]);
    //             }
    //         }
    //     }

    //     $keys = array_keys($data);

    //     $query = "update " . $this->table. " set ";

    //     foreach($keys as $key){
    //         $query .= $key ."=:" .$key .",";
    //     }

    //     $query = trim($query, ",");
    //     $query .= " where id = :id ";

    //     $data['id'] = $id;
    //     $this->query($query, $data);

    // }

}
