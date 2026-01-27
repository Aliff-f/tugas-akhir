<?php
// --- LOGIKA AWAL ---
$is_logged_in = $this->session->userdata('user_logged_in');
$role = $this->session->userdata('role');

// Cek apakah user boleh melihat konten (Login = YES, Admin = NO)
$allow_access = ($is_logged_in && $role != 'admin');
?>

<style>
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-brutal {
        animation: slideUpFade 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>

<?php if ($allow_access): ?>
    <?php
        // --- LOGIKA HITUNG HARGA ---
        $subtotal = isset($total_item_price) ? $total_item_price : 0;
        
        // Ongkir Tetap Rp 25.000 (Hanya jika ada barang di keranjang)
        $ongkir = ($subtotal > 0) ? 25000 : 0; 
        
        // Pajak 2.5% dari Subtotal
        $pajak = $subtotal * 0.025; 
        
        // Total Akhir
        $total_bayar = $subtotal + $ongkir + $pajak;
    ?>

    <section class="mt-32 md:mt-40 container max-w-7xl mx-auto px-4 mb-20">
        <div class="border-b-8 border-brutal-black pb-8 mb-12">
            <h1 class="font-sans font-black text-4xl md:text-6xl text-brutal-black uppercase leading-none">
                Keranjang Belanja
            </h1>
            <p class="font-mono font-bold text-gray-500 mt-2 uppercase">
                // PERIKSA KEMBALI PESANAN ANDA SEBELUM CHECKOUT
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 relative">
            
            <div class="w-full lg:w-2/3 flex flex-col gap-8">
                <?php if(!empty($carts)): ?>
                    <?php foreach ($carts as $cart) { ?>
                        <div class="relative group">
                            <div class="absolute inset-0 bg-brutal-black translate-x-2 translate-y-2"></div>
                            
                            <div class="relative bg-white border-4 border-brutal-black p-4 flex flex-col md:flex-row gap-6 transition-transform duration-200 group-hover:-translate-y-1 group-hover:-translate-x-1">
                                
                                <div class="w-full md:w-[180px] h-[180px] flex-shrink-0 border-2 border-brutal-black bg-gray-100 overflow-hidden">
                                    <img src="<?= base_url('public/uploads/' . $cart['product_image']); ?>"
                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" 
                                        alt="product-img" loading="lazy">
                                </div>

                                <div class="flex-grow flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-start">
                                            <h3 class="font-rubik font-black text-xl md:text-2xl text-brutal-black uppercase leading-tight max-w-[80%]">
                                                <?php echo $cart['product_name'] ?>
                                            </h3>
                                            
                                            <button type="button" 
                                                class="btn-delete-trigger text-red-600 hover:text-white hover:bg-red-600 border-2 border-transparent hover:border-black p-1 transition-all"
                                                data-href="<?= site_url('keranjang/delete/' . $cart['id']); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </button>
                                        </div>
                                        
                                        <div class="mt-4 flex items-center gap-4">
                                            <div class="font-mono text-xs text-gray-500 uppercase font-bold">Size: <?php echo $cart['product_size_name'] ?></div>
                                            <form action="<?= site_url('cart/update_quantity/' . $cart['id']); ?>" method="post" class="flex items-center gap-2">
                                                <div class="flex items-center border-2 border-black bg-white">
                                                    <button type="button" onclick="changeCartQty(this, -1)"
                                                        class="w-8 h-8 flex items-center justify-center font-black border-r-2 border-black hover:bg-brutal-orange transition-colors">
                                                        -
                                                    </button>
                                                    <input type="number" name="quantity" value="<?= $cart['quantity']; ?>" min="1" readonly
                                                        class="w-10 h-8 text-center font-rubik font-bold text-sm bg-transparent focus:outline-none">
                                                    <button type="button" onclick="changeCartQty(this, 1)"
                                                        class="w-8 h-8 flex items-center justify-center font-black border-l-2 border-black hover:bg-brutal-yellow transition-colors">
                                                        +
                                                    </button>
                                                </div>
                                                <button type="submit" class="bg-black text-white px-2 py-1 font-mono text-[10px] font-bold uppercase hover:bg-brutal-orange transition-colors border-2 border-black">
                                                    Update
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="mt-4 md:mt-0 flex justify-between items-end">
                                        <div>
                                            <p class="font-mono text-xs text-gray-500 uppercase">Harga Satuan</p>
                                            <p class="font-rubik font-bold text-2xl text-brutal-orange">
                                                Rp <?= number_format($cart['product_price'], 0, ',', '.'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php else: ?>
                    <div class="w-full border-4 border-dashed border-gray-300 p-12 text-center flex flex-col items-center justify-center bg-gray-50 h-[300px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" class="mb-4"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <h3 class="font-black text-2xl text-gray-400 uppercase">Keranjang Kosong</h3>
                        <a href="<?= base_url('produk'); ?>" class="mt-4 font-bold underline hover:text-brutal-orange uppercase">Belanja Sekarang -></a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="sticky top-32">
                    <div class="border-4 border-brutal-black bg-brutal-yellow p-6 shadow-[8px_8px_0px_0px_#000000]">
                        <h3 class="font-sans font-black text-2xl text-brutal-black uppercase mb-6 border-b-4 border-black pb-4">
                            Ringkasan Order
                        </h3>
                        
                        <div class="flex flex-col gap-4 font-mono font-bold text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">TOTAL BARANG</span>
                                <span><?php echo $total_product_at_cart ?> ITEM</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">SUBTOTAL</span>
                                <span><?php echo ($subtotal > 0) ? 'Rp ' . number_format($subtotal, 0, ',', '.') : '-'; ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">ONGKIR (FLAT)</span>
                                <span><?php echo ($ongkir > 0) ? 'Rp ' . number_format($ongkir, 0, ',', '.') : 'FREE'; ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">PAJAK (2.5%)</span>
                                <span><?php echo ($pajak > 0) ? 'Rp ' . number_format($pajak, 0, ',', '.') : '-'; ?></span>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t-4 border-black border-dashed flex justify-between items-end">
                            <span class="font-black font-sans text-xl uppercase">Total Bayar</span>
                            <span class="font-black font-sans text-3xl text-brutal-black">
                                <?php echo ($total_bayar > 0) ? 'Rp ' . number_format($total_bayar, 0, ',', '.') : '-'; ?>
                            </span>
                        </div>

                        <?php if (!$total_product_at_cart == 0) { ?>
                            <button type="button"
                                class="w-full mt-8 bg-brutal-black text-white font-black text-xl py-4 border-2 border-transparent hover:bg-white hover:text-black hover:border-black transition-all uppercase tracking-wider shadow-hard active:shadow-none active:translate-x-[2px] active:translate-y-[2px]"
                                onclick="window.location.href = '<?= base_url('kasir'); ?>'">
                                CHECKOUT SEKARANG >
                            </button>
                        <?php } ?>
                        
                        <p class="font-mono text-xs text-center mt-4 text-gray-600">
                            * Transaksi aman & terenkripsi.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="container max-w-7xl mx-auto px-4 mb-32 border-t-8 border-brutal-black pt-16">
        <div class="flex items-center gap-4 mb-12">
            <div class="w-8 h-8 bg-brutal-orange border-2 border-black"></div>
            <h3 class="font-sans font-black text-3xl md:text-5xl uppercase">Rekomendasi Lain</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($random_product as $key => $item) { ?>
                <div class="group relative flex flex-col h-full cursor-pointer" onclick="window.location.href = '<?php echo base_url('detail_produk/' . $item['id']); ?>'">
                    <div class="absolute inset-0 bg-gray-200 translate-x-2 translate-y-2 group-hover:bg-brutal-orange transition-colors"></div>
                    <div class="relative bg-white border-4 border-brutal-black p-3 h-full transition-transform duration-200 group-hover:-translate-y-1 group-hover:-translate-x-1 flex flex-col">
                        
                        <div class="w-full h-[200px] border-b-4 border-brutal-black mb-4 overflow-hidden bg-gray-100">
                            <img src="<?= base_url('public/uploads/' . $item['image_url']); ?>" 
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" 
                                alt="rec-product" loading="lazy">
                        </div>

                        <h4 class="font-rubik font-bold text-lg uppercase leading-tight line-clamp-2 mb-2">
                            <?php echo $item['name'] ?>
                        </h4>
                        
                        <div class="mt-auto flex justify-between items-center pt-2 border-t-2 border-gray-200">
                            <span class="font-mono font-bold text-brutal-orange">
                                Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                            </span>
                            <span class="w-8 h-8 bg-black text-white flex items-center justify-center font-bold text-xs group-hover:bg-brutal-yellow group-hover:text-black transition-colors">-></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <div id="deleteModal" class="fixed inset-0 z-[60] hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md border-4 border-brutal-black shadow-[12px_12px_0px_0px_#dc2626] p-8 relative animate-brutal flex flex-col items-center text-center">
            
            <div class="w-20 h-20 bg-red-100 border-4 border-black rounded-full flex items-center justify-center mb-6 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
            </div>

            <h3 class="font-sans font-black text-3xl uppercase mb-2">Hapus Barang?</h3>
            <p class="font-mono text-sm text-gray-500 mb-8 max-w-[80%]">
                Tindakan ini tidak dapat dibatalkan. Barang akan hilang dari keranjang.
            </p>

            <div class="flex gap-4 w-full">
                <button type="button" id="cancelDeleteBtn"
                    class="flex-1 bg-white text-black font-bold py-3 uppercase border-4 border-black hover:bg-gray-100 transition-colors">
                    Batal
                </button>
                <a href="#" id="confirmDeleteBtn"
                    class="flex-1 bg-red-600 text-white font-bold py-3 uppercase border-4 border-black hover:bg-red-700 hover:shadow-[4px_4px_0px_0px_#000000] hover:-translate-y-1 hover:-translate-x-1 transition-all flex items-center justify-center">
                    YA, HAPUS
                </a>
            </div>
        </div>
    </div>

<?php else: ?>
    <?php if ($role == 'admin'): ?>
        <div class="fixed inset-0 z-50 bg-brutal-orange flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-lg border-8 border-black shadow-[20px_20px_0px_0px_#000] p-10 text-center animate-brutal relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-yellow-300 rounded-full border-4 border-black z-0"></div>
                
                <div class="relative z-10">
                    <h1 class="font-rubik font-black text-6xl uppercase mb-2 text-brutal-black">OOPS!</h1>
                    <div class="bg-black text-white inline-block px-4 py-1 font-mono font-bold text-sm mb-6 -rotate-2">
                        ADMIN ACCESS RESTRICTED
                    </div>
                    
                    <p class="font-sans text-xl font-bold mb-2">Admin tidak bisa belanja.</p>
                    <p class="font-mono text-gray-500 mb-8">
                        Akun Anda terdaftar sebagai Admin. Silakan kembali ke Dashboard untuk mengelola toko.
                    </p>

                    <a href="<?php echo base_url('admin/dashboard'); ?>" 
                       class="inline-block w-full bg-black text-white font-black text-xl py-4 border-4 border-transparent hover:bg-white hover:text-black hover:border-black transition-all uppercase tracking-wider shadow-[8px_8px_0px_0px_#F58600]">
                        KEMBALI KE DASHBOARD
                    </a>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-lg border-4 border-brutal-orange shadow-[0px_0px_50px_rgba(245,134,0,0.5)] p-10 text-center animate-brutal">
                
                <div class="w-24 h-24 bg-brutal-black text-brutal-orange border-4 border-brutal-orange rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>

                <h1 class="font-rubik font-black text-5xl uppercase mb-4 text-brutal-black leading-none">
                    AKSES <br>DITOLAK
                </h1>
                
                <p class="font-mono text-gray-600 mb-8 font-bold">
                    // SILAKAN LOGIN TERLEBIH DAHULU UNTUK MELIHAT KERANJANG BELANJA ANDA.
                </p>

                <div class="flex flex-col gap-4">
                    <a href="<?php echo base_url('masuk'); ?>" 
                       class="block w-full bg-brutal-orange text-black font-black text-xl py-4 border-4 border-black hover:bg-brutal-yellow hover:shadow-[8px_8px_0px_0px_#000] hover:-translate-y-1 hover:-translate-x-1 transition-all uppercase">
                        LOGIN SEKARANG
                    </a>
                    <a href="<?php echo base_url('home'); ?>" 
                       class="block w-full bg-transparent text-gray-500 font-bold font-mono py-2 hover:text-white transition-colors uppercase text-sm">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<div id="notificationModal" class="fixed inset-0 z-[70] hidden bg-black/80 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md border-4 border-black shadow-[12px_12px_0px_0px_#fff] p-8 relative animate-brutal flex flex-col items-center text-center" id="notifCard">
        
        <div id="notifIcon" class="mb-6"></div>

        <h3 id="notifTitle" class="font-sans font-black text-4xl uppercase mb-2">TITLE</h3>
        
        <p id="notifMessage" class="font-mono text-sm text-gray-600 mb-8 font-bold px-4 border-l-4 border-gray-300">
            Message goes here...
        </p>

        <button type="button" onclick="closeNotification()"
            class="w-full bg-black text-white font-bold py-3 uppercase border-4 border-transparent hover:bg-white hover:text-black hover:border-black transition-all">
            MENGERTI
        </button>
    </div>
</div>

<script>
    function changeCartQty(btn, delta) {
        const input = btn.parentElement.querySelector('input');
        let val = parseInt(input.value) + delta;
        if (val >= 1) {
            input.value = val;
        }
    }

    // --- Logic Delete Modal ---
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        const deleteBtns = document.querySelectorAll('.btn-delete-trigger');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const url = this.getAttribute('data-href');
                confirmDeleteBtn.setAttribute('href', url);
                deleteModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Disable scroll
            });
        });

        const closeDeleteModal = () => {
            deleteModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        if(cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeDeleteModal);
        
        window.addEventListener('click', function(e) {
            if (e.target === deleteModal) closeDeleteModal();
        });
    }

    // --- Logic Notification Modal (Flashdata Replacement) ---
    const notifModal = document.getElementById('notificationModal');
    const notifCard = document.getElementById('notifCard');
    const notifTitle = document.getElementById('notifTitle');
    const notifMessage = document.getElementById('notifMessage');
    const notifIcon = document.getElementById('notifIcon');

    function showBrutalNotification(title, message, type) {
        notifTitle.innerText = title;
        notifMessage.innerHTML = message;
        
        // Reset Style
        notifCard.classList.remove('shadow-[12px_12px_0px_0px_#22c55e]', 'shadow-[12px_12px_0px_0px_#dc2626]');
        
        if (type === 'success') {
            // Style Sukses (Hijau/Hitam)
            notifCard.classList.add('shadow-[12px_12px_0px_0px_#22c55e]'); // Green Shadow
            notifTitle.classList.add('text-green-600');
            notifTitle.classList.remove('text-red-600');
            notifIcon.innerHTML = `
                <div class="w-20 h-20 bg-green-100 border-4 border-black rounded-full flex items-center justify-center text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>`;
        } else {
            // Style Error (Merah/Hitam)
            notifCard.classList.add('shadow-[12px_12px_0px_0px_#dc2626]'); // Red Shadow
            notifTitle.classList.add('text-red-600');
            notifTitle.classList.remove('text-green-600');
            notifIcon.innerHTML = `
                <div class="w-20 h-20 bg-red-100 border-4 border-black rounded-full flex items-center justify-center text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>`;
        }

        notifModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeNotification() {
        notifModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // --- Trigger Notification from PHP Session ---
    <?php if ($this->session->flashdata('success')): ?>
        showBrutalNotification("BERHASIL!", "<?= $this->session->flashdata('success'); ?>", "success");
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        showBrutalNotification("GAGAL!", "<?= $this->session->flashdata('error'); ?>", "error");
    <?php endif; ?>
</script>