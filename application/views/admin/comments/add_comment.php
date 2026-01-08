<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ulasan - Neo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f4f5; }
        
        /* --- Neo-Brutalism Utilities --- */
        .nb-card {
            background: #fff;
            border: 3px solid #18181b;
            box-shadow: 8px 8px 0px #18181b;
            border-radius: 16px;
        }

        .nb-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.875rem;
            color: #18181b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .nb-input {
            width: 100%;
            border: 2px solid #18181b;
            padding: 14px 16px;
            border-radius: 10px;
            font-weight: 600;
            outline: none;
            background-color: #ffffff;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nb-input:focus {
            box-shadow: 4px 4px 0px #18181b;
            transform: translate(-2px, -2px);
            border-color: #18181b;
            background-color: #fff;
        }

        .nb-input::placeholder {
            color: #a1a1aa;
            font-weight: 500;
        }

        .nb-btn {
            border: 2px solid #18181b;
            box-shadow: 4px 4px 0px #18181b;
            transition: all 0.15s ease;
            font-weight: 800;
            text-transform: uppercase;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .nb-btn:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px #18181b; }
        .nb-btn:active { transform: translate(0, 0); box-shadow: 0 0 0 #18181b; }

        /* File Upload */
        .upload-area {
            border: 2px dashed #d4d4d8;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            background-color: #fafafa;
            cursor: pointer;
        }
        .upload-area:hover {
            border-color: #18181b;
            background-color: #f0f9ff;
        }
    </style>
</head>
<body class="text-zinc-900">

<section class="w-full lg:ps-64 min-h-screen py-10 px-4 md:px-8 flex flex-col items-center">
    
    <div class="w-full max-w-3xl space-y-6">
        
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="<?= base_url('admin/comments'); ?>" class="nb-btn w-12 h-12 bg-white text-black hover:bg-gray-50">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-extrabold uppercase tracking-tight">Tambah Ulasan</h1>
                    <p class="text-sm font-medium text-gray-500">Buat ulasan manual untuk produk.</p>
                </div>
            </div>
        </div>

        <div class="nb-card relative overflow-hidden">
            <div class="h-3 w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 border-b-2 border-black"></div>

            <div class="p-6 md:p-8">
                <form action="<?php echo site_url('Admin/add_comment_action') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="product_name" class="nb-label">
                                    <i class="fa-solid fa-tag text-blue-600"></i> Nama Produk
                                </label>
                                <input type="text" id="product_name" name="product_name" 
                                       class="nb-input" placeholder="Misal: Sepatu Running..." autocomplete="off" required>
                            </div>

                            <div>
                                <label for="username" class="nb-label">
                                    <i class="fa-solid fa-user text-purple-600"></i> Nama Pengguna
                                </label>
                                <input type="text" id="username" name="username" 
                                       class="nb-input" placeholder="Misal: Budi Santoso" autocomplete="off" required>
                            </div>
                        </div>

                        <div>
                            <label for="rating" class="nb-label">
                                <i class="fa-solid fa-star text-yellow-500"></i> Beri Penilaian
                            </label>
                            <div class="relative">
                                <select id="rating" name="rating" class="nb-input appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>Pilih Bintang...</option>
                                    <option value="5">⭐⭐⭐⭐⭐ (5.0 - Sempurna)</option>
                                    <option value="4">⭐⭐⭐⭐ (4.0 - Bagus)</option>
                                    <option value="3">⭐⭐⭐ (3.0 - Cukup)</option>
                                    <option value="2">⭐⭐ (2.0 - Kurang)</option>
                                    <option value="1">⭐ (1.0 - Buruk)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-black">
                                    <i class="fa-solid fa-chevron-down text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="nb-label">
                                <i class="fa-solid fa-image text-pink-600"></i> Foto Produk (Opsional)
                            </label>
                            <div class="upload-area group" onclick="document.getElementById('product_image').click()">
                                <input type="file" id="product_image" name="product_image" class="hidden" accept="image/*" onchange="previewImage(this)">
                                
                                <div id="uploadPlaceholder" class="flex flex-col items-center justify-center py-2">
                                    <div class="w-12 h-12 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center mb-3 group-hover:border-black group-hover:scale-110 transition-all">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl text-gray-400 group-hover:text-black"></i>
                                    </div>
                                    <p class="text-sm font-bold text-gray-700">Klik untuk unggah foto</p>
                                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max 2MB)</p>
                                </div>
                                
                                <img id="imgPreview" class="hidden h-32 mx-auto object-contain rounded-lg border-2 border-black shadow-sm" alt="Preview">
                            </div>
                        </div>

                        <div>
                            <label for="comment" class="nb-label">
                                <i class="fa-solid fa-comment-dots text-green-600"></i> Isi Ulasan
                            </label>
                            <textarea id="comment" name="comment" rows="4" 
                                      class="nb-input resize-none" 
                                      placeholder="Tulis pendapat pengguna tentang kualitas produk..." required></textarea>
                        </div>

                    </div>

                    <div class="mt-8 pt-6 border-t-2 border-gray-200 flex flex-col-reverse md:flex-row justify-end gap-3">
                        <a href="<?= base_url('admin/comments'); ?>" 
                           class="nb-btn px-6 py-3.5 bg-white text-black hover:bg-gray-100 w-full md:w-auto">
                            Batal
                        </a>
                        <button type="submit" name="submit"
                                class="nb-btn px-8 py-3.5 bg-black text-white hover:bg-gray-800 w-full md:w-auto">
                            <i class="fa-solid fa-paper-plane text-sm"></i> Simpan Ulasan
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
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: "BERHASIL!",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "MANTAP",
            customClass: {
                popup: 'border-3 border-black shadow-[8px_8px_0_0_#000] rounded-xl font-sans',
                confirmButton: 'bg-green-500 text-black border-2 border-black font-bold px-6 py-2 rounded-lg shadow-[4px_4px_0_0_#000] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all',
                title: 'font-black uppercase'
            },
            buttonsStyling: false
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: "GAGAL!",
            html: "<div class='font-bold text-red-600'><?= $this->session->flashdata('error'); ?></div>",
            icon: "error",
            confirmButtonText: "CEK LAGI",
            customClass: {
                popup: 'border-3 border-black shadow-[8px_8px_0_0_#000] rounded-xl font-sans',
                confirmButton: 'bg-red-500 text-black border-2 border-black font-bold px-6 py-2 rounded-lg shadow-[4px_4px_0_0_#000] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all',
                title: 'font-black uppercase'
            },
            buttonsStyling: false
        });
    </script>
<?php endif; ?>

</body>
</html> 