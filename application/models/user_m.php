<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	private $table 			= 'user'; 
	private $primary_key	= 'id';

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));

		return $this->db->get($this->table)->row();
	}
}
