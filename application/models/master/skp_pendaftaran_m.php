<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Skp_pendaftaran_m extends MY_Model {

	protected $table       = 'skp_pendaftaran'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_all_data($status){

		$sql = "SELECT
					skp_pendaftaran.id,
					skp_pendaftaran.kp_id,
					mahasiswa.nama,
					kp_pengajuan.judul
				FROM
					skp_pendaftaran
				JOIN kp_pengajuan ON kp_pengajuan.id = skp_pendaftaran.kp_id
				JOIN mahasiswa ON kp_pengajuan.mahasiswa_id = mahasiswa.id
				WHERE
					skp_pendaftaran.`status` = '$status'";

		return $this->db->query($sql)->result();
	}

}
