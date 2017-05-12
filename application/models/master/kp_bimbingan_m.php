<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kp_bimbingan_m extends MY_Model {

	protected $table       = 'kp_bimbingan'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_all_bimbingan($dosen_id){

		$sql = "SELECT
					kp_bimbingan.id,
					kp_bimbingan.kp_id,
					kp_bimbingan.tanggal,
					kp_bimbingan.notes,
					kp_bimbingan.`status`
				FROM
					kp_bimbingan
				JOIN kp_pengajuan ON kp_pengajuan.id = kp_bimbingan.kp_id
				WHERE kp_pengajuan.dosen_id = '$dosen_id'
				AND kp_bimbingan.`status` = '1'";

		return $this->db->query($sql)->result();
	}
}
