<?php
require 'index.php';
$CI =& get_instance();
$CI->load->database();

echo "Sizes Table:\n";
$sizes = $CI->db->get('sizes')->result_array();
foreach ($sizes as $s) {
    echo "ID: " . $s['id'] . " - Name: " . $s['name'] . "\n";
}

echo "\nProduct Size Table Columns:\n";
$fields = $CI->db->field_data('product_size');
foreach ($fields as $field) {
    echo $field->name . " (" . $field->type . ")\n";
}
