<?php
require_once "../config/Database.php";
require_once "../classes/produk.php";

$produk = new Produk();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_produk'];
    $desk = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Validasi input
    if (empty($nama) || empty($desk) || empty($harga)) {
        $message = "Semua field wajib diisi!";
    } else {
        $video = $_FILES['video']['name'];
        $gambar1 = $_FILES['gambar1']['name'];
        $gambar2 = $_FILES['gambar2']['name'];
        $gambar3 = $_FILES['gambar3']['name'];

        $dir = '../uploads/';

        // Pastikan folder uploads ada
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $uploadSuccess = true;
        $errorMessage = "";

        // Upload video jika ada
        if (!empty($video)) {
            $videoPath = $dir . time() . '_' . $video;
            if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoPath)) {
                $uploadSuccess = false;
                $errorMessage .= "Gagal upload video. ";
            } else {
                $video = time() . '_' . $video;
            }
        }

        // Upload gambar 1 jika ada
        if (!empty($gambar1)) {
            $gambar1Path = $dir . time() . '_' . $gambar1;
            if (!move_uploaded_file($_FILES['gambar1']['tmp_name'], $gambar1Path)) {
                $uploadSuccess = false;
                $errorMessage .= "Gagal upload gambar 1. ";
            } else {
                $gambar1 = time() . '_' . $gambar1;
            }
        }

        // Upload gambar 2 jika ada
        if (!empty($gambar2)) {
            $gambar2Path = $dir . time() . '_' . $gambar2;
            if (!move_uploaded_file($_FILES['gambar2']['tmp_name'], $gambar2Path)) {
                $uploadSuccess = false;
                $errorMessage .= "Gagal upload gambar 2. ";
            } else {
                $gambar2 = time() . '_' . $gambar2;
            }
        }

        // Upload gambar 3 jika ada
        if (!empty($gambar3)) {
            $gambar3Path = $dir . time() . '_' . $gambar3;
            if (!move_uploaded_file($_FILES['gambar3']['tmp_name'], $gambar3Path)) {
                $uploadSuccess = false;
                $errorMessage .= "Gagal upload gambar 3. ";
            } else {
                $gambar3 = time() . '_' . $gambar3;
            }
        }

        if ($uploadSuccess) {
            // Panggil fungsi add dari class Produk
            $result = $produk->add($nama, $desk, $video, $gambar1, $gambar2, $gambar3, $harga);

            if ($result) {
                $message = "Produk berhasil ditambahkan!";
                // Redirect ke dashboard setelah berhasil
                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Gagal menambahkan produk ke database!";
            }
        } else {
            $message = "Error: " . $errorMessage;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- goggle font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- google font end -->

    <!-- css -->
    <link href="../src/output.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="Assets/image/Fix Logo 14 busworkshop Hitam.png" sizes="100x10">
    <!-- End Favicon -->

    <title>Document</title>
</head>

<body>
    <div class="px-10 lg:px-20 pt-10 pb-5">
        <div class="flex mb-10">
            <a href="dashboard.php" class="text-blue-500 hover:text-blue-700">← Kembali</a>
            <h2 class="mx-auto text-3xl font-semibold">Tambah Produk</h2>
        </div>

        <!-- Tampilkan pesan jika ada -->
        <?php if (!empty($message)): ?>
            <div
                class="mb-4 p-4 rounded-md <?php echo strpos($message, 'berhasil') !== false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Kolom Kiri -->
                <div class="lg:w-1/2 w-full">
                    <label for="nama_produk" class="block mb-1 font-medium">Nama Produk *</label>
                    <input type="text" name="nama_produk" id="nama_produk" required
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="<?php echo isset($_POST['nama_produk']) ? htmlspecialchars($_POST['nama_produk']) : ''; ?>">

                    <label for="harga" class="block mb-1 font-medium">Harga *</label>
                    <input type="number" name="harga" id="harga" required
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="<?php echo isset($_POST['harga']) ? htmlspecialchars($_POST['harga']) : ''; ?>">

                    <label for="deskripsi" class="block mb-1 font-medium">Deskripsi *</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" required
                        class="w-full px-3 py-4 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : ''; ?></textarea>
                </div>

                <!-- Kolom Kanan -->
                <div class="lg:w-1/2 w-full">
                    <label for="video" class="block mb-1 font-medium">Video *</label>
                    <input type="file" name="video" id="video" accept="video/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-600 mb-4">Format: MP4, AVI, MOV (Max: 50MB)</p>

                    <label for="gambar1" class="block mb-1 font-medium">Gambar 1 *</label>
                    <input type="file" name="gambar1" id="gambar1" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <label for="gambar2" class="block mb-1 font-medium">Gambar 2 *</label>
                    <input type="file" name="gambar2" id="gambar2" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <label for="gambar3" class="block mb-1 font-medium">Gambar 3 *</label>
                    <input type="file" name="gambar3" id="gambar3" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <p class="text-sm text-gray-600">Format gambar: JPG, PNG, GIF (Max: 5MB per file)</p>
                </div>
            </div>

            <div class="flex justify-center mb-5">
                <button type="submit"
                    class="mt-4 px-8 py-3 bg-amber-400 hover:bg-amber-500 text-white rounded-md font-medium transition-colors">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>

    <script>
        // Validasi ukuran file
        document.addEventListener('DOMContentLoaded', function () {
            const videoInput = document.getElementById('video');
            const imageInputs = ['gambar1', 'gambar2', 'gambar3'];

            // Validasi video (max 50MB)
            videoInput.addEventListener('change', function () {
                if (this.files[0] && this.files[0].size > 50 * 1024 * 1024) {
                    alert('Ukuran video terlalu besar! Maksimal 50MB.');
                    this.value = '';
                }
            });

            // Validasi gambar (max 5MB)
            imageInputs.forEach(function (inputId) {
                const input = document.getElementById(inputId);
                input.addEventListener('change', function () {
                    if (this.files[0] && this.files[0].size > 5 * 1024 * 1024) {
                        alert('Ukuran gambar terlalu besar! Maksimal 5MB.');
                        this.value = '';
                    }
                });
            });
        });
    </script>
</body>

</html>