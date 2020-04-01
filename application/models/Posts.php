<?php
class Posts extends CI_Model{

    function __construct(){
        parent::__construct();

        $this->table = "posts";
        $this->load->database();
    }


    public function get($id= null){
        if($id){
            $query = $this->db->get_where($this->table, array('id'=> $id));
        }else{
            $query = $this->db->get($this->table);

        }
        return $query->result_array();
    }



    public function create($post){
        $query = $this->db->insert($this->table, $post);
        return $query;
    }


    public function update($post, $id){
        
        $this->db->where('id', $id);
        return $this->db->update($this->table, $post);
    }


    public function delete($id){
        
        return $this->db->delete($this->table, array('id'=> $id));
    }




}
?>