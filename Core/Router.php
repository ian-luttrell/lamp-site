<?php

class Router
{
	// routing table
	protected $routes = [];

	// parameters from the matched route
	protected $params = [];

	public function addRoute($route, $params)
	{
		$this->routes[$route] = $params;
	}

	public function getRoutes()
	{
		return $this->routes;
	}

	public function matchRoute($url)
	{
		foreach ($this->routes as $route => $params) {
			if ($url == $route) {
				$this->params = $params;
				return true;
			}
		}

		return false;
	}

	// get the currently matched parameters
	public function getParams()
	{
		return $this->params;
	}


	public function dispatchRoute($url)
	{
		if ($this->matchRoute($url)) {
			$controller = $this->params['controller'];	
			$controller = $this->convertToStudlyCaps($controller);

			if (class_exists($controller)) {
				$controller_object = new $controller();

				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);

				if (is_callable([$controller_object, $action])) {
					$controller_object->$action();
				} else {
					echo "Method {$action} (in controller {$controller}) not found";
				}
			} else {
				echo "Controller class {$controller} not found";
			}
		} else {
			echo "No route matched for URL {$url}";
		}
	}


	protected function convertToStudlyCaps($string) 
	{
		return str_replace (' ', '', ucwords(str_replace('-', ' ', $string)));
	}


	protected function convertToCamelCase($string)
	{
		return lcfirst($this->convertToStudlyCaps($string));
	}
}

?>
