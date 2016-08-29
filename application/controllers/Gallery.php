<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
    
    private $newsStatus;
    private $newsNumPerPage;

    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('gallery_model');
        $this->photoType = array('0'=>'默认', '1'=>'新闻', '2'=>'用户', '3'=>'系统');
        $this->photoNumPerPage = 20;
    }

    public function index()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar']  = 'gallery';
        $this->load->view('header', $data);
        $this->load->view('gallery_index');
        $this->load->view('footer');
    }

    public function info()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'gallery';

        $this->load->view('header', $data);
        $this->load->view('gallery_info');
        $this->load->view('footer');
    }

    public function add()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'galleryAdd';
        $this->load->view('header', $data);
        $this->load->view('gallery_add');
        $this->load->view('footer');
    }


    //----------- 处理操作 ----------------------
    //do something...


    //------------ 上传图片 -----------------------------------------
    public function fileUpload() 
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->_responseData(array('status'=>0, 'msg'=>'对不起，您没有权限进行此操作'));
        }
        //var_dump($_FILES);exit;
        if (empty($_FILES['file'])) {
            $this->_responseData(array('status'=>0, 'msg'=>'未上传图片'));
        }
        //$file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $file_tmp  = $_FILES['file']['tmp_name'];

        $fileName = basename($_FILES['file']['name']);
        $file_ext = strtolower(substr($fileName, strrpos($fileName, '.') + 1)); //图片后缀

        $allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
        if (empty($allowed_image_types[$file_type]) || $allowed_image_types[$file_type] != $file_ext) {
            $this->_responseData(array('status'=>0, 'msg'=>'图片格式不支持'));
        }

        $allowed_max_size = 5*1000*1000; //5M
        if ($file_size > $allowed_max_size) {
            $this->_responseData(array('status'=>0, 'msg'=>'上传图片超过上限（'.$allowed_max_size.'｜'.$file_size.'）'));
        }

        $upload_time = time();
        //按年月命名文件夹存储图片
        $pathDate = date('Ym', $upload_time);

        $upload_path_local = UPLOAD_IMG_PATH .$pathDate.'/';//图片本地存储地址
        if(!is_dir($upload_path_local)){
            mkdir($upload_path_local); //, 0777
            mkdir($upload_path_local.'/thumb/'); //, 0777
        }

        $upload_path_url = UPLOAD_IMG_URL .$pathDate.'/';//图片访问url
        
        $file_name_new = 'PIC_'.time().'_'.$this->func->generateStr(4).'.'.$file_ext;//图片重命名
        move_uploaded_file($file_tmp, $upload_path_local.$file_name_new); //图片转移至上传路径
        
        //存储数据库
        $type = intval( $this->input->get('type') );
        $this->gallery_model->add_gallery( array('name'=>$file_name_new, 'path'=>$pathDate, 'add_time'=>$upload_time, 'status'=>1, 'type'=>$type) );
        //创建缩略图
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $upload_path_local.$file_name_new;
        $config['create_thumb'] = TRUE;
        $config['new_image'] = $upload_path_local.'thumb/'.$file_name_new;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
        $config['width'] = 400;
        $config['height'] = 300;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        //返回数据
        $data = array();
        $data['name'] = $file_name_new;
        $data['size'] = $file_size;
        $data['type'] = $file_type;
        $data['url']  = $upload_path_url.$file_name_new;
        $data['path'] = $pathDate;
        $data['uploadTime']     = $upload_time;
        $data['thumbnailUrl']   = $upload_path_url. 'thumb/' .$file_name_new;
        //$data['deleteUrl']    = base_url() . 'news/deleteImage?path='. $upload_time . '&fname=' .$file_name_new;
        //$data['deleteType']   = 'DELETE';
        //$data['error']        = null;
        
        $this->_responseData(array('status'=>1, 'msg'=>$data));
    }
    
    //删除图片
    public function deleteImage() 
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->_responseData(array('status'=>0, 'msg'=>'对不起，您没有权限进行此操作'));
        }
        
        $pathDate = $this->input->get('path');
        $fileName = $this->input->get('fname');
        $localFile = UPLOAD_IMG_PATH . $pathDate . '/' . $fileName;
        $localFileThumb = UPLOAD_IMG_PATH . $pathDate . '/thumb/' . $fileName;
        if (file_exists($localFile)) {
            //$res = delete_files($localFile) && delete_files($localFileThumb);
            $res = unlink($localFile) && unlink($localFileThumb);
            //删除数据库
            $this->gallery_model->del_gallery(array('name'=>$fileName) );
        }else{
            $this->_responseData(array('status'=>0, 'msg'=>'图片('.$localFile.')不存在'));
        }
        
        $this->_responseData(array('status'=>1, 'msg'=>$res));
    }

    private function _responseData($data){
        if(IS_AJAX){
            echo json_encode( $data );
        }else{
            $this->load->view('response_view', array('data'=>$data) );
        }
        exit;
    }


}
