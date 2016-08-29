<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();

        $this->load->model('match_model');
    }

    public function index()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'match';
        $data['matchList'] = $this->match_model->get_match_list(' l.status in (0,1,2,4) ');
        $this->load->view('header', $data);
        $this->load->view('match_list');
        $this->load->view('footer');
    }

    public function history()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'matchHis';
        $data['matchList'] = $this->match_model->get_match_history();
        $this->load->view('header', $data);
        $this->load->view('match_history');
        $this->load->view('footer');
    }

    //获取赛事列表
    public function getMatchListAJAX($value='')
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $p = intval($this->input->get_post('p'));
        if ( empty($p) ) {
            $this->func->responseData(0, '参数错误');
        }
        $limit  = 20;
        $offset = $limit*($p-1);
        $data   = $this->match_model->get_match_list('', $limit, $offset);
        $this->func->responseData(1, '获取数据成功', $data);
    }



    //赛事添加页面
    public function add()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'matchAdd';
        $data['matchType'] = $this->match_model->get_match_type(array('status'=>1));
        $data['matchMaps'] = $this->match_model->get_match_map(array('status'=>1));
        $this->load->view('header', $data);
        $this->load->view('match_add');
        $this->load->view('footer');
    }
    
    public function addMatchAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $data = array();
        $data['tid']   = trim( $this->input->post('mt', true) );
        $data['name']  = trim( $this->input->post('name', true) );
        $data['date']  = trim( $this->input->post('date', true) );
        $data['time']  = trim( $this->input->post('time', true) );
        $data['area']  = trim( $this->input->post('marea', true) );
        $data['prize'] = trim( $this->input->post('mprize', true) );
        $data['mapid'] = trim( $this->input->post('map', true) );
        $data['game_type']      = trim( $this->input->post('mgt', true) );
        $data['group_flag']     = trim( $this->input->post('group_flag', true) );
        $data['entry_ticket']   = trim( $this->input->post('mec', true) );
        $data['delayed_enroll'] = trim( $this->input->post('mde', true) );
        $data['start_condition']= trim( $this->input->post('msc', true) );

        //分桌配置
        $data['tab_type']       = intval( $this->input->post('tab_type', true) );
        $data['tab_num']        = intval( $this->input->post('tab_num', true) );
        $data['tab_min_seat']   = intval( $this->input->post('tab_min_seat', true) );
        $data['tab_new_tabs']   = intval( $this->input->post('tab_new_tabs', true) );
        $data['tab_reservation']= '';
        $data['status']= 0;

        $tab_reservation = $this->input->post('tab_reservation', true);
        if (!empty( $tab_reservation )) {
            $data['tab_reservation']= implode(',', $tab_reservation);
        }
        
        if ( $this->func->hasEmptyEle(array( $data['name'], $data['date'], $data['time'], $data['mapid'], $data['tid'], $data['entry_ticket'], $data['start_condition'], $data['game_type'], $data['prize'], $data['area'] ))==true ) {
            $this->func->responseData(0, '基本信息缺失', $data);
        }

        if ( $data['group_flag'] == 'main' && $this->func->hasEmptyEle(array( $data['tab_type'], $data['tab_num'], $data['tab_min_seat'], $data['tab_new_tabs']))==true ) {
            $this->func->responseData(0, '分桌配置信息缺失');
        }

        if ( $this->match_model->add_match_info($data) ) {
            $this->func->responseData(1, '添加赛事信息成功');
        }else{
            $this->func->responseData(0, '添加赛事信息失败', $data);
        }
    }

    //赛事添加页面
    public function edit()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $mid = intval( $this->input->get_post('id', true) );

        $data['actNavBar'] = 'matchEdit';

        $data['matchType'] = $this->match_model->get_match_type(array('status'=>1));
        $data['matchMaps'] = $this->match_model->get_match_map(array('status'=>1));
        $data['matchInfo'] = array();
        if (!empty( $mid )) {
            $matchInfo = $this->match_model->get_match_info(array('mid'=>$mid));
            if ( !empty( $matchInfo ) ) {
                $data['matchInfo'] = $matchInfo[0];
            }
        }

        $this->load->view('header', $data);
        $this->load->view('match_info');
        $this->load->view('footer');
    }

    public function editMatchAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $mid  = intval( $this->input->post('mid', true) );
        if (empty( $mid )) {
            $this->func->responseData(0, '赛事信息参数错误');
        }
        $data = array();
        $data['tid']   = trim( $this->input->post('mt', true) );
        $data['name']  = trim( $this->input->post('name', true) );
        $data['date']  = trim( $this->input->post('date', true) );
        $data['time']  = trim( $this->input->post('time', true) );
        $data['area']  = trim( $this->input->post('marea', true) );
        $data['prize'] = trim( $this->input->post('mprize', true) );
        $data['mapid'] = trim( $this->input->post('map', true) );
        $data['game_type']      = trim( $this->input->post('mgt', true) );
        $data['group_flag']     = trim( $this->input->post('group_flag', true) );
        $data['entry_ticket']   = trim( $this->input->post('mec', true) );
        $data['delayed_enroll'] = trim( $this->input->post('mde', true) );
        $data['start_condition']= trim( $this->input->post('msc', true) );

        //分桌配置
        $data['tab_type']       = intval( $this->input->post('tab_type', true) );
        $data['tab_num']        = intval( $this->input->post('tab_num', true) );
        $data['tab_min_seat']   = intval( $this->input->post('tab_min_seat', true) );
        $data['tab_new_tabs']   = intval( $this->input->post('tab_new_tabs', true) );
        $data['tab_reservation']= '';

        $tab_reservation = $this->input->post('tab_reservation', true);
        if (!empty( $tab_reservation )) {
            $data['tab_reservation']= implode(',', $tab_reservation);
        }

        if ( $this->func->hasEmptyEle(array( $data['name'], $data['date'], $data['time'], $data['mapid'], $data['tid'], $data['entry_ticket'], $data['start_condition'], $data['game_type'], $data['prize'], $data['area'] ))==true ) {
            $this->func->responseData(0, '基本信息缺失', $data);
        }

        if ( $data['group_flag'] == 'main' && $this->func->hasEmptyEle(array( $data['tab_type'], $data['tab_num'], $data['tab_min_seat'], $data['tab_new_tabs']))==true ) {
            $this->func->responseData(0, '分桌配置信息缺失');
        }

        if ( $this->match_model->update_match_info($data, array('mid'=>$mid)) ) {
            $this->func->responseData(1, '修改赛事信息成功');
        }else{
            $this->func->responseData(0, '修改赛事信息失败');
        }
    }

    public function updateMatchStatus()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE ){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $status = intval( $this->input->post('s', true) );
        $mid    = intval( $this->input->post('mid', true) );
        if (empty($mid)) {
            $this->func->responseData(0, '赛事信息参数错误');
        }
        //发布赛事前验证是否有计时器
        if ($status==1) {
            $timer = $this->match_model->get_match_timer(array('mid'=>$mid));
            if (empty( $timer )) {
                $this->func->responseData(0, '发布赛事需要添加计时器');
            }
        }
        if ( $this->match_model->update_match_info(array('status'=>$status), array('mid'=>$mid)) ) {
            $this->func->responseData(1, '修改赛事状态成功');
        }else{
            $this->func->responseData(0, '修改赛事状态失败');
        }
    }

    //赛事回收
    public function dustbin()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'matchDel';
        $data['matchList'] = $this->match_model->get_match_list('l.status = 9');
        $this->load->view('header', $data);
        $this->load->view('match_dustbin');
        $this->load->view('footer');
    }

    //下载人员名单
    public function downloads()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $mid = intval($this->input->get('id'));

        $header = array('编号', '姓名', '身份证号', '座位号');
        $data = $this->match_model->get_promotion_user(array('mid'=>$mid));
        //var_dump($data);exit;
        
        $this->func->excelExport($header, $this->_downloadDataFormat($data), 'CPGPlayers');
    }

    private function _downloadDataFormat($data=array())
    {
        $d = array();
        foreach ($data as $k => $v) {
            $d[$k][0] = $k+1;
            $d[$k][1] = ' '.$v['user_name'];
            $d[$k][2] = ' '.$v['user_card'];
            $d[$k][3] = ' '.$this->func->matchSeatFormat($v['match_seat']);
        }
        return $d;
    }

    //----------------------- 赛事系列 --------------------------------------

    public function type()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'matchType';
        $data['matchType'] = $this->match_model->get_match_type();
        $this->load->view('header', $data);
        $this->load->view('match_type');
        $this->load->view('footer');
    }

    //添加赛事系列
    public function addMatchTypeAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        //var_dump( $this->input->post() );
        $data['name'] = trim( $this->input->post('name', true) );
        $data['date'] = trim( $this->input->post('date', true) );
        $data['logo'] = trim( $this->input->post('logo', true) );
        if (empty($data['name']) || empty($data['date']) || empty($data['logo'])) {
            $this->func->responseData(0, '参数错误', $data);
        }
        $data['status'] = 1;
        $data['mtime'] = time();
        if ( $data['tid'] = $this->match_model->add_match_type($data) ) {
            $this->func->responseData(1, '添加赛事系列成功', $data);
        }else{
            $this->func->responseData(0, '添加赛事系列失败', $data);
        }
    }

    //修改赛事系列信息
    public function editMatchTypeAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $typeid = intval( $this->input->post('tid', true) );
        $data['name'] = trim( $this->input->post('name', true) );
        $data['date'] = trim( $this->input->post('date', true) );
        if ( empty($typeid) || empty($data['name']) || empty($data['date']) ) {
            $this->func->responseData(0, '参数错误', $data);
        }
        if ( $this->match_model->update_match_type($data, $typeid) ) {
            $this->func->responseData(1, '修改赛事系列信息成功');
        }else{
            $this->func->responseData(0, '修改赛事系列信息失败');
        }
    }

    //修改赛事系列状态
    public function updateMatchTypeAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $typeid = intval( $this->input->post('tid', true) );
        $data['status'] = intval( $this->input->post('s', true) );
        if ( empty($typeid) ) {
            $this->func->responseData(0, '参数错误');
        }
        if ( $this->match_model->update_match_type($data, $typeid) ) {
            $this->func->responseData(1, '修改赛事系列成功');
        }else{
            $this->func->responseData(0, '修改赛事系列失败');
        }
    }

    //----------------------- 赛场地图 --------------------------------------

    public function map()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'matchMap';
        $data['matchMaps'] = $this->match_model->get_match_map();
        $this->load->view('header', $data);
        $this->load->view('match_map');
        $this->load->view('footer');
    }


    //添加赛场地图
    public function addMatchMapAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        //var_dump( $this->input->post() );
        $data['name'] = trim( $this->input->post('name', true) );
        $data['addr'] = trim( $this->input->post('addr', true) );
        $data['map'] = trim( $this->input->post('map', true) );
        if (empty($data['name']) || empty($data['addr']) || empty($data['map'])) {
            $this->func->responseData(0, '参数错误', $data);
        }
        $data['status'] = 1;
        if ( $data['mapid'] = $this->match_model->add_match_map($data) ) {
            $this->func->responseData(1, '添加赛场地图成功', $data);
        }else{
            $this->func->responseData(0, '添加赛场地图失败', $data);
        }
    }

    //修改赛事地图信息
    public function updateMatchMapAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Match', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $mapid = intval( $this->input->post('mapid', true) );
        $data['status'] = intval( $this->input->post('s', true) );
        if ( empty($mapid) ) {
            $this->func->responseData(0, '参数错误');
        }
        /*
        $data['name'] = trim( $this->input->post('name', true) );
        $data['addr'] = trim( $this->input->post('addr', true) );
        $data['map']  = trim( $this->input->post('map', true) );
        if (empty($data['name']) || empty($data['addr']) || empty($data['map'])) {
            $this->func->responseData(0, '参数错误', $data);
        }
        */
        if ( $this->match_model->update_match_map($data, $mapid) ) {
            $this->func->responseData(1, '修改赛事地图成功');
        }else{
            $this->func->responseData(0, '修改赛事地图失败');
        }
    }

}
