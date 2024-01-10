<?php

class Index extends Controller{

	private $projectModel, $assetsModel;

	public function init($parameters){
		parent::init($parameters);

		$this->projectModel = new projectModel();
		$this->assetsModel = new assetsModel();
	}

	public function index(){
	    // home page

		// phpinfo();
		// exit;

		$projecten = $this->projectModel->getAll($frontend = true);
		
		$this->smarty->assign('projecten', $projecten);
		$this->smarty->display('templates/index.tpl');
	}

	public function project(){
		// projecten detail pagina

		$project = false;
		if(!empty($this->parameters['id']) && $this->parameters['id'] > 0){
			$project = $this->projectModel->getById($this->parameters['id']);

			if(!$project['is_visible']){
				$project = false;
			}
			else{
				$project['assets'] = $this->assetsModel->getAssetsForProject($project['id']);

				$links = $project['links'];

				if(!empty($links) && is_string($links)){
					$project['links'] = [];

					$links = explode(';', $links);

					foreach($links as $lkey => $link){
						if(empty(trim($link))){
							continue;
						}

						$link_parts = explode(', ', $link);

						if(count($link_parts) == 2){
							$project['links'][trim($link_parts[0])] = trim($link_parts[1]);
						}
					}
				}
			}
		}

		$this->smarty->assign('project', $project);
		$this->smarty->display('templates/project.tpl');
	}

	public function login(){
		if($this->auth->getLoggedIn()){
			header("Location: /admin/projecten");
		}

		$error = false;
		if($this->is_post){
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
