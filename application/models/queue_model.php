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
 * along with this iGame.  If not, see <http://www.gnu.org/licenses/>.
 *
 * #######################################################################
 */

class Queue_model extends CI_Model {

	protected $_table = 'queue';

	public function insert($data)
	{
		return $this->db->set('element_id', $data['element_id'])
			->set('element_type', $data['element_type'])
			->set('planet_id', $data['planet_id'])
			->set('time_start', $data['time_start'], false)
			->set('time_finish', $data['time_finish'], false)
			->insert($this->_table);
	}

	public function into($type, $planet_id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('element_type', $type)
			->where('planet_id', $planet_id)
			->get()
			->result();
	}

	public function get_element($id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('id', $id)
			->get()
			->result();
	}

	public function delete($id)
	{
		$this->db->delete($this->_table, array('id' => $id)); 
	}

	public function update()
	{
		
	}
}