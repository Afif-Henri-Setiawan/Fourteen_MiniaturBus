<?php
require_once "../config/Database.php";
require_once "../classes/produk.php";

$produk = new Produk();
$message = "";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];
$data = $produk->getById($id);

if (!$data) {
    die("Produk tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_produk'];
    $desk = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $video = $data['video'];
    $gambar1 = $data['gambar'];
    $gambar2 = $data['gambar2'];
    $gambar3 = $data['gambar3'];

    $dir = '../uploads/';
    if (!is_dir($dir))
        mkdir($dir, 0777, true);

    if (!empty($_FILES['video']['name'])) {
        $video = time() . '_' . $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], $dir . $video);
    }

    if (!empty($_FILES['gambar1']['name'])) {
        $gambar1 = time() . '_' . $_FILES['gambar1']['name'];
        move_uploaded_file($_FILES['gambar1']['tmp_name'], $dir . $gambar1);
    }

    if (!empty($_FILES['gambar2']['name'])) {
        $gambar2 = time() . '_' . $_FILES['gambar2']['name'];
        move_uploaded_file($_FILES['gambar2']['tmp_name'], $dir . $gambar2);
    }

    if (!empty($_FILES['gambar3']['name'])) {
        $gambar3 = time() . '_' . $_FILES['gambar3']['name'];
        move_uploaded_file($_FILES['gambar3']['tmp_name'], $dir . $gambar3);
    }

    $result = $produk->update($id, $nama, $desk, $video, $gambar1, $gambar2, $gambar3, $harga);
    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Gagal memperbarui produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <title>Edit Produk</title>
</head>

<body>
    <div class="px-10 lg:px-20 pt-10 pb-5">
        <div class="flex mb-10">
            <a href="dashboard.php" class="text-blue-500">← Kembali</a>
            <h2 class="mx-auto text-3xl font-semibold">Edit Produk</h2>
        </div>

        <?php if (!empty($message)): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-1/2 w-full">
                    <label for="nama_produk" class="block mb-1 font-medium">Nama Produk *</label>
                    <input type="text" name="nama_produk" id="nama_produk" required
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4"
                        value="<?= htmlspecialchars($data['nama_kategori']) ?>">

                    <label for="harga" class="block mb-1 font-medium">Harga *</label>
                    <input type="number" name="harga" id="harga" required
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4"
                        value="<?= htmlspecialchars($data['harga']) ?>">

                    <label for="deskripsi" class="block mb-1 font-medium">Deskripsi *</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" required
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="lg:w-1/2 w-full">
                    <label for="video" class="block mb-1 font-medium">Video (Opsional)</label>
                    <input type="file" name="video" id="video" accept="video/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4">
                    <p class="text-sm text-gray-600">Video saat ini: <?= htmlspecialchars($data['video']) ?></p>

                    <label for="gambar1" class="block mb-1 font-medium">Gambar 1 (Opsional)</label>
                    <input type="file" name="gambar1" id="gambar1" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4">
                    <p class="text-sm text-gray-600">Gambar saat ini: <?= htmlspecialchars($data['gambar']) ?></p>

                    <label for="gambar2" class="block mb-1 font-medium">Gambar 2 (Opsional)</label>
                    <input type="file" name="gambar2" id="gambar2" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4">
                    <p class="text-sm text-gray-600">Gambar saat ini: <?= htmlspecialchars($data['gambar2']) ?></p>

                    <label for="gambar3" class="block mb-1 font-medium">Gambar 3 (Opsional)</label>
                    <input type="file" name="gambar3" id="gambar3" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4">
                    <p class="text-sm text-gray-600">Gambar saat ini: <?= htmlspecialchars($data['gambar3']) ?></p>
                </div>
            </div>

            <div class="flex justify-center mb-5">
                <button type="submit"
                    class="mt-4 px-8 py-3 bg-amber-400 hover:bg-amber-500 text-white rounded-md font-medium">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>

</html>