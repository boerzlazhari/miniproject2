<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_kp extends CI_Controller {

	public $menu       = 1;
	public $menu_child = 0;

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

		$data_status = array(
			'status_penilaian' => 2
		);

		$where1 = array(
			'id'	=> $array_post['id']
		);

		$this->skp_penilaian_m->update($data_status, $where1);


		for ($i=1; $i < 11; $i++) { 

			$data = array(
				'nilai' => $array_post['nilai_'.$i]
			);

			$where = array(
				'id'	=> $array_post['id_'.$i]
			);

			$this->skp_penilaian_detail_m->update($data, $where);
		}

		$this->session->set_flashdata('insert_success', '1');
		redirect('kerja_praktek/Penilaian_kp');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */