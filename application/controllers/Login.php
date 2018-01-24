<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_login','modelLogin');
	}
	
	public function index()
	{
		if($_POST){
			$username    = $this->input->post('username', TRUE);
			$password 	 = $this->input->post('password', TRUE);
			
			$result = $this->modelLogin->authenticate($username, $password);
			if ($result == FALSE){
				$this->session->set_flashdata("notif",
				"<div class=\"alert bg-alert-success alert-styled-left\">
						<span class=\"text-semibold\">Login gagal, cek nama pengguna dan kata sandi anda !</span>
					</div>");
			}
			else
			{
				$getdata = $this->M_crud->get_by_id('role', 'role_id', $result[0]->role_id);
			
				$session_data = array(
						'ap_sid' 			=> $result[0]->user_id,
						'ap_username' 		=> $result[0]->username,
						'ap_role_name' 		=> $getdata->role_name,
						'ap_role'			=> $result[0]->role_id,
						'ap_image'			=> $result[0]->user_photo,
						'ap_is_admin'		=> $result[0]->is_admin,
						'ap_status_login'	=> 'Ok',
				);
			
				$this->session->set_userdata('simklinik', $session_data);
			
				redirect('beranda');
			}
		}
		$this->load->view('Login');
	}
	
	public function save_password()
	{
		$now = new DateTime ( NULL, new DateTimeZone('Asia/Jakarta'));
		if($this->input->post('password') == $this->input->post('confirm_password', TRUE))
		{
			$data = array(
					'password'    	=> $this->hash($this->input->post('password', TRUE)),
					'update_at'     => $now->format('Y-m-d H:i:s'),
					'update_by'     => $this->input->post('id'),
			);
			$update = $this->M_crud->update('users', array('id' => $this->input->post('id')), $data);
			if($update > 0){
				$this->session->set_flashdata("notif",
						"<div class=\"alert bg-alert-success alert-styled-left\">
								<span class=\"text-semibold\">Ganti password berhasil.</span>
							</div>");
				redirect("Signin");
			}else{
				$this->session->set_flashdata("notif",
						"<div class=\"alert bg-warning alert-styled-left\">
						<span class=\"text-semibold\" style=\"color: #ce7a7a\">Ganti password gagal !, silahkan coba lagi.</span>
					</div>");
				redirect("Signin/reset_password/token/".$this->input->post('token'));
			}
		}
		else
		{
			$this->session->set_flashdata("notif",
					"<div class=\"alert bg-warning alert-styled-left\">
						<span class=\"text-semibold\" style=\"color: #ce7a7a\">Password and Confirm Password doesn't match !</span>
					</div>");
			redirect("Signin/reset_password/token/".$this->input->post('token'));
		}
	}
	
	function hash($string){
		return hash('sha512', $string . config_item('encryption_key'));
	}
}