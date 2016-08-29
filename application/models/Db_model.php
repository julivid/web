<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加
    public function add_data($table='', $data=array())
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    //获取
    public function get_data($table, $where=array(), $limit=array(), $order = NULL)
    {
        if (!empty( $limit )) {
            $this->db->limit($limit[0], $limit[1]); //$limit[0], $limit[1]
        }
        if (!empty( $order )) {
            $this->db->order_by($order);
        }
        $query=$this->db->get_where($table, $where);
        return $query->result_array();
    }

    //更新
    public function update_data($table, $where=array(), $data = array())
    {
        if (empty($where)) {
            return -1;
        }
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    //删除
    public function del_data($table='', $where=array())
    {
        if (empty($where)) {
            return -1;
        }
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

}










