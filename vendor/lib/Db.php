<?php 
namespace vendor\lib;

use PDO;
/**
 * 
 */
class Db 
{
	
	protected $db;

	function __construct()
	{
		$config = require 'config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
		// debug($config);
	}

	public function query($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				// echo $key.$val;
				$stmt->bindValue(':'. $key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function findAll($sql, $params = []){
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

	public function findOne($sql, $params = []){
		$result = $this->query($sql,$params);
		return $result->fetchColumn();
	}
}