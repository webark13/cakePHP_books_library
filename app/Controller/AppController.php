<?php

App::uses('Controller', 'Controller');

class AppController extends Controller
{
	public $components = array( 
		'Flash',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'books',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'books',
				'action' => 'index'
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			),
			'authorize' => array('Controller')
		)
	);

	public function isAuthorized($user) {
		// admin can add books
		if (isset($user['role']) && $user['role'] == 'admin') {
			return true;
		}
		if(isset($user['role']) && $user['role'] == 'student') {
			$allowedAction = array('index', 'logout', 'profile');
			if(in_array($this->request->action, $allowedAction)) {
				return true;
			}
		}
		return false;
	}

	public function beforeFilter()
	{
		$this->Auth->allow('index');
	}
}
