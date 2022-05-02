<?php

App::uses('AppModel', 'Model');

class Stock extends AppModel
{
	public $useTable = 'books_users';
	public $belongsTo = array(
		'Book',
		'User'
	);
}



?>