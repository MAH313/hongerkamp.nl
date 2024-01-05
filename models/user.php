<?php /* Model voor de user database */

class userModel extends database{
	public $schema = 'user';

	public function getByEmail(string $email){
		$query = $this->connection->prepare('SELECT * FROM `'.$this->schema.'` where `email` = ?;');
		$query->bind_param('s', $email);

		$query->execute();

		$result = $query->get_result();
		
		if($result->num_rows > 0){
			return $result->fetch_assoc();
		}
		else{
			return false;
		}
	}

	public function getAll($fronted = false){
		$query = $this->connection->prepare('SELECT * FROM `'.$this->schema.'`');

		$query->execute();
		$result = $query->get_result();

		$data = [];
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}

		return $data;
	}
}