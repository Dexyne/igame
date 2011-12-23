<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file is part of iGame
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see https://github.com/Dexyne/igame
 *
 * @copyright Copyright (c) 2011-Present, Aurélien Léger, iGame
 * All rights reserved.
 *
 * iGame is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iGame program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with iGame.  If not, see <http://www.gnu.org/licenses/>.
 *
 * #######################################################################
 */

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