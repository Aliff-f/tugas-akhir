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
                COMPLETE YOUR PAYMENT // SECURE TRANSACTION // SOLENUSA OFFICIAL // CHOOSE YOUR PAYMENT METHOD // COMPLETE YOUR PAYMENT // SECURE TRANSACTION //
            </div>
        </div>

        <main class="flex-grow flex items-center justify-center p-4 bg-grid">
            
            <div class="relative w-full max-w-lg group">
                <div class="absolute inset-0 bg-brutal-black translate-x-3 translate-y-3 rounded-none"></div>
                
                <div class="relative bg-white border-4 border-brutal-black p-8 md:p-10 text-center flex flex-col items-center transition-transform duration-300 hover:-translate-y-1 hover:-translate-x-1">
                    
                    <div class="w-24 h-24 bg-brutal-yellow border-4 border-black rounded-full flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_#000]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>

                    <h1 class="font-black text-4xl md:text-5xl uppercase leading-none mb-2 tracking-tighter">
                        Satu Langkah<br>Lagi!
                    </h1>
                    <p class="font-mono text-gray-500 text-sm md:text-base uppercase mb-8">
                        Silakan selesaikan pembayaran Anda.
                    </p>

                    <div class="w-full bg-gray-50 border-4 border-black p-6 mb-8 relative text-left">
                        <div class="flex justify-between items-center mb-4 border-b-2 border-black border-dotted pb-2">
                             <p class="font-mono text-xs text-gray-500 uppercase">Order ID</p>
                             <p class="font-mono text-sm font-bold">#<?php echo $order_number; ?></p>
                        </div>
                        
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="font-mono text-xs text-gray-500 uppercase">Total Tagihan</p>
                                <p class="font-rubik font-black text-2xl text-brutal-orange">
                                    Rp <?= number_format($gross_amount, 0, ',', '.'); ?>
                                </p>
                            </div>
                            <div class="bg-brutal-yellow border-2 border-black px-2 py-1 font-mono text-[10px] font-bold uppercase rotate-3">
                                Pending
                            </div>
                        </div>
                    </div>

                    <div class="w-full space-y-3">
                        <?php if (!empty($snapToken)): ?>
                        <button type="button" id="pay-button"
                            class="w-full bg-brutal-black text-white font-bold text-lg py-4 border-4 border-transparent hover:bg-brutal-yellow hover:text-black hover:border-black transition-all uppercase tracking-widest shadow-[4px_4px_0px_0px_#000000] active:shadow-none active:translate-x-[2px] active:translate-y-[2px] flex items-center justify-center gap-3">
                            <span>BAYAR SEKARANG</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                        <?php else: ?>
                        <div class="bg-red-100 border-4 border-red-600 p-4 text-red-600 font-bold font-mono text-xs uppercase">
                            Gagal memuat sistem pembayaran. Silakan segarkan halaman.
                        </div>
                        <?php endif; ?>

                        <button type="button"
                            class="w-full bg-white text-black font-bold text-sm py-3 border-4 border-black hover:bg-gray-100 transition-all uppercase tracking-wider"
                            onclick="location.href='<?= base_url('home'); ?>'">
                            Nanti Saja
                        </button>
                    </div>

                    <div class="mt-6 text-xs font-mono text-gray-400">
                        SOLENUSA &copy; <?= date('Y'); ?> // SECURE PAYMENT BY MIDTRANS
                    </div>
                </div>
            </div>

        </main>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $clientKey ?>"></script>
        <script type="text/javascript">
            const payButton = document.getElementById('pay-button');
            if (payButton) {
                payButton.onclick = function () {
                    window.snap.pay('<?= $snapToken ?>', {
                        onSuccess: function (result) {
                            // Sync status with server manually as fallback for local dev/webhook issues
                            fetch('<?= base_url("notification/check_status/" . $order_number) ?>?status=completed');
                            
                            Swal.fire({
                                title: "Pembayaran Berhasil!",
                                text: "Pesanan Anda sedang diproses.",
                                icon: "success",
                                confirmButtonColor: "#000000",
                            }).then(() => {
                                window.location.href = '<?= base_url("akun/dashboard") ?>';
                            });
                        },
                        onPending: function (result) {
                            // Sync status with server
                            fetch('<?= base_url("notification/check_status/" . $order_number) ?>?status=pending');
                            
                            Swal.fire({
                                title: "Menunggu Pembayaran",
                                text: "Silakan selesaikan pembayaran sesuai instruksi.",
                                icon: "info",
                                confirmButtonColor: "#000000",
                            }).then(() => {
                                window.location.href = '<?= base_url("user/dashboard") ?>';
                            });
                        },
                        onError: function (result) {
                            Swal.fire({
                                title: "Pembayaran Gagal!",
                                text: "Terjadi kesalahan saat memproses pembayaran.",
                                icon: "error",
                                confirmButtonColor: "#000000",
                            });
                        },
                        onClose: function () {
                            console.log('Customer closed the popup without finishing the payment');
                        }
                    });
                };
            }
        </script>
    </body>

    </html>
<?php else : ?>
    <script>
        window.location.href = "<?php echo base_url('home'); ?>";
    </script>
<?php endif; ?>
