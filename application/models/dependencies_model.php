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

class Dependencies_model extends CI_Model {

	protected $_table = 'dependencies';

	public function get_all()
	{
		return $this->db->select('*')
			->from($this->_table)
			->get()
			->result();
	}

	public function get_allForType($type)
	{
		return $this->db->select('*')
			->from($this->_table)
			->where('type_element', $type)
			->get()
			->result();
	}

	// Retourne les données du bâtiment demandé
	public function get_dependence($id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('id', $id)
			->get()
			->result();
	}
}
