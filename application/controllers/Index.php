<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
    }

    public function index()
    {
        $data['actNavBar'] = 'index';
        //$data['loginUser'] = $this->auth->getUserInfo();
        $this->load->view('header', $data);
        $this->load->view('index_view');
        $this->load->view('footer');
    }
}
