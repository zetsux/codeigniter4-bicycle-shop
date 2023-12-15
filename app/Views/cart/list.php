<?php
$session = \Config\Services::session();

if (!$session->has('username') || !$session->has('role') || !$session->has('id')) {
  header('Location: ' . route_to('home.login'));
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction History Page</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
  <?php echo view('layouts/navbar') ?>
  <main class="min-h-screen py-32 w-10/12 mx-auto space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-semibold">Your Cart</h1>
      <?php if (isset($products[0]['cart_id'])) : ?>
        <form action="<?= route_to('transaction.prepare') ?>" method="POST">
          <input type="hidden" id="cart_id" name="cart_id" value="<?= $products[0]['cart_id'] ?>">
          <button type="submit" class="rounded-lg bg-sky-600 text-white w-fit px-4 min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm">Beli Sekarang</button>
        </form>
      <?php else : ?>
        <a href="/bike" class="rounded-lg bg-sky-600 text-white w-fit px-4 min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm">Catalog</a>
      <?php endif; ?>
    </div>
    <section class="space-y-4">
      <?php if (!isset($products[0]['cart_id'])) : ?>
        <div class="min-h-[50vh] grid place-items-center">
          <p class="text-slate-400">Your cart is empty</p>
        </div>
      <?php endif; ?>
      <?php foreach ($products as $product) : ?>
        <div class="bg-white shadow-sm border !border-gray-100 rounded-md px-4 py-3 space-y-2.5">
          <div class="flex items-center justify-between">
            <p><span class="font-medium">Product Name</span> : <?= $product['name'] ?></p>
            <p class="text-[15px]"><?= $product['color'] ?></p>
          </div>
          <div class="h-px w-full bg-slate-200"></div>
          <div class="flex items-end justify-between">
            <div class="flex items-center gap-6">
              <div class="p-2 bg-white rounded w-fit"><img src="<?= $product['image'] ?>" alt="" width="60px"></div>
              <div class="text-sm">
                <p> <span class="font-medium">Category :</span> <?= $product['category'] ?></p>
                <p> <span class="font-medium">Brand :</span> <?= $product['brand'] ?></p>
                <p> <span class="font-medium">Color :</span> <?= $product['color'] ?></p>
                <p> <span class="font-medium">Total harga :</span> Rp <?= $product['total_price'] ?></p>
              </div>
            </div>
            <div class="flex flex-col gap-2.5">
              <div class="shrink-0 flex items-center gap-4">
                <form action="<?= route_to('cart.count') ?>" method="POST">
                  <input type="hidden" id="count" name="count" value="<?= $product['count'] - 1 ?>" />
                  <input type="hidden" id="id" name="id" value="<?= $product['product_id'] ?>" />
                  <button type="submit" class="p-1.5 rounded-sm bg-white shadow-sm w-10 h-10 flex items-center justify-center">
                    -
                  </button>
                </form>
                <p id="quantity-display"></span> <?= $product['count'] ?></p>
                <form action="<?= route_to('cart.count') ?>" method="POST">
                  <input type="hidden" id="count" name="count" value="<?= $product['count'] + 1 ?>" />
                  <input type="hidden" id="id" name="id" value="<?= $product['product_id'] ?>" />
                  <button type="submit" class="p-1.5 rounded-sm bg-white shadow-sm w-10 h-10 flex items-center justify-center">
                    ﹢
                  </button>
                </form>
              </div>
              <a href="/bike/<?= $product['id'] ?>" class="rounded-lg bg-slate-500 text-white w-fit px-4 min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </section>
  </main>
  <script></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>