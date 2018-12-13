<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';
   	
class Posts extends REST_Controller{

    public function __construct(){
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Content-Type: application/json");
		header("Access-Control-Allow-Headers: Access-Control-Allow-Origin ,Origin, Content-Type, Content-Length, Accept-Encoding");
        $this->load->model('posts_model');
 		/*REVISAR ALTERNATIDA A ESTO*/
 		if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    		die();
		}
   	
    }

    public function index_get(){
        $posts = $this->posts_model->get();
        if (!is_null($posts)){
            $this->response($posts, 200);
        }else{
        	$this->response(array('error' => 'No posts found in Database...'), 404);
        }
	}

    public function search_get($post_id){
		if(!$post_id){
			$this->response(null,400);
		}
		$post = $this->posts_model->get($post_id);
		if(!is_null($post)){
			$this->response($post , 200);
		}else{
			$this->response(array('error' => 'Post not found...'),404);
		}
    }

    public function index_post(){

    	date_default_timezone_set('America/Santiago');
		$current_date = date('Y-m-d H:i:s', time());
		$post = array (
			'post_title' => $this->post('post_title'),
			'post_imageurl' => $this->post('post_imageurl'),
			'post_description' => $this->post('post_description'),
			'post_content' => $this->post('post_content'),
			'post_datetime' => $current_date,
			'post_posted_by' => $this->post('post_posted_by')
		);
		if (!$this->post('post_title')) {
			$this->response (null,400) ;
		}else{
			$status = $this->posts_model->save( $post );
			if ( $status == null ) {
				$this->response ( array ('response' => 'An error has occurred to create post...') , 400) ;
			}
			$this->response( array('response' => 'Post created successfully...') , 200) ;
   		}
    }

    public function index_put (){
		$post = array (
			'post_title' => $this->put('post_title'),
			'post_imageurl' => $this->put('post_imageurl'),
			'post_description' => $this->put('post_description'),
			'post_content' => $this->put('post_content')
		);
		if (!$this->put('post_title') || !$this->put('post_content')) {
			$this->response(null,400);
		}else{
			$status = $this->posts_model->update($post);
			if ( is_null ( $status ) ) {
				$this->response( array ( 'response' => 'Post has not been updated...') , 400) ;
			}
			$this->response ( array ('response' => 'Post updated successfully...') , 200) ;
		}
   }

	public function index_delete ($post_id){
		if(!$post_id){
			$this->response(null,400);
		}
		$status = $this->posts_model->delete($post_id);
		if (!is_null($status)){
			$this->response(array('response' => 'Post has been eliminated...') , 200) ;
		} else {
			$this->response(array('error' , 'Post has not been eliminated...') , 400);
		}
	}

}
