<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('user_model');
        $this->userNumPerPage = 20;
    }

	public function index()
	{
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $type = $this->input->get('t', true);
        $type = empty( $type ) ? 'player' : $type;

        $data['actNavBar'] = $type;
        $data['userInfo']  = $this->user_model->get_user( array('type'=>$type), $this->userNumPerPage, 0);
        $this->load->view('header', $data);
        $this->load->view('user_list');
        $this->load->view('footer');
	}

    public function add()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'user';
        $this->load->view('header', $data);
        $this->load->view('user_add');
        $this->load->view('footer');
    }

    public function info()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'user';

        $uid = intval( $this->input->get('id') );
        $data['userDetail'] = $this->user_model->get_user( array('uid'=>$uid) );

        $this->load->view('header', $data);
        $this->load->view('user_info');
        $this->load->view('footer');
    }

    public function edit()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'user';

        $uid = intval( $this->input->get('id') );
        $data['userDetail'] = $this->user_model->get_user( array('uid'=>$uid) );

        $this->load->view('header', $data);
        $this->load->view('user_edit');
        $this->load->view('footer');
    }


    //-------- 处理操作 --------------
    public function getUserListAJAX()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $p = intval($this->input->get_post('p'));
        $type =  $this->input->get_post('t', true);
        if ( $p==0 || empty($type) ) {
            $this->func->responseData(0, '参数错误');
        }
        $limit = $this->userNumPerPage;
        $offset = $limit*($p-1);
        $data = $this->user_model->get_user(array('type'=>$type), $limit, $offset);
        $this->func->responseData(1, '加载成功', $data);
    }

    public function userAdd()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $data = $this->input->post(array('type', 'name', 'gender', 'record', 'gallery'), true);
        if($this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错', $data);
        }
        $data['create_time'] = time();
        $gallery = explode(',', $data['gallery']);
        $data['photo'] = $gallery[0];
        $uid = $this->user_model->add_user($data);
        //log记录操作

        $this->func->responseData(1, '添加成功', array('userid'=>$uid));
    }

    //人员状态
    public function userStatus()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $uid = intval( $this->input->post('uid') );
        $status = intval( $this->input->post('status') );
        if(empty( $uid )){
            $this->func->responseData(0, '数据出错');
        }
        $this->user_model->update_user(array('status'=>$status), $uid);
        //log记录操作

        $this->func->responseData(1, '操作成功');
    }

    //修改人员信息
    public function userEdit()
    {
        if( $this->auth->checkManagerPrivilege('User', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $uid = intval( $this->input->post('uid') );
        $data = $this->input->post(array('name', 'gender', 'record'), true);
        if(empty( $uid ) || $this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错');
        }
        $this->user_model->update_user($data, $uid);
        //log记录操作

        $this->func->responseData(1, '修改成功');
    }

    public function Register(){
        $this->load->view('register_view');
    }

    public function forgotPwd(){
        $this->load->view('forgot_pwd_view');
    }


}
