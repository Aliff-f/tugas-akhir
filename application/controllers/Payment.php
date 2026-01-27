<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Checkout_model');
        
        // Midtrans configuration
        $server_key = $_ENV['MIDTRANS_SERVER_KEY'] ?? getenv('MIDTRANS_SERVER_KEY');
        if ($server_key) {
            \Midtrans\Config::$serverKey = $server_key;
            \Midtrans\Config::$isProduction = filter_var($_ENV['MIDTRANS_IS_PRODUCTION'] ?? getenv('MIDTRANS_IS_PRODUCTION') ?? false, FILTER_VALIDATE_BOOLEAN);
            \Midtrans\Config::$isSanitized = filter_var($_ENV['MIDTRANS_IS_SANITIZED'] ?? getenv('MIDTRANS_IS_SANITIZED') ?? true, FILTER_VALIDATE_BOOLEAN);
            \Midtrans\Config::$is3ds = filter_var($_ENV['MIDTRANS_IS_3DS'] ?? getenv('MIDTRANS_IS_3DS') ?? true, FILTER_VALIDATE_BOOLEAN);
        }
    }

    public function index()
    {
        $order_number = $this->session->flashdata('order_number') ?? $this->input->get('order_number');
        
        if (!$order_number) {
            redirect(base_url('home'));
            return;
        }

        $order_details = $this->Checkout_model->get_order_details_by_number($order_number);
        
        if (empty($order_details)) {
            redirect(base_url('home'));
            return;
        }

        $user_id = $order_details[0]['user_id'];
        $user = $this->Checkout_model->get_user($user_id);

        $item_details = [];
        $total_item_price = 0;

        foreach ($order_details as $item) {
            $total_item_price += $item['product_price'];
            $item_details[] = [
                'id' => $item['product_size_id'],
                'price' => (int)$item['product_price'],
                'quantity' => 1,
                'name' => substr($item['product_name'], 0, 50)
            ];
        }

        // Re-calculate delivery and PPN matching Checkout.php logic
        $delivery = 25000;
        $ppn_rate = 0.025;
        $ppn_amount = round(($total_item_price + $delivery) * $ppn_rate);
        $gross_amount = $total_item_price + $delivery + $ppn_amount;

        $item_details[] = [
            'id' => 'delivery',
            'price' => (int)$delivery,
            'quantity' => 1,
            'name' => 'Delivery Fee'
        ];

        $item_details[] = [
            'id' => 'ppn',
            'price' => (int)$ppn_amount,
            'quantity' => 1,
            'name' => 'PPN (2.5%)'
        ];

        $transaction_details = [
            'order_id' => $order_number . '-' . time(), // Append timestamp to allow retries with same order number in Sandbox
            'gross_amount' => (int)$gross_amount,
        ];

        $customer_details = [
            'first_name'    => $user['full_name'],
            'email'         => $user['email'],
            'phone'         => $user['phone'],
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        $data['snapToken'] = '';
        try {
            $data['snapToken'] = \Midtrans\Snap::getSnapToken($params);
        } catch (Exception $e) {
            log_message('error', 'Midtrans Error: ' . $e->getMessage());
        }

        $data['header_title'] = 'Solenusa | Pembayaran';
        $data['order_number'] = $order_number;
        $data['clientKey'] = $_ENV['MIDTRANS_CLIENT_KEY'] ?? getenv('MIDTRANS_CLIENT_KEY');
        $data['gross_amount'] = (int)$gross_amount;

        $this->load->view('pages/payment/index', $data);
    }
}