<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加
    public function add_gallery( $data=array() )
    {
        return $this->db->insert('gallery', $data);
        //return $this->db->insert_id();
    }

    //获取
    public function get_gallery( $where=array(), $limit=0, $offset=0, $orderBy='' )
    {
        if (!empty( $limit )) {
            $this->db->limit($limit, $offset);
        }
        if (!empty( $orderBy )) {
            $this->db->order_by( $orderBy );
        }
        $query=$this->db->get_where('gallery', $where);
        return $query->result_array();
    }


    //更新
    public function update_gallery( $where=array(), $data = array() )
    {
        if (empty($where)) {
            return -1;
        }
        $this->db->where($where);
        $this->db->update('gallery', $data);
        return $this->db->affected_rows();
    }

    //删除
    public function del_gallery( $where=array() )
    {
        if (empty($where)) {
            return -1;
        }
        $this->db->delete('gallery', $where);
        return $this->db->affected_rows();
    }

}










