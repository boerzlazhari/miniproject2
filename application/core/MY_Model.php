<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $table       = '';
	protected $primary_key = 'id';

	public function __construct() 
	{
		parent::__construct();
	}

	public function get($id = null){

		if ($id != null) {
			$this->db->where('id', $id);
			return $this->db->get($this->table)->row();
		}else {
			return $this->db->get($this->table)->result();
		}
	}

	public function get_where($where, $single = null){

		$this->db->where($where);
		
		if ($single != null) {
			return $this->db->get($this->table)->row();
		} else {
			return $this->db->get($this->table)->result();
		}
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($data, $where)
	{
		return $this->db->update($this->table, $data, $where);
	}
}