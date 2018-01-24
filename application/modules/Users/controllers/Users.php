<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Users extends MX_Controller {
	 
	function __construct()
    {
      parent::__construct();
      $this->load->model('M_users','usersModel');	  
    }

	public function index()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
    	$data['users'] = $this->usersModel->get_users();
		
		$this->load->view('show',$data);
	}	

	public function add_users()
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['role_id']		= $this->session->flashdata("role_id");
		$data['username']		= $this->session->flashdata("username");
		$data['user_photo']		= $this->session->flashdata("user_photo");
		$data['status']			= $this->session->flashdata("status");
		$data['arr_role']		= $this->usersModel->get_role();
		$this->load->view('form',$data);
	}
	
	public function edit($id)
	{
		$this->M_setting->_make_sure_is_login();
		$this->M_setting->_check_menu();
		
		$data['arr_role']			= $this->usersModel->get_role();
		 
		if(!empty($this->session->flashdata("nama_user"))){
			$data['user_id']		= $id;
			$data['role_id']		= $this->session->flashdata("role_id");
			$data['username']		= $this->session->flashdata("username");
			$data['user_photo']		= $this->session->flashdata("user_photo");
			$data['status']			= $this->session->flashdata("status");
		}else{
			$query = $this->usersModel->edit($id);
			foreach ($query as $result){
				$data['user_id']		= $id;
				$data['role_id']		= $result->role_id;
				$data['username']		= $result->username;
				$data['user_photo']		= $result->user_photo;
				$data['status']			= $result->status;
			}
		}
	
		$this->load->view('form',$data);
	}
	
	public function insert()
	{
		if (!empty($_FILES['user_photo']['name']))
		{
			if($this->input->post('password') == $this->input->post('confirm_password'))
			{
				if($this->M_crud->check_table('users', 'username', $this->input->post('nama', TRUE)) == NULL)
				{
					if (!is_dir('assets/userphoto/')) {
						mkdir('./assets/userphoto/');
					}
					
					$ext = explode(".", $_FILES['user_photo']['name']) ;
					
					$fileName = time();
					$config['upload_path'] = './assets/userphoto';
					$config['file_name'] = url_title($fileName);
					$config['allowed_types'] = '*';
					$this->upload->initialize($config);
					
					$pathfile = "./assets/userphoto/".url_title($fileName).'.'.$ext[1];
					if (file_exists($pathfile)){
						unlink($pathfile);
					}

					if($this->upload->do_upload('user_photo') )
					{						
						$data = array(
								'username' => $this->input->post('nama', TRUE),
								'password' => $this->hash($this->input->post('password', TRUE)),
								'role_id' => $this->input->post('role_id', TRUE),
								'user_photo'  => url_title($fileName).'.'.$ext[1],
								'status' => $this->input->post('status', TRUE),
								'created_by' => $this->session->userdata['simklinik']['ap_sid'],
						);
						
						if(!$this->usersModel->create($data,'users'))
						{
							$data = array(
									'class' => '1',
									'msg' => '<strong>Selamat</strong>, anda berhasil menginput data pengguna.',
							);
							$this->session->set_flashdata('alert',$data);
							redirect('Users');
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
							);
							$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
							$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata("status", $this->input->post('status', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect('Users/add_users');
						}
					}
					else
					{
						$data = array(
								'class' => '0',
								'msg' => $this->upload->display_errors(),
						);
						$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
						$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata("status", $this->input->post('status', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect('Users/add_users');
					}
				}
				else 
				{
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
					$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata("status", $this->input->post('status', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect('Users/add_users');
				}
			}else{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Kata kunci dan konfirmasi kata kunci harus sesuai.',
				);
				$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
				$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
				$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
				$this->session->set_flashdata("status", $this->input->post('status', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Users/add_users');
			}
		}else{
			if($this->input->post('password') == $this->input->post('confirm_password'))
			{
				if($this->M_crud->check_table('users', 'username', $this->input->post('nama', TRUE)) != NULL)
				{
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
					$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata("status", $this->input->post('status', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect('Users/add_users');
				}else{
					$data = array(
							'username' => $this->input->post('nama', TRUE),
							'password' => $this->hash($this->input->post('password', TRUE)),
							'role_id' => $this->input->post('role_id', TRUE),
							'status' => $this->input->post('status', TRUE),
							'created_by' => $this->session->userdata['simklinik']['ap_sid'],
					);
					
					if(!$this->usersModel->create($data,'users'))
					{
						$data = array(
								'class' => '1',
								'msg' => '<strong>Selamat</strong>, anda berhasil menginput data pengguna.',
						);
						$this->session->set_flashdata('alert',$data);
						redirect('Users');
					}
					else
					{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terinput.',
						);
						$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
						$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata("status", $this->input->post('status', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect('Users/add_users');
					}
				}
				
			}else{
				$data = array(
						'class' => '0',
						'msg' => '<strong>Maaf</strong>, Kata kunci dan konfirmasi kata kunci harus sesuai.',
				);
				$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
				$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
				$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
				$this->session->set_flashdata("status", $this->input->post('status', TRUE));
				$this->session->set_flashdata('alert',$data);
				redirect('Users/add_users');
			}
		}
	}
	
	public function update()
	{
		$inpt_pswd = $this->input->post('password');
		$getdata = $this->M_crud->get_by_id('users', 'user_id', $this->input->post('id'));
		$exs_username = $getdata->username;
		$status_username = TRUE;
		$id = $this->input->post('id', TRUE);
		
		if($exs_username <> $this->input->post('nama', TRUE)){
			if($this->M_crud->check_table('users', 'username', $this->input->post('nama', TRUE)) != NULL){
				$status_username = FALSE;
			}else{
				$status_username = TRUE;
			}
		}
		
		if (!empty($_FILES['user_photo']['name']))
		{
			if(!empty($inpt_pswd)){				
				if($status_username == FALSE){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
					$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata("status", $this->input->post('status', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/edit/$id");
				}else{
					if($this->input->post('password') == $this->input->post('confirm_password')){
						if (!is_dir('assets/userphoto/')) {
							mkdir('./assets/userphoto/');
						}
							
						$ext = explode(".", $_FILES['user_photo']['name']) ;
							
						$fileName = time();
						$config['upload_path'] = './assets/userphoto';
						$config['file_name'] = url_title($fileName);
						$config['allowed_types'] = '*';
						$config['max_size'] = config_item('max_image_size');
						$this->upload->initialize($config);
							
						$pathfile = "./assets/userphoto/".url_title($fileName).'.'.$ext[1];
						if (file_exists($pathfile)){
							unlink($pathfile);
						}
						
						if($this->upload->do_upload('user_photo') )
						{
							$data = array(
									'username' => $this->input->post('nama', TRUE),
									'password' => $this->hash($this->input->post('password', TRUE)),
									'role_id' => $this->input->post('role_id', TRUE),
									'user_photo'  => url_title($fileName).'.'.$ext[1],
									'status' => $this->input->post('status', TRUE),
									'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
							);
						
							if(!$this->usersModel->update($id,$data,'user_id','users'))
							{
								$data = array(
										'class' => '1',
										'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
								);
								$this->session->set_flashdata('alert',$data);
								redirect('Users');
							}
							else
							{
								$data = array(
										'class' => '0',
										'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
								);
								$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
								$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
								$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
								$this->session->set_flashdata("status", $this->input->post('status', TRUE));
								$this->session->set_flashdata('alert',$data);
								redirect("Users/edit/$id");
							}
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => $this->upload->display_errors(),
							);
							$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
							$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata("status", $this->input->post('status', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/edit/$id");
						}
					}else{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Kata kunci dan konfirmasi kata kunci harus sesuai.',
						);
						$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
						$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata("status", $this->input->post('status', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/edit/$id");
					}
				}				
			}
			else{
				if($status_username == FALSE){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
					$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata("status", $this->input->post('status', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/edit/$id");
				}else{
					if (!is_dir('assets/userphoto/')) {
						mkdir('./assets/userphoto/');
					}
					
					$ext = explode(".", $_FILES['user_photo']['name']) ;
					
					$fileName = time();
					$config['upload_path'] = './assets/userphoto';
					$config['file_name'] = url_title($fileName);
					$config['allowed_types'] = '*';
					$config['max_size'] = config_item('max_image_size');
					$this->upload->initialize($config);
					
					$pathfile = "./assets/userphoto/".url_title($fileName).'.'.$ext[1];
					if (file_exists($pathfile)){
						unlink($pathfile);
					}
					
					if($this->upload->do_upload('user_photo') )
					{
						$data = array(
								'username' => $this->input->post('nama', TRUE),
								'role_id' => $this->input->post('role_id', TRUE),
								'user_photo'  => url_title($fileName).'.'.$ext[1],
								'status' => $this->input->post('status', TRUE),
								'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
						);
					
						if(!$this->usersModel->update($id,$data,'user_id','users'))
						{
							$data = array(
									'class' => '1',
									'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
							);
							$this->session->set_flashdata('alert',$data);
							redirect('Users');
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
							);
							$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
							$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata("status", $this->input->post('status', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/edit/$id");
						}
					}
					else
					{
						$data = array(
								'class' => '0',
								'msg' => $this->upload->display_errors(),
						);
						$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
						$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata("status", $this->input->post('status', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/edit/$id");
					}
				}
			}
		}
		else
		{
			if(!empty($inpt_pswd))
			{
				if($status_username == FALSE){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
					$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata("status", $this->input->post('status', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/edit/$id");
				}else{
					if($this->input->post('password') == $this->input->post('confirm_password'))
					{
							
						$data = array(
								'username' => $this->input->post('nama', TRUE),
								'password' => $this->hash($this->input->post('password', TRUE)),
								'role_id' => $this->input->post('role_id', TRUE),
								'status' => $this->input->post('status', TRUE),
								'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
						);
							
						if(!$this->usersModel->update($id,$data,'user_id','users'))
						{
							$data = array(
									'class' => '1',
									'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
							);
							$this->session->set_flashdata('alert',$data);
							redirect('Users');
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
							);
							$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
							$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata("status", $this->input->post('status', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/edit/$id");
						}
					}else{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Kata kunci dan konfirmasi kata kunci harus sesuai.',
						);
						$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
						$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata("status", $this->input->post('status', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/edit/$id");
					}
				}	
			}
			else
			{
				if($status_username == FALSE)
				{
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
					$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata("status", $this->input->post('status', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/edit/$id");
				}
				else 
				{
					$data = array(
							'username' => $this->input->post('nama', TRUE),
							'role_id' => $this->input->post('role_id', TRUE),
							'status' => $this->input->post('status', TRUE),
							'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
					);
					
					if(!$this->usersModel->update($id,$data,'user_id','users'))
					{
						$data = array(
								'class' => '1',
								'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
						);
						$this->session->set_flashdata('alert',$data);
						redirect('Users');
					}
					else
					{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
						);
						$this->session->set_flashdata("role_id", $this->input->post('role_id', TRUE));
						$this->session->set_flashdata("username", $this->input->post('nama', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata("status", $this->input->post('status', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/edit/$id");
					}
				}
			}
		}
	}
	
	function delete($id)
	{
		if(!$this->usersModel->delete('user_id',$id,'users'))
		{
			$data = array(
					'class' => '1',
					'msg' => '<strong>Selamat</strong>, anda berhasil menghapus data pengguna.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect('Users');
		}
		else
		{
			$data = array(
					'class' => '0',
					'msg' => '<strong>Maaf</strong>, Data tidak terhapus.',
			);
			$this->session->set_flashdata('alert',$data);
			redirect("Users");
		}
	}
	
	function hash($string){
		return hash('sha512', $string . config_item('encryption_key'));
	}
	
	function users_profile($id)
	{				 
		$query = $this->usersModel->edit($id);
		foreach ($query as $result){
			$data['user_id']		= $id;
			$data['username']		= $result->username;
			$data['user_photo']		= $result->user_photo;
		}
	
		$this->load->view('form_profile',$data);
	}
	
	public function update_profile()
	{
		$inpt_pswd = $this->input->post('password');
		$getdata = $this->M_crud->get_by_id('users', 'user_id', $this->input->post('id'));
		$exs_username = $getdata->username;
		$status_username = TRUE;
		$id = $this->input->post('id', TRUE);
	
		if($exs_username <> $this->input->post('username', TRUE)){
			if($this->M_crud->check_table('users', 'username', $this->input->post('username', TRUE)) != NULL){
				$status_username = FALSE;
			}else{
				$status_username = TRUE;
			}
		}
	
		if (!empty($_FILES['user_photo']['name']))
		{
			if(!empty($inpt_pswd)){
				if($status_username == FALSE){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("username", $this->input->post('username', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/users_profile/$id");
				}else{
					if($this->input->post('password') == $this->input->post('confirm_password')){
						if (!is_dir('assets/userphoto/')) {
							mkdir('./assets/userphoto/');
						}
							
						$ext = explode(".", $_FILES['user_photo']['name']) ;
							
						$fileName = time();
						$config['upload_path'] = './assets/userphoto';
						$config['file_name'] = url_title($fileName);
						$config['allowed_types'] = '*';
						$config['max_size'] = config_item('max_image_size');
						$this->upload->initialize($config);
							
						$pathfile = "./assets/userphoto/".url_title($fileName).'.'.$ext[1];
						if (file_exists($pathfile)){
							unlink($pathfile);
						}
	
						if($this->upload->do_upload('user_photo') )
						{
							$data = array(
									'username' => $this->input->post('username', TRUE),
									'password' => $this->hash($this->input->post('password', TRUE)),
									'user_photo'  => url_title($fileName).'.'.$ext[1],
									'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
							);
	
							if(!$this->usersModel->update($id,$data,'user_id','users'))
							{
								$data = array(
										'class' => '1',
										'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
								);
								$this->session->set_flashdata("username", $this->input->post('username', TRUE));
								$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
								$this->session->set_flashdata('alert',$data);
								redirect("Users/users_profile/$id");
							}
							else
							{
								$data = array(
										'class' => '0',
										'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
								);
								$this->session->set_flashdata("username", $this->input->post('username', TRUE));
								$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
								$this->session->set_flashdata('alert',$data);
								redirect("Users/users_profile/$id");
							}
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => $this->upload->display_errors(),
							);
							$this->session->set_flashdata("username", $this->input->post('username', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/users_profile/$id");
						}
					}else{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Kata kunci dan konfirmasi kata kunci harus sesuai.',
						);
						$this->session->set_flashdata("username", $this->input->post('username', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/users_profile/$id");
					}
				}
			}
			else{
				if($status_username == FALSE){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("username", $this->input->post('username', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/users_profile/$id");
				}else{
					if (!is_dir('assets/userphoto/')) {
						mkdir('./assets/userphoto/');
					}
						
					$ext = explode(".", $_FILES['user_photo']['name']) ;
						
					$fileName = time();
					$config['upload_path'] = './assets/userphoto';
					$config['file_name'] = url_title($fileName);
					$config['allowed_types'] = '*';
					$config['max_size'] = config_item('max_image_size');
					$this->upload->initialize($config);
						
					$pathfile = "./assets/userphoto/".url_title($fileName).'.'.$ext[1];
					if (file_exists($pathfile)){
						unlink($pathfile);
					}
						
					if($this->upload->do_upload('user_photo') )
					{
						$data = array(
								'username' => $this->input->post('username', TRUE),
								'user_photo'  => url_title($fileName).'.'.$ext[1],
								'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
						);
							
						if(!$this->usersModel->update($id,$data,'user_id','users'))
						{
							$data = array(
									'class' => '1',
									'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
							);
							$this->session->set_flashdata("username", $this->input->post('username', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/users_profile/$id");
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
							);
							$this->session->set_flashdata("username", $this->input->post('username', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/users_profile/$id");
						}
					}
					else
					{
						$data = array(
								'class' => '0',
								'msg' => $this->upload->display_errors(),
						);
						$this->session->set_flashdata("username", $this->input->post('username', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/users_profile/$id");
					}
				}
			}
		}
		else
		{
			if(!empty($inpt_pswd))
			{
				if($status_username == FALSE){
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("username", $this->input->post('username', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/users_profile/$id");
				}else{
					if($this->input->post('password') == $this->input->post('confirm_password'))
					{
							
						$data = array(
								'username' => $this->input->post('username', TRUE),
								'password' => $this->hash($this->input->post('password', TRUE)),
								'updated_by' => $this->session->userdata['simklinik']['ap_sid'],
						);
							
						if(!$this->usersModel->update($id,$data,'user_id','users'))
						{
							$data = array(
									'class' => '1',
									'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
							);
							$this->session->set_flashdata("username", $this->input->post('username', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/users_profile/$id");
						}
						else
						{
							$data = array(
									'class' => '0',
									'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
							);
							$this->session->set_flashdata("username", $this->input->post('username', TRUE));
							$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
							$this->session->set_flashdata('alert',$data);
							redirect("Users/users_profile/$id");
						}
					}else{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Kata kunci dan konfirmasi kata kunci harus sesuai.',
						);
						$this->session->set_flashdata("username", $this->input->post('username', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/users_profile/$id");
					}
				}
			}
			else
			{
				if($status_username == FALSE)
				{
					$data = array(
							'class' => '0',
							'msg' => '<strong>Maaf</strong>, Nama pengguna ini sudah ada.',
					);
					$this->session->set_flashdata("username", $this->input->post('username', TRUE));
					$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
					$this->session->set_flashdata('alert',$data);
					redirect("Users/users_profile/$id");
				}
				else
				{
					$data = array(
							'username' => $this->input->post('username', TRUE),
					);
						
					if(!$this->usersModel->update($id,$data,'user_id','users'))
					{
						$data = array(
								'class' => '1',
								'msg' => '<strong>Selamat</strong>, anda berhasil mengubah data pengguna.',
						);
						$this->session->set_flashdata("username", $this->input->post('username', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/users_profile/$id");
					}
					else
					{
						$data = array(
								'class' => '0',
								'msg' => '<strong>Maaf</strong>, Data yang anda masukan tidak terubah.',
						);
						$this->session->set_flashdata("username", $this->input->post('username', TRUE));
						$this->session->set_flashdata("user_photo", $this->input->post('user_photo', TRUE));
						$this->session->set_flashdata('alert',$data);
						redirect("Users/users_profile/$id");
					}
				}
			}
		}
	}
	
	function cetak()
	{
		$data['pengguna']=$this->usersModel->get_users();
		$this->load->view('print',$data);
	}
	
	function doexport()
	{
		$header = [
				'No',
				'Nama Pengguna',
				'Tipe Akses',
				'Status'
		];
		 
		$dataList = array();
		$list = $this->usersModel->get_users();
		$no = 0;
		foreach ($list as $datas)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $datas->username;
			$row[] = $datas->role_name;
			$row[] = $datas->status;
			$dataList[] = $row;
		}
		 
		$writer = WriterFactory::create(Type::XLSX);
		$namaFile = 'Data_Pengguna_'.date('Ymd') . '.xlsx';
		$writer->openToBrowser($namaFile);
		$writer->addRow($header);
		$writer->addRows($dataList);
		$writer->close();
	}
}
