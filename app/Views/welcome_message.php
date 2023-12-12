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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      * {
      font-family: 'Poppins', sans-serif;
      }
  </style>
</head>

<body>
    <?php echo view('layouts/navbar')?>
    <main class="min-h-screen py-32 flex items-start gap-12 w-10/12 mx-auto">
        <aside class="w-[15rem] shrink-0">
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
                    <p class="text-lg font-medium pb-2.5 border-b border-slate-500">Buku (<span><?= count($books) ?></span>)</p>
                    <p class="text-lg font-medium pb-2.5 text-slate-300">Penulis</p>
                </div>
                <div class="h-px w-full bg-slate-200"></div>
            </section>
            <section class="mt-6 flex flex-wrap justify-between gap-4">
                <?php foreach ($books as $book) : ?>
                <div class="max-w-[11rem] space-y-2 bg-white shadow p-2.5">
                    <a href="/book/<?= $book['id'] ?>" class="inline-block">
                        <img src="<?= $book['cover'] ?>" alt="" class="w-full">
                    </a>
                    <div class="flex items-end justify-between">
                        <div class="w-1/2">  
                            <p class="text-slate-500 text-xs truncate"><?= $book['author'] ?></p>
                            <p class="font-medium text-sm truncate"><?= $book['title'] ?></p>
                        </div>
                        <p class="font-semibold text-xs text-slate-500 shrink-0">Rp <?= $book['price'] ?></p>
                    </div>
                    <div>
                        <p class="line-clamp-2 text-sm"><?= $book['genre'] ?></p>
                    </div>
                </div>
                <?php endforeach ?>
            </section>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>