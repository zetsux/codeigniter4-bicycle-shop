<?php

$imageUrl = base_url('images/hujan_cover.jpeg');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <?php echo view('layouts/navbar') ?>
    <main class="min-h-screen w-10/12 mx-auto">
        <section class="h-screen flex items-center gap-4">
            <div class="space-y-6 shrink-0">
                <h1 class="font-extrabold text-5xl max-w-sm leading-tight break-none">Nature Love <span class="text-sky-600">Bicycle</span></h1>
                <p class="font-semibold">The best bicycle with the best price offer in Indoesia</p>
                <p class="text-xs font-light max-w-sm">Custom your own bicycle with no extra charges and free monthly services plus a full year warranty with us. Get it now in our official store or buy it here!</p>
                <button type="button" id="scrollBtn" class="flex items-center shadow-sm hover:bg-slate-50">
                    <div class="bg-sky-600 text-white w-10 h-10 flex items-center justify-center">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="px-4">Check out catalog</div>
                </button>
            </div>
            <div class="w-11/12">
                <img src="/images/bike-2.png" alt="">
            </div>
        </section>
        <section id="catalog" class="min-h-screen">
            <h2 class="text-5xl font-bold text-center">Our Collections</h2>
            <div class="flex flex-wrap gap-4 mt-10">
                <?php foreach ($bikes as $bike) : ?>
                    <div class="w-full max-w-sm shadow-sm rounded">
                        <div class="bg-slate-50 overflow-clip px-3">
                            <img src="<?= $bike['image'] ?>" alt="" height="100">
                        </div>
                        <div class="p-4 space-y-2.5">
                            <div class="space-y-1">
                                <div class="flex items-center justify-between">
                                    <p class="uppercase text-slate-400"><?= $bike['category'] ?></p>
                                    <p class="text-slate-400">Stock : <?= $bike['stock'] ?></p>
                                </div>
                                <p class="font-semibold text-lg"><?= $bike['name'] ?></p>
                            </div>
                            <div class="space-y-4">
                                <p class="text-sm font-light line-clamp-3 h-14"><?= $bike['description'] ?></p>
                                <div class="h-px w-full bg-slate-300"></div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm truncate"><?= $bike['brand'] ?></p>
                                    <p class="text-sm">Rp <?= $bike['price'] ?></p>
                                </div>
                            </div>
                            <a href="/bike/<?= $bike['id'] ?>" class="w-full flex items-center justify-center py-2 px-4 rounded bg-slate-400 hover:bg-slate-500 text-white">Lihat Detail</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
        <!-- <aside class="w-[15rem] shrink-0">
            <p class="text-xl font-semibold">Filter</p>
            <div class="mt-3">
                <div class="flex items-center justify-between py-2.5 border-b">
                    <p class="text-slate-600">Kategori</p>
                    <img src="https://cdn.discordapp.com/attachments/1032505826885238864/1177650336941486141/down_2.png?ex=65734758&is=6560d258&hm=1d5ab7ddfadeb4b79cd069b9d91f2dff2587d4a1c43a2b0c9ea2c59d4b4bc26b&" alt="" width="20px">
                </div>
                <div class="flex items-center justify-between py-2.5 border-b">
                    <p class="text-slate-600">Rating</p>
                    <img src="https://cdn.discordapp.com/attachments/1032505826885238864/1177650336941486141/down_2.png?ex=65734758&is=6560d258&hm=1d5ab7ddfadeb4b79cd069b9d91f2dff2587d4a1c43a2b0c9ea2c59d4b4bc26b&" alt="" width="20px">
                </div>
                <div class="flex items-center justify-between py-2.5 border-b">
                    <p class="text-slate-600">Harga</p>
                    <img src="https://cdn.discordapp.com/attachments/1032505826885238864/1177650336941486141/down_2.png?ex=65734758&is=6560d258&hm=1d5ab7ddfadeb4b79cd069b9d91f2dff2587d4a1c43a2b0c9ea2c59d4b4bc26b&" alt="" width="20px">
                </div>
            </div>
        </aside>
        <section class="grow">
            <section class="">
                <div class="flex items-center gap-8">
                    <p class="text-lg font-medium pb-2.5 border-b border-slate-500">Buku (<span><?= count($bikes) ?></span>)</p>
                    <p class="text-lg font-medium pb-2.5 text-slate-300">Penulis</p>
                </div>
                <div class="h-px w-full bg-slate-200"></div>
            </section>
            <section class="mt-6 flex flex-wrap justify-between gap-4">
                <?php foreach ($bikes as $book) : ?>
                <div class="max-w-[11rem] space-y-2 bg-white shadow p-2.5">
                    <a href="/book/<?= $book['id'] ?>" class="inline-block">
                        <img src="<?= $book['image'] ?>" alt="" class="w-full">
                    </a>
                    <div class="flex items-end justify-between">
                        <div class="w-1/2">  
                            <p class="text-slate-500 text-xs truncate"><?= $book['brand'] ?></p>
                            <p class="font-medium text-sm truncate"><?= $book['name'] ?></p>
                        </div>
                        <p class="font-semibold text-xs text-slate-500 shrink-0">Rp <?= $book['price'] ?></p>
                    </div>
                    <div>
                        <p class="line-clamp-2 text-sm"><?= $book['description'] ?></p>
                    </div>
                </div>
                <?php endforeach ?>
            </section>
        </section> -->
    </main>
    <script>
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.getElementById('scrollBtn').addEventListener('click', function() {
            scrollToSection('catalog');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>