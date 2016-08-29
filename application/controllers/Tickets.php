<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();

        $this->load->model('tickets_model');
    }

    public function index()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'tickets';
        $data['agentList'] = $this->tickets_model->get_agent();

        //发卡统计
        //$data['ticketsStats'] = $this->tickets_model->tickets_stats('');
        //发卡记录
        $data['ticketsLog'] = $this->tickets_model->tickets_release_log();
        $ticketType = $this->tickets_model->get_ticket_type();
        $data['ticketType'] = $this->_ticketType($ticketType);
        $this->load->view('header', $data);
        $this->load->view('tickets_list');
        $this->load->view('footer');
    }

    private function _ticketType($data=array())
    {
        $tmp = array();
        foreach ($data as $d) {
            $tmp[$d['type_code']] = $d['type_name'];
        }
        return $tmp;
    }

    //发行界面
    public function release()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'tickets';
        $data['agentList'] = $this->tickets_model->get_agent();
        $this->load->view('header', $data);
        $this->load->view('tickets_release');
        $this->load->view('footer');
    }

    public function downloads()
    {
        $releaseid = intval( $this->input->get('id') );
        if (empty( $releaseid )) {
            exit('发行ID错误');
        }
        $header = array('编号', '卡号', '密码');
        $data = $this->tickets_model->get_tickets(array('rid'=>$releaseid));
        //var_dump($data);exit;
        //更新下载次数&添加log
        $this->tickets_model->add_ticket_downloads($releaseid);

        $this->func->excelExport($header, $this->_downloadDataFormat($data));
    }

    private function _downloadDataFormat($data=array())
    {
        $d = array();
        foreach ($data as $k => $v) {
            $d[$k][0] = $k+1;
            $d[$k][1] = ' '.$v['number'];
            $d[$k][2] = ' '.$v['password'];
        }
        return $d;
    }

    //卡的详细界面
    public function release_log()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'tickets';
        $releaseid = intval( $this->input->get('id') );
        $data['ticketsList'] = $this->tickets_model->get_tickets(array('rid'=>$releaseid));
        $ticketType = $this->tickets_model->get_ticket_type();
        $data['ticketType'] = $this->_ticketType($ticketType);
        $this->load->view('header', $data);
        $this->load->view('tickets_release_log');
        $this->load->view('footer');
    }

    //获取发卡类型
    public function getTicketTypeAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $type = intval( $this->input->post('t') );
        $ticketType = $this->tickets_model->get_ticket_type(array('card_type'=>$type));
        $this->func->responseData(1, '', $ticketType);
    }

    public function updateTicketStatusAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid    = intval( $this->input->post('id') );
        $status = intval( $this->input->post('s') );
        if (empty($tid)) {
            $this->func->responseData(0, '卡号不能为空');
        }else{
            $this->tickets_model->update_ticket_info(array('ticket_status'=>$status), array('tid'=>$tid));
            $this->func->responseData(1, '操作成功');
        }
    }

    //添加代理商
    public function addAgentAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }

        $data = array();
        $data['number']  = trim( $this->input->post('num', true) );
        $data['name']    = trim( $this->input->post('name', true) );

        if ( empty( $data['number'] ) ) {
            $this->func->responseData(0, '请填写代理商编号');
        }
        if ( empty( $data['name'] ) ) {
            $this->func->responseData(0, '请填写代理商姓名');
        }
        $aid = $this->tickets_model->add_agent($data);
        if ( $aid > 0 ) {
            $this->func->responseData(1, '添加代理商成功', array('aid'=>$aid));
        }else{
            $this->func->responseData(0, '添加代理商失败', $data);
        }
    }

    //修改代理商状态
    public function updateAgentAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }

        $aid  = intval( $this->input->post('id', true) );
        $name = trim( $this->input->post('name', true) );

        if ( empty( $aid ) ) {
            $this->func->responseData(0, '代理商信息错误');
        }

        if ( $this->tickets_model->update_agent(array('name'=>$name), array('aid'=>$aid)) ) {
            $this->func->responseData(1, '修改成功');
        }else{
            $this->func->responseData(0, '修改失败');
        }
    }

    public function ticketsRelease()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $userInfo = $this->auth->getUserInfo();

        $card_type    = intval( $this->input->post('ct') );
        $ticket_type  = trim( $this->input->post('tt', true) );
        $ticket_agent = trim( $this->input->post('ta', true) );
        $ticket_num   = intval( $this->input->post('tn') );

        if (empty( $ticket_type ) || empty( $ticket_num )) {
            $this->func->responseData(0, '发卡类型或发卡数量错误');
        }
        if ( $ticket_type=='zck_st' && empty($ticket_agent)) {
            $this->func->responseData(0, '代理商不能为空');
        }
        if (empty($ticket_agent)) {
            $ticket_agent = 'CPG';
        }

        $date = date('ym');
        $pubCodeCfg = array(
            //'zck_wx'    =>'1000',
            //'zck_zfb'   =>'2000',
            'zck_st'    =>'0000',
            'tyk_1'     =>'0010',
            'tyk_5'     =>'0050',
            'tyk_20'    =>'0200',
            'tyk_60'    =>'0600',
            'csk_1'     =>'1200',
            'csk_2'     =>'2400',
            'csk_3'     =>'3600',
            'csk_4'     =>'4800',
            'csk_6'     =>'6000',
            'cpg_a'     =>'0001',
            'cpg_b'     =>'0002',
            'cpg_c'     =>'0003'
        );
        
        $pub_code = $pubCodeCfg[$ticket_type];
        if (empty( $pub_code )) {
            $this->func->responseData(0, '卡类型错误');
        }
        
        $lastPubCard = $this->tickets_model->tickets_release_log(array('type'=>$ticket_type, 'date_no'=>$date));
        if (empty( $lastPubCard )) {
            $start_no = 1;
        }else{
            $start_no = intval($lastPubCard[0]['end_no']) + 1;
        }
        $end_no = $ticket_num + $start_no - 1;

        if ( $end_no > 999999 ) {
            $this->func->responseData(0, '发卡数量超过本月上限('.$start_no.'-'.$end_no.')');
        }

        $pub_time = time();

        $ticket_pub_data = array('type'=>$ticket_type, 'agent'=>$ticket_agent, 'num'=>$ticket_num, 'date_no'=>$date, 'start_no'=>$start_no, 'end_no'=>$end_no, 'status'=>0, 'operator'=>$userInfo['name'], 'uid'=>$userInfo['uid'], 'pub_time'=>$pub_time, 'desc'=>'发行新卡.代理［'.$ticket_agent.'］,数量［'.$ticket_num.'］,编号['.$start_no.'-'.$end_no.']');
        $release_id = $this->tickets_model->add_ticket_release($ticket_pub_data);
        //卡号前缀
        $prefix = $ticket_agent=='CPG' ? 1 : 2;
        $prefix .= $card_type.$pub_code.$date;
        
        //$cards = array(); //debug
        for ($i=$start_no; $i <= $end_no; $i++) { 
            $card_no  = $this->_cardNo( $i );
            $card_pwd = $this->func->generateStr(8,'',0,'0123456789');
            //$cards[]  = 'card:'.$prefix.$card_no.', pwd:'.$card_pwd.'<br>';

            //插入数据操作
            $data = array('type'=>$ticket_type, 'number'=>$prefix.$card_no, 'password'=>$card_pwd, 'ticket_status'=>0, 'pub_time'=>$pub_time, 'agent'=>$ticket_agent, 'rid'=>$release_id);
            if ( !$this->tickets_model->add_ticket($data) ) {
                $this->func->responseData(0, '发卡过程出现错误，请联系管理员', array('pubData'=>$ticket_pub_data));
            }
        }
        $this->tickets_model->update_ticket_release(array('status'=>1), array('id'=>$release_id));
        $ticket_pub_data['status'] = 1;

        $this->func->responseData(1, '操作成功，即将返回发卡记录列表');
    }

    private function _cardNo($n=0)
    {
        $len = 6 - strlen($n);
        if ($len < 1) {
            return $n;
        }
        $code = '';
        for ($i=0; $i < $len; $i++) { 
            $code .= '0';
        }
        return $code.$n;
    }






}
