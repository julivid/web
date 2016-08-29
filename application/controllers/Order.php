<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
    }

	public function index()
	{
        if( $this->auth->checkManagerPrivilege('Order', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'order';
		$this->load->view('header', $data);
		$this->load->view('order_list');
		$this->load->view('footer');
	}

    

    public function orderInfo()
    {
        if( $this->auth->checkManagerPrivilege('Order', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'orderInfo';
        $this->load->view('header', $data);
        $this->load->view('order_info');
        $this->load->view('footer');
    }

    public function orderInvoice()
    {
        if( $this->auth->checkManagerPrivilege('Order', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'orderInvoice';
        $this->load->view('header', $data);
        $this->load->view('order_invoice');
        $this->load->view('footer');
    }



}
