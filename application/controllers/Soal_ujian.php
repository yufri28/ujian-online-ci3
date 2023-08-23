<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class soal_ujian extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if ($this->session->userdata('status') !='admin_login') {
			if ($this->session->userdata('status') !='guru_login'){
			redirect('auth');
			}
		}
		$this->load->model('m_soal');
	}

	public function index()
	{	
		$id_guru = $this->session->userdata('id');
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$data['soal_ujian'] = $this->db->query("SELECT * FROM tb_soal_ujian JOIN tb_matapelajaran WHERE tb_soal_ujian.id_matapelajaran=tb_matapelajaran.id_matapelajaran AND tb_matapelajaran.id_matapelajaran='$id' AND tb_soal_ujian.id_guru='$id_guru' ORDER BY id_soal_ujian DESC")->result();
			$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
		} else {
			$data['soal_ujian'] = $this->db->query("SELECT * FROM tb_soal_ujian JOIN tb_matapelajaran ON tb_soal_ujian.id_matapelajaran=tb_matapelajaran.id_matapelajaran AND tb_soal_ujian.id_guru='$id_guru' ORDER BY id_soal_ujian DESC")->result();
			$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
		}					
		$this->load->view('admin/v_soal_ujian', $data);
	}

	public function edit($id)
	{
		$data['soal']=$this->m_soal->get_joinsoal($id)->result();
		$data['matapelajaran']=$this->m_data->get_data('tb_matapelajaran')->result();
		$data['kelas']=$this->m_data->get_data('tb_kelas')->result();		
		$this->load->view('admin/v_soal_ujian_edit', $data);		
	}

	public function update()
	{
		$id 				= $this->input->post('id');
		$nama_matapelajaran = $this->input->post('nama_matapelajaran');
		$soal				= $this->input->post('soal');
		$a 					= $this->input->post('a');
		$b					= $this->input->post('b');
		$c					= $this->input->post('c');
		$d					= $this->input->post('d');
		$e					= $this->input->post('e');
		$kunci				= $this->input->post('kunci');
		$id_kelas			= $this->input->post('nama_kelas');

		$where = array('id_soal_ujian'=>$id);
		$data = array(
			'id_matapelajaran'=>$nama_matapelajaran,
			'pertanyaan'=>$soal,
			'a'=>$a,
			'b'=>$b,
			'c'=>$c,
			'd'=>$d,
			'e'=>$e,
			'kunci_jawaban'=>$kunci,
			'id_kelas' => $id_kelas,
		);
		$this->m_data->update_data($where, $data, 'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
		redirect(base_url('soal_ujian'));
	}	

	public function hapus($id) 
	{
		$where = array(
					'id_soal_ujian'=>$id
				);
		$this->m_data->delete_data($where,'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Perhatian, Data telah berhasil dihapus!</h4></div>');
		redirect(base_url('soal_ujian'));
	}
}