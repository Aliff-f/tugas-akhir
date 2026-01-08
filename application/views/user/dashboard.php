<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        .neo-border { border: 2px solid #000; }
        .neo-shadow { box-shadow: 5px 5px 0px #000; }
        .neo-hover:hover { transform: translate(-2px, -2px); box-shadow: 7px 7px 0px #000; }
        .neo-btn-shadow { box-shadow: 3px 3px 0px 0px #000; }
        .neo-btn-hover:hover { transform: translate(-1px, -1px); box-shadow: 5px 5px 0px 0px #000; }
        .transition-all { transition: all 0.3s ease; }
        
        /* Class untuk menyembunyikan baris */
        .hidden-row { display: none !important; }
    </style>
</head>
<body class="bg-white min-h-screen text-black">

<section class="w-full lg:pl-[280px] pt-6 pb-12 px-4 md:px-8">
    <div class="w-full max-w-[90rem] mx-auto space-y-8">

        <div class="neo-border bg-black text-white p-8 md:p-10 neo-shadow rounded-lg w-full">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-70">DASHBOARD PENGGUNA</p>
                    <h1 class="text-3xl md:text-5xl font-black mt-2 leading-tight">RIWAYAT PESANAN</h1>
                    <p class="text-base mt-3 opacity-90">Lacak semua transaksi Anda dengan mudah dan transparan.</p>
                </div>
                <div class="text-right">
                    <p class="text-xs uppercase font-bold opacity-60">Tanggal Hari Ini</p>
                    <p class="text-2xl md:text-3xl font-black mt-1"><?= date('d F Y'); ?></p>
                </div>
            </div>
        </div>

        <?php if (!isset($orders)) { $orders = []; } ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
            <div class="neo-border bg-white p-6 neo-shadow transition-all neo-hover rounded-lg flex justify-between items-center h-full">
                <div><p class="text-xs font-bold uppercase tracking-wider text-gray-600">Total Pesanan</p><p class="text-3xl md:text-4xl font-black mt-2" id="stat-total">0</p></div>
                <div class="text-4xl opacity-100 bg-gray-100 w-16 h-16 flex items-center justify-center rounded-full border-2 border-black flex-shrink-0">🛒</div>
            </div>
            <div class="neo-border bg-white p-6 neo-shadow transition-all neo-hover rounded-lg flex justify-between items-center h-full">
                <div><p class="text-xs font-bold uppercase tracking-wider text-gray-600">Menunggu</p><p class="text-3xl md:text-4xl font-black mt-2 text-yellow-600" id="stat-pending">0</p></div>
                <div class="text-4xl opacity-100 bg-yellow-50 w-16 h-16 flex items-center justify-center rounded-full border-2 border-black flex-shrink-0">⏳</div>
            </div>
            <div class="neo-border bg-white p-6 neo-shadow transition-all neo-hover rounded-lg flex justify-between items-center h-full">
                <div><p class="text-xs font-bold uppercase tracking-wider text-gray-600">Selesai</p><p class="text-3xl md:text-4xl font-black mt-2 text-green-600" id="stat-completed">0</p></div>
                <div class="text-4xl opacity-100 bg-green-50 w-16 h-16 flex items-center justify-center rounded-full border-2 border-black flex-shrink-0">✅</div>
            </div>
            <div class="neo-border bg-white p-6 neo-shadow transition-all neo-hover rounded-lg flex justify-between items-center h-full">
                <div><p class="text-xs font-bold uppercase tracking-wider text-gray-600">Total Belanja</p><p class="text-2xl md:text-3xl font-black mt-2 truncate" id="stat-spend">Rp 0</p></div>
                <div class="text-4xl opacity-100 bg-blue-50 w-16 h-16 flex items-center justify-center rounded-full border-2 border-black flex-shrink-0">💰</div>
            </div>
        </div>

        <div class="neo-border bg-white neo-shadow rounded-lg overflow-hidden w-full">
            
            <div class="border-b-2 border-black p-5 md:p-7 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-gray-50">
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="table-search-input" onkeyup="searchTable()" placeholder="Cari pesanan..." class="w-full px-5 py-3.5 text-base font-medium border-2 border-black focus:outline-none focus:bg-yellow-50 transition-all rounded-md shadow-[3px_3px_0_0_#000]">
                </div>
                <p class="text-base font-bold uppercase">Total <span class="text-xl px-2 bg-black text-white rounded mx-1" id="table-count">0</span> Pesanan</p>
            </div>

            <div class="w-full">
                <table class="w-full" id="orders-table">
                    <thead class="bg-black text-white hidden md:table-header-group">
                        <tr>
                            <th class="px-6 py-5 text-left text-sm font-bold uppercase">Produk</th>
                            <th class="px-6 py-5 text-left text-sm font-bold uppercase">Detail</th>
                            <th class="px-6 py-5 text-left text-sm font-bold uppercase">Harga</th>
                            <th class="px-6 py-5 text-center text-sm font-bold uppercase">Status</th>
                            <th class="px-6 py-5 text-center text-sm font-bold uppercase">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody class="md:divide-y-2 md:divide-black block md:table-row-group p-4 md:p-0">
                        <?php if (empty($orders)): ?>
                            <tr class="block md:table-row">
                                <td colspan="5" class="py-24 text-center block md:table-cell">
                                    <div class="flex flex-col items-center">
                                        <p class="text-6xl mb-6 grayscale opacity-50">📦</p>
                                        <p class="text-2xl md:text-3xl font-black">Belum Ada Pesanan</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                            <tr class="order-row flex flex-col md:table-row bg-white border-2 border-black md:border-0 hover:bg-gray-50 transition-all mb-6 md:mb-0 rounded-lg md:rounded-none shadow-[4px_4px_0_0_#000] md:shadow-none p-2 md:p-0"
                                data-id="<?= $order['id'] ?>"
                                data-status="<?= $order['status'] ?>"
                                data-price="<?= $order['product_price'] ?>">
                                
                                <td class="block md:table-cell px-4 py-4 md:px-6 md:py-6 searchable-name border-b-2 border-dashed border-gray-300 md:border-none">
                                    <div class="flex items-center gap-4">
                                        <div>
                                            <p class="text-lg font-bold leading-tight"><?= htmlspecialchars($order['product_name']) ?></p>
                                            <?php if(isset($order['product_size'])): ?>
                                            <span class="inline-block mt-2 px-2 py-0.5 text-xs font-bold border border-black bg-white rounded-sm">Size: <?= htmlspecialchars($order['product_size']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <td class="flex justify-between md:table-cell items-center px-4 py-3 md:px-6 md:py-6 searchable-id">
                                    <span class="md:hidden text-xs font-bold uppercase text-gray-500">Info:</span>
                                    <div class="text-right md:text-left">
                                        <p class="text-sm font-bold">#<?= htmlspecialchars(isset($order['order_number']) ? $order['order_number'] : $order['id']) ?></p>
                                        <p class="text-xs text-gray-500 mt-1 font-mono"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                                    </div>
                                </td>

                                <td class="flex justify-between md:table-cell items-center px-4 py-3 md:px-6 md:py-6">
                                    <span class="md:hidden text-xs font-bold uppercase text-gray-500">Total:</span>
                                    <p class="text-lg font-black">Rp <?= number_format($order['product_price'], 0, ',', '.') ?></p>
                                </td>

                                <td class="flex justify-between md:table-cell items-center px-4 py-3 md:px-6 md:py-6 md:text-center">
                                    <span class="md:hidden text-xs font-bold uppercase text-gray-500">Status:</span>
                                    <div>
                                        <?php if ($order['status'] == 'completed'): ?>
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 font-bold text-xs border-2 border-green-800 rounded shadow-[2px_2px_0_0_#166534]">SUKSES</span>
                                        <?php elseif ($order['status'] == 'pending'): ?>
                                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 font-bold text-xs border-2 border-yellow-800 rounded shadow-[2px_2px_0_0_#854d0e]">PENDING</span>
                                        <?php else: ?>
                                            <span class="inline-block px-3 py-1 bg-red-100 text-red-800 font-bold text-xs border-2 border-red-800 rounded shadow-[2px_2px_0_0_#991b1b]">BATAL</span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td class="block md:table-cell px-4 py-4 md:px-6 md:py-6 md:text-center border-t-2 border-dashed border-gray-300 md:border-none">
                                    <div class="flex justify-end md:justify-center">
                                        <?php if ($order['status'] == 'pending'): ?>
                                            <button onclick="openCancelModal('<?= base_url('Users/order_cancel/' . $order['id']); ?>')"
                                               class="w-full md:w-auto text-center inline-block px-4 py-2 bg-red-600 text-white font-bold text-xs border-2 border-black rounded hover:bg-red-700 transition-all neo-btn-shadow neo-btn-hover uppercase cursor-pointer">
                                                Batal Pesanan
                                            </button>
                                        <?php else: ?>
                                            <button onclick="prepareDelete(this)"
                                                class="w-full md:w-auto px-4 py-2 bg-white text-black font-bold text-xs border-2 border-black rounded hover:bg-gray-100 transition-all neo-btn-shadow neo-btn-hover uppercase cursor-pointer flex items-center justify-center gap-2 group">
                                                <i class="fa-solid fa-trash-can text-red-600 group-hover:text-red-700"></i> Hapus
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="p-5 bg-black text-white text-center border-t-2 border-black">
                <p class="text-xs font-bold uppercase tracking-widest">Solenusa Store</p>
            </div>
        </div>
    </div>
</section>

<div id="cancelModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity opacity-0" id="cancelModalBackdrop"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden bg-white text-left shadow-[8px_8px_0_0_#000] border-4 border-black transition-all sm:my-8 sm:w-full sm:max-w-md scale-95 opacity-0" id="cancelModalPanel">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 border-2 border-black sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-xl font-black leading-6 text-black uppercase" id="modal-title">Konfirmasi Pembatalan</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 font-medium">Apakah Anda yakin ingin membatalkan pesanan ini? Status akan berubah menjadi Batal.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t-2 border-black gap-2">
                    <a id="confirmCancelBtn" href="#" class="inline-flex w-full justify-center px-5 py-2.5 bg-red-600 text-white font-bold text-sm border-2 border-black shadow-[2px_2px_0_0_#000] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase sm:w-auto">Ya, Batalkan</a>
                    <button type="button" onclick="closeCancelModal()" class="mt-3 inline-flex w-full justify-center px-5 py-2.5 bg-white text-black font-bold text-sm border-2 border-black shadow-[2px_2px_0_0_#000] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase sm:mt-0 sm:w-auto">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="delete-modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity opacity-0" id="deleteModalBackdrop"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden bg-white text-left shadow-[8px_8px_0_0_#000] border-4 border-black transition-all sm:my-8 sm:w-full sm:max-w-md scale-95 opacity-0" id="deleteModalPanel">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-gray-100 border-2 border-black sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-eye-slash text-black text-lg"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-xl font-black leading-6 text-black uppercase">Sembunyikan Item?</h3>
                            <div class="mt-2"><p class="text-sm text-gray-600 font-medium">Item ini akan disembunyikan secara permanen dari perangkat ini.</p></div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t-2 border-black gap-2">
                    <button type="button" onclick="confirmDeleteUI()" class="inline-flex w-full justify-center px-5 py-2.5 bg-black text-white font-bold text-sm border-2 border-black shadow-[2px_2px_0_0_#888] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase sm:w-auto">Ya, Sembunyikan</button>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 inline-flex w-full justify-center px-5 py-2.5 bg-white text-black font-bold text-sm border-2 border-black shadow-[2px_2px_0_0_#000] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase sm:mt-0 sm:w-auto">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // --- LOAD HIDDEN ITEMS FROM STORAGE ON PAGE LOAD ---
    document.addEventListener("DOMContentLoaded", function() {
        applyHiddenItems();
        updateStatistics();
    });

    // --- FUNGSI UPDATE STATISTIK ---
    function updateStatistics() {
        let total = 0, pending = 0, completed = 0, spend = 0;
        const rows = document.querySelectorAll(".order-row");

        rows.forEach(row => {
            // Hanya hitung baris yang TIDAK disembunyikan
            if (!row.classList.contains("hidden-row")) {
                total++;
                const status = row.getAttribute("data-status");
                const price = parseInt(row.getAttribute("data-price")) || 0;

                if (status === "pending") pending++;
                if (status === "completed") completed++;
                // Spend dihitung jika tidak cancelled
                if (status !== "cancelled") spend += price;
            }
        });

        // Update UI Angka
        document.getElementById("stat-total").innerText = total;
        document.getElementById("stat-pending").innerText = pending;
        document.getElementById("stat-completed").innerText = completed;
        document.getElementById("table-count").innerText = total;
        
        // Format Rupiah Manual
        document.getElementById("stat-spend").innerText = "Rp " + spend.toLocaleString('id-ID');
    }

    // --- SEARCH FUNCTION ---
    function searchTable() {
        const input = document.getElementById("table-search-input").value.toUpperCase();
        const rows = document.querySelectorAll(".order-row"); // Use class selector
        
        rows.forEach(row => {
            // Skip hidden rows from logic
            if (row.classList.contains("hidden-row")) return;

            const nameCell = row.querySelector(".searchable-name");
            const idCell = row.querySelector(".searchable-id");
            if (!nameCell || !idCell) { row.style.display = ""; return; }
            if (nameCell.textContent.toUpperCase().includes(input) || idCell.textContent.toUpperCase().includes(input)) { 
                row.style.display = ""; 
            } else { 
                row.style.display = "none"; 
            }
        });
    }

    // --- LOGIC LOCAL STORAGE ---
    function getHiddenItems() {
        const stored = localStorage.getItem("hiddenOrders");
        return stored ? JSON.parse(stored) : [];
    }

    function saveHiddenItem(id) {
        const items = getHiddenItems();
        if (!items.includes(id)) {
            items.push(id);
            localStorage.setItem("hiddenOrders", JSON.stringify(items));
        }
    }

    function applyHiddenItems() {
        const hiddenIds = getHiddenItems();
        hiddenIds.forEach(id => {
            const row = document.querySelector(`.order-row[data-id="${id}"]`);
            if (row) {
                row.classList.add("hidden-row"); // Sembunyikan lewat CSS
            }
        });
    }

    // --- CANCEL MODAL ---
    function openCancelModal(cancelUrl) {
        const modal = document.getElementById('cancelModal');
        const backdrop = document.getElementById('cancelModalBackdrop');
        const panel = document.getElementById('cancelModalPanel');
        document.getElementById('confirmCancelBtn').setAttribute('href', cancelUrl);
        modal.classList.remove('hidden');
        setTimeout(() => { backdrop.classList.remove('opacity-0'); panel.classList.remove('scale-95', 'opacity-0'); panel.classList.add('scale-100', 'opacity-100'); }, 10);
    }
    function closeCancelModal() {
        const modal = document.getElementById('cancelModal');
        const backdrop = document.getElementById('cancelModalBackdrop');
        const panel = document.getElementById('cancelModalPanel');
        backdrop.classList.add('opacity-0'); panel.classList.remove('scale-100', 'opacity-100'); panel.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    // --- DELETE UI LOGIC ---
    let targetRow = null; 

    function prepareDelete(buttonElement) {
        targetRow = buttonElement.closest('tr');
        openDeleteModal();
    }

    function confirmDeleteUI() {
        if (targetRow) {
            const id = targetRow.getAttribute("data-id"); // Ambil ID Order
            
            // Simpan ke Local Storage agar permanen
            saveHiddenItem(id);

            // Animasi Hapus
            targetRow.style.transition = "all 0.5s ease";
            targetRow.style.opacity = "0";
            targetRow.style.transform = "translateX(50px)";
            
            setTimeout(() => {
                targetRow.classList.add("hidden-row"); // Sembunyikan
                targetRow.style.display = "none"; // Pastikan display none agar tidak makan tempat
                targetRow = null;
                
                // Update Statistik setelah hapus
                updateStatistics();

                const Toast = Swal.mixin({
                    toast: true, position: 'top-end', showConfirmButton: false, timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({ icon: 'success', title: 'Item disembunyikan permanen.' });
            }, 500); 
        }
        closeDeleteModal();
    }

    function openDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const panel = document.getElementById('deleteModalPanel');
        modal.classList.remove('hidden');
        setTimeout(() => { backdrop.classList.remove('opacity-0'); panel.classList.remove('scale-95', 'opacity-0'); panel.classList.add('scale-100', 'opacity-100'); }, 10);
    }
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const panel = document.getElementById('deleteModalPanel');
        backdrop.classList.add('opacity-0'); panel.classList.remove('scale-100', 'opacity-100'); panel.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    // --- GLOBAL CLICK LISTENER ---
    window.onclick = function(event) {
        if (document.getElementById('cancelModal') && !document.getElementById('cancelModal').classList.contains('hidden')) {
            if (!document.getElementById('cancelModalPanel').contains(event.target) && !event.target.closest('button[onclick^="openCancelModal"]')) { closeCancelModal(); }
        }
        if (document.getElementById('deleteModal') && !document.getElementById('deleteModal').classList.contains('hidden')) {
            if (!document.getElementById('deleteModalPanel').contains(event.target) && !event.target.closest('button[onclick^="prepareDelete"]')) { closeDeleteModal(); }
        }
    }
</script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            confirmButtonColor: "#000",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>

</body>
</html>