<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    public function index()
    {
        $data['judul'] = 'Menu Paket';
        $data['paket'] = $this->db->get('tb_paket')->result_array();
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();
        $query = "SELECT tb_paket.nama_paket, tb_paket.jenis, tb_paket.harga, tb_outlet.nama, tb_paket.id_outlet, tb_paket.id FROM tb_paket JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id ";
        $data['tblpaket'] = $this->db->query($query)->result_array();

        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('paket/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id_outlet = $this->input->post('id_outlet');
            $jenis = $this->input->post('jenis');
            $nama_paket = $this->input->post('nama_paket');
            $harga = $this->input->post('harga');
            $data = [
                'id_outlet' => $id_outlet,
                'jenis' => $jenis,
                'nama_paket' => $nama_paket,
                'harga' => $harga
            ];
            $this->db->insert('tb_paket', $data);

            $aksi = $this->session->userdata('username') . ' Menambahkan Paket ' . $nama_paket;
            activity_log('Insert', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data Baru Telah Ditambahkan
            </div>');
            redirect('paket');
        }
    }

    public function editData()
    {
        $data['judul'] = 'Menu Paket';
        $data['paket'] = $this->db->get('tb_paket')->result_array();
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();
        $query = "SELECT tb_paket.nama_paket, tb_paket.jenis, tb_paket.harga, tb_outlet.nama, tb_paket.id_outlet, tb_paket.id FROM tb_paket JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id ";
        $data['tblpaket'] = $this->db->query($query)->result_array();

        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('paket/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id_data');
            $id_outlet = $this->input->post('id_outlet');
            $jenis = $this->input->post('jenis');
            $nama_paket = $this->input->post('nama_paket');
            $harga = $this->input->post('harga');
            $data = [
                'id_outlet' => $id_outlet,
                'jenis' => $jenis,
                'nama_paket' => $nama_paket,
                'harga' => $harga
            ];
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('tb_paket');
            if ($this->db->affected_rows() > 0) {
                $aksi = $this->session->userdata('username') . ' Mengedit Paket ' . $nama_paket;
                activity_log('Update', $aksi);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
               Data Berhasil Di Update  
            
                </div>');
                redirect('paket');
            } else if ($this->db->affected_rows() <= 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
               Data Gagal Di Update, Pastikan Semua Kolom Terisi
                </div>');
                redirect('paket');
            }
        }
    }


    public function deleteData()
    {
        $id =  $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('tb_paket');


        $aksi = $this->session->userdata('username') . ' Menghapus Paket ' . $id;
        activity_log('Delete', $aksi);
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
        Data Berhasil Di Hapus
         </div>');
        redirect('paket');
    }
}
