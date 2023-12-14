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
  <title>Detail Transaction Page</title>
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
    <div class="flex items-center gap-2.5">
      <a href="/" class="text-slate-400">Home</a>
      <p class="text-slate-400">/</p>
      <a href="/transaction" class="text-slate-400">Transaksi</a>
      <p class="text-slate-600">/</p>
      <p class="text-slate-600">Detail</p>
    </div>
    <h1 class="text-2xl font-semibold">Detail Transaksi</h1>
    <section class="space-y-3">
      <?php foreach ($products as $product) : ?>
        <div class="bg-white shadow-sm border !border-gray-100 rounded-md px-4 py-3 space-y-2.5">
          <div class="flex items-center justify-between">
            <p><span class="font-medium">Product Name</span> : <?= $product['name'] ?></p>
            <p class="text-[15px]">Date : <?= $product['created_at'] ?></p>
          </div>
          <div class="h-px w-full bg-slate-200"></div>
          <div class="flex items-end justify-between">
            <div class="flex items-center justify-between w-full">
              <div class="flex items-center gap-6 w-full">
                <div class="p-2 bg-white rounded w-fit"><img src="<?= $product['image'] ?>" alt="" width="60px"></div>
                <div class="text-sm grow">
                  <p> <span class="font-medium">Category :</span> <?= $product['category'] ?></p>
                  <p> <span class="font-medium">Brand :</span> <?= $product['brand'] ?></p>
                  <p> <span class="font-medium">Color :</span> <?= $product['color'] ?></p>
                  <p> <span class="font-medium">Jumlah Barang :</span> <?= $product['count'] ?></p>
                </div>
              </div>
              <div class="text-[15px] shrink-0 self-end text-end">
                <p class="font-semibold">Total Harga</p>
                <p>Rp <?= $product['price'] ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </section>
    <!-- <table class="table table-bordered table-hover mt-2">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>User_ID</th>
          <th>Book_ID</th>
          <th>Total_Price</th>
          <th>Count</th>
          <th>Book Cover</th>
          <th>Book Title</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        </tr>
      </tbody>
    </table> -->
  </main>
</body>

</html>