<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sk_pengajuan_m extends MY_Model {

	protected $table       = 'sk_pengajuan'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_data_pengajuan()
	{
		$sql = "SELECT
					skp.id , skp.judul , skp.transkrip_nilai , skp.bukti_bayar , skp.proposal , m.nim , m.nama
				FROM
					sk_pengajuan skp
				LEFT JOIN mahasiswa m ON m.id = skp.mahasiswa_id 
				WHERE skp.status = 1 ";

		return $this->db->query($sql)->result();
	}

	public function get_data_pengajuan_mhs($id)
	{
		$sql = "SELECT
					skp.id , skp.judul , skp.transkrip_nilai , skp.bukti_bayar , skp.proposal , m.nim , m.nama, m.id AS mhs_id
				FROM
					sk_pengajuan skp
				LEFT JOIN mahasiswa m ON m.id = skp.mahasiswa_id 
				WHERE skp.status = 1 AND skp.id = $id ";

		return $this->db->query($sql)->row();
	}

}
