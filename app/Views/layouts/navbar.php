<?php 
$session = \Config\Services::session();
?>

<header class="fixed top-0 inset-x-0">
    <nav class="min-h-[4.5rem] bg-white border-b shadow-sm flex items-center justify-between px-6 md:px-20">
        <a href="/" class="text-xl font-bold decoration-none">MediaIlmu</a>
        <!-- <input id="search" type="text" placeholder="Cari buku atau penulis" class="min-w-[25rem] min-h-[2.25rem] md:min-h-[2.5rem] rounded-full bg-slate-100 px-4 border border-gray-300 focus:outline-none"> -->
        <?php if ($session->has('username')): ?>
            <div class="flex items-center gap-6">
                <a href="/transaction" class="text-slate-500 font-medium">Riwayat Transaksi</a>
                <a href="/logout" class="text-slate-500 font-medium">Keluar</a>
                <h1 class="font-medium px-4 py-2 ring-2 ring-slate-400 rounded-full"><?= $session->get('username') ?></h1>
            </div>
        <?php else: ?>
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