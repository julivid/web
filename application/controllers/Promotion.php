<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->auth->checkLogin();
        $this->load->model('match_model');
    }

	public function index()
	{
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'promotion';
        $data['matchList'] = $this->match_model->get_match_list('l.entry_ticket = "jjs" AND l.status < 9 AND l.status != 3');
        $this->load->view('header', $data);
        $this->load->view('match_promotion');
        $this->load->view('footer');
	}

    public function add_player()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'promotion';
        $mid = intval( $this->input->get('id') );
        $data['playerList'] = $this->match_model->get_promotion_user(array('mid'=>$mid));
        $data['matchInfo'] = $this->match_model->get_match_info(array('mid'=>$mid));
        $data['matchType'] = array();

        $matchType = $this->match_model->get_match_type(array('status'=>1));
        foreach ($matchType as $mt) {
            $data['matchType'][$mt['tid']] = $mt['name'];
        }

        //var_dump( $data['matchInfo'],$data['matchType'],$data['playerList'] );exit();
        $this->load->view('header', $data);
        $this->load->view('promotion_add_player');
        $this->load->view('footer');
    }

    public function info()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'Promotion';

        $uid = intval( $this->input->get('id') );
        $data['PromotionDetail'] = $this->promotion_model->get_Promotion( array('uid'=>$uid) );

        $this->load->view('header', $data);
        $this->load->view('Promotion_info');
        $this->load->view('footer');
    }

    public function edit()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'Promotion';

        $uid = intval( $this->input->get('id') );
        $data['PromotionDetail'] = $this->promotion_model->get_Promotion( array('uid'=>$uid) );

        $this->load->view('header', $data);
        $this->load->view('Promotion_edit');
        $this->load->view('footer');
    }

    public function downloads()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
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

    //-------- 处理操作 --------------
    public function getUserInfoAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $t = intval( $this->input->post('t') );
        $code = trim( $this->input->post('code', true) );
        $card = trim( $this->input->post('card', true) );
        if ($t == 1) {
            if ( empty($code) || strlen($code) != 40) {
                $this->func->responseData(0, '二维码错误');
            }
            $data = $this->match_model->get_promotion_user(array('qr_code'=>$code));
            if (empty($data)) {
                $this->func->responseData(0, '无该用户信息');
            }
            $this->func->responseData(1, '获取成功', $data[0]);
        }

        if ($t == 2) {
            if ( empty($card) ) {
                $this->func->responseData(0, '身份证错误');
            }
            $data = $this->match_model->get_promotion_user(array('user_card'=>$card));
            if (empty($data)) {
                $this->func->responseData(0, '无该用户信息');
            }
            $this->func->responseData(1, '获取成功', $data[0]);
        }
        
        $this->func->responseData(0, '查询类型错误');
    }


    public function delPlayerAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $id = intval( $this->input->post('id', true) );
        if (empty( $id )) {
            $this->func->responseData(0, '用户信息错误');
        }
        if ($this->match_model->del_promotion_user($id)) {
            $this->func->responseData(1, '删除成功');
        }else{
            $this->func->responseData(0, '删除失败');
        }
    }

    public function addPlayerAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $code  = trim( $this->input->post('code', true) );
        $mid   = intval( $this->input->post('mid', true) );
        $chips = trim( $this->input->post('chips', true) );

        if (empty( $chips )) {
            $this->func->responseData(0, '筹码数量错误');
        }

        $userInfo = $this->match_model->get_promotion_user(array('qr_code'=>$code));
        if (empty( $userInfo )) {
            $this->func->responseData(0, '用户信息无效');
        }

        $hasMatched = $this->match_model->get_promotion_user(array('uid'=>$userInfo[0]['uid'], 'mid'=>$mid));
        if ( !empty($hasMatched) ) {
            $this->func->responseData(0, '用户已参加该赛事');
        }
        //报名数据
        $data = array();
        $data['uid'] = $userInfo[0]['uid'];
        $data['tid'] = intval($userInfo[0]['tid']);
        $data['mid'] = $mid;
        $data['chips'] = $chips;
        $data['enroll_type'] = '3';
        $data['enroll_fee']  = 'jjs';
        $data['enroll_time'] = time();

        $data['user_name'] = $userInfo[0]['user_name'];
        $data['user_card'] = $userInfo[0]['user_card'];
        //生成赛事二维码［唯一］
        $data['qr_code'] = $this->func->encryptPwd($mid.$data['uid'].$data['enroll_time'], 'HuanaoBeijing');

        if ($this->match_model->add_promotion_user($data)) {
            $this->func->responseData(1, '添加成功', $data);
        }else{
            $this->func->responseData(0, '添加失败');
        }
    }

    //晋级赛分桌------计算筹码量
    public function randomTableAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $mid = intval( $this->input->post('mid', true) );
        $tab_type = intval( $this->input->post('tab_type', true) );
        $tab_start_num = intval( $this->input->post('tab_start', true) );
        $players = $this->match_model->get_promotion_user(array('mid'=>$mid));
        $playersNum = count( $players );
        if (empty( $tab_start_num )) {
            $this->func->responseData(0, '起始牌桌不能为空');
        }
        if (empty( $players )) {
            $this->func->responseData(0, '无参赛人员，分桌停止');
        }
//var_dump( count($players) );exit();
        $tableNumArr = $this->_randTab($playersNum, $tab_type);
        
        foreach($players as $k=>$v){
            //更新数据
            $tableNum = array_pop($tableNumArr);
            $tableNum = $this->_newTabNum($tableNum, ($tab_start_num-1) );//更换新座位，从20桌起
            $where = array('id'=>$v['id']);
            $res = $this->match_model->update_promotion_user($where, array('match_seat'=>$tableNum));
            if($res < 1){
                $this->func->responseData(0, '分桌失败');
            }
        }

        //计算筹码量
        $allChips = $this->match_model->get_promotion_chips($mid);
        $initChips =  ceil( $allChips[0]['all_chips'] / $playersNum );
        //var_dump( $allChips, $playersNum);exit;
        //查找所有参赛人数
        $allPlayers = $this->match_model->get_promotion_all_players($players[0]['tid']);
        $this->load->model('timer_model');
        $this->timer_model->update_timer(array('initial_chips'=>$initChips, 'total_player'=>$allPlayers, 'left_player'=>$playersNum), array('mid'=>$mid));
        $this->match_model->update_match_info(array('enroll_players'=>$allPlayers), array('mid'=>$mid));

        $this->func->responseData(1, '分桌成功');
    }

    //如果需要更换桌号，如：从10桌开始排
    private function _newTabNum($tab = 10, $newTabNo = 0){
        $s = intval(mb_substr($tab, -1)); //座位号
        $t = intval(mb_substr($tab, 0, strlen($tab)-1)); //桌号
        return ( intval($t)+intval($newTabNo) ).$s;
    }

    //生成所有桌号
    private function _randTab($seatCount, $tabType=10){
        $tabs = ceil($seatCount/$tabType); //总桌数
        $diff = $seatCount%$tabType; //按序排的情况下最后一桌剩余人数
        $tabUnFull = $diff==0 ? 0 : ($tabType - $diff); //人数不满的桌数, 如果最后一桌剩余人数为0，则都是满桌
        
        $tabFull = $tabs - $tabUnFull; //满人数桌数
        
        $seats = array();
        //如果有满桌,则继续分桌；否则，递归处理，平均分桌
        if($tabFull > 0){
            //满桌座位号
            for($t=1; $t<=$tabFull; $t++){
                for($s=0; $s<$tabType; $s++){
                    $seats[] = $t.$s;
                }
            }
            //不满桌座位号
            for($t=$tabFull+1; $t<=$tabs; $t++){
                for($s=0; $s<($tabType-1); $s++){
                    $seats[] = $t.$s;
                }
            }
            shuffle($seats);
            return $seats;
        }else{
            return $this->_randTab($seatCount, $tabType-1);
        }
    }



}
