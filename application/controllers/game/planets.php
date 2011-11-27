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
		// (20 * $building_metal * pow((1.1), $building_metal))
		$building_metal = 2;
		$metal_per_hour = 50;

		if(isset($planet_id) && !empty($planet_id) && is_int($planet_id) || isset($planet_id) && !empty($planet_id) && ctype_digit($planet_id)) {
			// On récupère les données actuelles de la planète
			$data_planet = current($this->planet_model->get_planet($planet_id));

			$datetime1 = new DateTime(date('Y-m-d H:i:s'));
			$datetime2 = new DateTime($data_planet->last_update);
			$interval = $datetime1->diff($datetime2);
			/*
			| Reste à récupérer le temps en integer (ou timestamp) puis à le soustraire au calcul de ressource (ou le diviser)
			| Si %d < 1 (ou == 0) (soit moins d'un jour) on prend les heures sinon directement [days] pour le nombre total de jours.
			*/

			$data = array(
				'user_id' 		=> $data_planet->user_id,
				'name'			=> $data_planet->name,
				'galaxy'		=> $data_planet->galaxy,
				'system'		=> $data_planet->system,
				'planet'		=> $data_planet->planet,
				'last_update'	=> 'NOW()',
				'metal'			=> $data_planet->metal + (20 * $building_metal * pow((1.1), $building_metal)),
				'crystal'		=> $data_planet->crystal + (15 * $building_metal * pow((1.1), $building_metal)),
				'deuterium'		=> $data_planet->deuterium + (10 * $building_metal * pow((1.1), $building_metal)),
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