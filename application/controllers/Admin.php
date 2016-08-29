<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $personNumPerPage;

	public function __construct(){
		parent::__construct();
		$this->auth->checkLogin();
        $this->load->model('admin_model');
        $this->personNumPerPage = 20;
	}

    //------------- 管理员管理 ---------------------------
    public function index(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'auth';
        $data['managerList'] = $this->admin_model->get_manager(array('status'=>1), $this->personNumPerPage, 0);
        $roleList = $this->admin_model->get_role();
        $data['roleList'] = $this->_roleFormat($roleList);
        $this->load->view('header', $data);
        $this->load->view('admin_index');
        $this->load->view('footer');
    }

    public function getManagerListAJAX(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $p = intval( $this->input->get_post('p') );
        if ($p==0) {
            $this->func->responseData(0, '参数错误');
        }
        $limit = $this->personNumPerPage;
        $offset = $limit*($p-1);
        $data = $this->admin_model->get_manager(array(), $limit, $offset);
        $this->func->responseData(1, '加载成功', $data);
    }

    public function edit(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'auth';
        $mid = intval( $this->input->get_post('id') );
        $data['managerInfo'] = $this->admin_model->get_manager(array('mid'=>$mid));
        $roleList = $this->admin_model->get_role();
        $data['roleList'] = $this->_roleFormat($roleList);
        $this->load->view('header', $data);
        $this->load->view('admin_edit');
        $this->load->view('footer');
    }
    

    public function addManager(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $data['username'] = trim( $this->input->post('username', true) );
        //检查用户名唯一性
        if( $this->_checkEmptyUser( array('username'=>$data['username']) ) == false ){
            $this->func->responseData(0, '用户名'.$data['username'].'已存在');
        }
        
        $data['name'] = trim( $this->input->post('name', true) );
        $data['rid'] = intval($this->input->post('role', true));
        $data['time'] = time();
        $data['status'] = 1;
        //生成密码
        $password = trim( $this->input->post('pwd', true) );
        $data['salt'] = $this->func->generateStr();
        $data['passwd'] = $this->func->encryptPwd($password, $data['salt']);
        
        if($this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错');
        }
        $mid = $this->admin_model->add_manager($data);
        $dataRes = $this->admin_model->get_manager(array('mid'=>$mid));
        //添加日志
        //$this->auth->wLog('act', array('title'=>'添加管理员', 'description'=>$data['name'].':'.$data['username'].'|'.$password.'|'.$data['rid'], 'actStatus'=>$status));
        $this->func->responseData(1, '操作成功', $dataRes);
    }

    public function managerStatus(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $mid = intval($this->input->post('mid'));
        if ($mid==1) {
            $this->func->responseData(0, '该用户不在三界内，请斟酌一下...');
        }
        $status = intval($this->input->post('status'));
        if (empty($mid)) {
            $this->func->responseData(0, '参数错误');
        }
        //$this->admin_model->del_manager($mid);
        $this->admin_model->update_manager(array('status'=>$status), $mid);
        //添加日志
        //$this->auth->wLog('act', array('title'=>'管理员操作', 'description'=>$mid, 'actStatus'=>$status));
        $this->func->responseData(1, '操作成功');
    }
    
    public function editManager(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $managerId = intval($this->input->post('mid', true));
        //检查用户是否存在
        if( $this->_checkEmptyUser( array('mid'=>$managerId) ) == true ){
            $this->func->responseData(0, '用户不存在');
        }
        $data['name'] = trim( $this->input->post('name', true) );
        $data['rid'] = intval($this->input->post('role', true));
        
        //超级管理员限制
        if ($managerId === 1 && $data['rid'] !== 1 ) {
            $this->func->responseData(0, '超级管理员不能更换角色！');
        }
        
        //修改密码
        $password = trim( $this->input->post('pwd', true) );
        if( !empty($password) ){
            $data['salt']   = $this->func->generateStr();
            $data['passwd'] = $this->func->encryptPwd($password, $data['salt']);
        }

        if($this->func->hasEmptyEle($data)==true){
            $this->func->responseData(0, '上传数据出错');
        }
        if( ($res = $this->admin_model->update_manager($data, $managerId)) === 1 ){
            $this->func->responseData(1, '操作成功', $res);
            //添加日志
            //$this->auth->wLog('act', array('title'=>'修改管理员信息', 'description'=>$managerId.':'.$data['name'].'|'.$password.'|'.$data['rid'], 'actStatus'=>$status));
        }else{
            $this->func->responseData(0, '数据暂无修改，请确认修改后再试一次～', $res);
        }
    }
    
    
    private function _checkEmptyUser($where){
        $user = $this->admin_model->get_manager( $where );
        return empty($user) ? true : false;
    }
    
    private function _roleFormat($rList){
        if(empty($rList)){
            return array();
        }
        $role = array();
        foreach($rList as $r){
            $role[$r['rid']] = $r['rname'];
        }
        return $role;
    }
    
    public function delManager(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $mid = intval($this->input->post('mid'));
        if (empty($mid)) {
            $this->func->responseData(0, '管理员ID错误');
        }
        if ($mid==1) {
            $this->func->responseData(0, '该用户不在三界内，请斟酌一下...');
        }
        //$this->admin_model->del_manager($mid);
        $this->admin_model->del_manager($mid);
        //添加日志
        //$this->auth->wLog('act', array('title'=>'管理员操作', 'description'=>$mid, 'actStatus'=>$status));
        $this->func->responseData(1, '操作成功');
    }
    
    //------------- 角色管理 ---------------------------
    public function role(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'role';
        $data['privileges'] = $this->admin_model->get_privilege();
        $rolePrivilege = $this->admin_model->get_role_privilege();
        $data['rolePrivilege'] = $this->_rolePrivilegeFormat($rolePrivilege);
        //var_dump($rolePrivilege);
        $this->load->view('header', $data);
		$this->load->view('admin_role');
		$this->load->view('footer');
    }
    
    public function addRole(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $data['rname'] = trim( $this->input->post('name', true) );
        $privilege = $this->input->post('role', true);
        //var_dump($privilege);exit;
        if ( empty($data) || empty($privilege) ) {
            $this->func->responseData(0, '上传数据出错');
        }else{
            $rid = intval( $this->admin_model->add_role($data) );
            if($rid > 0){
                foreach($privilege as $pid){
                    $this->admin_model->add_role_privilege(array('rid'=>$rid, 'pid'=>$pid));
                }
            }else{
                $this->func->responseData(0, '数据插入失败');
            }
        }
        
        //添加日志
        //$this->auth->wLog('act', array('title'=>'添加角色', 'description'=>$rid.':'.$data['rname'].'|'.( implode(',', $privilege) ), 'actStatus'=>$status));
        
        $this->func->responseData(1, '操作成功', $rid);
    }
    
    public function editRole(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $rid = intval( $this->input->post('rid', true) );
        $rname = trim( $this->input->post('name', true) );
        $privilege = $this->input->post('role', true);
        //var_dump($this->input->post());exit;
        $status = 0;
        if ( empty($rname) || empty($privilege) ) {
            $this->func->responseData(0, '上传数据出错');
        }else{
            $status = $this->admin_model->update_role_info($rid, $rname, $privilege);
        }
        //添加日志
        //$this->auth->wLog('act', array('title'=>'修改角色', 'description'=>$rid.':'.$rname.'|'.( implode(',', $privilege) ), 'actStatus'=>$status));
        if ($status) {
            $this->func->responseData(1, '操作成功', $rid);
        }else{
            $this->func->responseData(0, '数据操作失败，请刷新后再试一次～');
        }
    }
    
    public function delRole(){
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $rid = intval($this->input->post('rid', true));
        if ($rid==1) {
            $this->func->responseData(0, '该用户不可以删除');
        }
        if( $this->admin_model->del_role($rid) ){
            $this->func->responseData(1, '操作成功', $rid);
            //添加日志
            //$this->auth->wLog('act', array('title'=>'删除角色', 'description'=>$rid, 'actStatus'=>'ok'));
        }else{
            $this->func->responseData(0, '数据操作失败，请刷新后再试一次～');
        }
    }
    
    private function _rolePrivilegeFormat($rPri){
        if(empty($rPri)){
            return array();
        }
        $role = array();
        foreach($rPri as $r){
            $role[$r['rid']]['rname'] = $r['rname'];
            $role[$r['rid']]['pList'][$r['pid']] = $r['pname'];
        }
        return $role;
    }
    

    //------------- 权限列表 -----------------------------
    public function privilege()
    {
        if( $this->auth->checkManagerPrivilege('Admin', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'authPrivilege';
        $data['privileges'] = $this->admin_model->get_privilege();

        $this->load->view('header', $data);
        $this->load->view('admin_privilege');
        $this->load->view('footer');
    }

    //错误页面
    public function error($value='')
    {
        //$data['actNavBar'] = 'authError';
        $this->load->view('header');
        $this->load->view('admin_error');
        $this->load->view('footer');
    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */