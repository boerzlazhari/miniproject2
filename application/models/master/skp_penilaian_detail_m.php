<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Skp_penilaian_detail_m extends MY_Model {

	protected $table       = 'skp_penilaian_detail'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

	public function get_data($id){

		$sql ="SELECT
					skp_penilaian_detail.id,	
					kategori_penilaian.description
				FROM
					skp_penilaian_detail
				JOIN kategori_penilaian ON skp_penilaian_detail.kategori_id = kategori_penilaian.id
				WHERE skp_penilaian_detail.skp_penilaian_id = $id";

		return $this->db->query($sql)->result();
	}	
}
