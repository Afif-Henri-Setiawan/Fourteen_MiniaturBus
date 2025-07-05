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

function filterPesanan(status) {
  const items = document.querySelectorAll(".pesanan-item");
  items.forEach((item) => {
    const visible = status === "semua" || item.classList.contains(status);
    item.style.display = visible ? "flex" : "none";
  });

  // Highlight active button
  document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.classList.remove("ring-2", "ring-offset-1", "ring-black");
  });
  event.target.classList.add("ring-2", "ring-offset-1", "ring-black");
}

// Default: tampilkan semua saat pertama kali
document.addEventListener("DOMContentLoaded", () => filterPesanan("semua"));
