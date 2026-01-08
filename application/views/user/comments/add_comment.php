<!-- ======= CONTENT SECTION START ======= -->
<section class="w-full lg:ps-[280px] bg-yellow-50 min-h-screen">
    <div class="p-6 md:p-8 space-y-8">
        
        <!-- HEADER -->
        <div class="max-w-4xl mx-auto">
            <div class="border-b-4 border-black pb-6">
                <div class="inline-block bg-orange-500 border-2 border-black px-3 py-1 text-xs font-bold font-display uppercase tracking-widest mb-2 shadow-[2px_2px_0px_0px_black] text-white">
                    Action
                </div>
                <h1 class="text-4xl md:text-5xl font-display font-black uppercase tracking-tighter leading-none">
                    Tulis Ulasan
                </h1>
                <p class="text-gray-700 font-bold mt-2 max-w-md bg-white inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Bagikan pengalaman Anda tentang produk ini.
                </p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white border-3 border-black shadow-[8px_8px_0px_0px_black] p-6 sm:p-10 relative overflow-hidden">
                
                <!-- DECORATION -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-300 rounded-full border-2 border-black z-0"></div>
                <div class="absolute top-20 -right-4 w-12 h-12 bg-black z-0"></div>

                <div class="relative z-10 mb-8">
                    <h2 class="text-2xl font-black text-black uppercase border-l-4 border-black pl-4">
                        Formulir Ulasan
                    </h2>
                </div>

                <form action="" method="post" enctype="multipart/form-data" class="relative z-10 space-y-6">
                    
                    <!-- PRODUCT INFO -->
                    <div class="bg-gray-50 border-2 border-black p-4 flex items-center gap-4 mb-6 shadow-[4px_4px_0px_0px_black]">
                        <img class="w-16 h-16 object-cover border-2 border-black" 
                             src="https://preline.co/assets/img/160x160/img1.jpg" alt="Product">
                        <div>
                            <p class="text-xs font-bold uppercase text-gray-500">Produk yang diulas:</p>
                            <p class="text-lg font-black uppercase leading-none">ADIDAS 4DFWD X PARLEY</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- USERNAME (READONLY) -->
                        <div>
                            <label class="block text-sm font-bold uppercase mb-2">Username</label>
                            <input type="text" 
                                class="w-full py-3 px-4 border-2 border-black bg-gray-100 font-bold text-gray-500 focus:outline-none cursor-not-allowed"
                                name="username" value="salmanabd" readonly>
                        </div>

                        <!-- RATING -->
                        <div>
                            <label class="block text-sm font-bold uppercase mb-2">Rating (1-5)</label>
                            <input type="number" min="1" max="5"
                                class="w-full py-3 px-4 border-2 border-black shadow-[4px_4px_0px_0px_black] focus:shadow-none focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold placeholder-gray-400 focus:bg-yellow-50 outline-none"
                                name="rating" placeholder="Beri nilai 1 - 5" autocomplete="off" required>
                        </div>
                    </div>

                    <!-- COMMENT -->
                    <div>
                        <label class="block text-sm font-bold uppercase mb-2">Komentar Anda</label>
                        <textarea 
                            class="w-full py-3 px-4 border-2 border-black shadow-[4px_4px_0px_0px_black] focus:shadow-none focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-medium placeholder-gray-400 focus:bg-yellow-50 outline-none resize-none"
                            name="comment" rows="6" placeholder="Ceritakan kepuasan Anda terhadap produk ini..." required></textarea>
                    </div>

                    <!-- BUTTONS -->
                    <div class="pt-6 flex flex-col sm:flex-row justify-end gap-4 border-t-2 border-dashed border-gray-300">
                        <button type="button"
                            class="w-full sm:w-auto py-3 px-6 text-sm font-bold uppercase border-2 border-black bg-white text-black shadow-[4px_4px_0px_0px_black] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                            onclick="window.location.href = '<?= base_url('user/comments'); ?>';">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto py-3 px-6 text-sm font-black uppercase border-2 border-black bg-black text-white shadow-[4px_4px_0px_0px_gray] hover:bg-orange-500 hover:text-black hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                            name="submit">
                            Simpan Ulasan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<!-- ======= CONTENT SECTION END ======= -->

<!-- Font Support for Brutalism -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@300;500;700;900&display=swap');
    
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>