<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加产品
    function add_product($para=array()){
        $this->db->insert('product', $para);
        return $this->db->insert_id();
    }
    
    //查询产品
    public function get_product( $where=array(), $limit=20, $offset=0 )
    {
        $sql = 'SELECT p.*,g.`add_time` as imgTime FROM `product` p LEFT JOIN `gallery` g ON p.main_photo=g.name ';
        if (!empty($where)) {
            $sql .= 'WHERE ';
            foreach ($where as $k => $v) {
                $sql .= 'p.'.$k.'="'.$v.'" AND ';
            }
            $sql = trim($sql);
            $sql = rtrim($sql, 'AND');
        }
        $sql .= ' ORDER BY p.pid DESC LIMIT '.$offset.','.$limit;
        $query = $this->db->query($sql);

        //$this->db->order_by("pid", "desc");
        //$this->db->limit($limit, $offset);
        //$query=$this->db->get_where('product', $para);
        return $query->result_array();
    }

    //更新产品信息
    public function update_product($para = array(), $pid = 0)
    {
        $this->db->where('pid', $pid);
        $this->db->update('product', $para);
        return $this->db->affected_rows();
    }

    //*********************** 图集 ************************
    //添加产品图片
    public function add_product_gallery($para=array())
    {
        return $this->db->insert('gallery', $para);
        //return $this->db->insert_id();
    }

    //获取产品图片
    public function get_product_gallery($para=array())
    {
        $this->db->where('type', 0);
        $query=$this->db->get_where('gallery', $para);
        return $query->result_array();
    }

    //更新产品图片
    public function update_product_gallery($para = array(), $name = NULL)
    {
        $this->db->where('name', $name);
        $this->db->where('type', 0);
        $this->db->update('gallery', $para);
        return $this->db->affected_rows();
    }
    //删除产品图片
    public function del_product_gallery($name = NULL)
    {
        //$this->db->where('name', $name);
        $this->db->delete('gallery', array('name'=>$name, 'type'=>0));
        return $this->db->affected_rows();
    }

}










