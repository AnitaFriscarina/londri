<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if ($this->session->userdata('role') != 'admin') {
            redirect('dashboard');
        }
    }


    public function index()
    {
        $data['judul'] = 'Data User';
        $data['user'] = $this->db->get('tb_user')->result_array();
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();

        $this->form_validation->set_rules('username', 'Nama', 'required|trim|is_unique[tb_user.nama]', [
            'is_unique' => 'username Telah Digunakan'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]|min_length[6]', [
            'matches' => 'Password Tidak Sama',
            'min_length' => 'Password Harus Minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]', [
            'min_length' => 'Password Harus Minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('id_outlet', 'ID Outlet', 'required|trim');


        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username', true);
            $pw = $this->input->post('password1', true);
            $role = $this->input->post('role');
            $idot = $this->input->post('id_outlet');
            $data = [
                'nama' => htmlspecialchars($username),
                'password' => password_hash($pw, PASSWORD_DEFAULT),
                'id_outlet' => $idot,
                'role' => $role
            ];
            $this->db->insert('tb_user', $data);


            $aksi = $this->session->userdata('username') . ' Menambahkan User ' . $username;
            activity_log('Insert', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data User Baru Telah Ditambahkan
            </div>');
            redirect('user');
        }
    }
    public function editData()
    {
        $data['judul'] = 'Data User';
        $data['user'] = $this->db->get('tb_user')->result_array();
        $data['outlet'] = $this->db->get('tb_outlet')->result_array();

        $this->form_validation->set_rules('username1', 'Nama', 'required|trim', [
            'is_unique' => 'username Telah Digunakan'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]|min_length[6]', [
            'matches' => 'Password Tidak Sama',
            'min_length' => 'Password Harus Minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]', [
            'min_length' => 'Password Harus Minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('id_outlet', 'ID Outlet', 'required|trim');


        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('templates/sidenav');
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username1', true);
            $pw = $this->input->post('password1', true);
            $role = $this->input->post('role');
            $idot = $this->input->post('id_outlet');
            $id_user = $this->input->post('id_data');
            $data = [
                'nama' => htmlspecialchars($username),
                'password' => password_hash($pw, PASSWORD_DEFAULT),
                'id_outlet' => $idot,
                'role' => $role
            ];
            $this->db->set($data);
            $this->db->where('id', $id_user);
            $this->db->update('tb_user');


            $aksi = $this->session->userdata('username') . ' Mengedit Data User ' . $id_user;
            activity_log('Update', $aksi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Data User Berhasil Telah Di-Update
            </div>');
            redirect('user');
        }
    }


    public function deleteData()
    {
        $id =  $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('tb_user');


        $aksi = $this->session->userdata('username') . ' Menghapus Data User ' . $id;
        activity_log('Update', $aksi);
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
        Data Berhasil Di Hapus
         </div>');
        redirect('User');
    }
}
