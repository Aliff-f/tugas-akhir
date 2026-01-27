<?php
require 'index.php';
$CI =& get_instance();
$CI->load->model('Size_model');

$test_size = "TEST-XL-" . rand(100,999);

echo "Testing Size Logic for: $test_size\n";

// 1. Check if exists (should be false)
echo "1. Checking existence... ";
$exists = $CI->Size_model->get_size_by_name($test_size);
if (!$exists) {
    echo "PASS (Not found)\n";
} else {
    echo "FAIL (Found unexpectedly)\n";
}

// 2. Create it
echo "2. Creating size... ";
$id = $CI->Size_model->create_size($test_size);
if ($id) {
    echo "PASS (Created ID: $id)\n";
} else {
    echo "FAIL (Creation failed)\n";
}

// 3. Check again (should be found)
echo "3. Checking existence again... ";
$exists_again = $CI->Size_model->get_size_by_name($test_size);
if ($exists_again && $exists_again['id'] == $id) {
    echo "PASS (Found correct ID)\n";
} else {
    echo "FAIL (Not found or ID mismatch)\n";
}
