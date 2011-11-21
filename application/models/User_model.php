<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	protected $_table = 'users';

	public function save($data) 
	{
		return $this->db->insert($this->_table, $data);
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

	public function getId()
	{
		$this->db->where('username', $this->session->userdata('username'));
		return $this->db->get('users');
	}
}