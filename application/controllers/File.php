<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {
    
    private $fileStatus;
    private $fileNumPerPage;

    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('file_model');
        $this->fileStatus = array('-1'=>'已删除', '0'=>'已录入', '1'=>'已发布');
        $this->fileNumPerPage = 20;
    }

	public function index()
	{
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar']  = 'file';
        $data['fileStatus'] = $this->fileStatus;
        $data['fileList']   = $this->file_model->get_file(array(), $this->fileNumPerPage, 0);
        $this->load->view('header', $data);
        $this->load->view('file_list');
        $this->load->view('footer');
	}

    public function info()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'fileInfo';
        $fid = intval( $this->input->get_post('id') );
        $data['fileInfo'] = $this->file_model->get_file(array('fid'=>$fid, 'status'=>0), 1, 0);
        $this->load->view('header', $data);
        $this->load->view('file_info');
        $this->load->view('footer');
    }

    public function add()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'fileAdd';
        $this->load->view('header', $data);
        $this->load->view('file_add');
        $this->load->view('footer');
    }

    //----------- 处理操作 ----------------------
    
    public function getFileListAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $p = intval( $this->input->get_post('p') );
        if ( $p==0 ) {
            $this->func->responseData(0, '参数错误');
        }
        $limit = $this->fileNumPerPage;
        $offset = $limit*($p-1);
        $data = $this->file_model->get_file(array(), $limit, $offset);
        $this->func->responseData(1, '加载成功', 'data'=>$data);
    }

    public function fileAdd()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        
        $data['name'] = $this->input->post('file_name', true);
        $data['brief'] = $this->input->post('file_brief', true);
        //$file_name = $_FILES['file_orig']['name'];
        $file_size = $_FILES['file_orig']['size'];
        $file_type = $_FILES['file_orig']['type'];
        $file_tmp  = $_FILES['file_orig']['tmp_name'];

        $fileName = basename($_FILES['file_orig']['name']);
        $file_ext = strtolower(substr($fileName, strrpos($fileName, '.') + 1)); //文件后缀

        $allowed_file_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'text/plain', 'application/pdf', 'binary/octet-stream', 'application/excel', 'application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/vnd.msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/vnd.ms-powerpoint', 'application/vnd.ms-office', 'application/msword', 'application/force-download', 'application/x-download', 'application/download', 'application/x-rar', 'application/rar', 'application/x-rar-compressed', 'application/x-zip', 'application/zip', 'application/x-zip-compressed', 'application/s-compressed', 'multipart/x-zip', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'image/pjpeg', 'image/jpeg', 'image/jpg', 'image/png', 'image/x-png', 'image/gif');
        $allowed_file_ext = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'rar', 'zip', 'csv', 'jpg', 'jpeg', 'png', 'gif', 'txt');
        $allowed_max_size = 5*1000*1000; //5M

        if($this->func->hasEmptyEle($data)==true || empty($_FILES['file_orig']) ){
            $this->func->responseData(0, '上传数据出错', 'data'=>$data), 'html';
        }elseif( !empty( $_FILES['file_orig']['error'] ) || $file_size > $allowed_max_size){
            $this->func->responseData(0, '上传文件超过限制，或上传过程出错（Max:'.$allowed_max_size.' ｜ File:'.$file_size.''), 'html');
        }elseif ( !in_array($file_type, $allowed_file_types) || !in_array($file_ext, $allowed_file_ext) ) {
            $this->func->responseData(0, '文件格式不支持', 'data'=>array('ext'=>$file_ext, 'type'=>$file_type)), 'html';
        }else{
            $upload_time = time();
            //按年月命名文件夹存储文件
            $pathDate = date('Ym', $upload_time);

            $upload_path_local = UPLOAD_FILE_PATH .$pathDate.'/';//文件本地存储地址
            if(!is_dir($upload_path_local)){
                mkdir($upload_path_local); //, 0777
            }

            $upload_path_url = UPLOAD_FILE_URL .$pathDate.'/';//文件访问url
            
            $file_name_new = 'HPA_'.time().'_'.$this->func->generateStr(4).'.'.$file_ext;//文件重命名
    
            move_uploaded_file($file_tmp, $upload_path_local.$file_name_new); //文件转移至上传路径
            
            //存储数据库
            $type = intval( $this->input->get('type') );
            if( $this->file_model->add_file( array('name'=>$data['name'], 'fname'=>$file_name_new, 'folder'=>$pathDate, 'add_time'=>$upload_time, 'status'=>0, 'brief'=>$data['brief'], 'type'=>$file_ext) ) ){
                //log记录操作
                redirect( base_url('File') );
            }else{
                $this->func->responseData(0, '录入数据库失败', 'data'=>array('error'=>mysql_error() ));
            }
        }
    }

    public function fileEdit()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $fid = intval( $this->input->post('fid') );
        $data = $this->input->post(array('title', 'tag', 'content', 'gallery', 'brief'), true);
        if(empty( $fid ) || $this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错');
        }
        $this->file_model->update_file($data, $fid);
        //log记录操作

        $this->func->responseData(1, '修改成功');
    }

    public function fileMainPhoto()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $fid = intval( $this->input->post('fid') );
        $data['main_photo'] = $this->input->post('main_photo', true);
        //var_dump($data);
        if(empty( $fid ) || empty( $data['main_photo'] )){
            $this->func->responseData(0, '上传数据出错');
        }
        $this->file_model->update_file($data, $fid);
        //log记录操作

        $this->func->responseData(1, '更换成功');
    }

    public function fileStatus()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $fid = intval( $this->input->post('fid') );
        $status = intval( $this->input->post('status') );
        if(empty( $fid )){
            $this->func->responseData(0, '信息数据出错');
        }
        $this->file_model->update_file(array('status'=>$status), $fid);
        //log记录操作

        $this->func->responseData(1, '操作成功');
    }


    public function indexShow()
    {
        if( $this->auth->checkManagerPrivilege('Files', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $fid = intval( $this->input->post('fid') );
        $channel = $this->input->post('channel', true);
        if(empty( $fid ) || empty( $channel )){
            $this->func->responseData(0, '信息数据出错');
        }
        $this->file_model->update_index($fid, $channel);
        //log记录操作

        $this->func->responseData(1, '操作成功');
    }


}
