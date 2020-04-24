<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    public function index()
    {
        $data['judul'] = 'Outlet';
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tlp', 'No.Telpon', 'required|trim');


        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('outlet/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tlp = $this->input->post('tlp');
            $data = [
                'nama' => $nama,
                'alamat' => $alamat,
                'tlp' => $tlp
            ];
            $this->db->insert('tb_outlet', $data);
            $aksi = $this->session->userdata('username') . ' Menambahkan Outlet ' . $nama;
            activity_log('Insert', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
           Data Outlet Baru Telah Ditambahkan
            </div>');
            redirect('outlet');
        }
    }
    public function editData()
    {
        $data['judul'] = 'Outlet';
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tlp', 'No.Telpon', 'required|trim');


        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('outlet/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tlp = $this->input->post('tlp');
            $id = $this->input->post('id_data');
            $data = [
                'nama' => $nama,
                'alamat' => $alamat,
                'tlp' => $tlp
            ];
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('tb_outlet', $data);

            $aksi = $this->session->userdata('username') . ' Mengedit Outlet ' . $nama;
            activity_log('Edit', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
           Data Outlet Berhasil Di-Update
            </div>');
            redirect('outlet');
        }
    }


    public function deleteData()
    {
        $id =  $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('tb_outlet');

        $aksi = $this->session->userdata('username') . ' Menghapus Outlet ' . $id;
        activity_log('Delete', $aksi);
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
        Data Berhasil Di Hapus
         </div>');
        redirect('outlet');
    }
}
