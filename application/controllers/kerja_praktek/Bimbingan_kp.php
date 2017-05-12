<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bimbingan_kp extends CI_Controller {

	public $menu       = 2;
	public $menu_child = 2;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/mahasiswa_m');
		$this->load->model('master/dosen_m');
		$this->load->model('master/prodi_m');
		$this->load->model('master/kp_pengajuan_m');
		$this->load->model('master/kp_bimbingan_m');
		$this->load->model('master/skp_pendaftaran_m');
	}

	public function index()
	{
		if($this->session->userdata('user_level') == 7){
			$data_kp = $this->kp_pengajuan_m->get_where(array('mahasiswa_id' => $this->session->userdata('user_id'), 'status' => 2), true);
			(!empty($data_kp)) ? $data_bimbingan = $this->kp_bimbingan_m->get_where(array('kp_id' => $data_kp->id)) : $data_bimbingan = array();
			$count = count($data_bimbingan);
		}else
		{
			$data_kp = array();
			$data_bimbingan = $this->kp_bimbingan_m->get_all_bimbingan($this->session->userdata('user_id'));
			$count = 0;
		}
		// die_dump($data_bimbingan);
		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Bimbingan',
			'header_child'   => 'Kerja Praktek STMIK Bandung',
			'view'           => 'kp/bimbingan', 
			'user_level'     => $this->session->userdata('user_level'),
			'data_kp'        => $data_kp,
			'data_bimbingan' => $data_bimbingan,
			'count'          => $count
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{
		$array_post = $this->input->post();

		$data = array(
			'kp_id'					 => $array_post['kp_id'],
			'tanggal'                => date("Y-m-d"),
			'notes'					 => $array_post['catatan'],
			'status'				 => 1
		);

		$kp_bimbingan_id = $this->kp_bimbingan_m->insert($data);
	}

	public function approved()
	{
		$array_post = $this->input->post();

		$data_update = array(
			'`status`' => 2
		);

		$where = array(
			'id'				=> $array_post['id']
		);

		$kp_pengajuan_id = $this->kp_bimbingan_m->update($data_update, $where);
		$this->session->set_flashdata('insert_success', '1');
	}

	public function daftar_sidang($id)
	{
		$kp_pengajuan = $this->kp_pengajuan_m->get($id);

		// $mahasiswa = new stdClass;
		// $mahasiswa->sks = 0;
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
			'data_pengajuan' => $kp_pengajuan
		);

 		$this->load->view('layout', $data);
	}

	public function simpan_sidang()
	{
		$array_post = $this->input->post();
		// die_dump($array_post);

		$data = array(
			'kp_id'	=> $array_post['kp_id'],
			'status'	=> 1
		);

		$this->skp_pendaftaran_m->insert($data);
		$this->session->set_flashdata('insert_success', '1');
		redirect('kerja_praktek/bimbingan_kp');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */