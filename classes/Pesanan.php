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

}

?>