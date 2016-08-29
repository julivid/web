<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
	}
    
	public function index()
	{
        $this->load->view('login_view');
	}
    
    public function opLogin()
	{
		$user_name = $this->input->post('username', true);
		$user_pwd  = $this->input->post('password', true);
        //生成salt： var_dump($a = $this->func->generateStr());
        //生成秘密： var_dump($this->func->encryptPwd('admin', $a)); exit;
        $data['status'] = -3;
        $data['msg'] = '参数错误';
        
		if(!empty($user_name) && !empty($user_pwd)){
            $this->load->model('log_model'); //加载日至模块
            //登陆错误次数&时间限制
            //do something...
            
            $this->load->model('admin_model');
            $manager_info = $this->admin_model->get_manager(array('username'=>$user_name));
			
			if(!empty($manager_info[0])){
                $pwd = $this->func->encryptPwd($user_pwd, $manager_info[0]['salt']);
                $logTime = time();
                $logIp = $this->func->get_client_ip();
				if($manager_info[0]['passwd'] == $pwd)
				{
                    //获取上一次成功登录日期
                    $loginLogs = $this->log_model->login_log_get(array('uid'=>$manager_info[0]['mid'], 'status'=>1),1);
                    if( empty($loginLogs)){
                        $last_time = $logTime;
                        $last_ip = $logIp;
                    }else{
                        $last_time = $loginLogs[0]['logTime'];
                        $last_ip = $loginLogs[0]['logIp'];
                    }
                    //添加登录日至--登录成功
                    $this->log_model->login_log_add(array('uid'=>$manager_info[0]['mid'], 'logTime'=>$logTime, 'logIp'=>$logIp, 'status'=>1));
                    
                    //添加session
                    //var_dump($manager_info);
					$userdata = array('uid'=>$manager_info[0]['mid'], 'uname'=>$manager_info[0]['username'], 'name'=>$manager_info[0]['name'], 'rid'=>$manager_info[0]['rid'], 'last_time'=>$last_time, 'last_ip'=>$last_ip, 'isLogin'=>TRUE);
					$this->session->set_userdata($userdata);
                    $data['status'] = 1;
                    $data['msg'] = '登录成功';
				}
				else
				{
                    //添加登录日至--密码错误
                    $this->log_model->login_log_add(array('uid'=>$manager_info[0]['mid'], 'logTime'=>$logTime, 'logIp'=>$logIp, 'status'=>0, 'testPwd'=>$user_pwd));
					$data['status'] = -1;
                    $data['msg'] = '密码错误';
				}
			}
			else
			{
                $data['status'] = -2;
                $data['msg'] = '用户名错误';
			}
            
		}
		echo json_encode($data, JSON_FORCE_OBJECT);
	}
    
    public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}
}
