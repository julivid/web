<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Match_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
        $this->config->load('match_cfg');
    }
    
    //添加赛事类型
    public function add_match_type($para=array()){
        $this->db->insert('cpg_match', $para);
        return $this->db->insert_id();
    }
    
    //获取赛事类型
    public function get_match_type( $where=array(), $limit=20, $offset=0 )
    {
        $this->db->order_by("date", "desc");
        $this->db->limit($limit, $offset);
        $query=$this->db->get_where('cpg_match', $where);
        return $query->result_array();
    }

    //更新赛事类型
    public function update_match_type($para = array(), $tid = 0)
    {
        $this->db->where('tid', $tid);
        $this->db->update('cpg_match', $para);
        return $this->db->affected_rows();
    }

    //添加赛场地图
    public function add_match_map($para=array()){
        $this->db->insert('cpg_match_map', $para);
        return $this->db->insert_id();
    }

    //获取赛场地图
    public function get_match_map( $where=array(), $limit=20, $offset=0 )
    {
        //$this->db->order_by("mapid", "asc");
        $this->db->limit($limit, $offset);
        $query=$this->db->get_where('cpg_match_map', $where);
        return $query->result_array();
    }

    //更新赛场地图
    public function update_match_map($para = array(), $mapid = 0)
    {
        $this->db->where('mapid', $mapid);
        $this->db->update('cpg_match_map', $para);
        return $this->db->affected_rows();
    }

    //添加赛事信息
    public function add_match_info($para=array()){
        $this->db->insert('cpg_match_list', $para);
        return $this->db->insert_id();
    }

    //获取赛事信息
    public function get_match_info($where=array()){
        $query=$this->db->get_where('cpg_match_list', $where);
        return $query->result_array();
    }

    //更新赛事信息
    public function update_match_info($para = array(), $where=array()){
        if( !is_array($where) || empty( $where ) ){
            return -1;
        }
        $this->db->update('cpg_match_list', $para, $where); 
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }
    
    //获取赛事信息
    public function get_match_list( $where='', $limit=20, $offset=0, $all=false )
    {
        /*$this->db->order_by("tid", "asc");
        $this->db->limit($limit, $offset);
        $query=$this->db->get_where('cpg_match_list', $where);
        reurn $query->result_array();*/
        if ( !empty($where) ) {
            $where = ' WHERE '.$where;
        }
        $sql = 'SELECT l.tid,l.mid,l.name,l.date,l.time,l.game_type,l.entry_ticket,l.start_condition,l.prize,l.delayed_enroll,l.status,l.is_del,l.group_flag,l.tab_type,l.tab_num,l.tab_reservation,l.tab_min_seat,l.tab_new_tabs,m.name as type_name,m.date as type_date,m.logo,m.status as type_status 
            FROM cpg_match_list l 
            LEFT JOIN cpg_match m ON l.tid=m.tid 
            '.$where.' 
            ORDER BY l.date ASC,l.time ASC '; //, l.tid ASC,l.group_flag DESC,l.status DESC
        if ($all==false) {
            $sql .= ' LIMIT '.$offset.','.$limit; 
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //获取历史赛事
    public function get_match_history()
    {
        $sql = 'SELECT l.tid,l.mid,l.name,l.date,l.time,l.game_type,l.entry_ticket,l.start_condition,l.prize,l.delayed_enroll,l.status,l.is_del,l.group_flag,l.tab_type,l.tab_num,l.tab_reservation,l.tab_min_seat,l.tab_new_tabs,m.name as type_name,m.date as type_date,m.logo,m.status as type_status 
            FROM cpg_match_list l 
            LEFT JOIN cpg_match m ON l.tid=m.tid 
            WHERE l.status=3
            ORDER BY l.date DESC,l.time DESC'; //, l.tid ASC,l.group_flag DESC,l.status DESC
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //获取赛事计时器信息
    public function get_match_timer($where=0)
    {
        $query=$this->db->get_where('cpg_timer', $where);
        return $query->result_array();
    }

    //获取用户参赛纪录
    public function get_promotion_user($where=array())
    {
        /*$sql = 'select * from user_match_log mlog LEFT JOIN game_user gu on mlog.uid=gu.uid WHERE mlog.mid='.$mid;
        $query=$this->db->query($sql);*/
        $query=$this->db->get_where('user_match_log', $where);
        return $query->result_array();
    }

    //获取晋级赛所有筹码量
    public function get_promotion_chips($mid=0)
    {
        $sql = 'SELECT sum(chips) as all_chips from user_match_log WHERE mid='.$mid;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //获取晋级赛所有参赛人数
    public function get_promotion_all_players($tid=0)
    {
        $mids_query = $this->db->get_where('cpg_match_list', array('tid'=>$tid));
        $mids = array();
        foreach ($mids_query->result() as $row){
            $mids[] = $row->mid;
        }
        
        $this->db->where_in('mid', $mids);
        return $this->db->count_all('user_match_log');
    }

    //添加晋级赛人员
    public function add_promotion_user($data=array())
    {
        $this->db->insert('user_match_log', $data);
        return $this->db->insert_id();
    }
    //删除晋级赛人员
    public function del_promotion_user($id)
    {
        $this->db->delete('user_match_log', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function update_promotion_user($where=array(), $data=array())
    {
        $this->db->where($where);
        $this->db->update('user_match_log', $data);
        return $this->db->affected_rows();
    }

    //事务Demo
    public function do_something($tid=NULL, $where=NULL)
    {
        if (empty($tid) || empty($where)) {
            return -1;
        }
        $this->db->trans_start();
        //do something...
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

}










