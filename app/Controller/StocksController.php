<?php

App::uses('AppController', 'Controller');

class StocksController extends AppController
{
	public $uses = array('Stock');

	public function issue()
	{
		$this->loadModel('User');
        $users = $this->User->find('list', array(
            'fields'=>array('User.username')
            ));
        $this->set('users', $users);

        $this->loadModel('Book');
        $books = $this->Book->find('list');
        $this->set('booksAvailable', $books);

        if($this->request->is('post')) {
            $data = $this->request->data;

            $user_id = $data['User']['id'];
            $user = $this->User->findById($user_id);
            if(!$user) {
                $this->Flash->error(__('Invalid User'));
            }
    
            $book_id = $data['Book']['id'];
            $book = $this->Book->findById($book_id);
            if(!$book) {
                $this->Flash->error(__('Invalid Book'));
            }

            // check if student has not returned book from previous issuing
            $issuedBooks = $this->Stock->find('first',
				array('conditions'=>array(
					'user_id'=>$user_id,
					'book_id'=>$book_id,
					'issue'=>true,
					'return'=>false)));
			if($issuedBooks) {
               $this->Flash->error(__('Student already isssued this book previously'));
            	return $this->redirect(array('action'=>'issue'));
            }

            if($book['Book']['units'] <= 0){
            	$this->Flash->error(__('This Book is not available at the moment'));
            	return $this->redirect(array('action'=>'issue'));
            }

            $data['Stock']['issue'] = true;
            if($this->Stock->saveAssociated($data)) {
            	// decrease unit field value in table if book issued
	            $units = $book['Book']['units'];
                if($this->Book->saveField('units', $units - 1)){
                	$this->Flash->success(__('Book has been issued'));	
                }
            $this->redirect(array(
            	'controller'=>'books', 'action'=>'index'));	            
        	}
        	$this->Flash->error(__('Book could not be issued'));            
        }          
	}

	public function returnBook()

	{
		$this->loadModel('User');
        $users = $this->User->find('list', 
        	array('fields'=>array('User.username')));
        $this->set('users', $users);

        $this->loadModel('Book');
        $books = $this->Book->find('list');
        $this->set('booksAvailable', $books);
		
		if($this->request->is('post')) {
			$data = $this->request->data;
			$user_id = $data['User']['id'];
			$book_id = $data['Book']['id'];
			$book = $this->Book->findById($book_id);
			$issuedBooks = $this->Stock->find('first',
				array('conditions'=>array(
					'user_id'=>$user_id,
					'book_id'=>$book_id)));
			if(!$issuedBooks){
				$this->Flash->error(__('This Book does not belong to you'));
				return $this->redirect(array('action'=>'returnBook'));
			}
			$this->Stock->id = $issuedBooks['Stock']['id'];
			if($this->Stock->saveField('return', true)) {
				$units = $book['Book']['units'];
				$this->Book->id = $book_id;
				// increase unit field value in table if book returned
				if($this->Book->saveField('units', $units + 1)) {
					$this->Flash->success(__('Book has been Returned'));
					return $this->redirect(array(
						'controller'=>'books', 'action'=>'index'));
				}
				
			}
			$this->Flash->error(__('Book could not be issued'));
		}
	}





}
?>