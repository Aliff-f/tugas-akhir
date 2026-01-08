<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google OAuth Debug - Nimble Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        h1 {
            color: #4285f4;
            margin-top: 0;
        }
        .info {
            background: #e3f2fd;
            padding: 15px;
            border-left: 4px solid #2196f3;
            margin: 15px 0;
        }
        .error {
            background: #ffebee;
            padding: 15px;
            border-left: 4px solid #f44336;
            margin: 15px 0;
        }
        .success {
            background: #e8f5e9;
            padding: 15px;
            border-left: 4px solid #4caf50;
            margin: 15px 0;
        }
        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }
        .credential {
            background: #f5f5f5;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            word-break: break-all;
        }
        .btn {
            background: #4285f4;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
        }
        .btn:hover {
            background: #357ae8;
        }
        .checklist {
            list-style: none;
            padding: 0;
        }
        .checklist li {
            padding: 8px 0;
        }
        .checklist li:before {
            content: "☐ ";
            font-size: 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🔍 Google OAuth Debug Tool</h1>
        
        <?php
        // Load CodeIgniter config
        define('BASEPATH', TRUE);
        require_once(__DIR__ . '/application/config/google.php');
        ?>
        
        <div class="info">
            <strong>📋 Informasi:</strong> Tool ini membantu Anda troubleshoot masalah Google OAuth.
        </div>

        <h2>1. Credentials yang Sedang Digunakan</h2>
        
        <p><strong>Client ID:</strong></p>
        <div class="credential">
            <code><?php echo isset($config['google_client_id']) ? $config['google_client_id'] : 'TIDAK DITEMUKAN'; ?></code>
        </div>
        
        <p><strong>Client Secret:</strong></p>
        <div class="credential">
            <code><?php echo isset($config['google_client_secret']) ? $config['google_client_secret'] : 'TIDAK DITEMUKAN'; ?></code>
        </div>
        
        <p><strong>Redirect URI:</strong></p>
        <div class="credential">
            <code><?php echo isset($config['google_redirect_uri']) ? $config['google_redirect_uri'] : 'TIDAK DITEMUKAN'; ?></code>
        </div>

        <h2>2. Validasi Credentials</h2>
        
        <?php
        $valid = true;
        $errors = [];

        // Cek Client ID
        if (empty($config['google_client_id'])) {
            $valid = false;
            $errors[] = "Client ID kosong atau tidak ditemukan";
        } elseif (!strpos($config['google_client_id'], 'googleusercontent.com')) {
            $valid = false;
            $errors[] = "Client ID tidak valid - harus mengandung 'googleusercontent.com'";
        }

        // Cek Client Secret
        if (empty($config['google_client_secret'])) {
            $valid = false;
            $errors[] = "Client Secret kosong atau tidak ditemukan";
        } elseif (!strpos($config['google_client_secret'], 'GOCSPX-')) {
            $valid = false;
            $errors[] = "Client Secret tidak valid - harus dimulai dengan 'GOCSPX-'";
        }

        // Cek Redirect URI
        if (empty($config['google_redirect_uri'])) {
            $valid = false;
            $errors[] = "Redirect URI kosong atau tidak ditemukan";
        }

        // Cek spasi
        if (trim($config['google_client_id']) !== $config['google_client_id']) {
            $valid = false;
            $errors[] = "Client ID mengandung spasi di awal/akhir";
        }
        if (trim($config['google_client_secret']) !== $config['google_client_secret']) {
            $valid = false;
            $errors[] = "Client Secret mengandung spasi di awal/akhir";
        }

        if ($valid && empty($errors)) {
            echo '<div class="success">';
            echo '<strong>✅ Validasi Passed!</strong><br>';
            echo 'Format credentials sudah benar. Jika masih error, kemungkinan:';
            echo '<ul>';
            echo '<li>Credentials tidak cocok dengan yang di Google Cloud Console</li>';
            echo '<li>OAuth Client sudah dihapus atau tidak aktif</li>';
            echo '<li>Belum ditambahkan sebagai Test User</li>';
            echo '</ul>';
            echo '</div>';
        } else {
            echo '<div class="error">';
            echo '<strong>❌ Error Ditemukan:</strong><br>';
            echo '<ul>';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
            echo '</div>';
        }
        ?>

        <h2>3. Checklist Troubleshooting</h2>
        
        <ul class="checklist">
            <li>Buka Google Cloud Console dan verify Client ID & Secret</li>
            <li>Pastikan Redirect URI di Google Cloud sama: <code><?php echo $config['google_redirect_uri']; ?></code></li>
            <li>Cek OAuth Consent Screen sudah Published atau tambahkan Test Users</li>
            <li>Tambahkan email Anda sebagai Test User jika app masih "Testing"</li>
            <li>Clear browser cache atau gunakan Incognito mode</li>
            <li>Restart Laragon</li>
        </ul>

        <h2>4. Quick Actions</h2>
        
        <a href="https://console.cloud.google.com/apis/credentials" target="_blank" class="btn">
            🔗 Buka Google Cloud Console
        </a>
        
        <a href="<?php echo $config['google_redirect_uri']; ?>" class="btn">
            🧪 Test Redirect URI
        </a>
        
        <a href="../login" class="btn">
            ◀ Kembali ke Login
        </a>

        <h2>5. Solusi Cepat</h2>
        
        <div class="info">
            <strong>Jika masih error "invalid_client":</strong><br><br>
            
            <strong>Langkah 1:</strong> Buka Google Cloud Console<br>
            <strong>Langkah 2:</strong> Pergi ke Credentials → OAuth 2.0 Client IDs<br>
            <strong>Langkah 3:</strong> Klik client yang sudah dibuat<br>
            <strong>Langkah 4:</strong> Copy ULANG Client ID dan Client Secret (pastikan lengkap!)<br>
            <strong>Langkah 5:</strong> Update file <code>application/config/google.php</code><br>
            <strong>Langkah 6:</strong> Save dan refresh halaman ini<br>
        </div>

        <div class="error">
            <strong>⚠️ Catatan Keamanan:</strong><br>
            File ini menampilkan credentials Anda. <strong>HAPUS file ini setelah debugging selesai!</strong><br>
            Jangan upload file ini ke Git atau server public.
        </div>
    </div>
</body>
</html>
