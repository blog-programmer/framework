<?php

namespace vendor\core;
/**
 * 
 */
 class View 
{
	public $path;
	public $route;
	public $layout = 'main';

	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
		// debug($this->path);
		
	}

	public function render($title, $vars = [])
	{
		extract($vars);
		// debug($age);
		if (file_exists('views/'.$this->path.'.php')) {
			ob_start();
				require 'views/'.$this->path.'.php';
				$content = ob_get_clean();
				require 'views/layouts/'.$this->layout.'.php';
		}else{
			echo('Вид не найден');
		}
	}

	public static function errorCode($code)
	{
		http_response_code($code);
		$path = 'views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit();
	}
	public function redirect($url)
	{
		header('location: '.$url);
	}
	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}
}