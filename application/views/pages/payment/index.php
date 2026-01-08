<?php if ($order_number) : ?>
    <!DOCTYPE html>
    <html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= base_url('public/icons/header/favicon.png'); ?>" type="image/png" sizes="64x64">
        <title><?= $header_title; ?></title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Rubik:wght@400;500;600;700;900&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
        
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Rubik"', 'sans-serif'],
                            mono: ['"Space Grotesk"', 'monospace'],
                        },
                        colors: {
                            'brutal-black': '#000000',
                            'brutal-yellow': '#FFD700',
                            'brutal-orange': '#f28500',
                        },
                        boxShadow: {
                            'hard': '8px 8px 0px 0px #000000',
                        }
                    }
                }
            }
        </script>

        <style>
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee {
                animation: marquee 15s linear infinite;
            }
            .bg-grid {
                background-size: 40px 40px;
                background-image: linear-gradient(to right, #e5e7eb 1px, transparent 1px), linear-gradient(to bottom, #e5e7eb 1px, transparent 1px);
            }
        </style>
    </head>

    <body class="bg-gray-50 text-brutal-black font-sans min-h-screen flex flex-col">

        <div class="bg-brutal-black text-white overflow-hidden py-2 border-b-4 border-black">
            <div class="whitespace-nowrap animate-marquee font-mono font-bold text-sm uppercase">
                PAYMENT SUCCESSFUL // ORDER CONFIRMED // THANK YOU FOR SHOPPING // SOLENUSA OFFICIAL // PAYMENT SUCCESSFUL // ORDER CONFIRMED // THANK YOU FOR SHOPPING //
            </div>
        </div>

        <main class="flex-grow flex items-center justify-center p-4 bg-grid">
            
            <div class="relative w-full max-w-lg group">
                <div class="absolute inset-0 bg-brutal-black translate-x-3 translate-y-3 rounded-none"></div>
                
                <div class="relative bg-white border-4 border-brutal-black p-8 md:p-10 text-center flex flex-col items-center transition-transform duration-300 hover:-translate-y-1 hover:-translate-x-1">
                    
                    <div class="w-24 h-24 bg-brutal-yellow border-4 border-black rounded-full flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_#000]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <h1 class="font-black text-4xl md:text-5xl uppercase leading-none mb-2 tracking-tighter">
                        Order<br>Confirmed!
                    </h1>
                    <p class="font-mono text-gray-500 text-sm md:text-base uppercase mb-8">
                        Terima kasih, pesanan Anda telah kami terima.
                    </p>

                    <div class="w-full bg-gray-50 border-4 border-black border-dashed p-6 mb-8 relative">
                        <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-r-4 border-black rounded-full"></div>
                        <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-l-4 border-black rounded-full"></div>

                        <p class="font-mono text-xs text-gray-500 uppercase mb-2">Order ID Reference</p>
                        <div class="bg-brutal-black text-white font-mono text-2xl md:text-3xl font-bold py-2 px-4 inline-block transform -rotate-2">
                            #<?php echo $order_number; ?>
                        </div>
                        <p class="font-mono text-xs text-gray-500 uppercase mt-4">
                            Email konfirmasi telah dikirim.
                        </p>
                    </div>

                    <button type="button"
                        class="w-full bg-brutal-black text-white font-bold text-lg py-4 border-4 border-transparent hover:bg-brutal-orange hover:text-white hover:border-black transition-all uppercase tracking-widest shadow-[4px_4px_0px_0px_#000000] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]"
                        onclick="location.href='<?= base_url('home'); ?>'">
                        Back to Home
                    </button>

                    <div class="mt-6 text-xs font-mono text-gray-400">
                        SOLENUSA &copy; <?= date('Y'); ?> // ALL RIGHTS RESERVED
                    </div>
                </div>
            </div>

        </main>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </body>

    </html>
<?php else : ?>
    <script>
        window.location.href = "<?php echo base_url('home'); ?>";
    </script>
<?php endif; ?>