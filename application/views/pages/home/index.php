<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLENUSA- Home</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;900&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    
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
                            black: '#000000',
                            white: '#FFFFFF',
                            orange: '#f28500', 
                            yellow: '#FFFF00',
                            blue: '#4a69bd',
                            grey: '#f5f5f5'
                        }
                    },
                    boxShadow: {
                        'hard': '4px 4px 0px 0px #000000', 
                        'hard-yellow': '8px 8px 0px 0px #FFFF00',
                        'hard-white': '4px 4px 0px 0px #FFFFFF',
                        'hard-orange': '4px 4px 0px 0px #f28500',
                        'hard-sm': '2px 2px 0px 0px #000000',
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Swiper Styles */
        .swiper-button-next, .swiper-button-prev {
            color: #000 !important;
            background: #FFFF00;
            width: 44px !important;
            height: 44px !important;
            border: 3px solid #000;
            box-shadow: 4px 4px 0px 0px #000;
            transition: all 0.2s;
            z-index: 50;
            opacity: 1 !important;
        }
        
        /* Hide arrows on mobile to save space */
        @media (max-width: 640px) {
            .swiper-button-next, .swiper-button-prev {
                display: none !important;
            }
        }

        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 18px !important;
            font-weight: 900;
        }

        .swiper-button-next:active, .swiper-button-prev:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000;
        }

        .swiper-pagination {
            z-index: 50 !important;
            bottom: 10px !important;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #fff;
            opacity: 1;
            border: 2px solid #000;
            border-radius: 0;
            margin: 0 6px !important;
        }

        .swiper-pagination-bullet-active {
            background: #f28500;
            transform: scale(1.2);
        }

        .text-stroke-white {
            -webkit-text-stroke: 2px white;
        }
        .text-stroke-0 {
            -webkit-text-stroke: 0;
        }

        .hero-swiper {
            width: 100%;
            height: 100%;
        }
        
        .swiper-slide {
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-white font-sans overflow-x-hidden">
    
    <div id="mobile-menu" class="fixed inset-0 bg-brutal-black z-40 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-center items-center border-l-8 border-brutal-yellow">
         <nav class="flex flex-col space-y-6 text-center">
            <a href="<?= site_url('home'); ?>" class="mobile-link text-4xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300">Home</a>
            <a href="<?= site_url('produk'); ?>" class="mobile-link text-4xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300">Produk</a>
            <a href="<?= site_url('tentang'); ?>" class="mobile-link text-4xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300">Tentang</a>
            <a href="<?= site_url('kontak'); ?>" class="mobile-link text-4xl font-black text-transparent text-stroke-white uppercase tracking-tighter hover:text-brutal-orange hover:text-stroke-0 transition-all duration-300">Kontak</a>
        </nav>
        
        <div class="mt-10 flex space-x-6">
            <button onclick="location.href='<?= site_url('keranjang'); ?>'" class="relative w-16 h-16 bg-brutal-white border-4 border-brutal-white text-black shadow-hard-orange transition-all hover:translate-x-[6px] hover:translate-y-[6px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange flex items-center justify-center group">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter" class="transition-colors"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <div class="absolute -top-2 -right-2 w-7 h-7 bg-red-600 border-2 border-black shadow-hard-sm flex items-center justify-center rounded-full z-10"><span class="text-white text-xs font-black">3</span></div>
            </button>
            <button onclick="location.href='<?= site_url('masuk'); ?>'" class="w-16 h-16 bg-brutal-white border-4 border-brutal-white text-black shadow-hard-orange transition-all hover:translate-x-[6px] hover:translate-y-[6px] hover:shadow-none hover:bg-brutal-orange hover:text-white hover:border-brutal-orange flex items-center justify-center group">
                 <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square" stroke-linejoin="miter" class="transition-colors"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </button>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 mt-24 md:mt-32 lg:mt-40 mb-16 md:mb-20 space-y-16 md:space-y-24">
        
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <div class="border-4 border-brutal-black p-6 md:p-8 lg:p-12 shadow-hard bg-brutal-grey h-full flex flex-col justify-center order-2 lg:order-1">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black uppercase mb-4 md:mb-6 leading-none">
                    Solenusa <br>
                    <span class="bg-brutal-orange px-2 text-white inline-block mt-1">Store</span>
                </h1>
                <p class="text-lg md:text-2xl font-bold border-l-8 border-brutal-yellow pl-4 md:pl-6 mb-6 md:mb-8 max-w-2xl font-rubik">
                    Sepatu brand lokal Indonesia dengan gaya, kenyamanan, dan kualitas terbaik. SOLENUSA STORE untuk kamu yang bangga melangkah dengan produk dalam negeri.                </p>
                <div class="mt-2 md:mt-8">
                    <button type="button" 
                        class="w-full md:w-auto bg-brutal-black text-white text-lg md:text-xl font-bold py-3 md:py-4 px-8 md:px-10 border-4 border-transparent hover:bg-white hover:text-black hover:border-brutal-black hover:shadow-hard transition-all duration-300 transform hover:-rotate-1"
                        onclick="location.href='<?= site_url('produk'); ?>'">
                        Lihat Koleksi
                    </button>
                </div>
            </div>

            <div class="order-1 lg:order-2 relative w-full h-[300px] md:h-[400px] lg:h-[500px] border-4 border-brutal-black shadow-hard bg-white p-2">
                <div class="swiper hero-swiper w-full h-full relative z-10">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?= base_url('public/images/home/banner-1.png'); ?>" class="block w-full h-full object-cover" alt="slider-image-1"></div>
                        <div class="swiper-slide"><img src="<?= base_url('public/images/home/banner-2.png'); ?>" class="block w-full h-full object-cover" alt="slider-image-2"></div>
                        <div class="swiper-slide"><img src="<?= base_url('public/images/home/banner-3.png'); ?>" class="block w-full h-full object-cover" alt="slider-image-3"></div>
                        <div class="swiper-slide"><img src="<?= base_url('public/images/home/banner-4.png'); ?>" class="block w-full h-full object-cover" alt="slider-image-4"></div>
                        <div class="swiper-slide"><img src="<?= base_url('public/images/home/banner-5.png'); ?>" class="block w-full h-full object-cover" alt="slider-image-5"></div>
                        <div class="swiper-slide"><img src="<?= base_url('public/images/home/banner-6.png'); ?>" class="block w-full h-full object-cover" alt="slider-image-6"></div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="absolute -bottom-4 -right-4 md:-bottom-6 md:-right-6 w-16 h-16 md:w-24 md:h-24 bg-brutal-yellow border-4 border-black shadow-hard z-30 flex items-center justify-center rounded-full font-black text-lg md:text-2xl rotate-12 pointer-events-none">
                    NEW!
                </div>
            </div>
        </section>

        <section class="flex flex-col items-center justify-center gap-6 md:gap-8">
            <h3 class="font-sans text-2xl md:text-4xl lg:text-5xl font-black uppercase text-brutal-black bg-brutal-orange px-4 md:px-6 py-2 border-4 border-black shadow-hard transform -rotate-1">
                BRANDS KAMI
            </h3>
            
            <div class="w-full border-4 border-brutal-black p-6 md:p-8 bg-white shadow-hard">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-8 items-center justify-items-center">
                    <img src="<?= base_url('public/images/home/ventela.png'); ?>" class="block w-full max-w-[100px] md:max-w-[120px] grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer hover:scale-110" alt="ventela">
                    <img src="<?= base_url('public/images/home/cavallero.png'); ?>" class="block w-full max-w-[100px] md:max-w-[120px] grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer hover:scale-110" alt="cavallero">
                    <img src="<?= base_url('public/images/home/eiger.png'); ?>" class="block w-full max-w-[100px] md:max-w-[120px] grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer hover:scale-110" alt="eiger">
                    <img src="<?= base_url('public/images/home/aero.png'); ?>" class="block w-full max-w-[100px] md:max-w-[120px] grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer hover:scale-110" alt="aero">
                    <img src="<?= base_url('public/images/home/compass.png'); ?>" class="block w-full max-w-[100px] md:max-w-[120px] grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer hover:scale-110" alt="compass">
                    <img src="<?= base_url('public/images/home/miles.png'); ?>" class="block w-full max-w-[100px] md:max-w-[120px] grayscale hover:grayscale-0 transition-all duration-300 cursor-pointer hover:scale-110" alt="miles">
                </div>
            </div>
        </section>

        <section class="flex flex-col gap-8">
            <div class="flex flex-col md:flex-row gap-6 items-center justify-between text-center md:text-left">
                <h3 class="font-sans font-black text-3xl md:text-5xl uppercase leading-none">
                    Jangan lewatkan, <br>
                    <span class="text-transparent" style="-webkit-text-stroke: 1.5px black;">produk terbaru</span>
                </h3>
                <button type="button" 
                    class="bg-brutal-blue text-white font-bold py-3 px-8 border-4 border-black shadow-hard hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all w-full md:w-auto"
                    onclick="location.href='<?= site_url('produk'); ?>'">
                    LIHAT SEMUA
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php if(!empty($recent_products)): foreach ($recent_products as $key => $item): ?>
                <div class="border-4 border-black bg-white p-4 shadow-hard flex flex-col gap-4 group hover:-translate-y-2 transition-transform duration-300">
                    <div class="bg-gray-100 border-2 border-black h-[200px] overflow-hidden">
                        <img src="<?= base_url('public/uploads/' . $item['image_url']); ?>" alt="product" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-rubik font-bold text-lg uppercase truncate"><?= $item['name']; ?></h4>
                    </div>
                    <div class="mt-auto flex justify-between items-center">
                        <span class="font-black text-lg bg-brutal-yellow px-2 border-2 border-black">Rp <?= number_format($item['price'], 0, ',', '.'); ?></span>
                        <button class="bg-black text-white p-2 hover:bg-brutal-orange transition-colors" onclick="window.location.href = '<?= site_url('detail_produk/' . $item['id']); ?>'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
                <?php endforeach; else: ?>
                    <div class="border-4 border-black bg-white p-4 shadow-hard flex flex-col gap-4 group hover:-translate-y-2 transition-transform duration-300">
                        <div class="bg-gray-100 border-2 border-black h-[200px] overflow-hidden">
                            <img src="<?= base_url('public/images/home/banner-6.png'); ?>" alt="Product" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-rubik font-bold text-lg uppercase truncate">Nike Air Jordan</h4>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="font-black text-lg bg-brutal-yellow px-2 border-2 border-black">Rp 2.500k</span>
                            <button class="bg-black text-white p-2 hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="border-4 border-black bg-white p-4 shadow-hard flex flex-col gap-4 group hover:-translate-y-2 transition-transform duration-300">
                        <div class="bg-gray-100 border-2 border-black h-[200px] overflow-hidden">
                            <img src="<?= base_url('public/images/home/banner-1.png'); ?>" alt="Product" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-rubik font-bold text-lg uppercase truncate">Adidas Fury</h4>
                        </div>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="font-black text-lg bg-brutal-yellow px-2 border-2 border-black">Rp 1.800k</span>
                            <button class="bg-black text-white p-2 hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="flex flex-col gap-8">
            <h3 class="font-sans font-black text-3xl md:text-4xl uppercase text-center md:text-left decoration-4 decoration-brutal-orange underline underline-offset-8">
                Kategori Pilihan
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                
                <div class="group cursor-pointer" onclick="window.location.href = '<?= site_url('produk/filter/category/1'); ?>'">
                    <div class="relative bg-white border-4 border-black shadow-hard transition-all duration-300 group-hover:shadow-none group-hover:translate-x-[4px] group-hover:translate-y-[4px]">
                        <div class="h-48 md:h-56 lg:h-64 w-full border-b-4 border-black overflow-hidden relative">
                            <img src="<?= base_url('public/images/home/banner-6.png'); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110" alt="Sport">
                            <!-- <div class="absolute top-2 right-2 bg-black text-white text-xs font-bold px-2 py-1 uppercase transform rotate-2">Sport</div> -->
                        </div>
                        <div class="p-4 flex justify-between items-center bg-brutal-white group-hover:bg-brutal-yellow transition-colors duration-300">
                            <h4 class="font-black text-xl md:text-2xl uppercase italic">Sport Shoes</h4>
                            <div class="bg-black text-white p-2 group-hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group cursor-pointer" onclick="window.location.href = '<?= site_url('produk/filter/category/2'); ?>'">
                    <div class="relative bg-white border-4 border-black shadow-hard transition-all duration-300 group-hover:shadow-none group-hover:translate-x-[4px] group-hover:translate-y-[4px]">
                        <div class="h-48 md:h-56 lg:h-64 w-full border-b-4 border-black overflow-hidden relative">
                            <img src="<?= base_url('public/images/home/banner-1.png'); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110" alt="Sneakers">
                            <!-- <div class="absolute top-2 right-2 bg-black text-white text-xs font-bold px-2 py-1 uppercase transform rotate-2">Trend</div> -->
                        </div>
                        <div class="p-4 flex justify-between items-center bg-brutal-white group-hover:bg-brutal-yellow transition-colors duration-300">
                            <h4 class="font-black text-xl md:text-2xl uppercase italic">Sneakers</h4>
                            <div class="bg-black text-white p-2 group-hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group cursor-pointer" onclick="window.location.href = '<?= site_url('products/filter/category/3'); ?>'">
                    <div class="relative bg-white border-4 border-black shadow-hard transition-all duration-300 group-hover:shadow-none group-hover:translate-x-[4px] group-hover:translate-y-[4px]">
                        <div class="h-48 md:h-56 lg:h-64 w-full border-b-4 border-black overflow-hidden relative">
                            <img src="<?= base_url('public/images/home/banner-5.png'); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110" alt="Casual">
                        </div>
                        <div class="p-4 flex justify-between items-center bg-brutal-white group-hover:bg-brutal-yellow transition-colors duration-300">
                            <h4 class="font-black text-xl md:text-2xl uppercase italic">Casual</h4>
                            <div class="bg-black text-white p-2 group-hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group cursor-pointer" onclick="window.location.href = '<?= site_url('products/filter/category/4'); ?>'">
                    <div class="relative bg-white border-4 border-black shadow-hard transition-all duration-300 group-hover:shadow-none group-hover:translate-x-[4px] group-hover:translate-y-[4px]">
                        <div class="h-48 md:h-56 lg:h-64 w-full border-b-4 border-black overflow-hidden relative">
                            <img src="<?= base_url('public/images/home/banner-2.png'); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110" alt="Formal">
                        </div>
                        <div class="p-4 flex justify-between items-center bg-brutal-white group-hover:bg-brutal-yellow transition-colors duration-300">
                            <h4 class="font-black text-xl md:text-2xl uppercase italic">Formal</h4>
                            <div class="bg-black text-white p-2 group-hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group cursor-pointer" onclick="window.location.href = '<?= site_url('products/filter/category/5'); ?>'">
                    <div class="relative bg-white border-4 border-black shadow-hard transition-all duration-300 group-hover:shadow-none group-hover:translate-x-[4px] group-hover:translate-y-[4px]">
                        <div class="h-48 md:h-56 lg:h-64 w-full border-b-4 border-black overflow-hidden relative">
                            <img src="<?= base_url('public/images/home/banner-3.png'); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110" alt="Outdoor">
                            <!-- <div class="absolute top-2 right-2 bg-black text-white text-xs font-bold px-2 py-1 uppercase transform rotate-2">Tough</div> -->
                        </div>
                        <div class="p-4 flex justify-between items-center bg-brutal-white group-hover:bg-brutal-yellow transition-colors duration-300">
                            <h4 class="font-black text-xl md:text-2xl uppercase italic">Outdoor</h4>
                            <div class="bg-black text-white p-2 group-hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group cursor-pointer" onclick="window.location.href = '<?= site_url('products/filter/category/7'); ?>'">
                    <div class="relative bg-white border-4 border-black shadow-hard transition-all duration-300 group-hover:shadow-none group-hover:translate-x-[4px] group-hover:translate-y-[4px]">
                        <div class="h-48 md:h-56 lg:h-64 w-full border-b-4 border-black overflow-hidden relative">
                            <img src="<?= base_url('public/images/home/banner-4.png'); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110" alt="School">
                        </div>
                        <div class="p-4 flex justify-between items-center bg-brutal-white group-hover:bg-brutal-yellow transition-colors duration-300">
                            <h4 class="font-black text-xl md:text-2xl uppercase italic">School</h4>
                            <div class="bg-black text-white p-2 group-hover:bg-brutal-orange transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="miter"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Swiper Configuration
            var swiper = new Swiper(".hero-swiper", {
                loop: true,
                effect: 'fade', 
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 4000, 
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                observer: true, 
                observeParents: true,
            });

            // Mobile Menu Logic
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const bar1 = document.getElementById('bar1');
            const bar2 = document.getElementById('bar2');
            const bar3 = document.getElementById('bar3');
            let isMenuOpen = false;

            btn.addEventListener('click', () => {
                isMenuOpen = !isMenuOpen;
                if (isMenuOpen) {
                    menu.classList.remove('translate-x-full');
                    document.body.style.overflow = 'hidden';
                    bar1.classList.add('rotate-45', 'translate-y-2');
                    bar2.classList.add('opacity-0');
                    bar3.classList.add('-rotate-45', '-translate-y-2');
                } else {
                    menu.classList.add('translate-x-full');
                    document.body.style.overflow = 'auto';
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
        });
    </script>
</body>
</html>