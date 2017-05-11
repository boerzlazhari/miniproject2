<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pra_sk_pengajuan_m extends MY_Model {

	protected $table       = 'pra_sk_pengajuan'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_data($mahasiswa_id)
	{
		$sql = "SELECT
					psp.id , psp.sk_pengajuan_id , psp.tanggal_pengajuan ,
					psp.notes , psp.`status` , psp.tanggal_sidang ,
					psp.tanggal_approved, skp.mahasiswa_id,
					skp.judul, skp.dosen_id, d.nama AS pembimbing, m.nama, m.nim
				FROM
					pra_sk_pengajuan psp
				JOIN sk_pengajuan skp ON skp.id = psp.sk_pengajuan_id
				JOIN mahasiswa m ON m.id = skp.mahasiswa_id
				JOIN dosen d ON d.id = skp.dosen_id
				WHERE skp.mahasiswa_id = $mahasiswa_id ";

		return $this->db->query($sql)->result_array();
	}

	public function get_data_prasidang($id)
	{
		$sql = "SELECT
					psp.id , psp.sk_pengajuan_id , psp.tanggal_pengajuan ,
					psp.notes , psp.`status` , psp.tanggal_sidang ,
					psp.tanggal_approved, skp.mahasiswa_id,
					skp.judul, skp.dosen_id, d.nama AS pembimbing, m.nama, m.nim
				FROM
					pra_sk_pengajuan psp
				JOIN sk_pengajuan skp ON skp.id = psp.sk_pengajuan_id
				JOIN mahasiswa m ON m.id = skp.mahasiswa_id
				JOIN dosen d ON d.id = skp.dosen_id
				WHERE psp.id = $id ";

		return $this->db->query($sql)->row();
	}

	public function get_datatable($status)
	{
		$status = implode(",", $status);
		$sql = "SELECT
					psp.id ,
					psp.sk_pengajuan_id ,
					psp.tanggal_pengajuan ,
					psp.notes ,
					psp.`status` ,
					psp.tanggal_sidang ,
					psp.tanggal_approved,
					skp.mahasiswa_id,
					skp.judul,
					skp.dosen_id,
					m.nim,
					m.nama,
					d.nama AS pembimbing
				FROM
					pra_sk_pengajuan psp
				JOIN sk_pengajuan skp ON skp.id = psp.sk_pengajuan_id
				JOIN mahasiswa m ON m.id = skp.mahasiswa_id
				JOIN dosen d ON d.id = skp.dosen_id
				WHERE psp.`status` IN ($status)";

		return $this->db->query($sql)->result_array();
	}
}
