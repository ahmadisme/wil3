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
        $data['title'] = "Login";
        $this->load->view('auth/login_page', $data);
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function registration()
    {
        // $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'password1', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Register";
            $this->load->view('auth/register', $data);
        } else {
            $data = [
                'email' => $this->input->post('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_active' => '1',
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            This is a success alert—check it out!</div>');
            redirect('auth/index');
        }
    }
}
