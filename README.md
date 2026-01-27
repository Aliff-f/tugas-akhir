# 👟 Solenusa Store

[![CodeIgniter](https://img.shields.io/badge/Framework-CodeIgniter%203-EE4430?style=for-the-badge&logo=codeigniter&logoColor=white)](https://codeigniter.com/)
[![TailwindCSS](https://img.shields.io/badge/Design-Tailwind%20CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

**Solenusa** adalah platform e-commerce sepatu revolusioner yang memadukan estetika **Neo-Brutalism** dengan fungsionalitas modern. Dirancang untuk memberikan pengalaman belanja yang berani, responsif, dan sangat interaktif.

---

## ✨ Fitur Utama

-   🎨 **Desain Neo-Brutalism**: Tampilan unik dengan kontras tinggi, bayangan tajam (hard shadows), dan tipografi tebal.
-   🔑 **Google OAuth 2.0 Integration**: Login cepat dan aman menggunakan akun Google.
-   🛠️ **Manajemen Produk (CRUD)**: Sistem admin lengkap untuk mengelola produk, kategori, warna, dan ukuran.
-   💬 **Sistem Ulasan Pengguna**: Fitur rating dan komentar untuk interaksi pelanggan.
-   📱 **Fully Responsive**: Teroptimasi untuk desktop, tablet, dan smartphone.
-   🛒 **Seamless Checkout**: Alur pembelian yang intuitif dan mudah dipahami.

---

## 🚀 Teknologi

-   **Backend**: PHP / CodeIgniter 3
-   **Frontend**: TailwindCSS, Preline UI
-   **JavaScript**: Alpine.js / Vanilla JS, SwiperJS (Slider)
-   **Database**: MySQL
-   **Utility**: SweetAlert2 (Notifikasi), Google API Client

---

## 📂 Struktur Direktori

```bash
solenusa-store/
├── application/      # Inti aplikasi (Controller, Model, View)
├── database/         # File migrasi & SQL setup
├── public/           # Aset statis (CSS, JS, Images, Uploads)
├── system/           # Core framework CodeIgniter
├── vendor/           # Dependensi Composer
├── .env              # Konfigurasi Environment (API Keys, DB)
└── index.php         # Entry point aplikasi
```

---

## 🛠️ Instalasi & Setup

Siapkan lingkungan server lokal Anda (Laragon/XAMPP) dan ikuti langkah berikut:

### 1. Clone & Install
```bash
git clone https://github.com/Aliff-f/tugas-akhir.git
cd solenusa-store
composer install
npm install
```

### 2. Environment Setup
Rename `.env.example` menjadi `.env` (jika tersedia) atau sesuaikan konfigurasi database dan API Google di:
- `application/config/database.php`
- `application/config/google.php`

### 3. Database
- Buat database baru bernama `solenusa_store`.
- Import file `.sql` yang terdapat di folder `/database`.

### 4. Build Assets
Jika Anda melakukan perubahan pada styling:
```bash
npm run dev # atau npm run build
```

---

## 📸 Preview

![Home Page Preview](./preview/home.png)

---

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buka **Issue** atau kirim **Pull Request** untuk perbaikan dan fitur baru.

Made with ❤️ by [Solenusa Team](https://github.com/Aliff-f)
