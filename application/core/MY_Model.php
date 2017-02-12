<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $table       = '';
	protected $primary_key = 'id';

	public function __construct() 
	{
		parent::__construct();
	}

	public function get(){

		return $this->db->get($this->table);
	}

	public function get_where($where){

		return $this->get_where($this->table, $where);
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