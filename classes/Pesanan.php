<?php
class Pesanan
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // Menyimpan data pesanan baru
    public function create($nama, $telepon, $alamat, $bukti_bayar, $gambar_request, $deskripsi, $total)
    {
        $stmt = $this->conn->prepare("INSERT INTO pesanan 
        (nama_pembeli, no_telp, alamat, bukti_bayar, gambar_request, deskripsi_tambahan, total, tanggal_pesan)
        VALUES (:nama, :telepon, :alamat, :bukti_bayar, :gambar_request, :deskripsi_tambahan, :total, NOW())");

        $stmt->execute([
            ':nama' => $nama,
            ':telepon' => $telepon,
            ':alamat' => $alamat,
            ':bukti_bayar' => $bukti_bayar,
            ':gambar_request' => $gambar_request,
            ':deskripsi_tambahan' => $deskripsi,
            ':total' => $total
        ]);
        return $this->conn->lastInsertId();
    }

    public function updateStatus($id_pesanan, $status)
    {
        $stmt = $this->conn->prepare("UPDATE pesanan SET status = :status WHERE id_pesanan = :id");
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id_pesanan
        ]);
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM pesanan ORDER BY tanggal_pesan DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pesanan WHERE id_pesanan = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function count()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM pesanan");
        return $stmt->fetchColumn();
    }


}

?>