<?php #base router functions

class Route{

	private $controllers = [];
	private $paths = [];

	public function addPath($path, $controller, $function){
    	#adds a route
		$this->paths[] = ['path'=> trim($path, '/') ?: '/', 'controller' => $controller, 'function' => $function];
	}

	public function addController($name, $class){
		#adds a controller
		$this->controllers[$name] = $class;
	}

	public function submit(){
    	#routing function
		$uri = isset($_GET['uri']) ? $_GET['uri'] : "/";
		$FourOhFour = true;

		foreach ($this->paths as $pathKey => $pathValue) {
			if(preg_match("#^".$pathValue['path']."/?$#", $uri, $matches)){
				$controller = $this->controllers[$pathValue['controller']];

				if(method_exists($controller, "init")){
					$controller->init($matches);
				}

				//$initOuput->url_matches = $matches;

				$function = $pathValue['function'];

				$controller->$function();
				$FourOhFour = false;

				break;
			}
		}

		if($FourOhFour){
			if(function_exists("FourOhFour")){
				FourOhFour($uri);
			}
			else{
				http_response_code (404);
				echo "404; page not found";
			}
		}
	}

}
