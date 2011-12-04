<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Building_model extends CI_Model {

	protected $_table = 'building';

	public function get_allBuilding()
	{
		return $this->db->select('*')
			->from($this->_table)
			->get()
			->result();
	}

	// Retourne les données du bâtiment demandé
	public function get_building($id, $select = '*')
	{
		return $this->db->select($select)
			->from($this->_table)
			->where('id', $id)
			->get()
			->result();
	}
}