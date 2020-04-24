<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        // cek session
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }
        //validsi form
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $this->load->view('Auth/login');
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        //amvil adta user yg login
        $user  = $this->db->get_where('tb_user', ['nama' => $username])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['nama'],
                    'id_user' => $user['id'],
                    'role' => $user['role']
                ];
                //bikin session
                $this->session->set_userdata($data);
                $aksi = $this->session->userdata('username') . ' Telah Login';
                activity_log('Login', $aksi);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Password Salah !
                    </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Username Tidak Terdaftar ! 
                    </div>');
            redirect('Auth');
        }
    }


    public function logout()
    {


        $aksi = $this->session->userdata('username') . ' Telah Logout';
        activity_log('Logout', $aksi);

        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('id_user');
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Berhasil Logout !!!
	  	</div>');

        redirect('Auth');
    }
}
