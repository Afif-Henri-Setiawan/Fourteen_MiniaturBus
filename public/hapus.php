<?php
require_once '../config/Database.php';
require_once '../classes/produk.php';

$produk = new Produk();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($produk->delete($id)) {
        header("Location: dashboard.php");
    } else {
        echo "❌ Gagal menghapus produk.";
    }
} else {
    echo "ID produk tidak ditemukan.";
}
?>