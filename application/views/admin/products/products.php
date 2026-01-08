<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Neo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #f3f4f6; }
        
        /* --- Neo-Brutalism Custom Utilities --- */
        .nb-card {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 6px 6px 0px #000;
            border-radius: 12px;
        }

        .nb-btn {
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
            transition: all 0.2s;
            text-transform: uppercase;
            font-weight: 700;
        }
        .nb-btn:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px #000; }
        .nb-btn:active { transform: translate(0, 0); box-shadow: 0 0 0 #000; }

        /* Icon Button Variant */
        .nb-icon-btn {
            border: 2px solid #000;
            box-shadow: 3px 3px 0px #000;
            transition: all 0.1s;
        }
        .nb-icon-btn:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0px #000; }
        .nb-icon-btn:active { transform: translate(0, 0); box-shadow: 0 0 0 #000; }

        .nb-input {
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
            outline: none;
            transition: 0.2s;
        }
        .nb-input:focus { background-color: #fffbeb; box-shadow: 2px 2px 0px #000; transform: translate(2px, 2px); }

        .nb-badge {
            border: 2px solid #000;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            box-shadow: 2px 2px 0px rgba(0,0,0,0.1);
        }

        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar { height: 10px; }
        .custom-scroll::-webkit-scrollbar-track { background: #eee; border-top: 2px solid #000; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #000; border-radius: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #444; }
    </style>
</head>
<body class="text-black">

<section class="w-full lg:ps-64 min-h-screen py-10 px-4 md:px-8">
    <div class="max-w-[95rem] mx-auto space-y-8">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div>
                <div class="inline-block px-3 py-1 bg-black text-white text-xs font-bold mb-2 transform -rotate-1 shadow-md">
                    INVENTORY SYSTEM
                </div>
                <h1 class="text-5xl font-black uppercase tracking-tight leading-none">
                    Data Produk
                </h1>
                <p class="text-gray-600 font-medium mt-2">Kelola katalog, stok, dan harga produk.</p>
            </div>
            
            <a href="<?= site_url('admin/add_product'); ?>" 
                class="nb-btn bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                TAMBAH PRODUK
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full relative">
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari Nama Produk atau Brand..." 
                        class="nb-input w-full px-5 py-4 rounded-lg font-bold text-lg placeholder:font-medium placeholder:text-gray-400">
                <i class="fa-solid fa-magnifying-glass absolute right-5 top-5 text-xl text-gray-400"></i>
            </div>

            <div class="nb-card px-6 py-2 bg-yellow-300 flex items-center justify-center gap-3 min-w-[220px] transform rotate-1">
                <div class="bg-black text-white w-10 h-10 flex items-center justify-center rounded-full border-2 border-white">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div>
                    <span class="block text-xs font-bold uppercase tracking-wider">Total Items</span>
                    <span class="block text-2xl font-black leading-none" id="totalCount"><?php echo isset($count_all_products) ? $count_all_products : count($products); ?></span>
                </div>
            </div>
        </div>

        <div class="nb-card overflow-hidden bg-white">
            <div class="overflow-x-auto custom-scroll pb-4">
                <table class="min-w-full divide-y-2 divide-black" id="productTable">
                    <thead class="bg-black text-white">
                        <tr>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Info Produk</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Brand</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Harga</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Stok</th>
                            <th scope="col" class="px-6 py-5 text-center text-xs font-black uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black bg-white">
                        <?php foreach ($products as $product) { ?>
                        <tr class="hover:bg-blue-50 transition-colors duration-150 group product-row">
                            
                            <td class="px-6 py-4 whitespace-nowrap search-target">
                                <div class="flex items-start gap-4">
                                    <div class="relative shrink-0">
                                        <img class="w-16 h-16 object-cover rounded-md border-2 border-black shadow-[3px_3px_0_0_#000]"
                                             src="<?= base_url('public/uploads/' . $product['image_url']); ?>" 
                                             alt="Img"
                                             onerror="this.src='https://placehold.co/100x100?text=No+Image'">
                                        <span class="absolute -top-2 -left-2 bg-black text-white text-[10px] font-bold px-1.5 py-0.5 rounded border border-white">
                                            ID: <?= $product['id'] ?>
                                        </span>
                                    </div>
                                    <div class="flex flex-col max-w-[200px]">
                                        <span class="font-black text-base truncate" title="<?= $product['name'] ?>"><?= $product['name'] ?></span>
                                        <span class="text-xs text-gray-500 line-clamp-2 mt-1 leading-tight"><?= $product['description'] ?></span>
                                        <span class="text-[10px] font-mono text-gray-400 mt-1">Added: <?= date('d M Y', strtotime($product['created_at'])) ?></span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap search-target">
                                <span class="nb-badge bg-white text-black px-2 py-1 rounded">
                                    <i class="fa-solid fa-copyright mr-1"></i> <?= $product['brand'] ?>
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-black text-lg text-gray-900 bg-green-100 px-2 py-1 border-2 border-transparent group-hover:border-black transition-all rounded">
                                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                    $stockBg = 'bg-green-300';
                                    if($product['stock'] < 10) { $stockBg = 'bg-red-300'; }
                                    elseif($product['stock'] < 50) { $stockBg = 'bg-yellow-300'; }
                                ?>
                                <div class="flex items-center gap-2">
                                    <span class="<?= $stockBg ?> w-8 h-8 flex items-center justify-center rounded-full border-2 border-black font-bold text-xs shadow-sm">
                                        <?= $product['stock'] ?>
                                    </span>
                                    <span class="text-xs font-bold uppercase hidden lg:block">Unit</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?= site_url('Admin/update_product/' . $product['id']); ?>" 
                                        class="nb-icon-btn w-10 h-10 flex items-center justify-center bg-yellow-400 text-black rounded hover:bg-yellow-500"
                                        title="Edit Produk">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    
                                    <button onclick="confirmDelete('<?= site_url('Admin/delete_product/' . $product['id']); ?>', '<?= $product['name'] ?>')" 
                                            class="nb-icon-btn w-10 h-10 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600"
                                            title="Hapus Produk">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <tr id="noDataRow" class="hidden">
                            <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="fa-solid fa-box-open text-5xl"></i>
                                    <span class="font-black text-xl text-black">PRODUK TIDAK DITEMUKAN</span>
                                    <span class="text-sm">Coba kata kunci lain atau tambah produk baru.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t-2 border-black flex justify-between items-center">
                <span class="text-sm font-bold text-gray-500">
                    Menampilkan <span id="showingCount" class="text-black font-black"><?php echo isset($count_all_products) ? $count_all_products : count($products); ?></span> Produk
                </span>
                <div class="flex gap-2">
                    <button class="px-4 py-1.5 border-2 border-black bg-white text-xs font-bold rounded shadow-[2px_2px_0_0_#000] disabled:opacity-50" disabled>PREV</button>
                    <button class="px-4 py-1.5 border-2 border-black bg-black text-white text-xs font-bold rounded shadow-[2px_2px_0_0_#999]">NEXT</button>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // --- 1. SEARCH FUNCTION ---
    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("productTable");
        const tr = table.getElementsByClassName("product-row");
        const noDataRow = document.getElementById("noDataRow");
        let visibleCount = 0;

        for (let i = 0; i < tr.length; i++) {
            const searchCols = tr[i].getElementsByClassName("search-target");
            let rowMatch = false;

            // Memeriksa kolom "Info Produk" (nama, deskripsi) dan "Brand"
            for (let j = 0; j < searchCols.length; j++) {
                if (searchCols[j].textContent.toUpperCase().indexOf(filter) > -1) {
                    rowMatch = true;
                    break;
                }
            }

            if (rowMatch) {
                tr[i].style.display = "";
                visibleCount++;
            } else {
                tr[i].style.display = "none";
            }
        }

        if (visibleCount === 0) {
            noDataRow.classList.remove("hidden");
        } else {
            noDataRow.classList.add("hidden");
        }
        
        document.getElementById("showingCount").innerText = visibleCount;
    }

    // --- 2. DELETE CONFIRMATION ---
    function confirmDelete(url, productName) {
        Swal.fire({
            title: 'HAPUS PRODUK?',
            html: `Yakin ingin menghapus <b>${productName}</b>?<br>Stok dan data terkait akan hilang permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS!',
            cancelButtonText: 'BATAL',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#000',
            background: '#fff',
            customClass: {
                popup: 'border-4 border-black shadow-[8px_8px_0_0_#000] rounded-xl font-sans',
                title: 'font-black uppercase tracking-tight',
                confirmButton: 'border-2 border-black shadow-[4px_4px_0_0_#000] font-bold px-6 py-2 rounded hover:shadow-none transition-all mr-2',
                cancelButton: 'border-2 border-black bg-white text-black shadow-[4px_4px_0_0_#ccc] font-bold px-6 py-2 rounded hover:shadow-none transition-all'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: 'BERHASIL!',
            text: '<?= $this->session->flashdata('success'); ?>',
            icon: 'success',
            confirmButtonText: 'KEREN!',
            customClass: {
                popup: 'border-4 border-black shadow-[8px_8px_0_0_#000] rounded-xl',
                confirmButton: 'border-2 border-black bg-green-400 text-black shadow-[4px_4px_0_0_#000] font-bold px-6 py-2 rounded hover:shadow-none transition-all'
            },
            buttonsStyling: false
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: 'GAGAL!',
            html: "<div class='font-bold text-red-600'><?= $this->session->flashdata('error'); ?></div>",
            icon: 'error',
            confirmButtonText: 'CEK LAGI',
            customClass: {
                popup: 'border-4 border-black shadow-[8px_8px_0_0_#000] rounded-xl',
                confirmButton: 'border-2 border-black bg-red-400 text-black shadow-[4px_4px_0_0_#000] font-bold px-6 py-2 rounded hover:shadow-none transition-all'
            },
            buttonsStyling: false
        });
    </script>
<?php endif; ?>

</body>
</html>