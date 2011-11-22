<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planets_model extends CI_Model {

	protected $_table = 'planets';

	public function get_allResources()
	{
		return $this->db->select('metal, crystal, deuterium, energy_used, energy_max')
			->from($this->_table)
			->get()
			->result();
	}

	public function get_allResourcesByPlanet($planet_id)
	{
		return $this->db->select('metal, crystal, deuterium, energy_used, energy_max')
			->from($this->_table)
			->where('id', $planet_id)
			->get()
			->result();
	}
}