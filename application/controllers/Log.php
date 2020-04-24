<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {

        $data['judul'] = 'Riwayat Log';

        $data['log'] = $this->db->get('tb_log')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidenav');
        $this->load->view('log/index', $data);
        $this->load->view('templates/footer');
    }
}
