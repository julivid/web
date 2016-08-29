<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    
    private $newsStatus;
    private $newsNumPerPage;

    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('news_model');
        $this->newsStatus = array('-1'=>'已删除', '0'=>'已录入', '1'=>'已发布');
        $this->newsNumPerPage = 20;
    }

    public function index()
    {
        redirect(base_url('News/lists?c=news'));
    }

    public function lists()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE ){
            redirect(base_url('Admin/error'));
        }
        $channel = $this->input->get('c', true);
        $data['actNavBar']  = $channel;
        $data['newsStatus'] = $this->newsStatus;
        $data['newsList']   = $this->news_model->get_news(array('channel'=>$channel), $this->newsNumPerPage, 0);
        $this->load->view('header', $data);
        $this->load->view('news_list');
        $this->load->view('footer');
    }

    public function info()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'newsInfo';
        $nid = intval( $this->input->get_post('id') );
        $data['newsInfo'] = $this->news_model->get_news(array('nid'=>$nid, 'status'=>0), 1, 0);
        $this->load->view('header', $data);
        $this->load->view('news_info');
        $this->load->view('footer');
    }

    public function show()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $nid = intval( $this->input->get_post('id') );
        $data['newsInfo'] = $this->news_model->get_news(array('nid'=>$nid), 1, 0);
        if (empty( $data['newsInfo'] )) {
            $data['actNavBar'] = 'news';
        }else{
            $data['actNavBar'] = $data['newsInfo'][0]['channel'];
        }
        $this->load->view('header', $data);
        $this->load->view('news_show');
        $this->load->view('footer');
    }

    public function add()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'newsAdd';
        $this->load->view('header', $data);
        $this->load->view('news_add');
        $this->load->view('footer');
    }

    //----------- 处理操作 ----------------------
    
    public function getNewsListAJAX()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $p = intval($this->input->get_post('p'));
        $channel =  $this->input->get_post('t', true);
        if ( $p==0 || empty($channel) ) {
            $this->func->responseData(0, '参数错误');
        }
        $limit = $this->newsNumPerPage;
        $offset = $limit*($p-1);
        $data = $this->news_model->get_news(array('channel'=>$channel), $limit, $offset);
        $this->func->responseData(1, '加载成功', $data);
    }

    public function newsAdd()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $data = $this->input->post(array('channel', 'title', 'tag', 'content', 'gallery', 'brief'), true);
        if($this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错', $data);
        }
        $data['add_time'] = time();
        $gallery = explode(',', $data['gallery']);
        $data['main_photo'] = $gallery[0];
        $this->news_model->add_news($data);
        //log记录操作

        $this->func->responseData(1, '添加成功');
    }

    public function newsEdit()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $nid = intval( $this->input->post('nid') );
        $data = $this->input->post(array('title', 'tag', 'content', 'gallery', 'brief'), true);
        if(empty( $nid ) || $this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错');
        }
        $this->news_model->update_news($data, $nid);
        //log记录操作

        $this->func->responseData(1, '修改成功');
    }

    public function newsMainPhoto()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $nid = intval( $this->input->post('nid') );
        $data['main_photo'] = $this->input->post('main_photo', true);
        //var_dump($data);
        if(empty( $nid ) || empty( $data['main_photo'] )){
            $this->func->responseData(0, '上传数据出错');
        }
        $this->news_model->update_news($data, $nid);
        //log记录操作

        $this->func->responseData(1, '更换成功');
    }

    public function newsStatus()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $nid = intval( $this->input->post('nid') );
        $status = intval( $this->input->post('status') );
        if(empty( $nid )){
            $this->func->responseData(0, '信息数据出错');
        }
        $this->news_model->update_news(array('status'=>$status), $nid);
        //log记录操作

        $this->func->responseData(1, '操作成功');
    }


    public function indexShow()
    {
        if( $this->auth->checkManagerPrivilege('News', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $nid = intval( $this->input->post('nid') );
        $channel = $this->input->post('channel', true);
        if(empty( $nid ) || empty( $channel )){
            $this->func->responseData(0, '信息数据出错');
        }
        $this->news_model->update_index($nid, $channel);
        //log记录操作

        $this->func->responseData(1, '操作成功');
    }


}
