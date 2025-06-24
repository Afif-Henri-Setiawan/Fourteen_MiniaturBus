<?php
require_once '../config/Database.php';
require_once '../classes/Pesanan.php';
require_once '../classes/PesananDetail.php';

$db = new Database();
$conn = $db->getConnection();

$pesanan = new Pesanan($conn);
$pesananDetail = new PesananDetail($conn);

// Ambil data dari POST
$nama = $_POST['name'] ?? '';
$telepon = $_POST['nomor'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$catatan = $_POST['deskripsi_tambahan'] ?? '';
$total = $_POST['total'] ?? 0;

// Upload bukti bayar
$buktiBayar = $_FILES['bukti_bayar']['name'] ?? '';
$target = '';

if (!empty($buktiBayar)) {
    $tmp = $_FILES['bukti_bayar']['tmp_name'];
    $target = '../uploads/' . uniqid() . '_' . basename($buktiBayar);
    move_uploaded_file($tmp, $target);
}

// Upload gambar request (gambar contoh)
$gambarRequest = $_FILES['gambar_request']['name'] ?? '';
$gambarRequestPath = '';

if (!empty($gambarRequest)) {
    $tmpGambar = $_FILES['gambar_request']['tmp_name'];
    $gambarRequestPath = '../uploads/' . uniqid() . '_' . basename($gambarRequest);
    move_uploaded_file($tmpGambar, $gambarRequestPath);
}

// Simpan ke tabel pesanan
$id_pesanan = $pesanan->create($nama, $telepon, $alamat, basename($target), basename($gambarRequestPath), $catatan, $total);

// Ambil dan simpan produk detail
$produkDetail = json_decode($_POST['produk_detail'], true);

if (is_array($produkDetail)) {
    foreach ($produkDetail as $item) {
        $id_kategori = $item['id_kategori'];
        $jumlah = $item['jumlah'];
        $subtotal = $item['subtotal'];

        $pesananDetail->add($id_pesanan, $id_kategori, $jumlah, $subtotal);
    }
}

// Redirect atau tampilkan pesan
header("Location: sukses.php");
exit;
?>