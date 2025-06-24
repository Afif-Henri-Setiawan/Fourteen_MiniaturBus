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
            <a href="dashboard.php">back</a>
            <h2 class="mx-auto text-3xl font-semibold">Detail Pembayaran</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 items-start">

            <!-- Bukti Bayar (Kiri) -->
            <div class="flex flex-col items-center mt-5 gap-4">
                <img src="Assets\image\2.jpg" alt="Bukti Pembayaran"
                    class="w-[300px] h-[400px] object-cover rounded-xl border shadow" />

                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row mt-5 gap-4">
                    <button
                        class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-lg transition">Setujui</button>
                    <button
                        class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2 rounded-lg transition">Tolak</button>
                </div>
            </div>


            <!-- Informasi Pembayaran (Kanan) -->
            <div class="space-y-4 lg:pt-8 ">
                <div>
                    <h3 class="font-medium text-gray-700">Nama Pemesan:</h3>
                    <p class="text-gray-900">Afif Henri</p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Nomor Telepon:</h3>
                    <p class="text-gray-900">0812-3456-7890</p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Tanggal Pembayaran:</h3>
                    <p class="text-gray-900">20 Juni 2025</p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700">Total Pembayaran:</h3>
                    <p class="text-gray-900">Rp750.000</p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-700 flex items-center gap-2">
                        Request:
                        <!-- Ikon untuk melihat gambar -->
                        <a href="gambar-request.jpg" target="_blank" class="text-blue-600 hover:text-blue-800"
                            title="Lihat Gambar Request">
                            <!-- Heroicons eye (lihat) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                    </h3>
                    <p class="text-gray-900 text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Voluptatibus maiores doloremque sit, aliquam animi impedit facilis dolores inventore deleniti
                        voluptates asperiores nihil. Iusto nihil facilis neque animi laborum deleniti exercitationem,
                        sequi praesentium vero perferendis labore assumenda aut quidem unde aliquam quos vel numquam
                        consequuntur fuga molestiae tenetur modi sint ipsam tempore. Consectetur necessitatibus
                        voluptatum minus tenetur quo, tempore ad, eaque iusto labore error vel itaque et velit numquam
                        nam optio? Totam at, obcaecati cumque molestias velit reiciendis optio unde facilis animi illum
                        veritatis perferendis provident inventore odit autem, debitis deserunt dignissimos. Molestiae
                        doloribus atque quas dolorum id mollitia earum quis?</p>
                </div>
            </div>
        </div>


    </div>
</body>

</html>