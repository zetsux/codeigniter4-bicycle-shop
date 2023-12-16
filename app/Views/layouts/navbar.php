<?php
$session = \Config\Services::session();
?>

<header class="fixed top-0 inset-x-0">
    <nav class="min-h-[4.5rem] bg-white border-b shadow-sm flex items-center justify-between px-6 md:px-20 navbar">
        <a href="/" class="text-xl font-bold decoration-none">SepedaKuy</a>
        <!-- <input id="search" type="text" placeholder="Cari buku atau penulis" class="min-w-[25rem] min-h-[2.25rem] md:min-h-[2.5rem] rounded-full bg-slate-100 px-4 border border-gray-300 focus:outline-none"> -->
        <?php if ($session->has('username')) : ?>
            <ul class="flex items-center gap-6">
                <li class="hover:text-slate-500">
                    <a href="/">Home</a>
                </li>
                <li class="hover:text-slate-500">
                    <a href="/bike">Catalog</a>
                </li>
                <li class="hover:text-slate-500 relative cart-link">
                    <a href="/cart" class="w-full h-full">Cart</a>
                    <div id="cart-badge" class="absolute -top-2 -right-2 bg-sky-700 text-white font-medium text-xs px-2.5 py-1 rounded-full hidden">1</div>
                </li>
                <li class="hover:text-slate-500">
                    <a href="/transaction">History</a>
                </li>
                <?php if ($session->get('role') == 'admin') : ?>
                    <li class="hover:text-slate-500">
                        <a href="/admin/bike" class="text-red-500 !decoration-none">Bikes</a>
                    </li>
                    <li class="hover:text-slate-500 relative cart-link">
                        <a href="/admin/sales" class="text-red-500 !decoration-none" class="w-full h-full">Sales</a>
                        <div id="cart-badge" class="absolute -top-2 -right-2 bg-sky-700 text-white font-medium text-xs px-2.5 py-1 rounded-full hidden">1</div>
                    </li>
                <?php endif; ?>
            </ul>
            <button data-popover-target="popover-click" data-popover-trigger="click" type="button" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-200 font-medium rounded-full text-sm px-4 py-2.5 text-center"><?= $session->get('username') ?></button>
            <div data-popover id="popover-click" role="tooltip" class="absolute z-10 invisible w-48 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 p-2">
                <div class="px-3 py-2 rounded hover:bg-slate-200 text-slate-800 font-medium">
                    <a href="/logout">Logout</a>
                </div>
            </div>
        <?php else : ?>
            <ul class="flex items-center gap-10 font-medium">
                <li class="hover:text-slate-500">
                    <a href="">Home</a>
                </li>
                <li class="hover:text-slate-500">
                    <a href="">Catalog</a>
                </li>
                <li class="hover:text-slate-500">
                    <a href="">About</a>
                </li>
                <li class="hover:text-slate-500">
                    <a href="/cart">Cart</a>
                </li>
            </ul>
            <ul class="flex items-center gap-6">
                <li>
                    <a href="/login" class="text-sky-600 font-medium">Masuk</a>
                </li>
                <li>
                    <a href="/register" class="btn btn-primary bg-sky-600 hover:bg-sky-700">Daftar</a>
                </li>
            </ul>
        <?php endif; ?>
    </nav>
</header>