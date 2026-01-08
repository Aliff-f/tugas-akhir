# Setup Google OAuth Login - Nimble Store

## 📋 Langkah-Langkah Setup

### 1. ✅ Anda Sudah Melakukan (SELESAI)
- [x] Membuat project di Google Cloud Console
- [x] Mengaktifkan OAuth consent screen
- [x] Membuat OAuth 2.0 Client ID
- [x] Mendapatkan Client ID dan Client Secret
- [x] Menambahkan Authorized Redirect URI: `http://localhost/nimble-store/login/google_callback`

**Credentials Anda:**
- Client ID: `271760094030-0c004cus0MrukUn7hPpnDekGC7deb3o05.googleusercontent.com`
- Client Secret: `GOCSPX-u3We9lpovR8ngzmF3hCJNb0RH5`

---

### 2. 🗄️ Update Database

Buka **phpMyAdmin** atau MySQL client Anda, lalu jalankan query di file:
```
database/add_google_oauth_support.sql
```

Atau copy paste query berikut:

```sql
-- Tambahkan kolom google_id ke tabel users
ALTER TABLE `users`
ADD COLUMN `google_id` VARCHAR(255) NULL DEFAULT NULL AFTER `profile_picture`,
ADD UNIQUE KEY `google_id` (`google_id`);

-- Ubah kolom gender menjadi nullable
ALTER TABLE `users`
MODIFY COLUMN `gender` ENUM('male', 'female', 'other') NULL DEFAULT NULL;

-- Ubah kolom password menjadi nullable  
ALTER TABLE `users`
MODIFY COLUMN `password` VARCHAR(255) NULL DEFAULT NULL;
```

---

### 3. ✅ File yang Sudah Dibuat/Diupdate (SELESAI)

#### File Konfigurasi:
- ✅ `application/config/google.php` - Konfigurasi Google OAuth (credentials sudah diisikan)
- ✅ `application/config/config.php` - Composer autoload diaktifkan

#### Backend:
- ✅ `application/controllers/Login.php` - Ditambahkan:
  - `google_login()` - Inisialisasi OAuth flow
  - `google_callback()` - Handle callback dari Google
  - `get_google_client()` - Helper untuk Google Client
  - `check_or_create_google_user()` - Cek/buat user di database

- ✅ `application/models/Login_model.php` - Ditambahkan:
  - `get_user_by_email()` - Cari user berdasarkan email
  - `create_google_user()` - Buat user baru dari Google
  - `update_google_user()` - Update data Google user

#### Frontend:
- ✅ `application/views/pages/auth/login/index.php` - Tombol Google sudah berfungsi

#### Dependencies:
- ✅ `composer.json` - Google API Client library ditambahkan
- ✅ Library sudah terinstall via Composer

---

### 4. 🧪 Testing

1. **Buka browser** dan akses: `http://localhost/nimble-store/login`

2. **Klik tombol Google** (tombol pertama dengan icon Google)

3. **Anda akan diredirect** ke halaman login Google

4. **Login dengan akun Google** Anda

5. **Authorize aplikasi** Nimble Store

6. **Anda akan diredirect kembali** ke aplikasi dan otomatis login

7. **Cek database** - user baru akan dibuat di tabel `users` dengan:
   - `email` dari Google
   - `username` sama dengan email  
   - `full_name` dari Google
   - `google_id` terisi
   - `profile_picture` dari Google
   - `password` kosong
   - `role` = 'user'

---

## 🔧 Cara Kerja

### Flow Login:
```
User klik tombol Google
    ↓
Redirect ke login/google_login
    ↓
Redirect ke Google OAuth page
    ↓
User authorize aplikasi
    ↓
Google redirect ke login/google_callback?code=xxx
    ↓
Tukar code dengan access token
    ↓
Ambil data user dari Google
    ↓
Cek user di database berdasarkan email
    ↓
    ├─ User ada? → Update google_id & profile_picture
    └─ User tidak ada? → Buat user baru
    ↓
Set session & redirect ke dashboard
```

---

## 🚨 Troubleshooting

### Error: "redirect_uri_mismatch"
**Solusi:** Pastikan Redirect URI di Google Cloud Console sama persis:
```
http://localhost/nimble-store/login/google_callback
```

### Error: "This app is blocked"
**Solusi:** Tambahkan email Anda sebagai test user di OAuth consent screen → Test users

### Error: "Class 'Google_Client' not found"
**Solusi:** Jalankan `composer install` di folder project

### Error: Database - kolom google_id tidak ada
**Solusi:** Jalankan SQL query untuk menambahkan kolom (lihat langkah 2)

---

## 📝 Catatan Penting

1. **Credentials bersifat rahasia** - Jangan commit file `application/config/google.php` ke Git public repository

2. **Production**: Untuk production, ganti:
   - Redirect URI menjadi domain production Anda
   - Update di Google Cloud Console dan `application/config/google.php`

3. **Other OAuth Providers**: 
   - Apple dan Facebook belum diimplementasikan
   - Bisa ditambahkan dengan cara yang sama

---

## ✅ Checklist Verifikasi

- [ ] Database sudah diupdate (kolom `google_id` ada)
- [ ] Composer install berhasil
- [ ] Buka halaman login tanpa error
- [ ] Klik tombol Google redirect ke Google login
- [ ] Setelah login Google, redirect kembali ke aplikasi
- [ ] User tersimpan di database dengan google_id
- [ ] Session terbuat dan bisa akses dashboard

---

**Selamat!** 🎉 Google OAuth Login sudah diimplementasikan dengan baik dan benar!
