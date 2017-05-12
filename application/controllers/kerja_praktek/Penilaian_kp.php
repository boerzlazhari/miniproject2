<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_kp extends CI_Controller {

	public $menu       = 2;
	public $menu_child = 4;

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
		$data_penilaian = $this->skp_penilaian_m->get_all_data($this->session->userdata('user_id'));

		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Penilaian',
			'header_child' => 'Kerja Praktek STMIK Bandung',
			'view'         => 'kp/penilaian', 
			'user_level'   => $this->session->userdata('user_level'),
			'data_penilaian'  => $data_penilaian
		);

 		$this->load->view('layout', $data);
	}

	public function daftar_penilaian($kp_id, $id, $dosen_id)
	{
		$kp_pengajuan = $this->kp_pengajuan_m->get($kp_id);
		$data_penilaian = $this->skp_penilaian_detail_m->get_data($id);  

		$mahasiswa = new stdClass;
		$mahasiswa->sks = 0;
		$mahasiswa = $this->mahasiswa_m->get($kp_pengajuan->mahasiswa_id);
		$dosen = $this->dosen_m->get($dosen_id);
		$prodi = $this->prodi_m->get($mahasiswa->prodi_id);

		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Pendaftaran',
			'header_child' => 'Pendaftaran Sidang Kerja Praktek',
			'view'         => 'kp/daftar_penilaian', 
			'sks'          => $mahasiswa->sks,
			'mahasiswa'	   => $mahasiswa,
			'dosen'	   	   => $dosen,
			'prodi'		   => $prodi,
			'data_pengajuan' => $kp_pengajuan,
			'data_penilaian'  => $data_penilaian,
			'skp_id'		=> $id
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{
		$array_post = $this->input->post();
		die_dump($array_post);
	
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

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */