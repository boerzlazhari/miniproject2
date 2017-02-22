<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_pengajuan_sk extends CI_Controller {

	public $menu       = 3;
	public $menu_child = 2;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/sk_pengajuan_m');
		$this->load->model('master/mahasiswa_m');
	}

	public function index()
	{	
		if ($this->session->userdata('user_level') == 5) {
			$data_pengajuan = $this->sk_pengajuan_m->get_data_pengajuan(1);
		}
		elseif ($this->session->userdata('user_level') == 4) {
			$data_pengajuan = $this->sk_pengajuan_m->get_data_pengajuan(2);
		}
		elseif ($this->session->userdata('user_level') == 2) {
			$data_pengajuan = $this->sk_pengajuan_m->get_data_pengajuan(3);
		}
		else {
			$data_pengajuan = array();
		}

		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Daftar Pengajuan',
			'header_child'   => 'Skripsi STMIK Bandung',
			'view'           => 'sk/daftar_pengajuan', 
			'data_pengajuan' => $data_pengajuan
		);

 		$this->load->view('layout', $data);
	}

	public function proses($id)
	{
		$mahasiswa = $this->sk_pengajuan_m->get_data_pengajuan_mhs($id);
		// die_dump($mahasiswa);
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Daftar Pengajuan',
			'header_child' => 'Skripsi STMIK Bandung',
			'view'         => 'sk/proses', 
			'pk'           => $id,
			'data_mhs'     => $mahasiswa,
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{	
		$array_post = $this->input->post();

		$data = array(
			'mahasiswa_id'      => $this->session->userdata('user_id'),
			'tanggal_pengajuan' => date('Y-m-d', strtotime($array_post['tgl_pengajuan'])),
			'judul'             => $array_post['judul'],
			'transkrip_nilai'   => $array_post['fileupload_nilai'],
			'bukti_bayar'       => $array_post['fileupload_transfer'],
			'proposal'          => $array_post['fileupload_proposal'],
			'status'            => 1
		);

		$sk_pengajuan_id = $this->sk_pengajuan_m->insert($data);
		$this->session->set_flashdata('insert_success', '1');
		redirect('skripsi/pengajuan_sk');
	}
}

/* End of file Daftar_pengajuan_sk.php */
/* Location: ./application/controllers/Daftar_pengajuan_sk.php */