<?php
require_once '../config/Database.php';
require_once '../classes/Pesanan.php';
require_once '../classes/Pesanan_detail.php';

$pdo = Database::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data utama
    $nama = $_POST['nama'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $total = $_POST['total'] ?? 0;
    $deskripsi = $_POST['deskripsi_tambahan'] ?? '';
    $produkJSON = $_POST['produk_detail'] ?? '[]';

    // Coba decode produk_detail
    $produkDetail = json_decode($produkJSON, true);
    if (!is_array($produkDetail) || empty($produkDetail)) {
        die("Data produk tidak valid atau kosong.");
    }

    // Upload bukti bayar
    $buktiBayarPath = '';
    if (!empty($_FILES['bukti_bayar']['name'])) {
        $ext = pathinfo($_FILES['bukti_bayar']['name'], PATHINFO_EXTENSION);
        $filename = 'bukti_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], '../uploads/' . $filename);
        $buktiBayarPath = $filename;
    }

    // Upload gambar request (opsional)
    $gambarRequestPath = '';
    if (!empty($_FILES['gambar_request']['name'])) {
        $ext = pathinfo($_FILES['gambar_request']['name'], PATHINFO_EXTENSION);
        $filename = 'gambar_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['gambar_request']['tmp_name'], '../uploads/' . $filename);
        $gambarRequestPath = $filename;
    }

    // Simpan pesanan utama
    $pesanan = new Pesanan($pdo);
    $id_pesanan = $pesanan->create($nama, $telepon, $alamat, $buktiBayarPath, $gambarRequestPath, $deskripsi, $total);

    // Simpan detail pesanan
    $detail = new PesananDetail($pdo);
    foreach ($produkDetail as $item) {
        // Validasi setiap item
        if (!isset($item['id_kategori'], $item['jumlah'], $item['harga_satuan'])) {
            continue; // skip jika tidak lengkap
        }

        $id_kategori = $item['id_kategori'];
        $jumlah = (int) $item['jumlah'];
        $subtotal = $item['harga_satuan'] * $jumlah;

        $detail->add($id_pesanan, $id_kategori, $jumlah, $subtotal);
    }

    // Redirect ke halaman sukses
    header("Location: sukses.php");
    exit;
}
?>