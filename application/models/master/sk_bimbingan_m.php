<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sk_bimbingan_m extends MY_Model {

	protected $table       = 'sk_bimbingan'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_all_bimbingan($dosen_id){

		$sql = "SELECT
					sk_bimbingan.id,
					sk_bimbingan.sk_pengajuan_id,
					sk_bimbingan.tanggal,
					sk_bimbingan.notes,
					sk_bimbingan.`status`
				FROM
					sk_bimbingan
				JOIN sk_pengajuan ON sk_pengajuan.id = sk_bimbingan.sk_pengajuan_id
				WHERE sk_pengajuan.dosen_id = '$dosen_id'
				AND sk_bimbingan.`status` = '1'";

		return $this->db->query($sql)->result();
	}
}
