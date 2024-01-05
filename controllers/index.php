<?php

class Index extends Controller{

	public function init($parameters){
		parent::init($parameters);

		$this->projectModel = new projectModel();
	}

	public function index(){
	    // home page

		$projecten = $this->projectModel->getAll($frontend = true);
		
		$this->smarty->assign('projecten', $projecten);
		$this->smarty->display('templates/index.tpl');
	}

	public function project(){
		// projecten detail pagina

		$project = false;
		if(!empty($this->parameters['id']) && $this->parameters['id'] > 0){
			$project = $this->projectModel->getById($this->parameters['id']);
		}

		$this->smarty->assign('project', $project);
		$this->smarty->display('templates/project.tpl');
	}

	public function login(){
		if($this->auth->getLoggedIn()){
			header("Location: /admin/projecten");
		}

		$error = false;
		if($_POST){
			if($this->auth->createSession($_POST['email'], $_POST['password'])){
				header("Location: /admin/projecten");
				exit;
			}
			else{
				$error = true;
			}
		}

		$this->smarty->assign('error', $error);
		$this->smarty->display('templates/login.tpl');
	}

	public function logout(){
		if(!$this->auth->getLoggedIn()){
			header("Location: /");
		}

		$this->auth->removeSession();

		header("Location: /");
	}
}
