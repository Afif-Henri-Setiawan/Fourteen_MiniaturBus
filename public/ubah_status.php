<?php
require_once '../config/Database.php';
require_once '../classes/Pesanan.php';

$pdo = Database::getConnection();
$pesanan = new Pesanan($pdo);

$id = $_GET['id'] ?? null;
$status = $_GET['status'] ?? null;

if (!$id || !in_array($status, ['Menunggu', 'Disetujui', 'Ditolak'])) {
    echo "Permintaan tidak valid.";
    exit;
}

// Update status pesanan
$pesanan->updateStatus($id, $status);

// Ambil data pesanan untuk info WhatsApp
$data = $pesanan->getById($id);
if (!$data) {
    echo "Pesanan tidak ditemukan.";
    exit;
}

// Format nomor ke 62xxxxx
$no_wa = preg_replace('/^0/', '62', $data['no_telp']);

// Buat isi pesan tergantung status
if ($status === 'Disetujui') {
    $pesan = "Halo {$data['nama_pembeli']}, pesanan kamu sudah *Disetujui*. Total: Rp " . number_format($data['total'], 0, ',', '.') . ". Terima kasih telah memesan.";
} elseif ($status === 'Ditolak') {
    $pesan = "Hai {$data['nama_pembeli']}, mohon maaf pesanan kamu *Ditolak*. Silakan hubungi admin untuk informasi lebih lanjut.";
} else {
    $pesan = "Status pesanan kamu saat ini: *{$status}*.";
}

// Encode pesan
$pesan = urlencode($pesan);

// Redirect ke WhatsApp
header("Location: https://wa.me/{$no_wa}?text={$pesan}");
exit;
?>
