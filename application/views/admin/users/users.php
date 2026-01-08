<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Neo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #f0f2f5; }
        
        /* --- Neo-Brutalism Utilities --- */
        .nb-card {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 6px 6px 0px #000;
            border-radius: 12px;
        }

        .nb-btn-primary {
            background-color: #3b82f6; /* Blue */
            color: white;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
            transition: all 0.2s;
        }
        .nb-btn-primary:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px #000; }
        .nb-btn-primary:active { transform: translate(0, 0); box-shadow: 0 0 0 #000; }

        .nb-btn-icon {
            border: 2px solid #000;
            box-shadow: 3px 3px 0px #000;
            transition: all 0.1s;
        }
        .nb-btn-icon:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0px #000; }
        .nb-btn-icon:active { transform: translate(0, 0); box-shadow: 0 0 0 #000; }

        .nb-input {
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
            transition: all 0.2s;
        }
        .nb-input:focus { outline: none; background-color: #fffbeb; transform: translate(1px,1px); box-shadow: 2px 2px 0px #000; }

        .table-head-th {
            background-color: #000;
            color: #fff;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
        }

        /* Scrollbar Style */
        .custom-scroll::-webkit-scrollbar { height: 10px; width: 10px; }
        .custom-scroll::-webkit-scrollbar-track { background: #eee; border: 2px solid #000; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #000; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #444; }
    </style>
</head>
<body class="text-black">

<section class="w-full lg:ps-64 min-h-screen py-8 px-4 md:px-6">
    <div class="max-w-[95rem] mx-auto space-y-6">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <div class="inline-block px-3 py-1 bg-black text-white text-xs font-bold mb-2 transform -rotate-1 shadow-[2px_2px_0_0_rgba(0,0,0,0.3)]">ADMIN PANEL</div>
                <h1 class="text-4xl font-black uppercase tracking-tight">Data Pengguna</h1>
                <p class="text-gray-600 font-medium mt-1">Kelola akun, peran, dan informasi pengguna.</p>
            </div>
            
            <a href="<?= base_url('admin/add_user'); ?>" class="nb-btn-primary px-5 py-3 rounded-lg font-bold flex items-center gap-2">
                <i class="fa-solid fa-user-plus"></i> Tambah Pengguna
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full relative">
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari Nama, Email, atau ID..." class="nb-input w-full px-4 py-3 rounded-lg font-medium">
                <i class="fa-solid fa-magnifying-glass absolute right-4 top-4 text-gray-400"></i>
            </div>
            <div class="nb-card px-6 py-3 bg-yellow-300 flex items-center justify-center min-w-[200px] gap-2 transform rotate-1">
                <i class="fa-solid fa-users text-xl"></i>
                <div>
                    <span class="block text-xs font-bold uppercase">Total User</span>
                    <span class="block text-xl font-black leading-none" id="totalCount"><?php echo isset($total_users) ? $total_users : count($users); ?></span>
                </div>
            </div>
        </div>

        <div class="nb-card overflow-hidden bg-white">
            <div class="overflow-x-auto custom-scroll pb-2">
                <table class="min-w-full divide-y-2 divide-black" id="userTable">
                    <thead>
                        <tr>
                            <th class="table-head-th px-6 py-4 text-left">ID</th>
                            <th class="table-head-th px-6 py-4 text-left">Profil</th>
                            <th class="table-head-th px-6 py-4 text-left">Info Akun</th>
                            <th class="table-head-th px-6 py-4 text-left">Kontak</th>
                            <th class="table-head-th px-6 py-4 text-left">Alamat Utama</th>
                            <th class="table-head-th px-6 py-4 text-left">Detail Alamat</th>
                            <th class="table-head-th px-6 py-4 text-left">Peran</th>
                            <th class="table-head-th px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black bg-white">
                        <?php foreach ($users as $user) { ?>
                        <tr class="hover:bg-blue-50 transition-colors duration-150 group user-row">
                            <td class="px-6 py-4 whitespace-nowrap font-bold font-mono text-gray-700">#<?php echo $user['id'] ?></td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative w-12 h-12">
                                    <img class="w-12 h-12 rounded-full object-cover border-2 border-black shadow-[2px_2px_0_0_#000]" 
                                         src="<?= base_url('public/uploads/users/' . $user['profile_picture']) ?>" 
                                         alt="Avatar"
                                         onerror="this.src='https://ui-avatars.com/api/?name=<?= $user['username'] ?>&background=000&color=fff'">
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap search-target">
                                <div class="flex flex-col">
                                    <span class="font-black text-lg"><?php echo $user['username']; ?></span>
                                    <span class="text-sm font-semibold text-gray-600"><?php echo $user['full_name']; ?></span>
                                    
                                    <span class="mt-1 inline-flex items-center gap-1 w-fit px-2 py-0.5 rounded border border-black text-[10px] font-bold uppercase 
                                        <?php echo ($user['gender'] == 'Laki-laki' || $user['gender'] == 'Male') ? 'bg-blue-200' : 'bg-pink-200'; ?>">
                                        <?php echo $user['gender']; ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap search-target">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2 text-sm font-medium">
                                        <i class="fa-regular fa-envelope w-4"></i> <?php echo $user['email']; ?>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm font-medium">
                                        <i class="fa-solid fa-phone w-4"></i> <?php echo $user['phone']; ?>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold"><?php echo $user['address_city']; ?></div>
                                <div class="text-xs font-medium text-gray-500 uppercase"><?php echo $user['address_province']; ?></div>
                                <div class="text-xs font-mono mt-1 bg-gray-100 px-1 border border-gray-300 w-fit rounded"><?php echo $user['zip_code']; ?></div>
                            </td>

                            <td class="px-6 py-4 min-w-[200px]">
                                <div class="text-xs font-medium text-gray-800 line-clamp-2">
                                    <?php echo $user['street_name']; ?>
                                </div>
                                <div class="text-[10px] text-gray-500 mt-1">
                                    Kec: <?php echo $user['address_district']; ?>, Kel: <?php echo $user['address_subdistrict']; ?>
                                </div>
                                <?php if(!empty($user['address_description'])): ?>
                                    <div class="text-[10px] italic text-gray-400 mt-0.5">Note: <?php echo $user['address_description']; ?></div>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-block px-3 py-1 rounded-md border-2 border-black text-xs font-black uppercase shadow-[2px_2px_0_0_rgba(0,0,0,0.2)]
                                    <?php echo ($user['role'] == 'admin') ? 'bg-purple-300' : 'bg-gray-200'; ?>">
                                    <?php echo $user['role']; ?>
                                </span>
                                <div class="text-[10px] font-mono mt-2 text-gray-500">
                                    Join: <?php echo date('d/m/Y', strtotime($user['created_at'])); ?>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?= base_url('admin/update_user/' . $user['id']); ?>" 
                                       class="nb-btn-icon w-9 h-9 flex items-center justify-center bg-yellow-400 text-black rounded hover:bg-yellow-500"
                                       title="Edit User">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    
                                    <button onclick="confirmDelete('<?= base_url('Admin/delete_user/' . $user['id']) ?>', '<?= $user['username'] ?>')" 
                                            class="nb-btn-icon w-9 h-9 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600"
                                            title="Hapus User">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <tr id="noDataRow" class="hidden">
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-face-dizzy text-4xl mb-3"></i>
                                    <span class="font-bold text-lg">User tidak ditemukan!</span>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t-2 border-black flex justify-between items-center">
                 <span class="text-sm font-bold text-gray-500">Showing all records</span>
                 <div class="flex gap-2">
                     <button class="px-3 py-1 border-2 border-black bg-white text-xs font-bold rounded shadow-[2px_2px_0_0_#000] hover:translate-y-0.5 hover:shadow-none transition-all disabled:opacity-50" disabled>PREV</button>
                     <button class="px-3 py-1 border-2 border-black bg-black text-white text-xs font-bold rounded shadow-[2px_2px_0_0_#999] hover:translate-y-0.5 hover:shadow-none transition-all">NEXT</button>
                 </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // --- SEARCH FUNCTIONALITY ---
    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("userTable");
        const tr = table.getElementsByClassName("user-row");
        const noDataRow = document.getElementById("noDataRow");
        let visibleCount = 0;

        for (let i = 0; i < tr.length; i++) {
            // Search in Username, Fullname, Email columns (Class 'search-target')
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

        // Show/Hide Empty State
        if (visibleCount === 0) {
            noDataRow.classList.remove("hidden");
        } else {
            noDataRow.classList.add("hidden");
        }
        
        // Update Counter
        document.getElementById("totalCount").innerText = visibleCount;
    }

    // --- CUSTOM DELETE CONFIRMATION ---
    function confirmDelete(url, username) {
        Swal.fire({
            title: 'HAPUS USER?',
            html: `Anda yakin ingin menghapus user <b>${username}</b>?<br>Data tidak bisa dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS!',
            cancelButtonText: 'BATAL',
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#000',
            // Custom Styling Neo Brutalism
            customClass: {
                popup: 'border-4 border-black shadow-[8px_8px_0_0_#000] rounded-xl font-sans',
                title: 'font-black uppercase',
                confirmButton: 'border-2 border-black shadow-[4px_4px_0_0_#000] font-bold px-6 py-2 rounded hover:shadow-none transition-all mr-2',
                cancelButton: 'border-2 border-black bg-white text-black shadow-[4px_4px_0_0_#ccc] font-bold px-6 py-2 rounded hover:shadow-none transition-all'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>

<?php if ($this->session->flashdata('success')): ?>
<script>
    Swal.fire({
        title: 'BERHASIL!',
        text: '<?= $this->session->flashdata('success'); ?>',
        icon: 'success',
        confirmButtonText: 'MANTAP',
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
        title: 'ERROR!',
        text: '<?= $this->session->flashdata('error'); ?>',
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