<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - Neo Brutalism</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #f3f4f6; }
        
        /* --- Utilities Neo-Brutalism Custom --- */
        .nb-box {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 6px 6px 0px #000;
            border-radius: 8px;
        }

        .nb-input {
            width: 100%;
            border: 2px solid #000;
            padding: 10px 15px;
            font-weight: 500;
            outline: none;
            transition: all 0.2s ease;
            box-shadow: 4px 4px 0px #000;
        }

        .nb-input:focus {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px #000;
            background-color: #fffbeb; 
        }

        .nb-btn {
            transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
            font-weight: 700;
            text-transform: uppercase;
        }

        .nb-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000;
        }

        .nb-btn:active {
            transform: translate(0px, 0px);
            box-shadow: 0px 0px 0px #000;
        }

        .nb-badge {
            border: 2px solid #000;
            font-weight: 700;
            font-size: 0.75rem;
            box-shadow: 2px 2px 0px rgba(0,0,0,0.2);
        }

        .tr-hover:hover td {
            background-color: #fffbeb; 
        }
        
        .hidden-row {
            display: none !important;
        }
    </style>
</head>
<body class="text-black">

<section class="w-full lg:ps-80 min-h-screen py-12 px-8 md:px-12 lg:px-16">
    <div class="max-w-[1600px] mx-auto space-y-10">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div>
                <div class="inline-block px-3 py-1 bg-black text-white text-xs font-bold mb-3 transform -rotate-2">ADMIN DASHBOARD</div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-tighter leading-none">
                    Daftar <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF8A00] via-[#FF5C00] to-[#E31E24]" style="-webkit-text-stroke: 1.5px black;">Pesanan</span>
                </h1>
                <p class="text-gray-500 font-bold mt-3 max-w-lg text-sm md:text-base">Kelola transaksi masuk, verifikasi pembayaran, dan perbarui status pengiriman.</p>
            </div>
            
            <div class="nb-box bg-yellow-300 px-8 py-5 flex flex-col items-center justify-center min-w-[200px] transform rotate-1 border-[3px]">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60">Total Order</span>
                <span class="text-5xl font-black mt-1" id="totalOrderCount"><?php echo isset($results) ? $results : count($orders); ?></span>
            </div>
        </div>

        <div class="bg-white border-[3px] border-black p-5 rounded-xl shadow-[8px_8px_0_0_#000] flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="w-full md:w-3/4 relative">
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari ID, Nama Pelanggan, atau Produk..." class="nb-input rounded-lg py-4 text-lg">
                <i class="fa-solid fa-search absolute right-5 top-5 text-gray-400 text-xl"></i>
            </div>
            
            <div class="flex gap-3 bg-gray-100 p-3 border-2 border-black rounded-lg">
                <div class="w-5 h-5 rounded-full bg-red-500 border-2 border-black"></div>
                <div class="w-5 h-5 rounded-full bg-yellow-400 border-2 border-black"></div>
                <div class="w-5 h-5 rounded-full bg-green-500 border-2 border-black"></div>
            </div>
        </div>

        <div class="nb-box overflow-hidden border-[3px] shadow-[12px_12px_0_0_#000]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y-[3px] divide-black" id="ordersTable">
                    <thead class="bg-black text-white">
                        <tr>
                            <th scope="col" class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest">ID & Tgl</th>
                            <th scope="col" class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest">Pelanggan</th>
                            <th scope="col" class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest">Item</th>
                            <th scope="col" class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest">Total</th>
                            <th scope="col" class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest text-center">Status</th>
                            <th scope="col" class="px-8 py-6 text-center text-xs font-black uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-[3px] divide-black bg-white" id="tableBody">
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6" class="px-8 py-24 text-center text-gray-400">
                                    <i class="fa-solid fa-folder-open text-6xl mb-4"></i>
                                    <p class="font-black text-xl">Belum ada data pesanan.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order) { ?>
                                <tr class="tr-hover transition-all duration-200 order-row">
                                    <td class="px-8 py-6 whitespace-nowrap search-target">
                                        <div class="flex flex-col">
                                            <span class="font-black text-2xl">#<?php echo $order['id'] ?></span>
                                            <span class="text-[10px] font-black text-gray-500 bg-gray-100 px-2 py-1 rounded border border-black w-fit mt-2">
                                                <i class="fa-regular fa-calendar mr-1"></i>
                                                <?php echo date('d M Y', strtotime($order['created_at'])); ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-6 whitespace-nowrap search-target">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-lg bg-black text-white flex items-center justify-center font-black text-lg border-2 border-black shadow-[3px_3px_0_0_#ccc]">
                                                <?php echo strtoupper(substr($order['username'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="font-black text-base"><?php echo $order['username'] ?></div>
                                                <div class="text-[10px] text-gray-400 font-black uppercase tracking-tighter">Customer User</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-6 search-target">
                                        <div class="flex items-center gap-4 max-w-[300px]">
                                            <div class="w-16 h-16 flex-shrink-0 bg-gray-100 border-2 border-black rounded-lg overflow-hidden shadow-[3px_3px_0_0_#000]">
                                                <?php if (!empty($order['image_url'])): ?>
                                                    <img src="<?php echo base_url('public/uploads/' . $order['image_url']); ?>" alt="Product" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                        <i class="fa-solid fa-image text-gray-400"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex flex-col min-w-0">
                                                <span class="font-black text-base truncate uppercase tracking-tight"><?php echo $order['product_name'] ?></span>
                                                <div class="mt-2">
                                                    <span class="inline-block px-2 py-1 bg-white border-2 border-black rounded text-[9px] font-black shadow-[2px_2px_0_0_#000]">
                                                        SIZE: <?php echo $order['product_size'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <span class="font-black text-xl">Rp <?php echo number_format($order['product_price'], 0, ',', '.') ?></span>
                                    </td>

                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <?php if ($order['status'] == 'completed') : ?>
                                            <span class="nb-badge inline-flex items-center gap-2 py-2 px-4 rounded-full bg-green-400 text-black border-2 border-black">
                                                <i class="fa-solid fa-check-circle"></i> BERHASIL
                                            </span>
                                        <?php elseif ($order['status'] == 'cancelled') : ?>
                                            <span class="nb-badge inline-flex items-center gap-2 py-2 px-4 rounded-full bg-red-400 text-black border-2 border-black">
                                                <i class="fa-solid fa-circle-xmark"></i> BATAL
                                            </span>
                                        <?php elseif ($order['status'] == 'pending') : ?>
                                            <span class="nb-badge inline-flex items-center gap-2 py-2 px-4 rounded-full bg-yellow-300 text-black border-2 border-black">
                                                <i class="fa-solid fa-clock"></i> PENDING
                                            </span>
                                        <?php else: ?>
                                            <span class="nb-badge inline-flex items-center gap-2 py-2 px-4 rounded-full bg-gray-200 text-black border-2 border-black">
                                                <?php echo strtoupper($order['status']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-8 py-6 whitespace-nowrap text-center">
                                        <button onclick="confirmDeleteOrder('<?= $order['id']; ?>')" 
                                                class="nb-btn w-10 h-10 flex items-center justify-center bg-red-500 text-white rounded-lg mx-auto" 
                                                title="Hapus Pesanan">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            
                            <tr id="noDataRow" class="hidden-row">
                                <td colspan="6" class="px-8 py-16 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-solid fa-magnifying-glass text-5xl mb-4"></i>
                                        <span class="font-black text-xl">DATA TIDAK DITEMUKAN</span>
                                        <span class="text-sm font-bold">Gunakan kata kunci pencarian yang berbeda.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="px-8 py-6 border-t-[3px] border-black bg-gray-50 flex justify-between items-center">
                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">
                    MENAMPILKAN <span id="showingCount" class="text-black"><?php echo isset($results) ? $results : count($orders); ?></span> DATA PESANAN
                </span>
                <div class="flex gap-3">
                    <button class="nb-btn px-6 py-2 bg-white text-[10px] rounded-lg opacity-50 cursor-not-allowed">PREV</button>
                    <button class="nb-btn px-6 py-2 bg-black text-white text-[10px] rounded-lg">NEXT PAGE</button>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function filterTable() {
        let input = document.getElementById("searchInput");
        let filter = input.value.toUpperCase();
        let table = document.getElementById("ordersTable");
        let tr = table.getElementsByClassName("order-row");
        let noDataRow = document.getElementById("noDataRow");
        let visibleCount = 0;
        let hasVisibleRows = false;

        for (let i = 0; i < tr.length; i++) {
            let searchCols = tr[i].getElementsByClassName("search-target");
            let rowMatch = false;

            for (let j = 0; j < searchCols.length; j++) {
                if (searchCols[j]) {
                    let txtValue = searchCols[j].textContent || searchCols[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        rowMatch = true;
                        break;
                    }
                }
            }

            if (rowMatch) {
                tr[i].classList.remove("hidden-row");
                visibleCount++;
                hasVisibleRows = true;
            } else {
                tr[i].classList.add("hidden-row");
            }
        }

        if (!hasVisibleRows && tr.length > 0) {
            noDataRow.classList.remove("hidden-row");
        } else if (noDataRow) {
            noDataRow.classList.add("hidden-row");
        }
        document.getElementById("showingCount").innerText = visibleCount;
    }

    function confirmDeleteOrder(id) {
        Swal.fire({
            title: 'HAPUS PESANAN?',
            html: '<i class="fa-solid fa-trash-can text-6xl text-red-500 mb-4 block"></i>' +
                  '<p class="font-bold">Pesanan #' + id + ' akan dihapus permanen dari data.</p>',
            showCancelButton: true,
            confirmButtonColor: '#000',
            cancelButtonColor: '#fff',
            confirmButtonText: 'YA, HAPUS!',
            cancelButtonText: 'BATAL',
            customClass: {
                popup: 'border-[4px] border-black shadow-[10px_10px_0_0_#000] rounded-2xl',
                title: 'font-black uppercase tracking-tighter text-2xl',
                confirmButton: 'border-2 border-black bg-black text-white shadow-[4px_4px_0_0_#333] font-black px-8 py-3 rounded-lg hover:shadow-none transition-all mr-2',
                cancelButton: 'border-2 border-black bg-white text-black shadow-[4px_4px_0_0_#ccc] font-black px-8 py-3 rounded-lg hover:shadow-none transition-all'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('Admin/delete_order/'); ?>' + id;
            }
        });
    }
</script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: "BERHASIL!",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "MANTAP!",
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
            title: "GAGAL!",
            html: "<div class='font-bold'><?= $this->session->flashdata('error'); ?></div>",
            icon: "error",
            confirmButtonText: "CEK LAGI",
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