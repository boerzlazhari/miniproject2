<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan_prasidang extends CI_Controller {

	public $menu       = 3;
	public $menu_child = 3;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/sk_pengajuan_m');
		$this->load->model('master/pra_sk_pengajuan_m');
		$this->load->model('master/mahasiswa_m');
	}

	public function index()
	{
		$data_pengajuan   = $this->pra_sk_pengajuan_m->get_data($this->session->userdata('user_id'));
		$status_pengajuan = $this->sk_pengajuan_m->get_where(array('status' => 5, 'mahasiswa_id' => $this->session->userdata('user_id')), true);

		$data = array(
			'menu'             => $this->menu,
			'menu_child'       => $this->menu_child,	
			'header'           => 'Pendaftaran Pra Sidang',
			'header_child'     => 'Skripsi STMIK Bandung',
			'view'             => 'sk/prasidang/pengajuan_prasidang', 
			'data_pengajuan'   => object_to_array($data_pengajuan),
			'status_pengajuan' => $status_pengajuan
		);

 		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$data_pengajuan = $this->sk_pengajuan_m->get_data_pendaftaran($this->session->userdata('user_id'));

		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Pendaftaran Pra Sidang',
			'header_child'   => 'Tambah Pendaftaran Pra Sidang',
			'view'           => 'sk/prasidang/tambah', 
			'data_pengajuan' => $data_pengajuan
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{	
		$array_post = $this->input->post();

		$data = array(
			'sk_pengajuan_id'   => $array_post['skp_id'],
			'tanggal_pengajuan' => date('Y-m-d'),
			'notes'             => $array_post['catatan'],
			'status'            => 1
		);

		$pra_sk_pengajuan_id = $this->pra_sk_pengajuan_m->insert($data);
		$this->session->set_flashdata('insert_success', '1');
		redirect('skripsi/pengajuan_prasidang');
	}

}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */