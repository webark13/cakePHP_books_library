<?php

App::uses('AppModel', 'Model'); 

class Book extends AppModel
{
	public $validate = array(
		'title' => array(
			"rule" => 'notBlank',
			'message'=>'Please add title of book'
		),

		'author'=>array(
			'rule'=>'notBlank',
			'message'=>'Please add author of book'),

		'file' => array(
			'extension' => array(
				'rule' => array('extension', array('pdf')),
				'message' => 'Only pdf files are allwed'
			)
		),

		'units'=>array(
			'notBlank'=>array(
				'rule'=>'notBlank',
				'message'=>'Please number of books'
			),
			'numeric'=>array(
				'rule'=>'numeric',
				'message'=>'Please add only numbers'
			)
		)
	);

	public $hasMany = array(
		'Stock'=>array(
			'Stock'
			)
		);


}