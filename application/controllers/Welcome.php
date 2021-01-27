<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('welcome_message');
		$this->load->view('template/footer');
	}

	public function login()
	{
		$this->load->view('login_page');
	}
}
