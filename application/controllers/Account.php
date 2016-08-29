<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    
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
        $data['actNavBar'] = 'account';
        $agentList = $this->tickets_model->get_agent();
        $data['agentList'] = $this->_agentFormat($agentList);
        $ticketType = $this->tickets_model->get_ticket_type();
        $data['ticketType'] = $this->_ticketType($ticketType);

        //代理商统计
        $agentStats = $this->tickets_model->tickets_agent_stats();
        
        //用户实体卡注册统计
        $userRegStats = $this->tickets_model->tickets_reg_stats();
        $userRegStats = $this->_regUserFormat($userRegStats);
        //$data['userRegStats'] = $this->_regUserFormat($userRegStats);
        //充值统计
        $payStats = $this->tickets_model->tickets_pay_stats();
        //$data['payStats'] = $this->tickets_model->tickets_pay_stats();


        $_stats = array();
        foreach ($agentStats as $stats) {
            if (empty( $_stats[$stats['agent']]['all'] )) {
                $_stats[$stats['agent']]['all'] = 0;
            }
            $_stats[$stats['agent']]['all'] += $stats['all'];
            $_stats[$stats['agent']]['ticketStatus'][$stats['ticket_status']] = $stats['all'];
            $_stats[$stats['agent']]['wx_num'] = $userRegStats[$stats['agent']]['wx_num'];
            $_stats[$stats['agent']]['zfb_num'] = $userRegStats[$stats['agent']]['zfb_num'];
            //首冲统计...
            $_stats[$stats['agent']]['first_num'] = 0;
        }
        $data['stats'] = $_stats;

        $ticketStats = $this->tickets_model->tickets_stats();
        $data['ticketStats'] = $this->_ticketsStatsFormat($ticketStats);
        //$data['allTickets'] = $this->tickets_model->tickets_all();
        //var_dump( $data );
        $this->load->view('header', $data);
        $this->load->view('account_index');
        $this->load->view('footer');
    }

    private function _agentFormat($data=array())
    {
        $tmp = array();
        $tmp['CPG'] = 'CPG自营';
        foreach ($data as $d) {
            $tmp[$d['number']] = $d['name'];
        }
        return $tmp;
    }
    private function _regUserFormat($data=array())
    {
        $tmp = array();
        foreach ($data as $d) {
            if (empty($tmp[$d['agent']]['wx_num'])) {
                $tmp[$d['agent']]['wx_num'] = 0;
            }
            if (empty($tmp[$d['agent']]['zfb_num'])) {
                $tmp[$d['agent']]['zfb_num'] = 0;
            }
            if (!empty($d['wx_id'])) {
                $tmp[$d['agent']]['wx_num'] += 1;
            }
            if (!empty($d['zfb_id'])) {
                $tmp[$d['agent']]['zfb_num'] += 1;
            }
        }
        return $tmp;
    }
    private function _ticketsStatsFormat($data=array())
    {
        $tmp = array();
        foreach ($data as $d) {
            if (empty($tmp[$d['type']]['all'])) {
                $tmp[$d['type']]['all'] = 0;
            }
            $tmp[$d['type']]['all'] += $d['num'];
            $tmp[$d['type']]['stats'][$d['ticket_status']] = $d['num'];
        }
        return $tmp;
    }
    private function _ticketType($data=array())
    {
        $tmp = array();
        foreach ($data as $d) {
            $tmp[$d['type_code']] = $d['type_name'];
        }
        return $tmp;
    }

    //详细信息
    public function detail()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'account';
        $agentList = $this->tickets_model->get_agent();
        $data['agentList'] = $this->_agentFormat($agentList);
        $ticketType = $this->tickets_model->get_ticket_type();
        $data['ticketType'] = $this->_ticketType($ticketType);
        
        $type  = trim( $this->input->get('t', true) );
        $agent = trim( $this->input->get('a', true) );

        $data['ticketList'] = array();
        if (!empty($type)) {
            $data['ticketList'] = $this->tickets_model->get_tickets(array('type'=>$type));
            $this->load->view('header', $data);
            $this->load->view('account_detail_t');
            $this->load->view('footer');
        }elseif (!empty($agent)) {
            $data['ticketList'] = $this->tickets_model->get_tickets(array('agent'=>$agent, 'type'=>'zck_st'));
            $this->load->view('header', $data);
            $this->load->view('account_detail_a');
            $this->load->view('footer');
        }else{
            $this->load->view('header', $data);
            $this->load->view('account_detail_a');
            $this->load->view('footer');
        }
    }

    //获取注册卡详细信息
    public function getRegDetailInfoAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval( $this->input->post('id', true) );
        $detailInfo = $this->tickets_model->get_ticket_detail(array('reg_ticket_id'=>$tid));
        $this->func->responseData(1, 'ok', $detailInfo[0]);
    }

    //获取参赛卡详细信息
    public function getTicketDetailInfoAJAX($value='')
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $uid = intval( $this->input->post('id', true) );
        $detailInfo = $this->tickets_model->get_ticket_detail(array('uid'=>$uid));
        $this->func->responseData(1, 'ok', $detailInfo[0]);
    }


    //赛果
    public function game_prize()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'gamePrize';
        $data['prizeList'] = $this->tickets_model->get_game_prize();

        $this->load->view('header', $data);
        $this->load->view('account_game_prize');
        $this->load->view('footer');
    }

    public function addPrizeMemoAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Account', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $pid = intval( $this->input->post('id', true) );
        $memo = trim( $this->input->post('memo', true) );
        $res = $this->tickets_model->update_game_prize_memo($memo, $pid);
        if ($res) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '发生了什么未知的错误');
        }
    }


}
