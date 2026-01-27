<?php
class Checkout_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_order_details_by_number($order_number) {
        $this->db->select('checkout.*, products.name as product_name, products.price as product_price');
        $this->db->from('checkout');
        $this->db->join('product_size', 'checkout.product_size_id = product_size.id');
        $this->db->join('products', 'product_size.id_products = products.id');
        $this->db->where('checkout.order_number', $order_number);
        return $this->db->get()->result_array();
    }

    public function update_user($data, $user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
}
