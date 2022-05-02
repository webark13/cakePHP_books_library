<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $validate = array(

			'name' => array(
				'required'=>array(
					'rule'=>'notBlank',
					'message'=>'Name is required')
			),

			'username' => array(
				'required' => array(
					'rule' => 'notBlank',
					'message' => 'A username is required'),
				'unique'=>array(
					'rule'=>'isUnique',
					'required'=>'create',
					'message'=>'This username is not available, Please try another'),
				'alphanumeric'=>array(
					'rule'=>'alphanumeric',
					'message'=>'Only letters and numbers are allowed')
			),

			'password' => array(
				'required' => array(
					'rule' => 'notBlank',
					'message' => 'A password is required')
			),

			'role' => array(
				'valid' => array(
					'rule' => array('inlist', array('student')),
					'allowEmpty' => false
				)
			)
		);

	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']);
		}
		return true;
	}

	public $hasMany = array(
		'Stock'=>array(
			'Stock'
			)
		);






}
