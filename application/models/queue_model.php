<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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