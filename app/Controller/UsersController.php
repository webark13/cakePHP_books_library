<?php
 
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $uses = array('User');

    public function beforeFilter()
    {
        parent::beforeFilter();
        // allow users to register and logout 
        $this->Auth->allow('add', 'login');
    }



    public function allUsers()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->User->Stock->find('all'));
    }

    public function profile()
    {
        $user = $this->Auth->user();
        $userProfile = $this->User->Stock->find('all',
            array('conditions'=>array('User.id'=>$user['id'])));

        $this->set('userDetails', $userProfile);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The User has been saved'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(__('There is an error, Please try again'));
        }
    }

    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    
}
