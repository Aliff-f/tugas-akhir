<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $header_title ?? 'Solenusa' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        brutal: {
                            black: '#000000',
                            white: '#FFFFFF',
                            orange: '#f28500', 
                            yellow: '#FFFF00',
                            blue: '#0000FF'
                        }
                    },
                    boxShadow: {
                        'hard': '4px 4px 0px 0px #000000', 
                        'hard-yellow': '8px 8px 0px 0px #FFFF00',
                        'hard-white': '4px 4px 0px 0px #FFFFFF',
                        'hard-orange': '4px 4px 0px 0px #f28500',
                        'hard-sm': '2px 2px 0px 0px #000000', // Shadow kecil untuk badge
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white font-sans overflow-x-hidden">

    <?php if (empty($hide_navbar_footer)): ?>
    <nav class="fixed w-full top-0 z-50 bg-brutal-black border-b-4 border-brutal-black shadow-hard-yellow py-4 px-4 md:px-8 transition-transform duration-300 hover:-translate-y-1 hover:translate-x-[-2px] hover:shadow-[12px_12px_0px_0px_#FFFF00]">
        <div class="max-w-7xl mx-auto flex justify-between items-center relative">

            <a href="<?= site_url('home'); ?>" class="group relative z-50 block">
                <div class="relative text-2xl md:text-3xl font-black tracking-tighter uppercase text-brutal-white transition-transform duration-200 group-hover:text-brutal-orange group-hover:scale-105 group-hover:-rotate-1">
                    SOLENUSA
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-8 lg:space-x-12 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                
                <a href="<?= site_url('home'); ?>" class="group relative inline-block py-2">
                    <span class="relative z-10 text-lg font-bold uppercase tracking-widest text-brutal-white transition-colors duration-300 group-hover:text-brutal-orange">
                        Home
                    </span>
                    <span class="absolute bottom-0 left-0 h-[4px] w-0 bg-brutal-orange transition-all duration-300 ease-out group-hover:w-full"></span>
                </a>

                
                <a href="<?= site_url('tentang'); ?>" class="group relative inline-block py-2">
                    <span class="relative z-10 text-lg font-bold uppercase tracking-widest text-brutal-white transition-colors duration-300 group-hover:text-brutal-orange">
                        Tentang
                    </span>
                    <span class="absolute bottom-0 left-0 h-[4px] w-0 bg-brutal-orange transition-all duration-300 ease-out group-hover:w-full"></span>
                </a>
                
                <a href="<?= site_url('produk'); ?>" class="group relative inline-block py-2">
                    <span class="relative z-10 text-lg font-bold uppercase tracking-widest text-brutal-white transition-colors duration-300 group-hover:text-brutal-orange">
                        Produk
                    </span>
                    <span class="absolute bottom-0 left-0 h-[4px] w-0 bg-brutal-orange transition-all duration-300 ease-out group-hover:w-full"></span>
                </a>

                <a href="<?= site_url('kontak'); ?>" class="group relative inline-block py-2">
                    <span class="relative z-10 text-lg font-bold uppercase tracking-widest text-brutal-white transition-colors duration-300 group-hover:text-brutal-orange">
                        Kontak
                    </span>
                    <span class="absolute bottom-0 left-0 h-[4px] w-0 bg-brutal-orange transition-all duration-300 ease-out group-hover:w-full"></span>
                </a>

            </div>

            <div class="flex items-center gap-3 z-50">
                
                <?php if ($this->session->userdata('user_logged_in')): ?>
                    <?php 
                        $role = $this->session->userdata('role');
                        $dashboard_url = ($role == 'admin') ? site_url('admin/dashboard') : site_url('user/dashboard');
                    ?>
                    <button onclick="location.href='<?= $dashboard_url; ?>'" class="hidden md:flex relative items-center gap-2 px-4 py-2.5 bg-brutal-white border-4 border-brutal-white shadow-hard-orange text-brutal-black font-bold uppercase text-sm tracking-wider transition-all duration-200 hover:translate-x-[4px] hover:translate-y-[4px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange group overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter" class="group-hover:scale-110 transition-transform">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="hidden lg:inline">Profil</span>
                    </button>
                <?php else: ?>
                    <button onclick="location.href='<?= site_url('masuk'); ?>'" class="hidden md:flex relative items-center gap-2 px-4 py-2.5 bg-brutal-white border-4 border-brutal-white shadow-hard-orange text-brutal-black font-bold uppercase text-sm tracking-wider transition-all duration-200 hover:translate-x-[4px] hover:translate-y-[4px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange group overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter" class="group-hover:scale-110 transition-transform">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="hidden lg:inline">Login</span>
                    </button>
                <?php endif; ?>


                <?php if ($this->session->userdata('role') !== 'admin'): ?>
                <button onclick="location.href='<?= site_url('keranjang'); ?>'" class="hidden md:flex relative items-center gap-2 px-4 py-2.5 bg-brutal-white border-4 border-brutal-white shadow-hard-orange text-brutal-black font-bold uppercase text-sm tracking-wider transition-all duration-200 hover:translate-x-[4px] hover:translate-y-[4px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter" class="group-hover:scale-110 transition-transform">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="hidden lg:inline">Cart</span>
                    
                    <?php
                        $cart_count = 0;
                        if ($this->session->userdata('user_logged_in')) {
                            $user_id = $this->session->userdata('id');
                            $cart_count = $this->Cart_model->count_cart_by_user_id($user_id);
                        }
                    ?>
                    <?php if ($cart_count > 0): ?>
                    <div class="absolute -top-3 -right-3 w-7 h-7 bg-red-600 border-2 border-black shadow-hard-sm flex items-center justify-center rounded-full z-10 transition-transform group-hover:scale-110 group-hover:-rotate-12 group-hover:bg-brutal-yellow group-hover:text-black">
                        <span class="text-white text-xs font-black group-hover:text-black"><?= $cart_count; ?></span>
                    </div>
                    <?php endif; ?>
                </button>
                <?php endif; ?>


                <button id="mobile-menu-btn" class="md:hidden flex flex-col justify-center items-center w-12 h-12 bg-brutal-orange border-4 border-brutal-white shadow-hard-white transition-all active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                    <span class="block w-6 h-1 bg-black mb-1 transition-transform duration-300 origin-center" id="bar1"></span>
                    <span class="block w-6 h-1 bg-black mb-1 transition-opacity duration-300" id="bar2"></span>
                    <span class="block w-6 h-1 bg-black transition-transform duration-300 origin-center" id="bar3"></span>
                </button>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <?php if (empty($hide_navbar_footer)): ?>
    <div id="mobile-menu" class="fixed inset-0 bg-brutal-black z-40 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-center items-center border-l-8 border-brutal-yellow">
        <nav class="flex flex-col space-y-8 text-center">
            <a href="<?= site_url('home'); ?>" class="mobile-link text-5xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300 transform hover:-rotate-2 hover:scale-110">
                Home
            </a>
            <a href="<?= site_url('tentang'); ?>" class="mobile-link text-5xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300 transform hover:-rotate-2 hover:scale-110 delay-100">
                Tentang
            </a>
            <a href="<?= site_url('produk'); ?>" class="mobile-link text-5xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300 transform hover:-rotate-2 hover:scale-110 delay-75">
                Produk
            </a>
            <a href="<?= site_url('kontak'); ?>" class="mobile-link text-5xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300 transform hover:-rotate-2 hover:scale-110 delay-150">
                Kontak
            </a>
        </nav>

        <div class="mt-12 flex space-x-6">
            <?php if ($this->session->userdata('role') !== 'admin'): ?>
            <button onclick="location.href='<?= site_url('keranjang'); ?>'" class="relative w-20 h-20 bg-brutal-white border-4 border-brutal-white text-black shadow-hard-orange transition-all hover:translate-x-[6px] hover:translate-y-[6px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange flex items-center justify-center group">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter" class="transition-colors">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-600 border-2 border-black shadow-hard-sm flex items-center justify-center rounded-full z-10">
                    <span class="text-white text-sm font-black"><?= isset($cart_count) ? $cart_count : 0; ?></span>
                </div>
            </button>
            <?php endif; ?>

            
            <?php if ($this->session->userdata('user_logged_in')): ?>
                <?php 
                    $role = $this->session->userdata('role');
                    $dashboard_url = ($role == 'admin') ? site_url('admin/dashboard') : site_url('user/dashboard');
                ?>
                <button onclick="location.href='<?= $dashboard_url; ?>'" class="w-20 h-20 bg-brutal-white border-4 border-brutal-white text-black shadow-hard-orange transition-all hover:translate-x-[6px] hover:translate-y-[6px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange flex items-center justify-center group">
                     <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter" class="transition-colors">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
            <?php else: ?>
                <button onclick="location.href='<?= site_url('masuk'); ?>'" class="w-20 h-20 bg-brutal-white border-4 border-brutal-white text-black shadow-hard-orange transition-all hover:translate-x-[6px] hover:translate-y-[6px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange flex items-center justify-center group">
                     <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter" class="transition-colors">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <style>
        .text-stroke-white {
            -webkit-text-stroke: 2px white;
        }
        .text-stroke-0 {
            -webkit-text-stroke: 0;
        }
    </style>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');
        let isMenuOpen = false;

        btn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            
            if (isMenuOpen) {
                // Open Menu
                menu.classList.remove('translate-x-full');
                document.body.style.overflow = 'hidden';
                
                // Animate Hamburger to X
                bar1.classList.add('rotate-45', 'translate-y-2');
                bar2.classList.add('opacity-0');
                bar3.classList.add('-rotate-45', '-translate-y-2');
            } else {
                // Close Menu
                menu.classList.add('translate-x-full');
                document.body.style.overflow = 'auto';
                
                // Animate X back to Hamburger
                bar1.classList.remove('rotate-45', 'translate-y-2');
                bar2.classList.remove('opacity-0');
                bar3.classList.remove('-rotate-45', '-translate-y-2');
            }
        });

        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => {
                isMenuOpen = false;
                menu.classList.add('translate-x-full');
                document.body.style.overflow = 'auto';
                bar1.classList.remove('rotate-45', 'translate-y-2');
                bar2.classList.remove('opacity-0');
                bar3.classList.remove('-rotate-45', '-translate-y-2');
            });
        });
    </script>
</body>
</html>