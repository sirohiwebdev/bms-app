<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct(){
		parent::__construct();
		$this->load->model('posts');
	}

	
	public function index()
	{
		$posts = $this->posts->get();	
		$this->load->view('templates/header');
		$this->load->view('home', array('posts'=> $posts));
		$this->load->view('templates/footer');
	
	}
}
