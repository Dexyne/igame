<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planets extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$this->show();
		} else {
			$this->login();
		}
	}

	public function show($id = '')
	{
		$data = array();

		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data['planet_select'] = $this->planet_model->get_planet($id);

			$session_data = array(
				'planet_id'	=> $id,
			);

			$this->session->set_userdata($session_data);
		}

		redirect('game/home');
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */