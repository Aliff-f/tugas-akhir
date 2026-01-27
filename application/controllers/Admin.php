<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Size_model');
        $this->load->library('session');
    }

    // DASHBOARD
    public function dashboard()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Dashboard Admin';
        $data['admin'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $data['orders'] = $this->Admin_model->get_orders();
        $data['results'] = $this->Admin_model->count_orders();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/admin_footer');
    }

    // USERS
    public function users()
    {
        $id = $this->session->userdata('id');
        $this->load->model('Admin_model');
        $query['users'] = $this->Admin_model->get_users();
        $query['total_users'] = $this->Admin_model->count_users();
        $data['header_title'] = 'Solenusa | Kelola Pengguna';
        $data['admin'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout');
        $this->load->view('admin/users/users', $query);
        $this->load->view('templates/admin_footer');
    }

    public function add_user()
    {
        $id = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Tambah Pengguna';
        $data['admin'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout');
        $this->load->view('admin/users/add_user');
        $this->load->view('templates/admin_footer');
    }

    public function add_users_action()
    {
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $province = $this->input->post('province');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $subdistrict = $this->input->post('subdistrict');
        $street = $this->input->post('street');
        $description = $this->input->post('description');
        $zip_code = $this->input->post('zip_code');

        $config['upload_path'] = './public/uploads/users';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 10240; // 10MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('picture')) {
            $picture = $this->upload->data('file_name');
        } else {
            $picture = null;
            $error = $this->upload->display_errors();
        }

        $data = array(
            'full_name' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => $password,
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

        $this->Admin_model->add_user($data);

        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Add user successfully.');
            redirect('Admin/users');
        } else {
            $this->session->set_flashdata('error', 'Failed to add user. Please try again.');
            redirect('Admin/add_user');
        }
    }

    public function update_user($id)
    {
        $id_admin = $this->session->userdata('id');
        $data['header_title'] = 'Solenusa | Ubah Pengguna';
        $this->load->view('templates/admin_header', $data);
        $data['user'] = $this->Admin_model->get_users_by_id($id)->row_array();
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/users/update_user', $data);
        $this->load->view('templates/admin_footer');
    }

    public function update_user_action()
    {
        $id = $this->input->post('id');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
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

        $config['upload_path'] = './public/uploads/users';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 10240; // 10MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $picture = $picture_old;

        if (!empty($_FILES['picture']['name'])) {
            if ($this->upload->do_upload('picture')) {
                $picture = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('Admin/update_user/' . $id);
                return;
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

        // Hanya update password jika input tidak kosong
        $new_password = $this->input->post('new_password');
        if (!empty($new_password)) {
            $data['password'] = $new_password;
        } elseif (!empty($password)) {
            $data['password'] = $password;
        }


        $this->Admin_model->update_user($data, $id);

        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Update user successfully.');
            redirect('Admin/users');
        } else {
            $this->session->set_flashdata('error', 'Failed to update user. Please try again.');
            redirect('Admin/update_user' . $id);
        }
    }

    public function delete_user($id_user)
    {
        $this->Admin_model->delete_user($id_user);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Delete user successfully.');
            redirect('Admin/users');
        } else {
            echo "Data gagal dihapus";
        }
    }

    // PRODUCTS
    public function products()
    {
        $data['header_title'] = 'Solenusa | Kelola Produk';
        $id_admin = $this->session->userdata('id');
        $this->load->model('Admin_model');
        $query['products'] = $this->Admin_model->get_product();
        $query['count_all_products'] = $this->Admin_model->count_all_products();
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/products/products', $query);
        $this->load->view('templates/admin_footer');
    }

    public function add_product()
    {
        $data['header_title'] = 'Solenusa | Tambah Produk';
        $id_admin = $this->session->userdata('id');
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $query['categories'] = $this->db->get('categories')->result_array();
        // $query['colors'] = $this->db->get('colors')->result_array(); // Removed
        // $query['sizes'] = $this->db->get('sizes')->result_array(); // Removed, sizes now static in view
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin + $query);
        $this->load->view('admin/products/add_product', $query);
        $this->load->view('templates/admin_footer');
    }

    public function add_product_action()
    {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $stock = $this->input->post('stock');
        $category = $this->input->post('category');
        $category = $this->input->post('category');
        // $size = $this->input->post('size'); // Legacy single size not used
        $color = $this->input->post('color');
        $brand = $this->input->post('brand');

        $config['upload_path'] = './public/uploads';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 10240; // 10MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('picture')) {
            $picture = $this->upload->data('file_name');
        } else {
            $picture = null;
            $error = $this->upload->display_errors();
        }

        $data = array(
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $category,
            // 'size_id' => $size,
            'color_id' => $color,
            'brand' => $brand,
            'image_url' => $picture
        );
        $this->Admin_model->add_product($data);

        $this->db->select_max('id');
        $query = $this->db->get('products')->row_array();
        $id = $query['id'];

        // Insert Sizes logic updated for STATIC string storage
        $sizes = $this->input->post('sizes'); // Array of names e.g. ['38', '40']
        $custom_size = $this->input->post('custom_size'); // String e.g. "S, M, XL"

        $all_sizes_to_process = [];

        if (!empty($sizes)) {
            $all_sizes_to_process = array_merge($all_sizes_to_process, $sizes);
        }

        if (!empty($custom_size)) {
            // Split by comma and trim whitespace
            $custom_sizes_array = array_map('trim', explode(',', $custom_size));
            $all_sizes_to_process = array_merge($all_sizes_to_process, $custom_sizes_array);
        }

        // Filter empty values and unique
        $all_sizes_to_process = array_unique(array_filter($all_sizes_to_process));

        if (!empty($all_sizes_to_process)) {
            foreach ($all_sizes_to_process as $size_value) {
                // Direct insert of string value (requires DB column 'size' in product_size table)
                $size_data = array(
                    'id_products' => $id,
                    'size' => $size_value // Changed from id_sizes to size
                );
                $this->Size_model->add_size($size_data);
            }
        }


        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Add Product successfully.');
            redirect('Admin/update_product/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Failed to add product. Please try again.');
            redirect('Admin/add_product');
        }
    }

    public function update_product($id)
    {
        $data['header_title'] = 'Solenusa | Ubah Produk';
        $id_admin = $this->session->userdata('id');
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $data['product'] = $this->Admin_model->get_product_by_id($id)->row_array();
        $query['categories'] = $this->db->get('categories')->result_array();
        // $query['colors'] = $this->db->get('colors')->result_array(); // Removed
        // $query['sizes'] = $this->db->get('sizes')->result_array(); // We now use static sizes or product_size table for reading
        $data['products_sizes'] = $this->Size_model->get_size_by_product_id($id);
        $data['count_all_product_sizes'] = $this->Size_model->count_all_product_sizes_by_product_id($id);
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/products/update_product', $data + $query);
        $this->load->view('templates/admin_footer');
    }

    public function update_product_action()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $stock = $this->input->post('stock');
        $category = $this->input->post('category');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $brand = $this->input->post('brand');

        $product = $this->Admin_model->get_product_by_id($id)->row_array();
        $old_picture = $product['image_url'];

        $config['upload_path'] = './public/uploads';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 10240; // 10MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $picture = $old_picture;

        if (!empty($_FILES['picture']['name'])) {
            if ($this->upload->do_upload('picture')) {
                $picture = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('Admin/update_product/' . $id);
                return;
            }
        }

        $data = array(
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $category,
            'size_id' => $size,
            'color_id' => $color,
            'brand' => $brand,
            'image_url' => $picture
        );
        $this->Admin_model->update_product($data, $id);

        // Update Sizes Logic (Optional: if we want to add new sizes from update page form directly, usually handled by separate Size Controller but let's keep it clean here)
        // Usually update_product doesn't have size checkboxes, it has a separate section below.
        // But if you added checkboxes there too:
        /*
        $sizes = $this->input->post('sizes');
        // ... Logic would go here similar to add_product_action
        */ 
        
        // Note: The previous logic didn't actually update sizes in `update_product_action` based on lines read previously.
        // It mainly updates product details. Size management is done via size section on the bottom.
        
        if ($this->db->affected_rows() >= 0) { // Changed to >= 0 because sometimes no changes made is valid success
            $this->session->set_flashdata('success', 'Update Product successfully.');
            redirect('Admin/products');
        } else {
            $this->session->set_flashdata('error', 'Failed to update product. Please try again.');
            redirect('Admin/update_product/' . $id);
        }
    }

    public function delete_product($id_product)
    {
        $this->Admin_model->delete_product($id_product);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Delete Product successfully.');
            redirect('Admin/products');
        } else {
            echo "Data gagal dihapus";
        }
    }

    // COMMENTS
    public function comments()
    {
        $data['header_title'] = 'Solenusa | Kelola Komentar';
        $id_admin = $this->session->userdata('id');
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $data['comments'] = $this->Admin_model->get_comments();
        $data['count_all_comment'] = $this->Admin_model->count_all_comments();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/comments/comments', $data);
        $this->load->view('templates/admin_footer');
    }

    public function add_comment()
    {
        $data['header_title'] = 'Solenusa | Tambah Komentar';
        $id_admin = $this->session->userdata('id');
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/comments/add_comment');
        $this->load->view('templates/admin_footer');
        $this->load->helper('url');
    }

    public function add_comment_action()
    {
        $comment_id = $this->input->post('id');
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');
        $comment = $this->input->post('comment');
        $rating = $this->input->post('rating');

        if (empty($user_id)) {
            $user_id = $this->session->all_userdata()['id'];
            if (empty($user_id)) {
                echo "User ID is missing or not logged in.";
                return;
            }
        }


        if ($rating < 1 || $rating > 5) {
            echo "Rating must be between 1 and 5.";
            return;
        }

        $data = array(
            'product_id' => $product_id,
            'user_id' => $user_id,
            'comment' => $comment,
            'rating' => $rating
        );

        $this->Admin_model->add_comment($data, $comment_id);

        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Comment added successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            // Jika insert gagal
            $this->session->set_flashdata('error', 'Failed to save your comment. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function update_comment($id)
    {
        $data['header_title'] = 'Solenusa | Ubah Komentar';
        $id_admin = $this->session->userdata('id');
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        $data['comment'] = $this->Admin_model->get_comment_by_id($id)->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/comments/update_comment', $data);
        $this->load->view('templates/admin_footer');
    }

    public function update_add_comment_action()
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
            $this->session->set_flashdata('success', 'Comment edit successfully.');
            redirect("Admin/comments");
        } else {
            $this->session->set_flashdata('error', 'Failed to edit the comment. Please try again.');
            redirect("Admin/comments");
        }
    }

    public function delete_comment($id)
    {
        $this->Admin_model->delete_comment($id);
        if ($this->db->affected_rows()) {
            if ($this->db->affected_rows()) {
                $this->session->set_flashdata('success', 'Delete comment successfully.');
                redirect("Admin/comments");
            } else {
                // Jika insert gagal
                $this->session->set_flashdata('error', 'Failed to delete the comment. Please try again.');
                redirect("Admin/comments");
            }
        }
    }

    public function order($id, $status)
    {
        if ($status == 'accept') {
            $status = 'completed';
            $this->db->query("CALL update_order_status($id, '$status');");
            $this->session->set_flashdata('success', 'Order Accepted.');
            redirect("Admin/dashboard");
        } elseif ($status == 'cancel') {
            $status = 'cancelled';
            $this->db->query("CALL update_order_status($id, '$status');");
            $this->session->set_flashdata('success', 'Order Cancelled.');
            redirect("admin/dashboard");
        }
    }

    public function delete_order($id)
    {
        $this->Admin_model->delete_order($id);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Order deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete order.');
        }
        redirect('Admin/dashboard');
    }

    public function sales()
    {
        $data['header_title'] = 'Solenusa | Analisis Penjualan';
        $id_admin = $this->session->userdata('id');
        $data_admin['admin'] = $this->Admin_model->get_users_by_id($id_admin)->row_array();
        
        $data['weekly_sales'] = $this->Admin_model->get_weekly_sales();
        $data['monthly_sales'] = $this->Admin_model->get_monthly_sales();
        $data['yearly_sales'] = $this->Admin_model->get_yearly_sales();
        $data['total_revenue'] = $this->Admin_model->get_total_revenue();
        $data['top_products'] = $this->Admin_model->get_top_selling_products(5);
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/dashboard_layout', $data_admin);
        $this->load->view('admin/sales/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function api_sales()
    {
        $data = [
            'weekly_sales' => $this->Admin_model->get_weekly_sales(),
            'monthly_sales' => $this->Admin_model->get_monthly_sales(),
            'yearly_sales' => $this->Admin_model->get_yearly_sales(),
            'total_revenue' => $this->Admin_model->get_total_revenue(),
            'total_revenue_formatted' => 'Rp ' . number_format($this->Admin_model->get_total_revenue(), 0, ',', '.'),
            'top_products' => $this->Admin_model->get_top_selling_products(5)
        ];
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
