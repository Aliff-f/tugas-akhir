<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbarui Akun | Neo-Brutalist</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&family=Space+Grotesk:wght@300;500;700;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        'brutal-orange': '#FF5500', 
                    }
                }
            }
        }
    </script>

    <style>
        /* Base Styles - Background Putih Polos */
        body {
            background-color: #ffffff;
            color: #000;
        }

        /* Neo-Brutalism Utilities */
        .nb-card {
            background: white;
            border: 3px solid black;
            box-shadow: 8px 8px 0px 0px black;
        }

        .nb-input {
            border: 2px solid black;
            background: white;
            transition: all 0.2s ease;
            border-radius: 0; /* Sharp edges */
        }
        .nb-input:focus {
            outline: none;
            box-shadow: 4px 4px 0px 0px black;
            transform: translate(-2px, -2px);
            background-color: #fff;
        }

        .nb-button {
            border: 2px solid black;
            box-shadow: 4px 4px 0px 0px black;
            transition: all 0.2s ease;
            text-transform: uppercase;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
        }
        .nb-button:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px black;
        }
        .nb-button:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px black;
        }

        .nb-radio-label {
            border: 2px solid black;
            cursor: pointer;
            transition: all 0.2s;
        }
        input[type="radio"]:checked + .nb-radio-label {
            background-color: black;
            color: white;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.5);
            transform: translate(-2px, -2px);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #fff; border-left: 2px solid black; }
        ::-webkit-scrollbar-thumb { background: #000; border: 2px solid #fff; }
    </style>
</head>
<body class="text-black min-h-screen flex flex-col">

<section class="w-full lg:ps-64 py-10 px-4 md:px-8 flex-grow">
    <div class="max-w-7xl mx-auto">
        
        <div class="nb-card p-6 md:p-10 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-brutal-orange border-2 border-black rotate-45 z-0"></div>

            <div class="relative z-10 mb-10 pb-6 border-b-2 border-dashed border-gray-300">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="inline-block bg-black text-white px-3 py-1 text-xs font-bold font-display uppercase tracking-widest mb-2">
                            Pengaturan Pengguna
                        </div>
                        <h1 class="text-4xl md:text-5xl font-display font-black uppercase leading-tight tracking-tighter">
                            Edit Profil
                        </h1>
                    </div>
                    <p class="text-sm font-medium border-l-4 border-black pl-4 max-w-xs leading-relaxed text-gray-600">
                        Perbarui informasi pribadi dan keamanan akun Anda. Pastikan data tetap valid.
                    </p>
                </div>
            </div>

            <form id="updateProfileForm" action="<?php echo site_url('User/update_user_action') ?>" method="post" enctype="multipart/form-data" class="relative z-10">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                <div class="grid lg:grid-cols-12 gap-10">
                    
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-gray-50 border-2 border-black p-4 text-center">
                            <label class="block text-sm font-bold font-display uppercase tracking-wider mb-4">Foto Identitas</label>
                            
                            <div class="relative w-40 h-40 mx-auto mb-4 group cursor-pointer">
                                <?php 
                                    // Foto dummy standar
                                    $dummy_avatar = 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
                                    $avatar = !empty($user['image']) ? base_url('uploads/'.$user['image']) : $dummy_avatar; 
                                ?>
                                <img id="profile-preview" src="<?= $avatar ?>" alt="Avatar" class="w-full h-full object-cover border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-white">
                                
                                <div class="absolute inset-0 bg-black/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 border-2 border-transparent">
                                    <i class="fa-solid fa-camera text-white text-2xl"></i>
                                </div>
                                <input type="file" name="picture" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <p class="text-xs font-mono text-gray-500">Klik gambar untuk mengganti.<br>Max: 2MB (JPG/PNG)</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase mb-1">Username</label>
                            <div class="w-full border-2 border-black bg-gray-200 px-4 py-3 font-mono text-sm opacity-75 cursor-not-allowed">
                                @<?php echo $user['username']; ?>
                            </div>
                            <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
                        </div>
                    </div>

                    <div class="lg:col-span-8 space-y-8">
                        
                        <div>
                            <h3 class="text-xl font-display font-bold border-b-2 border-black pb-2 mb-6 flex items-center">
                                <i class="fa-solid fa-user-tag mr-2"></i> Informasi Pribadi
                            </h3>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label class="block text-xs font-bold uppercase mb-1 ml-1">Nama Lengkap</label>
                                    <input type="text" name="fullname" class="nb-input w-full px-4 py-3 font-medium placeholder-gray-400" 
                                           placeholder="Masukkan nama lengkap Anda" value="<?php echo $user['full_name']; ?>">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase mb-1 ml-1">Email</label>
                                    <input type="email" name="email" class="nb-input w-full px-4 py-3 font-medium placeholder-gray-400" 
                                           value="<?php echo $user['email']; ?>">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase mb-1 ml-1">No. Telepon</label>
                                    <input type="text" name="phone" class="nb-input w-full px-4 py-3 font-medium placeholder-gray-400" 
                                           value="<?php echo $user['phone']; ?>">
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-xs font-bold uppercase mb-2 ml-1">Jenis Kelamin</label>
                                    <div class="grid grid-cols-3 gap-4">
                                        <label>
                                            <input type="radio" name="gender" value="male" class="hidden" <?= $user['gender'] === 'male' ? 'checked' : ''; ?>>
                                            <div class="nb-radio-label py-3 text-center text-sm font-bold">PRIA</div>
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="female" class="hidden" <?= $user['gender'] === 'female' ? 'checked' : ''; ?>>
                                            <div class="nb-radio-label py-3 text-center text-sm font-bold">WANITA</div>
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="other" class="hidden" <?= $user['gender'] === 'other' ? 'checked' : ''; ?>>
                                            <div class="nb-radio-label py-3 text-center text-sm font-bold">LAINNYA</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-display font-bold border-b-2 border-black pb-2 mb-6 flex items-center mt-8">
                                <i class="fa-solid fa-map-location-dot mr-2"></i> Alamat & Lokasi
                            </h3>

                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="col-span-2 md:col-span-1">
                                    <input type="text" name="street" class="nb-input w-full px-4 py-3 text-sm" placeholder="Nama Jalan & Nomor" value="<?php echo $user['street_name']; ?>">
                                </div>
                                
                                <div class="col-span-2 md:col-span-1">
                                    <input type="text" name="zip_code" class="nb-input w-full px-4 py-3 text-sm" placeholder="Kode Pos" value="<?php echo $user['zip_code']; ?>">
                                </div>

                                <div class="col-span-2 grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <input type="text" name="province" class="nb-input w-full px-3 py-2 text-sm" placeholder="Provinsi" value="<?php echo $user['address_province']; ?>">
                                    <input type="text" name="city" class="nb-input w-full px-3 py-2 text-sm" placeholder="Kota" value="<?php echo $user['address_city']; ?>">
                                    <input type="text" name="district" class="nb-input w-full px-3 py-2 text-sm" placeholder="Kecamatan" value="<?php echo $user['address_district']; ?>">
                                    <input type="text" name="subdistrict" class="nb-input w-full px-3 py-2 text-sm" placeholder="Kelurahan" value="<?php echo $user['address_subdistrict']; ?>">
                                </div>

                                <div class="col-span-2">
                                    <textarea name="description" rows="2" class="nb-input w-full px-4 py-3 text-sm" placeholder="Patokan / Catatan Tambahan (Misal: Pagar Hitam)"><?php echo $user['address_description']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-black text-white p-6 border-2 border-black mt-4 relative">
                            <div class="absolute top-2 right-2 text-xs font-mono border border-white px-2 py-0.5">AREA SENSITIF</div>
                            <h3 class="text-lg font-display font-bold mb-4 flex items-center text-brutal-orange">
                                <i class="fa-solid fa-lock mr-2"></i> Keamanan
                            </h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs uppercase text-gray-400 mb-1 block">Password Lama</label>
                                    <input type="password" name="password" class="w-full bg-gray-900 border border-gray-700 text-white px-4 py-3 focus:outline-none focus:border-brutal-orange transition-colors" placeholder="••••••••">
                                </div>
                                <div>
                                    <label class="text-xs uppercase text-gray-400 mb-1 block">Password Baru</label>
                                    <input type="password" name="new_password" class="w-full bg-gray-900 border border-gray-700 text-white px-4 py-3 focus:outline-none focus:border-brutal-orange transition-colors" placeholder="Min. 8 Karakter">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-12 pt-6 border-t-2 border-dashed border-gray-300 flex flex-col sm:flex-row justify-end gap-4">
                    <button type="button" onclick="window.location.href = '<?= base_url('user/dashboard'); ?>';"
                        class="nb-button bg-white text-black px-8 py-4 text-sm tracking-wider hover:bg-gray-100">
                        <i class="fa-solid fa-xmark mr-2"></i> Batal
                    </button>
                    
                    <button type="button" onclick="confirmUpdate()"
                        class="nb-button bg-brutal-orange text-black px-8 py-4 text-sm tracking-wider hover:bg-orange-600">
                        Simpan Perubahan <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>

            </form>
        </div>


    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Override SweetAlert Styles for Brutalism */
    div:where(.swal2-container) div:where(.swal2-popup) {
        border: 3px solid #000 !important;
        box-shadow: 8px 8px 0px #000 !important;
        border-radius: 0 !important;
        background: #fff !important;
        color: #000 !important;
        font-family: 'Space Grotesk', sans-serif !important;
    }
    div:where(.swal2-icon) {
        border-color: #000 !important;
        color: #000 !important;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #000 !important;
        color: #fff !important;
        border-radius: 0 !important;
        box-shadow: 4px 4px 0px rgba(0,0,0,0.2) !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
        border: 2px solid transparent !important;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0,0,0,0.4) !important;
    }
    /* Cancel button specific style */
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
        background-color: #fff !important;
        color: #000 !important;
        border: 2px solid #000 !important;
        border-radius: 0 !important;
        font-weight: bold !important;
        box-shadow: 4px 4px 0px rgba(0,0,0,0.1) !important;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:hover {
        background-color: #f0f0f0 !important;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px rgba(0,0,0,0.2) !important;
    }
</style>

<script>
    // 1. Fungsi Preview Gambar (Menimpa Foto Dummy)
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('profile-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Set src gambar dengan data baru
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // 2. Fungsi Konfirmasi Simpan dengan SweetAlert
    function confirmUpdate() {
        Swal.fire({
            title: 'SIMPAN DATA?',
            text: "Pastikan informasi yang Anda masukkan sudah benar!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'YA, SIMPAN!',
            cancelButtonText: 'CEK LAGI',
            reverseButtons: true,
            focusConfirm: false,
            width: '450px'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form secara manual jika user klik YA
                document.getElementById('updateProfileForm').submit();
            }
        });
    }
</script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: "DATA DIPERBARUI",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "LANJUTKAN"
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: "GAGAL MENYIMPAN",
            html: "<?= $this->session->flashdata('error'); ?>",
            icon: "error",
            confirmButtonText: "PERIKSA KEMBALI"
        });
    </script>
<?php endif; ?>

</body>
</html> 