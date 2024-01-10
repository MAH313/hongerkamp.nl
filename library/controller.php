<?php

class Controller{
	protected $smarty;
	protected $auth;

	protected $parameters = [];
	protected $require_login = false;

	protected $is_post = false;

	public function init($parameters){

		$this->auth = new Auth();

		$active_user = $this->auth->getLoggedIn();

		if($this->require_login && !$active_user){
			http_response_code(403);
			header("Location: /login");
			exit;
		}

		// als de method post is en de post niet leeg is
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {

			XSRF::checktoken();
			unset($_POST['token']);

		    $this->is_post = true;
		}


		foreach ($parameters as $key => $value) {
		    if (is_int($key)) {
		        unset($parameters[$key]);
		    }
		}

		// GET variabelen ook beschikbaar maken in de parameters array
		$this->parameters = array_merge($parameters, $_GET);

	    // initialasation function
		$this->smarty = new Smarty;
		$this->smarty->error_reporting = E_ALL ^ E_NOTICE ^ E_WARNING;

		$this->smarty->assign('current_year', date('Y'));
		$this->smarty->assign('active_user', $active_user ?: false);
		$this->smarty->assign('token', XSRF::createtoken());

		/*$output = [
			"smarty" => $smarty
		];

		return (object) $output;*/
	}
}

