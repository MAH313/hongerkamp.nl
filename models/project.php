<?php /* Model voor de projecten database */

include_once 'library/db.php';

class projectModel extends database{
	public $schema = 'project';

	public function getAll($fronted = false){
		$query = $this->connection->prepare('SELECT * FROM `'.$this->schema.'`'.($fronted ? ' WHERE `is_visible` = 1' : ''));

		$query->execute();
		$result = $query->get_result();

		$data = [];
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}

		return $data;
	}

	public function saveProject($id=null, $values){

		$user = 1;

		if(!$id){
			return $this->add($values);
		}
		else{

			return $this->update($id, $values);
		}
	}
}