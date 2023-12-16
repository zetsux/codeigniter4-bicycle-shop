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
    <main class="min-h-screen py-32 w-10/12 mx-auto space-y-6">
        <h1 class="text-2xl font-semibold">Daftar Penjualan</h1>
        <section class="space-y-4">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Datetime</th>
                        <th>Brand</th>
                        <th>Color</th>
                        <th>Count</th>
                        <th>Total Price</th>
                        <th>payment_method</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1;
                    foreach ($transactions as $transaction) : ?>
                        <tr>
                            <td><?= $counter++; ?></td>
                            <td><?= $transaction['user']['username'] ?></td>
                            <td><?= $transaction['created_at'] ?></td>
                            <td><?= $transaction['bike']['brand'] ?></td>
                            <td><?= $transaction['product']['color'] ?></td>
                            <td><?= $transaction['product']['count'] ?></td>
                            <td><?= $transaction['product']['total_price'] ?></td>
                            <td><?= $transaction['payment_method'] ?></td>
                            <td><img src="<?= $transaction['bike']['image'] ?>" alt="" width="100px"></td>
                            <td>
                                <div class="flex items-center gap-1.5">
                                    <a href="/transaction/<?= $transaction['id'] ?>" class="flex items-center justify-center w-8 h-8 rounded bg-blue-400 hover:bg-blue-500 text-white"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <div class="bg-white shadow-sm border !border-gray-100 rounded-md px-4 py-3 space-y-2.5">
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
                </div> -->
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>