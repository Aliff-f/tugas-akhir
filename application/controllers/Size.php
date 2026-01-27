<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size extends CI_Controller
{
    public function add_size($id)
    {
        $this->load->model('Size_model');
        $size_value = $this->input->post('size'); // Contains string like 'XL' or '42'
        $this->db->where('id_products', $id);
        $this->db->where('size', $size_value);
        $existing_size = $this->db->get('product_size')->row();

        if ($existing_size) {
            $this->session->set_flashdata('error', 'Size already added to this product.');
            redirect('Admin/update_product/' . $id);
        } else {
            $data = array(
                'id_products' => $id,
                'size' => $size_value
            );

            $this->Size_model->add_size($data);

            if ($this->db->affected_rows()) {
                $this->session->set_flashdata('success', 'Add product size successfully.');
                redirect('Admin/update_product/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Failed to add size. Please try again.');
                redirect('Admin/update_product/' . $id);
            }
        }
    }

    public function delete_size($product_size)
    {
        $this->load->model('Size_model');
        $this->Size_model->delete_size($product_size);
        $this->session->set_flashdata('success', 'Delete product size successfully.');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
