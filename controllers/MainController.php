<?php 
namespace controllers;

use vendor\core\Controller;

use vendor\lib\Db;
/**
 * 
 */
class MainController extends Controller
{
	
	public function indexAction()
	{
		$db = new Db;

		$result = $this->model->getNews();
		// debug($result);

		$params = [
			'id' => 1,
		];
		$data = $db->findALl('SELECT * from greens WHERE id = :id ',$params);
		
		

		$this->view->render('Главная страницa', [
			'news' => $result
		]);
		// echo('Главная страницa');	
	}
}