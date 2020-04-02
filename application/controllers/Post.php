<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('posts');
	}

	
	public function index($id = null)
	{
		$posts = [];
		if($id){
			
			$posts = $this->posts->get($id);
			$this->load->view('templates/header'); 
			$this->load->view('home', array('posts'=> $posts, 'view'=> true));
			$this->load->view('templates/footer');


		}else{
			$posts = $this->posts->get();	
			$this->load->view('templates/header');
			$this->load->view('home', array('posts'=> $posts));
			$this->load->view('templates/footer');
		}
		
		
	}


	public function add($new = null)
	{
		
		if($new){
			$post_title = $this->input->post('title');
			$post_short_desc = $this->input->post('short_desc');
			$post_long_desc = $this->input->post('long_desc');
			$post_dop = $this->input->post('dop');
			if($post_title && $post_short_desc && $post_long_desc){
				$create = $this->posts->create(array('title'=> $post_title, 'short_desc'=> $post_short_desc, 'long_desc'=> $post_long_desc, 'dop'=>$post_dop));
				if($create){
					echo json_encode(array('status'=>"SUCCESS", "msg"=>"Post created successfully."));
				}else{
					echo json_encode(array('status'=>"ERROR", "msg"=>"Error creating new post."));
				}
			}
			
		}else{
	
			$this->load->view('templates/header');
			$this->load->view('addpost');
			$this->load->view('templates/footer');
			
		}
	}

	public function edit($id = null)
	{

		$post_title = $this->input->post('title');
		$post_short_desc = $this->input->post('short_desc');
		$post_long_desc = $this->input->post('long_desc');
		$post_dop = $this->input->post('dop');

		if($id && $post_title && $post_long_desc && $post_short_desc){

				$update = $this->posts->update(array('title'=> $post_title, 'short_desc'=> $post_short_desc, 'long_desc'=> $post_long_desc, 'dop'=> $post_dop), $id);
				if($update){
					echo json_encode(array('status'=>"SUCCESS", "msg"=>"Post updated successfully."));
				}else{
					echo json_encode(array('status'=>"ERROR", "msg"=>"Error updating post."));
				}
						
		}else{

			$posts = $this->posts->get($id);
			$this->load->view('templates/header');
			$this->load->view('editpost', array('posts' => $posts) );
			$this->load->view('templates/footer');

		}



			
		
	}

	public function delete($id)
	{
		if($id){

			$delete = $this->posts->delete($id);
			if($delete){
				echo json_encode(array('status'=>"SUCCESS", "msg"=>"Post deleted successfully."));
			}else{
				echo json_encode(array('status'=>"ERROR", "msg"=>"Error deleting post."));
			}
		}else{
			echo json_encode(array('status'=>"ERROR", "msg"=>"Error Occured, Invalid Id."));
		}
	}
}
