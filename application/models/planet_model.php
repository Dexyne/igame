<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planet_model extends CI_Model {

	protected $_table = 'planets';

	public function get_allResources()
	{
		return $this->db->select('metal, crystal, deuterium, energy_used, energy_max')
			->from($this->_table)
			->get()
			->result();
	}

	// Retourne toutes les ressources d'une planète
	public function get_allResourcesByPlanet($planet_id)
	{
		return $this->db->select('metal, crystal, deuterium, energy_used, energy_max')
			->from($this->_table)
			->where('id', $planet_id)
			->get()
			->result();
	}

	// Retourne l'id et le nom des planètes d'un utilisateur
	public function get_allPlanetByuser($user_id)
	{
		return $this->db->select('id, name')
			->from($this->_table)
			->where('user_id', $user_id)
			->get()
			->result();
	}

	// Retourne les données de la planète demandé
	public function get_planet($planet_id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('id', $planet_id)
			->get()
			->result();
	}

	// Créer une nouvelle planète dans la DB
	public function create($planet_id, $data)
	{
		return $this->db->set('user_id', $data['user_id'])
			->set('name', $data['name'])
			->set('galaxy', $data['galaxy'])
			->set('system', $data['system'])
			->set('planet', $data['planet'])
			->set('last_update', $data['last_update'], false)
			->set('metal', $data['metal'])
			->set('crystal', $data['crystal'])
			->set('deuterium', $data['deuterium'])
			->set('energy_used', $data['energy_used'])
			->set('energy_max', $data['energy_max'])
			->where('id', $planet_id)
			->insert($this->_table);
	}

	// Mettre à jour la table planets
	public function update($planet_id, $data)
	{
		return $this->db->set('user_id', $data['user_id'])
			->set('name', $data['name'])
			->set('galaxy', $data['galaxy'])
			->set('system', $data['system'])
			->set('planet', $data['planet'])
			->set('last_update', $data['last_update'], false)
			->set('metal', $data['metal'])
			->set('crystal', $data['crystal'])
			->set('deuterium', $data['deuterium'])
			->set('energy_used', $data['energy_used'])
			->set('energy_max', $data['energy_max'])
			->where('id', $planet_id)
			->update($this->_table);
	}
}