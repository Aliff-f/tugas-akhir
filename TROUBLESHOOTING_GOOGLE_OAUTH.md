# Troubleshooting: Error 401 Invalid Client

## 🔴 Error yang Terjadi
```
Access blocked: Authorization Error
The OAuth client was not found.
Error 401: invalid_client
```

## 🔍 Penyebab Error

Error ini terjadi karena **Google tidak mengenali Client ID dan/atau Client Secret** yang digunakan. Kemungkinan penyebab:

1. ❌ Client ID atau Client Secret **SALAH/TYPO**
2. ❌ OAuth Client **SUDAH DIHAPUS** di Google Cloud Console
3. ❌ OAuth Client **BELUM DI-PUBLISH** atau masih draft
4. ❌ Ada **SPASI TERSEMBUNYI** di credentials
5. ❌ Copy-paste credentials **TIDAK LENGKAP**

---

## ✅ Solusi - Langkah Demi Langkah

### Langkah 1: Verifikasi Client ID dan Secret di Google Cloud Console

1. **Buka Google Cloud Console**
   - https://console.cloud.google.com/apis/credentials

2. **Pilih Project Anda** (nimble store)

3. **Klik pada OAuth 2.0 Client ID** yang sudah dibuat

4. **Copy ulang Client ID dan Client Secret**
   - Pastikan **COPY LENGKAP** dari awal sampai akhir
   - Jangan ada spasi di awal/akhir
   - Jangan terputus di tengah

5. **Cek bagian "Authorized redirect URIs"**
   - Pastikan ada: `http://localhost/nimble-store/login/google_callback`
   - Harus **PERSIS SAMA** (case sensitive)

---

### Langkah 2: Update File Konfigurasi

1. **Buka file:** `application/config/google.php`

2. **Ganti dengan Client ID dan Secret yang BARU Anda copy**

Contoh format yang benar:
```php
// Client ID - HARUS LENGKAP, tidak ada spasi
$config['google_client_id'] = '271760094030-0c004cus0MrukUn7hPpnDekGC7deb3o05.googleusercontent.com';

// Client Secret - HARUS LENGKAP, tidak ada spasi  
$config['google_client_secret'] = 'GOCSPX-u3We9lpovR8ngzmF3hCJNb0RH5';
```

3. **SAVE file** dan pastikan tersimpan

---

### Langkah 3: Cek OAuth Consent Screen Status

1. Di Google Cloud Console, pergi ke **"OAuth consent screen"**

2. **Pastikan status TIDAK "Draft"**
   - Jika masih draft, klik "PUBLISH APP"
   
3. **Tambahkan Test Users** (jika app masih dalam testing mode)
   - Klik "ADD USERS"
   - Masukkan email Google yang akan Anda gunakan untuk testing
   - Save

---

### Langkah 4: Clear Cache & Test Ulang

1. **Clear browser cache** atau buka **Incognito/Private window**

2. **Restart Laragon** (untuk clear PHP cache)

3. **Test ulang:**
   - Buka: `http://localhost/nimble-store/login`
   - Klik tombol Google
   - Harus redirect ke Google tanpa error

---

## 🆘 Jika Masih Error

### Opsi A: Buat OAuth Client Baru

Jika masih error, lebih mudah **BUAT ULANG OAuth Client**:

1. **Di Google Cloud Console → Credentials**

2. **Klik "CREATE CREDENTIALS" → OAuth client ID**

3. **Application type:** Web application

4. **Name:** Nimble Store OAuth (atau nama apapun)

5. **Authorized redirect URIs:**
   ```
   http://localhost/nimble-store/login/google_callback
   ```

6. **CREATE**

7. **Copy Client ID dan Client Secret yang BARU**

8. **Update file `application/config/google.php`** dengan credentials baru

---

### Opsi B: Enable APIs

Pastikan API yang diperlukan sudah enabled:

1. **Di Google Cloud Console → APIs & Services → Library**

2. **Cari dan Enable:**
   - Google+ API (deprecated tapi kadang diperlukan)
   - People API
   - Google OAuth2 API

---

### Opsi C: Cek Error Log

Tambahkan error logging di controller untuk debug:

Edit `application/controllers/Login.php`, method `google_login()`:

```php
public function google_login()
{
    try {
        $client = $this->get_google_client();
        
        // Debug: print credentials (HAPUS SETELAH DEBUG!)
        echo "Client ID: " . $this->config->item('google_client_id');
        echo "<br>Client Secret: " . $this->config->item('google_client_secret');
        echo "<br>Redirect URI: " . $this->config->item('google_redirect_uri');
        die();
        
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
```

Ini akan menampilkan credentials yang sedang digunakan - cek apakah sudah benar.

**INGAT: HAPUS CODE DEBUG INI SETELAH SELESAI!**

---

## 📋 Checklist Verifikasi

Cek satu per satu:

- [ ] Client ID dan Secret di file config **SAMA PERSIS** dengan di Google Cloud Console
- [ ] Tidak ada spasi di awal/akhir credentials
- [ ] Redirect URI di Google Cloud Console **SAMA PERSIS**: `http://localhost/nimble-store/login/google_callback`
- [ ] OAuth consent screen sudah **PUBLISHED** atau minimal ada test users
- [ ] Email yang digunakan untuk testing **TERDAFTAR** sebagai test user
- [ ] Browser cache sudah di-clear
- [ ] Laragon sudah di-restart

---

## 🎯 Kemungkinan Besar Solusinya

Berdasarkan pengalaman, error ini **90% disebabkan oleh:**

1. **Copy-paste Client Secret tidak lengkap** 
   - Saat copy, pastikan scroll ke kanan untuk copy semua karakter
   - Client Secret biasanya panjang: `GOCSPX-xxxxxxxxxxxxxxxxxx`

2. **Test user belum ditambahkan**
   - Jika OAuth app masih "Testing", hanya test users yang bisa login
   - Tambahkan email Anda di OAuth consent screen → Test users

Silakan coba solusi di atas dan beri tahu hasil nya!
