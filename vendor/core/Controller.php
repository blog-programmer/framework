<?php

namespace vendor\core;
/**
 * 
 */
use vendor\core\View;

abstract class Controller 
{
	public $route;
	public $view;
	public $acl;
	public function __construct($route)
	{
		$this->route = $route;
		// debug($this->checkAcl());
		if ($this->checkAcl() == false) {
			View::errorCode(403);
		}
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);

	}

	public function loadModel($name)
	{

		$path = 'models\\'.ucfirst($name);
		// debug($path);
		if (class_exists($path)) {
			// debug('s');	
			return new $path;
		}
		
	}

	public function checkAcl()
	{
		$this->acl = require 'acl/'.$this->route['controller'].'.php';
		
		// $_SESSION['admin'] = 1;

		if ($this->isAcl('all')) {
			return true;
		}
		if (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) {
			return true;
		}
		if (!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')) {
			return true;
		}

		if (isset($_SESSION['admin']) && $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key)
	{
		if (in_array($this->route['action'], $this->acl[$key]) || in_array('*', $this->acl[$key])) {
			return true;
		}
	}
}