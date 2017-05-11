<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kp_pengajuan_m extends MY_Model {

	protected $table       = 'kp_pengajuan'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}


	public function get_pengajuan($id){

		$sql = "SELECT COUNT(`status`) as jumlah FROM kp_pengajuan WHERE status != 3 AND mahasiswa_id =".$id;

		return $this->db->query($sql)->result();		
	}
}
