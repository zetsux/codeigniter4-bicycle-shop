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
    <h1 class="text-2xl font-semibold">Riwayat Transaksi</h1>
    <section class="space-y-4">
      <?php foreach ($transactions as $transaction) : ?>
        <div class="bg-white shadow-sm border !border-gray-100 rounded-md px-4 py-3 space-y-2.5">
          <div class="flex items-center justify-between">
            <p><span class="font-medium">Kode Transaksi</span> : <?= $transaction['id'] ?></p>
            <p class="text-[15px]"><?= $transaction['created_at'] ?></p>
          </div>
          <div class="h-px w-full bg-slate-200"></div>
          <div class="flex items-end justify-between">
            <div class="flex items-center gap-6">
              <div class="p-2 bg-white rounded w-fit"><img src="<?= $transaction['bike']['image'] ?>" alt="" width="60px"></div>
              <div class="text-sm">
                <p> <span class="font-medium">Category :</span> <?= $transaction['bike']['category'] ?></p>
                <p> <span class="font-medium">Brand :</span> <?= $transaction['bike']['brand'] ?></p>
                <p> <span class="font-medium">Color :</span> <?= $transaction['product']['color'] ?></p>
                <p> <span class="font-medium">Jumlah Barang :</span> <?= $transaction['product']['count'] ?></p>
                <p> <span class="font-medium">Jumlah Harga :</span> <?= $transaction['product']['total_price'] ?></p>
              </div>
            </div>
            <a href="/transaction/<?= $transaction['id'] ?>" class="rounded-lg bg-white text-sky-700 border-[1.5px] border-sky-600 w-fit px-4 min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm">Lihat Detail</a>
          </div>
        </div>
      <?php endforeach ?>
    </section>
  </main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>