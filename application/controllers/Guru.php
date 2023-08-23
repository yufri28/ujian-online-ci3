<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class guru extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if ($this->session->userdata('status') != 'admin_login') {
			redirect(base_url('auth'));
		}

	}

	public function index()
	{
		$data['guru'] = $this->m_data->get_data('tb_guru')->result();
		$this->load->view('admin/v_guru', $data);
	}

	public function guru_aksi()
	{
		$nik		= htmlspecialchars($this->input->post('nik'));
		$nama 		= htmlspecialchars($this->input->post('nama'));		
		$username	= htmlspecialchars($this->input->post('username'));
		$password	= htmlspecialchars($this->input->post('password'));

		$username_siswa = $this->db->get_where('tb_siswa', ['username' => $username])->row_array();

		if($username_siswa){
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-times"></i><b>Maaf ! <br></b> Username sudah digunakan</div>');
		}else{
			$data = array(
				'id_guru'=>$nik,
				'nama_guru'=>$nama,
				'username'=>$username,
				'password'=> password_hash($password, PASSWORD_DEFAULT),
			);
	
			if(!$this->m_data->insert_data($data, 'tb_guru')){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menambahkan data guru</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-times"></i><b>Maaf ! <br></b> Data gagal ditambahkan</div>');
			}
		}
		redirect(base_url('guru'));
	}

	public function hapus($id) 
	{
		$where = array(
					'id_guru'=>$id
				);

		if(!$this->m_data->delete_data($where,'tb_guru')){
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menghapus data guru</div>');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-times"></i><b>Maaf ! <br></b> Data gagal dihapus</div>');
		}
		
		redirect(base_url('guru'));
	}

	public function edit($id) 
	{
		$where	= array('id_guru'=>$id);
		$data['guru']=$this->m_data->edit_data($where,'tb_guru')->result();
		$this->load->view('admin/v_guru_edit',$data);
	}
	
	public function update()
	{
		$id 		= htmlspecialchars($this->input->post('nik'));
		$nama 		= htmlspecialchars($this->input->post('nama'));
		$username	= htmlspecialchars($this->input->post('username'));
		$password	= htmlspecialchars($this->input->post('password'));

		if($password != ''){
			$where = array('id_guru'=>$id);		
			$data = array(
							'nama_guru'=>$nama,
							'username'=> $username,
							'password'=>password_hash($password, PASSWORD_DEFAULT),
						);
		}elseif($password == ''){
			$where = array('id_guru'=>$id);		
			$data = array(
							'nama_guru'=>$nama,
							'username'=> $username,
						);
		}
		
		if(!$this->m_data->update_data($where,$data,'tb_guru')){
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil mengupdate data guru</div>');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-times"></i><b>Maaf ! <br></b> Data gagal diupdate</div>');
		}
		
		redirect(base_url('guru'));
	}
}
