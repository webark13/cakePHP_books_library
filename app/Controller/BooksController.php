<?php

App::uses('AppController', 'Controller');

class BooksController extends AppController
{
    public $uses = array('Book');

    public $helpers = array('Html', 'Form');

    public function index()
    {
        // find all books from database
        $result = $this->Book->find('all');
        // assign result to 'books' var to use in view
        $this->set('books', $result);
    }

    // create a function to add books
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Book->create();
            if ($this->Book->save($this->request->data)) {
                $this->Flash->success(__('New Book added'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Your Book could not be added'));
        }
    }

    





}
?>