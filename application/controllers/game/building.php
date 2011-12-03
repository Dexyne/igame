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
			$building_level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'metal_mine, crystal_mine, deuterium_sintetizer, solar_plant'));

			$b[] = 'metal_mine';
			$b[] = 'crystal_mine';
			$b[] = 'deuterium_sintetizer';
			$b[] = 'solar_plant';

			for($i = 0; $i < count($data['building_list']); $i++) {
				$data['building_list'][$i]->level = $building_level->$b[$i];
			}

			$this->load->view('game/show_building', $data);
		} else {
			$this->login();
		}
	}

	public function create($id = '')
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();

			if(isset($id) && ctype_digit($id)) {
				$data['notif']['type'] = 'success';
				$data['notif']['message'] = "Bâtiment en cours de construction.";


			} else {
				$this->index();
			}
		} else {
			redirect('users/login');
		}
	}
}

/* End of file building.php */
/* Location: ./application/controllers/building.php */