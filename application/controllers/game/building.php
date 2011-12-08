<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Building extends CI_Controller {

	public $layout = 'space_game';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('building_model', 'building');
		$this->load->model('queue_model', 'queue');
	}

	/**
	| Affiche la liste de tous les bâtiments disponible
	| @param $data = array()
	| @return une vue
	**/
	public function index($data = array())
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data['building_list'] = $this->building->get_allBuilding();
			$building_level = current($this->planet_model->get_planet($this->session->userdata('planet_id'), 'metal_mine, crystal_mine, deuterium_sintetizer, solar_plant'));

			$b = array('metal_mine', 'crystal_mine', 'deuterium_sintetizer', 'solar_plant');

			for($i = 0; $i < count($data['building_list']); $i++) {
				$data['building_list'][$i]->level = $building_level->$b[$i];
			}

			$this->load->view('game/building/show', $data);
		} else {
			$this->login();
		}
	}

	/**
	| Permet la construction d'un bâtiment
	| @param $id du bâtiment
	| @return une vue
	**/
	public function create($id = '')
	{
		if($this->session->userdata('email') || $this->session->userdata('logged'))
		{
			$data = array();

			if(isset($id) && ctype_digit($id)) {
				$building_select = current($this->building->get_building($id, 'name, construct_time'));

				if(isset($building_select) && !empty($building_select)) {
					// mktime(int hour, int minute, int second, int month, int day, int year)
					$date_now_in_tsp = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
					$date_finish_in_tsp = $date_now_in_timestamp + $building_select->construct_time;

					$data = array(
						'element_id'	=> $id,
						'element_type'	=> 'building',
						'planet_id'		=> $this->session->userdata('planet_id'),
						'time_start'	=> date('Y-m-d H:i:s'),
						'time_finish'	=> date('Y-m-d H:i:s', $date_finish_in_tsp)
					);					

					if($this->queue->insert($data)) {
						$data['notif']['type'] = 'success';
						$data['notif']['message'] = "{$building_select->name} en cours de construction.";
					} else {
						$data['notif']['type'] = 'error';
						$data['notif']['message'] = "Une erreur est survenue.";
					}

					$this->index($data);
				} else {
					$data['notif']['type'] = 'warning';
					$data['notif']['message'] = "Le bâtiment demandé n'existe pas.";

					$this->index($data);
				}
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