<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Building extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('building_model', 'building');
	}

	public function index()
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data['building_list'] = $this->building->get_allBuilding();

			$this->load->view('game/show_building', $data);
		} else {
			$this->login();
		}
	}

	public function create()
	{
		redirect('users/login');
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */