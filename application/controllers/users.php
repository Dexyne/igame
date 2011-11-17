<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function register()
	{
		$this->load->view('users/form_register');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */