<?php 
namespace vendor\core;

use vendor\core\View;
/**
 * 
 */
class Router 
{
	
	protected $routes = [];
	protected $params = [];

	function __construct()
	{
		$arr = require 'config/routes.php';
		// debug($arr);
		foreach ($arr as $key => $val) {
			$this->add($key,$val);
		}
		// debug($this->routes);
	}

	public function add($route, $params)
	{
		$route = '#^'.$route.'$#';
		$this->routes[$route] = $params;
	}
	public function match()
	{
		$url = trim($_SERVER['REQUEST_URI'], '/');
		// debug($url);
		foreach ($this->routes as $route => $params) {
			// var_dump($route);
			if (preg_match($route, $url, $matches)) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}
	public function run()
	{
		if ($this->match()) {
			$path = 'controllers\\'.ucfirst($this->params['controller']).'Controller';
			// var_dump($path);
			if (class_exists($path)) {
				$action = $this->params['action'].'Action';
				if (method_exists($path, $action)) {
					$controller = new $path($this->params);
					$controller->$action();
				} else {
					View::errorCode(404);
				}
			} else {
					View::errorCode(404);
				// echo "Не найден контроллер ". $path;
			}
		}else{
			// echo "Маршрут не найден";
					View::errorCode(404);
		}
	}


}