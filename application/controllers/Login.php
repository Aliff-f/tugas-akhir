<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data['header_title'] = 'Solenusa | Masuk';
        $data['hide_navbar_footer'] = true;
        $this->load->view('templates/header', $data);
        $this->load->model('Products_model');
        $query['categories'] = $this->db->get('categories')->result_array();
        $this->load->view('pages/auth/login/index');
        $this->load->view('templates/subscribe');
        $this->load->view('templates/footer', $query);
    }

    public function authenticate()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $response = $this->db->get_where('users', array('email' => $email, 'password' => $password))->row_array();
        if ($response) {
            $data = array(
                'user_logged_in' => TRUE,
                'id' => $response['id'],
                'role' => $response['role'],
                'profile_picture' => $response['profile_picture'],
                'email' => $response['email']
            );
            $this->session->set_userdata($data);
            if ($response['role'] == 'admin') {
                $this->session->set_flashdata('success', 'Login success.');
                redirect(base_url('admin/dashboard'));
            } elseif ($response['role'] == 'user') {
                $this->session->set_flashdata('success', 'Login success.');
                redirect(base_url('user/dashboard'));
            }
        } else {
            $this->session->set_flashdata('error', 'Email or Password is incorrect. Please try again.');
            redirect(base_url('masuk'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('Login'));
    }

    /**
     * Inisialisasi Google OAuth Login
     */
    public function google_login()
    {
        $client = $this->get_google_client();
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    }

    /**
     * Callback dari Google setelah user authorize
     */
    public function google_callback()
    {
        $client = $this->get_google_client();

        // Cek apakah ada code dari Google
        if (!$this->input->get('code')) {
            $this->session->set_flashdata('error', 'Google login gagal. Tidak ada authorization code.');
            redirect(base_url('masuk'));
            return;
        }

        try {
            // Tukar authorization code dengan access token
            $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));

            if (isset($token['error'])) {
                throw new Exception($token['error_description']);
            }

            $client->setAccessToken($token);

            // Dapatkan informasi user dari Google
            $google_oauth = new \Google\Service\Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();

            $email = $google_account_info->email;
            $first_name = $google_account_info->givenName;
            $last_name = $google_account_info->familyName;
            $full_name = $google_account_info->name;
            $google_id = $google_account_info->id;
            $profile_picture = $google_account_info->picture;

            // Cek atau buat user di database
            $user = $this->check_or_create_google_user($email, $google_id, $full_name, $profile_picture);

            if ($user) {
                // Set session
                $data = array(
                    'user_logged_in' => TRUE,
                    'id' => $user['id'],
                    'role' => $user['role'],
                    'profile_picture' => $user['profile_picture'],
                    'email' => $user['email']
                );
                $this->session->set_userdata($data);

                $this->session->set_flashdata('success', 'Login dengan Google berhasil!');

                // Redirect sesuai role
                if ($user['role'] == 'admin') {
                    redirect(base_url('admin/dashboard'));
                } else {
                    redirect(base_url('user/dashboard'));
                }
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat akun. Silakan coba lagi.');
                redirect(base_url('masuk'));
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Google login error: ' . $e->getMessage());
            redirect(base_url('masuk'));
        }
    }

    /**
     * Forgot Password View
     */
    public function forgot_password()
    {
        $data['header_title'] = 'Solenusa | Lupa Password';
        $data['hide_navbar_footer'] = true;
        
        // EmailJS Configuration from .env
        $data['emailjs_public_key'] = $_ENV['EMAILJS_PUBLIC_KEY'] ?? getenv('EMAILJS_PUBLIC_KEY');
        $data['emailjs_service_id'] = $_ENV['EMAILJS_SERVICE_ID'] ?? getenv('EMAILJS_SERVICE_ID');
        $data['emailjs_template_id'] = $_ENV['EMAILJS_TEMPLATE_ID'] ?? getenv('EMAILJS_TEMPLATE_ID');

        // Load header directly since templates might be structured differently
        $this->load->view('templates/header', $data);
        $this->load->view('pages/auth/forgot_password', $data);
        // We might not need footer for this simple page, but following login structure
        // Login uses: $this->load->view('templates/footer', $query); where $query has categories.
        // Let's safe load footer without data or basic data if needed.
        // Login.php index() passes $query['categories']. I should probably fetch it if footer needs it.
        // Checking Login::index() again... yes it fetches categories.
        $this->load->model('Products_model');
        $query['categories'] = $this->db->get('categories')->result_array();
        $this->load->view('templates/footer', $query);
    }

    /**
     * Generate Token (AJAX)
     */
    public function generate_token()
    {
        // Prevent any previous output from breaking JSON
        @ob_clean();
        header('Content-Type: application/json');
        
        try {
            $email = trim($this->input->post('email'));
            
            if (empty($email)) {
                echo json_encode(['status' => 'error', 'message' => 'Email wajib diisi.']);
                return;
            }

            // Verify Login_model is loaded
            if (!isset($this->Login_model)) {
                $this->load->model('Login_model');
            }

            $user = $this->Login_model->get_user_by_email($email);
            
            log_message('error', 'Forgot Password: Searching for ' . $email . '. Found: ' . ($user ? 'Yes (ID: '.$user['id'].')' : 'No'));

            if ($user) {
                // Generate a secure random token
                try {
                    $token = bin2hex(random_bytes(32));
                } catch (Throwable $e) {
                     // Fallback if random_bytes fails (rare/old php)
                     $token = md5(uniqid(rand(), true));
                }
                
                if ($this->Login_model->store_reset_token($email, $token)) {
                    echo json_encode([
                        'status' => 'success', 
                        'token' => $token, 
                        'name' => $user['full_name'] ?? $user['username'],
                        'message' => 'Token generated successfully.'
                    ]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan token ke database.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan.', 'debug_email' => $email]);
            }
        } catch (Throwable $e) { // Catch both Exception and Error
            log_message('error', 'Generate Token Error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    /**
     * Reset Password View
     */
    public function reset_password()
    {
        $token = $this->input->get('token');
        
        if (!$token) {
            $this->session->set_flashdata('error', 'Token is missing.');
            redirect(base_url('masuk'));
            return;
        }

        $user = $this->Login_model->verify_token($token);

        if ($user) {
            $data['header_title'] = 'Solenusa | Reset Password';
            $data['hide_navbar_footer'] = true;
            $data['token'] = $token;
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/auth/reset_password', $data);
            
            $this->load->model('Products_model');
            $query['categories'] = $this->db->get('categories')->result_array();
            $this->load->view('templates/footer', $query);
        } else {
            $this->session->set_flashdata('error', 'Token tidak valid atau sudah kadaluarsa.');
            redirect(base_url('masuk'));
        }
    }

    /**
     * Update Password Action
     */
    public function update_password()
    {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        
        if (empty($password)) {
            $this->session->set_flashdata('error', 'Password tidak boleh kosong.');
            redirect(base_url('Login/reset_password?token=' . $token));
            return;
        }

        if ($this->Login_model->update_password_by_token($token, $password)) {
            $this->session->set_flashdata('success', 'Password berhasil diubah. Silahkan login.');
            redirect(base_url('masuk'));
        } else {
            $this->session->set_flashdata('error', 'Gagal mereset password. Token mungkin sudah kadaluarsa.');
            redirect(base_url('Login/reset_password?token=' . $token));
        }
    }
    
    /**
     * Helper function untuk membuat Google Client
     */
    private function get_google_client()
    {
        $this->config->load('google');

        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));
        $client->setApplicationName($this->config->item('google_application_name'));
        $client->setScopes($this->config->item('google_scopes'));

        return $client;
    }

    /**
     * Cek apakah user sudah ada, jika belum buat user baru
     */
    private function check_or_create_google_user($email, $google_id, $full_name, $profile_picture)
    {
        $this->load->model('Login_model');

        // Cek apakah user dengan email ini sudah ada
        $existing_user = $this->Login_model->get_user_by_email($email);

        if ($existing_user) {
            // Update google_id dan profile picture jika belum ada
            $this->Login_model->update_google_user($existing_user['id'], $google_id, $profile_picture);
            return $existing_user;
        } else {
            // Buat user baru
            $user_data = array(
                'email' => $email,
                'username' => $email, // Gunakan email sebagai username
                'full_name' => $full_name,
                'google_id' => $google_id,
                'profile_picture' => $profile_picture,
                'role' => 'user', // Default role
                'password' => '', // Kosongkan password karena login via Google
                'created_at' => date('Y-m-d H:i:s')
            );

            $user_id = $this->Login_model->create_google_user($user_data);

            if ($user_id) {
                return $this->Login_model->get_user_by_email($email);
            }

            return false;
        }
    }
}