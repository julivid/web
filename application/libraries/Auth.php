<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth {
    /**
     * Authority management controller.
     *
     * This controller used for authority.
     * Check privilege for each user, get the user`s option menu.
     * 
     * @auth    zhuliwei at 2015-05-23 09:50:36
     * 
     */
    private $_CI;

    function __construct(){
        $this->_CI = &get_instance();
    }


    //写日至
    public function wLog($type='log', $action='add a log'){
        $this->_CI->load->model('log_model');
        return $this->_CI->log_model->add_act_log(array('type'=>$type, 'action'=>$action, 'logTime'=>time()));
    }

    //验证用户登录
    public function checkLogin(){
        $isLogin = $this->_CI->session->userdata('isLogin');
        if(empty($isLogin) || $isLogin!==TRUE){
            $this->_CI->load->helper('url');
            //redirect(base_url('Login').'?redirect='.urlencode($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']));
            redirect(base_url('Login'));
        }
    }

    //获取用户session信息
    public function getUserInfo(){
        $this->checkLogin();
        $user = $this->_CI->session->all_userdata();
        $data['uid'] = $user['uid'];
        $data['uname'] = $user['uname'];
        $data['name'] = $user['name'];
        $data['rid'] = $user['rid'];
        $data['last_time'] = $user['last_time'];
        $data['last_ip'] = $user['last_ip'];
        return $data;
    }

    //验证权限
    public function checkManagerPrivilege($ctl, $method){
        $userInfo = $this->getUserInfo();
        $this->_CI->load->model('admin_model');
        return $this->_CI->admin_model->check_manager_privilege($userInfo['uid'], $ctl, $method);
    }

    //获取用户权限功能列表
    public function getUserMenu()
    {
        $rid = $this->getUserInfo()['rid'];
        $this->_CI->load->model('admin_model');
        $rolePrivilege = $this->_CI->admin_model->get_role_privilege();
        $menu = array();
        foreach ($rolePrivilege as $k=>$p) {
            if ($p['rid']==$rid) {
                $menu[$p['pctl']][$k] = $p['pmethod'];
            }
        }
        return $menu;
    }

    /*
    function set_user_session($userInfo){
        $this->_CI->session->set_userdata($userInfo);
    }

    function getUserName(){
        $this->set_user_session(array('user'=>array('username'=>'test_user')));
        $user = $this->_CI->session->userdata('user');
        $username = $user['username'];
        return $username;
        //return 'test_user';
    }

    

    function getUserMenu(){
        $username = $this->getUserName();
        $user_privileges = $this->_CI->auth_model->get_user_privileges($username);
        
        return $this->_FormatPrivilege2Menu($user_privileges);
    }


    function checkUserPrivilege($privilege){
        $username = $this->getUserName();
        return $this->_CI->auth_model->check_user_privilege($username, $privilege);
    }

    function allPrivileges(){
        $allPrivileges = $this->_CI->auth_model->get_privileges_list();
        return $this->_FormatPrivilege2Menu($allPrivileges);
    }

    function getRolePrivilege($rid){
        $d = array();
        $result = $this->_CI->auth_model->get_role_privileges($rid);
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $d[$key] = $value['pid'];
            }
        }
        return $d;
    }

    function grantRolePrivileges($pList, $rid){
        //删除gid所有权限
        $this->revokeRolePrivileges($rid);
        //添加新权限
        $privileges = array();
        foreach ($pList as $k => $p) {
            $privileges[$k] = array('rid'=>$rid, 'pid'=>$p);
        }
        return $this->_CI->auth_model->grant_role_privileges($privileges);
    }

    function revokeRolePrivileges($rid){
        return $this->_CI->auth_model->revoke_role_privileges($rid);
    }

    //格式化权限功能菜单对应数组，便于前台展示
    private function _FormatPrivilege2Menu($p){
        $data = array(); // var_dump($p);
        $i = 0;
        if (!empty($p)) {
            foreach ($p as $privilege) {
                if (!isset($data[$privilege['pctl']])) {
                    $i = 0;
                    $data[$privilege['pctl']]['title'] = $privilege['pcname'];
                    $data[$privilege['pctl']]['code'] = $privilege['pctl'];
                }

                $data[$privilege['pctl']]['list'][$i]['id'] = $privilege['pid'];
                $data[$privilege['pctl']]['list'][$i]['title'] = $privilege['pname'];
                $data[$privilege['pctl']]['list'][$i]['code'] = $privilege['pact'];
                $i++;
            }
        }
        return $data;
    }
*/

}






/* End of file auth.php */
/* Location: ./application/libraries/auth.php */