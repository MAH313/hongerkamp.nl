<?php

class Projecten extends Controller{
	protected $require_login = true;

	public function init($parameters){
		parent::init($parameters);

		$this->projectModel = new projectModel();

		$this->smarty->assign('active_nav', 'projecten');
	}

	public function index(){
	    // home page

		$projects = $this->projectModel->getAll();

		$this->smarty->assign('projects', $projects);
		$this->smarty->display('templates/admin/projecten/index.tpl');
	}

	public function edit(){

		$project = false;
		if(isset($this->parameters['id']) && $this->parameters['id'] > 0){
			$project = $this->projectModel->getById($this->parameters['id']);
		}

		if($_POST && !empty($_POST)){
			$id = $this->projectModel->saveProject($project ? $project['id'] : null, $_POST);

			if(!$project){
				header("Location: /admin/projecten/edit/id/".$id);
				exit;
			}
			else{
				$project = $this->projectModel->getById($this->parameters['id']);
			}
		}


		$this->smarty->assign('project', $project);
		$this->smarty->display('templates/admin/projecten/edit.tpl');
	}

	public function delete(){

		$project = false;
		if(isset($this->parameters['id']) && $this->parameters['id'] > 0){
			$project = $this->projectModel->getById($this->parameters['id']);
		}

		
		if($project){
			$this->projectModel->delete($project['id']);
		}


		header("Location: /admin/projecten");
		exit;
	}

}
