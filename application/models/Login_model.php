<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validate($email, $password) {
        // Query untuk mencari user berdasarkan email
        $this->db->where('email', $email);
        $query = $this->db->get('users'); // Ganti 'users' dengan nama tabel yang sesuai

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Verifikasi password tanpa hashing
            if ($password === $user->password) {
                return $user; // Kembalikan data user jika valid
            }
        }
        return false; // Kembalikan false jika tidak valid
    }

    /**
     * Cari user berdasarkan email
     */
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    /**
     * Buat user baru dari Google OAuth
     */
    public function create_google_user($user_data) {
        $this->db->insert('users', $user_data);
        return $this->db->insert_id();
    }

    /**
     * Update data Google user (google_id dan profile_picture)
     */
    public function update_google_user($user_id, $google_id, $profile_picture) {
        $data = array(
            'google_id' => $google_id,
            'profile_picture' => $profile_picture
        );

        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    /**
     * Store reset token and expiry
     */
    public function store_reset_token($email, $token) {
        $check_email = $this->get_user_by_email($email);
        
        if ($check_email) {
            $data = array(
                'reset_token' => $token,
                'token_expiry' => date('Y-m-d H:i:s', strtotime('+1 hour')) // Token valid for 1 hour
            );
            $this->db->where('email', $email);
            return $this->db->update('users', $data);
        }
        return false;
    }

    /**
     * Verify token
     */
    public function verify_token($token) {
        $this->db->where('reset_token', $token);
        $this->db->where('token_expiry >=', date('Y-m-d H:i:s'));
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    /**
     * Update password by token
     */
    public function update_password_by_token($token, $new_password) {
        $user = $this->verify_token($token);

        if ($user) {
            $data = array(
                'password' => $new_password,
                'reset_token' => NULL,
                'token_expiry' => NULL
            );
            $this->db->where('id', $user['id']);
            return $this->db->update('users', $data);
        }
        return false;
    }
}