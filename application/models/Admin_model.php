<?php
class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ======================== Produk ========================
    public function get_product()
    {
        // Melakukan join antara tabel products dan categories
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'products.category_id = categories.id', 'left');
        $this->db->order_by('products.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_products()
    {
        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function get_product_by_id($idProduk)
    {
        return $this->db->get_where('products', array('id' => $idProduk));
    }

    public function add_product($data)
    {
        $this->db->insert('products', $data);
    }

    public function update_product($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        // 1. Delete Comments related to this product
        $this->db->where('product_id', $id);
        $this->db->delete('comments');

        // 2. Get related product_size IDs
        $this->db->select('id');
        $this->db->where('id_products', $id);
        $sizes = $this->db->get('product_size')->result_array();

        if (!empty($sizes)) {
            $size_ids = array_column($sizes, 'id');

            // 3. Delete from cart (references product_size)
            $this->db->where_in('product_size_id', $size_ids);
            $this->db->delete('cart');

            // 4. Delete from checkout (references product_size)
            $this->db->where_in('product_size_id', $size_ids);
            $this->db->delete('checkout');

            // 5. Delete from product_size
            $this->db->where('id_products', $id);
            $this->db->delete('product_size');
        }


        // 6. Finally delete the product
        $this->db->where('id', $id);
        $this->db->delete('products');
    }

    // ======================== Pengguna ========================
    public function get_users()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function count_users()
    {
        return $this->db->count_all('users');
    }

    public function get_users_by_id($id)
    {
        return $this->db->get_where('users', array('id' => $id));
    }

    public function add_user($data)
    {
        $this->db->insert('users', $data);
    }

    public function update_user($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function delete_user($id_user)
    {
        $this->db->where('id', $id_user);
        $this->db->delete('users');
    }

    // ======================== Komentar ========================
    public function get_comments()
    {
        $this->db->select('comments.id, comments.product_id, comments.user_id, comments.comment, comments.rating, comments.created_at, 
                               users.full_name as user_name, products.name as product_name, products.image_url as image_url');
        $this->db->from('comments');
        $this->db->join('users', 'comments.user_id = users.id', 'left');
        $this->db->join('products', 'comments.product_id = products.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_comments()
    {
        $this->db->from('comments');
        return $this->db->count_all_results();
    }

    public function get_comment_by_id($id)
    {
        $this->db->select('comments.*, products.name AS product_name, users.full_name AS user_name');
        $this->db->from('comments');
        $this->db->join('products', 'comments.product_id = products.id', 'left');
        $this->db->join('users', 'comments.user_id = users.id', 'left');
        $this->db->where('comments.id', $id);
        return $this->db->get();
    }

    public function add_comment($data)
    {
        $this->db->insert('comments', $data);
    }

    public function update_comment($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('comments', $data);
    }

    public function delete_comment($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('comments');
    }

    public function get_comments_by_product_id($product_id)
    {
        $this->db->select('comments.*, users.full_name as user_name', 'products.image_url as image_url');
        $this->db->from('comments');
        $this->db->join('users', 'comments.user_id = users.id', 'left');
        $this->db->where('comments.product_id', $product_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_comments_by_user_id()
    {
        $this->db->select('comments.id, comments.product_id, comments.user_id, comments.comment, comments.rating, comments.created_at, 
                               users.full_name as user_name, products.name as product_name, products.image_url as image_url');
        $this->db->from('comments');
        $this->db->join('users', 'comments.user_id = users.id', 'left');
        $this->db->join('products', 'comments.product_id = products.id', 'left');
        $this->db->where('comments.user_id', $this->session->userdata('id'));
        $this->db->order_by('comments.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_comments_by_user_id()
    {
        $this->db->where('user_id', $this->session->userdata('id'));
        return $this->db->count_all_results('comments');
    }

    public function count_orders()
    {
        $this->db->from('checkout');
        return $this->db->count_all_results();
    }

    public function get_orders()
    {
        $this->db->select('checkout.*, 
        users.username AS username,
        products.name AS product_name,
        products.price AS product_price,
        products.image_url AS image_url,
        product_size.size AS product_size');
        $this->db->from('checkout');
        $this->db->join('users', 'checkout.user_id = users.id', 'left');
        $this->db->join('product_size', 'checkout.product_size_id = product_size.id', 'left');
        $this->db->join('products', 'product_size.id_products = products.id', 'left');
        $this->db->order_by('checkout.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_last_order_today($date)
    {
        $this->db->select('order_number');
        $this->db->from('checkout');
        $this->db->like('order_number', $date, 'after');
        $this->db->order_by('order_number', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function add_order($data)
    {
        $this->db->insert('checkout', $data);
    }

    public function update_status_by_number($order_number, $status)
    {
        $this->db->where('order_number', $order_number);
        $this->db->update('checkout', array('status' => $status));
        return $this->db->affected_rows();
    }

    public function update_order_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update('checkout', array('status' => $status));
    }

    public function delete_order($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('checkout');
        return $this->db->affected_rows();
    }

    public function get_order_by_user_id($user_id)
    {
        $this->db->select('checkout.*,
        checkout.id AS checkout_id,
        users.username AS username,
        products.name AS product_name,
        products.price AS product_price,
        products.image_url AS image_url,
        product_size.size AS product_size');
        $this->db->from('checkout');
        $this->db->join('users', 'checkout.user_id = users.id', 'left');
        $this->db->join('product_size', 'checkout.product_size_id = product_size.id', 'left');
        $this->db->join('products', 'product_size.id_products = products.id', 'left');
        $this->db->order_by('checkout.id', 'DESC');
        $this->db->where('checkout.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function order_result_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('checkout');
    }

    public function get_weekly_sales()
    {
        // Get sales count per day for the last 7 days (completed only)
        $query = $this->db->query("
            SELECT DATE(created_at) as date, COUNT(*) as total_sales
            FROM checkout
            WHERE created_at >= CURDATE() - INTERVAL 6 DAY
            AND status = 'completed'
            GROUP BY DATE(created_at)
            ORDER BY date ASC
        ");
        return $query->result_array();
    }

    public function get_monthly_sales()
    {
        // Get sales count per day for the last 30 days (completed only)
        $query = $this->db->query("
            SELECT DATE(created_at) as date, COUNT(*) as total_sales
            FROM checkout
            WHERE created_at >= CURDATE() - INTERVAL 29 DAY
            AND status = 'completed'
            GROUP BY DATE(created_at)
            ORDER BY date ASC
        ");
        return $query->result_array();
    }

    public function get_total_revenue()
    {
        // Calculate total revenue from completed orders
        // Assuming price is in products table, we join through product_size
        $this->db->select_sum('products.price', 'total_revenue');
        $this->db->from('checkout');
        $this->db->join('product_size', 'checkout.product_size_id = product_size.id');
        $this->db->join('products', 'product_size.id_products = products.id');
        $this->db->where('checkout.status', 'completed');
        $query = $this->db->get();
        return $query->row()->total_revenue ?? 0;
    }

    public function get_top_selling_products($limit = 5)
    {
        // Count occurring product names in completed orders
        $this->db->select('products.name, products.image_url, COUNT(checkout.id) as total_sold');
        $this->db->from('checkout');
        $this->db->join('product_size', 'checkout.product_size_id = product_size.id');
        $this->db->join('products', 'product_size.id_products = products.id');
        $this->db->where('checkout.status', 'completed');
        $this->db->group_by('products.id');
        $this->db->order_by('total_sold', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_yearly_sales()
    {
        // Get sales count per month for the last 12 months (completed only)
        $query = $this->db->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m') as month_year, 
                   MONTHNAME(created_at) as month_name, 
                   COUNT(*) as total_sales
            FROM checkout
            WHERE created_at >= CURDATE() - INTERVAL 12 MONTH
            AND status = 'completed'
            GROUP BY month_year, month_name
            ORDER BY month_year ASC
        ");
        return $query->result_array();
    }
}
