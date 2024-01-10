<?php

class Auth{
	//authoriztie class
	private $session_cookie_name = 'session';
	private $session_lifetime = 86400; // 1 dag

	private $active_user, $userModel, $sessionModel;

	function __construct(){
		$this->userModel = new userModel();
		$this->sessionModel = new sessionModel();
	}

	function createSession($email, $password){
	  //checks for a valid login and creates a session
		$this->removeExpiredSessions();

		if($this->getLoggedIn()){
			throw new Exception('A login is already present');
		}
		
		$user = $this->userModel->getByEmail($email);

		if(!$user || !password_verify($password, $user['password'])){
			return false;
		}

		$uuid = uniqid();
		$date = new Datetime();
		date_timestamp_set($date, time() + $this->session_lifetime);

		setcookie($this->session_cookie_name, $uuid, time() + $this->session_lifetime);

		$date = date_format($date, 'Y-m-d H:i:s');

		$this->sessionModel->add([
			'user' => $user['id'],
			'key' => $uuid,
			'expire' => $date,
		]);

		return true;
	}

	function removeSession(){
	  	//removes the active session
		if(!$this->getLoggedIn()){
			throw new Exception('No login present');
		}

		$key = $_COOKIE[$this->session_cookie_name];

		$session = $this->sessionModel->getByKey($key);

		$this->sessionModel->delete($session['id']);

		setcookie($this->session_cookie_name, "", time()-3600);

		return true;
	}

	function removeExpiredSessions(){
	  //removes all expired sessions

		$this->sessionModel->clearExpiredSessions();

		return true;
	}

	function getLoggedIn($force_update = false){
	  	//check for an active session

	  	if(!isset($this->active_user) || $force_update){
			$this->removeExpiredSessions();

			
			$session_key = false;
			if(isset($_COOKIE[$this->session_cookie_name])){				
				$session_key = $_COOKIE[$this->session_cookie_name];
			}

			if(empty($session_key)){
				return false;
			}
			
			$this->active_user = $this->sessionModel->getSessionWithUser($session_key);
		}

		return $this->active_user;
	}

	function createUser($username, $email, $password){
	 	//create a new user account
		$password = password_hash($password, PASSWORD_DEFAULT);

		$new_user_id = $this->userModel->add([
			'username' => $username,
			'email' => $email,
			'password' => $password,
		]);

		return $new_user_id;
	}

	function updateUser($userID, $username=false, $email=false, $password=false){
		//update user
		$changes = [];

		if(!empty($username)){
			$changes['username'] = $username;
		}

		if(!empty($email)){
			$changes['email'] = $email;
		}

		if(!empty($password)){
			$password = password_hash($password, PASSWORD_DEFAULT);

			$changes['password'] = $password;
		}

		if(!empty($changes)){
			$this->userModel->update($changes);
		}


		return true;
	}
}
