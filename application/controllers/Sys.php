<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('sys_model');
        $this->confStatus = array('-1'=>'已删除', '0'=>'已录入', '1'=>'已发布');
    }

    public function index()
    {
        if( $this->auth->checkManagerPrivilege('Conf', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $type = $this->input->get('t', true);
        if( empty( $type ) ){
            $type = 'topAd';
        }
        $data['actNavBar']  = $type;
        $data['dataStatus'] = $this->confStatus;

        $typeData = array('topAd'=>'顶部广告', 'sideAd'=>'侧边栏目广告', 'friend'=>'合作伙伴', 'link'=>'友情链接');
        $confData = $this->sys_model->get_conf();
        $data['confData'] = array();
        foreach ($confData as $k => $conf) {
            if ( ( in_array( $type, array('topAd', 'sideAd') ) && in_array( $conf['type'], array('topAd', 'sideAd') ) ) || $type == $conf['type'] ){
                $data['confData'][$k] = $conf;
                $data['confData'][$k]['type'] = $typeData[$conf['type']];
            }
        }
        
        $this->load->view('header', $data);
        $this->load->view('sys_list');
        $this->load->view('footer');
    }

    public function add()
    {
        $data['actNavBar'] = 'sys';
        $this->load->view('header', $data);
        $this->load->view('sys_add');
        $this->load->view('footer');
    }




    public function confAdd()
    {
        if( $this->auth->checkManagerPrivilege('Conf', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }

        $data = $this->input->post(array('type', 'name', 'link', 'brief', 'gallery'), true);
        if($this->func->hasEmptyEle($data, $exceptKey=array('link', 'brief'))==true){
            $this->func->responseData(0, '上传数据出错', $data);
        }
        $data['add_time'] = time();
        $sid = $this->sys_model->add_conf($data);
        //log记录操作

        $this->func->responseData(1, '添加成功', array('sid'=>$sid));
    }

    //人员状态
    public function confStatus()
    {
        if( $this->auth->checkManagerPrivilege('Conf', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $sid = intval( $this->input->post('sid') );
        $status = intval( $this->input->post('status') );
        if(empty( $sid )){
            $this->func->responseData(0, '数据出错');
        }
        $this->sys_model->update_conf(array('status'=>$status), $sid);
        //log记录操作

        $this->func->responseData(1, '操作成功');
    }

}
