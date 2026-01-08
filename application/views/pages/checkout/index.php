<?php if ($this->session->userdata('user_logged_in')): ?>
    <?php if ($this->session->userdata('role') != 'admin'): ?>
        <?php if (!$total_product_at_cart == 0): ?>
            
            <?php
                // --- LOGIKA HITUNG HARGA ---
                $subtotal = isset($total_item_price) ? $total_item_price : 0;
                $ongkir = ($subtotal > 0) ? 25000 : 0; 
                $pajak = $subtotal * 0.025; 
                $total_bayar = $subtotal + $ongkir + $pajak;
            ?>

            <section class="mt-32 md:mt-40 container max-w-7xl mx-auto px-4 mb-24">
                
                <div class="flex flex-col md:flex-row items-center justify-between border-b-2 border-black pb-6 mb-10 gap-4">
                    <h1 class="font-sans font-bold text-3xl md:text-4xl text-black uppercase tracking-tight">
                        Checkout Pesanan
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-mono text-gray-600 bg-gray-100 px-3 py-1 rounded border border-gray-300">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        SECURE TRANSACTION
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 relative">
                    
                    <div class="w-full lg:w-[60%] order-2 lg:order-1">
                        <form id="checkoutForm" method="post" action="<?php echo site_url('Checkout/checkout_action') ?>" class="flex flex-col gap-10">
                            
                            <div>
                                <h4 class="font-sans font-bold text-xl uppercase mb-6 flex items-center gap-3">
                                    <span class="bg-black text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">1</span>
                                    Informasi Kontak
                                </h4>
                                
                                <div class="grid grid-cols-1 gap-5">
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Nama Lengkap</label>
                                        <input type="text" name="fullname" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all placeholder-gray-400"
                                            placeholder="Nama sesuai KTP" value="<?php echo $user['full_name']; ?>" autocomplete="off" required>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class="flex flex-col gap-2">
                                            <label class="font-mono font-bold text-xs uppercase text-gray-500">Email</label>
                                            <input type="email" name="email" 
                                                class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all placeholder-gray-400"
                                                placeholder="email@anda.com" value="<?php echo $user['email']; ?>" autocomplete="off" required>
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label class="font-mono font-bold text-xs uppercase text-gray-500">No. WhatsApp</label>
                                            <input type="text" name="phone" 
                                                class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all placeholder-gray-400"
                                                placeholder="0812xxxx" value="<?php echo $user['phone']; ?>" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-sans font-bold text-xl uppercase mb-6 flex items-center gap-3">
                                    <span class="bg-black text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">2</span>
                                    Alamat Pengiriman
                                </h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Provinsi</label>
                                        <input type="text" name="province" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="Provinsi" value="<?php echo $user['address_province']; ?>" required>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Kota/Kabupaten</label>
                                        <input type="text" name="city" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="Kota" value="<?php echo $user['address_city']; ?>" required>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Kecamatan</label>
                                        <input type="text" name="district" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="Kecamatan" value="<?php echo $user['address_district']; ?>" required>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Kelurahan</label>
                                        <input type="text" name="subdistrict" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="Kelurahan" value="<?php echo $user['address_subdistrict']; ?>" required>
                                    </div>
                                    <div class="md:col-span-2 flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Alamat Lengkap</label>
                                        <input type="text" name="street" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="Nama Jalan, No. Rumah, RT/RW" value="<?php echo $user['street_name']; ?>" required>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Kode Pos</label>
                                        <input type="text" name="zip_code" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="60111" value="<?php echo $user['zip_code']; ?>" required>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="font-mono font-bold text-xs uppercase text-gray-500">Catatan (Opsional)</label>
                                        <input type="text" name="description" 
                                            class="w-full border-2 border-black rounded-lg p-3 font-rubik text-sm focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all"
                                            placeholder="Pagar warna..." value="<?php echo $user['address_description']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                <label class="flex items-center gap-3 cursor-pointer group select-none mb-3">
                                    <input type="checkbox" id="same-info" class="w-5 h-5 text-black border-2 border-black rounded focus:ring-0">
                                    <span class="font-rubik text-sm text-gray-600">Alamat tagihan sama dengan alamat pengiriman</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input type="checkbox" id="verification" class="w-5 h-5 text-black border-2 border-black rounded focus:ring-0" required>
                                    <span class="font-rubik text-sm text-gray-600">Saya menyetujui Syarat & Ketentuan yang berlaku.</span>
                                </label>
                            </div>

                            <button type="submit" id="btn-mobile" disabled class="lg:hidden w-full bg-black text-white font-bold text-lg py-4 rounded-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)] active:shadow-none active:translate-y-1 transition-all opacity-50 cursor-not-allowed">
                                Bayar Sekarang
                            </button>

                        </form>
                    </div>

                    <div class="w-full lg:w-[40%] order-1 lg:order-2">
                        <div class="sticky top-32">
                            <div class="bg-[#FFD700] border-2 border-black rounded-2xl p-6 shadow-[8px_8px_0px_0px_#000000]">
                                <h3 class="font-sans font-bold text-xl uppercase mb-6 border-b-2 border-black pb-4 text-black">
                                    Ringkasan Pesanan
                                </h3>

                                <div class="flex flex-col gap-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar mb-6">
                                    <?php foreach ($order_details as $order_detail): ?>
                                        <div class="flex gap-4 items-start">
                                            <div class="w-16 h-16 rounded-lg border-2 border-black overflow-hidden flex-shrink-0 bg-white">
                                                <img src="<?= base_url('public/uploads/' . $order_detail['product_image']); ?>"
                                                    class="w-full h-full object-cover mix-blend-multiply" 
                                                    alt="product" loading="lazy">
                                            </div>
                                            <div class="flex-grow">
                                                <h4 class="font-rubik font-bold text-sm text-black leading-tight mb-1">
                                                    <?php echo $order_detail['product_name']; ?>
                                                </h4>
                                                <p class="text-xs text-black font-mono">
                                                    Size: <?php echo $order_detail['product_size_name'] ?> | Qty: 1
                                                </p>
                                                <p class="font-black text-sm text-black mt-1">
                                                    Rp <?php echo number_format($order_detail['product_price'], 0, ',', '.'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="flex flex-col gap-3 py-4 border-t-2 border-dashed border-black">
                                    <div class="flex justify-between text-sm font-mono text-black font-medium">
                                        <span>Subtotal</span>
                                        <span>Rp <?= number_format($subtotal, 0, ',', '.'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-sm font-mono text-black font-medium">
                                        <span>Ongkir (Flat)</span>
                                        <span>Rp <?= number_format($ongkir, 0, ',', '.'); ?></span>
                                    </div>
                                    <div class="flex justify-between text-sm font-mono text-black font-medium">
                                        <span>Pajak (2.5%)</span>
                                        <span>Rp <?= number_format($pajak, 0, ',', '.'); ?></span>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center pt-4 border-t-2 border-black mt-2">
                                    <span class="font-bold text-lg text-black">Total Bayar</span>
                                    <span class="font-black text-2xl text-black">
                                        Rp <?= number_format($total_bayar, 0, ',', '.'); ?>
                                    </span>
                                </div>

                                <button id="btn-desktop" onclick="document.getElementById('checkoutForm').submit();" disabled
                                    class="hidden lg:block w-full mt-8 bg-black text-white font-bold text-lg py-4 rounded-xl border-2 border-transparent transition-all uppercase tracking-wide opacity-50 cursor-not-allowed">
                                    Konfirmasi Pembayaran
                                </button>
                                
                                <div class="mt-4 flex justify-center items-center gap-2 text-black opacity-70">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span class="text-xs font-mono font-bold">Pembayaran Aman & Terenkripsi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkSame = document.getElementById('same-info');
                    const checkVerif = document.getElementById('verification');
                    const btnMobile = document.getElementById('btn-mobile');
                    const btnDesktop = document.getElementById('btn-desktop');

                    function toggleButtons() {
                        // Cek apakah KEDUANYA dicentang
                        const isReady = checkSame.checked && checkVerif.checked;

                        if (isReady) {
                            // Enable Mobile Button
                            btnMobile.disabled = false;
                            btnMobile.classList.remove('opacity-50', 'cursor-not-allowed');
                            
                            // Enable Desktop Button
                            btnDesktop.disabled = false;
                            btnDesktop.classList.remove('opacity-50', 'cursor-not-allowed');
                            btnDesktop.classList.add('hover:bg-white', 'hover:text-black', 'hover:border-black', 'hover:shadow-[4px_4px_0px_0px_#000000]');
                        } else {
                            // Disable Mobile Button
                            btnMobile.disabled = true;
                            btnMobile.classList.add('opacity-50', 'cursor-not-allowed');
                            
                            // Disable Desktop Button
                            btnDesktop.disabled = true;
                            btnDesktop.classList.add('opacity-50', 'cursor-not-allowed');
                            btnDesktop.classList.remove('hover:bg-white', 'hover:text-black', 'hover:border-black', 'hover:shadow-[4px_4px_0px_0px_#000000]');
                        }
                    }

                    // Tambahkan Event Listener
                    checkSame.addEventListener('change', toggleButtons);
                    checkVerif.addEventListener('change', toggleButtons);

                    // Jalankan sekali saat load untuk memastikan status awal benar
                    toggleButtons();
                });
            </script>

        <?php else: ?>
            <script>
                alert("Keranjang belanja kosong.");
                window.location.href = "<?php echo site_url('produk'); ?>";
            </script>
        <?php endif; ?>
    <?php else: ?>
        <script>
            window.location.href = "<?php echo site_url('admin/dashboard'); ?>";
        </script>
    <?php endif; ?>
<?php else: ?>
    <script>
        window.location.href = "<?php echo site_url('masuk'); ?>";
    </script>
<?php endif; ?>