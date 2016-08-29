<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加
    public function add_file($para=array()){
        $this->db->insert('file', $para);
        return $this->db->insert_id();
    }
    
    //查询
    public function get_file( $where=array(), $limit=20, $offset=0 )
    {
        $this->db->order_by("fid", "desc");
        $this->db->limit($limit, $offset);
        $query=$this->db->get_where('file', $where);
        return $query->result_array();
    }

    //更新
    public function update_file($para = array(), $fid = 0)
    {
        $this->db->where('fid', $fid);
        $this->db->update('file', $para);
        return $this->db->affected_rows();
    }

    //事务
    public function do_something($fid=NULL, $where=NULL)
    {
        if (empty($fid) || empty($where)) {
            return -1;
        }
        $this->db->trans_start();
        //do something...
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

}










