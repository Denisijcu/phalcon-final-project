<?php

use Phalcon\Mvc\Controller;

class ShowController extends Controller
{
	public function indexAction()
	{
        $id = $this->request->get('id');
       
        $stamps = Stamps::findFirst($id);

        $this->view->stamps = $stamps;
    
    }
    
    public function newAction()
    {
        $stamps = new Stamps();
        $this->view->stamps = $stamps;
    }


    public function saveAction()
    {  
       // $number = $this->request->get('number');
        $name = $this->request->get('name');
        $description = $this->request->get('description');
        $party = $this->request->get('party');
        $term = $this->request->get('term');
        $hoy = date("F j, Y, g:i a");  
        // upload the image
        $ext = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
        $filename = md5(rand() . $name . $hoy) . ".$ext";
        copy($_FILES["picture"]["tmp_name"], "images/$filename");
        $number = $this->request->get('id');
        $stamps = new Stamps();
        $stamps->number = $number;
        $stamps->name = $name;
        $stamps->description = $description;
        $stamps->party = $party;
        $stamps->term = $term;
        $stamps->picture = 'images/'.$filename;
        $stamps->save();

        $this->response->redirect('stamps');
    }
   
    public function updateAction(){
        $id = $this->request->get('id');
        $stamps = Stamps::findFirst($id);
        $this->view->stamps = $stamps;
    }

    public function saveupdateAction()
    {
        $id = trim($this->request->get('id'));
        $name = $this->request->get('name');
        $description = $this->request->get('description');
        $party = $this->request->get('party');
        $term = $this->request->get('term');
       // $number =  $id; // change to update name

        $stamps = Stamps::findFirst($id);
       // $stamps->number = $number;
        $stamps->name = $name;
        $stamps->description = $description;
        $stamps->party = $party;
        $stamps->term = $term;
        $stamps->save();

        $this->response->redirect('stamps');
    }

    public function deleteAction(){
       $id = $this->request->get('id');
		// find user in the database
		$stamps = Stamps::findFirst($id);
		$stamps->delete();

		// redirect to home
        $this->response->redirect('stamps');
    }
}	
