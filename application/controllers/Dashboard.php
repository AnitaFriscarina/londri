<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {


        $data['judul'] = 'Dashboard';
        $query = 'SELECT COUNT(*) as frem FROM tb_transaksi';
        $queryz = 'SELECT COUNT(*) as frem FROM tb_transaksi WHERE status_pembayaran = "belum dibayar"';
        $queryp = 'SELECT COUNT(*) as frem FROM tb_transaksi WHERE status != "selesai"';
        $querys = 'SELECT sum(total_harga) as frem FROM tb_transaksi WHERE status_pembayaran = "dibayar"';
        $data['jmlh'] = $this->db->query($querys)->result_array();
        $data['blm'] = $this->db->query($queryz)->result_array();
        $data['sls'] = $this->db->query($queryp)->result_array();
        $data['transaksi'] = $this->db->query($query)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidenav');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
