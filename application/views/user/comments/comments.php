<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ulasan | Neo-Brutalism</title>
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
                <div>
                    <div class="inline-block bg-brutal-yellow border-2 border-black px-3 py-1 text-xs font-bold font-display uppercase tracking-widest mb-2 shadow-[2px_2px_0px_0px_black]">
                        User
                    </div>
                    <h1 class="text-4xl md:text-5xl font-display font-black uppercase tracking-tighter leading-none">
                        Kelola Ulasan
                    </h1>
                    <p class="text-gray-600 font-medium mt-2 max-w-md">
                        Tambah, edit, dan hapus ulasan yang telah Anda berikan.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pb-12">
            <div class="border-3 border-black nb-shadow bg-white overflow-hidden">
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="nb-table-head font-display">
                            <tr>
                                <th scope="col" class="px-6 py-5 text-sm font-bold border-b-3 border-black">ID</th>
                                <th scope="col" class="px-6 py-5 text-sm font-bold border-b-3 border-black">Produk</th>
                                <th scope="col" class="px-6 py-5 text-sm font-bold border-b-3 border-black">Pengguna</th>
                                <th scope="col" class="px-6 py-5 text-sm font-bold border-b-3 border-black w-1/3">Rating & Komentar</th>
                                <th scope="col" class="px-6 py-5 text-sm font-bold border-b-3 border-black">Tanggal</th>
                                <th scope="col" class="px-6 py-5 text-end text-sm font-bold border-b-3 border-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-black divide-y-2 divide-gray-100">
                            <?php foreach ($comments as $comment) { ?>
                                <tr class="group hover:bg-yellow-50 transition-colors duration-200">
                                    
                                    <td class="px-6 py-5 whitespace-nowrap border-b border-gray-200">
                                        <span class="font-mono text-xs font-bold bg-gray-200 px-2 py-1 border border-black">
                                            #<?php echo $comment['id'] ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap border-b border-gray-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 flex-shrink-0 bg-white border-2 border-black rounded shadow-[2px_2px_0px_0px_black] overflow-hidden">
                                                <?php if (!empty($comment['image_url'])): ?>
                                                    <img src="<?php echo base_url('public/uploads/' . $comment['image_url']); ?>" alt="Product" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                        <i class="fa-solid fa-box-open text-gray-400"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <span class="block text-sm font-bold font-display uppercase tracking-tight">
                                                <?php echo $comment['product_name'] ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap border-b border-gray-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-brutal-orange border-2 border-black flex items-center justify-center text-xs font-black text-black">
                                                <?= strtoupper(substr($comment['user_name'], 0, 2)); ?>
                                            </div>
                                            <span class="block text-sm font-bold">
                                                <?php echo $comment['user_name'] ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 border-b border-gray-200">
                                        <div class="max-w-xs">
                                            <div class="flex items-center gap-2 mb-2">
                                                <div class="flex gap-0.5 text-black text-xs">
                                                    <?php 
                                                    $rating = isset($comment['rating']) ? (int)$comment['rating'] : 0;
                                                    for($i=1; $i<=5; $i++): 
                                                        if($i <= $rating): ?>
                                                            <i class="fa-solid fa-star"></i>
                                                        <?php else: ?>
                                                            <i class="fa-regular fa-star text-gray-400"></i>
                                                        <?php endif; 
                                                    endfor; ?>
                                                </div>
                                                <span class="text-[10px] font-bold border border-black px-1.5 py-0.5 bg-brutal-yellow">
                                                    <?= $rating ?>.0
                                                </span>
                                            </div>
                                            
                                            <p class="text-sm text-gray-700 leading-snug font-medium italic relative pl-3 border-l-2 border-gray-300">
                                                "<?php echo $comment['comment'] ?>"
                                            </p>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap border-b border-gray-200">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold font-display">
                                                <?php echo date('d M Y', strtotime($comment['created_at'])); ?>
                                            </span>
                                            <span class="text-xs text-gray-500 font-mono">
                                                <?php echo date('H:i', strtotime($comment['created_at'])); ?> WIB
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 whitespace-nowrap text-end border-b border-gray-200">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="<?= base_url('User/update_comment_user/' . $comment['id']); ?>" 
                                               class="w-9 h-9 inline-flex justify-center items-center bg-white border-2 border-black text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-[2px_2px_0px_0px_black] hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]"
                                               title="Edit">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>
                                            
                                            <a href="<?= base_url('User/delete_comment/' . $comment['id']); ?>" 
                                               onclick="confirmDelete(event, this.href)"
                                               class="w-9 h-9 inline-flex justify-center items-center bg-white border-2 border-black text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-[2px_2px_0px_0px_black] hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]"
                                               title="Hapus">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            
                            <?php if(empty($comments)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center bg-gray-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 bg-white border-2 border-black flex items-center justify-center text-3xl mb-4 shadow-[4px_4px_0px_0px_black]">
                                                <i class="fa-solid fa-folder-open text-gray-400"></i>
                                            </div>
                                            <h3 class="text-lg font-bold font-display uppercase">Data Kosong</h3>
                                            <p class="text-sm text-gray-500">Belum ada ulasan yang masuk saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t-3 border-black bg-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm font-bold font-display text-gray-600">
                        TOTAL HASIL: <span class="bg-black text-white px-2 py-0.5 ml-1"><?php echo $count_comments_by_user_id ?? 0 ?></span>
                    </p>
                    
                    <div class="inline-flex gap-x-2">
                        <button type="button" class="px-4 py-2 text-xs font-bold uppercase border-2 border-black bg-white hover:bg-black hover:text-white transition-all shadow-[2px_2px_0px_0px_black] active:translate-y-0.5 active:shadow-none disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Prev
                        </button>
                        <button type="button" class="px-4 py-2 text-xs font-bold uppercase border-2 border-black bg-white hover:bg-black hover:text-white transition-all shadow-[2px_2px_0px_0px_black] active:translate-y-0.5 active:shadow-none disabled:opacity-50 disabled:cursor-not-allowed">
                            Next <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Styling SweetAlert Brutalist */
    div:where(.swal2-container) div:where(.swal2-popup) {
        border-radius: 0px !important;
        border: 3px solid #000 !important;
        box-shadow: 10px 10px 0px 0px #000 !important;
        font-family: 'Space Grotesk', sans-serif;
        padding: 2rem;
    }
    
    div:where(.swal2-container) h2:where(.swal2-title) {
        text-transform: uppercase;
        font-weight: 900;
        font-size: 1.8rem;
    }

    /* Confirm Button */
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #000 !important;
        border: 2px solid #000 !important;
        border-radius: 0px !important;
        color: #fff !important; 
        font-weight: bold;
        text-transform: uppercase;
        box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.2);
        padding: 12px 24px;
        font-size: 1rem;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:hover {
        background-color: #FF5500 !important;
        color: #000 !important;
        box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
        transform: translate(1px, 1px);
    }

    /* Cancel Button */
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
        background-color: #fff !important;
        border: 2px solid #000 !important;
        border-radius: 0px !important;
        color: #000 !important; 
        font-weight: bold;
        text-transform: uppercase;
        box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.1);
        padding: 12px 24px;
        font-size: 1rem;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:hover {
        background-color: #f3f3f3 !important;
        box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
        transform: translate(1px, 1px);
    }

    div:where(.swal2-icon) {
        border-color: #000 !important;
        color: #000 !important;
    }
</style>

<script>
    // FUNGSI KONFIRMASI HAPUS
    function confirmDelete(event, url) {
        event.preventDefault(); // Mencegah link pindah halaman langsung
        
        Swal.fire({
            title: 'HAPUS PERMANEN?',
            text: "Ulasan yang dihapus tidak dapat dikembalikan lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS!',
            cancelButtonText: 'BATAL',
            reverseButtons: true, // Tombol batal di kiri, hapus di kanan
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // Lanjut ke URL penghapusan
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
            confirmButtonText: "OKE",
            width: '400px'
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: "GAGAL!",
            html: "<?= $this->session->flashdata('error'); ?>",
            icon: "error",
            confirmButtonText: "COBA LAGI",
            width: '400px'
        });
    </script>
<?php endif; ?>
</body>
</html>