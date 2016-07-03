<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_m extends CI_Model {

	private $table 			= 'prodi'; 
	private $primary_key	= 'id';

	public function save_data($data, $id = null)
	{
		if ($id == null) 
		{
			$this->db->insert($this->table, $data);
		} 
		else 
		{
			$this->db->update($this->table, $data, $condition);
		}
	}
}
