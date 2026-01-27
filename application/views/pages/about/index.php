<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLENUSA - Tentang Kami</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&family=Rubik:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                        rubik: ['"Rubik"', 'sans-serif'],
                        mono: ['"Courier New"', 'monospace'],
                    },
                    colors: {
                        brutal: {
                            black: '#121212', 
                            white: '#FFFFFF',
                            orange: '#F58600', 
                            grey: '#F3F4F6'
                        }
                    },
                    animation: {
                        'marquee': 'marquee 20s linear infinite',
                    },
                    keyframes: {
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-100%)' },
                        }
                    },
                    backgroundImage: {
                        'barcode': "url(\"data:image/svg+xml,%3Csvg width='100' height='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M2 0h2v20H2zm4 0h1v20H6zm3 0h3v20H9zm5 0h1v20h-1zm4 0h2v20h-2zm4 0h1v20h-1zm3 0h2v20h-2zm4 0h2v20h-2zm4 0h1v20h-1zm3 0h3v20h-3zm5 0h1v20h-1zm3 0h2v20h-2z' fill='%23000' fill-rule='evenodd'/%3E%3C/svg%3E\")",
                    }
                }
            }
        }
    </script>

    <style>
        .text-stroke-black { -webkit-text-stroke: 1px black; }
        .text-stroke-0 { -webkit-text-stroke: 0; }
        
        .bg-pattern-dot {
            background-image: radial-gradient(#000 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="bg-white font-sans text-brutal-black selection:bg-brutal-orange selection:text-white overflow-x-hidden">

    <main class="mt-24 md:mt-32">

        <section class="container max-w-7xl mx-auto px-4 mb-20 md:mb-24">
            <div class="flex flex-col-reverse lg:flex-row gap-12 lg:gap-20 items-center">
                
                <div class="w-full lg:w-1/2 text-center lg:text-left relative">
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-pattern-dot rounded-full z-0 hidden lg:block"></div>
                    
                    <h1 class="font-rubik font-black text-6xl md:text-7xl lg:text-8xl text-brutal-black uppercase tracking-tighter leading-[0.9] mb-8 relative z-10">
                        SOLE
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brutal-orange to-red-600" style="-webkit-text-stroke: 2px black;">NUSA.</span>
                    </h1>

                    <div class="border-l-4 border-brutal-black pl-6 md:pl-8 space-y-6 text-left relative z-10">
                        <p class="font-rubik font-bold text-xl md:text-3xl leading-tight text-gray-800">
                            "Kualitas Lokal, <br>Standar Global."
                        </p>
                        <p class="font-sans font-medium text-base md:text-lg text-gray-600 leading-relaxed">
Sepatu pilihan dari brand lokal Indonesia dengan gaya, kenyamanan, dan kualitas terbaik. SOLENUSA STORE untuk kamu yang bangga melangkah dengan produk dalam negeri.                        </p>
                        <div class="pt-2">
                            <span class="font-bold bg-brutal-grey text-black px-3 py-1 border border-black inline-block text-sm">#LokalItuKeren</span>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 relative group">
                    <div class="absolute top-3 left-3 w-full h-full bg-gray-200 border-2 border-brutal-black z-0"></div>
                    
                    <div class="relative bg-white border-2 border-brutal-black p-2 z-10 transition-transform duration-300 group-hover:-translate-y-1 group-hover:-translate-x-1">
                        <div class="relative overflow-hidden border border-brutal-black h-[300px] md:h-[450px]">
                            <img src="<?= base_url('public/images/about.jpg'); ?>" 
                                 class="block w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" 
                                 alt="Sole Nusa Team">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-brutal-yellow border-y-4 border-brutal-black overflow-hidden py-4 mb-24 rotate-1 scale-105 shadow-[0px_4px_0px_0px_#000]">
            <div class="whitespace-nowrap animate-marquee">
                <span class="text-3xl font-black mx-4 uppercase">/// ORIGINAL LOCAL BRAND ///</span>
                <span class="text-3xl font-black mx-4 uppercase text-transparent text-stroke-black">SUPPORT LOCAL CREATORS</span>
                <span class="text-3xl font-black mx-4 uppercase">/// ORIGINAL LOCAL BRAND ///</span>
                <span class="text-3xl font-black mx-4 uppercase text-transparent text-stroke-black">SUPPORT LOCAL CREATORS</span>
                <span class="text-3xl font-black mx-4 uppercase">/// ORIGINAL LOCAL BRAND ///</span>
                <span class="text-3xl font-black mx-4 uppercase text-transparent text-stroke-black">SUPPORT LOCAL CREATORS</span>
            </div>
        </div>

        <section class="container max-w-7xl mx-auto px-4 mb-32">
            
            <div class="flex flex-col md:flex-row items-start md:items-end gap-6 mb-12 border-b-2 border-black pb-4">
                 <h2 class="font-rubik font-black text-5xl md:text-6xl uppercase tracking-tighter leading-none relative">
                    Impact Kami
                </h2>
                <div class="font-mono text-sm text-gray-500 mb-2 md:ml-auto">
                    UPDATED DATA: <?= date('Y'); ?>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-black translate-x-2 translate-y-2 group-hover:translate-x-3 group-hover:translate-y-3 transition-transform duration-300"></div>
                    
                    <div class="relative h-full bg-white border-4 border-black p-8 flex flex-col justify-between transition-all duration-300 group-hover:-translate-y-1 group-hover:-translate-x-1 group-hover:bg-brutal-orange">
                        
                        <div class="flex justify-between items-center mb-6 border-b-2 border-black pb-4">
                            <span class="font-rubik font-bold text-3xl">01</span>
                            <div class="h-6 w-16 bg-barcode opacity-60"></div>
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-rubik font-black text-6xl text-brutal-orange mb-4 transition-colors duration-300 group-hover:text-white">20+</h3>
                            
                            <div class="inline-block border-2 border-black px-3 py-1 text-sm font-bold uppercase mb-4 tracking-wider bg-white transition-colors duration-300 group-hover:bg-black group-hover:text-white">
                                BRANDS
                            </div>
                            
                            <p class="font-mono text-sm text-gray-600 leading-relaxed transition-colors duration-300 group-hover:text-black">
                                Kurasi ketat dari berbagai brand lokal terbaik. Variasi gaya untuk setiap karakter.
                            </p>
                        </div>

                        <div class="mt-8 pt-4 border-t-2 border-dashed border-gray-300 group-hover:border-black/50 flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-500 group-hover:text-black">Available Now</span>
                        </div>
                    </div>
                </div>

                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-black translate-x-2 translate-y-2 group-hover:translate-x-3 group-hover:translate-y-3 transition-transform duration-300"></div>
                    
                    <div class="relative h-full bg-white border-4 border-black p-8 flex flex-col justify-between transition-all duration-300 group-hover:-translate-y-1 group-hover:-translate-x-1 group-hover:bg-brutal-orange">
                        
                        <div class="flex justify-between items-center mb-6 border-b-2 border-black pb-4">
                            <span class="font-rubik font-bold text-3xl">02</span>
                            <div class="border border-black rounded-full px-3 py-1 text-[10px] uppercase tracking-wider bg-white group-hover:bg-black group-hover:text-white transition-colors">Top Stats</div>
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-rubik font-black text-6xl text-brutal-orange mb-4 transition-colors duration-300 group-hover:text-white">150+</h3>
                            
                            <div class="inline-block border-2 border-black px-3 py-1 text-sm font-bold uppercase mb-4 tracking-wider bg-white transition-colors duration-300 group-hover:bg-black group-hover:text-white">
                                TERJUAL
                            </div>
                            
                            <p class="font-mono text-sm text-gray-600 leading-relaxed transition-colors duration-300 group-hover:text-black">
                                Produk berkualitas yang telah mendarat di kaki pelanggan di seluruh Indonesia.
                            </p>
                        </div>

                        <div class="mt-8 flex justify-between gap-1 opacity-40 group-hover:opacity-60">
                            <div class="h-4 w-1/4 bg-barcode"></div>
                            <div class="h-4 w-1/4 bg-barcode"></div>
                            <div class="h-4 w-1/4 bg-barcode"></div>
                        </div>
                    </div>
                </div>

                <div class="relative group h-full">
                    <div class="absolute inset-0 bg-black translate-x-2 translate-y-2 group-hover:translate-x-3 group-hover:translate-y-3 transition-transform duration-300"></div>
                    
                    <div class="relative h-full bg-white border-4 border-black p-8 flex flex-col justify-between transition-all duration-300 group-hover:-translate-y-1 group-hover:-translate-x-1 group-hover:bg-brutal-orange">
                        
                        <div class="flex justify-between items-center mb-6 border-b-2 border-black pb-4">
                            <span class="font-rubik font-bold text-3xl">03</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-rubik font-black text-6xl text-brutal-orange mb-4 transition-colors duration-300 group-hover:text-white">100+</h3>
                            
                            <div class="inline-block border-2 border-black px-3 py-1 text-sm font-bold uppercase mb-4 tracking-wider bg-white transition-colors duration-300 group-hover:bg-black group-hover:text-white">
                                CUSTOMERS
                            </div>
                            
                            <p class="font-mono text-sm text-gray-600 leading-relaxed transition-colors duration-300 group-hover:text-black">
                                Komunitas yang terus tumbuh. Kepercayaan adalah prioritas utama kami.
                            </p>
                        </div>

                        <div class="mt-8 pt-4 border-t-2 border-dashed border-gray-300 group-hover:border-black/50 flex items-center gap-1">
                            <span class="text-xs font-black uppercase text-gray-500 group-hover:text-black">★★★★★ RATED</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

</body>
</html>