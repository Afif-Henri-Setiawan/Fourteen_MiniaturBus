<?php
class PesananDetail
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // Tambahkan satu produk ke dalam pesanan
    public function add($id_pesanan, $id_kategori, $jumlah, $subtotal)
    {
        $sql = "INSERT INTO pesanan_detail (id_pesanan, id_kategori, jumlah, subtotal)
                VALUES (:id_pesanan, :id_kategori, :jumlah, :subtotal)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id_pesanan' => $id_pesanan,
            ':id_kategori' => $id_kategori,
            ':jumlah' => $jumlah,
            ':subtotal' => $subtotal
        ]);
    }

    // Ambil semua produk dalam satu pesanan
    public function getByPesanan($id_pesanan)
    {
        $sql = "SELECT pd.*, p.nama_kategori
            FROM pesanan_detail pd
            JOIN produk p ON pd.id_kategori = p.id_kategori
            WHERE pd.id_pesanan = :id_pesanan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_pesanan' => $id_pesanan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Hapus semua produk berdasarkan id_pesanan
    public function deleteByPesanan($id_pesanan)
    {
        $stmt = $this->conn->prepare("DELETE FROM pesanan_detail WHERE id_pesanan = :id");
        return $stmt->execute([':id' => $id_pesanan]);
    }
}

?>