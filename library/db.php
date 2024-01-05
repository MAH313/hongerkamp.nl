<?php #basic database functions to be used in models

class database{
    //database class

	public $schema;
	protected $connection;

	public $include_created_modified = true;

	function __construct(){
		$this->connection = $this->connect();
		$this->user = ['id' => 1];
	}

	function __destruct(){
		$this->connection->close();
	}

	protected function connect(){
      	//open a database connection

	    $settings = parse_ini_file('config.ini');

      	// Create connection
		$conn = new mysqli($settings['database']['host'], $settings['database']['username'], $settings['database']['password']);

      	// Check connection
		if ($conn->connect_error) {
			return $conn->connect_error;
		}

		$conn->select_db($settings['database']['database']);

		return $conn;
	}

	public function getById(int $id){
		$query = $this->connection->prepare('SELECT * FROM `'.$this->schema.'` WHERE `id` = ?;');
		$query->bind_param('i', $id);

		$query->execute();

		$result = $query->get_result();
		
		if($result->num_rows > 0){
			return $result->fetch_assoc();
		}
		else{
			return false;
		}
	}


	public function add($values){
		if($this->include_created_modified){
			$values['created'] = date('Y-m-d H:i:s');
			$values['created_by'] = $this->user['id'];
		}

		$assignments = $this->_getAssignmentList($values);

		try{
			$query = $this->connection->prepare('INSERT INTO `'.$this->schema.'` SET '.$assignments['set'].';');
			$query->bind_param($assignments['types'], ...$assignments['values']);
		}
		catch (error $e){
			$this->connection->close();
			die('Error: You have probably an error in your sql syntax; '.$e->getMessage());
		}

		$query->execute();

		return $query->insert_id;
	}

	public function update($id, $values){
		if($this->include_created_modified){
			$values['modified'] = date('Y-m-d H:i:s');
			$values['modified_by'] = $this->user['id'];
		}

		$assignments = $this->_getAssignmentList($values);

		$assignments['types'] .= 'i';
		$assignments['values'][] = $id;

		try{
			$query = $this->connection->prepare('UPDATE `'.$this->schema.'` SET '.$assignments['set'].' WHERE `ID` = ?;');
			$query->bind_param($assignments['types'], ...$assignments['values']);
		}
		catch (error $e){
			$this->connection->close();
			die('Error: You have probably an error in your sql syntax; '.$e->getMessage());
		}

		$query->execute();

		return $id;
	}

	public function delete($id){
		try{
			$query = $this->connection->prepare('DELETE FROM `'.$this->schema.'` WHERE `id` = ?;');
			$query->bind_param('i', $id);
		}
		catch (error $e){
			$this->connection->close();
			die('Error: You have probably an error in your sql syntax; '.$e->getMessage());
		}

		$query->execute();

		return true;
	}

	protected function _getAssignmentList($values){
		$types = [];
		$set = [];

		foreach($values as $key => $value){
			if(!is_numeric($key) && !empty($key)){
				$set[] = '`'.$key.'`=?';

				switch (gettype($value)) {
					case 'integer':
						$types[] = 'i';
						break;

					case 'double': // double = float
						$types[] = 'd';
						break;
					
					default:
						$types[] = 's';
						break;
				}
			}		
		}

		return [
			'set' => implode(',', $set),
			'types' => implode('', $types),
			'values' => array_values($values),
		];
	}
}
