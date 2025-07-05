<?php
require_once '../config/Database.php';
require_once '../classes/produk.php';
require_once '../classes/Pesanan.php';

$pdo = Database::getConnection();
$pesananStmt = $pdo->query("SELECT * FROM pesanan ORDER BY tanggal_pesan DESC");
$semuaPesanan = $pesananStmt->fetchAll(PDO::FETCH_ASSOC);

$produkObj = new Produk();
$semuaProduk = $produkObj->getAll();

$pesanan = new Pesanan($pdo);
$jumlahPesanan = $pesanan->count();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">

    <!-- goggle font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- google font end -->

    <!-- css -->
    <link href="../src/output.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="Assets/image/Fix Logo 14 busworkshop Hitam.png" sizes="100x10">
    <!-- End Favicon -->

    <title>Dashboard</title>
</head>

<body class="bg-gray-100 font-[Poppins]">

    <!-- NAVIGATION -->
    <div class="px-20 pt-10 pb-5">
        <h1 class="text-4xl font-semibold">Dashboard</h1>

        <!-- Navigasi -->
        <ul class="flex mt-4 pb-4 text-lg">
            <li id="nav-pesanan" class="flex items-center pr-10  text-black cursor-pointer"
                onclick="showPage('pesanan')">
                Pesanan
                <div class="ml-2 h-5 w-5 flex justify-center items-center text-xs rounded-full bg-amber-300 text-black">
                    <?= $jumlahPesanan ?>
                </div>
            </li>
            <li id="nav-produk" class="flex items-center px-8 text-gray-500 cursor-pointer hover:text-black transition"
                onclick="showPage('produk')">
                Produk
            </li>
        </ul>
        <div class="flex flex-wrap gap-2 mt-1">
            <button onclick="filterPesanan('semua')"
                class="filter-btn bg-gray-200 text-gray-700 hover:bg-gray-300 px-3 py-1 rounded text-sm font-medium cursor-pointer">Semua</button>
            <button onclick="filterPesanan('menunggu')"
                class="filter-btn bg-yellow-100 text-yellow-800 hover:bg-yellow-200 px-3 py-1 rounded text-sm font-medium cursor-pointer">Menunggu</button>
            <button onclick="filterPesanan('disetujui')"
                class="filter-btn bg-green-100 text-green-800 hover:bg-green-200 px-3 py-1 rounded text-sm font-medium cursor-pointer">Disetujui</button>
            <button onclick="filterPesanan('ditolak')"
                class="filter-btn bg-red-100 text-red-800 hover:bg-red-200 px-3 py-1 rounded text-sm font-medium cursor-pointer">Ditolak</button>
        </div>
    </div>

    <!-- KONTEN PESANAN -->
    <div id="pesanan" class="px-20">
        <ul class="space-y-4">
            <?php if (count($semuaPesanan) > 0): ?>
                <?php foreach ($semuaPesanan as $pesanan): ?>
                    <li class="flex items-center bg-white rounded-lg shadow p-4 pesanan-item <?= $pesanan['status'] ?>">
                        <img src="Assets/image/1.jpg" alt="Bus Mini" class="w-16 h-16 object-cover rounded mr-6">
                        <div class="flex-1">
                            <div class="flex text-xs text-gray-400">
                                <div class="pr-8">
                                    <span class="pr-2">Nama</span>
                                    <div class="font-semibold text-gray-600 text-sm">
                                        <?= $pesanan['nama_pembeli'] ?>
                                    </div>
                                </div>
                                <div class="pr-8">
                                    <span class="pr-2">Tanggal Pesan</span>
                                    <div class="font-semibold text-gray-600 text-sm">
                                        <?= date('d M Y', strtotime($pesanan['tanggal_pesan'])) ?>
                                    </div>
                                </div>
                                <div class="pr-8">
                                    <span class="pr-2">Total Harga</span>
                                    <div class="font-semibold text-gray-600 text-sm">
                                        Rp <?= number_format($pesanan['total'], 0, ',', '.') ?>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="pr-2">Status</span>
                                    <div
                                        class="px-3 py-1.5 text-xs font-semibold rounded-full 
                                        <?= $pesanan['status'] === 'disetujui' ? 'bg-green-100 text-green-800' :
                                            ($pesanan['status'] === 'ditolak' ? 'bg-red-100 text-red-800' :
                                                ($pesanan['status'] === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-200 text-gray-800')) ?>">
                                        <?= htmlspecialchars($pesanan['status']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="detailBayar.php?id=<?= $pesanan['id_pesanan'] ?>"
                            class="ml-6 px-4 py-2 bg-amber-300 text-white rounded font-semibold text-sm hover:bg-amber-400 transition">
                            Lihat Detail
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="text-gray-500">Belum ada pesanan masuk.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- KONTEN PRODUK -->
    <div id="produk" class="px-20 hidden">
        <div class="flex justify-end mb-4 ">
            <a href="tambahProduk.php" class="bg-amber-400 rounded-full text-white px-4 py-1.5 text-sm">+ Tambah
                Kategori</a>
        </div>
        <ul class="space-y-4">
            <?php foreach ($semuaProduk as $produk): ?>
                <li class="flex items-center bg-white rounded-lg shadow p-4">
                    <!-- Gambar Produk -->
                    <img src="../uploads/<?= htmlspecialchars($produk['gambar']) ?>" alt="Produk"
                        class="w-16 h-16 object-cover rounded mr-6">

                    <!-- Detail Produk -->
                    <div class="flex-1">
                        <div class="flex text-xs text-gray-400">
                            <div class="pr-8">
                                <span class="pr-2">Kategori</span>
                                <div class="font-semibold text-gray-600 text-sm">
                                    <?= htmlspecialchars($produk['nama_kategori']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aksi Tombol -->
                    <div class="flex gap-2">
                        <a href="editProduk.php?id=<?= $produk['id_kategori'] ?>"
                            class="p-2 text-blue-500 hover:text-blue-600 transition">
                            edit
                        </a>
                        <a href="hapus.php?id=<?= $produk['id_kategori'] ?>"
                            onclick="return confirm('Yakin ingin menghapus?')"
                            class="p-2 text-red-600 hover:text-red-600 transition">
                            Hapus
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>


    <!-- JS TOGGLE -->
    <script src="js/dashboard.js"></script>
</body>

</html>