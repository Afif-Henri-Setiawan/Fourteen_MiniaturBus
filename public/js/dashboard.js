function showPage(page) {
  document.getElementById("pesanan").classList.add("hidden");
  document.getElementById("produk").classList.add("hidden");
  document.getElementById(page).classList.remove("hidden");

  // Atur style aktif
  document
    .getElementById("nav-pesanan")
    .classList.remove("font-bold", "text-black");
  document.getElementById("nav-pesanan").classList.add("text-gray-500");
  document
    .getElementById("nav-produk")
    .classList.remove("font-bold", "text-black");
  document.getElementById("nav-produk").classList.add("text-gray-500");

  document
    .getElementById("nav-" + page)
    .classList.add("font-bold", "text-black");
  document.getElementById("nav-" + page).classList.remove("text-gray-500");
}

