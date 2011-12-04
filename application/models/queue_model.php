<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queue_model extends CI_Model {

	protected $_table = 'queue';

	public function insert($data)
	{
		return $this->db->set('element_id', $data['element_id'])
			->set('planet_id', $data['planet_id'])
			->set('time_start', $data['time_start'], false)
			->set('time_finish', $data['time_finish'], false)
			->insert($this->_table);
	}
}