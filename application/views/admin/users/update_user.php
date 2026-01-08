<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbarui Pengguna - Neo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Public Sans"', 'sans-serif'],
                    },
                    colors: {
                        'neo-black': '#09090b',
                        'neo-yellow': '#ffdc58',
                        'neo-blue': '#4dabf7',
                        'neo-red': '#ff6b6b',
                        'neo-green': '#22c55e',
                    },
                    boxShadow: {
                        'neo': '5px 5px 0px 0px #09090b',
                        'neo-sm': '3px 3px 0px 0px #09090b',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            /* Background titik-titik telah dihapus */
            background-color: #f4f4f5;
        }

        /* --- Neo-Brutalism Components --- */
        .neo-card {
            background: white;
            border: 3px solid #09090b;
            border-radius: 12px;
            box-shadow: 8px 8px 0px 0px #09090b;
            overflow: hidden;
        }

        .neo-input {
            width: 100%;
            background-color: #fff;
            border: 2px solid #09090b;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #09090b;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            outline: none;
        }
        
        .neo-input:focus {
            box-shadow: 4px 4px 0px 0px #09090b;
            transform: translate(-2px, -2px);
            background-color: #fafafa;
        }

        .neo-label {
            display: block;
            font-weight: 800;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #09090b;
        }

        .neo-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            border: 2px solid #09090b;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            text-transform: uppercase;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 4px 0px 0px #09090b;
            cursor: pointer;
        }

        .neo-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #09090b;
        }

        .neo-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #09090b;
        }

        /* Upload Area */
        .upload-zone {
            border: 2px dashed #a1a1aa;
            background-color: #fafafa;
            transition: all 0.3s ease;
            position: relative;
        }
        .upload-zone:hover {
            border-color: #09090b;
            border-style: solid;
            background-color: #ffffff;
        }

        /* Radio Group Styling */
        .neo-radio-group label {
            cursor: pointer;
            transition: all 0.2s;
        }
        .neo-radio-group input:checked + span {
            background-color: #09090b;
            color: white;
            border-color: #09090b;
            box-shadow: 3px 3px 0px 0px #9ca3af;
            transform: translate(-2px, -2px);
        }
    </style>
</head>
<body class="text-zinc-900 min-h-screen">

<section class="w-full lg:ps-64 py-10 px-4 md:px-8 flex flex-col items-center">
    <div class="w-full max-w-5xl space-y-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <a href="<?= base_url('admin/users'); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-zinc-500 hover:text-black mb-2 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                </a>
                <h1 class="text-4xl md:text-5xl font-extrabold text-neo-black tracking-tight uppercase">
                    Perbarui Pengguna
                </h1>
                <p class="text-zinc-600 font-medium mt-2 text-lg">Kelola nama, kata sandi, dan pengaturan akun.</p>
            </div>
            <div class="hidden md:flex items-center justify-center w-14 h-14 border-2 border-black bg-neo-yellow shadow-neo rounded-lg">
                <i class="fa-solid fa-user-pen text-2xl"></i>
            </div>
        </div>

        <div class="neo-card">
             <div class="bg-neo-black text-white px-6 py-3 flex items-center justify-between border-b-2 border-black">
                <span class="font-mono font-bold text-sm tracking-widest">USER-EDIT-MODE</span>
                <div class="flex gap-2">
                    <div class="w-3 h-3 bg-yellow-400 rounded-full border border-white"></div>
                    <div class="w-3 h-3 bg-green-400 rounded-full border border-white"></div>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <form action="<?php echo site_url('Admin/update_user_action') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        
                        <div class="lg:col-span-4 flex flex-col">
                            <label class="neo-label">
                                <i class="fa-solid fa-camera text-blue-600 mr-1"></i> Foto Profil
                            </label>
                            
                            <div class="upload-zone flex-grow rounded-xl cursor-pointer flex flex-col items-center justify-center p-4 text-center min-h-[300px] group relative overflow-hidden bg-white" 
                                 onclick="document.getElementById('profile_image').click()" 
                                 style="border: 2px solid #000;">
                                
                                <input type="file" id="profile_image" name="picture" class="hidden" accept="image/*" onchange="previewImage(this)">
                                
                                <div id="uploadPlaceholder" class="<?php echo !empty($user['picture']) ? 'hidden' : ''; ?> flex flex-col items-center justify-center transition-all duration-300 group-hover:scale-105">
                                    <div class="w-24 h-24 bg-white border-2 border-black rounded-full flex items-center justify-center mb-5 shadow-[4px_4px_0px_0px_#000]">
                                        <i class="fa-solid fa-camera text-4xl text-black"></i>
                                    </div>
                                    <h3 class="text-xl font-extrabold text-black tracking-tight mb-1">
                                        Upload Foto
                                    </h3>
                                    <p class="text-sm text-zinc-500 font-medium">
                                        Format: JPG, PNG, WEBP
                                    </p>
                                </div>

                                <img id="imgPreview" 
                                     src="<?php echo !empty($user['picture']) ? base_url('upload/user/' . $user['picture']) : ''; ?>" 
                                     class="<?php echo empty($user['picture']) ? 'hidden' : ''; ?> w-full h-full object-cover rounded-lg absolute inset-0 p-2 z-10 bg-white" 
                                     alt="Preview">
                                
                                <div id="hoverOverlay" class="<?php echo empty($user['picture']) ? 'hidden' : ''; ?> absolute inset-0 bg-black/10 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 pointer-events-none">
                                     <div class="bg-white border-2 border-black px-4 py-2 rounded-lg shadow-[4px_4px_0px_0px_#000]">
                                         <span class="font-bold text-black text-xs uppercase">Ganti Foto</span>
                                     </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-8 space-y-6">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="fullname" class="neo-label">Nama Lengkap</label>
                                    <input type="text" id="fullname" name="fullname" 
                                           value="<?php echo $user['full_name']; ?>"
                                           class="neo-input" placeholder="Contoh: Salman Abdurrahman" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="username" class="neo-label">Nama Pengguna</label>
                                    <input type="text" id="username" name="username" 
                                           value="<?php echo $user['username']; ?>"
                                           class="neo-input" placeholder="Contoh: salmanabd" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="email" class="neo-label">
                                        <i class="fa-solid fa-envelope text-red-500 mr-1"></i> Email
                                    </label>
                                    <input type="email" id="email" name="email" 
                                           value="<?php echo $user['email']; ?>"
                                           class="neo-input" placeholder="nama@email.com" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="phone" class="neo-label">
                                        <i class="fa-solid fa-phone text-green-600 mr-1"></i> No Telepon
                                    </label>
                                    <input type="text" id="phone" name="phone" 
                                           value="<?php echo $user['phone']; ?>"
                                           class="neo-input" placeholder="+62 812 3456 7890" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="p-5 border-2 border-dashed border-zinc-400 bg-zinc-50 rounded-lg">
                                <label class="neo-label text-zinc-500 mb-4"><i class="fa-solid fa-lock mr-1"></i> Ganti Kata Sandi (Opsional)</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <input type="password" id="password" name="password" 
                                               class="neo-input" placeholder="Kata Sandi Saat Ini" autocomplete="off">
                                    </div>
                                    <div>
                                        <input type="password" id="new_password" name="new_password" 
                                               class="neo-input" placeholder="Kata Sandi Baru" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="neo-label">Jenis Kelamin</label>
                                <div class="flex gap-4 neo-radio-group">
                                    <label class="flex-1">
                                        <input type="radio" name="gender" value="male" class="hidden" <?= $user['gender'] === 'male' ? 'checked' : ''; ?>>
                                        <span class="flex items-center justify-center w-full py-3 border-2 border-zinc-300 rounded-lg font-bold text-zinc-500 hover:border-black transition-all">
                                            <i class="fa-solid fa-mars mr-2"></i> Laki-Laki
                                        </span>
                                    </label>
                                    <label class="flex-1">
                                        <input type="radio" name="gender" value="female" class="hidden" <?= $user['gender'] === 'female' ? 'checked' : ''; ?>>
                                        <span class="flex items-center justify-center w-full py-3 border-2 border-zinc-300 rounded-lg font-bold text-zinc-500 hover:border-black transition-all">
                                            <i class="fa-solid fa-venus mr-2"></i> Perempuan
                                        </span>
                                    </label>
                                    <label class="flex-1">
                                        <input type="radio" name="gender" value="other" class="hidden" <?= $user['gender'] === 'other' ? 'checked' : ''; ?>>
                                        <span class="flex items-center justify-center w-full py-3 border-2 border-zinc-300 rounded-lg font-bold text-zinc-500 hover:border-black transition-all">
                                            Lainnya
                                        </span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="my-8 border-t-2 border-dashed border-zinc-300 relative">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4">
                            <i class="fa-solid fa-map-location-dot text-zinc-300 text-xl"></i>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-black uppercase mb-6 flex items-center">
                        <span class="bg-neo-yellow px-2 mr-2 border-2 border-black shadow-[2px_2px_0_0_#000] text-sm">ALAMAT</span> Detail Lokasi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label class="neo-label">Provinsi</label>
                            <input type="text" name="province" class="neo-input" placeholder="Jawa Timur" value="<?php echo $user['address_province']; ?>">
                        </div>
                        <div>
                            <label class="neo-label">Kota/Kabupaten</label>
                            <input type="text" name="city" class="neo-input" placeholder="Surabaya" value="<?php echo $user['address_city']; ?>">
                        </div>
                        <div>
                            <label class="neo-label">Kecamatan</label>
                            <input type="text" name="district" class="neo-input" placeholder="Benowo" value="<?php echo $user['address_district']; ?>">
                        </div>
                        <div>
                            <label class="neo-label">Kelurahan</label>
                            <input type="text" name="subdistrict" class="neo-input" placeholder="Sememi" value="<?php echo $user['address_subdistrict']; ?>">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <label class="neo-label">Alamat Jalan</label>
                            <input type="text" name="street" class="neo-input" placeholder="Jl. Bandarejo Asri No. 12" value="<?php echo $user['street_name']; ?>">
                        </div>
                        <div>
                            <label class="neo-label">Kode Pos</label>
                            <input type="text" name="zip_code" class="neo-input" placeholder="50123" value="<?php echo $user['zip_code']; ?>">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="neo-label">Deskripsi Tambahan</label>
                        <textarea name="description" rows="3" class="neo-input resize-none" placeholder="Catatan tambahan (Opsional)..."><?php echo $user['address_description']; ?></textarea>
                    </div>

                    <div class="mt-10 pt-6 border-t-2 border-zinc-200 flex flex-col-reverse md:flex-row justify-end gap-4">
                        <button type="button" 
                                onclick="window.location.href = '<?= base_url('admin/users'); ?>';"
                                class="neo-btn bg-white text-black hover:bg-zinc-100 w-full md:w-auto">
                            Batal
                        </button>
                        <button type="submit" name="submit"
                                class="neo-btn bg-neo-yellow text-black w-full md:w-auto">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Image Preview Logic
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        const placeholder = document.getElementById('uploadPlaceholder');
        const hoverOverlay = document.getElementById('hoverOverlay');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                hoverOverlay.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Custom SweetAlert Config
    const swalNeoConfig = {
        customClass: {
            popup: 'border-3 border-black shadow-[8px_8px_0_0_#000] rounded-xl font-sans bg-white',
            title: 'font-black uppercase text-2xl text-black',
            htmlContainer: 'font-medium text-zinc-600',
            confirmButton: 'bg-neo-black text-white border-2 border-black font-bold px-6 py-3 rounded-lg shadow-[4px_4px_0_0_#888] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all uppercase',
        },
        buttonsStyling: false
    };
</script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            ...swalNeoConfig,
            title: "BERHASIL!",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            iconColor: '#000',
            confirmButtonText: "MANTAP"
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            ...swalNeoConfig,
            title: "GAGAL!",
            html: "<div class='text-left text-red-600 font-bold list-disc pl-4'><?= $this->session->flashdata('error'); ?></div>",
            icon: "error",
            iconColor: '#ef4444',
            confirmButtonText: "CEK LAGI"
        });
    </script>
<?php endif; ?>

</body>
</html>