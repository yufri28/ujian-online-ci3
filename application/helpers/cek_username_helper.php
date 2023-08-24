<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function cek_username($username){
    $ci =& get_instance();
    $ci->load->database();
    $username_siswa = $ci->db->get_where('tb_siswa', ['username' => $username])->row_array();
    $username_guru = $ci->db->get_where('tb_guru', ['username' => $username])->row_array();
    return $username_siswa || $username_guru ? true:false;
}


?>