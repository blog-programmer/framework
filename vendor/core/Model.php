<?php 

namespace vendor\core;

use vendor\lib\Db;

abstract class Model {

	public $db;

	public function __construct() {
		// echo "string";
		$this->db = new Db;
	}

}
