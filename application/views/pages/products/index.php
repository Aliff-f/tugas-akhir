<section class="mt-28 md:mt-36 container max-w-7xl mx-auto px-4 mb-12 md:mb-16">
    <div class="relative w-full group">
        <div class="absolute top-1 md:top-2 left-1 md:left-2 w-full h-full bg-brutal-black border-4 border-brutal-black z-0"></div>
        
        <div class="relative bg-white border-4 border-brutal-black p-2 md:p-3 z-10 transition-transform duration-300 group-hover:-translate-y-1 group-hover:-translate-x-1">
            <div class="relative overflow-hidden border-2 border-brutal-black">
                <div class="absolute inset-0 bg-brutal-yellow/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 pointer-events-none mix-blend-multiply"></div>
                
                <img src="<?= base_url('public/images/products/fotoo.png'); ?>"
                    class="block w-full h-[200px] md:h-[350px] lg:h-[450px] object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                    alt="Product Campaign"
                    loading="lazy">
                
                <div class="absolute top-2 right-2 md:top-4 md:right-4 bg-brutal-orange text-white font-black text-sm md:text-xl px-4 py-1 md:px-6 md:py-2 border-2 md:border-4 border-black shadow-[2px_2px_0px_0px_#000000] md:shadow-[4px_4px_0px_0px_#000000] transform rotate-3 z-30 uppercase">
                    New Drop!
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-6 border-b-4 border-brutal-black pb-8">
        
        <button class="lg:hidden w-full flex items-center justify-between bg-brutal-black text-white px-6 py-4 border-4 border-transparent active:bg-white active:text-black active:border-brutal-black transition-all" onclick="toggleMobileFilter()">
            <span class="font-bold font-mono text-lg uppercase">>> Show Filters</span>
            <img src="<?= base_url('public/icons/products/filter.png'); ?>" alt="filter" class="w-6 filter invert active:invert-0">
        </button>

        <div class="flex flex-col items-center md:items-start w-full text-center md:text-left">
            <h1 class="font-sans font-black text-3xl md:text-5xl lg:text-6xl text-brutal-black uppercase tracking-tight leading-none">
                Koleksi Sepatu
            </h1>
            <div class="flex flex-wrap justify-center md:justify-start items-center gap-2 mt-2 font-mono font-bold text-gray-500 text-xs md:text-sm">
                <span>// TOTAL SEPATU TERSEDIA:</span>
                <span class="bg-brutal-yellow text-black px-2 border border-black"><?php echo $count_all_products ?> ITEM DITEMUKAN</span>
            </div>
        </div>
    </div>
</section>
<section class="container max-w-7xl mx-auto px-4 mb-20 md:mb-32 flex flex-col lg:flex-row gap-8 lg:gap-12 relative">
    
    <aside class="hidden lg:block w-full lg:w-1/4 h-fit sticky top-28 z-20">
        <div class="border-4 border-brutal-black bg-white shadow-[8px_8px_0px_0px_#000000] p-6">
            <div class="flex items-center gap-2 mb-6 border-b-4 border-brutal-black pb-4">
                <div class="w-4 h-4 bg-brutal-orange border-2 border-black rounded-full"></div>
                <h3 class="font-sans font-black text-2xl uppercase">Filter Data</h3>
            </div>

            <div class="mb-8">
                <h4 class="font-mono font-bold text-sm text-gray-500 mb-3 uppercase flex justify-between">
                    <span>Ukuran</span>
                    <span>[-]</span>
                </h4>
                <div class="grid grid-cols-3 gap-2">
                    <?php foreach ($sizes as $size) { ?>
                        <button type="button"
                            class="py-2 border-2 border-brutal-black font-rubik font-bold text-sm hover:bg-brutal-black hover:text-white transition-all duration-200 shadow-[2px_2px_0px_0px_#ccc] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]"
                            onclick="window.location.href = '<?= base_url('produk/filter/size/' . $size['id']); ?>'">
                            <?= $size['name']; ?>
                        </button>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="font-mono font-bold text-sm text-gray-500 mb-3 uppercase flex justify-between">
                    <span>Kategori</span>
                    <span>[-]</span>
                </h4>
                <div class="space-y-3">
                    <?php foreach ($categories as $category) { ?>
                        <label class="flex items-center gap-3 cursor-pointer group select-none" onclick="window.location.href = '<?= base_url('produk/filter/category/' . $category['id']); ?>'">
                            <div class="w-6 h-6 border-2 border-brutal-black flex items-center justify-center group-hover:bg-brutal-yellow transition-colors flex-shrink-0">
                                <div class="w-3 h-3 bg-black opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            <span class="font-rubik font-bold text-sm uppercase text-brutal-black group-hover:translate-x-1 transition-transform"><?= $category['name']; ?></span>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </div>
    </aside>

    <div class="w-full lg:w-3/4">
        <?php if(empty($products)): ?>
            <div class="w-full h-64 border-4 border-dashed border-brutal-black flex flex-col items-center justify-center bg-gray-50 p-4 text-center">
                <h3 class="font-black text-2xl md:text-3xl uppercase text-gray-400">DATA_NOT_FOUND</h3>
                <p class="font-mono text-xs md:text-sm mt-2">Silakan reset filter Anda.</p>
                <button onclick="window.location.href='<?= base_url('produk'); ?>'" class="mt-4 bg-brutal-black text-white px-6 py-3 font-bold hover:bg-brutal-orange transition-colors uppercase text-sm md:text-base">RESET FILTER</button>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <?php foreach ($products as $key => $item) { ?>
                    <div class="group relative flex flex-col h-full">
                        <div class="absolute inset-0 bg-brutal-black translate-x-2 translate-y-2 lg:translate-x-3 lg:translate-y-3"></div>
                        
                        <div class="relative flex flex-col h-full bg-white border-4 border-brutal-black p-3 transition-transform duration-200 group-hover:-translate-y-1 group-hover:-translate-x-1">
                            
                            <div class="relative w-full h-[220px] md:h-[250px] overflow-hidden border-b-4 border-brutal-black bg-gray-100 mb-4">
                                <img src="<?= base_url('public/uploads/' . $item['product_image']); ?>" 
                                    alt="<?= $item['product_name']; ?>"
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500"
                                    loading="lazy">
                                
                                <div class="absolute bottom-0 right-0 bg-brutal-yellow text-black font-mono font-bold text-xs md:text-sm px-3 py-1 border-t-2 border-l-2 border-black">
                                    Rp <?= number_format($item['product_price'], 0, ',', '.'); ?>
                                </div>
                            </div>

                            <div class="flex-grow flex flex-col gap-2">
                                <h3 class="font-rubik font-black text-lg md:text-xl uppercase leading-tight line-clamp-2">
                                    <?= $item['product_name']; ?>
                                </h3>
                                <div class="w-full h-1 bg-gray-200 mt-1 mb-3 relative overflow-hidden">
                                    <div class="absolute top-0 left-0 h-full bg-brutal-orange w-0 group-hover:w-full transition-all duration-500"></div>
                                </div>
                            </div>

                            <button type="button"
                                class="mt-auto w-full bg-brutal-black text-white font-bold py-3 uppercase tracking-wider text-sm md:text-base hover:bg-brutal-orange hover:text-white transition-colors flex items-center justify-center gap-2 group-hover:gap-4"
                                onclick="window.location.href = '<?= base_url('detail_produk/' . $item['product_id']); ?>'">
                                <span>Lihat Detail</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<script>
    function toggleMobileFilter() {
        const sidebar = document.querySelector('aside');
        
        // Cek jika sidebar tersembunyi
        if (sidebar.classList.contains('hidden')) {
            // Tampilkan sidebar (Mode Modal/Overlay)
            sidebar.classList.remove('hidden');
            sidebar.classList.add('block', 'fixed', 'inset-0', 'z-50', 'bg-black/80', 'overflow-y-auto', 'animate-fade-in');
            
            // Style inner container agar di tengah layar HP
            const innerDiv = sidebar.firstElementChild;
            innerDiv.classList.add('max-w-[90%]', 'mx-auto', 'mt-10', 'mb-10', 'relative');
            
            // Tambahkan tombol close jika belum ada
            if (!document.getElementById('closeFilterBtn')) {
                const closeBtn = document.createElement('button');
                closeBtn.id = 'closeFilterBtn';
                closeBtn.innerHTML = 'CLOSE [X]';
                closeBtn.className = 'absolute top-2 right-2 font-black text-red-600 border-2 border-red-600 px-2 py-1 bg-white hover:bg-red-600 hover:text-white transition-colors';
                closeBtn.onclick = toggleMobileFilter;
                innerDiv.prepend(closeBtn);
            }
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';

        } else {
            // Sembunyikan sidebar
            sidebar.classList.add('hidden');
            sidebar.classList.remove('block', 'fixed', 'inset-0', 'z-50', 'bg-black/80', 'overflow-y-auto', 'animate-fade-in');
            
            // Reset style inner container
            const innerDiv = sidebar.firstElementChild;
            innerDiv.classList.remove('max-w-[90%]', 'mx-auto', 'mt-10', 'mb-10', 'relative');
            
            // Hapus tombol close
            const closeBtn = document.getElementById('closeFilterBtn');
            if (closeBtn) closeBtn.remove();
            
            // Enable body scroll
            document.body.style.overflow = '';
        }
    }
</script>