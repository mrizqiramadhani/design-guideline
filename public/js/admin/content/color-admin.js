// Buka modal tambah warna
function openModal() {
    document.getElementById("addColorModal").classList.remove("hidden");
}

// Tutup modal tambah warna
function closeModal() {
    document.getElementById("addColorModal").classList.add("hidden");
}

// Fungsi untuk membuka modal konfirmasi hapus
function openDeleteModal(colorId) {
    document.getElementById("deleteConfirmModal").classList.remove("hidden");
    document.getElementById("confirmDeleteBtn").onclick = function () {
        deleteColor(colorId);
    };
}

// Fungsi untuk menutup modal konfirmasi hapus
function closeDeleteModal() {
    document.getElementById("deleteConfirmModal").classList.add("hidden");
}

// Fungsi untuk menghapus warna
function deleteColor(colorId) {
    // Ambil CSRF token dari atribut data di body
    const csrfToken = document.body.getAttribute("data-csrf-token");

    // Buat elemen form sementara untuk mengirim request delete
    const form = document.createElement("form");
    form.action = `/admin/color-palette/${colorId}`;
    form.method = "POST";

    // Tambahkan CSRF token dan method DELETE ke form
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="DELETE">
    `;

    document.body.appendChild(form);
    form.submit();
}
