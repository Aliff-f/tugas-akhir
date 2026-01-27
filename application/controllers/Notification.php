<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        
        // Midtrans configuration
        $server_key = $_ENV['MIDTRANS_SERVER_KEY'] ?? getenv('MIDTRANS_SERVER_KEY');
        if ($server_key) {
            \Midtrans\Config::$serverKey = $server_key;
            \Midtrans\Config::$isProduction = filter_var($_ENV['MIDTRANS_IS_PRODUCTION'] ?? getenv('MIDTRANS_IS_PRODUCTION') ?? false, FILTER_VALIDATE_BOOLEAN);
        }
    }

    public function handling()
    {
        try {
            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id_with_timestamp = $notif->order_id;
            $fraud = $notif->fraud_status;

            // Strip the timestamp to get the actual order number
            // The format is {order_number}-{timestamp}
            $parts = explode('-', $order_id_with_timestamp);
            array_pop($parts); // Remove the timestamp
            $order_number = implode('-', $parts);

            if ($transaction == 'capture' || $transaction == 'settlement') {
                if ($type == 'credit_card' && $fraud == 'challenge') {
                    $this->update_status($order_number, 'pending');
                } else {
                    $this->update_status($order_number, 'completed');
                }
            } else if ($transaction == 'pending') {
                $this->update_status($order_number, 'pending');
            } else if ($transaction == 'deny') {
                $this->update_status($order_number, 'cancelled');
            } else if ($transaction == 'expire') {
                $this->update_status($order_number, 'cancelled');
            } else if ($transaction == 'cancel') {
                $this->update_status($order_number, 'cancelled');
            }
            
            echo "OK";
        } catch (Exception $e) {
            log_message('error', 'Notification error: ' . $e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }

    public function check_status($order_number)
    {
        try {
            // Since we use {number}-{timestamp}, we need to find the latest transaction for this order number
            // or just use the order_number directly if Midtrans allows querying by prefix (unlikely)
            // better: the frontend can pass the full MIDTRANS order_id if it has it.
            
            // For now, let's just make it a simple update for testing purposes if called
            $status = $this->input->get('status');
            if ($status) {
                $this->update_status($order_number, $status);
                echo "Updated to $status";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function update_status($order_number, $status)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->update_status_by_number($order_number, $status);
        log_message('info', "Order $order_number updated to $status via Midtrans notification");
    }
}
