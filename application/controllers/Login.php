<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if (!$this->session->userdata('is_login')) {
	 		$this->load->view('login');

	 		// $this->session->set_flashdata('a', 'b');
	 		// die_dump($this->session);
		} 
		else {
	 		redirect('home');
		}
	}

	public function validasi() {

		$this->load->model('user_m');

		$username = $this->input->post('username');	
		$password = $this->input->post('password');	

		$result = $this->user_m->login($username, $password);
		// die_dump($result);

		if (!empty($result)) {
			
			$set_session = array(
				'user_id'    => $result->id,
				'user_name'  => $result->name,
				'user_level' => $result->user_level_id,
				'is_login'   => TRUE
			);
			
			$this->session->set_userdata( $set_session );
		} 
		else {
	 		$this->session->set_flashdata('error', 'Username dan Password Salah!');
	 		$this->session->set_flashdata('username', $username);
		}

		redirect('login');
	}
}
