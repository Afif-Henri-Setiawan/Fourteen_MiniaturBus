<?php
require_once '../config/Database.php'; // sesuaikan path-nya

try {
    $conn = Database::getConnection();
    echo "✅ Koneksi berhasil!";
} catch (PDOException $e) {
    echo "❌ Koneksi gagal: " . $e->getMessage();
}
?>