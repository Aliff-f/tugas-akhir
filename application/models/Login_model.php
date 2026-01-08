<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validate($username, $password) {
        // Query untuk mencari user berdasarkan username
        $this->db->where('username', $username);
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

        if ($query->num_rows() == 1) {
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
}