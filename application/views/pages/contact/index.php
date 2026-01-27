<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - SOLENUSA</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=Rubik:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                        rubik: ['"Rubik"', 'sans-serif'],
                    },
                    colors: {
                        brutal: {
                            black: '#121212',
                            white: '#FFFFFF',
                            orange: '#F58600',
                            grey: '#F3F4F6'
                        }
                    },
                    boxShadow: {
                        'hard': '8px 8px 0px 0px #000000',
                        'hard-hover': '4px 4px 0px 0px #000000',
                    },
                    animation: {
                        'marquee': 'marquee 20s linear infinite',
                    },
                    keyframes: {
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
        .bg-pattern-dot {
            background-image: radial-gradient(#000 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.05;
        }
        /* Custom Scrollbar for Textarea */
        textarea::-webkit-scrollbar {
            width: 12px;
        }
        textarea::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-left: 2px solid #000;
        }
        textarea::-webkit-scrollbar-thumb {
            background: #F58600;
            border: 2px solid #000;
        }
    </style>
</head>
<body class="bg-brutal-white font-sans text-brutal-black selection:bg-brutal-orange selection:text-white overflow-x-hidden">

    <div id="status-message" class="fixed top-0 left-0 right-0 z-[60] p-4 text-center font-bold font-rubik uppercase tracking-widest hidden transition-all duration-300 shadow-hard border-b-4 border-black"></div>

    <main class="pt-32 md:pt-48 min-h-screen relative pb-20">
        <div class="fixed inset-0 bg-pattern-dot pointer-events-none z-0"></div>

        <section class="container max-w-7xl mx-auto px-4 mb-12 relative z-10">
            <h1 class="font-rubik font-black text-6xl md:text-8xl uppercase leading-none mb-6">
                HUBUNGI
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brutal-orange to-red-600" style="-webkit-text-stroke: 2px black;">KAMI.</span>
            </h1>
            <p class="font-sans text-lg md:text-xl max-w-2xl border-l-4 border-brutal-orange pl-6 py-2 bg-white/80 backdrop-blur-sm">
                Punya pertanyaan tentang produk, kolaborasi, atau sekadar ingin menyapa? 
                Isi formulir di bawah, kami akan membalas secepat kilat.
            </p>
        </section>
        <section class="container max-w-7xl mx-auto px-4 mb-24 relative z-10">
            <div class="flex flex-col lg:flex-row gap-0 shadow-hard border-4 border-black bg-white">
                
                <div class="w-full lg:w-1/3 bg-brutal-black text-white p-8 md:p-12 flex flex-col justify-between border-b-4 lg:border-b-0 lg:border-r-4 border-black relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-brutal-orange rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity"></div>

                    <div class="space-y-12 relative z-10">
                        <div>
                            <h3 class="font-rubik font-bold text-2xl uppercase mb-6 text-brutal-orange">Info Kontak</h3>
                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-white/10 border border-white/20">
                                        <i data-lucide="phone" class="w-6 h-6 text-brutal-orange"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Telepon / WhatsApp</p>
                                        <a href="tel:+6286227507531" class="text-lg font-bold hover:text-brutal-orange transition-colors font-mono">+62 862-2750-7531</a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-white/10 border border-white/20">
                                        <i data-lucide="mail" class="w-6 h-6 text-brutal-orange"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Email Resmi</p>
                                        <a href="mailto:aihsanavriandhana@gmail.com" class="text-lg font-bold hover:text-brutal-orange transition-colors break-all">aihsanavriandhana@gmail.com</a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-white/10 border border-white/20">
                                        <i data-lucide="map-pin" class="w-6 h-6 text-brutal-orange"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Lokasi Markas</p>
                                        <p class="text-lg font-bold">Surabaya, Jawa Timur<br>Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-white/20">
                            <p class="font-mono text-sm text-gray-400 mb-4">// FOLLOW US</p>
                            <div class="flex gap-4">
                                <a href="#" class="p-3 bg-white text-black hover:bg-brutal-orange hover:text-white transition-all border-2 border-transparent hover:border-white shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="p-3 bg-white text-black hover:bg-brutal-orange hover:text-white transition-all border-2 border-transparent hover:border-white shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="p-3 bg-white text-black hover:bg-brutal-orange hover:text-white transition-all border-2 border-transparent hover:border-white shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3 p-8 md:p-12 bg-white">
                    <form id="contact-form" class="flex flex-col gap-6 h-full justify-center">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-xs tracking-wider">Nama Lengkap</label>
                                <input type="text" name="user_name"
                                    class="w-full p-4 bg-brutal-grey border-2 border-black focus:outline-none focus:bg-white focus:shadow-[4px_4px_0px_0px_#F58600] transition-all font-medium placeholder-gray-500"
                                    placeholder="Siapa nama Anda?" required autocomplete="name">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-xs tracking-wider">Alamat Email</label>
                                <input type="email" name="user_email"
                                    class="w-full p-4 bg-brutal-grey border-2 border-black focus:outline-none focus:bg-white focus:shadow-[4px_4px_0px_0px_#F58600] transition-all font-medium placeholder-gray-500"
                                    placeholder="email@anda.com" required autocomplete="email">
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase text-xs tracking-wider">Pesan</label>
                            <textarea name="message" id="message" rows="5" 
                                class="w-full p-4 bg-brutal-grey border-2 border-black focus:outline-none focus:bg-white focus:shadow-[4px_4px_0px_0px_#F58600] transition-all font-medium placeholder-gray-500 resize-none" 
                                placeholder="Tuliskan apa yang bisa kami bantu..." required autocomplete="off"></textarea>
                        </div>

                        <button type="submit" id="submit-button"
                            class="mt-4 bg-black text-white font-rubik font-black text-xl py-5 px-8 border-2 border-black hover:bg-brutal-orange hover:text-black hover:border-black shadow-hard hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all flex items-center justify-between group disabled:opacity-50 disabled:cursor-not-allowed">
                            <span>KIRIM PESAN</span>
                            <i data-lucide="arrow-right" class="w-6 h-6 group-hover:translate-x-2 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <section class="w-full mb-12">
            <div class="container max-w-7xl mx-auto px-4">
                <div class="border-4 border-black p-2 bg-white shadow-hard">
                    <div class="relative w-full h-[400px] bg-brutal-grey border-2 border-black overflow-hidden group">
                        <div class="absolute inset-0 bg-brutal-orange/10 pointer-events-none z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.844673920866!2d112.72298567492697!3d-7.258512192748217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9503d619c43%3A0x411d4cbbe989434!2sSMK%20Negeri%202%20Surabaya!5e0!3m2!1sen!2sid!4v1764923224643!5m2!1sen!2sid"
                            class="w-full h-full grayscale group-hover:grayscale-0 transition-all duration-500"
                            style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>

                        <div class="absolute bottom-4 left-4 bg-white border-2 border-black px-4 py-2 z-20 shadow-[4px_4px_0px_0px_#000]">
                            <span class="font-mono text-xs font-bold uppercase">📍 Main HQ Location</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // =========================================================================
        // CONFIGURATION
        // =========================================================================
        const EMAILJS_SERVICE_ID = 'service_5475vve'; 
        const EMAILJS_TEMPLATE_ID = 'template_nhax4i4'; 
        const EMAILJS_PUBLIC_KEY = 'ZDqyaGHKvQWEYCJAu'; 

        // Function to show Brutalist Status Toast
        function showStatus(message, isSuccess) {
            const statusDiv = document.getElementById('status-message');
            statusDiv.textContent = message;
            
            if (isSuccess) {
                statusDiv.className = 'fixed top-0 left-0 right-0 z-[60] p-4 text-center font-bold font-rubik uppercase tracking-widest transition-all duration-300 shadow-hard border-b-4 border-black bg-brutal-orange text-black';
            } else {
                statusDiv.className = 'fixed top-0 left-0 right-0 z-[60] p-4 text-center font-bold font-rubik uppercase tracking-widest transition-all duration-300 shadow-hard border-b-4 border-black bg-red-600 text-white';
            }

            statusDiv.classList.remove('hidden');
            statusDiv.classList.remove('-translate-y-full');
            
            setTimeout(() => {
                statusDiv.classList.add('-translate-y-full');
                setTimeout(() => {
                    statusDiv.classList.add('hidden');
                }, 300);
            }, 5000);
        }

        // Form Handler
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const btn = document.getElementById('submit-button');
            const btnText = btn.querySelector('span');
            const originalText = btnText.textContent;
            
            // Validation placeholder check
            if (EMAILJS_PUBLIC_KEY === 'YOUR_PUBLIC_KEY') {
                showStatus("Error: Konfigurasi EmailJS belum diatur.", false);
                return;
            }

            // UI Loading State
            btn.disabled = true;
            btn.classList.add('bg-gray-400', 'border-gray-400', 'cursor-not-allowed');
            btn.classList.remove('hover:bg-brutal-orange', 'hover:shadow-none', 'hover:translate-x-[4px]', 'hover:translate-y-[4px]');
            btnText.textContent = 'MENGIRIM...';
            
            emailjs.init(EMAILJS_PUBLIC_KEY);

            emailjs.sendForm(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, this)
                .then(function() {
                    showStatus('PESAN BERHASIL DIKIRIM!', true);
                    document.getElementById('contact-form').reset();
                }, function(error) {
                    console.error('FAILED...', error);
                    showStatus('GAGAL MENGIRIM. PERIKSA KONEKSI ATAU COBA LAGI.', false);
                })
                .finally(function() {
                    // Reset UI State
                    btn.disabled = false;
                    btnText.textContent = originalText;
                    btn.classList.remove('bg-gray-400', 'border-gray-400', 'cursor-not-allowed');
                    btn.classList.add('bg-black', 'border-black', 'hover:bg-brutal-orange');
                });
        });
    </script>
</body>
</html>