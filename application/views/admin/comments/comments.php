<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ulasan - Neo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #f3f4f6; }
        
        /* --- Neo-Brutalism Utilities --- */
        .nb-card {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px #000;
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
                    FEEDBACK SYSTEM
                </div>
                <h1 class="text-5xl font-black uppercase tracking-tight leading-none">
                    Ulasan Pelanggan
                </h1>
                <p class="text-gray-600 font-medium mt-2">Kelola testimoni, rating, dan masukan pengguna.</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full relative">
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari Nama User, Produk, atau Isi Komentar..." 
                       class="nb-input w-full px-5 py-4 rounded-lg font-bold text-lg placeholder:font-medium placeholder:text-gray-400">
                <i class="fa-solid fa-magnifying-glass absolute right-5 top-5 text-xl text-gray-400"></i>
            </div>

            <div class="nb-card px-6 py-2 bg-yellow-300 flex items-center justify-center gap-3 min-w-[200px] transform rotate-1">
                <div class="bg-black text-white w-10 h-10 flex items-center justify-center rounded-full border-2 border-white">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div>
                    <span class="block text-xs font-bold uppercase tracking-wider">Total Ulasan</span>
                    <span class="block text-2xl font-black leading-none" id="totalCount"><?php echo isset($count_all_comment) ? $count_all_comment : count($comments); ?></span>
                </div>
            </div>
        </div>

        <div class="nb-card overflow-hidden bg-white">
            <div class="overflow-x-auto custom-scroll pb-4">
                <table class="min-w-full divide-y-2 divide-black" id="commentTable">
                    <thead class="bg-black text-white">
                        <tr>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider w-16">ID</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Produk & User</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Rating</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider w-1/3">Komentar</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-black uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-5 text-center text-xs font-black uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black bg-white">
                        <?php foreach ($comments as $comment) { ?>
                        <tr class="hover:bg-blue-50 transition-colors duration-150 group comment-row">
                            
                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <span class="font-black font-mono text-gray-700">#<?= $comment['id'] ?></span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap search-target align-top">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 border-2 border-black overflow-hidden shadow-[2px_2px_0_0_#000] flex-shrink-0">
                                            <?php if (!empty($comment['image_url'])): ?>
                                                <img src="<?php echo base_url('public/uploads/' . $comment['image_url']); ?>" alt="Product" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                    <i class="fa-solid fa-box text-xs text-gray-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <span class="font-bold text-sm truncate max-w-[150px]" title="<?= $comment['product_name'] ?>">
                                            <?= $comment['product_name'] ?>
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-black text-white border border-gray-500 flex items-center justify-center text-xs font-bold">
                                            <?= strtoupper(substr($comment['user_name'], 0, 1)) ?>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600">
                                            <?= $comment['user_name'] ?>
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <div class="flex items-center text-yellow-400 text-sm drop-shadow-[1px_1px_0_rgba(0,0,0,1)]">
                                    <?php 
                                    $rating = intval($comment['rating']);
                                    for($i=1; $i<=5; $i++): 
                                        if($i <= $rating): ?>
                                            <i class="fa-solid fa-star"></i>
                                        <?php else: ?>
                                            <i class="fa-regular fa-star text-gray-300 drop-shadow-none"></i>
                                        <?php endif; 
                                    endfor; ?>
                                    <span class="ml-2 text-black font-bold text-xs bg-yellow-200 px-1.5 py-0.5 rounded border border-black">
                                        <?= $comment['rating'] ?>.0
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 search-target align-top">
                                <div class="relative bg-gray-100 border-2 border-black p-3 rounded-tr-xl rounded-bl-xl rounded-br-xl shadow-[3px_3px_0_0_rgba(0,0,0,0.1)]">
                                    <p class="text-sm text-gray-800 italic leading-snug">
                                        "<?= $comment['comment'] ?>"
                                    </p>
                                    <div class="absolute top-0 -left-2 w-0 h-0 border-t-[10px] border-t-black border-l-[10px] border-l-transparent"></div>
                                    <div class="absolute top-[2px] -left-[5px] w-0 h-0 border-t-[8px] border-t-gray-100 border-l-[8px] border-l-transparent"></div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <span class="text-xs font-mono font-bold text-gray-500 bg-white border border-gray-300 px-2 py-1 rounded">
                                    <i class="fa-regular fa-calendar mr-1"></i>
                                    <?= date('d M Y', strtotime($comment['created_at'])) ?>
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center align-top">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="confirmDelete('<?= base_url('Admin/delete_comment/' . $comment['id']); ?>')" 
                                            class="nb-icon-btn w-9 h-9 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600"
                                            title="Hapus Ulasan">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                        <tr id="noDataRow" class="hidden">
                            <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="fa-regular fa-comments text-5xl"></i>
                                    <span class="font-black text-xl text-black">BELUM ADA ULASAN</span>
                                    <span class="text-sm">Data tidak ditemukan untuk pencarian ini.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t-2 border-black flex justify-between items-center">
                <span class="text-sm font-bold text-gray-500">
                    Menampilkan <span id="showingCount" class="text-black font-black"><?php echo isset($count_all_comment) ? $count_all_comment : count($comments); ?></span> Ulasan
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
        const table = document.getElementById("commentTable");
        const tr = table.getElementsByClassName("comment-row");
        const noDataRow = document.getElementById("noDataRow");
        let visibleCount = 0;

        for (let i = 0; i < tr.length; i++) {
            const searchCols = tr[i].getElementsByClassName("search-target");
            let rowMatch = false;

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
    function confirmDelete(url) {
        Swal.fire({
            title: 'HAPUS ULASAN?',
            html: `Yakin ingin menghapus ulasan ini secara permanen?`,
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
            confirmButtonText: 'MANTAP!',
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