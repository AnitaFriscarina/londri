<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    public function index()
    {
        $data['judul'] = 'Pelanggan';
        $data['member'] = $this->db->get('tb_member')->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tlp', 'No.Telpon', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('pelanggan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tlp = $this->input->post('tlp');
            $gender = $this->input->post('gender');
            $data = [
                'nama' => $nama,
                'alamat' => $alamat,
                'jenis_kelamin' => $gender,
                'tlp' => $tlp
            ];
            $this->db->insert('tb_member', $data);

            $aksi = $this->session->userdata('username') . ' Menambahkan Pelanggan ' . $nama;
            activity_log('Insert', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
           Data Baru Telah Ditambahkan
            </div>');
            redirect('pelanggan');
        }
    }

    public function editData()
    {
        $data['judul'] = 'Pelanggan';
        $data['member'] = $this->db->get('tb_member')->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tlp', 'No.Telpon', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('pelanggan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id_data');
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tlp = $this->input->post('tlp');
            $gender = $this->input->post('gender');
            $data = [
                'nama' => $nama,
                'alamat' => $alamat,
                'jenis_kelamin' => $gender,
                'tlp' => $tlp
            ];
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('tb_member');

            $aksi = $this->session->userdata('username') . ' Mengedit Pelanggan ' . $nama;
            activity_log('Update', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
           Data Berhasil Di Update
            </div>');
            redirect('pelanggan');
        }
    }


    public function deleteData()
    {
        $id =  $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('tb_member');

        $aksi = $this->session->userdata('username') . ' Menghapus Pelanggan ' . $id;
        activity_log('Delete', $aksi);
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
        Data Berhasil Di Hapus
         </div>');
        redirect('pelanggan');
    }
}
