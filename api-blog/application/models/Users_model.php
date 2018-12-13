<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get($user_id = null)
    {
        if (!is_null($user_id)) {
            $query = $this->db->select('*')->from('users')->where('user_id', $user_id)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
        
        $query = $this->db->select('*')->from('users')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return null;
    }
	public function save ( $user ){
		$this->db->insert('users', $user );
		if($this->db->affected_rows() === 1) {
			return true;
		}
		return null;
	}

	public function update ( $user ){
		$this->db->replace('users' , $user );
		if($this->db->affected_rows() === 2){
		  return true;
		}
		return null;
	}

	public function delete ( $user_id ){
		$this->db->where('user_id',$user_id)->delete('users');
		if($this->db->affected_rows() > 0){
			return true;
		}
		return null;
	}

	public function validate( $user ){
		$email_query = $this->db->select('user_id, user_fullname, user_nickname, user_email, user_level_access')->from('users')->where('user_password', $user['password'])->where('user_email', $user['username'])->get();
			
		if( $email_query->num_rows() == 0 ){
			$nickname_query = $this->db->select('user_id, user_fullname, user_nickname, user_email, user_level_access')->from('users')->where('user_password', $user['password'])->where('user_nickname', $user['username'])->get();
			if( $nickname_query->num_rows() === 1){
				return $nickname_query->result_array();
			}else{
				return null;
			}
		}
		return $email_query->row_array();
		
	}

}