<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan_sidang extends CI_Controller {

	public $menu       = 3;
	public $menu_child = 5;

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
		$data_pengajuan = $this->sk_pengajuan_m->get_where(array('mahasiswa_id' => $this->session->userdata('user_id')));
		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Pengajuan',
			'header_child'   => 'Skripsi STMIK Bandung',
			'view'           => 'sk/pengajuan', 
			'data_pengajuan' => object_to_array($data_pengajuan)
		);

 		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$mahasiswa = $this->mahasiswa_m->get($this->session->userdata('user_id'));
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Pengajuan',
			'header_child' => 'Tambah Pengajuan Skripsi',
			'view'         => 'sk/tambah', 
			'sks'          => $mahasiswa->sks
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

	public function do_upload($type)
	{
		$path = 'upload/'.$this->session->userdata('nim').'_'.$this->session->userdata('user_name');
		create_folder($path);

		switch ($type) {
			case 1:
				$file_name   = 'transkrip_nilai';
				$upload_name = 'fileupload_nilai';
				break;
			case 2:
				$file_name   = 'bukti_transfer';
				$upload_name = 'fileupload_transfer';
				break;
			case 3:
				$file_name   = 'proposal';
				$upload_name = 'fileupload_proposal';
				break;
			default: break;
		}

		$config['upload_path']   = $path;
		$config['file_name']     = $file_name;

		$this->load->library('upload', $config);
        $this->upload->initialize($config);        
        $this->upload->set_allowed_types('*');
		
		if ( ! $this->upload->do_upload($upload_name)){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo json_encode($data);
		}	
	}
}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */