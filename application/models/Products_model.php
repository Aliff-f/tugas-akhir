<?php
class Products_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_products()
    {
        $this->db->select(
            'products.id AS product_id,
            products.name AS product_name, 
            products.description AS product_description, 
            products.image_url AS product_image, 
            products.price AS product_price'
        );
        $this->db->order_by('products.id', 'DESC');
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function get_product_by_id($id)
    {
        $this->db->select('products.*, "" AS color_name'); // Replaced colors.name with empty string
        $this->db->from('products');
        // $this->db->join('colors', 'products.color_id = colors.id', 'left'); // Removed
        $this->db->where('products.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_recent_products($limit = 4)
    {
        // Mengambil 4 produk terbaru berdasarkan tanggal pembuatan (created_at)
        $this->db->select('*');  // Pilih semua kolom
        $this->db->from('products');  // Dari tabel products
        $this->db->order_by('products.id', 'DESC');
        $this->db->limit($limit);  // Batasi hasilnya menjadi 4 produk terbaru

        $query = $this->db->get();  // Jalankan query
        return $query->result_array();  // Mengembalikan hasil dalam bentuk array
    }

    public function get_random_products($limit = 4)
    {
        // Mengambil produk secara acak
        $this->db->select('*');  // Pilih semua kolom
        $this->db->from('products');  // Dari tabel products
        $this->db->order_by('RAND()');  // Urutkan secara acak
        $this->db->limit($limit);  // Batasi hasilnya menjadi 4 produk

        $query = $this->db->get();  // Jalankan query
        return $query->result_array();  // Mengembalikan hasil dalam bentuk array
    }

    public function count_all_products()
    {
        // Menjalankan query untuk menghitung jumlah data di tabel 'products'
        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function get_products_by_color($color_id)
    {
        $this->db->select('products.*, 
        products.id AS product_id,
        products.name AS product_name, 
        products.description AS product_description, 
        products.image_url AS product_image, 
        products.price AS product_price');
        $this->db->from('products');
        // $this->db->join('colors', 'products.color_id = colors.id', 'left'); // Removed
        $this->db->where('products.color_id', $color_id); // Filter based on color_id if column still exists in products, otherwise logic broken
        $this->db->order_by('products.id', 'DESC'); // Urutkan berdasarkan ID secara menurun
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function get_products_by_size($size_id)
    // {
    //     $this->db->select('products.*, colors.name AS color_name');
    //     $this->db->from('products');
    //     $this->db->join('colors', 'products.color_id = colors.id', 'left');
    //     $this->db->where('products.size_id', $size_id); // Filter berdasarkan ID ukuran
    //     $this->db->order_by('created_at', 'DESC'); // Urutkan berdasarkan created_at secara menurun
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function get_all_distinct_sizes()
    {
        $this->db->distinct();
        $this->db->select('size');
        $this->db->from('product_size');
        $this->db->order_by('size', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_products_by_size($size_value)
    {
        $this->db->select('product_size.*, 
        products.id AS product_id,
        products.name AS product_name, 
        products.description AS product_description, 
        products.image_url AS product_image, 
        products.price AS product_price');
        $this->db->from('product_size');
        // Removed join sizes
        $this->db->join('products', 'product_size.id_products = products.id', 'left');
        $this->db->where('product_size.size', $size_value);
        $this->db->order_by('products.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_products_by_category($category_id)
    {
        $this->db->select('products.*, 
        products.id AS product_id,
        products.name AS product_name, 
        products.description AS product_description, 
        products.image_url AS product_image, 
        products.price AS product_price');
        $this->db->from('products');
        // Removed join colors
        $this->db->where('products.category_id', $category_id); 
        $this->db->order_by('products.id', 'DESC'); 
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sizes_by_product_name($product_name)
    {
        $this->db->select('product_size.*, product_size.size AS size_name'); // Use size column
        $this->db->from('product_size');
        // Removed join sizes
        $this->db->where('id_products', $product_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sizes_by_product($id_product)
    {
        $this->db->select('product_size.*, product_size.size AS size_name'); // Use size column
        $this->db->from('product_size');
        // Removed join sizes
        $this->db->where('id_products', $id_product);
        $this->db->order_by('size', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function decrease_stock($product_id, $qty = 1)
    {
        $this->db->where('id', $product_id);
        $this->db->where('stock >=', $qty);
        $this->db->set('stock', 'stock - ' . (int) $qty, FALSE);
        $this->db->update('products');
        return $this->db->affected_rows() > 0;
    }

    public function increase_stock($product_id, $qty = 1)
    {
        $this->db->where('id', $product_id);
        $this->db->set('stock', 'stock + ' . (int) $qty, FALSE);
        $this->db->update('products');
        return $this->db->affected_rows() > 0;
    }
}
