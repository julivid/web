<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    

    //------------------ 代理商 [start] ------------------------------
    //添加
    public function add_agent($data=array()){
        $this->db->insert('match_ticket_agents', $data);
        return $this->db->insert_id();
    }
    
    //查询
    public function get_agent( $where=array() )
    {
        //$this->db->order_by("aid", "desc");
        //$this->db->limit($limit, $offset);
        $query=$this->db->get_where('match_ticket_agents', $where);
        return $query->result_array();
    }

    //更新
    public function update_agent($data = array(), $where = array())
    {
        $this->db->update('match_ticket_agents', $data, $where);
        return $this->db->affected_rows();
    }
    //------------------ 代理商 [end] --------------------------------


    //获取发行卡类型
    public function get_ticket_type($where=array())
    {
        $this->db->order_by("sort", "asc");
        $query=$this->db->get_where('match_ticket_type', $where);
        return $query->result_array();
    }

    //获取发卡记录
    public function tickets_release_log($where=array())
    {
        $this->db->order_by("id", "desc");
        $query=$this->db->get_where('match_ticket_release_log', $where);
        return $query->result_array();
    }


    //添加发卡记录
    public function add_ticket_release($data=array())
    {
        $this->db->insert('match_ticket_release_log', $data);
        return $this->db->insert_id();
    }

    //更新发卡记录
    public function update_ticket_release($data=array(), $where=array())
    {
        $this->db->update('match_ticket_release_log', $data, $where);
        return $this->db->affected_rows();
    }

    public function add_ticket_downloads($rid='')
    {
        $this->db->set('downloads', 'downloads+1', FALSE);
        $this->db->where('id', $rid);
        $this->db->update('match_ticket_release_log');
        return $this->db->affected_rows();
    }

    //添加卡
    public function add_ticket($data=array())
    {
        $this->db->insert('match_ticket', $data);
        return $this->db->insert_id();
    }

    //获取发行卡信息
    public function get_tickets($where=array())
    {
        $query=$this->db->get_where('match_ticket', $where); //echo $this->db->last_query();
        return $query->result_array();
    }
    
    //更新卡
    public function update_ticket_info($data=array(), $where=array())
    {
        $this->db->update('match_ticket', $data, $where);
        return $this->db->affected_rows();
    }

    //-------------- 统计 ----------------
    //参赛卡
    public function tickets_all()
    {
        $sql = 'SELECT count(*) as `num`,`type`
                FROM `match_ticket`
                group by `type`
                order by `type` asc';
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    public function tickets_stats()
    {
        $sql = 'SELECT count(*) as `num`,`type`,`ticket_status` 
                FROM `match_ticket`
                where type != "zck_st" 
                group by `type`,`ticket_status`
                order by `type` asc';
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    //注册卡
    public function tickets_agent_stats()
    {
        $sql = 'SELECT count(*) as `all`,`type`,`agent`,`ticket_status` 
                FROM `match_ticket`
                where type = "zck_st" 
                group by `agent`,`ticket_status`,`type`
                order by `agent` asc';
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    public function tickets_reg_stats()
    {
        $sql = 'SELECT u.`uid`,u.`zfb_id`,u.`wx_id`,t.`agent`
                FROM `game_user` u
                left join `match_ticket` t 
                ON u.`reg_ticket_id` = t.`tid`
                order by t.`agent` asc';
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    public function tickets_pay_stats()
    {
        return array();
        $sql = '';
        $query=$this->db->query($sql);
        return $query->result_array();
    }

    public function get_ticket_detail($where=array())
    {
        /*$sql = 'SELECT username,family_name,given_name,email,mobile,id_card,addr,wx_id,zfb_id FROM game_user where reg_ticket_id='.$tid;
        $query=$this->db->query($sql);
        return $query->result_array();*/
        $this->db->select('username,family_name,given_name,email,mobile,id_card,addr,country,province,city,wx_id,zfb_id');
        $query=$this->db->get_where('game_user', $where); //echo $this->db->last_query();
        return $query->result_array();
    }


    //线上游戏赛果
    public function get_game_prize()
    {
        $sql = 'SELECT u.uid,u.username,u.family_name,u.given_name,u.email,u.mobile,u.id_card,u.addr,u.country,u.province,u.city,p.table_name,p.rank,p.prize,p.memo,p.time,p.pid,p.game_time FROM game_prize_log p left join game_user u on p.uid=u.uid where p.prize_type=1  order by p.game_time DESC,p.rank asc';
        $query=$this->db->query($sql);
        //$query=$this->db->get_where('game_prize_log', $where); //echo $this->db->last_query();
        return $query->result_array();
    }

    public function update_game_prize_memo($memo='', $pid=0)
    {
        $this->db->update('game_prize_log', array('memo'=>$memo), array('pid'=>$pid));
        return $this->db->affected_rows();
    }

}










