<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Users extends REST_Controller{

    public function __construct(){
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Origin ,Origin, Content-Type, Content-Length, Accept-Encoding");
        $this->load->model('users_model');
        /*REVISAR ALTERNATIDA A ESTO*/
 		if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    		die();
		}
    }

    public function index_get(){
        $users = $this->users_model->get();
        if (!is_null($users)){
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
        	$this->response(array('error' => 'No users found in Database...'), 404);
        }
	}

    public function search_get($user_id){
		if(!$user_id){
			$this->response(null,400);
		}
		$user = $this->users_model->get($user_id);
		if(!is_null($user)){
			$this->response($user , 200);
		}else{
			$this->response(array('error' => 'User not found...'),404);
		}
    }

    public function index_post(){
		$user = array (
			'user_fullname' => $this->post('user_fullname'),
			'user_nickname' => $this->post('user_nickname'),
			'user_email' => $this->post('user_email'),
			'user_password' => $this->post('user_password'),
			'user_level_access' => $this->post('user_level_access')
		);
		if (!$this->post('user_email')) {
			$this->response (null,400) ;
		}else{
			$status = $this->users_model->save( $user );
			if ( $status == null ) {
				$this->response ( array ('response' => 'An error has occurred to create user...') , 400);
			}
			$this->response( array('response' => 'User created successfully...') , 200);
   		}
    }

    public function validate_post(){
    	$token = '4s7F5g3X2w7N';
    	$user = array(
    		'username' => $this->post('username'), 
    		'password' => $this->post('password')
    	);
    	$user_data = $this->users_model->validate( $user );
    	if( $user_data == null){
    		$this->response( array ('response' => 'Invalid user...') , 400);
    	}else{
    		$this->response(array(
    			'token' => $token,
    			'user' => $user_data)
    		, 200);
    	}
    }

    public function index_put (){
		$user = array (
			'user_fullname' => $this->put('user_title'),
			'user_nickname' => $this->put('user_imageurl'),
			'user_email' => $this->put('user_description'),
			'user_password' => $this->put('user_content'),
			'user_level_access' => $this->put('user_level_access')
		);
		if (!$this->put('user_email')) {
			$this->response(null,400);
		}else{
			$status = $this->users_model->update($user);
			if ( is_null ( $status ) ) {
				$this->response( array ( 'response' => 'User has not been updated...') , 400) ;
			}
			$this->response ( array ('response' => 'User updated successfully...') , 200) ;
		}
   }

	public function index_delete ($user_id){
		if(!$user_id){
			$this->response(null,400);
		}
		$status = $this->users_model->delete($user_id);
		if (!is_null($status)){
			$this->response(array('response' => 'User has been eliminated...') , 200) ;
		} else {
			$this->response(array('error' , 'User has not been eliminated...') , 400);
		}
	}

}
