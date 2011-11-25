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

			$this->update($data['planet_select']->id, $data['planet_select']);
		}

		redirect('game/home');
	}

	public function update($planet_id = '', $data_planet = array())
	{
		if(isset($planet_id) && !empty($planet_id))
		{
			$data = array(
				'user_id' 		=> $data_planet->user_id,
				'name'			=> $data_planet->name,
				'galaxy'		=> $data_planet->galaxy,
				'system'		=> $data_planet->system,
				'planet'		=> $data_planet->planet,
				'last_update'	=> NOW(),
				'metal'			=> $data_planet->metal,
				'crystal'		=> $data_planet->crystal,
				'deuterium'		=> $data_planet->deuterium,
				'energy_used'	=> $data_planet->energy_used,
				'energy_max'	=> $data_planet->energy_max
			);

			return $this->planet_model->save($planet_id, $data);
		}
	}
}

/* End of file planets.php */
/* Location: ./application/controllers/planets.php */