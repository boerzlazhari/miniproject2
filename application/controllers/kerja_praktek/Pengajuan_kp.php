<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan_kp extends CI_Controller {

	public $menu       = 2;
	public $menu_child = 1;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/kp_pengajuan_m');
		$this->load->model('master/mahasiswa_m');
		$this->load->model('master/dosen_m');
	}

	public function index()
	{
		// die_dump($this->session->userdata('user_level'));
		$count = 0;
		if($this->session->userdata('user_level') == 7){
			$data_pengajuan = $this->kp_pengajuan_m->get_where(array('mahasiswa_id' => $this->session->userdata('user_id')));
			$count_data_reject = $this->kp_pengajuan_m->get_pengajuan($this->session->userdata('user_id'));

			$count = $count_data_reject[0]->jumlah;
			// die_dump($count_data_reject);
		}else
		{
			$data_pengajuan = $this->kp_pengajuan_m->get_where(array('status' => 1));
			$count = 1;
		}

		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Pengajuan',
			'header_child'   => 'Kerja Praktek STMIK Bandung',
			'view'           => 'kp/pengajuan', 
			'data_pengajuan' => $data_pengajuan,
			'user_level'	 => $this->session->userdata('user_level'),
			'count'			 => $count,
		);

 		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$mahasiswa = new stdClass;
		$mahasiswa->sks = 0;
		if($this->session->userdata('user_level') == 7)
		{
			$mahasiswa = $this->mahasiswa_m->get($this->session->userdata('user_id'));
		}

		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Pengajuan',
			'header_child' => 'Tambah Pengajuan Kerja Praktek',
			'view'         => 'kp/tambah', 
			'sks'          => $mahasiswa->sks
		);

 		$this->load->view('layout', $data);
	}

	public function proses($id)
	{
		// $kp_pengajuan = new stdClass;
		// if($this->session->userdata('user_level') == 5)
		// {
			$kp_pengajuan = $this->kp_pengajuan_m->get($id);
		// }

		// die_dump($kp_pengajuan);
		$data = array(
			'menu'         	 => $this->menu,
			'menu_child'   	 => $this->menu_child,	
			'header'       	 => 'Pengajuan',
			'header_child' 	 => 'Persetujuan Pengajuan Kerja Praktek',
			'view'         	 => 'kp/proses', 
			'data_pengajuan' => $kp_pengajuan,
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{	
		$array_post = $this->input->post();

		$data = array(
			'mahasiswa_id'      => $this->session->userdata('user_id'),
			'tanggal_pengajuan' => date('Y-m-d', strtotime($array_post['tgl_pengajuan'])),
			'nama_tempat'       => $array_post['tempat'],
			'judul'             => $array_post['judul'],
			'bukti_tp'	        => $array_post['fileupload_transfer'],
			'proposal'          => $array_post['fileupload_proposal'],
			'status'            => 1
		);

		$kp_pengajuan_id = $this->kp_pengajuan_m->insert($data);
		$this->session->set_flashdata('insert_success', '1');
		redirect('kerja_praktek/pengajuan_kp');
	}

	public function update_reason()
	{	
		$array_post = $this->input->post();

		$data = array(
			'unapproved_reason'          => $array_post['reason'],
			'status'            		 => 3
		);

		$where = array(
			'id'				=> $array_post['id']
		);

		$kp_pengajuan_id = $this->kp_pengajuan_m->update($data, $where);
	}

	public function approved()
	{	
		$array_post = $this->input->post();

		$data = array(
			'dosen_id'					 => $array_post['dosen_id'],
			'status'            		 => 2
		);

		$where = array(
			'id'				=> $array_post['id']
		);

		$kp_pengajuan_id = $this->kp_pengajuan_m->update($data, $where);
	}

	public function do_upload($type)
	{
		$path = 'upload/'.$this->session->userdata('nim').'_'.$this->session->userdata('user_name');
		create_folder($path);

		switch ($type) {
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