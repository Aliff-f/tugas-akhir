<style>
    /* Custom Font untuk Logo agar mirip gambar */
    @import url('https://fonts.googleapis.com/css2?family=Changa+One&family=Public+Sans:wght@400;600;700;800&display=swap');

    .font-logo {
        font-family: 'Changa One', cursive;
    }
    
    .neo-shadow {
        box-shadow: 4px 4px 0px 0px #000;
    }
    
    .neo-shadow-sm {
        box-shadow: 2px 2px 0px 0px #000;
    }

    .neo-border {
        border: 2px solid #000;
    }
    
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<?php if ($this->session->userdata('user_logged_in') && $this->session->userdata('role') == 'admin'): ?>

    <header class="sticky top-0 inset-x-0 z-[48] w-full bg-white border-b-2 border-black py-3 lg:ps-[280px]">
        <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto justify-between">
            
            <div class="flex items-center gap-4">
                <div class="lg:hidden">
                    <button type="button" class="p-2 border-2 border-black rounded bg-white text-black hover:bg-yellow-400 hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all shadow-[2px_2px_0px_0px_#000]" 
                            data-hs-overlay="#hs-application-sidebar" aria-controls="hs-application-sidebar" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>

                <a href="<?= base_url('home'); ?>" class="hidden md:inline-flex items-center gap-2 px-4 py-2 bg-yellow-400 border-2 border-black font-bold text-black shadow-[2px_2px_0_0_#000] hover:bg-orange-500 hover:translate-y-0.5 hover:shadow-none transition-all rounded-md text-sm uppercase">
                    <i class="fa-solid fa-chevron-left text-xs"></i> Beranda
                </a>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden md:flex flex-col items-end mr-1">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Masuk Sebagai</span>
                    <span class="text-sm font-bold text-black leading-tight"><?= $admin['email'] ?></span>
                </div>
                <div class="relative group cursor-pointer">
                    <img class="inline-block size-[42px] rounded-md border-2 border-black shadow-[2px_2px_0_0_#000] group-hover:bg-yellow-400 group-hover:shadow-none group-hover:translate-x-[2px] group-hover:translate-y-[2px] transition-all" 
                         src="<?= base_url('public/uploads/users/') . $admin['profile_picture'] ?>" alt="Avatar">
                </div>
            </div>
        </nav>
    </header>

    <aside id="hs-application-sidebar" class="hs-overlay [--auto-close:lg]
        hs-overlay-open:translate-x-0
        -translate-x-full transition-all duration-300 transform
        w-[280px] h-full
        hidden
        fixed inset-y-0 start-0 z-[60]
        bg-white border-e-2 border-black
        lg:block lg:translate-x-0 lg:end-auto lg:bottom-0">
        
        <div class="relative flex flex-col h-full max-h-full">
            
            <div class="px-6 py-6 border-b-2 border-black bg-orange-500">
                <h3 class="font-logo text-4xl text-white tracking-wide uppercase drop-shadow-[2px_2px_0_#000] text-shadow cursor-pointer hover:text-yellow-300 transition-colors"
                    onclick="location.href='<?= base_url('home'); ?>'" 
                    style="-webkit-text-stroke: 1.5px black;">
                    SoleNusa
                </h3>
            </div>

            <div class="h-full overflow-y-auto no-scrollbar p-5 flex flex-col justify-between">
                
                <nav class="space-y-3">
                    
                    <a href="<?= base_url('admin/dashboard'); ?>" 
                       class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black bg-white border-2 border-black rounded-lg shadow-[4px_4px_0_0_#000] hover:bg-yellow-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                        <i class="fa-solid fa-table-columns text-lg"></i>
                        Dashboard
                    </a>

                    <a href="<?= base_url('admin/users'); ?>" 
                       class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black bg-white border-2 border-black rounded-lg shadow-[4px_4px_0_0_#000] hover:bg-yellow-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                        <i class="fa-solid fa-users text-lg"></i>
                        Pengguna
                    </a>

                    <a href="<?= base_url('admin/products'); ?>" 
                       class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black bg-white border-2 border-black rounded-lg shadow-[4px_4px_0_0_#000] hover:bg-yellow-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                        <i class="fa-solid fa-box-open text-lg"></i>
                        Produk
                    </a>

                    <a href="<?= base_url('admin/comments'); ?>" 
                       class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black bg-white border-2 border-black rounded-lg shadow-[4px_4px_0_0_#000] hover:bg-yellow-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all">
                        <i class="fa-regular fa-comment-dots text-lg"></i>
                        Ulasan
                    </a>

                </nav>

                <div class="mt-auto pt-6 border-t-2 border-dashed border-gray-300">
                    <a href="<?= base_url('Login/logout'); ?>" 
                       class="w-full flex items-center justify-center gap-x-2 py-3 px-4 text-sm font-bold text-white bg-black border-2 border-black rounded-lg shadow-[4px_4px_0_0_#888] hover:bg-orange-500 hover:text-white hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all uppercase">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Keluar
                    </a>
                </div>

            </div>
        </div>
    </aside>
    <?php elseif ($this->session->userdata('user_logged_in') && $this->session->userdata('role') != 'admin'): ?>
    <script>
        alert("You cannot access admin dashboard.");
        window.location.href = "<?php echo base_url('user/dashboard'); ?>";
    </script>
<?php else: ?>
    <script>
        alert("You need to log in first to view dashboard.");
        window.location.href = "<?php echo base_url('login'); ?>";
    </script>
<?php endif; ?>