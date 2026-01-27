<?php if (!$this->session->userdata('user_logged_in')): ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SOLE NUSA</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=Rubik:wght@400;500;700;900&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    
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
        <a href="<?= site_url('masuk'); ?>" class="absolute top-4 right-4 md:top-8 md:right-8 z-50 group">
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
                        FORGOT PASSWORD /// RECOVERY /// RESET ACCESS /// FORGOT PASSWORD /// RECOVERY /// RESET ACCESS ///
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="mb-6 border-b-4 border-black pb-4">
                        <h2 class="font-rubik font-black text-3xl md:text-4xl uppercase tracking-tighter">
                            LUPA PASSWORD<span class="text-brutal-orange">.</span>
                        </h2>
                        <p class="font-mono text-sm mt-2 text-gray-600">Masukkan email Anda untuk reset password.</p>
                    </div>

                    <form id="forgotForm" class="space-y-5">
                        <div class="space-y-2">
                            <label class="block font-mono font-bold text-xs uppercase flex items-center gap-2">
                                <div class="w-2 h-2 bg-brutal-orange border border-black"></div>
                                Email Address
                            </label>
                            <div class="relative">
                                <input type="email" id="email" name="email" required autocomplete="email" placeholder="nama@email.com"
                                    class="input-brutal w-full px-4 py-3 md:px-5 md:py-3 border-4 border-black font-bold font-sans text-sm md:text-base placeholder-gray-400 bg-brutal-grey focus:bg-white focus:outline-none transition-all duration-200">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" id="btnSubmit"
                                class="w-full bg-black text-white font-rubik font-black text-xl py-4 border-4 border-black shadow-hard hover:shadow-hard-hover hover:translate-x-1 hover:translate-y-1 hover:bg-brutal-orange hover:text-black hover:border-black transition-all duration-150 flex justify-center items-center gap-2 group">
                                <span id="btnText">KIRIM LINK RESET</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div id="message" class="mt-4 font-mono text-sm font-bold text-center hidden"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            // EmailJS Config from Controller
            emailjs.init("<?= $emailjs_public_key ?>"); 
        })();

        document.getElementById('forgotForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const btnSubmit = document.getElementById('btnSubmit');
            const btnText = document.getElementById('btnText');
            const messageDiv = document.getElementById('message');
            const emailInput = document.getElementById('email').value;

            btnSubmit.disabled = true;
            btnText.innerText = 'MEMPROSES...';
            messageDiv.classList.add('hidden');
            messageDiv.classList.remove('text-green-600', 'text-red-600');

            // 1. Generate Token via Backend
            const formData = new FormData();
            formData.append('email', emailInput);

            fetch('<?= site_url('Login/generate_token'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        throw new Error("Server Error (Not JSON): " + text.substring(0, 100));
                    }
                });
            })
            .then(data => {
                if (data.status === 'success') {
                    // 2. Send Email via EmailJS
                    const templateParams = {
                        to_name: data.name,
                        to_email: emailInput, 
                        reset_link: '<?= base_url('Login/reset_password?token='); ?>' + data.token
                    };

                    emailjs.send('<?= $emailjs_service_id ?>', '<?= $emailjs_template_id ?>', templateParams)
                        .then(function(response) {
                            console.log('SUCCESS!', response.status, response.text);
                            messageDiv.innerText = 'Link reset password telah dikirim ke email Anda!';
                            messageDiv.classList.add('text-green-600');
                            messageDiv.classList.remove('hidden');
                            btnText.innerText = 'TERKIRIM';
                        }, function(error) {
                            console.log('FAILED...', error);
                            messageDiv.innerText = 'Gagal mengirim email (EmailJS).';
                            messageDiv.classList.add('text-red-600');
                            messageDiv.classList.remove('hidden');
                            btnText.innerText = 'COBA LAGI';
                            btnSubmit.disabled = false;
                        });
                } else {
                    messageDiv.innerText = data.message;
                    messageDiv.classList.add('text-red-600');
                    messageDiv.classList.remove('hidden');
                    btnText.innerText = 'COBA LAGI';
                    btnSubmit.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                let msg = error.message;
                if (!msg && typeof error === 'string') {
                    msg = error;
                } else if (!msg) {
                    msg = 'Unknown Error (undefined)';
                }
                
                messageDiv.innerText = 'Kesalahan: ' + msg;
                messageDiv.classList.add('text-red-600');
                messageDiv.classList.remove('hidden');
                btnText.innerText = 'COBA LAGI';
                btnSubmit.disabled = false;
            });
        });
    </script>
</body>
</html>
<?php endif; ?>
