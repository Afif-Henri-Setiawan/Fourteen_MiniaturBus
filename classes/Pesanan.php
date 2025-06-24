<?php
class Pesanan
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // Menyimpan data pesanan baru
    public function create($nama, $telepon, $alamat, $bukti_bayar, $total)
    {
        $stmt = $this->conn->prepare("INSERT INTO pesanan 
        (nama_pembeli, no_telp, alamat, bukti_bayar, total, tanggal_pesan)
        VALUES (:nama, :telepon, :alamat, :bukti_bayar, :total, NOW())");

        $stmt->execute([
            ':nama' => $nama,
            ':telepon' => $telepon,
            ':alamat' => $alamat,
            ':bukti_bayar' => $bukti_bayar,
            ':total' => $total
        ]);

        return $this->conn->lastInsertId(); // untuk relasi ke pesanan_detail
    }


    // Ambil semua pesanan
    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM pesanan ORDER BY tanggal_pesan DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu pesanan berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pesanan WHERE id_pesanan = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hapus pesanan
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM pesanan WHERE id_pesanan = :id");
        return $stmt->execute([':id' => $id]);
    }
}

?>