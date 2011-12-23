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

class User_model extends CI_Model {

	protected $_table = 'users';

	public function save($data) 
	{
		return $this->db->set('username', $data['username'])
			->set('email', $data['email'])
			->set('password', $data['password'])
			->set('created_at', $data['created_at'], false)
			->set('updated_at', $data['updated_at'], false)
			->insert($this->_table);
	}

	public function check_id($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', sha1($password));
		$query = $this->db->get('users');

		if($query->num_rows == 1)
		{
			return True;
		}
	}

	public function get_user($email, $id = '')
	{
		/*$this->db->where('email', $email);
		return $this->db->get('users');*/
		return $this->db->select('*')
			->from($this->_table)
			->where('email', $email)
			->or_where('id', $id)
			->get()
			->result();
	}

	public function get_userById($id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('id', $id)
			->get()
			->result();
	}

	public function getId()
	{
		$this->db->where('username', $this->session->userdata('username'));
		return $this->db->get('users');
	}

	public function last_id()
	{
		return $this->db->insert_id();
	}
}