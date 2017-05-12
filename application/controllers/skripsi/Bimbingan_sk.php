<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bimbingan_sk extends CI_Controller {

	public $menu       = 1;
	public $menu_child = 0;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/mahasiswa_m');
		$this->load->model('master/dosen_m');
		$this->load->model('master/prodi_m');
		$this->load->model('master/sk_pengajuan_m');
		$this->load->model('master/sk_bimbingan_m');
	}

	public function index()
	{
		if($this->session->userdata('user_level') == 7){
			$data_sk = $this->sk_pengajuan_m->get_where(array('mahasiswa_id' => $this->session->userdata('user_id'), 'status' => 5), true);
			if(empty($data_sk)){
				$data_bimbingan = array();
				$count = 0;
			}else
			{
				$data_bimbingan = $this->sk_bimbingan_m->get_where(array('sk_pengajuan_id' => $data_sk->id));
				$count = count($data_bimbingan);
			}
		}else
		{
			$data_sk = array();
			$data_bimbingan = $this->sk_bimbingan_m->get_all_bimbingan($this->session->userdata('user_id'));
			$count = 0;
		}
		// die_dump($data_bimbingan);
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Bimbingan',
			'header_child' => 'Kerja Praktek STMIK Bandung',
			'view'         => 'sk/bimbingan', 
			'user_level'	 => $this->session->userdata('user_level'),
			'data_sk'	   =>  $data_sk,
			'data_bimbingan' => $data_bimbingan,
			'count'		   => $count
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{
		$array_post = $this->input->post();
		
		$data = array(
			'sk_pengajuan_id'		 => $array_post['sk_pengajuan_id'],
			'tanggal'                => date("Y-m-d"),
			'notes'					 => $array_post['catatan'],
			'status'				 => 1
		);
		
		$sk_bimbingan_id = $this->sk_bimbingan_m->insert($data);
		// die_dump($this->db->last_query());
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

		$sk_pengajuan_id = $this->sk_bimbingan_m->update($data_update, $where);
		$this->session->set_flashdata('insert_success', '1');
	}

	public function daftar_sidang($id)
	{
		$sk_pengajuan = $this->sk_pengajuan_m->get($id);

		$mahasiswa = new stdClass;
		$mahasiswa->sks = 0;
		$mahasiswa = $this->mahasiswa_m->get($sk_pengajuan->mahasiswa_id);
		$dosen = $this->dosen_m->get($sk_pengajuan->dosen_id);
		$prodi = $this->prodi_m->get($mahasiswa->prodi_id);

		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Pendaftaran',
			'header_child' => 'Pendaftaran Sidang Kerja Praktek',
			'view'         => 'sk/daftar_sidang', 
			'sks'          => $mahasiswa->sks,
			'mahasiswa'	   => $mahasiswa,
			'dosen'	   	   => $dosen,
			'prodi'		   => $prodi,
			'data_pengajuan' => $sk_pengajuan
		);

 		$this->load->view('layout', $data);
	}

	public function simpan_sidang()
	{
		$array_post = $this->input->post();
		// die_dump($array_post);

		$data = array(
			'sk_pengajuan_id'	=> $array_post['sk_pengajuan_id'],
			'status'	=> 1
		);

		$this->ssk_pendaftaran_m->insert($data);
		$this->session->set_flashdata('insert_success', '1');
		redirect('kerja_praktek/bimbingan_sk');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */