<?php
    $productDate = $product['created_at']; 
    $sevenDaysAgo = strtotime('-7 days'); 
    $productTimestamp = strtotime($productDate); 
    $isNewRelease = $productTimestamp >= $sevenDaysAgo;
    ?>

    <section class="mt-32 md:mt-40 container max-w-7xl mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">
            
            <div class="relative w-full group">
                <div class="absolute inset-0 bg-brutal-black translate-x-3 translate-y-3"></div>
                <div class="relative bg-white border-4 border-brutal-black p-4 z-10 transition-transform duration-300 group-hover:-translate-y-1 group-hover:-translate-x-1">
                    <img src="<?= base_url("public/uploads/" . (isset($product['image_url']) ? $product['image_url'] : 'default-image.png')); ?>"
                        class="block w-full h-auto object-cover border-2 border-brutal-black grayscale group-hover:grayscale-0 transition-all duration-500" 
                        alt="product-image" loading="lazy">
                    
                    <?php if ($isNewRelease) { ?>
                        <div class="absolute top-4 left-4 bg-brutal-yellow text-black font-black text-lg px-4 py-1 border-4 border-black transform -rotate-3 uppercase">
                            New Arrival
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <div class="border-b-4 border-brutal-black pb-6">
                    <h1 class="font-sans font-black text-4xl md:text-6xl text-brutal-black uppercase leading-tight">
                        <?= $product['name']; ?>
                    </h1>
                    <div class="mt-4 flex items-center justify-between">
                        <p class="font-mono font-bold text-2xl md:text-3xl text-brutal-orange">
                            Rp <?= number_format($product['price'], 0, ',', '.'); ?>
                        </p>
                        <?php if ($product['stock'] > 0): ?>
                            <span class="font-mono text-sm bg-black text-white px-2 py-1">STOCK: <?= $product['stock']; ?></span>
                        <?php else: ?>
                            <span class="font-mono text-sm bg-red-600 text-white px-2 py-1">OUT OF STOCK</span>
                        <?php endif; ?>
                    </div>
                </div>

                <form method="post" action="<?php echo site_url('keranjang/add/' . $product['id']); ?>" id="add-to-cart-form" class="flex flex-col gap-8">
                    

                    <div>
                        <h4 class="font-mono font-bold text-sm text-gray-500 mb-3 uppercase flex justify-between">
                            <span>Pilih Ukuran</span>
                            <!-- <span>[ REQUIRED ]</span> -->
                        </h4>
                        
                        <input type="hidden" name="size" id="selected-size-input" required>

                        <div class="flex flex-wrap gap-3" id="size-options">
                            <?php foreach ($product_sizes as $product_size) { ?>
                                <?php if (!empty($size_ada)): // Asumsi logika size_ada sudah benar dari controller ?>
                                    <button type="button" 
                                        class="size-option-btn min-w-[60px] h-12 border-4 border-brutal-black font-rubik font-bold text-lg hover:bg-brutal-black hover:text-white transition-all duration-200 uppercase"
                                        data-value="<?php echo $product_size['size']; ?>">
                                        <?php echo $product_size['size_name']; ?>
                                    </button>
                                <?php endif; ?>
                            <?php } ?>
                        </div>
                        <p id="size-error" class="text-red-600 font-bold text-sm mt-2 hidden">* Harap pilih ukuran terlebih dahulu!</p>
                    </div>

                    <div class="bg-gray-100 p-4 border-l-4 border-brutal-black">
                        <h4 class="font-mono font-bold text-sm text-gray-500 mb-2 uppercase">// DESKRIPSI PRODUK</h4> 
                        <p class="font-rubik text-base text-brutal-black leading-relaxed">
                            <?= $product['description']; ?>
                        </p>
                    </div>

                    <?php if ($this->session->userdata('role') !== 'admin'): ?>
                    <div class="mt-4">
                        <h4 class="font-mono font-bold text-sm text-gray-500 mb-3 uppercase flex justify-between">
                            <span>Jumlah</span>
                        </h4>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center border-4 border-brutal-black bg-white">
                                <button type="button" onclick="decrementQty()"
                                    class="w-12 h-12 flex items-center justify-center font-black text-2xl hover:bg-brutal-orange transition-colors border-r-4 border-brutal-black">
                                    -
                                </button>
                                <input type="number" name="quantity" id="quantity-input" value="1" min="1" max="<?= $product['stock']; ?>" readonly
                                    class="w-16 h-12 text-center font-rubik font-bold text-xl focus:outline-none bg-transparent">
                                <button type="button" onclick="incrementQty()"
                                    class="w-12 h-12 flex items-center justify-center font-black text-2xl hover:bg-brutal-yellow transition-colors border-l-4 border-brutal-black">
                                    +
                                </button>
                            </div>
                            <span class="font-mono text-xs text-gray-400 uppercase font-bold">Stok: <?= $product['stock']; ?> tersedia</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <?php if ($this->session->userdata('user_logged_in')): ?>
                            <?php if ($product['stock'] > 0): ?>
                                <button type="submit"
                                    class="w-full bg-brutal-black text-white font-black text-xl py-4 border-4 border-transparent hover:bg-brutal-orange hover:text-white hover:border-black transition-all shadow-[4px_4px_0px_0px_#000000] active:shadow-none active:translate-x-[4px] active:translate-y-[4px] uppercase tracking-wider">
                                    MASUKKAN KE KERANJANG
                                </button>
                            <?php else: ?>
                                <button type="button" disabled
                                    class="w-full bg-gray-400 text-white font-black text-xl py-4 border-4 border-transparent cursor-not-allowed uppercase tracking-wider">
                                    STOK HABIS
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <button type="button"
                                class="w-full bg-brutal-black text-white font-black text-xl py-4 border-4 border-transparent hover:bg-brutal-orange hover:text-white hover:border-black transition-all shadow-[4px_4px_0px_0px_#000000] uppercase tracking-wider"
                                onclick="window.location.href = '<?php echo base_url('masuk'); ?>'">
                                MASUKKAN KE KERANJANG
                            </button>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="mt-4 pt-4 border-t-4 border-brutal-black">
                         <div class="bg-gray-100 p-4 border-2 border-black shadow-[4px_4px_0_0_#000]">
                             <p class="text-sm font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-user-shield"></i> Administrator Mode
                             </p>
                             <p class="text-xs text-gray-400 mt-1 italic">Order and Cart functionality is disabled for management accounts.</p>
                         </div>
                    </div>
                    <?php endif; ?>


                </form>
            </div>
        </div>
    </section>
    <section class="container max-w-7xl mx-auto px-4 mb-32">
        <div class="border-t-8 border-brutal-black pt-12">
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-12">
                <div class="flex items-center gap-4">
                    <div class="w-6 h-6 bg-brutal-yellow border-2 border-black"></div>
                    <h3 class="font-sans font-black text-3xl md:text-5xl uppercase">Ulasan Pembeli</h3>
                </div>
                
                <?php if ($this->session->userdata('user_logged_in')): ?>
                    <button type="button" id="button-add-review"
                        class="bg-white text-brutal-black font-bold border-4 border-brutal-black px-8 py-3 hover:bg-brutal-black hover:text-white transition-all shadow-[4px_4px_0px_0px_#000000] uppercase">
                        + Tulis Ulasan
                    </button>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($comments)) { ?>
                    <?php foreach ($comments as $comment) { ?>
                        <div class="bg-white border-4 border-brutal-black p-6 shadow-hard flex flex-col gap-4 relative">
                            <div class="flex items-center gap-4 border-b-2 border-gray-200 pb-4">
                                <div class="w-12 h-12 bg-gray-200 border-2 border-black rounded-full overflow-hidden">
                                    <img src="<?= base_url("public/uploads/default-image.png"); ?>" class="w-full h-full object-cover" alt="User">
                                </div>
                                <div>
                                    <h4 class="font-rubik font-bold text-lg uppercase"><?= isset($comment['user_name']) ? $comment['user_name'] : 'User'; ?></h4>
                                    <div class="flex gap-1">
                                        <?php if (isset($comment['rating'])) {
                                            for ($i = 1; $i <= 5; $i++) { 
                                                if($i <= $comment['rating']) {
                                                    echo '<div class="w-3 h-3 bg-brutal-orange border border-black"></div>';
                                                } else {
                                                    echo '<div class="w-3 h-3 bg-gray-300 border border-gray-400"></div>';
                                                }
                                            }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <p class="font-rubik text-gray-600 italic">"<?= isset($comment['comment']) ? $comment['comment'] : '-'; ?>"</p>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-span-full py-12 text-center border-4 border-dashed border-gray-300">
                        <p class="font-mono text-gray-400 uppercase">Belum ada ulasan data.</p>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section>
    <div id="add-review" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg border-4 border-brutal-black shadow-[12px_12px_0px_0px_#f28500] p-8 relative animate-fade-in">
            
            <div class="flex justify-between items-center mb-6 border-b-4 border-brutal-black pb-4">
                <h3 class="font-sans font-black text-3xl uppercase">Review Produk</h3>
                <button type="button" id="cancel-add-review" class="font-bold text-xl hover:text-red-600">X</button>
            </div>

            <form action="<?php echo site_url('Admin/add_comment_action') ?>" method="post" class="flex flex-col gap-6">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <input type="hidden" name="user_id" value="<?= $this->session->all_userdata()['id'] ?? ''; ?>">

                <div>
                    <label class="font-mono font-bold text-xs text-gray-500 uppercase block mb-2">Komentar Anda</label>
                    <textarea name="comment" rows="4"
                        class="w-full border-4 border-brutal-black p-3 font-rubik text-base focus:outline-none focus:bg-gray-50 transition-colors"
                        placeholder="Tulis pendapat jujur Anda di sini..." required></textarea>
                </div>

                <div>
                    <label class="font-mono font-bold text-xs text-gray-500 uppercase block mb-2">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5"
                        class="w-full border-4 border-brutal-black p-3 font-rubik text-base focus:outline-none focus:bg-gray-50"
                        placeholder="5" required>
                </div>

                <div class="flex gap-4 mt-4">
                    <button type="submit"
                        class="flex-1 bg-brutal-black text-white font-bold py-3 uppercase border-2 border-transparent hover:bg-brutal-orange hover:text-black hover:border-black transition-colors">
                        Kirim Ulasan
                    </button>
                    <button type="button" id="cancel-btn-2"
                        class="flex-1 bg-white text-black font-bold py-3 uppercase border-2 border-black hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // --- Size Selection Logic ---
        const sizeButtons = document.querySelectorAll('.size-option-btn');
        const sizeInput = document.getElementById('selected-size-input');
        const sizeError = document.getElementById('size-error');

        sizeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Reset all buttons style
                sizeButtons.forEach(b => {
                    b.classList.remove('bg-brutal-black', 'text-white');
                    b.classList.add('bg-white', 'text-brutal-black');
                });

                // Set active style
                this.classList.remove('bg-white', 'text-brutal-black');
                this.classList.add('bg-brutal-black', 'text-white');

                // Set value
                sizeInput.value = this.getAttribute('data-value');
                sizeError.classList.add('hidden');
            });
        });

        document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
            if (!sizeInput.value) {
                e.preventDefault();
                sizeError.classList.remove('hidden');
                // Shake animation effect could be added here
            }
        });

        // --- Quantity Logic ---
        const qtyInput = document.getElementById('quantity-input');
        const maxStock = parseInt(qtyInput.getAttribute('max'));

        function incrementQty() {
            let currentVal = parseInt(qtyInput.value);
            if (currentVal < maxStock) {
                qtyInput.value = currentVal + 1;
            }
        }

        function decrementQty() {
            let currentVal = parseInt(qtyInput.value);
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        }

        // --- Modal Review Logic ---
        const modal = document.getElementById('add-review');
        const btnOpen = document.getElementById('button-add-review');
        const btnClose = document.getElementById('cancel-add-review');
        const btnClose2 = document.getElementById('cancel-btn-2');

        if(btnOpen) {
            btnOpen.addEventListener('click', () => {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        }

        const closeModal = () => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        if(btnClose) btnClose.addEventListener('click', closeModal);
        if(btnClose2) btnClose2.addEventListener('click', closeModal);
        
        // Close on click outside
        modal.addEventListener('click', (e) => {
            if(e.target === modal) closeModal();
        });
    </script>

    <?php if ($this->session->flashdata('success')): ?>
        <script>
            Swal.fire({
                title: "BERHASIL!",
                text: "<?= $this->session->flashdata('success'); ?>",
                icon: "success",
                confirmButtonColor: "#000000",
                confirmButtonText: "OK, LANJUTKAN"
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <script>
            Swal.fire({
                title: "GAGAL!",
                html: "<?= $this->session->flashdata('error'); ?>",
                icon: "error",
                confirmButtonColor: "#000000",
                confirmButtonText: "COBA LAGI"
            });
        </script>
    <?php endif; ?>