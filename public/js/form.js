document.addEventListener("DOMContentLoaded", () => {
  // === NAVBAR ===
  const header = document.querySelector("header");
  const hamburger = document.querySelector("#hamburger");
  const navMenu = document.querySelector("#nav-menu");

  if (header) {
    const fixedNav = header.offsetTop;
    window.onscroll = () => {
      if (window.pageYOffset > fixedNav) {
        header.classList.add("navbar-fix");
      } else {
        header.classList.remove("navbar-fix");
      }
    };
  }

  if (hamburger && navMenu) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("hamburger-active");
      navMenu.classList.toggle("hidden");
    });
  }

  // === FORM & ELEMEN ===
  const btnPesan = document.getElementById("btn-pesan");
  const formSatu = document.getElementById("form-satu");
  const formBoxSatu = document.getElementById("form-box-1");
  const formDua = document.getElementById("form-dua");
  const formBoxDua = document.getElementById("form-box-2");
  const btnSelanjutnya = document.getElementById("btn-selanjutnya");
  const btnKembali = document.getElementById("btn-kembali");
  const btnKirim = document.getElementById("btn-kirim");
  const categorySelect = document.getElementById("product-category");
  const addProductBtn = document.getElementById("add-product-btn");
  const productListContainer = document.getElementById(
    "selected-products-list"
  );
  const emptyState = document.getElementById("empty-state");
  const totalHargaText = document.getElementById("total-harga");

  let totalHarga = 0;

  const formatRupiah = (angka) => {
    return "Rp" + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  };

  const updateTotalHarga = () => {
    if (totalHargaText) {
      totalHargaText.textContent = `Total: ${formatRupiah(totalHarga)}`;
    }
  };

  const updateEmptyState = () => {
    const items = productListContainer.querySelectorAll(".product-item");
    emptyState.style.display = items.length > 0 ? "none" : "block";
  };

  const showModal = (modalElement) => {
    modalElement.classList.remove("hidden");
    modalElement.classList.add("flex");
  };

  const hideModal = (modalElement) => {
    modalElement.classList.add("hidden");
    modalElement.classList.remove("flex");
  };

  // === EVENT ===
  btnPesan.addEventListener("click", () => showModal(formSatu));

  formSatu.addEventListener("click", (e) => {
    const ignoreClick = e.target.closest(".btn-delete"); // pengecualian untuk tombol hapus
    if (!formBoxSatu.contains(e.target) && !ignoreClick) {
      hideModal(formSatu);
    }
  });

  formDua.addEventListener("click", (e) => {
    if (!formBoxDua.contains(e.target)) hideModal(formDua);
  });

  addProductBtn.addEventListener("click", () => {
    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
    if (!selectedOption || !selectedOption.value) {
      alert("Silakan pilih kategori produk terlebih dahulu.");
      return;
    }

    const productId = selectedOption.value;
    const productName = selectedOption.text;
    const harga = parseInt(selectedOption.dataset.harga);

    if (document.querySelector(`.product-item[data-id="${productId}"]`)) {
      alert("Produk ini sudah ada di daftar pesanan Anda.");
      return;
    }

    totalHarga += harga;
    updateTotalHarga();

    const productItem = document.createElement("div");
    productItem.className =
      "flex items-center justify-between p-4 bg-gray-50 border rounded-lg shadow-sm product-item";
    productItem.dataset.id = productId;
    productItem.dataset.harga = harga;

    productItem.innerHTML = `
      <span class="font-semibold text-gray-800 flex-1 pr-4">${productName} - ${formatRupiah(
      harga
    )}</span>
      <div class="flex items-center space-x-2 md:space-x-4">
        <div class="flex items-center space-x-3">
          <button type="button" class="btn-decrease bg-gray-200 text-gray-700 w-8 h-8 rounded-full flex items-center justify-center font-bold hover:bg-gray-300">-</button>
          <span class="quantity font-bold text-xl text-gray-800 w-8 text-center">1</span>
          <button type="button" class="btn-increase bg-gray-200 text-gray-700 w-8 h-8 rounded-full flex items-center justify-center font-bold hover:bg-gray-300">+</button>
        </div>
        <button type="button" class="btn-delete text-red-500 hover:text-red-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </div>
    `;

    productListContainer.appendChild(productItem);
    categorySelect.value = "";
    updateEmptyState();
  });

  productListContainer.addEventListener("click", (event) => {
    const productItem = event.target.closest(".product-item");
    if (!productItem) return;

    const harga = parseInt(productItem.dataset.harga);
    const quantitySpan = productItem.querySelector(".quantity");
    let quantity = parseInt(quantitySpan.textContent);

    if (event.target.closest(".btn-increase")) {
      quantity++;
      quantitySpan.textContent = quantity;
      totalHarga += harga;
      updateTotalHarga();
    }

    if (event.target.closest(".btn-decrease")) {
      if (quantity > 1) {
        quantity--;
        quantitySpan.textContent = quantity;
        totalHarga -= harga;
        updateTotalHarga();
      }
    }

    if (event.target.closest(".btn-delete")) {
      totalHarga -= harga * quantity;
      productItem.remove();
      updateTotalHarga();
      updateEmptyState();
    }
  });

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

  btnKembali.addEventListener("click", () => {
    showModal(formSatu);
    hideModal(formDua);
  });

  btnKirim.addEventListener("click", () => {
    alert(
      "Pesanan Terkirim! (Logika pengiriman data bisa ditambahkan di sini)"
    );
    hideModal(formDua);
  });

  function filterKategori(id) {
    const semuaProduk = document.querySelectorAll(".produk-item");
    semuaProduk.forEach((item) => {
      const idKategori = item.getAttribute("data-kategori");
      if (id === "all" || idKategori == id) {
        item.style.display = "block";
      } else {
        item.style.display = "none";
      }
    });
  }

  let produkTerpilih = [];

  document
    .getElementById("add-product-btn")
    .addEventListener("click", function () {
      const select = document.getElementById("product-category");
      const jumlah = 1; // atau ambil dari input jumlah jika ada
      const harga = parseInt(select.selectedOptions[0].dataset.harga || 0);
      const id = select.value;
      const nama = select.options[select.selectedIndex].text;
      const subtotal = jumlah * harga;

      if (id) {
        produkTerpilih.push({
          id_kategori: id,
          nama_kategori: nama,
          jumlah: jumlah,
          subtotal: subtotal,
        });

        // simpan ke input hidden
        document.getElementById("produk-detail-json").value =
          JSON.stringify(produkTerpilih);
      }
    });

  const totalHargaText1 = document.getElementById("total-harga").textContent;
  const totalNumber = parseInt(totalHargaText1.replace(/[^\d]/g, ""), 10);
  document.getElementById("total-input").value = totalNumber;
});
