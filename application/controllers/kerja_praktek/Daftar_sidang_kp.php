<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_sidang_kp extends CI_Controller {

	public $menu       = 2;
	public $menu_child = 3;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/dosen_m');
		$this->load->model('master/prodi_m');
		$this->load->model('master/mahasiswa_m');
		$this->load->model('master/kp_pengajuan_m');
		$this->load->model('master/kp_bimbingan_m');
		$this->load->model('master/skp_penilaian_m');
		$this->load->model('master/skp_pendaftaran_m');
		$this->load->model('master/kategori_penilaian_m');
		$this->load->model('master/skp_penilaian_detail_m');
	}

	public function index()
	{
		if($this->session->userdata('user_level') == 2){
			$status = 2;
			$data_sidang = $this->skp_pendaftaran_m->get_all_data($status);
		}elseif ($this->session->userdata('user_level') == 5) {
			$status = 1;
			$data_sidang = $this->skp_pendaftaran_m->get_all_data($status);
		}
		else
		{
			$data_sidang = array();
		}
		
		// die_dump($data_bimbingan);
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Bimbingan',
			'header_child' => 'Kerja Praktek STMIK Bandung',
			'view'         => 'kp/pendaftaran', 
			'user_level'   => $this->session->userdata('user_level'),
			'data_sidang'  => $data_sidang
		);

 		$this->load->view('layout', $data);
	}

	public function daftar_sidang($kp_id, $id)
	{
		$kp_pengajuan = $this->kp_pengajuan_m->get($kp_id);
		$data_daftar = $this->skp_pendaftaran_m->get($id);  

		$mahasiswa = new stdClass;
		$mahasiswa->sks = 0;
		$mahasiswa = $this->mahasiswa_m->get($kp_pengajuan->mahasiswa_id);
		$dosen = $this->dosen_m->get($kp_pengajuan->dosen_id);
		$prodi = $this->prodi_m->get($mahasiswa->prodi_id);

		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Pendaftaran',
			'header_child' => 'Pendaftaran Sidang Kerja Praktek',
			'view'         => 'kp/daftar_sidang', 
			'sks'          => $mahasiswa->sks,
			'mahasiswa'	   => $mahasiswa,
			'dosen'	   	   => $dosen,
			'prodi'		   => $prodi,
			'data_pengajuan' => $kp_pengajuan,
			'data_daftar'  => $data_daftar
		);

 		$this->load->view('layout', $data);
	}

	public function simpan_sidang()
	{
		$array_post = $this->input->post();
		// die_dump($array_post);
	
		$status = 2;

		$data = array(
			'kp_id'	=> $array_post['kp_id'],
			'notes'	=> $array_post['notes'],
			'another_notes'	=> $array_post['another_notes'],
			'status'	=> $status
		);

		$where = array(
			'id'				=> $array_post['id']
		);

		$this->skp_pendaftaran_m->update($data, $where);
		$this->session->set_flashdata('insert_success', '1');
		redirect('kerja_praktek/Daftar_sidang_kp');
	}

	public function save_penilaian()
	{	
		$array_post = $this->input->post();

		$status = 3;
		$data = array(
			'status'	=> $status
		);

		$where = array(
			'id'				=> $array_post['id']
		);

		$this->skp_pendaftaran_m->update($data, $where);

		$data_nilai_1 = array(
			'kp_id'		=> $array_post['kp_id'],
			'dosen_id'	=> $array_post['dosen_1_id'],
			'status_penguji'	=> 1,
			'status_penilaian'	=> 1
		);
		$skp_penilaian_id_1 = $this->skp_penilaian_m->insert($data_nilai_1);

		$data_nilai_2 = array(
			'kp_id'		=> $array_post['kp_id'],
			'dosen_id'	=> $array_post['dosen_2_id'],
			'status_penguji'	=> 2,
			'status_penilaian'	=> 1
		);

		$skp_penilaian_id_2 = $this->skp_penilaian_m->insert($data_nilai_2);

		$kategori = $this->kategori_penilaian_m->get();

		foreach ($kategori as $data) {
			$data_skp1 = array(
				'skp_penilaian_id' => $skp_penilaian_id_1,
				'kategori_id'	=> $data->id
			);

			$this->skp_penilaian_detail_m->insert($data_skp1);

			$data_skp2 = array(
				'skp_penilaian_id' => $skp_penilaian_id_2,
				'kategori_id'	=> $data->id
			);

			$this->skp_penilaian_detail_m->insert($data_skp2);
		}

	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */