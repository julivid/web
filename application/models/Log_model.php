<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加操作日至
    function add_act_log($para=array()){
        return $this->db->insert('act_log', $para);
    }

    
    //查询登录日志
    public function login_log_get($para = array(), $limit=0)
    {
        $this->db->order_by("logTime", "desc");
        if($limit){
            $this->db->limit(1);
        }
        $query=$this->db->get_where('login_log', $para);
        return $query->result_array();
    }

    //添加登录日志
    public function login_log_add($para=array())
    {
        $res = $this->db->insert('login_log', $para);
        return $res = $res ? 1 : 0 ;
    }

}










