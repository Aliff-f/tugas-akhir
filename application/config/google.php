<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Google OAuth Configuration
|--------------------------------------------------------------------------
|
| Konfigurasi untuk Google OAuth Login
| Dapatkan credentials dari: https://console.cloud.google.com/
|
| Langkah-langkah:
| 1. Buat project di Google Cloud Console
| 2. Enable Google+ API atau People API
| 3. Buat OAuth 2.0 Client ID
| 4. Tambahkan Authorized Redirect URI
| 5. Copy Client ID dan Client Secret ke bawah ini
|
*/

// PENTING: Ganti dengan Client ID Anda dari Google Cloud Console
$config['google_client_id'] = $_ENV['GOOGLE_CLIENT_ID'];

// PENTING: Ganti dengan Client Secret Anda dari Google Cloud Console  
$config['google_client_secret'] = $_ENV['GOOGLE_CLIENT_SECRET'];

// Redirect URI - harus sama dengan yang didaftarkan di Google Cloud Console
$config['google_redirect_uri'] = 'http://localhost/solenusa-store/login/google_callback';

// Application name
$config['google_application_name'] = 'Solenusa Store';

// Scopes - informasi apa yang akan diminta dari Google
$config['google_scopes'] = [
    'email',
    'profile'
];
