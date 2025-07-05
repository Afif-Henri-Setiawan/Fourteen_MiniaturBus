<?php
require_once '../config/Database.php';
require_once '../classes/Produk.php';
require_once '../classes/Wilayah.php';

$conn = Database::getConnection();
$produk = new Produk();
$semuaProduk = $produk->getAll();
$first = $semuaProduk[0];

$wilayahObj = new Wilayah($conn);
$semuaWilayah = $wilayahObj->getAll();

// Ambil semua kategori unik
$kategoriList = $produk->getKategoriList();

// Cek apakah ada kategori yang dipilih
$idKategori = $_GET['id'] ?? null;

if ($idKategori) {
    $produkPerKategori = $produk->getByKategori($idKategori);
    $first = $produkPerKategori[0] ?? null;
} else {
    $produkPerKategori = $produk->getAll();
    $first = $produkPerKategori[0] ?? null;
}
?>


<!doctype html>
<html data-theme="light" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

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

    <!-- animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    <title>FourteenBus Workshop - Miniatur Bus</title>
</head>

<body>
    <!-- Navbar -->
    <header
        class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10 navbar-fix animate__animated animate__fadeInDown animated__delay-3s">
        <div class="container max-w-full mx-5 lg:mx-10">
            <div class="flex items-center justify-between relative">
                <div class="px-5">
                    <img src="Assets\image\Fix Logo 14 busworkshop Hitam.png" alt="logo" class="h-10 my-5">
                </div>
                <div class="flex items-center px-4">
                    <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 lg:hidden">
                        <img src="Assets\image\align-justify.svg" alt="">
                    </button>

                    <nav id="nav-menu"
                        class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                        <ul class="block lg:flex">
                            <li class="group">
                                <a href="#home"
                                    class="text-base text-dark py-2 mx-6 flex group-hover:text-blue-400 group-hover:duration-300">Beranda</a>
                            </li>
                            <li class="group">
                                <a href="#kategori"
                                    class="text-base text-dark py-2 mx-6 flex group-hover:text-blue-400 group-hover:duration-300">Kategori</a>
                            </li>
                            <li class="group">
                                <a href="#servis"
                                    class="text-base text-dark py-2 mx-6 flex group-hover:text-blue-400 group-hover:duration-300">Layanan</a>
                            </li>
                            <li class="group">
                                <a href="#kategori"
                                    class="text-base bg-amber-400 py-2 px-4 text-white text-dark mx-3 flex group-hover:text-blue-400 group-hover:duration-300">Pesan
                                    Sekarang</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Navbar end -->

    <!-- Hero section -->
    <section id="home" class="mt-40">
        <div class="container max-w-full px-10 lg:px-15">
            <div class="flex flex-wrap">
                <div class="md:w-1/2">
                    <h2
                        class="text-3xl tracking-normal font-bold lg:text-4xl mb-5 mr-2 animate__animated animate__fadeInUp animate__delay-1s">
                        Wujudkan Miniatur Bus Impian
                        Anda Dengan <br>Kualitas Unggul.</h2>

                    <p
                        class="mb-8 text-md lg:text-lg leading-6 text-dark mr-24 animate__animated animate__fadeInUp animate__delay-1s">
                        Ciptakan bus impian Anda dalam bentuk
                        miniatur
                        yang presisi
                        dan eksklusif, cocok untuk koleksi pribadi atau hadiah spesial.</p>
                    <a href="#kategori"
                        class="bg-amber-300 hover:bg-amber-400 text-white py-3 px-10 rounded-full animate__animated animate__fadeInUp animate__delay-1s">Pesan
                        Sekarang</a>
                </div>
                <div
                    class="max-w-full md:w-1/2 mt-10 md:mt-0 mb-5 grid grid-cols-2 gap-2 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="bg-amber-500 col-span-2 rounded-2xl h-52 overflow-hidden">
                        <img src="Assets\image\1.jpg" alt="" class="object-cover w-full h-full">
                    </div>
                    <div class="bg-amber-500 rounded-xl h-36 overflow-hidden">
                        <img src="Assets\image\4.jpg" alt="" class="object-cover w-full h-full">
                    </div>
                    <div class="bg-amber-500 rounded-xl h-36 overflow-hidden">
                        <img src="Assets\image\5.jpg" alt="" class="object-cover w-full h-full">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section end -->

    <!-- carousel -->
    <div class="carousel w-full h-60 md:h-72 lg:h-80 mt-20">
        <div id="slide1" class="carousel-item relative w-full overflow-hidden">
            <img src="Assets\image\1.jpg" class="object-cover w-full h-full" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide3" class="btn btn-circle bg-transparant border-none">❮</a>
                <a href="#slide2" class="btn btn-circle bg-transparant border-none">❯</a>
            </div>
        </div>
        <div id="slide2" class="carousel-item relative w-full overflow-hidden">
            <img src="Assets\image\1.jpg" class="object-cover w-full h-full" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide1" class="btn btn-circle bg-transparant border-none">❮</a>
                <a href="#slide3" class="btn btn-circle bg-transparant border-none">❯</a>
            </div>
        </div>
    </div>
    <!-- carousel end -->

    <!-- Kategori -->
    <section id="kategori" class="mb-28 mt-20 ">
        <div class="container max-w-full px-10 lg:px-15">
            <h2 class="text-3xl font-semibold text-center" data-aos="fade-up" data-aos-duration="1100">Kategori</h2>
            <div class="flex flex-wrap justify-center mt-8 gap-4" data-aos="fade-up" data-aos-duration="1100">
                <?php foreach ($kategoriList as $kategori): ?>
                    <a href="?id=<?= $kategori['id_kategori'] ?>"
                        class="w-80 h-48 bg-amber-300 relative overflow-hidden group rounded-xl shadow-md transition-all duration-300 hover:scale-105 block">
                        <img src="../uploads/<?= htmlspecialchars($kategori['gambar']) ?>"
                            alt="<?= htmlspecialchars($kategori['nama_kategori']) ?>"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-black/30"></div>
                        <p class="absolute inset-0 flex items-center justify-center text-white text-2xl font-bold z-10">
                            <?= htmlspecialchars($kategori['nama_kategori']) ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-3 gap-4 mt-10 p-6" data-aos="fade-up" data-aos-duration="1100">

                <div
                    class="bg-red-600 h-[1920] col-span-3 lg:row-span-3 lg:col-span-1 flex items-center overflow-hidden justify-center rounded-xl">
                    <?php if (!empty($first['video'])): ?>
                        <video controls class="w-full h-[1920] object-cover rounded-xl">
                            <source src="../uploads/<?= htmlspecialchars($first['video']) ?>" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    <?php endif; ?>
                </div>

                <!-- Gambar 1 -->
                <div class="bg-red-500 h-60 col-span-3 lg:col-span-1 rounded-xl">
                    <img src="../uploads/<?= htmlspecialchars($first['gambar2']) ?>" alt="Gambar 2"
                        class="w-full h-full object-cover rounded-xl">
                </div>

                <!-- Gambar 2 -->
                <div class="bg-red-500 h-60 col-span-3 lg:col-span-1 rounded-xl">
                    <img src="../uploads/<?= htmlspecialchars($first['gambar3']) ?>" alt="Gambar 3"
                        class="w-full h-full object-cover rounded-xl">
                </div>

                <!-- Gambar 3 -->
                <div class="bg-red-400 h-72 col-span-3 lg:col-span-2 hidden lg:block rounded-xl">
                    <img src="../uploads/<?= htmlspecialchars($first['gambar']) ?>" alt="Gambar Tambahan"
                        class="w-full h-full object-cover rounded-xl">
                </div>

                <!-- Deskripsi -->
                <div class="col-span-3 lg:col-span-2 rounded-xl pl-2">
                    <h3 class="text-3xl font-bold">Deskripsi</h3>
                    <p class="text-lg font-semibold"><?= htmlspecialchars($first['nama_kategori']) ?> (Skala 1:50)</p>
                    <ul class="list-none pl-2 mt-1">
                        <li><?= nl2br(htmlspecialchars($first['deskripsi'])) ?></li>
                        <li class="list-none font-semibold text-xl">Harga: Rp<?= number_format($first['harga']) ?></li>
                    </ul>
                </div>

            </div>
            <div class="min-w-full flex justify-center mx-auto">
                <button id="btn-pesan"
                    class="bg-green-500 text-white cursor-pointer font-bold text-xl px-20 py-4 rounded-full shadow-lg hover:bg-green-600 duration-100">
                    Pesan Sekarang
                </button>

                <!-- form pesanan -->
                <form id="form-pemesanan" method="POST" action="simpan_pesanan.php" enctype="multipart/form-data"
                    class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50 p-4 modal-container">
                    <div id="form-box-1"
                        class="w-full max-w-3xl bg-white p-6 md:p-8 rounded-xl shadow-lg flex flex-col max-h-[90vh] overflow-y-auto">

                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Form Pemesanan</h1>
                        <p class="text-gray-500 mb-6">Pilih produk, unggah gambar contoh (opsional), dan isi data
                            pemesanan.</p>

                        <!-- Pilih Produk -->
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="flex-grow">
                                <label for="product-category" class="sr-only">Pilih Produk</label>
                                <select id="product-category"
                                    class="block w-full p-3 border border-gray-300 rounded-lg text-lg">
                                    <option value="" disabled selected>-- Pilih Kategori Produk --</option>
                                    <?php foreach ($semuaProduk as $item): ?>
                                        <option value="<?= $item['id_kategori'] ?>" data-harga="<?= $item['harga'] ?>">
                                            <?= htmlspecialchars($item['nama_kategori']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button id="add-product-btn" type="button"
                                class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-5 rounded-lg flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Tambah</span>
                            </button>
                        </div>

                        <hr class="my-4">

                        <!-- Produk Dipesan -->
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Produk Dipesan</h2>
                        <div id="selected-products-list" class="space-y-4 mb-6">
                            <div id="empty-state"
                                class="text-center py-8 px-4 border-2 border-dashed border-gray-300 rounded-lg">
                                <p class="text-gray-500">Belum ada produk yang ditambahkan.</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Gambar Contoh -->
                        <div class="mb-6">
                            <label for="image-upload" class="block text-xl font-semibold text-gray-700 mb-2">Upload
                                Gambar Contoh (Opsional)</label>
                            <input id="image-upload" type="file" class="w-full" name="gambar_request" />
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        <!-- Catatan Tambahan -->
                        <div class="mb-4">
                            <label for="additional-notes" class="block text-xl font-semibold text-gray-700 mb-2">Catatan
                                Tambahan (Opsional)</label>
                            <textarea id="additional-notes" name="deskripsi_tambahan" rows="4"
                                class="block w-full p-3 border border-gray-300 rounded-lg"
                                placeholder="Contoh: Buat seperti bus PO Haryanto"></textarea>
                        </div>

                        <!-- Data Diri -->
                        <div class="mb-3">
                            <label for="name" class="block text-gray-700 text-md font-medium">Nama <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="nama"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label for="nomor" class="block text-gray-700 text-md font-medium">Nomor WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" id="nomor" name="telepon"
                                class="w-full border border-gray-300 rounded px-3 py-2" placeholder="08xxx" required>
                        </div>

                        <div class="mb-3">
                            <label for="wilayah" class="block text-gray-700 text-md font-medium">Pilih Wilayah <span class="text-red-500">*</span></label>
                            <select id="select-wilayah" name="id_wilayah" required
                                class="block w-full p-3 border border-gray-300 rounded-lg text-lg">
                                <option value="">-- Pilih Wilayah --</option>
                                <?php foreach ($semuaWilayah as $wilayah): ?>
                                    <option value="<?= $wilayah['id'] ?>" data-ongkir="<?= $wilayah['ongkir'] ?>">
                                        <?= htmlspecialchars($wilayah['nama_wilayah']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>


                        <div class="mb-3">
                            <label for="alamat" class="block text-gray-700 text-md font-medium">Alamat <span class="text-red-500">*</span></label>
                            <input type="text" id="alamat" name="alamat"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Masukkan alamat lengkap" required>
                        </div>

                        <!-- Upload Bukti Bayar -->
                        <div class="my-3">
                            <label class="block text-gray-700 text-md font-medium">Upload Bukti Bayar <span class="text-red-500">*</span></label>
                            <input type="file" name="bukti_bayar" required class="w-full">
                            <p class="text-sm text-gray-500">Format JPG/PNG, maksimal 2MB</p>
                        </div>

                        <!-- Rekening -->
                        <div class="mt-3">
                            <h2 class="font-semibold">Pembayaran</h2>
                            <p>BRI : 092189389172312</p>
                        </div>

                        <div class="mt-3">
                            <input type="hidden" id="ongkir" name="ongkir" value="0" />
                            <p class="text-gray-600 text-sm mt-2">Ongkos Kirim: <span id="ongkir-text">Rp0</span></p>
                        </div>

                        <!-- Total + Submit -->
                        <div class="mt-6 pt-4 border-t flex justify-between md:flex-row">
                            <div class="text-right md:w-auto left-0 ">
                                <p id="subtotal-text" class="text-sm text-gray-600">
                                    Subtotal: Rp0 + Ongkir: Rp0
                                </p>
                                <p id="total-bayar" class="text-xl font-bold text-red-600 mt-1">
                                    Total Bayar: Rp0
                                </p>
                            </div>

                            <button type="submit"
                                class="mt-4 ml-4 md:mt-0 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg flex items-center space-x-2">
                                <span>Kirim</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                            <input type="hidden" name="total" id="total-input" />
                        </div>

                    </div>

                    <!-- Hidden Input -->
                    <input type="hidden" name="produk_detail" id="produk-detail-json">

            </div>
            </form>

            <!-- Form pertama end -->

    </section>
    <!-- Kategori end -->

    <!-- servis -->
    <section id="servis" class="mt-20">
        <div class="container max-w-full px-10 lg:px-15">
            <h2 class="text-4xl font-semibold text-center my-10 pb-5" data-aos="fade-up" data-aos-duration="1100">
                Layanan Kami</h2>
            <div class="my-8">
                <div class="flex flex-wrap">
                    <div class="w-full rounded-xl h-80 overflow-hidden lg:w-1/2" data-aos="fade-up"
                        data-aos-duration="1200">
                        <img src="Assets\image\buat.jpg" alt="" class="w-full h-full object-cover">
                    </div>

                    <div class="lg:w-1/2 lg:pl-8 lg:pt-8" data-aos="fade-up" data-aos-duration="1300">
                        <h3 class="text-3xl font-semibold mt-10 mb-3 lg:mt-0">Buatan Tangan, Penuh Ketelitian</h3>
                        <p class="text-justify text-base lg:mr-4">Setiap miniatur bus kami dibuat dengan tangan oleh
                            pengrajin
                            berpengalaman, bukan hasil pabrik massal. Mulai dari detail bodi, livery, hingga aksesori
                            kecil seperti spion dan plat nomor—semua dikerjakan dengan teliti, satu per satu. Hasilnya?
                            Miniatur dengan sentuhan personal dan nilai koleksi tinggi yang tidak bisa ditemukan di mana
                            pun.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-10 lg:pt-20 pb-10 ">
                <div class="flex flex-wrap">
                    <div class="w-full rounded-xl h-80 overflow-hidden lg:w-1/2 lg:hidden" data-aos="fade-up"
                        data-aos-duration="1200">
                        <img src="Assets/image/packing.jpg" alt="" class="w-full h-full object-cover">
                    </div>

                    <div class="lg:w-1/2 lg:pr-8 lg:pt-5" data-aos="fade-up" data-aos-duration="1300">
                        <h3 class="text-3xl font-semibold mt-10 mb-3 lg:mt-0 ">Pengemasan Aman, Sampai Tanpa Cacat</h3>
                        <p class="text-justify lg:mr-8">Kami tahu betapa berharganya miniatur ini bagi Anda. Karena itu,
                            setiap pesanan kami bungkus dengan hati-hati menggunakan lapisan bubble wrap berlapis dan
                            kardus kokoh. Kami pastikan miniatur sampai di tangan Anda dalam kondisi sempurna, siap
                            dipajang atau dijadikan hadiah spesial.
                        </p>
                    </div>

                    <div class="hidden h-80 rounded-xl overflow-hidden lg:w-1/2 lg:block" data-aos="fade-up"
                        data-aos-duration="1300">
                        <img src="Assets/image/packing.jpg" alt="" class="w-full h-full object-cover">
                    </div>

                </div>
            </div>


        </div>
    </section>
    <!-- servis end -->

    <!-- Section FAQ -->
    <section class="w-full px-4 md:px-20 py-20 bg-white">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-yellow-600 mb-10">Pertanyaan Umum</h2>

        <div class="max-w-4xl mx-auto space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-gray-100 rounded-xl">
                <button onclick="toggleFaq(this)"
                    class="w-full flex justify-between items-center px-6 py-4 text-left font-medium text-gray-800 focus:outline-none">
                    Bagaimana cara memesan produk?
                    <span class="transform transition-transform duration-200 text-xl">&#9662;</span>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600">
                    Untuk memesan, silakan kunjungi halaman produk, klik tombol "Pesan Sekarang", lalu isi formulir
                    pemesanan sesuai instruksi. Atau hubungi kami langsung melalui WhatsApp.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-gray-100 rounded-xl">
                <button onclick="toggleFaq(this)"
                    class="w-full flex justify-between items-center px-6 py-4 text-left font-medium text-gray-800 focus:outline-none">
                    Berapa lama waktu pembuatan?
                    <span class="transform transition-transform duration-200 text-xl">&#9662;</span>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600">
                    Waktu pembuatan biasanya memakan waktu 3–5 hari kerja tergantung pada tingkat kerumitan dan jumlah
                    pesanan.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-gray-100 rounded-xl">
                <button onclick="toggleFaq(this)"
                    class="w-full flex justify-between items-center px-6 py-4 text-left font-medium text-gray-800 focus:outline-none">
                    Metode pembayaran apa yang tersedia?
                    <span class="transform transition-transform duration-200 text-xl">&#9662;</span>
                </button>
                <div class="hidden px-6 pb-4 text-gray-600">
                    Kami menerima pembayaran melalui transfer bank (BCA, BRI), QRIS, serta e-wallet seperti Dana, OVO,
                    dan GoPay.
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer sm:footer-horizontal bg-base-200 text-base-content pl-28 p-10">
        <aside>
            <img src="Assets/image/Fix Logo 14 busworkshop Hitam.png" class="h-16 mt-5" alt="">
            <p>
                Fourteen Bus Workshop<br />
                &copy; 2025 | <a href="profil_dev.php" class="hover:text-amber-800 duration-200">Team Development</a>
            </p>
        </aside>

        <!-- Link navigasi -->
        <nav class="mt-5">
            <h6 class="footer-title">About us</h6>
            <a href="#home" class="link link-hover">Beranda</a>
            <a href="#kategori" class="link link-hover">Kategori</a>
            <a href="#servis" class="link link-hover">Layanan</a>
        </nav>

        <!-- Media sosial -->
        <nav class="mt-5">
            <h6 class="footer-title">Sosial Media</h6>
            <a href="https://www.instagram.com/14.busworkshop?utm_source=ig_web_button_share_sheet&igsh=MWxuNnBvbjUzZ3hvdQ=="
                class="link link-hover">Instagram</a>
            <a href="#" class="link link-hover">Facebook</a>
            <a href="#" class="link link-hover">WhatsApp</a>
        </nav>

        <!-- Alamat dan Google Maps -->
        <div class="mt-5">
            <h6 class="footer-title">Alamat Kami</h6>
            <p>Fourteen Bus Workshop<br>Kutasari, Purbalingga, Jawa Tengah</p>
            <div class="mt-3 rounded-xl overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.298317877058!2d109.2368359!3d-7.198261899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655d6339d11e71%3A0xb070f61a93e7b9f!2sFourteen%20Bus%20Workshop!5e0!3m2!1sid!2sid!4v1719248999999!5m2!1sid!2sid"
                    width="300" height="100" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </footer>


    <!-- js -->
    <!-- <script src="js\script.js"></script> -->
    <script src="js\form.js"></script>
    <!-- js end-->

    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>