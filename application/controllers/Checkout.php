<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Cart_model');
        $this->load->model('Checkout_model');
        $this->load->model('Products_model');
    }
    public function index()
    {
        $id = $this->session->userdata('id');
        $data['order_details'] = $this->Cart_model->get_cart_by_user_id($id);
        $data['total_product_at_cart'] = $this->Cart_model->count_cart_by_user_id($id);
        $data['total_item_price'] = $this->Cart_model->total_item($id);
        $data['user'] = $this->Checkout_model->get_user($id);

        if ($data['total_item_price'] == 0) {
            $delivery = 0;
        } else {
            $delivery = 25000;
        }

        $data['delivery'] = $delivery;
        $ppn = 0.025;
        $data['ppn'] = ($data['total_item_price'] + $delivery) * $ppn;
        $data['total'] = $data['total_item_price'] + $delivery + $data['ppn'];

        $data['header_title'] = 'Solenusa | Checkout';
        $this->load->view('templates/header', $data);
        $this->load->model('Products_model');
        $query['categories'] = $this->db->get('categories')->result_array();
        $this->load->view('pages/checkout/index');
        $this->load->view('templates/subscribe');
        $this->load->view('templates/footer', $query);
    }

    public function checkout_action()
    {
        $id = $this->session->userdata('id');
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

        $user = $this->Checkout_model->get_user($id);
        $picture_old = $user['profile_picture'];

        $config['upload_path'] = './public/uploads/users';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('picture')) {
            $picture = $this->upload->data('file_name');
        } else {
            $picture = $picture_old;
            $error = $this->upload->display_errors();
        }

        $data = array(
            'full_name' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'address_province' => $province,
            'address_city' => $city,
            'address_district' => $district,
            'address_subdistrict' => $subdistrict,
            'street_name' => $street,
            'address_description' => $description,
            'zip_code' => $zip_code,
            'profile_picture' => $picture
        );

        $this->Checkout_model->update_user($data, $id);

        $get_data_product = $this->Cart_model->get_cart_by_user_id($id);

        if (!empty($get_data_product)) {
            $order_number = $this->db->query('SELECT generate_order_number() AS order_number')->row()->order_number;

            foreach ($get_data_product as $product) {
                // Loop based on quantity to insert multiple rows if needed
                // This ensures that SUM(products.price) for an order_number reflects the actual total quantity
                for ($i = 0; $i < $product['quantity']; $i++) {
                    $data_order = array(
                        'user_id' => $id,
                        'product_size_id' => $product['product_size_id'],
                        'status' => 'pending',
                        'order_number' => $order_number
                    );
                    
                    $this->Admin_model->add_order($data_order);
                }

                // Reduce Stock
                if (isset($product['product_id'])) {
                     $this->Products_model->decrease_stock($product['product_id'], $product['quantity']);
                }
            }
            $this->Cart_model->empty_cart($id);
            $this->session->set_flashdata('order_number', $order_number);
        }
        
        redirect('pembayaran');
    }
}
