<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk - Neo Admin</title>
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
                        'neo-red': '#ff6b6b',
                        'neo-blue': '#4dabf7',
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

        .neo-btn-sm {
            padding: 0.4rem 1rem;
            font-size: 0.75rem;
            box-shadow: 2px 2px 0px 0px #09090b;
        }
        .neo-btn-sm:hover { box-shadow: 3px 3px 0px 0px #09090b; }

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

        .neo-table thead th {
            border-bottom: 3px solid #09090b;
            background-color: #ffdc58;
            color: #09090b;
            font-weight: 900;
            text-transform: uppercase;
            padding: 1rem;
            text-align: left;
        }
        .neo-table tbody td {
            border-bottom: 1px solid #e4e4e7;
            padding: 1rem;
            color: #09090b;
            font-weight: 500;
        }
        .neo-table tbody tr:last-child td { border-bottom: none; }
    </style>
</head>
<body class="text-zinc-900 min-h-screen">

<section class="w-full lg:ps-64 py-10 px-4 md:px-8 flex flex-col items-center">
    <div class="w-full max-w-5xl space-y-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <a href="<?= base_url('admin/products'); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-zinc-500 hover:text-black mb-2 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                </a>
                <h1 class="text-4xl md:text-5xl font-extrabold text-neo-black tracking-tight uppercase">
                    Perbarui Produk
                </h1>
                <p class="text-zinc-600 font-medium mt-2 text-lg">Edit informasi detail produk dan kelola stok.</p>
            </div>
            <div class="hidden md:flex items-center justify-center w-14 h-14 border-2 border-black bg-neo-yellow shadow-neo rounded-lg">
                <i class="fa-solid fa-pen-to-square text-2xl"></i>
            </div>
        </div>

        <div class="neo-card">
             <div class="bg-neo-black text-white px-6 py-3 flex items-center justify-between border-b-2 border-black">
                <span class="font-mono font-bold text-sm tracking-widest">PRODUCT-EDIT-MODE</span>
                <div class="flex gap-2">
                    <div class="w-3 h-3 bg-yellow-400 rounded-full border border-white"></div>
                    <div class="w-3 h-3 bg-green-400 rounded-full border border-white"></div>
                </div>
            </div>

            <div class="p-6 md:p-10">
                <form action="<?php echo site_url('Admin/update_product_action') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        
                        <div class="lg:col-span-4 flex flex-col">
                            <label class="neo-label">
                                <i class="fa-solid fa-image text-blue-600 mr-1"></i> Foto Produk
                            </label>
                            
                            <div class="upload-zone flex-grow rounded-xl cursor-pointer flex flex-col items-center justify-center p-4 text-center min-h-[300px] lg:h-full group relative overflow-hidden bg-white" 
                                 onclick="document.getElementById('product_image').click()" 
                                 style="border: 2px solid #000;"> 
                                <input type="file" id="product_image" name="picture" class="hidden" accept="image/*" onchange="previewImage(this)">
                                
                                <div id="uploadPlaceholder" class="<?php echo !empty($product['picture']) ? 'hidden' : ''; ?> flex flex-col items-center justify-center transition-all duration-300 group-hover:scale-105">
                                    <div class="w-24 h-24 bg-white border-2 border-black rounded-full flex items-center justify-center mb-5 shadow-[4px_4px_0px_0px_#000]">
                                        <i class="fa-solid fa-camera text-4xl text-black"></i>
                                    </div>
                                    <h3 class="text-xl font-extrabold text-black tracking-tight mb-1">Upload Foto</h3>
                                    <p class="text-sm text-zinc-500 font-medium">Format: JPG, PNG, WEBP</p>
                                </div>

                                <img id="imgPreview" 
                                     src="<?php echo !empty($product['picture']) ? base_url('public/uploads/' . $product['picture']) . '?v=' . time() : ''; ?>" 
                                     class="<?php echo empty($product['picture']) ? 'hidden' : ''; ?> w-full h-full object-contain rounded-lg absolute inset-0 p-2 z-10 bg-white" 
                                     alt="Preview">

                                <div id="hoverOverlay" class="<?php echo empty($product['picture']) ? 'hidden' : ''; ?> absolute inset-0 bg-black/10 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 pointer-events-none">
                                     <div class="bg-white border-2 border-black px-4 py-2 rounded-lg shadow-[4px_4px_0px_0px_#000]">
                                         <span class="font-bold text-black text-xs uppercase">Ganti Foto</span>
                                     </div>
                                 </div>
                            </div>
                        </div>

                        <div class="lg:col-span-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="neo-label">Nama Produk</label>
                                    <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" class="neo-input" placeholder="Misal: Sepatu Sneakers" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="brand" class="neo-label">Brand</label>
                                    <input type="text" id="brand" name="brand" value="<?php echo $product['brand']; ?>" class="neo-input" placeholder="Misal: Ventela" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price" class="neo-label"><i class="fa-solid fa-tag text-green-600 mr-1"></i> Harga (Rp)</label>
                                    <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" class="neo-input" placeholder="125000" min="0" required>
                                </div>
                                <div>
                                    <label for="stock" class="neo-label"><i class="fa-solid fa-layer-group text-purple-600 mr-1"></i> Stok Total</label>
                                    <input type="number" id="stock" name="stock" value="<?php echo $product['stock']; ?>" class="neo-input" placeholder="10" min="1" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1">
                                <div>
                                    <label for="category" class="neo-label">Kategori</label>
                                    <div class="relative">
                                        <select id="category" name="category" class="neo-input appearance-none cursor-pointer bg-white" required>
                                            <option value="" disabled <?php echo empty($product['category_id']) ? 'selected' : ''; ?>>Pilih Kategori...</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category['id'] ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                                                    <?php echo $category['name'] ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-black">
                                            <i class="fa-solid fa-chevron-down text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="neo-label">Deskripsi</label>
                                <textarea id="description" name="description" rows="4" class="neo-input resize-none leading-relaxed" placeholder="Deskripsi produk..."><?php echo $product['description']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t-2 border-zinc-200 flex flex-col-reverse md:flex-row justify-end gap-4">
                        <button type="button" onclick="window.location.href = '<?= base_url('admin/products'); ?>';" class="neo-btn bg-white text-black hover:bg-zinc-100 w-full md:w-auto">Batal</button>
                        <button type="submit" name="submit" class="neo-btn bg-neo-yellow text-black w-full md:w-auto">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="neo-card">
            <div class="px-6 py-5 border-b-3 border-black bg-white flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h2 class="text-2xl font-black uppercase flex items-center gap-2">
                        <i class="fa-solid fa-ruler-combined"></i> Varian Ukuran
                    </h2>
                    <p class="text-sm text-zinc-500 font-bold mt-1">Kelola ukuran yang tersedia untuk produk ini.</p>
                </div>
                <button type="button" id="add-size-button" class="neo-btn bg-neo-black text-white hover:bg-zinc-800 text-sm py-3">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Ukuran
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full neo-table">
                    <thead>
                        <tr>
                            <th class="w-20">ID</th>
                            <th>Ukuran</th>
                            <th>Dibuat Pada</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($products_sizes)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-8 text-zinc-500 italic font-bold">Belum ada data ukuran. Klik "Tambah Ukuran" untuk menambahkan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products_sizes as $product_size) : ?>
                            <tr class="hover:bg-yellow-50 transition-colors">
                                <td class="font-mono text-zinc-500">#<?php echo $product_size['id'] ?></td>
                                <td class="text-lg font-bold"><?php echo $product_size['size_name'] ?></td>
                                <td class="text-sm font-mono"><?php echo $product_size['created_at'] ?></td>
                                <td class="text-right">
                                    <a href="<?php echo base_url('Size/delete_size/' . $product_size['id']) ?>" 
                                       onclick="return confirmDelete(event, this.href)"
                                       class="neo-btn neo-btn-sm bg-neo-red text-white hover:bg-red-600 border-2 border-black inline-flex items-center gap-1">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="bg-zinc-50 border-t-2 border-black">
                        <tr>
                            <td colspan="4" class="px-6 py-3 font-bold text-sm">
                                Total Data: <span class="bg-black text-white px-2 py-0.5 rounded ml-1"><?php echo $count_all_product_sizes?></span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div id="add-size-section" class="hidden transition-all duration-300 ease-in-out">
            <div class="neo-card border-dashed border-zinc-400 bg-zinc-50">
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-black text-white rounded flex items-center justify-center font-bold text-lg">+</div>
                        <h2 class="text-xl font-black uppercase">Tambah Ukuran Baru</h2>
                    </div>

                    <form action="<?php echo site_url('Size/add_size/') . $product['id']; ?>" method="post">
                        <div class="flex flex-col md:flex-row gap-4 items-end">
                            <div class="flex-grow w-full">
                                <label for="af-account-size" class="neo-label">Pilih Ukuran</label>
                                <div class="relative">
                                    <select id="af-account-size" name="size" class="neo-input appearance-none cursor-pointer" required>
                                        <option value="" disabled selected>-- Pilih Size --</option>
                                        <?php foreach ($sizes as $size) : ?>
                                            <option value="<?php echo $size['id']; ?>">
                                                <?php echo $size['name']; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-black">
                                        <i class="fa-solid fa-chevron-down text-sm"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-3 w-full md:w-auto">
                                <button type="button" id="add-size-cancel-button" class="neo-btn bg-white w-full md:w-auto">Batal</button>
                                <button type="submit" name="submit" class="neo-btn bg-blue-500 text-white hover:bg-blue-600 w-full md:w-auto">
                                    <i class="fa-solid fa-check mr-2"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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

    const addSizeButton = document.getElementById('add-size-button');
    const addSizeCancelButton = document.getElementById('add-size-cancel-button');
    const addSizeSection = document.getElementById('add-size-section');

    addSizeButton.addEventListener('click', function() {
        addSizeSection.classList.remove('hidden');
        addSizeSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    addSizeCancelButton.addEventListener('click', function() {
        addSizeSection.classList.add('hidden');
    });

    const swalNeoConfig = {
        customClass: {
            popup: 'border-3 border-black shadow-[8px_8px_0_0_#000] rounded-xl font-sans bg-white',
            title: 'font-black uppercase text-2xl text-black',
            htmlContainer: 'font-medium text-zinc-600',
            confirmButton: 'bg-neo-black text-white border-2 border-black font-bold px-6 py-3 rounded-lg shadow-[4px_4px_0_0_#888] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all uppercase mr-2',
            cancelButton: 'bg-white text-black border-2 border-black font-bold px-6 py-3 rounded-lg shadow-[4px_4px_0_0_#888] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all uppercase',
            actions: 'gap-3'
        },
        buttonsStyling: false
    };

    function confirmDelete(e, url) {
        e.preventDefault();
        Swal.fire({
            ...swalNeoConfig,
            title: "YAKIN HAPUS?",
            text: "Ukuran ini akan dihapus permanen dari produk.",
            icon: "warning",
            iconColor: '#000',
            showCancelButton: true,
            confirmButtonText: "YA, HAPUS",
            cancelButtonText: "BATAL"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
        return false;
    }
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