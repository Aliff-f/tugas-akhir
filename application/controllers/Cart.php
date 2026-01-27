<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->model('Products_model');
        $this->load->library('session');
    }
    public function index()
    {
        // Prevent Admin from accessing cart
        if ($this->session->userdata('role') === 'admin') {
            redirect('admin/dashboard');
            return;
        }

        $data['header_title'] = 'Solenusa | Keranjang';
        $this->load->view('templates/header', $data);
        $id = $this->session->userdata('id');
        $data['carts'] = $this->Cart_model->get_cart_by_user_id($id);
        $data['random_product'] = $this->Products_model->get_random_products(4);
        $data['total_product_at_cart'] = $this->Cart_model->count_cart_by_user_id($id);
        $data['total_item_price'] = $this->Cart_model->total_item($id);
        
        if ($data['total_item_price'] == 0) {
            $delivery = 0;
        } else {
            $delivery = 6.99;
        }
        
        $data['delivery'] = $delivery;
        $ppn = 0.12;
        $data['ppn'] = ($data['total_item_price'] + $delivery) * $ppn;
        $data['total'] = $data['total_item_price'] + $delivery + $data['ppn'];
        $query['categories'] = $this->db->get('categories')->result_array();
        $this->load->view('pages/cart/index', $data);
        $this->load->view('templates/subscribe');
        $this->load->view('templates/footer', $query);
    }

    public function add($id_product) {
        // Prevent Admin from adding to cart
        if ($this->session->userdata('role') === 'admin') {
            $this->session->set_flashdata('error', 'Administrator cannot add items to cart.');
            redirect('admin/dashboard');
            return;
        }

        // Validate that user is logged in
        if (!$this->session->userdata('user_logged_in')) {
            $this->session->set_flashdata('error', 'Please login first.');
            redirect('masuk');
            return;
        }

        $id_size = $this->input->post('size');

        // Validate Size input
        if (empty($id_size)) {
            $this->session->set_flashdata('error', 'Please select a size first.');
            redirect('detail_produk/' . $id_product);
            return;
        }

        $data_product_size = $this->Cart_model->get_product_size($id_size, $id_product);

        // Validate if product_size mapping exists
        if (!$data_product_size) {
            $this->session->set_flashdata('error', 'Product variant not available.');
            redirect('detail_produk/' . $id_product);
            return;
        }

        $user_id = $this->session->userdata('id');
        $quantity = $this->input->post('quantity') ? (int)$this->input->post('quantity') : 1;

        $data = array(
            'user_id' => $user_id,
            'product_size_id' => $data_product_size['id'],
            'quantity' => $quantity
        );

        // Debuging check only if needed (removed for production)
        
        $this->Cart_model->add_cart($data);

        // We can't easily check affected_rows for duplicate key updates in some drivers, 
        // but if we are here, it likely succeeded unless DB error.
        // Let's assume success if no exception.
        $this->session->set_flashdata('success', 'Product added to cart successfully.');
        redirect('keranjang');
    }

    public function delete($id){
        $this->Cart_model->delete_cart($id);
        $this->session->set_flashdata('success', 'Delete Product from Cart successfully.');
        redirect('keranjang');
    }

    public function update_quantity($id){
        $quantity = $this->input->post('quantity');
        if ($quantity > 0) {
            $this->Cart_model->update_quantity($id, $quantity);
            $this->session->set_flashdata('success', 'Quantity updated.');
        }
        redirect('keranjang');
    }
}
