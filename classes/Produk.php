<?php
require_once '../config/Database.php';

class Produk
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // Ambil semua data produk
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM produk ORDER BY id_kategori DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE id_kategori = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah produk
    public function add($nama_kategori, $deskripsi, $video, $gambar1, $gambar2, $gambar3, $harga)
    {
        $stmt = $this->conn->prepare("INSERT INTO produk 
            (nama_kategori, deskripsi, video, gambar, gambar2, gambar3, harga) 
            VALUES (:nama_kategori, :deskripsi, :video, :gambar, :gambar2, :gambar3, :harga)");
        return $stmt->execute([
            ':nama_kategori' => $nama_kategori,
            ':deskripsi' => $deskripsi,
            ':video' => $video,
            ':gambar' => $gambar1,
            ':gambar2' => $gambar2,
            ':gambar3' => $gambar3,
            ':harga' => $harga
        ]);
    }

    // Update produk
    public function update($id, $nama_kategori, $deskripsi, $video, $gambar1, $gambar2, $gambar3, $harga)
    {
        $stmt = $this->conn->prepare("UPDATE produk SET 
            nama_kategori = :nama_kategori,
            deskripsi = :deskripsi,
            video = :video,
            gambar = :gambar,
            gambar2 = :gambar2,
            gambar3 = :gambar3,
            harga = :harga
            WHERE id_kategori = :id");
        return $stmt->execute([
            ':nama_kategori' => $nama_kategori,
            ':deskripsi' => $deskripsi,
            ':video' => $video,
            ':gambar' => $gambar1,
            ':gambar2' => $gambar2,
            ':gambar3' => $gambar3,
            ':harga' => $harga,
            ':id' => $id
        ]);
    }

    // Hapus produk
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM produk WHERE id_kategori = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getAllKategori()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT id_kategori, nama_kategori, gambar FROM produk");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>