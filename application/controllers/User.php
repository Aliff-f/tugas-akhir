<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
    }

    // DASHBOARD
    public function dashboard()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Dashboard Pengguna';
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $data['orders'] = $this->Admin_model->get_order_by_user_id($id);
        $data['results'] = $this->Admin_model->order_result_by_user_id($id);
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/admin_footer');
    }

    public function update_user()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Ubah Profil';
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout', $data);
        $this->load->view('user/user/update_user', $data);
        $this->load->view('templates/admin_footer');
    }

    public function update_user_action()
    {
        $id = $this->session->userdata('id');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $province = $this->input->post('province');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $subdistrict = $this->input->post('subdistrict');
        $street = $this->input->post('street');
        $description = $this->input->post('description');
        $zip_code = $this->input->post('zip_code');

        $user = $this->Admin_model->get_users_by_id($id)->row_array();
        $picture_old = $user['profile_picture'];

        // KONFIGURASI UPLOAD (Harap Jangan Dihapus)
        $config['upload_path'] = './public/uploads/users';
        $config['allowed_types'] = 'jpg|jpeg|png|webp|gif'; // Tambahkan webp
        $config['max_size']     = 5120; // 5MB
        $config['encrypt_name'] = TRUE; // PENTING: Rename file random untuk mencegah error nama file
        $config['detect_mime']  = TRUE; // Security check

        $this->load->library('upload', $config);
        $this->upload->initialize($config); // Reset config

        $picture = $picture_old; 

        if (!empty($_FILES['picture']['name'])) {
            if ($this->upload->do_upload('picture')) {
                $picture = $this->upload->data('file_name');
            } else {
                // Tampilkan error spesifik dari library upload
                $this->session->set_flashdata('error_upload', 'Gagal Upload Foto: ' . $this->upload->display_errors('', ''));
            }
        }

        $data = array(
            'full_name' => $fullname,
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'address_province' => $province,
            'address_city' => $city,
            'address_district' => $district,
            'address_subdistrict' => $subdistrict,
            'street_name' => $street,
            'address_description' => $description,
            'zip_code' => $zip_code,
            'profile_picture' => $picture
        );

        // PASSWORD UPDATE LOGIC
        // Hanya update jika user mengisi password baru
        $new_password = $this->input->post('new_password');
        if (!empty($new_password)) {
            $data['password'] = $new_password; 
        }

        $this->Admin_model->update_user($data, $id);

        if ($this->db->affected_rows() >= 0) {
            // Check if there was an upload error specifically
            if($this->session->flashdata('error_upload')) {
                $this->session->set_flashdata('error', $this->session->flashdata('error_upload'));
            } else {
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            }
            redirect('akun/update_user'); // Stay on page to verify changes
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            redirect('akun/update_user');
        }
    }

    // COMMENTS
    public function comments()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Komentar Saya';
        $data['comments'] = $this->Admin_model->get_comments_by_user_id();
        $data['count_comments_by_user_id'] = $this->Admin_model->count_comments_by_user_id();
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout', $data);
        $this->load->view('user/comments/comments', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_comment()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Tambah Komentar';
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout', $data);
        $this->load->view('user/comments/add_comment');
        $this->load->view('templates/admin_footer');
    }

    public function update_comment_user($id_product)
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Ubah Komentar';
        $data['comment'] = $this->Admin_model->get_comment_by_id($id_product)->row_array();
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_user_layout', $data);
        $this->load->view('user/comments/update_comment', $data);
        $this->load->view('templates/admin_footer');
    }

    public function update_add_comment_action_user()
    {
        $comment_id = $this->input->post('id');
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');
        $comment = $this->input->post('comment');
        $rating = $this->input->post('rating');



        $data = array(
            'product_id' => $product_id,
            'user_id' => $user_id,
            'comment' => $comment,
            'rating' => $rating
        );

        $this->Admin_model->update_comment($data, $comment_id);

        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Comment updated successfully.');
            redirect("akun/comments");
        } else {
            $this->session->set_flashdata('error', 'Failed to update your comment. Please try again.');
            redirect("akun/comments");
        }
    }

    public function delete_comment($id)
    {
        $this->Admin_model->delete_comment($id);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Delete comment successfully.');
            redirect("akun/comments");
        } else {
            $this->session->set_flashdata('error', 'Failed to delete your comment. Please try again.');
            redirect("akun/comments");
        }
    }

    public function order_cancel($id)
    {
        $status = 'cancelled';
        $this->db->query("CALL update_order_status($id, '$status');");
        $this->session->set_flashdata('success', 'Order Cancelled.');
        redirect("akun/dashboard");
    }
}
