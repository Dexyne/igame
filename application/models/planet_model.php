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
	public function get_allResourcesByPlanet($id)
	{
		return $this->db->select('metal, crystal, deuterium, energy_used, energy_max')
			->from($this->_table)
			->where('id', $id)
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
	public function get_planet($id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('id', $id)
			->get()
			->result();
	}

	// Créer une nouvelle planète dans la DB
	public function create($id, $data)
	{
		return $this->db->set('user_id', $data['user_id'])
			->set('name', $data['name'])
			->set('galaxy', $data['galaxy'])
			->set('system', $data['system'])
			->set('planet', $data['planet'])
			->set('created_at', $data['created_at'], false)
			->set('updated_at', $data['updated_at'], false)
			->set('metal', $data['metal'])
			->set('crystal', $data['crystal'])
			->set('deuterium', $data['deuterium'])
			->set('energy_used', $data['energy_used'])
			->set('energy_max', $data['energy_max'])
			->where('id', $id)
			->insert($this->_table);
	}

	// Mettre à jour la table planets
	public function update($id, $data)
	{
		return $this->db->set('user_id', $data['user_id'])
			->set('name', $data['name'])
			->set('galaxy', $data['galaxy'])
			->set('system', $data['system'])
			->set('planet', $data['planet'])
			->set('created_at', $data['created_at'])
			->set('updated_at', $data['updated_at'], false)
			->set('metal', $data['metal'])
			->set('crystal', $data['crystal'])
			->set('deuterium', $data['deuterium'])
			->set('energy_used', $data['energy_used'])
			->set('energy_max', $data['energy_max'])
			->set('metal_mine', $data['metal_mine'])
			->set('crystal_mine', $data['crystal_mine'])
			->set('deuterium_sintetizer', $data['deuterium_sintetizer'])
			->set('solar_plant', $data['solar_plant'])
			->where('id', $id)
			->update($this->_table);
	}
}