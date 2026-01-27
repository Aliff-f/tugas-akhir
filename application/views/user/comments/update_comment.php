<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbarui Ulasan | Neo-Brutalism</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@300;500;700;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        'brutal-orange': '#FF5500', 
                        'brutal-yellow': '#D6F264',
                        'brutal-gray': '#F3F3F3',
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #ffffff; color: #000; }
        
        /* Neo-Brutalist Utilities */
        .nb-border { border: 3px solid black; }
        .nb-shadow { box-shadow: 6px 6px 0px 0px black; }
        .nb-shadow-hover:hover { box-shadow: 8px 8px 0px 0px black; transform: translate(-2px, -2px); }
        .nb-shadow-active:active { box-shadow: 2px 2px 0px 0px black; transform: translate(2px, 2px); }
        
        .nb-input {
            width: 100%;
            background-color: #fff;
            border: 3px solid black;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: black;
            border-radius: 0;
            transition: all 0.2s ease;
            outline: none;
        }
        .nb-input:focus {
            box-shadow: 4px 4px 0px 0px black;
            transform: translate(-1px, -1px);
            background-color: #fff;
        }
    </style>
</head>
<body class="min-h-screen">

<section class="w-full lg:ps-[280px] bg-white min-h-screen">
    <div class="p-6 md:p-8 space-y-8">
        
        <!-- HEADER SECTION -->
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b-4 border-black pb-6">
                <div class="space-y-2">
                    <a href="<?= base_url('user/comments'); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-gray-600 hover:text-black transition-colors uppercase font-display">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <div>
                         <div class="inline-block bg-brutal-orange border-2 border-black px-3 py-1 text-xs font-bold font-display uppercase tracking-widest mb-2 shadow-[2px_2px_0px_0px_black] text-white">
                            Edit Mode
                        </div>
                        <h1 class="text-4xl md:text-5xl font-display font-black uppercase tracking-tighter leading-none">
                            Perbarui Ulasan
                        </h1>
                        <p class="text-gray-600 font-medium mt-2 max-w-md">
                             Edit detail ulasan dan penilaian Anda untuk produk ini.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pb-12">
            <!-- FORM CARD -->
            <div class="border-3 border-black nb-shadow bg-white overflow-hidden p-6 md:p-8">
                 <div class="mb-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-black text-white flex items-center justify-center text-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)]">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>
                    <h2 class="text-2xl font-display font-black uppercase">Detail Ulasan</h2>
                </div>

                <form action="<?php echo site_url('user/update_add_comment_action_user') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $comment['id'] ?>">
                    <input type="hidden" name="product_id" value="<?php echo $comment['product_id'] ?>">
                    <input type="hidden" name="user_id" value="<?php echo $comment['user_id'] ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        
                        <!-- PRODUCT INFO (READONLY) -->
                         <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-brutal-gray border-3 border-black">
                            <div>
                                <label class="font-display font-bold uppercase text-sm mb-2 block">
                                    <i class="fa-solid fa-box mr-1"></i> Produk
                                </label>
                                <div class="bg-white border-3 border-black p-3 font-bold font-mono shadow-[4px_4px_0px_0px_rgba(0,0,0,0.1)]">
                                    <?php echo $comment['product_name'] ?>
                                </div>
                            </div>
                            <div>
                                <label class="font-display font-bold uppercase text-sm mb-2 block">
                                    <i class="fa-solid fa-user mr-1"></i> Pengguna
                                </label>
                                <div class="bg-white border-3 border-black p-3 font-bold font-mono shadow-[4px_4px_0px_0px_rgba(0,0,0,0.1)]">
                                    <?php echo $comment['user_name']; ?>
                                </div>
                            </div>
                         </div>

                        <!-- INPUT FIELDS -->
                        <div class="lg:col-span-12 space-y-6">
                            
                            <!-- RATING -->
                            <div>
                                <label for="rating" class="font-display font-bold uppercase text-sm mb-2 block">
                                    <i class="fa-solid fa-star text-yellow-500 mr-1"></i> Penilaian (1-5)
                                </label>
                                <div class="relative max-w-xs">
                                    <input type="number" id="rating" name="rating" 
                                           class="nb-input text-lg" 
                                           placeholder="1 - 5" 
                                           value="<?php echo $comment['rating'] ?>" 
                                           min="1" max="5" required
                                           autocomplete="off">
                                    <div class="absolute right-0 top-0 h-full px-3 flex items-center bg-black text-white font-bold text-xs pointer-events-none">
                                        STARS
                                    </div>
                                </div>
                            </div>

                            <!-- COMMENT -->
                            <div>
                                <label for="comment" class="font-display font-bold uppercase text-sm mb-2 block">
                                    Ulasan Anda
                                </label>
                                <textarea id="comment" name="comment" rows="6" 
                                          class="nb-input resize-none leading-relaxed" 
                                          placeholder="Tulis pendapat jujur Anda tentang produk ini..."><?php echo $comment['comment'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="mt-10 pt-6 border-t-4 border-black flex flex-col-reverse md:flex-row justify-end gap-4">
                        <button type="button" onclick="window.location.href = '<?= base_url('user/comments'); ?>';" 
                                class="px-6 py-3 font-bold uppercase border-3 border-black bg-white hover:bg-gray-100 transition-all shadow-[4px_4px_0px_0px_black] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_black] w-full md:w-auto">
                            Batal
                        </button>
                        <button type="submit" name="submit" 
                                class="px-6 py-3 font-bold uppercase border-3 border-black bg-brutal-yellow hover:bg-yellow-300 transition-all shadow-[4px_4px_0px_0px_black] active:translate-y-[2px] active:shadow-[2px_2px_0px_0px_black] w-full md:w-auto">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>
