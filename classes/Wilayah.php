<?php
require_once '../config/Database.php';

class Wilayah
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // Ambil semua wilayah
    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM wilayah ORDER BY nama_wilayah ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu wilayah berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM wilayah WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah wilayah baru
    public function create($nama_wilayah, $ongkir)
    {
        $stmt = $this->conn->prepare("INSERT INTO wilayah (nama_wilayah, ongkir) VALUES (:nama, :ongkir)");
        return $stmt->execute([':nama' => $nama_wilayah, ':ongkir' => $ongkir]);
    }

    // Update wilayah
    public function update($id, $nama_wilayah, $ongkir)
    {
        $stmt = $this->conn->prepare("UPDATE wilayah SET nama_wilayah = :nama, ongkir = :ongkir WHERE id = :id");
        return $stmt->execute([
            ':nama' => $nama_wilayah,
            ':ongkir' => $ongkir,
            ':id' => $id
        ]);
    }

    // Hapus wilayah
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM wilayah WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>