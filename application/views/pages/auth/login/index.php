<?php if (!$this->session->userdata('user_logged_in')): ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SOLE NUSA</title>
    
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
                        'marquee': 'marquee 12s linear infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Background Pattern Original */
        .bg-grid-pattern {
            background-image: 
                repeating-linear-gradient(0deg, #e5e7eb 0px, #e5e7eb 2px, transparent 2px, transparent 50px),
                repeating-linear-gradient(90deg, #e5e7eb 0px, #e5e7eb 2px, transparent 2px, transparent 50px);
        }
        
        /* Custom Styles for Inputs */
        .input-brutal:focus {
            box-shadow: 6px 6px 0px 0px #F58600;
            transform: translate(-2px, -2px);
        }

        /* Marquee Container */
        .marquee-wrapper {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
    </style>
</head>
<body class="bg-white font-sans text-brutal-black h-screen w-screen overflow-hidden">

    <div class="h-screen w-screen flex items-center justify-center bg-grid-pattern relative p-4 sm:p-6">

        <a href="<?= site_url('home'); ?>" class="absolute top-4 right-4 md:top-8 md:right-8 z-50 group">
            <div class="bg-white border-4 border-black px-4 py-2 font-mono font-bold text-xs md:text-sm uppercase shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 transition-all flex items-center gap-2">
                <span>KEMBALI</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>
        </a>

        <div class="relative w-full max-w-md animate-slide-up group/card">
            
            <div class="absolute inset-0 bg-black translate-x-3 translate-y-3 md:translate-x-4 md:translate-y-4 border-4 border-black z-0 transition-transform duration-300"></div>

            <div class="relative bg-white border-4 border-black z-10 flex flex-col overflow-hidden">
                
                <div class="bg-black text-white py-2 border-b-4 border-black overflow-hidden whitespace-nowrap marquee-wrapper">
                    <div class="inline-block animate-marquee font-mono font-bold text-xs tracking-wider text-brutal-yellow">
                        LOGIN AREA /// SOLE NUSA /// AUTHENTICATION /// LOGIN AREA /// SOLE NUSA /// AUTHENTICATION /// 
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    
                    <div class="mb-6 border-b-4 border-black pb-4">
                        <h2 class="font-rubik font-black text-4xl md:text-5xl uppercase tracking-tighter">
                            LOGIN<span class="text-brutal-orange">.</span>
                        </h2>
                    </div>

                    <form action="<?php echo site_url('masuk/authenticate') ?>" method="post" enctype="multipart/form-data" class="space-y-5">
                        
                        <div class="space-y-2">
                            <label class="block font-mono font-bold text-xs uppercase flex items-center gap-2">
                                <div class="w-2 h-2 bg-brutal-orange border border-black"></div>
                                Username
                            </label>
                            <div class="relative">
                                <input type="text" name="username" required autocomplete="off" placeholder="Masukkan username..."
                                    class="input-brutal w-full px-4 py-3 md:px-5 md:py-3 border-4 border-black font-bold font-sans text-sm md:text-base placeholder-gray-400 bg-brutal-grey focus:bg-white focus:outline-none transition-all duration-200">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block font-mono font-bold text-xs uppercase flex items-center gap-2">
                                <div class="w-2 h-2 bg-brutal-orange border border-black"></div>
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" id="passwordInput" name="password" required placeholder="••••••••"
                                    class="input-brutal w-full px-4 py-3 md:px-5 md:py-3 pr-12 border-4 border-black font-bold font-sans text-sm md:text-base placeholder-gray-400 bg-brutal-grey focus:bg-white focus:outline-none transition-all duration-200">
                                <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 hover:text-brutal-orange transition-colors cursor-pointer">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="pt-2 space-y-4">
                            <button type="submit" 
                                class="w-full bg-black text-white font-rubik font-black text-xl py-4 border-4 border-black shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 hover:bg-brutal-orange hover:text-black hover:border-black transition-all duration-150 flex justify-center items-center gap-2 group">
                                <span>MASUK</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>

                            <div class="relative flex py-2 items-center justify-center">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t-4 border-black"></div>
                                </div>
                                <span class="relative bg-brutal-yellow px-2 font-mono text-xs font-black border-2 border-black -rotate-2">
                                    ATAU
                                </span>
                            </div>

                            <button type="button" onclick="window.location.href='<?= site_url('masuk/google_login'); ?>'"
                                class="w-full bg-white text-black font-mono font-bold text-sm py-3 border-4 border-black hover:bg-brutal-yellow transition-all flex justify-center items-center gap-3 shadow-none hover:shadow-hard-hover hover:-translate-y-0.5 hover:-translate-x-0.5">
                                <img src="<?= base_url('public/icons/register/google.png'); ?>" alt="G" class="w-5 h-5 grayscale group-hover:grayscale-0">
                                <span>LOGIN GOOGLE</span>
                            </button>
                        </div>

                    </form>
                </div>

                <div class="bg-brutal-grey border-t-4 border-black p-4 text-center">
                    <p class="font-mono text-xs font-bold mb-2">BELUM PUNYA AKUN?</p>
                    
                    <a href="<?= site_url('/daftar'); ?>" 
                        class="inline-block relative font-rubik font-black text-sm uppercase group tracking-wider">
                        <span class="relative z-10 text-black group-hover:text-brutal-orange transition-colors duration-300">
                            DAFTAR SEKARANG →
                        </span>
                        <span class="absolute left-0 -bottom-1 w-0 h-1 bg-brutal-orange transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
    }
}
</script>
</html>

<?php elseif ($this->session->userdata('user_logged_in') && $this->session->userdata('role') == 'user'): ?>
    <script>window.location.href = "<?php echo site_url('user/dashboard'); ?>";</script>
<?php elseif ($this->session->userdata('user_logged_in') && $this->session->userdata('role') == 'admin'): ?>
    <script>window.location.href = "<?php echo site_url('admin/dashboard'); ?>";</script>
<?php endif; ?>