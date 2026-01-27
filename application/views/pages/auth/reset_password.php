<?php if (!$this->session->userdata('user_logged_in')): ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SOLE NUSA</title>
    
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
        body { margin: 0; padding: 0; overflow: hidden; }
        .bg-grid-pattern {
            background-image: 
                repeating-linear-gradient(0deg, #e5e7eb 0px, #e5e7eb 2px, transparent 2px, transparent 50px),
                repeating-linear-gradient(90deg, #e5e7eb 0px, #e5e7eb 2px, transparent 2px, transparent 50px);
        }
        .input-brutal:focus {
            box-shadow: 6px 6px 0px 0px #F58600;
            transform: translate(-2px, -2px);
        }
        .marquee-wrapper {
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
    </style>
</head>
<body class="bg-white font-sans text-brutal-black h-screen w-screen overflow-hidden">
    <div class="h-screen w-screen flex items-center justify-center bg-grid-pattern relative p-4 sm:p-6">
        
        <?php if ($this->session->flashdata('error')): ?>
        <div class="absolute top-4 left-1/2 -translate-x-1/2 bg-red-500 text-white px-6 py-3 border-4 border-black shadow-hard z-50 font-bold">
            <?= $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <div class="relative w-full max-w-md animate-slide-up group/card">
            <div class="absolute inset-0 bg-black translate-x-3 translate-y-3 md:translate-x-4 md:translate-y-4 border-4 border-black z-0 transition-transform duration-300"></div>
            <div class="relative bg-white border-4 border-black z-10 flex flex-col overflow-hidden">
                <div class="bg-black text-white py-2 border-b-4 border-black overflow-hidden whitespace-nowrap marquee-wrapper">
                    <div class="inline-block animate-marquee font-mono font-bold text-xs tracking-wider text-brutal-yellow">
                        NEW PASSWORD /// SECURE ACCESS /// NEW PASSWORD /// SECURE ACCESS /// NEW PASSWORD /// SECURE ACCESS ///
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="mb-6 border-b-4 border-black pb-4">
                        <h2 class="font-rubik font-black text-3xl md:text-3xl uppercase tracking-tighter">
                            SET PASS BARU<span class="text-brutal-orange">.</span>
                        </h2>
                    </div>

                    <form action="<?= site_url('Login/update_password'); ?>" method="post" class="space-y-5">
                        <input type="hidden" name="token" value="<?= $token; ?>">
                        
                        <div class="space-y-2">
                            <label class="block font-mono font-bold text-xs uppercase flex items-center gap-2">
                                <div class="w-2 h-2 bg-brutal-orange border border-black"></div>
                                New Password
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

                        <div class="pt-2">
                            <button type="submit" 
                                class="w-full bg-black text-white font-rubik font-black text-xl py-4 border-4 border-black shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 hover:bg-brutal-orange hover:text-black hover:border-black transition-all duration-150 flex justify-center items-center gap-2 group">
                                <span>SIMPAN PASSWORD</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
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
</body>
</html>
<?php endif; ?>
