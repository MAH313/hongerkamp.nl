<?php

class Gebruikers extends Controller{
	protected $require_login = true;

	public function init($parameters){
		parent::init($parameters);

		$this->userModel = new userModel();

		$this->smarty->assign('active_nav', 'gebruikers');
	}

	public function index(){
	    // home page

		$users = $this->userModel->getAll();

		$this->smarty->assign('users', $users);
		$this->smarty->display('templates/admin/gebruikers/index.tpl');
	}

	public function edit(){

		$user = false;
		if(isset($this->parameters['id']) && $this->parameters['id'] > 0){
			$user = $this->userModel->getById($this->parameters['id']);
		}

		if($this->is_post){
			if(!$user){
				$this->auth->createUser($_POST['username'], $_POST['email'], $_POST['password']);
			}
			else{
				$this->auth->updateUser($user['id'], $_POST['username'], $_POST['email'], $_POST['password']);
			}

			header("Location: /admin/gebruikers");
			exit;
		}

		$this->smarty->assign('user', $user);
		$this->smarty->display('templates/admin/gebruikers/edit.tpl');
	}

	public function delete(){

		$user = false;
		if(isset($this->parameters['id']) && $this->parameters['id'] > 0){
			$user = $this->userModel->getById($this->parameters['id']);
		}

		
		if($user){
			$this->userModel->delete($user['id']);
		}

		header("Location: /admin/gebruikers");
		exit;
	}

}
