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

    #animated-item {
      transition: transform 0.5s ease-in-out;
    }
  </style>
</head>

<body>
  <?php echo view('layouts/navbar') ?>
  <main class="min-h-screen w-10/12 mx-auto py-32">
    <form action="<?= route_to('cart.add') ?>" method="POST">
      <div class="flex items-center gap-2.5 text-sm">
        <a href="/" class="text-slate-400">Home</a>
        <p class="text-slate-400">/</p>
        <a href="/" class="text-slate-400">Bike</a>
        <p class="text-slate-600">/</p>
        <p class="text-slate-600"><?= $bike['name'] ?></p>
      </div>
      <section class="flex items-start gap-10">
        <div class="basis-1/2 space-y-2">
          <img src="<?= $bike['image'] ?>" alt="">
          <div class="flex items-center gap-2">
            <div class="basis-1/5 border p-2"><img src="<?= $bike['image'] ?>" alt=""></div>
            <div class="basis-1/5 border p-2"><img src="<?= $bike['image'] ?>" alt=""></div>
            <div class="basis-1/5 border p-2"><img src="<?= $bike['image'] ?>" alt=""></div>
            <div class="basis-1/5 border p-2"><img src="<?= $bike['image'] ?>" alt=""></div>
            <div class="basis-1/5 border p-2"><img src="<?= $bike['image'] ?>" alt=""></div>
          </div>
        </div>
        <div class="space-y-8 basis-1/2 pl-10">
          <div class="space-y-2.5">
            <p class="uppercase text-slate-400"><?= $bike['brand'] ?> : <?= $bike['category'] ?></p>
            <p class="font-semibold text-3xl"><?= $bike['name'] ?> bike</p>
            <p id="book-stock" class="text-sm text-slate-400">stock : <?= $bike['stock'] - 1 ?></p>
            <p class="text-slate-400 max-w-sm"><?= $bike['description'] ?></p>
          </div>
          <div class="flex items-center justify-between gap-2">
            <p id="subtotal-price" class="text-4xl font-bold">Rp <?= $bike['price'] ?></p>
            <div class="shrink-0 flex items-center gap-4">
              <button id="decrement-btn" type="button" class="p-1.5 rounded-sm bg-white shadow-sm w-10 h-10 flex items-center justify-center">
                -
              </button>
              <p id="quantity-display">1</p>
              <button type="button" id="increment-btn" type="button" class="p-1.5 rounded-sm bg-white shadow-sm w-10 h-10 flex items-center justify-center">
                ﹢
              </button>
            </div>
          </div>
          <div class="space-y-2">
            <label for="color" class="font-medium">Color:</label>
            <input type="text" id="color" name="color" class="outine-none p-0 border-none pointer-events-none" readonly>
            <div class="flex items-center gap-4">
              <button type="button" id="dark" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-slate-700 rounded-lg"></button>
              <button type="button" id="light" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-slate-100 rounded-lg"></button>
              <button type="button" id="red" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-red-300 rounded-lg"></button>
              <button type="button" id="blue" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-blue-300 rounded-lg"></button>
              <button type="button" id="yellow" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-yellow-300 rounded-lg"></button>
              <button type="button" id="green" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-green-300 rounded-lg"></button>
              <button type="button" id="indigo" class="color-btn focus:outline-none active:outline-slate-500 w-10 h-10 bg-indigo-300 rounded-lg"></button>
            </div>
          </div>
          <div>
            <?php if (session()->getFlashdata('error')) { ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php } ?>
            <input type="hidden" id="bike_id" name="bike_id" value=<?= $bike['id'] ?>>
            <input type="hidden" id="count" name="count" value=<?= 1 ?>>
            <input type="hidden" step=".01" id="total_price" name="total_price" value=<?= $bike['price'] ?>>
            <button type="submit" class="rounded-md min-h-[2.25rem] min-h-[2.75rem] flex items-center justify-center gap-2 bg-slate-800 text-white font-medium text-sm w-full hover:bg-slate-800/90">
              <i class="fa-solid fa-bag-shopping"></i>
              <span>Add to cart</span>
            </button>
          </div>
        </div>
      </section>
    </form>
  </main>
  <div id="animated-item" class="hidden bg-sky-700 text-white font-medium text-sm px-2.5 py-1 text-center rounded-full absolute z-50">
    <i class="fa-regular fa-cart-shopping"></i>
    <span>1</span>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      var quantity = 1; // Initial quantity
      var stock = <?= $bike['stock'] ?>

      // Function to update the quantity display
      function updateQuantity() {
        $('#quantity-display').text(quantity);
        $('#count').val(quantity)
        $('#book-stock').text("Stok : " + (stock - quantity))
      }

      function updatePrice() {
        var subtotal = quantity * <?= $bike['price'] ?>;
        $('#subtotal-price').text('Rp ' + subtotal);
        $('#total_price').val(subtotal);
      }

      // Event listener for the decrement button
      $('#decrement-btn').click(function() {
        if (quantity > 1) {
          quantity--;
          updateQuantity();
          updatePrice();
        }
      });

      // Event listener for the increment button
      $('#increment-btn').click(function() {
        if (quantity < stock) {
          quantity++;
          updateQuantity();
          updatePrice();
        }
      });

      // Event listener for the color buttons
      $('.color-btn').click(function() {
        var selectedColor = $(this).attr('id');
        $('#color').text(selectedColor.charAt(0).toUpperCase() + selectedColor.slice(1));

        var color = document.getElementById('color').value = selectedColor.charAt(0).toUpperCase() + selectedColor.slice(1)

        // Remove border from all color buttons
        $('.color-btn').css('outline', 'none');

        // Add border to the selected color button
        $(this).css('outline', '2px solid #64748b'); // Change #000 to the desired border color
        // $(this).css('outline', 'none'); // Change #000 to the desired border color
      });
      $('#dark').click();

      // Event listener for the "Add to Cart" button
      $('form').submit(function(e) {
        // e.preventDefault();

        // Get the button, animated item, and cart badge
        var addButton = $(this).find('button[type="submit"]');
        var animatedItem = $('#animated-item');
        var cartBadge = $('#cart-badge');

        // Clone the button and append it to the body for animation
        var animatedClone = addButton.clone().appendTo('body');

        // Get the position of the button
        var buttonPosition = addButton.offset();

        // Set the position and make the animated item visible
        animatedItem.css({
          top: buttonPosition.top + 'px',
          left: buttonPosition.left + 'px',
        }).removeClass('hidden');

        // Set the position for the animation end point (cart in the navbar)
        var cartPosition = $('.navbar .cart-link').offset();

        // Calculate the distance to move
        var distanceX = cartPosition.left - buttonPosition.left;
        var distanceY = cartPosition.top - buttonPosition.top;

        // Apply the transform to animate the item to the cart
        animatedItem.css({
          transform: `translate(${distanceX}px, ${distanceY}px)`,
        });

        // After the animation is complete, hide the animated item
        setTimeout(function() {
          animatedItem.addClass('hidden').css({
            transform: 'none',
          });

          // Show and update the cart badge
          var currentCount = parseInt(cartBadge.text()) || 0;
          var newCount = currentCount;
          cartBadge.text(newCount).removeClass('hidden');
        }, 500); // Change the time to match the transition duration
      });
      var cartNotif = <?php echo json_encode($session->getFlashdata('cartNotif')); ?>;
      if (cartNotif) {
        // Update the text content of the "Cart" nav item
        updateCartNavItem(cartNotif);
      }

      // Function to update the text content of the "Cart" nav item
      function updateCartNavItem(cartNotif) {
        // Assuming your cart nav item has a specific class or ID, adjust accordingly
        var cartNavItem = document.getElementById('cart-badge');

        // Remove the "hidden" class
        cartNavItem.classList.remove('hidden');

        // Update the text content
        cartNavItem.innerText = cartNotif;
      }

    });
  </script>
</body>

</html>