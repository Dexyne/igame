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
			$data['planet_select'] = current($this->planet_model->get_planet($id));

			$session_data = array(
				'planet_id'	=> $id,
			);

			$this->session->set_userdata($session_data);

			$this->edit($data['planet_select']->id);
		}
		
		redirect('game/home');
	}

	public function edit($planet_id = '')
	{
		// Level du batiment, est normalement enregistrer en db, ici c'est pour les tests
		$building_metal = 2;
		$metal_per_hour = 50;

		if(isset($planet_id) && !empty($planet_id) && is_int($planet_id) || isset($planet_id) && !empty($planet_id) && ctype_digit($planet_id)) {
			// On récupère les données actuelles de la planète
			$data_planet = current($this->planet_model->get_planet($planet_id));

			$today = new DateTime(date('Y-m-d H:i:s'));
			$last_update = new DateTime($data_planet->updated_at);
			$interval = $today->diff($last_update);

			$hours = $interval->days * 24 + $interval->h;
			$minutes = $hours * 60 + $interval->i;
			$seconds = $minutes * 60 + $interval->s;

			$data = array(
				'user_id' 		=> $data_planet->user_id,
				'name'			=> $data_planet->name,
				'galaxy'		=> $data_planet->galaxy,
				'system'		=> $data_planet->system,
				'planet'		=> $data_planet->planet,
				'created_at'	=> $data_planet->created_at,
				'updated_at'	=> 'NOW()',
				'metal'			=> $data_planet->metal + ($building_metal * $metal_per_hour * ($seconds / 3600)),
				'crystal'		=> $data_planet->crystal + ($building_metal * $metal_per_hour * ($seconds / 3600)),
				'deuterium'		=> $data_planet->deuterium + ($building_metal * $metal_per_hour * ($seconds / 3600)),
				'energy_used'	=> $data_planet->energy_used,
				'energy_max'	=> $data_planet->energy_max
			);

			// On met à jour les données de la planète
			return $this->planet_model->update($planet_id, $data);
		} else {
			redirect('game/home');	
		}		
	}
}

/* End of file planets.php */
/* Location: ./application/controllers/planets.php */