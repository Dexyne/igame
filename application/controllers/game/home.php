<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$this->load->view('game/home');
		} else {
			redirect('users/login');
		}
	}
}

/* End of file game.php */
/* Location: ./application/controllers/game.php */