<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timer extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('timer_model');
        $this->load->model('match_model');
    }

    //计时器列表
    public function index()
    {
        $this->auth->checkLogin();
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'timer';
        $data['timerList'] = $this->timer_model->get_timer_list();
        $matchType = $this->match_model->get_match_type(array('status'=>1));
        $data['matchType'] = $this->_formatMatchType($matchType);
        $this->load->view('header', $data);
        $this->load->view('timer_index');
        $this->load->view('footer');
    }

    private function _formatMatchType($data=array())
    {
        if (empty($data)) {
            return $data;
        }
        $arr = array();
        foreach ($data as $d) {
            $arr[$d['tid']] = $d['name'];
        }
        return $arr;
    }

    //添加计时器
    public function add()
    {
        $this->auth->checkLogin();
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $data['actNavBar'] = 'timerAdd';
        $data['matchList'] = $this->match_model->get_match_list($where='l.status < 9 AND l.status != 3', 0,0, $all=TRUE);
        //var_dump( $data['matchList'] );
        $hasTimerMatch = array();
        $timerList = $this->timer_model->get_match_timer();
        //var_dump( $timerList );
        foreach ($timerList as $t) {
            $hasTimerMatch[] = $t['mid'];
        }
        //$hasTimerMatch = array_unique($hasTimerMatch);
        $data['hasTimerMatch'] = $hasTimerMatch;

        $this->load->view('header', $data);
        $this->load->view('timer_add');
        $this->load->view('footer');
    }

    //计时器显示
    public function monitor()
    {
        $tid = intval( $this->input->get('id') );
        if (empty( $tid )) {
            echo 'Data error...';exit;
        }
        $data = $this->getLevelData($tid);
        //var_dump( $data );
        //$this->load->view('timer_start', $data);
        $this->load->view('timer_monitor', $data);
    }

    //计时器控制
    public function control()
    {
        $this->auth->checkLogin();
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $tid = intval( $this->input->get('id') );
        $data['actNavBar']  = 'timer';
        $data['timerInfo']  = $this->timer_model->get_timer_list($tid);
        $data['blindsInfo'] = $this->timer_model->get_timer_blinds($tid);
        $data['matchInfo']  = $this->match_model->get_match_info(array('mid'=>$data['timerInfo'][0]['mid']));
        //var_dump( $data );exit;
        $this->load->view('header', $data);
        $this->load->view('timer_control');
        $this->load->view('footer');
    }

    //盲注列表－－修改界面
    public function blinds()
    {
        $this->auth->checkLogin();
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            redirect(base_url('Admin/error'));
        }
        $tid = intval( $this->input->get('id') );
        $data['actNavBar'] = 'timer';
        $timerInfo  = $this->timer_model->get_timer_list($tid);
        //$blindsInfo = $this->timer_model->get_timer_blinds($tid);
        $data['timerInfo'] = $timerInfo[0];
        $data['blindsInfo']= $this->timer_model->get_timer_blinds($tid);
        $data['timerId']   = $tid;
        $this->load->view('header', $data);
        $this->load->view('timer_edit');
        $this->load->view('footer');
    }


    //---------------------- AJAX 操作 -------------------------
    //添加计时器
    public function addTimer()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $timer = $this->input->post(array('mid', 'initial_chips', 'blinds_raise_time'), true);
        if($this->func->hasEmptyEle($timer)==true){
            $this->func->responseData(0, '基础数据出错');
        }
        $timer['left_player'] = $timer['total_player'] = 0;

        $blinds['blinds_level'] = $this->input->post('blinds_level', true);
        $blinds['blinds_ante']  = $this->input->post('blinds_ante', true);
        $blinds['blinds_num']   = $this->input->post('blinds_num', true);
        $blinds['break_time']   = $this->input->post('break_time', true);
        if ($this->timer_model->add_timer($timer, $blinds)) {
            $this->func->responseData(1, '添加成功');
        }else{
            $this->func->responseData(0, '添加失败');
        }
    }

    //修改计时器盲注列表
    public function editTimerBlinds()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval( $this->input->post('tid', true) );
        if(empty( $tid )){
            $this->func->responseData(0, '上传数据出错');
        }

        $blinds['blinds_level'] = $this->input->post('blinds_level', true);
        $blinds['blinds_ante']  = $this->input->post('blinds_ante', true);
        $blinds['blinds_num']   = $this->input->post('blinds_num', true);
        $blinds['break_time']   = $this->input->post('break_time', true);
        if ($this->timer_model->edit_timer_blinds($tid, $blinds)) {
            $this->func->responseData(1, '添加成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    //获取级别盲注表
    public function getTimerBlinds()
    {
        $tid = intval( $this->input->post('tid') );
        $data = $this->timer_model->get_timer_blinds($tid);
        $this->func->responseData(1, 'ok', $data);
    }

    //修改计时器信息－－v2无用，禁止修改名称
    /*
    public function editTimer()
    {
        if( $this->auth->checkManagerPrivilege('Timer', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));
        $match_name = $this->input->post('match_name', true);

        if(empty($tid) || empty($match_name)){
            $this->func->responseData(0, '上传数据出错');
        }
        
        if ($this->db_model->update_data('cpg_timer', array('tid'=>$tid), array('match_name'=>$match_name))) {
            $this->db_model->add_data('cpg_timer_log', array('tid'=>$tid, 'log_type'=>'chg_match_name', 'log_time'=>time(), 'log_content'=>$match_name));
            $this->sendSocketData($tid, array('type'=>'change_name', 'data'=>$match_name) );
            $this->func->responseData(1, '修改成功');
        }else{
            $this->func->responseData(0, '修改无效/修改失败');
        }
    }
    */



    //---------------------- 控制 [Start] ------------------------------------
    //开始比赛
    public function startMatch()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));
        $timerInfo = $this->timer_model->get_timer_list($tid); //var_dump( $timerInfo );exit;
        if (empty( $timerInfo )) {
            $this->func->responseData(0, '无赛事计时器信息，或参数错误');
        }
        //验证赛事状态，未发布赛事不允许开始
        $this->_checkMatchStatus( $timerInfo[0]['mid'] );

        $timerLog = $this->timer_model->get_timer_log( array('tid'=>$tid) );
        
        $mid = 0; //只更新计时器状态
        
        if ( empty( $timerLog ) ) {
            $mid = $timerInfo[0]['mid']; //开始比赛，同时更新计时器状态和赛事状态
        }

        if ( $this->timer_model->start_match($tid, $mid) ) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    private function _checkMatchStatus($mid=0)
    {
        if (empty($mid)) {
            $this->func->responseData(0, '赛事信息错误');
        }
        $matchInfo = $this->match_model->get_match_info(array('mid'=>$mid));
        if (empty($matchInfo[0]['status'])) {
            $this->func->responseData(0, '请先发布赛事');
        }
    }

    //暂停比赛
    public function pauseMatch()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));

        if ( $this->timer_model->pause_match($tid) ) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }

    }

     //结束比赛
    public function matchOver()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));
        $timerInfo = $this->timer_model->get_timer_list($tid); //var_dump( $timerInfo );exit;

        if ( $this->timer_model->match_over($tid, $timerInfo[0]['mid']) ) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }

    }

    //显示图片
    public function showMainPhoto()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));

        if ( $this->timer_model->update_timer( array('show_photo'=>1), array('tid'=>$tid) ) ) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    //显示计时器
    public function showMainTimer()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));

        if ( $this->timer_model->update_timer( array('show_photo'=>0), array('tid'=>$tid) ) ) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    //修改涨盲时间
    public function editBlindsRaiseTimeAJAX()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));
        $time = intval($this->input->post('time'));
        if (empty($tid) || empty($time)) {
            $this->func->responseData(0, '时间不能为0');
        }
        if ( $this->timer_model->update_timer( array('blinds_raise_time'=>$time), array('tid'=>$tid) ) ) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    //更新人数
    public function playerChangeNum()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid  = intval($this->input->post('tid'));
        $timerInfo = $this->timer_model->get_timer_list($tid); 
        if (empty( $timerInfo )) {
            $this->func->responseData(0, '无赛事信息，或参数错误');
        }
        $type = $this->input->post('type', true);
        switch ($type) {
            case 'L-':
                $res = $this->timer_model->update_timer( array('left_player'=>($timerInfo[0]['left_player']-1)), array('tid'=>$tid) );
                break;
            case 'L+':
                $res = $this->timer_model->update_timer( array('left_player'=>($timerInfo[0]['left_player']+1)), array('tid'=>$tid) );
                break;
            case 'T+':
                $res = $this->timer_model->update_timer( array('total_player'=>($timerInfo[0]['total_player']+1)), array('tid'=>$tid) );
                break;
            case 'T-':
                $res = $this->timer_model->update_timer( array('total_player'=>($timerInfo[0]['total_player']-1)), array('tid'=>$tid) );
                break;
            case 'P+':
                $res = $this->timer_model->update_timer( array('prize_player'=>($timerInfo[0]['prize_player']+1)), array('tid'=>$tid) );
                break;
            case 'P-':
                $res = $this->timer_model->update_timer( array('prize_player'=>($timerInfo[0]['prize_player']-1)), array('tid'=>$tid) );
                break;
        }
        if (!empty($res)) {
            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    //启动新级别－－启动后自动计时
    public function startNewLevel()
    {
        if( $this->auth->checkManagerPrivilege('Manager', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid   = intval($this->input->post('tid'));
        $index = intval($this->input->post('level_index'));
        //更换新级别后，计时器状态为自动计时中
        if( $this->timer_model->chg_timer_level(array('current_level_index'=>$index, 'timer_status'=>1), $tid) ){

            $this->_checkMatchEnrollStatus($tid, $index); //检查赛事报名状态

            $this->func->responseData(1, '操作成功');
        }else{
            $this->func->responseData(0, '操作失败');
        }
    }

    public function _checkMatchEnrollStatus($timerid='', $curIndex=0)
    {
        $timerInfo = $this->timer_model->get_timer_list($timerid);
        $matchInfo = $this->match_model->get_match_info(array('mid'=>$timerInfo[0]['mid']));
        //进行中的赛事截止报名
        if ( $matchInfo[0]['status'] < 3 && $matchInfo[0]['delayed_enroll'] <= $curIndex ) { 
            $this->match_model->update_match_info(array('status'=>4), array('mid'=>$timerInfo[0]['mid']));
        }
    }
    
    //---------------------- 控制 [End] ------------------------------------

    //公共
    public function getTimerDataAJAX()
    {
        $tid = intval( $this->input->get_post('tid') );
        if (empty($tid)) {
            $this->func->responseData(0, '获取数据失败');
        }
        $data = $this->getLevelData($tid);
        unset($data['match_id']);
        unset($data['match_name']);
        unset($data['match_status']);
        unset($data['match_title']);
        $this->func->responseData(1, 'ok', $data);
    }

    //获取下一级别信息
    public function getNextLevelData()
    {
        $tid = intval( $this->input->get_post('tid') );
        //$cur_level = intval( $this->input->get_post('cur_l') );
        if (empty($tid)) {
            $this->func->responseData(0, '获取数据失败');
        }

        $timerInfo = $this->timer_model->get_timer_list($tid);
        $cur_level = $timerInfo[0]['current_level_index'];

        $hasNextLevel = false;
        $nextLevel = $cur_level+1;
        $blindsInfo = $this->timer_model->get_timer_blinds($tid);
        
        foreach ($blindsInfo as $blinds) {
            if($nextLevel == $blinds['index']){ //存在下一个级别
                $hasNextLevel = true;
            }
        }
        //没有下一个级别列表的时候赛事结束
        if ($hasNextLevel == false) {
            $this->timer_model->update_timer(array('timer_status'=>3), array('tid'=>$tid));
            $this->func->responseData(2, '比赛结束');
        }
        //更新到下一级别并返回下一级别数据
        if( $this->timer_model->chg_timer_level(array('current_level_index'=>$nextLevel, 'timer_status'=>1), $tid) ){
            $data = $this->getLevelData($tid);
            
            $this->_checkMatchEnrollStatus($tid, $nextLevel); //检查赛事报名状态

            $this->func->responseData(1, 'ok', $data);
        }else{
            $this->func->responseData(0, '启动下一级别失败');
        }
        
    }
    /*
    //自动ajax获取下一个级别数据?
    public function nextMatchLevelData()
    {
        if( $this->auth->checkManagerPrivilege('Timer', 'index') !== TRUE){
            $this->func->responseData(0, '对不起，您没有权限进行此操作');
        }
        $tid = intval($this->input->post('tid'));
        $level = intval($this->input->post('level'));

        $timerInfo = $this->db_model->get_data('cpg_timer', array('tid'=>$tid));
        if (empty( $timerInfo )) {
            $this->func->responseData(0, '无赛事信息，或参数错误');
        }
        if ($level == $timerInfo[0]['current_level_index']) {
            $nextLevelIndex = $timerInfo[0]['current_level_index']+1;
            //开启下一个级别，并重新记录时间
            $this->db_model->update_data( 'cpg_timer', array('tid'=>$tid), array('current_level_index'=>$nextLevelIndex, 'last_log_time'=>time()) );
        }
        
        $this->db_model->add_data('cpg_timer_log', array('tid'=>$tid, 'log_type'=>'chg_match_level', 'log_time'=>time(), 'log_content'=>$nextLevelIndex));
        
        $data = $this->getLevelData($tid);
        //$this->sendSocketData($tid, array('type'=>'new_level', 'data'=>$data) );
        $this->func->responseData(1, 'ok', $data);
    }*/

    //获取某场赛事当前级别的监控数据
    private function getLevelData($tid){
        $matchType  = $this->match_model->get_match_type(array('status'=>1));
        $timerInfo  = $this->timer_model->get_timer_list($tid);
        $blindsInfo = $this->timer_model->get_timer_blinds($tid);
        $blindsInfo = $this->_timerBlindsFormat($blindsInfo);

        //var_dump( $matchType, $timerInfo, $blindsInfo);exit;
        //计时器主要信息
        $timer = $timerInfo[0];

        $data['match_title'] = '未知赛事';
        foreach ($matchType as $mt) {
            if ($mt['tid'] == $timerInfo[0]['match_type']) {
                $data['match_title'] = $mt['name'];
            }
        }
        $data['match_name']   = $timer['name'];
        $data['match_id']     = $timer['mid'];
        $data['timer_id']     = $tid;
        
        $data['match_status'] = $timer['match_status']; //0-未发布，1-报名中，2－进行中，3-已结束
        $data['timer_status'] = $timer['timer_status']; //0-未计时，1-计时中，2－暂停中，3-已结束
        $data['show_photo']   = $timer['show_photo'];
        $data['prize_player'] = $timer['prize_player'];
        $data['total_player'] = $timer['total_player'];
        $data['left_player']  = $timer['left_player'];
        $data['total_chips']  = $timer['initial_chips']*$timer['total_player'];
        $data['arg_chips']    = $timer['left_player']==0 ? 0 : floor($data['total_chips']/$timer['left_player']);
        $data['current_level_index'] = $timer['current_level_index'];
        

        //计时器盲注信息
        $currentLevel = $blindsInfo[$timer['current_level_index']]['blinds_level'];

        if ($currentLevel==-1) { //当前级别为休息,显示上一级别的盲注和前注
            $data['cur_level_blinds'] = $blindsInfo[($timer['current_level_index']-1)]['blinds_num'];
            $data['cur_level_ante']   = $blindsInfo[($timer['current_level_index']-1)]['blinds_ante'];
            $data['current_level']    = '休息';
        }else{
            $data['cur_level_blinds'] = $blindsInfo[$timer['current_level_index']]['blinds_num'];
            $data['cur_level_ante']   = $blindsInfo[$timer['current_level_index']]['blinds_ante'];
            $data['current_level']    = $currentLevel;
        }
        //如果存在下一个级别
        if (isset($blindsInfo[($timer['current_level_index']+1)]['blinds_num'])) {
            //下一级别为休息，显示下两个级别的盲注级别
            if ($blindsInfo[($timer['current_level_index']+1)]['blinds_level'] == -1) {
                $data['next_level_blinds']= isset($blindsInfo[($timer['current_level_index']+2)]['blinds_num']) ? $blindsInfo[($timer['current_level_index']+2)]['blinds_num'] : '－/－';
                $data['next_level_ante']= isset($blindsInfo[($timer['current_level_index']+2)]['blinds_ante']) ? $blindsInfo[($timer['current_level_index']+2)]['blinds_ante'] : '－';
            }else{
                $data['next_level_blinds']= $blindsInfo[($timer['current_level_index']+1)]['blinds_num'];
                $data['next_level_ante']= $blindsInfo[($timer['current_level_index']+1)]['blinds_ante'];
            }
        }else{
            $data['next_level_blinds']= '－/－';
            $data['next_level_ante']= '－';
        }

        //如果计时器已结束
        if ($data['match_status']== 3 || $data['timer_status']==3) {
            $data['cur_level_time_left'] = $data['next_break_min'] = 0;
            return $data;
        }
        
        //计算倒计时剩余时间(单位:s)
        $timerLog = $this->timer_model->get_timer_log( array('tid'=>$tid, 'log_type'=>3) );//最后一次切换级别的时间戳
        if (empty( $timerLog )) {
            $curLevelTimeLeft = $timer['blinds_raise_time'] * 60;
        }else{
            $_startTime = $timerLog[0]['log_time'];
            $now = time();
            //获取当前level开始后的记录
            $breakTimeLog = $this->timer_model->get_timer_log( array('tid'=>$tid, 'logid >'=>$timerLog[0]['logid']) );
            $_breakTime = $this->_getBreakTime($breakTimeLog);

            $_currentLevelTime = ($currentLevel == -1 ? $blindsInfo[$timer['current_level_index']]['break_time']*60 : $timer['blinds_raise_time']*60 );
            //剩余时间 ＝ 本节时间 - (本节开始到现在的时间差) + 暂停操作占用的时间
            $curLevelTimeLeft = $_currentLevelTime - ($now - $_startTime) + $_breakTime;
        }
        
        $curLevelTimeLeft = $curLevelTimeLeft < 0 ? 0 : $curLevelTimeLeft;

        $curLevelTimeMin = floor( $curLevelTimeLeft/60 );
        $curLevelTimeSec = $curLevelTimeLeft%60;

        $data['cur_level_time_left'] = $curLevelTimeLeft;
        //$data['cur_level_time_left'] = 30;//DEBUG
        $data['cur_level_time_text'] = ($curLevelTimeMin > 9 ? $curLevelTimeMin : '0'.$curLevelTimeMin ) . ':' . ($curLevelTimeSec > 9 ? $curLevelTimeSec : '0'.$curLevelTimeSec);


        //简化级别列表,用于计算休息时间
        $blindsArr = array();
        foreach ($blindsInfo as $key => $blinds) {
            $blindsArr[$blinds['index']] = $blinds['blinds_level'];
        }
        //下次休息时间=当前级别剩余时间＋至休息时剩余级别＊涨盲时间(如果后续无休息，则至最后一个级别)
        $data['next_break_min'] = $curLevelTimeMin + $this->getNextBreakLevels($blindsArr, $timer['current_level_index']) * $timer['blinds_raise_time'];
        //如果结束则为0
        $data['next_break_min'] = $data['next_break_min'] > 0 ? $data['next_break_min'] : 0;

        return $data;
    }
    
    private function _timerBlindsFormat($b=array())
    {
        foreach ($b as $v) {
            $b[$v['index']] = $v;
        }
        return $b;
    }


    private function _getBreakTime($breakLog=array())
    {
        //计时器操作记录：开赛时更换level(type=3)，先有暂停(type=2)才会有开始(type=1)，最后一次是暂停，则计算最后一次暂停至现在时间差。
        if (empty($breakLog)) {
            return 0;
        }
        $bt  = $bt_flag = 0;
        $now = time();
        //最后一次是暂停，则暂停时间是从现在到暂停时的时间差
        if ($breakLog[0]['log_type']==2) {
            $bt = $now - $breakLog[0]['log_time'];
        }

        foreach ($breakLog as $break) {
            if ($break['log_type']==1) { //开始操作，向前找暂停
                $bt_flag = $break['log_time'];
            }elseif ($break['log_type']==2 && $bt_flag!=0 ) { //暂停操作
                $bt += ($bt_flag - $break['log_time']);
                $bt_flag = 0;
            }
        }
        //echo $bt;
        return $bt;
    }


    //获取下次休息时需要历时的级别数，para:级别列表，当前级别索引
    private function getNextBreakLevels($blinds=array(), $currentLevelIndex = 0)
    {
        $_blindsLeft = array_slice($blinds, $currentLevelIndex+1);//当前级别以后的级别列表（不含当前级别）
        $_nextBreakLevel = array_search(-1, $_blindsLeft);
        if ($_nextBreakLevel === FALSE) {
            $_nextBreakLevel = count( $_blindsLeft );
        }
        return intval( $_nextBreakLevel );
    }




}
