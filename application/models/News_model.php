<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model{


    public function __construct()
    {
        parent::__construct();
    }
    
    //添加信息
    public function add_news($para=array()){
        $this->db->insert('news', $para);
        return $this->db->insert_id();
    }
    
    //查询信息
    public function get_news( $where=array(), $limit=20, $offset=0 )
    {
        $sql = 'SELECT n.*,g.`add_time` as imgTime FROM `news` n LEFT JOIN `gallery` g ON n.main_photo=g.name ';
        if (!empty($where)) {
            $sql .= 'WHERE ';
            foreach ($where as $k => $v) {
                $sql .= 'n.'.$k.'="'.$v.'" AND ';
            }
            $sql = trim($sql);
            $sql = rtrim($sql, 'AND');
        }
        $sql .= ' ORDER BY n.index_show DESC, n.status DESC, n.nid DESC LIMIT '.$offset.','.$limit;
        $query = $this->db->query($sql);

        //$this->db->order_by("nid", "desc");
        //$this->db->limit($limit, $offset);
        //$query=$this->db->get_where('news', $para);
        return $query->result_array();
    }

    //更新信息信息
    public function update_news($para = array(), $nid = 0)
    {
        $this->db->where('nid', $nid);
        $this->db->update('news', $para);
        return $this->db->affected_rows();
    }

    //更新首页信息
    public function update_index($nid=NULL, $channel=NULL)
    {
        if (empty($nid) || empty($channel)) {
            return -1;
        }
        $this->db->trans_start();
        //$this->db->query('UPDATE news SET index_show=0 WHERE index_show=1 AND channel="'.$channel.'"');
        //$this->db->query('UPDATE news SET index_show=1 WHERE nid='.$nid);
        $this->db->update('news', array('index_show'=>0), array('channel' => $channel, 'index_show'=>1) );
        $this->db->update('news', array('index_show'=>1), array('nid'=>$nid) );
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }


}










