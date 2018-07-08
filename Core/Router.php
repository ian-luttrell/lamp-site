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
}
