document.addEventListener("DOMContentLoaded", () => {
  // === ELEMEN PENTING ===
  // --- Blok untuk Navbar & Hamburger ---
  const header = document.querySelector("header");
  const hamburger = document.querySelector("#hamburger");
  const navMenu = document.querySelector("#nav-menu");

  if (header) {
    const fixedNav = header.offsetTop;
    window.onscroll = function () {
      if (window.pageYOffset > fixedNav) {
        header.classList.add("navbar-fix");
      } else {
        header.classList.remove("navbar-fix");
      }
    };
  }

  if (hamburger && navMenu) {
    hamburger.addEventListener("click", function () {
      hamburger.classList.toggle("hamburger-active");
      navMenu.classList.toggle("hidden");
    });
  }
  // Tombol utama
  const btnPesan = document.getElementById("btn-pesan");

  // Form 1
  const formSatu = document.getElementById("form-satu");
  const formBoxSatu = document.getElementById("form-box-1");
  const categorySelect = document.getElementById("product-category");
  const addProductBtn = document.getElementById("add-product-btn");
  const productListContainer = document.getElementById(
    "selected-products-list"
  );
  const emptyState = document.getElementById("empty-state");
  const btnSelanjutnya = document.getElementById("btn-selanjutnya");

  // Form 2
  const formDua = document.getElementById("form-dua");
  const formBoxDua = document.getElementById("form-box-2");
  const btnKembali = document.getElementById("btn-kembali");
  const btnKirim = document.getElementById("btn-kirim");

  // === FUNGSI-FUNGSI ===

  // Fungsi untuk menampilkan modal
  const showModal = (modalElement) => {
    modalElement.classList.remove("hidden");
    modalElement.classList.add("flex");
  };

  // Fungsi untuk menyembunyikan modal
  const hideModal = (modalElement) => {
    modalElement.classList.add("hidden");
    modalElement.classList.remove("flex");
  };

  // Fungsi untuk update state jika list produk kosong/isi
  const updateEmptyState = () => {
    const items = productListContainer.querySelectorAll(".product-item");
    emptyState.style.display = items.length > 0 ? "none" : "block";
  };

  // === EVENT LISTENERS ===

  // Tampilkan Form 1 saat tombol "Pesan Sekarang" diklik
  btnPesan.addEventListener("click", () => {
    showModal(formSatu);
  });

  // Sembunyikan Form 1 jika klik di luar area form-box
  formSatu.addEventListener("click", (e) => {
    if (!formBoxSatu.contains(e.target)) {
      hideModal(formSatu);
    }
  });

  // Sembunyikan Form 2 jika klik di luar area form-box
  formDua.addEventListener("click", (e) => {
    if (!formBoxDua.contains(e.target)) {
      hideModal(formDua);
    }
  });

  // Logika untuk menambah produk ke list
  addProductBtn.addEventListener("click", () => {
    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
    if (!selectedOption || !selectedOption.value) {
      alert("Silakan pilih kategori produk terlebih dahulu.");
      return;
    }

    const productId = selectedOption.value;
    const productName = selectedOption.text;

    if (document.querySelector(`.product-item[data-id="${productId}"]`)) {
      alert("Produk ini sudah ada di daftar pesanan Anda.");
      return;
    }

    const productItemHTML = `
            <div class="flex items-center justify-between p-4 bg-gray-50 border rounded-lg shadow-sm product-item" data-id="${productId}">
                <span class="font-semibold text-gray-800 flex-1 pr-4">${productName}</span>
                <div class="flex items-center space-x-2 md:space-x-4">
                    <div class="flex items-center space-x-3">
                        <button type="button" class="btn-decrease bg-gray-200 text-gray-700 w-8 h-8 rounded-full flex items-center justify-center font-bold hover:bg-gray-300">-</button>
                        <span class="quantity font-bold text-xl text-gray-800 w-8 text-center">1</span>
                        <button type="button" class="btn-increase bg-gray-200 text-gray-700 w-8 h-8 rounded-full flex items-center justify-center font-bold hover:bg-gray-300">+</button>
                    </div>
                    <button type="button" class="btn-delete text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>`;

    productListContainer.insertAdjacentHTML("beforeend", productItemHTML);
    categorySelect.value = "";
    updateEmptyState();
  });

  // Logika untuk tombol (+), (-), dan hapus pada list produk
  productListContainer.addEventListener("click", (event) => {
    const productItem = event.target.closest(".product-item");
    if (!productItem) return;

    if (event.target.closest(".btn-increase")) {
      const quantitySpan = productItem.querySelector(".quantity");
      quantitySpan.textContent = parseInt(quantitySpan.textContent) + 1;
    }

    if (event.target.closest(".btn-decrease")) {
      const quantitySpan = productItem.querySelector(".quantity");
      let quantity = parseInt(quantitySpan.textContent);
      if (quantity > 1) {
        quantitySpan.textContent = quantity - 1;
      }
    }

    if (event.target.closest(".btn-delete")) {
      event.stopPropagation(); // << Tambahkan ini untuk mencegah modal tertutup
      productItem.remove();
      updateEmptyState();
    }
  });

  // Tombol "Selanjutnya" untuk ke Form 2 dengan validasi
  btnSelanjutnya.addEventListener("click", () => {
    const items = productListContainer.querySelectorAll(".product-item");

    if (items.length === 0) {
      Swal.fire({
        icon: "warning",
        title: "Oops!",
        text: "Silakan pilih minimal satu produk sebelum melanjutkan.",
        confirmButtonColor: "#3085d6",
      });
      return;
    }

    hideModal(formSatu);
    showModal(formDua);
  });

  // (BARU) Tombol "Kembali" untuk ke Form 1
  btnKembali.addEventListener("click", () => {
    showModal(formSatu);
    hideModal(formDua);
  });

  // (BARU) Placeholder untuk tombol Kirim Pesanan
  btnKirim.addEventListener("click", () => {
    alert(
      "Pesanan Terkirim! (Logika pengiriman data bisa ditambahkan di sini)"
    );
    hideModal(formDua);
    // Di sini Anda bisa menambahkan logika untuk mengirim semua data form
  });
});
