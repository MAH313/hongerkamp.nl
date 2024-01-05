<?php /* Model voor de user database */

class sessionModel extends database{
	public $schema = 'session';
	public $include_created_modified = false;

	public function getByKey(string $key){
		$query = $this->connection->prepare('SELECT * FROM `'.$this->schema.'` where `key` = ?;');
		$query->bind_param('s', $key);

		$query->execute();

		$result = $query->get_result();
		
		if($result->num_rows > 0){
			return $result->fetch_assoc();
		}
		else{
			return false;
		}
	}

	public function getSessionWithUser(string $key){
		$query = $this->connection->prepare('SELECT `user`.`id` AS `user_id`, `user`.`username` AS `username`, `user`.`email` AS `email`, `session`.`key` AS `session_key`, `session`.`expire` as `expire`  FROM `session` LEFT JOIN `user` ON session.user = user.ID where `key` = ?;');
		$query->bind_param('s', $key);

		$query->execute();

		$result = $query->get_result();
		
		$session_with_user = false;
		if($result->num_rows > 0){
			$session_with_user = $result->fetch_assoc();
		}

		if(!empty($session_with_user) && $session_with_user['user_id'] > 0){
			return $session_with_user;
		}
		else{
			return false;
		}
	}

	public function clearExpiredSessions(){
		$date = new Datetime();
		$date = date_format($date, 'Y-m-d H:i:s');

		$query = $this->connection->prepare('DELETE FROM `session` WHERE `expire` <= ?;');
		$query->bind_param('s', $date);
		$query->execute();

		return true;
	}

}