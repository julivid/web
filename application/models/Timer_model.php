<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Timer_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加计时器
    public function add_timer($timer_data=array(), $blinds_data=array()){

        $this->db->trans_start();

        $this->db->insert('cpg_timer', $timer_data);
        $tid = $this->db->insert_id();

        for ($i=0; $i < count($blinds_data['blinds_level']); $i++) { 
            $this->db->insert(
                'cpg_timer_blinds', 
                array(
                    'tid'=>$tid,
                    'blinds_level'  =>$blinds_data['blinds_level'][$i], 
                    'blinds_num'    =>$blinds_data['blinds_num'][$i], 
                    'blinds_ante'   =>$blinds_data['blinds_ante'][$i], 
                    'break_time'    =>$blinds_data['break_time'][$i],
                    'index'         =>$i
                    )
            );
        }

        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
     //修改盲注列表
    public function edit_timer_blinds($tid=0, $blinds_data=array()){

        $this->db->trans_start();

        $this->db->delete('cpg_timer_blinds', array('tid' => $tid)); //删除原始记录

        for ($i=0; $i < count($blinds_data['blinds_level']); $i++) { 
            $this->db->insert(
                'cpg_timer_blinds', 
                array(
                    'tid'=>$tid,
                    'blinds_level'  =>$blinds_data['blinds_level'][$i], 
                    'blinds_num'    =>$blinds_data['blinds_num'][$i], 
                    'blinds_ante'   =>$blinds_data['blinds_ante'][$i], 
                    'break_time'    =>$blinds_data['break_time'][$i],
                    'index'         =>$i
                    )
            );
        }

        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    //获取盲注表盲注信息
    public function get_blinds($where='1=1')
    {
        $sql = 'select * from cpg_timer_blinds b left join cpg_timer t on b.tid=t.tid where '.$where.' order by index asc, tid asc';
        $query = $this->db->query($sql);
    }

    //获取所有赛事的计时器列表－－筛选用
    public function get_match_timer($where=array())
    {
        $query=$this->db->get_where('cpg_timer', $where);
        return $query->result_array();
    }

    //获取计时器列表
    public function get_timer_list($tid='')
    {
        $where = ' WHERE m.status != 3 AND m.status != 9 ';
        if ( !empty($tid) ) {
            $where .= ' AND t.tid='.$tid;
        }
        $sql = 'SELECT t.tid,t.mid,t.total_player,t.prize_player,t.left_player,t.initial_chips,t.blinds_raise_time,t.current_level_index,t.timer_status,t.show_photo,m.tid as match_type,m.name,m.status as match_status from cpg_timer t left join cpg_match_list m on t.mid=m.mid '.$where.' ORDER BY m.date ASC, m.time ASC';
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    //获取盲注列表详细信息
    public function get_timer_blinds($tid=0)
    {
        $this->db->select('blinds_level,blinds_num,blinds_ante,index,break_time');
        $this->db->order_by('index', 'asc');
        $query=$this->db->get_where('cpg_timer_blinds', array('tid'=>$tid));
        return $query->result_array();
    }

    //更换计时器盲注level
    public function chg_timer_level($data=array(), $tid=0)
    {
        $this->db->trans_start();

        $this->db->update('cpg_timer', $data, array('tid'=>$tid));
        
        $this->db->insert('cpg_timer_log', array('tid'=>$tid, 'log_time'=>time(), 'log_type'=>3, 'log_content'=>'New Level index:'.$data['current_level_index']));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    //获取计时器操作记录
    public function get_timer_log($where=array())
    {
        $this->db->order_by('logid desc');
        $query=$this->db->get_where('cpg_timer_log', $where);
        return $query->result_array();
    }


    //----------------- 操作 -------------------
    public function start_match($tid=0, $mid=0)
    {
        $time = time();
        $this->db->trans_start();
        if ($mid > 0) {
            //更新赛事状态
            $this->db->update('cpg_match_list', array('status'=>2, 'start_time'=>$time), array('mid'=>$mid)); 
            //计时器Log
            $this->db->insert('cpg_timer_log', array('tid'=>$tid, 'log_time'=>$time, 'log_type'=>3, 'log_content'=>'NewLevelIndex:0'));
            //计时器状态
            $this->db->update('cpg_timer', array('timer_status'=>1, 'start_time'=>$time), array('tid'=>$tid));
        }else{
            //计时器Log
            $this->db->insert('cpg_timer_log', array('tid'=>$tid, 'log_time'=>$time, 'log_type'=>1, 'log_content'=>'TimerStart'));
            //计时器状态
            $this->db->update('cpg_timer', array('timer_status'=>1), array('tid'=>$tid));
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    //暂停比赛
    public function pause_match($tid=0)
    {
        $this->db->trans_start();
        //计时器Log
        $this->db->insert('cpg_timer_log', array('tid'=>$tid, 'log_time'=>time(), 'log_type'=>2, 'log_content'=>'TimerPause'));
        //计时器状态
        $this->db->update('cpg_timer', array('timer_status'=>2), array('tid'=>$tid));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    //结束比赛
    public function match_over($tid=0, $mid=0)
    {
        $this->db->trans_start();
        //计时器Log
        $this->db->insert('cpg_timer_log', array('tid'=>$tid, 'log_time'=>time(), 'log_type'=>2, 'log_content'=>'TimerOver'));
        //计时器状态
        $this->db->update('cpg_timer', array('timer_status'=>3), array('tid'=>$tid));
        //赛事状态
        $this->db->update('cpg_match_list', array('status'=>3), array('mid'=>$mid));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }




    //更新计时器基本信息
    public function update_timer($data=array(), $where=array())
    {
        if (empty($where)) {
            return -1;
        }
        $this->db->update('cpg_timer', $data, $where);
        return $this->db->affected_rows();
    }

}










