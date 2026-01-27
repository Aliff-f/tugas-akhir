<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk | Neo-Brutalism</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@300;500;700;900&display=swap" rel="stylesheet">

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
                        'brutal-yellow': '#D6F264',
                        'brutal-gray': '#F3F3F3',
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #ffffff; color: #000; }
        
        /* Neo-Brutalist Utilities */
        .nb-border { border: 3px solid black; }
        .nb-shadow { box-shadow: 6px 6px 0px 0px black; }
        .nb-shadow-hover:hover { box-shadow: 8px 8px 0px 0px black; transform: translate(-2px, -2px); }
        .nb-shadow-active:active { box-shadow: 2px 2px 0px 0px black; transform: translate(2px, 2px); }
        
        .nb-table-head { background-color: black; color: white; text-transform: uppercase; letter-spacing: 0.05em; }
        
        .nb-input {
            width: 100%;
            background-color: #fff;
            border: 3px solid black;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: black;
            border-radius: 0;
            transition: all 0.2s ease;
            outline: none;
        }
        .nb-input:focus {
            box-shadow: 4px 4px 0px 0px black;
            transform: translate(-1px, -1px);
            background-color: #fff;
        }

        .upload-zone {
            border: 3px dashed #000;
            background-color: #F3F3F3;
            transition: all 0.3s ease;
            position: relative;
        }
        .upload-zone:hover {
            border-style: solid;
            background-color: #D6F264;
        }

        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="min-h-screen">

<section class="w-full lg:ps-[280px] bg-white min-h-screen">
    <div class="p-6 md:p-8 space-y-8">
        
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b-4 border-black pb-6">
                <div class="space-y-2">
                    <a href="<?= base_url('admin/products'); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-gray-600 hover:text-black transition-colors uppercase font-display">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <div>
                         <div class="inline-block bg-brutal-orange border-2 border-black px-3 py-1 text-xs font-bold font-display uppercase tracking-widest mb-2 shadow-[2px_2px_0px_0px_black] text-white">
                            Admin
                        </div>
                        <h1 class="text-4xl md:text-5xl font-display font-black uppercase tracking-tighter leading-none">
                            Perbarui Produk
                        </h1>
                        <p class="text-gray-600 font-medium mt-2 max-w-md">
                             Edit detail produk, harga, stok, dan varian ukuran.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pb-12 space-y-10">
            <!-- PRODUCT FORM START -->
            <div class="border-3 border-black nb-shadow bg-white overflow-hidden p-6 md:p-8">
                 <div class="mb-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-black text-white flex items-center justify-center text-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)]">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <h2 class="text-2xl font-display font-black uppercase">Informasi Produk</h2>
                </div>

                <form action="<?php echo site_url('Admin/update_product_action') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        
                        <!-- IMAGE UPLOAD -->
                        <div class="lg:col-span-4 flex flex-col">
                            <label class="font-display font-bold uppercase text-sm mb-2 block">
                                Foto Produk
                            </label>
                            
                            <div class="upload-zone flex-grow cursor-pointer flex flex-col items-center justify-center p-4 text-center min-h-[300px] lg:h-full group relative overflow-hidden" 
                                 onclick="document.getElementById('product_image').click()"> 
                                <input type="file" id="product_image" name="picture" class="hidden" accept="image/*" onchange="previewImage(this)">
                                
                                <div id="uploadPlaceholder" class="<?php echo !empty($product['picture']) ? 'hidden' : ''; ?> flex flex-col items-center justify-center transition-all duration-300 group-hover:scale-105 z-10 relative">
                                    <div class="w-20 h-20 bg-white border-3 border-black flex items-center justify-center mb-4 shadow-[4px_4px_0px_0px_black]">
                                        <i class="fa-solid fa-camera text-3xl text-black"></i>
                                    </div>
                                    <h3 class="text-lg font-bold font-display uppercase tracking-tight mb-1">Upload Foto</h3>
                                    <p class="text-xs text-gray-500 font-mono font-bold">JPG, PNG, WEBP</p>
                                </div>

                                <img id="imgPreview" 
                                     src="<?php echo !empty($product['picture']) ? base_url('public/uploads/' . $product['picture']) . '?v=' . time() : ''; ?>" 
                                     class="<?php echo empty($product['picture']) ? 'hidden' : ''; ?> w-full h-full object-contain absolute inset-0 p-4 z-0 bg-white" 
                                     alt="Preview">

                                <div id="hoverOverlay" class="<?php echo empty($product['picture']) ? 'hidden' : ''; ?> absolute inset-0 bg-black/20 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 pointer-events-none">
                                     <div class="bg-brutal-yellow border-3 border-black px-4 py-2 shadow-[4px_4px_0px_0px_#000]">
                                         <span class="font-bold text-black text-xs font-display uppercase">Ganti Foto</span>
                                     </div>
                                 </div>
                            </div>
                        </div>

                        <!-- INPUT FIELDS -->
                        <div class="lg:col-span-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="font-display font-bold uppercase text-sm mb-2 block">Nama Produk</label>
                                    <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" class="nb-input" placeholder="Misal: Sepatu Sneakers" autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="brand" class="font-display font-bold uppercase text-sm mb-2 block">Brand</label>
                                    <input type="text" id="brand" name="brand" value="<?php echo $product['brand']; ?>" class="nb-input" placeholder="Misal: Ventela" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price" class="font-display font-bold uppercase text-sm mb-2 block">Harga (Rp)</label>
                                    <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" class="nb-input" placeholder="125000" min="0" required>
                                </div>
                                <div>
                                    <label for="stock" class="font-display font-bold uppercase text-sm mb-2 block">Stok Total</label>
                                    <div class="relative">
                                        <input type="number" id="stock" name="stock" value="<?php echo $product['stock']; ?>" class="nb-input" placeholder="10" min="1" required>
                                        <div class="absolute right-0 top-0 h-full px-3 flex items-center bg-black text-white font-bold text-xs pointer-events-none">
                                            UNIT
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="category" class="font-display font-bold uppercase text-sm mb-2 block">Kategori</label>
                                <div class="relative">
                                    <select id="category" name="category" class="nb-input appearance-none cursor-pointer" required>
                                        <option value="" disabled <?php echo empty($product['category_id']) ? 'selected' : ''; ?>>Pilih Kategori...</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id'] ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                                                <?php echo $category['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-black">
                                        <i class="fa-solid fa-caret-down text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="font-display font-bold uppercase text-sm mb-2 block">Deskripsi</label>
                                <textarea id="description" name="description" rows="5" class="nb-input resize-none leading-relaxed" placeholder="Deskripsi lengkap produk..."><?php echo $product['description']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t-4 border-black flex flex-col-reverse md:flex-row justify-end gap-4">
                        <button type="button" onclick="window.location.href = '<?= base_url('admin/products'); ?>';" class="px-6 py-3 font-bold uppercase border-3 border-black bg-white hover:bg-gray-100 transition-all shadow-[4px_4px_0px_0px_black] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_black]">
                            Batal
                        </button>
                        <button type="submit" name="submit" class="px-6 py-3 font-bold uppercase border-3 border-black bg-brutal-yellow hover:bg-yellow-300 transition-all shadow-[4px_4px_0px_0px_black] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_black]">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
            <!-- PRODUCT FORM END -->

            <!-- SIZE VARIANTS START -->
            <div class="border-3 border-black nb-shadow bg-white overflow-hidden">
                <div class="px-6 py-5 border-b-3 border-black bg-brutal-gray flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                         <div class="w-10 h-10 bg-black text-white flex items-center justify-center text-xl shadow-[2px_2px_0px_0px_black]">
                             <i class="fa-solid fa-ruler-combined"></i>
                         </div>
                        <div>
                            <h2 class="text-xl font-display font-black uppercase">Varian Ukuran</h2>
                            <p class="text-xs font-bold text-gray-500 font-mono">KELOLA UKURAN PRODUK</p>
                        </div>
                    </div>
                    <button type="button" id="add-size-button" class="px-5 py-2 text-sm font-bold uppercase border-3 border-black bg-brutal-orange text-white hover:bg-orange-600 transition-all shadow-[4px_4px_0px_0px_black] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_black]">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Ukuran
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="nb-table-head font-display">
                            <tr>
                                <th class="px-6 py-4 border-b-3 border-black">ID</th>
                                <th class="px-6 py-4 border-b-3 border-black">Ukuran</th>
                                <th class="px-6 py-4 border-b-3 border-black">Dibuat Pada</th>
                                <th class="px-6 py-4 border-b-3 border-black text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-gray-100 bg-white">
                            <?php if(empty($products_sizes)): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 font-bold bg-gray-50">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-solid fa-box-open text-4xl mb-3 text-gray-400"></i>
                                            BELUM ADA VARIAN UKURAN
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products_sizes as $product_size) : ?>
                                <tr class="hover:bg-yellow-50 transition-colors">
                                    <td class="px-6 py-4 font-mono font-bold text-sm">
                                        <span class="bg-gray-200 border border-black px-2 py-1">#<?php echo $product_size['id'] ?></span>
                                    </td>
                                    <td class="px-6 py-4 text-lg font-black font-display"><?php echo $product_size['size_name'] ?></td>
                                    <td class="px-6 py-4 text-sm font-mono font-medium"><?php echo $product_size['created_at'] ?></td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="<?php echo base_url('Size/delete_size/' . $product_size['id']) ?>" 
                                           onclick="return confirmDelete(event, this.href)"
                                           class="inline-flex items-center justify-center w-10 h-10 border-2 border-black bg-white text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-[2px_2px_0px_0px_black] hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]"
                                           title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="bg-gray-50 border-t-3 border-black">
                            <tr>
                                <td colspan="4" class="px-6 py-3 font-bold font-mono text-sm uppercase">
                                    Total Varian: <span class="bg-black text-white px-2 py-0.5 ml-1"><?php echo $count_all_product_sizes?></span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- SIZE VARIANTS END -->

            <!-- ADD SIZE MODAL (INLINE) -->
            <div id="add-size-section" class="hidden transition-all duration-300 ease-in-out">
                <div class="border-3 border-black border-dashed bg-gray-50 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-black text-white flex items-center justify-center font-bold text-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <h2 class="text-xl font-display font-black uppercase">Tambah Ukuran Baru</h2>
                    </div>

                    <form action="<?php echo site_url('Size/add_size/') . $product['id']; ?>" method="post">
                        <div class="flex flex-col md:flex-row gap-4 items-end">
                            <div class="flex-grow w-full">
                                <label for="af-account-size" class="font-display font-bold uppercase text-sm mb-2 block">Pilih Ukuran</label>
                                <div class="relative">
                                    <input list="size-options" id="af-account-size" name="size" class="nb-input appearance-none" placeholder="Isi ukuran (Contoh: 42, XL)" required autocomplete="off">
                                    <datalist id="size-options">
                                        <option value="38">
                                        <option value="39">
                                        <option value="40">
                                        <option value="41">
                                        <option value="42">
                                        <option value="43">
                                        <option value="44">
                                        <option value="45">
                                        <option value="46">
                                        <option value="47">
                                        <option value="S">
                                        <option value="M">
                                        <option value="L">
                                        <option value="XL">
                                    </datalist>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-black">
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-3 w-full md:w-auto">
                                <button type="button" id="add-size-cancel-button" class="w-full md:w-auto px-6 py-3 font-bold uppercase border-3 border-black bg-white hover:bg-gray-200 transition-all">Batal</button>
                                <button type="submit" name="submit" class="w-full md:w-auto px-6 py-3 font-bold uppercase border-3 border-black bg-black text-white hover:bg-gray-800 transition-all shadow-[4px_4px_0px_0px_#888] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_#888]">
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
<style>
    /* Global SweetAlert Styling */
    div:where(.swal2-container) div:where(.swal2-popup) {
        border-radius: 0px !important;
        border: 3px solid #000 !important;
        box-shadow: 8px 8px 0px 0px #000 !important;
        font-family: 'Space Grotesk', sans-serif;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #000 !important;
        border: 2px solid #000 !important;
        border-radius: 0 !important;
        box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.2);
        font-weight: 700;
        text-transform: uppercase;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:hover {
        background-color: #333 !important;
        box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
        background-color: #fff !important;
        color: #000 !important;
        border: 2px solid #000 !important;
        border-radius: 0 !important;
        box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.1);
        font-weight: 700;
        text-transform: uppercase;
    }
</style>

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

    function confirmDelete(e, url) {
        e.preventDefault();
        Swal.fire({
            title: "HAPUS UKURAN?",
            text: "Ukuran ini akan dihapus permanen.",
            icon: "warning",
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
            title: "BERHASIL!",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "MANTAP"
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
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