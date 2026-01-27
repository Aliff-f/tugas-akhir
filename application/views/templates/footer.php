    <?php if (empty($hide_navbar_footer)): ?>
<footer class="bg-black text-white w-full py-10 px-4 lg:py-20 lg:px-8 border-t-8 border-yellow-400">
    <div class="max-w-7xl mx-auto flex flex-col gap-16">
        
        <div class="flex flex-col lg:flex-row lg:justify-between gap-12 lg:gap-20">
            
            <div class="flex flex-col gap-8 items-start lg:w-1/3 border-b-4 lg:border-b-0 lg:border-r-4 border-yellow-400 pb-8 lg:pb-0 lg:pr-8">
                <h1 class="font-mono font-extrabold text-5xl md:text-7xl text-yellow-400 tracking-tighter uppercase leading-none">
                    SOLENUSA
                </h1>
                <p class="text-gray-300 font-mono text-sm uppercase max-w-sm border border-gray-700 p-2">
Sepatu pilihan dari brand lokal Indonesia dengan gaya, kenyamanan, dan kualitas terbaik. SOLENUSA STORE untuk kamu yang bangga melangkah dengan produk dalam negeri.                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-10 lg:gap-20 lg:w-2/3">
                
                <div class="flex flex-col gap-5">
                    <h4 class="font-mono font-bold text-xl uppercase text-white border-b-2 border-yellow-400 pb-1">Navigasi</h4>
                    <div class="flex flex-col gap-3 font-mono text-sm">
                        <a href="<?= site_url('home'); ?>" class="text-gray-400 hover:text-yellow-400 transition duration-150 transform hover:translate-x-1 uppercase">Home</a>
                        <a href="<?= site_url('produk'); ?>" class="text-gray-400 hover:text-yellow-400 transition duration-150 transform hover:translate-x-1 uppercase">Produk</a>
                        <a href="<?= site_url('tentang'); ?>" class="text-gray-400 hover:text-yellow-400 transition duration-150 transform hover:translate-x-1 uppercase">Tentang Kami</a>
                        <a href="<?= site_url('kontak'); ?>" class="text-gray-400 hover:text-yellow-400 transition duration-150 transform hover:translate-x-1 uppercase">Kontak</a>
                    </div>
                </div>
                
                <div class="flex flex-col gap-5">
                    <h4 class="font-mono font-bold text-xl uppercase text-white border-b-2 border-yellow-400 pb-1">Kategori Produk</h4>
                    <div class="flex flex-col gap-3 font-mono text-sm">
                        <?php if (isset($categories) && is_array($categories)) {
                            foreach ($categories as $category) { ?>
                                <a href="<?= site_url('produk/filter/category/' . $category['id']); ?>" class="text-gray-400 hover:text-yellow-400 transition duration-150 transform hover:translate-x-1 uppercase">
                                    <?= $category['name']; ?>
                                </a>
                            <?php }
                        } else { ?>
                            <p class="text-gray-600 text-sm italic uppercase">Kategori tidak tersedia.</p>
                        <?php } ?>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <h4 class="font-mono font-bold text-xl uppercase text-white border-b-2 border-yellow-400 pb-1">Social</h4>
                    <div class="flex gap-4 flex-wrap">
                        <a href="" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-yellow-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.5)] border-2 border-transparent hover:border-black" target="_blank" aria-label="Facebook">
                            <img src="<?= base_url('public/icons/footer/facebook.png'); ?>" class="w-6 h-6 object-contain filter brightness-0" alt="Facebook" loading="lazy">
                        </a>
                        
                        <a href="" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-yellow-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.5)] border-2 border-transparent hover:border-black" target="_blank" aria-label="Instagram">
                             <img src="<?= base_url('public/icons/footer/instagram.png'); ?>" class="w-6 h-6 object-contain filter brightness-0" alt="Instagram" loading="lazy">
                        </a>
                        
                        <a href="" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-yellow-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.5)] border-2 border-transparent hover:border-black" target="_blank" aria-label="TikTok">
                             <img src="<?= base_url('public/icons/footer/tiktok.png'); ?>" class="w-6 h-6 object-contain filter brightness-0" alt="TikTok" loading="lazy">
                        </a>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="mt-4 pt-6 border-t border-gray-700">
            <div class="text-center font-mono text-gray-500 text-xs md:text-sm uppercase">
                <span class="text-yellow-400 mr-2">COPYRIGHT</span> &copy; <?= date('Y'); ?> SOLENUSA. ALL RIGHTS RESERVED.
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>