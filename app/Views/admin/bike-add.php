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
  <main class="min-h-screen py-32 w-10/12 mx-auto space-y-6">
    <form action="<?= route_to('bike.create') ?>" method="POST">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Add New Bike</h1>
        <button type="submit" class="flex items-center justify-center py-2 px-4 rounded bg-sky-500 hover:bg-slate-500 text-white">Submit</button>
      </div>
      <section class="mt-4">
        <div class="space-y-2.5">
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Name
            </span>
            <input type="text" id="name" name="name" placeholder="Enter bike's name" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Brand
            </span>
            <input type="text" id="brand" name="brand" placeholder="Enter bike's brand" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Category
            </span>
            <input type="text" id="category" name="category" placeholder="Enter bike's category" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Description
            </span>
            <input type="text" id="description" name="description" placeholder="Enter bike's description" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Price
            </span>
            <input type="number" id="price" name="price" placeholder="Enter bike's price" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Stock
            </span>
            <input type="number" id="stock" name="stock" placeholder="Enter bike's stock" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
          <label class="block">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
              Image Link
            </span>
            <input type="text" id="image" name="image" placeholder="Enter bike's image link" required class="mt-1 px-3 py-2 min-h-[2.25rem] md:min-h-[2.5rem] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1 focus:outline-none" />
          </label>
        </div>
      </section>
    </form>
  </main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>