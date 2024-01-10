<?php /* Model voor de projecten database */


class assetsModel extends database{
	public $schema = 'asset';

	public function getAssetsForProject(int $project_id){
		$query = $this->connection->prepare('SELECT * FROM `'.$this->schema.'` where `project_id` = ? ORDER BY `position`;');
		$query->bind_param('i', $project_id);

		$query->execute();

		$result = $query->get_result();
		
		$data = [];
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}

		return $data;
	}
}