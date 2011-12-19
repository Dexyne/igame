<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queue extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('queue_model', 'queue');
		$this->load->model('building_model', 'building');
	}

	public function update($id = '')
	{
		if(isset($id) && !empty($id) && ctype_digit($id)) {
			$element = current($this->queue->get_element($id));
			if($element->element_type == 'building')
				$element_type = current($this->building->get_building($element->element_id, 'name_clean'));

			if(isset($element) && $element->planet_id == $this->session->userdata('planet_id')) {

				$planet = current($this->planet_model->get_planet($this->session->userdata('planet_id')));

				$data = array(
					'user_id' 				=> $planet->user_id,
					'name'					=> $planet->name,
					'galaxy'				=> $planet->galaxy,
					'system'				=> $planet->system,
					'planet'				=> $planet->planet,
					'created_at'			=> $planet->created_at,
					'updated_at'			=> 'NOW()',
					'metal'					=> $planet->metal,
					'crystal'				=> $planet->crystal,
					'deuterium'				=> $planet->deuterium,
					'energy_used'			=> $planet->energy_used,
					'energy_max'			=> $planet->energy_max,
					'metal_mine'			=> $planet->metal_mine + (($element_type->name_clean === 'metal_mine') ? 1 : 0),
					'crystal_mine'			=> $planet->crystal_mine + (($element_type->name_clean === 'crystal_mine') ? 1 : 0),
					'deuterium_sintetizer'	=> $planet->deuterium_sintetizer + (($element_type->name_clean === 'deuterium_sintetizer') ? 1 : 0),
					'solar_plant'			=> $planet->solar_plant + (($element_type->name_clean === 'solar_plant') ? 1 : 0)
				);

				if($this->planet_model->update($this->session->userdata('planet_id'), $data) && $this->queue->delete($id)) {
					return True;
				} else {
					return False;
				}
			}
		}
	}
}