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
  <?php echo view('layouts/navbar')?>
  <main class="min-h-screen py-32 w-10/12 mx-auto space-y-6">
    <div class="flex items-center gap-2.5">
      <a href="/" class="text-slate-400">Home</a>
      <p class="text-slate-400">/</p>
      <a href="/transaction" class="text-slate-400">Transaksi</a>
      <p class="text-slate-600">/</p>
      <p class="text-slate-600">Detail</p>
    </div>
    <h1 class="text-2xl font-semibold">Detail Transaksi</h1>
    <section class="">
      <section class="mt-6 flex flex-col lg:flex-row gap-12">
        <div>
          <div class="p-3.5 bg-white rounded shadow w-fit">
            <img src="<?= $book['cover'] ?>" alt="">
          </div>
        </div>
        <div class="space-y-7 lg:w-1/2">
          <div>
            <p class="text-slate-400"><?= $book['author'] ?></p>
            <p class="text-3xl font-medium"><?= $book['title'] ?></p>
          </div>
          <div class="h-px w-full bg-slate-200"></div>
          <div>
            <p class="text-[17px] font-medium">Detail Produk Buku</p>
            <table class="mt-2 text-[15px] border-separate border-spacing-2 w-full">
              <tbody>
                <tr>
                  <td class="font-medium text-sky-700 align-top">Penerbit</td>
                  <td class="align-top">:</td>
                  <td><?= $book['publisher'] ?></td>
                </tr>
                <tr>
                  <td class="font-medium text-sky-700 align-top">Genre</td>
                  <td class="align-top">:</td>
                  <td><?= $book['genre'] ?></td>
                </tr>
                <tr>
                  <td class="font-medium text-sky-700 align-top">Deskripsi</td>
                  <td class="align-top">:</td>
                  <td><?= $book['description'] ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div>
            <p class="text-[17px] font-medium">Detail Pembayaran</p>
            <div class="grid grid-cols-2">
              <table class="mt-2 text-[15px] border-separate border-spacing-2">
                <tbody>
                  <tr>
                    <td class="font-medium text-sky-700 align-top">Jumlah</td>
                    <td class="align-top">:</td>
                    <td><?= $transaction['count'] ?> Buku</td>
                  </tr>
                  <tr>
                    <td class="font-medium text-sky-700 align-top">Total</td>
                    <td class="align-top">:</td>
                    <td>Rp <?= number_format($transaction['total_price']) ?></td>
                  </tr>
                </tbody>
              </table>
              <table class="mt-2 text-[15px] border-separate border-spacing-2">
                <tbody>
                  <tr>
                    <td class="font-medium text-sky-700 align-top">Metode</td>
                    <td class="align-top">:</td>
                    <td><?= $transaction['payment_method'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-medium text-sky-700 align-top">Alamat</td>
                    <td class="align-top">:</td>
                    <td><?= $transaction['address'] ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 grow h-fit space-y-2.5 w-1/4">
          <p class="font-medium">Ada pertanyaan?</p>
          <p class="text-sm">Silahkan menanyakan produk ini kepada customer service kami dengan cara menekan tombol Tanya Produk di bawah ini.</p>
          <button class="rounded-lg bg-white text-sky-700 border-[1.5px] border-sky-600 w-full px-4 min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm mt-3">Tanya Produk</button>
        </div>
      </section>
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
          <td><?= $transaction['id'] ?></td>
          <td><?= $transaction['user_id'] ?></td>
          <td><?= $transaction['book_id'] ?></td>
          <td><?= $transaction['total_price'] ?></td>
          <td><?= $transaction['count'] ?></td>
          <td><img src="<?= $book['cover'] ?>"></td>
          <td><?= $book['title'] ?></td>
        </tr>
      </tbody>
    </table> -->
  </main>
</body>

</html>