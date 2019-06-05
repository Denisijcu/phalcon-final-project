<?php

use Phalcon\Mvc\Controller;

class GalleryController extends Controller
{
	public function indexAction()
	{
        $stamps = Stamps::find();
       

        $this->view->stamps = $stamps;
     //   $this->view->setLayout('gallery');
     
       
	}
}