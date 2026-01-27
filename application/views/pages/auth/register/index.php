<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SOLE NUSA</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=Rubik:wght@400;500;700;900&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                        rubik: ['"Rubik"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        brutal: {
                            black: '#121212',
                            white: '#FFFFFF',
                            orange: '#F58600',
                            yellow: '#FFD600',
                            grey: '#F3F4F6',
                        }
                    },
                    boxShadow: {
                        'hard': '8px 8px 0px 0px #000000',
                        'hard-hover': '4px 4px 0px 0px #000000',
                        'hard-focus': '6px 6px 0px 0px #F58600',
                    },
                    animation: {
                        'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'marquee': 'marquee 15s linear infinite',
                    },
                    keyframes: {
                        slideUp: {
                            '0%': { transform: 'translateY(50px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-100%)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { margin: 0; padding: 0; overflow-x: hidden; }

        .bg-grid-pattern {
            background-image: 
                repeating-linear-gradient(0deg, #e5e7eb 0px, #e5e7eb 2px, transparent 2px, transparent 50px),
                repeating-linear-gradient(90deg, #e5e7eb 0px, #e5e7eb 2px, transparent 2px, transparent 50px);
        }
        
        .marquee-wrapper {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }

        /* Custom Radio Styling */
        input[type="radio"]:checked + div {
            background-color: #000;
            color: #FFD600;
            box-shadow: 4px 4px 0px 0px #F58600;
            transform: translate(-2px, -2px);
            border-color: #000;
        }
        
        .input-brutal:focus {
            background-color: #fff;
            box-shadow: 6px 6px 0px 0px #000;
            transform: translate(-2px, -2px);
        }
    </style>
</head>
<body class="bg-white font-sans text-brutal-black min-h-screen w-full">

    <div class="min-h-screen w-full flex items-center justify-center bg-grid-pattern relative p-4 py-8 md:py-12">

        <div class="fixed top-8 left-8 hidden md:block z-50">
             <!-- <div class="bg-brutal-yellow border-4 border-black px-4 py-2 font-black font-mono text-xs shadow-hard transform rotate-2 hover:rotate-0 transition-all cursor-default">
                STATUS: REGISTRATION 
            </div> -->
        </div>

        <a href="<?= site_url('home'); ?>" class="fixed top-4 right-4 md:top-8 md:right-8 z-50 group">
            <div class="bg-white border-4 border-black px-4 py-2 font-mono font-bold text-xs md:text-sm uppercase shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 transition-all flex items-center gap-2">
                <span>KEMBALI</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>
        </a>

        <div class="relative w-full max-w-3xl animate-slide-up">
            
            <div class="absolute inset-0 bg-brutal-orange translate-x-3 translate-y-3 md:translate-x-5 md:translate-y-5 border-4 border-black z-0"></div>

            <div class="relative bg-white border-4 border-black z-10 flex flex-col">
                
                <div class="bg-black text-white py-2 border-b-4 border-black overflow-hidden whitespace-nowrap marquee-wrapper">
                    <div class="inline-block animate-marquee font-mono font-bold text-xs md:text-sm tracking-wider text-brutal-yellow">
                        JOIN THE CLUB /// REGISTER NEW ACCOUNT /// SOLE NUSA MEMBERSHIP /// UNLOCK EXCLUSIVE ACCESS /// JOIN THE CLUB /// REGISTER NEW ACCOUNT ///
                    </div>
                </div>

                <div class="px-6 pt-8 pb-4 md:px-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b-4 border-black pb-4">
                        <div>
                            <span class="bg-brutal-yellow text-black px-2 py-1 font-mono text-xs font-bold border-2 border-black mb-2 inline-block">
                                NEW MEMBER
                            </span>
                            <h2 class="font-rubik font-black text-4xl md:text-5xl uppercase tracking-tighter leading-none">
                                DAFTAR<span class="text-brutal-orange">.</span>
                            </h2>
                        </div>
                        <div class="hidden md:block text-right opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-10 pt-2">
                    <form action="<?php echo site_url('daftar/submit') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                    <div class="w-2 h-2 bg-black"></div> Nama Lengkap
                                </label>
                                <input type="text" name="fullname" required placeholder="Jhon Doe"
                                    class="input-brutal w-full px-4 py-3 border-4 border-black font-bold font-mono text-sm bg-brutal-grey focus:outline-none transition-all duration-200">
                            </div>
                            <div class="space-y-2">
                                <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                    <div class="w-2 h-2 bg-black"></div> Username
                                </label>
                                <input type="text" name="username" required placeholder="jhondoe123"
                                    class="input-brutal w-full px-4 py-3 border-4 border-black font-bold font-mono text-sm bg-brutal-grey focus:outline-none transition-all duration-200">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                <div class="w-2 h-2 bg-black"></div> Jenis Kelamin
                            </label>
                            <div class="grid grid-cols-3 gap-3 md:gap-4">
                                <label class="cursor-pointer group relative">
                                    <input type="radio" name="gender" value="male" class="sr-only" required>
                                    <div class="py-3 border-4 border-black text-center font-bold font-mono text-xs md:text-sm uppercase transition-all bg-white hover:bg-brutal-grey">
                                        PRIA
                                    </div>
                                </label>
                                <label class="cursor-pointer group relative">
                                    <input type="radio" name="gender" value="female" class="sr-only" required>
                                    <div class="py-3 border-4 border-black text-center font-bold font-mono text-xs md:text-sm uppercase transition-all bg-white hover:bg-brutal-grey">
                                        WANITA
                                    </div>
                                </label>
                                <label class="cursor-pointer group relative">
                                    <input type="radio" name="gender" value="other" class="sr-only" required>
                                    <div class="py-3 border-4 border-black text-center font-bold font-mono text-xs md:text-sm uppercase transition-all bg-white hover:bg-brutal-grey">
                                        LAINNYA
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                    <div class="w-2 h-2 bg-black"></div> No. Telepon
                                </label>
                                <input type="tel" name="phone" required placeholder="0812..."
                                    class="input-brutal w-full px-4 py-3 border-4 border-black font-bold font-mono text-sm bg-brutal-grey focus:outline-none transition-all duration-200">
                            </div>
                            <div class="space-y-2">
                                <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                    <div class="w-2 h-2 bg-black"></div> Email
                                </label>
                                <input type="email" name="email" required placeholder="email@contoh.com"
                                    class="input-brutal w-full px-4 py-3 border-4 border-black font-bold font-mono text-sm bg-brutal-grey focus:outline-none transition-all duration-200">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                    <div class="w-2 h-2 bg-brutal-orange border border-black"></div> Password
                                </label>
                                <input type="password" name="password" required placeholder="••••••••"
                                    class="input-brutal w-full px-4 py-3 border-4 border-black font-bold font-mono text-sm bg-brutal-grey focus:outline-none transition-all duration-200">
                            </div>
                            <div class="space-y-2">
                                <label class="font-mono font-bold text-xs uppercase flex items-center gap-2">
                                    <div class="w-2 h-2 bg-brutal-orange border border-black"></div> Konfirmasi
                                </label>
                                <input type="password" name="confirm_password" required placeholder="••••••••"
                                    class="input-brutal w-full px-4 py-3 border-4 border-black font-bold font-mono text-sm bg-brutal-grey focus:outline-none transition-all duration-200">
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" 
                                class="w-full bg-black text-white font-rubik font-black text-xl py-4 border-4 border-black shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 hover:bg-brutal-yellow hover:text-black hover:border-black transition-all duration-150 flex justify-center items-center gap-3 group">
                                <span>DAFTAR SEKARANG</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>

                    </form>
                </div>

                <div class="bg-brutal-grey border-t-4 border-black p-4 text-center">
                    <p class="font-mono text-xs font-bold mb-2">SUDAH PUNYA AKUN?</p>
                    <a href="<?= site_url('masuk'); ?>" 
                        class="inline-block relative font-rubik font-black text-sm uppercase group tracking-wider">
                        <span class="relative z-10 text-black group-hover:text-brutal-orange transition-colors duration-300">
                            MASUK DI SINI →
                        </span>
                        <span class="absolute left-0 -bottom-1 w-0 h-1 bg-brutal-orange transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

            </div>
            
            <div class="absolute -top-3 -right-3 w-8 h-8 bg-brutal-yellow border-4 border-black z-20 hidden md:block"></div>
            <div class="absolute -bottom-3 -left-3 w-8 h-8 bg-white border-4 border-black z-20 hidden md:block"></div>

        </div>
    </div>

    <!-- Duplicate Email Modal -->
    <?php if ($this->session->flashdata('is_duplicate_email')): ?>
    <div id="duplicateEmailModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="relative w-full max-w-md animate-slide-up">
            <!-- Shadow Layer -->
            <div class="absolute inset-0 bg-brutal-orange translate-x-3 translate-y-3 border-4 border-black z-0"></div>
            
            <!-- Modal Content -->
            <div class="relative bg-white border-4 border-black z-10 flex flex-col">
                <div class="bg-black text-white py-2 border-b-4 border-black px-4 flex justify-between items-center">
                    <span class="font-mono font-bold text-xs tracking-widest text-brutal-yellow uppercase">Email Terdaftar</span>
                    <button onclick="closeModal()" class="hover:text-brutal-orange transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                
                <div class="p-8 text-center flex flex-col gap-6">
                    <div class="flex justify-center">
                        <div class="w-16 h-16 bg-brutal-yellow border-4 border-black flex items-center justify-center shadow-hard rotate-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-black">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <h3 class="font-rubik font-black text-2xl uppercase leading-tight">Akun Sudah Terdaftar!</h3>
                        <p class="font-mono text-sm font-bold text-gray-600">
                            Email <span class="text-brutal-orange underline"><?= $this->session->flashdata('duplicate_email'); ?></span> sepertinya sudah terdaftar di sistem kami.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <a href="<?= site_url('masuk'); ?>" 
                            class="w-full bg-black text-white font-mono font-black py-4 border-4 border-black shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 hover:bg-brutal-yellow hover:text-black transition-all flex justify-center items-center gap-2">
                            <span>MASUK KE AKUN</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <button onclick="closeModal()" 
                            class="w-full bg-brutal-grey text-black font-mono font-bold py-3 border-4 border-black hover:bg-white transition-all">
                            GANTI EMAIL LAIN
                        </button>
                    </div>
                </div>
                
                <div class="bg-black py-1 overflow-hidden h-6">
                    <div class="animate-marquee whitespace-nowrap font-mono text-[10px] font-bold text-brutal-yellow uppercase tracking-widest">
                        DUPLICATE EMAIL DETECTED /// PLEASE SIGN IN OR USE ANOTHER EMAIL /// DUPLICATE EMAIL DETECTED /// PLEASE SIGN IN OR USE ANOTHER EMAIL ///
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            const modal = document.getElementById('duplicateEmailModal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => modal.remove(), 300);
        }

        // Auto-close on ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
    <?php endif; ?>

</body>
</html>