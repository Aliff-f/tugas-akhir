<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
    }
    public function index()
    {
        $data['header_title'] = 'Solenusa | Daftar';
        $this->load->model('Products_model');
        $query['categories'] = $this->db->get('categories')->result_array();
        $this->load->view('pages/auth/register/index', $data);
    }

    public function submit()
    {
        // Get raw input
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        // Validate password confirmation
        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak sesuai.');
            redirect(base_url('daftar'));
            return;
        }

        $data = array(
            'full_name' => strip_tags(trim($this->input->post('fullname'))),
            'username' => strip_tags(trim($this->input->post('username'))),
            'gender' => $this->input->post('gender'),
            'phone' => strip_tags(trim($this->input->post('phone'))),
            'email' => strip_tags(trim($this->input->post('email'))),
            'password' => $password, // Storing plain text as per current system design
            'role' => 'user',
            'profile_picture' => 'default.jpg',
            'created_at' => date('Y-m-d H:i:s')
        );

        // Check if email already exists
        $this->load->model('Login_model');
        if ($this->Login_model->get_user_by_email($data['email'])) {
            $this->session->set_flashdata('error', 'Email sudah terdaftar. Silakan gunakan email lain atau login.');
            $this->session->set_flashdata('is_duplicate_email', true);
            $this->session->set_flashdata('duplicate_email', $data['email']);
            redirect(base_url('daftar'));
            return;
        }
        
        // Check if username already exists
        $this->db->where('username', $data['username']);
        if ($this->db->count_all_results('users') > 0) {
             $this->session->set_flashdata('error', 'Username sudah digunakan. Silakan pilih username lain.');
             redirect(base_url('daftar'));
             return;
        }

        // Check if phone already exists
        $this->db->where('phone', $data['phone']);
        if ($this->db->count_all_results('users') > 0) {
             $this->session->set_flashdata('error', 'Nomor telepon sudah terdaftar. Silakan gunakan nomor lain.');
             redirect(base_url('daftar'));
             return;
        }

        if ($this->Register_model->register_user($data)) {
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect(base_url('masuk'));
        } else {
            // Log the actual error
            $error = $this->db->error();
            $error_msg = isset($error['message']) ? $error['message'] : 'Unknown database error';
            log_message('error', 'Registration Failed: ' . $error_msg);
            
            // Check for duplicate entry error specifically if it slipped through (e.g. race condition)
            if ($error['code'] == 1062) {
                 if (strpos($error_msg, 'phone') !== false) {
                     $this->session->set_flashdata('error', 'Nomor telepon sudah terdaftar.');
                 } elseif (strpos($error_msg, 'email') !== false) {
                     $this->session->set_flashdata('error', 'Email sudah terdaftar.');
                 } elseif (strpos($error_msg, 'username') !== false) {
                     $this->session->set_flashdata('error', 'Username sudah digunakan.');
                 } else {
                     $this->session->set_flashdata('error', 'Data sudah terdaftar (duplikat).');
                 }
            } else {
                 $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi nanti.');
            }
            redirect(base_url('daftar'));
        }
    }
}