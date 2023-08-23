<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'admin_login') {
			if ($this->session->userdata('status') != 'guru_login') {
				redirect('auth');
			}
		}
	}

	public function index()
	{
		$data['soal'] = $this->m_data->get_data('tb_matapelajaran')->result();
		$data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
		$this->load->view('admin/v_soal', $data);
	}

	public function insert()
	{
		$nama_matapelajaran = $this->input->post('nama_matapelajaran',TRUE);
		$soal				= $this->input->post('soal',TRUE);
		$a 					= $this->input->post('a',TRUE);
		$b					= $this->input->post('b',TRUE);
		$c					= $this->input->post('c',TRUE);
		$d					= $this->input->post('d',TRUE);
		$e					= $this->input->post('e',TRUE);
		$kunci				= $this->input->post('kunci',TRUE);
		$id_guru			= $this->input->post('id_guru',TRUE);
		$id_kelas			= $this->input->post('nama_kelas',TRUE);

		$data = array(
			'id_matapelajaran' => $nama_matapelajaran,
			'pertanyaan' => $soal,
			'a' => $a,
			'b' => $b,
			'c' => $c,
			'd' => $d,
			'e' => $e,
			'kunci_jawaban' => $kunci,
			'id_guru' => $id_guru,
			'id_kelas' => $id_kelas,
		);

		if ($nama_matapelajaran == '' || $soal == '') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Input Soal Gagal!</h4> Mata Kuliah dan Pertanyaan Soal tidak boleh dikosongkan.</div>');
			redirect(base_url('soal'));
		} else {
			$this->m_data->insert_data($data, 'tb_soal_ujian');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal berhasil dibuat!</h4>untuk melihat soal tersebut bisa anda lihat di menu <b>Daftar Soal ujian</b>.</div>');
			redirect(base_url('soal'));
		}	
	}
}
