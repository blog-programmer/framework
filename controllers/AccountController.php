<?php 
namespace controllers;

use vendor\core\Controller;
/**
 * 
 */
class AccountController extends Controller
{

	
	
	public function loginAction()
	{
		if (!empty($_POST)) {
			$this->view->location('/');
		}
		// $this->view->redirect('/');

		$this->view->render('Вход');
		
	}

	public function registerAction()
	{
		$this->view->render('Регистрация');
	}
}