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
    form.action = `/operator/color-palette/${colorId}`;
    form.method = "POST";

    // Tambahkan CSRF token dan method DELETE ke form
    form.innerHTML = `
        <input type="hidden" name="_token" value="${csrfToken}">
        <input type="hidden" name="_method" value="DELETE">
    `;

    document.body.appendChild(form);
    form.submit();
}

// Buka modal edit dengan data yang ada
function openEditModal(id, unitId, colorHex) {
    document.getElementById("editColorModal").classList.remove("hidden");

    // Isi form dengan data dari database
    document.getElementById("edit_unit_id").value = unitId;
    document.getElementById("editColorHex").value = colorHex; // Perbaikan ID
    document.getElementById("editColorPicker").value = colorHex;

    // Update form action URL untuk request edit
    document.getElementById("editColorForm").action = `/operator/color-palette/${id}`;
}

// Tutup modal edit
function closeEditModal() {
    document.getElementById("editColorModal").classList.add("hidden");
}

// Menyinkronkan color picker dan input kode hex pada modal tambah
document.getElementById("colorHex").addEventListener("input", function () {
    document.getElementById("colorPicker").value = this.value;
});

document.getElementById("colorPicker").addEventListener("input", function () {
    document.getElementById("colorHex").value = this.value;
});

// Menyinkronkan color picker dan input kode hex pada modal edit
document.getElementById("editColorHex").addEventListener("input", function () {
    document.getElementById("editColorPicker").value = this.value;
});

document.getElementById("editColorPicker").addEventListener("input", function () {
    document.getElementById("editColorHex").value = this.value;
});

// Sinkronkan nilai sebelum form dikirim
document.querySelector("#editColorForm").addEventListener("submit", function () {
    const colorPicker = document.getElementById("editColorPicker");
    const colorHex = document.getElementById("editColorHex");

    // Sinkronkan nilai terakhir
    colorHex.value = colorPicker.value;
});
