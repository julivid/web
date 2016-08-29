<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
        //$this->db->query('SET NAMES latin1');
    }
    //---- 管理员 ----------
    public function get_manager($where=array(), $limit=1, $offset=0){
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('admin'); //echo $this->db->last_query();
        return $query->result_array();
    }
        
    public function add_manager($data){
        $this->db->insert('admin', $data);
        return $this->db->insert_id();
    }
    
    public function update_manager($data, $mid){
        $this->db->where('mid', $mid);
        $this->db->update('admin', $data);
        return $this->db->affected_rows();
    }
    
    public function del_manager($mid){
        return $this->db->delete('admin', array('mid' => $mid));
    }
    
    //---- 角色 ------------
    public function add_role($data){
        $this->db->insert('admin_role', $data);
        return $this->db->insert_id();
    }
    public function add_role_privilege($data){
        $this->db->insert('admin_role_privilege', $data);
        return $this->db->affected_rows();
    }
    
    public function get_role(){
        $query = $this->db->get('admin_role'); //echo $this->db->last_query();
        return $query->result_array();
    }
    //权限列表
    public function get_privilege(){
        $this->db->order_by('pid', 'ASC');
        $query = $this->db->get_where('admin_privilege', array('status'=>1)); //echo $this->db->last_query();
        return $query->result_array();
    }
    //角色权限列表
    public function get_role_privilege(){
        $sql = 'SELECT r.*,p.* FROM admin_role_privilege a LEFT JOIN admin_role r ON a.rid=r.rid LEFT JOIN admin_privilege p ON a.pid=p.pid WHERE p.status=1 ORDER BY r.rid ASC, p.pid ASC';
        $query = $this->db->query($sql); //echo $this->db->last_query();
        return $query->result_array();
    }
    
    //更新角色=更新角色信息+删除权限列表+添加新权限信息
    public function update_role_info($rid, $rname, $privilege){
        $this->db->trans_start();
        $this->db->update('admin_role', array('rname' => $rname), array('rid' => $rid) );
        $this->db->delete('admin_role_privilege', array('rid' => $rid));
        foreach($privilege as $pid){
            $this->db->insert('admin_role_privilege', array('rid'=>$rid, 'pid'=>$pid));
        }
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    //删除角色=角色信息+权限信息
    public function del_role($rid){
        $this->db->trans_start();
        $this->db->delete('admin_role', array('rid' => $rid));
        $this->db->delete('admin_role_privilege', array('rid' => $rid));
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    //验证权限
    public function check_manager_privilege($mid, $ctl, $method){
        $sql = 'SELECT * FROM admin_role_privilege r LEFT JOIN admin a ON r.rid=a.rid LEFT JOIN admin_privilege p ON r.pid=p.pid WHERE a.mid = "'.$mid.'" AND a.status=1 AND p.pctl="'.$ctl.'" AND p.pmethod="'.$method.'" ';
        $query = $this->db->query($sql);
        return $query->num_rows() > 0 ? TRUE : FALSE;
    }
    
}










