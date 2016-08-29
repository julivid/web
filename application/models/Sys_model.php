<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加配置
    public function add_conf( $para=array() ){
        $this->db->insert('sys_conf', $para);
        return $this->db->insert_id();
    }
    
    //查询配置
    public function get_conf( $where=array(), $limit=20, $offset=0 )
    {
        $this->db->order_by("type", "asc");
        //$this->db->limit($limit, $offset);
        $query=$this->db->get_where('sys_conf', $where);
        return $query->result_array();
    }

    //更新配置信息
    public function update_conf($para = array(), $sid = 0)
    {
        $this->db->where('sid', $sid);
        $this->db->update('sys_conf', $para);
        return $this->db->affected_rows();
    }



}










