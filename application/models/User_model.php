<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加
    public function add_user($para=array()){
        $this->db->insert('user', $para);
        return $this->db->insert_id();
    }
    
    //查询
    public function get_user( $where=array(), $limit=20, $offset=0 )
    {
        $this->db->order_by("uid", "desc");
        $this->db->limit($limit, $offset);
        $query=$this->db->get_where('user', $where);
        return $query->result_array();
    }

    //更新
    public function update_user($para = array(), $uid = 0)
    {
        $this->db->where('uid', $uid);
        $this->db->update('user', $para);
        return $this->db->affected_rows();
    }

    //事务
    public function do_something($uid=NULL, $where=NULL)
    {
        if (empty($uid) || empty($where)) {
            return -1;
        }
        $this->db->trans_start();
        //do something...
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

}










