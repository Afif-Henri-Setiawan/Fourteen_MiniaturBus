<?php
require_once '../config/Database.php';
require_once '../classes/Pesanan.php';
require_once '../classes/Pesanan_detail.php';

$pdo = Database::getConnection();

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID tidak ditemukan.");
}

// Ambil data pesanan dari database
$pesananObj = new Pesanan($pdo);
$pesanan = $pesananObj->getById($id); // Pastikan class Pesanan punya method getById
if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}

// Ambil detail produk pesanan
$detailObj = new PesananDetail($pdo);
$produkDipesan = $detailObj->getByPesanan($id);
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran</title>
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-[Poppins]">
    <div class="px-10 lg:px-20 pt-10 pb-5">
        <div class="flex mb-10">
            <a href="dashboard.php" class="text-blue-600 hover:underline">← Kembali</a>
            <h2 class="mx-auto text-3xl font-semibold">Detail Pembayaran</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 items-start">
            <!-- Bukti Bayar -->
            <div class="flex flex-col items-center mt-5 gap-4">
                <img src="../uploads/<?= htmlspecialchars($pesanan['bukti_bayar']) ?>" alt="Bukti Pembayaran"
                    class="w-[300px] h-[400px] object-cover rounded-xl border shadow" />

                <!-- button -->
                <div class="flex flex-row mt-5 gap-4">
                    <a href="ubah_status.php?id=<?= $pesanan['id_pesanan'] ?>&status=Disetujui"
                        class="bg-green-400 text-white px-3 py-1.5 rounded-sm">Setujui</a>
                    <a href="ubah_status.php?id=<?= $pesanan['id_pesanan'] ?>&status=Ditolak"
                        class="bg-red-400 text-white px-3 py-1.5 rounded-sm">Tolak</a>
                </div>
            </div>

            <!-- Informasi Pembayaran -->
            <div class="space-y-4 lg:pt-8">
                <div>
                    <h3 class="font-medium text-gray-700">Nama Pemesan:</h3>
                    <p class="text-gray-900"><?= htmlspecialchars($pesanan['nama_pembeli']) ?></p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Nomor Telepon:</h3>
                    <p class="text-gray-900"><?= htmlspecialchars($pesanan['no_telp']) ?></p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Tanggal Pemesanan:</h3>
                    <p class="text-gray-900"><?= date('d M Y', strtotime($pesanan['tanggal_pesan'])) ?></p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700 mb-1">Produk Dipesan:</h3>
                    <ul class="text-gray-900 list-disc ml-5 space-y-1">
                        <?php foreach ($produkDipesan as $item): ?>
                            <li>
                                <?= htmlspecialchars($item['nama_kategori']) ?> - <?= $item['jumlah'] ?> pcs
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>


                <div>
                    <h3 class="font-medium text-gray-700">Total Pembayaran:</h3>
                    <p class="text-gray-900">Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700 flex items-center gap-2">
                        Gambar Request:
                        <?php if (!empty($pesanan['gambar_request'])): ?>
                            <a href="../uploads/<?= $pesanan['gambar_request'] ?>" target="_blank"
                                class="text-blue-600 hover:underline">Lihat Gambar</a>
                        <?php else: ?>
                            <span class="text-gray-400 italic">Tidak ada</span>
                        <?php endif; ?>
                    </h3>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Deskripsi Tambahan:</h3>
                    <p class="text-gray-900 text-justify"><?= nl2br(htmlspecialchars($pesanan['deskripsi_tambahan'])) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>