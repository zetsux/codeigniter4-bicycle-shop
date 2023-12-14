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
    <main class="min-h-screen py-32 w-10/12 mx-auto space-y-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-semibold">Daftar Transaksi</h1>
            <a href="/admin/bike/add" class="flex items-center justify-center py-2 px-4 rounded bg-slate-400 hover:bg-slate-500 text-white">Add New</a>
        </div>

        <section>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    foreach ($bikes as $bike) :
                    ?>
                        <tr>
                            <td><?= $counter++; ?></td>
                            <td><?= $bike['id'] ?></td>
                            <td><?= $bike['brand'] ?></td>
                            <td><?= $bike['name'] ?></td>
                            <td><?= $bike['category'] ?></td>
                            <td><?= $bike['description'] ?></td>
                            <td><?= $bike['price'] ?></td>
                            <td><?= $bike['stock'] ?></td>
                            <td>
                                <div class="flex items-center gap-1.5">
                                    <a href="/admin/bike/update/<?= $bike['id'] ?>" class="flex items-center justify-center w-8 h-8 rounded bg-blue-400 hover:bg-blue-500 text-white"><i class="fa-solid fa-pen"></i></a>
                                    <form action="/bike/delete/<?= $bike['id'] ?>" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="flex items-center justify-center w-8 h-8 rounded bg-red-400 hover:bg-red-500 text-white"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>