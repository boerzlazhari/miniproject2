<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sk_pengajuan_m extends MY_Model {

	protected $table       = 'sk_pengajuan'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_data_pengajuan($status)
	{
		$status = $status;
		$sql = "SELECT
					skp.id , skp.judul , skp.tanggal_pengajuan , skp.tanggal_wawancara , skp.transkrip_nilai , skp.bukti_bayar , skp.proposal , skp.status, m.nim , m.nama,
					d.nama AS pembimbing
				FROM
					sk_pengajuan skp
				LEFT JOIN mahasiswa m ON m.id = skp.mahasiswa_id 
				LEFT JOIN dosen d ON d.id = skp.dosen_id
				WHERE skp.status IN (".implode(",",$status).") ";

		return $this->db->query($sql)->result_array();
	}

	public function get_data_pengajuan_mhs($id)
	{
		$sql = "SELECT
					skp.id , skp.judul, skp.tanggal_pengajuan, skp.tanggal_wawancara , skp.dosen_id, skp.transkrip_nilai , skp.bukti_bayar , skp.proposal , m.nim , m.nama, m.id AS mhs_id, m.sks
				FROM
					sk_pengajuan skp
				LEFT JOIN mahasiswa m ON m.id = skp.mahasiswa_id 
				WHERE skp.id = $id ";

		return $this->db->query($sql)->row();
	}

	public function get_data_pendaftaran($mahasiswa_id)
	{
		$sql = "SELECT
					skp.id , skp.judul, skp.tanggal_pengajuan, skp.tanggal_wawancara , skp.dosen_id, skp.transkrip_nilai , skp.bukti_bayar , skp.proposal , m.nim , m.nama, m.id AS mhs_id, m.sks, d.nama AS pembimbing
				FROM
					sk_pengajuan skp
				LEFT JOIN mahasiswa m ON m.id = skp.mahasiswa_id 
				LEFT JOIN dosen d ON d.id = skp.dosen_id
				WHERE skp.mahasiswa_id = $mahasiswa_id AND skp.status = 5";

		return $this->db->query($sql)->row();
	}

}
