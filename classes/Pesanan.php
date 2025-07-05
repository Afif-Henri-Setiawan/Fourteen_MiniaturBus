<?php
class Pesanan
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // CREATE - Menyimpan data pesanan baru
    public function create($nama, $telepon, $alamat, $bukti_bayar, $gambar_request, $deskripsi, $total, $id_wilayah, $ongkir)
    {
        $stmt = $this->conn->prepare("INSERT INTO pesanan 
            (nama_pembeli, no_telp, alamat, bukti_bayar, gambar_request, deskripsi_tambahan, total, id_wilayah, ongkir, tanggal_pesan)
            VALUES (:nama, :telepon, :alamat, :bukti_bayar, :gambar_request, :deskripsi, :total, :id_wilayah, :ongkir, NOW())");

        $stmt->execute([
            ':nama' => $nama,
            ':telepon' => $telepon,
            ':alamat' => $alamat,
            ':bukti_bayar' => $bukti_bayar,
            ':gambar_request' => $gambar_request,
            ':deskripsi' => $deskripsi,
            ':total' => $total,
            ':id_wilayah' => $id_wilayah,
            ':ongkir' => $ongkir
        ]);

        return $this->conn->lastInsertId();
    }

    // READ - Mendapatkan semua pesanan (dengan nama wilayah)
    public function getAll()
    {
        $stmt = $this->conn->query("SELECT p.*, w.nama_wilayah 
                                    FROM pesanan p 
                                    LEFT JOIN wilayah w ON p.id_wilayah = w.id 
                                    ORDER BY p.tanggal_pesan DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Mendapatkan satu pesanan berdasarkan ID
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT p.*, w.nama_wilayah 
                                      FROM pesanan p 
                                      LEFT JOIN wilayah w ON p.id_wilayah = w.id 
                                      WHERE p.id_pesanan = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Ubah status pesanan
    public function updateStatus($id_pesanan, $status)
    {
        $stmt = $this->conn->prepare("UPDATE pesanan SET status = :status WHERE id_pesanan = :id");
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id_pesanan
        ]);
    }

    // DELETE - Hapus pesanan
    public function delete($id_pesanan)
    {
        $stmt = $this->conn->prepare("DELETE FROM pesanan WHERE id_pesanan = :id");
        return $stmt->execute([':id' => $id_pesanan]);
    }

    // UTILITY - Hitung jumlah semua pesanan
    public function count()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM pesanan");
        return $stmt->fetchColumn();
    }
}
?>