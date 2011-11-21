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
}