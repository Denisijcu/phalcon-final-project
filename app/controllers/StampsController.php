<?php

use Phalcon\Mvc\Controller;

class StampsController extends Controller
{
	public function indexAction()
	{
     $stamps = Stamps::find();
     $page = $this->request->get('page');
     // send data to the view
     
     /*
    $users = ['Denis'];

     if($this->session->has('users')){
         $this->session->set('users',[]);
     }

     $users =$this->session->get('users');

    $this->view->users = $users;
     */
   
     $this->view->stamps = $stamps;
     $this->view->page = $page;
    
   
	}
}	// load users from database
