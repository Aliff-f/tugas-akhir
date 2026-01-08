<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Neo Admin</title>
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
            /* Background titik-titik dihapus, diganti warna solid */
            background-color: #f4f4f5;
        }

        /* --- Neo-Brutalism Components --- */
        .neo-card {
            background: white;
            border: 3px solid #09090b;
            border-radius: 12px;
            box-shadow: 8px 8px 0px 0px #09090b;
        }

        .neo-input {
            width: 100%;
            background-color: #fff;
            border: 2px solid #09090b;
            padding: 0.75rem 1rem;
            font-weight: 500;
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
            font-weight: 700;
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
            background-color: #ecfccb;
        }
    </style>
</head>
<body class="text-zinc-900 min-h-screen">

<section class="w-full lg:ps-64 py-10 px-4 md:px-8 flex flex-col items-center">
    <div class="w-full max-w-5xl space-y-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <a href="<?= base_url('admin/products'); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-zinc-500 hover:text-black mb-2 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Produk
                </a>
                <h1 class="text-4xl md:text-5xl font-extrabold text-neo-black tracking-tight uppercase">
                    Tambah Produk
                </h1>
                <p class="text-zinc-600 font-medium mt-2 text-lg">Kelola katalog, harga, dan stok barang.</p>
            </div>
            <div class="hidden md:flex items-center justify-center w-14 h-14 border-2 border-black bg-white shadow-neo rounded-lg">
                <i class="fa-solid fa-box-open text-2xl"></i>
            </div>
        </div>

        <div class="neo-card overflow-hidden">
             <div class="bg-neo-black text-white px-6 py-3 flex items-center justify-between border-b-2 border-black">
                <span class="font-mono font-bold text-sm tracking-widest">INV-ADD-NEW</span>
                <div class="flex gap-2">
                    <div class="w-3 h-3 bg-zinc-600 rounded-full"></div>
                    <div class="w-3 h-3 bg-zinc-400 rounded-full"></div>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <form action="<?php echo site_url('Admin/add_product_action') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        
                        <div class="lg:col-span-4 flex flex-col">
                            <label class="neo-label">
                                <i class="fa-solid fa-image text-blue-600 mr-1"></i> Foto Produk
                            </label>
                            
                            <div class="upload-zone flex-grow rounded-xl cursor-pointer flex flex-col items-center justify-center p-4 text-center min-h-[300px] lg:h-full group" onclick="document.getElementById('product_image').click()">
                                <input type="file" id="product_image" name="picture" class="hidden" accept="image/*" onchange="previewImage(this)" required>
                                
                                <div id="uploadPlaceholder" class="transition-all duration-300 group-hover:scale-105">
                                    <div class="w-20 h-20 bg-white border-2 border-black shadow-neo-sm rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-neo-yellow transition-colors">
                                        <i class="fa-solid fa-camera text-3xl"></i>
                                    </div>
                                    <h3 class="font-bold text-lg">Upload Foto</h3>
                                    <p class="text-xs text-zinc-500 mt-1">Format: JPG, PNG, WEBP</p>
                                </div>

                                <img id="imgPreview" class="hidden w-full h-full absolute inset-0 object-contain p-2 rounded-xl bg-white" alt="Preview">
                                
                                <div id="previewOverlay" class="hidden absolute bottom-4 right-4 bg-white border-2 border-black px-3 py-1 rounded-md text-xs font-bold shadow-neo-sm z-10">
                                    <i class="fa-solid fa-pen"></i> UBAH
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-8 space-y-6">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="neo-label">Nama Produk</label>
                                    <input type="text" id="name" name="name" 
                                           class="neo-input" placeholder="Misal: Sepatu Sneakers" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="brand" class="neo-label">Brand / Merk</label>
                                    <input type="text" id="brand" name="brand" 
                                           class="neo-input" placeholder="Misal: Ventela" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price" class="neo-label">
                                        <i class="fa-solid fa-tag text-green-600 mr-1"></i> Harga (Rp)
                                    </label>
                                    <input type="number" id="price" name="price" 
                                           class="neo-input" placeholder="125000" min="0" required>
                                </div>
                                <div>
                                    <label for="stock" class="neo-label">
                                        <i class="fa-solid fa-layer-group text-purple-600 mr-1"></i> Stok Awal
                                    </label>
                                    <input type="number" id="stock" name="stock" 
                                           class="neo-input" placeholder="10" min="1" required>
                                </div>
                            </div>

                            <div>
                                <label for="category" class="neo-label">Kategori</label>
                                <div class="relative">
                                    <select id="category" name="category" class="neo-input appearance-none cursor-pointer" required>
                                        <option value="" disabled selected>Pilih Kategori...</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-black">
                                        <i class="fa-solid fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                    <textarea id="description" name="description" rows="5" 
                                          class="neo-input resize-none leading-relaxed" 
                                          placeholder="Jelaskan detail spesifikasi, bahan, dan keunggulan produk..."></textarea>
                            </div>

                            <div>
                                <label class="neo-label">
                                    <i class="fa-solid fa-ruler-combined text-orange-500 mr-1"></i> Pilih Ukuran Tersedia
                                </label>
                                <div class="bg-zinc-50 border-2 border-black rounded-lg p-4">
                                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                                        <?php if(isset($sizes) && !empty($sizes)): ?>
                                            <?php foreach ($sizes as $size): ?>
                                                <label class="relative cursor-pointer group">
                                                    <input type="checkbox" name="sizes[]" value="<?= $size['id']; ?>" class="peer sr-only">
                                                    <div class="h-10 w-full flex items-center justify-center bg-white border-2 border-zinc-300 rounded text-sm font-bold text-zinc-500 transition-all peer-checked:bg-neo-black peer-checked:text-white peer-checked:border-black peer-checked:shadow-none peer-hover:border-black group-hover:-translate-y-0.5 shadow-[2px_2px_0_0_#ccc] peer-checked:translate-y-0.5 peer-checked:shadow-none">
                                                        <?= $size['name']; ?>
                                                    </div>
                                                </label>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="col-span-full text-zinc-500 text-sm">Tidak ada data ukuran.</p>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-zinc-500 mt-3 font-medium">* Pilih satu atau lebih ukuran yang tersedia untuk produk ini.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t-2 border-zinc-200 flex flex-col-reverse md:flex-row justify-end gap-4">
                        <button type="button" 
                                onclick="window.location.href = '<?= base_url('admin/products'); ?>';"
                                class="neo-btn bg-white text-black hover:bg-zinc-100 w-full md:w-auto">
                            Batal
                        </button>
                        <button type="submit" name="submit"
                                class="neo-btn bg-neo-yellow text-black w-full md:w-auto">
                            <i class="fa-solid fa-plus-circle mr-2"></i> Simpan Produk
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
        const overlay = document.getElementById('previewOverlay');
        const container = input.closest('.upload-zone');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                overlay.classList.remove('hidden');
                
                // Solid styling when image is present
                container.style.borderStyle = 'solid';
                container.style.borderColor = '#000';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Neo-Brutalism SweetAlert Config
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
            confirmButtonText: "PERBAIKI"
        });
    </script>
<?php endif; ?>
</body>
</html>