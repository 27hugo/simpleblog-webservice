<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get($post_id = null)
    {
        if (!is_null($post_id)) {
            $query = $this->db->select('*')->from('posts')->where('post_id', $post_id)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        
        $query = $this->db->select('*')->from('posts')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }
	public function save ( $post ){
		$this->db->insert('posts', $post );
		if($this->db->affected_rows() === 1) {
			return true;
		}
		return null;
	}

	public function update ( $post ){
		$this->db->replace('posts' , $post );
		if($this->db->affected_rows() === 2){
		  return true;
		}
		return null;
	}

	public function delete ( $post_id ){
		$this->db->where('post_id',$post_id)->delete('posts');
		if($this->db->affected_rows() > 0){
			return true;
		}
		return null;
	}

}
