<?php
class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_cart_by_user_id($user_id) {
        $this->db->select('cart.id, cart.user_id, cart.product_size_id, cart.quantity, cart.added_at, 
        products.id AS product_id,
        products.name AS product_name, 
        sizes.name AS product_size_name, 
        products.price AS product_price, 
        products.image_url AS product_image, 
        products.description AS product_description, 
        colors.name AS product_color_name');
        $this->db->from('cart');
        $this->db->join('product_size', 'cart.product_size_id = product_size.id');
        $this->db->join('products', 'product_size.id_products = products.id');
        $this->db->join('sizes', 'product_size.id_sizes = sizes.id');
        $this->db->join('colors', 'products.color_id = colors.id', 'left'); // Left join for color in case null
        $this->db->where('cart.user_id', $user_id);
        $this->db->group_by('cart.id'); // Avoid duplicates
        $this->db->order_by('cart.added_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_cart_by_user_id($user_id)
    {
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function total_item($user_id) {
        $this->db->select('SUM(p.price * c.quantity) as total_price');
        $this->db->from('cart c');
        $this->db->join('product_size ps', 'c.product_size_id = ps.id');
        $this->db->join('products p', 'ps.id_products = p.id');
        $this->db->where('c.user_id', $user_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->total_price;
        } else {
            return 0;
        }
    }

    public function get_product_size($id_sizes, $id_products){
        $this->db->select('*');
        $this->db->from('product_size');
        $this->db->where(['id_sizes' => $id_sizes, 'id_products' => $id_products]);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function add_cart($data)
    {
        // Check if item exists
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('product_size_id', $data['product_size_id']);
        $query = $this->db->get('cart');

        if ($query->num_rows() > 0) {
            // Item exists, update quantity
            $existing_item = $query->row();
            $new_quantity = $existing_item->quantity + $data['quantity'];
            
            $this->db->where('id', $existing_item->id);
            $this->db->update('cart', array('quantity' => $new_quantity));
        } else {
            // Item does not exist, insert new
            $this->db->insert('cart', $data);
        }
    }
    
    public function update_cart(){
        
    }

    public function delete_cart($id){
        $this->db->where('id', $id);
        $this->db->delete('cart');
    }

    public function empty_cart($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('cart');
    }
}
