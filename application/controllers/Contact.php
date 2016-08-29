<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('contact_model');
    }

	public function index()
	{
        if( $this->auth->checkManagerPrivilege('Contact', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar']   = 'contact';
        $data['contactList'] = $this->contact_model->get_contact();
		$this->load->view('header', $data);
		$this->load->view('contact_list');
		$this->load->view('footer');
	}



}
