//* Spinnder Loading
document.getElementById("addLogoForm").addEventListener("submit", function () {
  document.getElementById("loadingSpinner").classList.remove("hidden");
});
document.getElementById("editForm").addEventListener("submit", function () {
  document.getElementById("loadingSpinnerEdit").classList.remove("hidden");
});

//! Modal Tambah Logo
function showModal() {
  document.getElementById("addLogoModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("addLogoModal").classList.add("hidden");
}

//!  Menangani upload gambar theme primary
document
  .getElementById("theme_primary")
  .addEventListener("change", function (event) {
    const files = event.target.files;
    const tagsContainer = document.getElementById("themePrimaryTags");

    // Clear existing tags
    tagsContainer.innerHTML = "";

    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const reader = new FileReader();

      reader.onload = function (e) {
        const tag = document.createElement("div");
        tag.classList.add(
          "relative",
          "flex",
          "items-center",
          "bg-green-100",
          "px-3",
          "py-2",
          "rounded",
          "space-x-2",
          "shadow-lg",
          "min-w-max"
        );
        tag.innerHTML = `
              <img src="${e.target.result}" alt="Thumbnail" class="w-12 h-12 object-cover rounded-md">
              <span class="text-sm text-gray-700 truncate w-32">${file.name}</span>
              <button type="button" onclick="removeTag(this)" class="absolute top-0 right-0 text-gray-600 hover:text-red-500 p-1">×</button>
          `;
        tagsContainer.appendChild(tag);
      };

      reader.readAsDataURL(file);
    }
  });

//! Menangani upload gambar theme white
document
  .getElementById("theme_white")
  .addEventListener("change", function (event) {
    const files = event.target.files;
    const tagsContainer = document.getElementById("themeWhiteTags");

    // Clear existing tags
    tagsContainer.innerHTML = "";

    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const reader = new FileReader();

      reader.onload = function (e) {
        const tag = document.createElement("div");
        tag.classList.add(
          "relative",
          "flex",
          "items-center",
          "bg-blue-100",
          "px-3",
          "py-2",
          "rounded",
          "space-x-2",
          "shadow-lg",
          "min-w-max"
        );
        tag.innerHTML = `
              <img src="${e.target.result}" alt="Thumbnail" class="w-12 h-12 object-cover rounded-md">
              <span class="text-sm text-gray-700 truncate w-32">${file.name}</span>
              <button type="button" onclick="removeTag(this)" class="absolute top-0 right-0 text-gray-600 hover:text-red-500 p-1">×</button>
          `;
        tagsContainer.appendChild(tag);
      };

      reader.readAsDataURL(file);
    }
  });

//! Fungsi untuk menghapus tag
function removeTag(button) {
  const tag = button.parentElement;
  const fileInput =
    tag.parentElement.id === "themePrimaryTags"
      ? document.getElementById("theme_primary")
      : document.getElementById("theme_white");
  const fileList = Array.from(fileInput.files); // Mengubah fileList menjadi array

  // Temukan file yang sesuai dengan tag yang dihapus
  const fileName = tag.querySelector("span").textContent;

  // Hapus file dari file input
  const updatedFiles = fileList.filter((file) => file.name !== fileName);

  // Update input file dengan file yang tersisa
  const dataTransfer = new DataTransfer(); // Membuat objek DataTransfer untuk memperbarui file input
  updatedFiles.forEach((file) => dataTransfer.items.add(file));
  fileInput.files = dataTransfer.files;

  // Hapus tag dari tampilan
  tag.remove();
}

//! Modal edit Logo
// Variabel untuk menyimpan ID gambar yang ditandai untuk dihapus sementara
let deletePrimaryIds = [];
let deleteWhiteIds = [];

// Fungsi untuk membuka modal edit dan mengisi data logo
function openEditModal(id) {
  // Set action form edit dengan ID yang benar
  $("#editForm").attr("action", `/admin/logo/${id}`);

  // Panggil AJAX untuk mendapatkan data logo yang dipilih
  $.ajax({
    url: `/admin/logo/${id}/edit`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      // Set title dan field lainnya
      if ($("#editTitle").length > 0) {
        $("#editTitle").val(data.title);
      }

      // Tampilkan preview thumbnail
      if (data.thumbnail) {
        $("#thumbnailPreview").attr(
          "src",
          `/storage/thumbnails/${data.thumbnail}`
        );
      }

      // Tampilkan preview tema primary
      if (data.theme_primary.length > 0) {
        let preview = "";
        data.theme_primary.forEach(function (img) {
          let imgPath = img.path.replace(/^public\//, "");
          preview += `
      <div id="primaryImage${img.id}" class="relative inline-block p-2 rounded-md shadow-md">
        <img src="/storage/${imgPath}" alt="theme-primary" class="w-16 h-16 object-cover rounded-md">
        <button type="button" class="absolute top-1 right-1 text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 rounded-full p-2" onclick="deleteImageUI(${img.id}, 'primary')">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>`;
        });

        // Set preview HTML langsung ke kontainer
        $("#themePrimaryPreview").html(preview);
      }

      // Tampilkan preview tema white
      if (data.theme_white.length > 0) {
        let preview = "";
        data.theme_white.forEach(function (img) {
          let imgPath = img.path.replace(/^public\//, "");
          preview += `
      <div id="whiteImage${img.id}" class="relative inline-block p-2 rounded-md shadow-md bg-black">
        <img src="/storage/${imgPath}" alt="theme-white" class="w-16 h-16 object-cover rounded-md">
        <button type="button" class="absolute top-1 right-1 text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 rounded-full p-2" onclick="deleteImageUI(${img.id}, 'white')">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>`;
        });

        // Set preview HTML langsung ke kontainer
        $("#themeWhitePreview").html(preview);
      }

      // Tampilkan modal edit
      $("#editModal").removeClass("hidden");
    },
    error: function (xhr, status, error) {
      console.error("Error fetching logo data:", error);
    },
  });
}

// Fungsi untuk menandai gambar sebagai "dihapus" di UI tanpa langsung menghapus dari database
function deleteImageUI(imageId, theme) {
  if (theme === "primary") {
    deletePrimaryIds.push(imageId);
  } else if (theme === "white") {
    deleteWhiteIds.push(imageId);
  }
  // Hilangkan gambar dari UI
  $(`#${theme}Image${imageId}`).remove();
}

// Fungsi untuk menutup modal edit dan mengatur ulang data sementara
function closeEditModal() {
  $("#editModal").addClass("hidden");
  // Reset data gambar yang ditandai untuk dihapus
  deletePrimaryIds = [];
  deleteWhiteIds = [];
}

// Tambahkan token CSRF ke header untuk setiap permintaan AJAX
$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

// Fungsi untuk submit form update
$("#editForm").on("submit", function (e) {
  e.preventDefault();

  // Ambil data dari form
  let formData = new FormData(this);
  formData.append("delete_primary_ids", deletePrimaryIds.join(","));
  formData.append("delete_white_ids", deleteWhiteIds.join(","));

  // Lakukan submit via AJAX
  $.ajax({
    url: $(this).attr("action"), // Ambil URL dari action form
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Logo and photos deleted successfully!",
        showConfirmButton: false, // Menyembunyikan tombol konfirmasi
        timer: 2000, // Timer untuk 2 detik
      }).then(() => {
        // Redirect ke halaman logo setelah alert
        window.location.href = "/admin/logo"; // Pastikan URL benar
      });
    },
    error: function (xhr, status, error) {
      console.error("Error updating data:", error);
      Swal.fire({
        icon: "error",
        title: "Gagal!",
        text: "Data gagal diperbarui. Silakan coba lagi.",
        confirmButtonText: "OK",
      });
    },
  });
});

//! open delete modal
// Fungsi untuk membuka modal
function openDeleteModal(actionUrl) {
  document.getElementById("deleteLogoModal").classList.remove("hidden");
  document.getElementById("deleteForm").action = actionUrl; // Set action URL form ke URL penghapusan yang sesuai
}

// Fungsi untuk menutup modal
function closeDeleteModal() {
  document.getElementById("deleteLogoModal").classList.add("hidden");
}
