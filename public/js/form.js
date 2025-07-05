document.addEventListener("DOMContentLoaded", () => {
  const btnPesan = document.getElementById("btn-pesan");
  const formPemesanan = document.getElementById("form-pemesanan");
  const categorySelect = document.getElementById("product-category");
  const addProductBtn = document.getElementById("add-product-btn");
  const productListContainer = document.getElementById(
    "selected-products-list"
  );
  const emptyState = document.getElementById("empty-state");
  const subtotalText = document.getElementById("subtotal-text");
  const totalBayarElement = document.getElementById("total-bayar");
  const totalInput = document.getElementById("total-input");
  const ongkirInput = document.getElementById("ongkir");
  const ongkirText = document.getElementById("ongkir-text");
  const wilayahSelect = document.getElementById("select-wilayah");

  let produkTerpilih = [];

  const formatRupiah = (angka) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR",
      minimumFractionDigits: 0,
    }).format(angka);
  };

  const showModal = (el) => {
    el.classList.remove("hidden");
    el.classList.add("flex");
  };

  const hideModal = (el) => {
    el.classList.add("hidden");
    el.classList.remove("flex");
  };

  const renderPesanan = () => {
    productListContainer.innerHTML = "";

    if (produkTerpilih.length === 0) {
      productListContainer.appendChild(emptyState);
      emptyState.style.display = "block";
    } else {
      emptyState.style.display = "none";
      produkTerpilih.forEach((produk) => {
        const item = document.createElement("div");
        item.className =
          "flex justify-between items-center p-3 bg-gray-100 rounded-lg product-item";
        item.dataset.id = produk.id_kategori;

        item.innerHTML = `
          <div>
            <p class="font-bold">${produk.nama_kategori}</p>
            <p class="text-sm text-gray-600">${formatRupiah(
              produk.harga_satuan
            )}</p>
          </div>
          <div class="flex items-center space-x-2">
            <button class="btn-decrease px-2 bg-gray-300 rounded-full">-</button>
            <span class="quantity">${produk.jumlah}</span>
            <button class="btn-increase px-2 bg-gray-300 rounded-full">+</button>
            <button class="btn-delete text-red-500 ml-2">Hapus</button>
          </div>
        `;

        productListContainer.appendChild(item);
      });
    }

    const subtotal = produkTerpilih.reduce(
      (total, produk) => total + produk.subtotal,
      0
    );

    const ongkir = parseInt(ongkirInput.value) || 0;
    const totalBayar = subtotal + ongkir;

    subtotalText.innerHTML = `
      <span class="text-sm text-gray-600">
        Subtotal: ${formatRupiah(subtotal)} + Ongkir: ${formatRupiah(ongkir)}
      </span>
    `;
    totalBayarElement.textContent = `Total Bayar: ${formatRupiah(totalBayar)}`;
    totalInput.value = totalBayar;
  };

  if (btnPesan) {
    btnPesan.addEventListener("click", () => {
      showModal(formPemesanan);
    });
  }

  if (formPemesanan) {
    formPemesanan.addEventListener("click", (e) => {
      if (e.target.id === "form-pemesanan") {
        hideModal(formPemesanan);
      }
    });
  }

  if (addProductBtn) {
    addProductBtn.addEventListener("click", () => {
      const selectedOption =
        categorySelect.options[categorySelect.selectedIndex];
      if (!selectedOption || !selectedOption.value)
        return alert("Silakan pilih produk.");

      const id = selectedOption.value;
      if (produkTerpilih.some((p) => p.id_kategori === id))
        return alert("Produk ini sudah ditambahkan.");

      produkTerpilih.push({
        id_kategori: id,
        nama_kategori: selectedOption.text,
        harga_satuan: parseInt(selectedOption.dataset.harga),
        jumlah: 1,
        get subtotal() {
          return this.harga_satuan * this.jumlah;
        },
      });

      renderPesanan();
      categorySelect.value = "";
    });
  }

  if (productListContainer) {
    productListContainer.addEventListener("click", (e) => {
      const item = e.target.closest(".product-item");
      if (!item) return;
      const id = item.dataset.id;
      const produk = produkTerpilih.find((p) => p.id_kategori === id);
      if (!produk) return;

      if (e.target.closest(".btn-increase")) produk.jumlah++;
      if (e.target.closest(".btn-decrease") && produk.jumlah > 1)
        produk.jumlah--;
      if (e.target.closest(".btn-delete"))
        produkTerpilih = produkTerpilih.filter((p) => p.id_kategori !== id);

      renderPesanan();
    });
  }

  if (wilayahSelect) {
    wilayahSelect.addEventListener("change", () => {
      const selected = wilayahSelect.options[wilayahSelect.selectedIndex];
      const ongkirBaru = parseInt(selected.getAttribute("data-ongkir")) || 0;
      ongkirInput.value = ongkirBaru;

      if (ongkirText) {
        ongkirText.textContent = formatRupiah(ongkirBaru);
      }

      renderPesanan();
    });
  }

  formPemesanan.addEventListener("submit", (e) => {
    if (produkTerpilih.length === 0) {
      e.preventDefault();
      alert("Minimal pilih 1 produk.");
      return;
    }

    const ongkir = parseInt(ongkirInput.value) || 0;
    const total = produkTerpilih.reduce(
      (acc, produk) => acc + produk.subtotal,
      0
    );
    const totalAkhir = total + ongkir;

    document.getElementById("produk-detail-json").value =
      JSON.stringify(produkTerpilih);
    document.getElementById("total-input").value = totalAkhir;

    // Hindari klik ganda
    e.target.querySelector("button[type='submit']").disabled = true;
  });
});

function toggleFaq(btn) {
  const answer = btn.nextElementSibling;
  const icon = btn.querySelector("span");
  answer.classList.toggle("hidden");
  icon.classList.toggle("rotate-180");
}
