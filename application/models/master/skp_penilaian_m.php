<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Skp_penilaian_m extends MY_Model {

	protected $table       = 'skp_penilaian'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_all_data($dosen_id){

		$sql ="SELECT
				skp_penilaian.id,
				skp_penilaian.dosen_id,
				kp_pengajuan.id as kp_id,
				mahasiswa.nama,
				kp_pengajuan.judul
			FROM
				skp_penilaian
			JOIN kp_pengajuan ON kp_pengajuan.id = skp_penilaian.kp_id
			JOIN mahasiswa ON kp_pengajuan.mahasiswa_id = mahasiswa.id
			WHERE
				skp_penilaian.dosen_id = $dosen_id";

		return $this->db->query($sql)->result();
	}	
}
