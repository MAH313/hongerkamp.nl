<?php

class Projecten extends Controller{
	protected $require_login = true;

	private $projectModel, $assetsModel;

	public function init($parameters){
		parent::init($parameters);

		$this->projectModel = new projectModel();
		$this->assetsModel = new assetsModel();

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

		if($this->is_post){
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


	public function assets(){
		$project = false;
		if(isset($this->parameters['id']) && $this->parameters['id'] > 0){
			$project = $this->projectModel->getById($this->parameters['id']);

			$assets = $this->assetsModel->getAssetsForProject($this->parameters['id']);
		}

		if(!$project){
			header("Location: /admin/projecten");
			exit;
		}

		$this->smarty->assign('project', $project);
		$this->smarty->assign('assets', $assets);
		$this->smarty->display('templates/admin/projecten/assets.tpl');
	}

	public function upload_asset(){
		if($this->is_post){

			$project_id = $_POST['project'];

			$uploads_dir = 'public/uploads/';
			$file = $_FILES['uploaded_file'];
			
			$image_data = getimagesize($file['tmp_name']);

			$file_name = $file['name'];
			$file_extension = end(explode(".", $file_name));

			$storage_path = $uploads_dir.date('Y-m-d').'_'.base64_encode(date('Hi').rand(10000,99999)).'.'.$file_extension;

			if($image_data !== false){
				$upload_successfull = move_uploaded_file($file['tmp_name'], $storage_path);

				if($upload_successfull){
					$asset_id = $this->assetsModel->add([
						'title' => $file_name,
						'path' => $storage_path,
						'project_id' => $project_id,
					]);

					$asset = $this->assetsModel->getById($asset_id);

					echo json_encode(['success' => true, 'asset' => $asset]);
					exit;
				}
				else{
					http_response_code(500);
					echo json_encode(['success' => false, 'error' => 'Could not store file']);
					exit;
				}
			}
			else{
				http_response_code(400);
				echo json_encode(['success' => false, 'error' => 'invalid_request']);
				exit;
			}
		}

		http_response_code(400);
		echo json_encode(['success' => false, 'error' => 'invalid_request']);
		exit;
	}

	public function delete_asset(){

		if($this->is_post){

			$asset_id = $_POST['asset_id'];
			$asset = $this->assetsModel->getById($asset_id);

			if($asset){
				unlink($asset['path']);
				$this->assetsModel->delete($asset['id']);
			}
			else{
				echo json_encode(['success' => false, 'error' => 'Asset bestaat niet']);
				exit;
			}

			echo json_encode(['success' => true]);
			exit;
		}

		http_response_code(400);
		echo json_encode(['success' => false, 'error' => 'invalid_request']);
		exit;
	}

	// public function reorder_assets(){
	// 	echo '<pre>';
	// 	var_dump($_POST, $_FILES);
	// 	exit;
	// }

}
