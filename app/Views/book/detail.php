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
  <title>Book Detail Page</title>
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
  <main class="min-h-screen w-10/12 mx-auto py-32">
    <div class="flex items-center gap-2.5">
      <a href="/" class="text-slate-400">Home</a>
      <p class="text-slate-400">/</p>
      <a href="/" class="text-slate-400">Buku</a>
      <p class="text-slate-600">/</p>
      <p class="text-slate-600"><?= $book['title'] ?></p>
    </div>
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
        <div class="">
          <div class="flex items-center gap-10">
            <p class="font-medium pb-2.5 border-b border-slate-500 text-sky-600 border-b border-sky-500">Pilih Format Buku</p>
            <p class="font-medium pb-2.5 text-slate-300">Deskripsi Buku</p>
            <p class="font-medium pb-2.5 text-slate-300">Detail Buku</p>
          </div>
          <div class="h-px w-full bg-slate-200"></div>
        </div>
        <div>
          <p class="text-[17px] font-medium">Pilih Format Buku yang Tersedia</p>
          <div class="mt-2">
            <div class="bg-slate-100 max-w-[14rem] rounded-lg px-3.5 py-2.5">
              <p class="uppercase font-medium">hard cover</p>
              <p class="text-sm text-slate-400">mulai dari</p>
              <p class="text-sky-700">Rp <?= number_format($book['price']) ?></p>
            </div>
          </div>
        </div>
        <div class="space-y-1.5">
          <p class="font-medium text-[17px]">Deskripsi Buku</p>
          <p class="text-[15px] text-slate-600"><?= $book['description'] ?></p>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow p-6 grow h-fit space-y-2.5 min-w-[15rem]">
        <p class="font-medium">Ingin beli berapa?</p>
        <p class="text-sm">Jumlah barang :</p>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-6">
            <button id="decrement-btn" type="button" class="p-1.5 rounded-sm bg-white shadow-sm w-6 h-6 flex items-center justify-center">
              -
            </button>
            <p id="quantity-display">1</p>
            <button id="increment-btn" type="button" class="p-1.5 rounded-sm bg-white shadow-sm w-6 h-6 flex items-center justify-center">
              ﹢
            </button>
          </div>
          <p id="book-stock" class="text-slate-400 text-sm">Stok : <?= $book['stock'] - 1?></p>
        </div>
        <div class="h-px w-full bg-slate-200"></div>
        <div class="flex items-center justify-between text-sm">
          <input type="hidden">
          <p class="">Subtotal</p>
          <p id='subtotal-price'>Rp <?= $book['price'] ?></p>
        </div>
        <!-- <button class="rounded-lg bg-white text-sky-700 border-[1.5px] border-sky-600 w-full min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm mt-3">Tambah Keranjang</button> -->
        <form action="<?= route_to('transaction.prepare') ?>" method="POST">
          <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger">
              <?= session()->getFlashdata('error') ?>
            </div>
          <?php } ?>
          <input type="hidden" id="book_id" name="book_id" value=<?= $book['id'] ?>>
          <input type="hidden" id="user_id" name="user_id" value=<?= session()->get('id') ?>>
          <input type="hidden" id="count" name="count" value=<?= 1 ?>>
          <input type="hidden" step=".01" id="total_price" name="total_price" value=<?= $book['price'] ?>>
          <button type="submit" class="rounded-lg bg-sky-700/90 hover:bg-sky-700 text-white w-full min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm mt-4">Beli Sekarang</button>
        </form>
      </div>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function () {
      var quantity = 1; // Initial quantity
      var stock = <?= $book['stock'] ?>

      // Function to update the quantity display
      function updateQuantity() {
        $('#quantity-display').text(quantity);
        $('#count').val(quantity)
        $('#book-stock').text("Stok : " + (stock - quantity))
      }
      function updatePrice() {
        var subtotal = quantity * <?= $book['price'] ?>;
        $('#subtotal-price').text('Rp ' + subtotal);
        $('#total_price').val(subtotal);
      }
 
      // Event listener for the decrement button
      $('#decrement-btn').click(function () {
        if (quantity > 1) {
          quantity--;
          updateQuantity();
          updatePrice();
        }
      });

      // Event listener for the increment button
      $('#increment-btn').click(function () {
        if(quantity < stock) {
          quantity++;
          updateQuantity();
          updatePrice();
        }
      });
    });
  </script>
</body>

</html>