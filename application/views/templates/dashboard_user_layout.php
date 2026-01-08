<?php if ($this->session->userdata('user_logged_in') && $this->session->userdata('role') == 'user'): ?>
    
    <header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[50] w-full bg-white border-b-2 border-black py-3 lg:ps-[280px]">
        <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
            
            <div class="flex items-center gap-x-4">
                <div class="lg:hidden">
                    <button type="button" class="p-2 inline-flex justify-center items-center gap-x-2 rounded-none border-2 border-black bg-yellow-400 text-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all focus:outline-none" 
                        data-hs-overlay="#hs-application-sidebar" aria-controls="hs-application-sidebar" aria-label="Toggle navigation">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                    </button>
                </div>

                <a href="<?= base_url('home'); ?>" class="group inline-flex items-center gap-x-2 py-2 px-4 bg-yellow-300 border-2 border-black text-sm font-bold text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:bg-orange-500 hover:text-black hover:translate-x-[3px] hover:translate-y-[3px] transition-all duration-200">
                    <svg class="shrink-0 size-4 transition-transform group-hover:-translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    Beranda
                </a>
            </div>

            <div class="w-full flex items-center justify-end ms-auto gap-x-3">
                <div class="flex items-center gap-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Masuk sebagai</p>
                        <p class="text-sm font-bold text-black"><?= $user['email'] ?></p>
                    </div>
                    <a href="<?= base_url('user/update_user'); ?>" class="size-[42px] inline-flex justify-center items-center rounded-none border-2 border-black bg-white shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] hover:bg-yellow-300 transition-all focus:outline-none" title="Profil Saya">
                        <img class="shrink-0 size-[34px] object-cover border border-black" src="<?= base_url('public/uploads/users/') . $user['profile_picture'] ?>" alt="Avatar">
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <aside id="hs-application-sidebar" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-[280px] h-full hidden fixed inset-y-0 start-0 z-[60] bg-white border-e-2 border-black lg:block lg:translate-x-0 lg:end-auto lg:bottom-0">
        
        <div class="relative flex flex-col h-full max-h-full bg-white">
            
            <div class="px-6 pt-6 pb-4 border-b-2 border-black bg-orange-500">
                <h3 class="font-rubik font-black text-3xl uppercase tracking-tighter cursor-pointer text-white hover:text-black transition-colors drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]" onclick="location.href='<?= base_url('home'); ?>'">
                    SoleNusa
                </h3>
            </div>

            <div class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-black [&::-webkit-scrollbar-track]:bg-gray-100 p-4">
                <nav class="hs-accordion-group w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                    <ul class="space-y-3">
                        
                        <li>
                            <a class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black border-2 border-black bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] hover:bg-yellow-300 transition-all" href="<?= base_url('user/dashboard'); ?>">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black border-2 border-black bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] hover:bg-yellow-300 transition-all" href="<?= base_url('user/update_user'); ?>">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                Perbarui Profil
                            </a>
                        </li>

                        <li>
                            <a class="group flex items-center gap-x-3.5 py-3 px-4 text-sm font-bold text-black border-2 border-black bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] hover:bg-yellow-300 transition-all" href="<?= base_url('user/comments'); ?>">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
                                Ulasan Saya
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="mt-auto p-4 border-t-2 border-black bg-yellow-50">
                <a class="group w-full flex justify-center items-center gap-x-2 py-3 px-4 text-sm font-bold text-white bg-black border-2 border-black shadow-[4px_4px_0px_0px_rgba(255,165,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] hover:bg-orange-500 hover:text-black transition-all" href="<?= base_url('Login/logout'); ?>">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    KELUAR
                </a>
            </div>

        </div>
    </aside>

<?php elseif ($this->session->userdata('user_logged_in') && $this->session->userdata('role') != 'user'): ?>
    <script>
        alert("You cannot access user dashboard.");
        window.location.href = "<?php echo base_url('admin/dashboard'); ?>";
    </script>
<?php else: ?>
    <script>
        alert("You need to log in first to view dashboard.");
        window.location.href = "<?php echo base_url('login'); ?>";
    </script>
<?php endif; ?>