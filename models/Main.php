<?php 

namespace models;

use vendor\core\Model;

/**
 * 
 */
class Main extends Model
{
	
	public function getNews()
	{
		$result = $this->db->findAll('SELECT * FROM greens');
		return $result;
	}
}