// //* Spinnder Loading
// document.getElementById("addLogoForm").addEventListener("submit", function () {
//   document.getElementById("loadingSpinner").classList.remove("hidden");
// });
// document.getElementById("editForm").addEventListener("submit", function () {
//   document.getElementById("loadingSpinnerEdit").classList.remove("hidden");
// });

//! form validation modal tambah
document
  .getElementById("submitLogoForm")
  .addEventListener("click", function (event) {
    event.preventDefault(); // Mencegah form langsung dikirimkan

    const errors = [];

    // Ambil data dari form
    const title = document.getElementById("title").value.trim();
    const thumbnail = document.getElementById("thumbnail").files;
    const unitId = document.getElementById("unit_id").value;
    const themePrimary = document.getElementById("theme_primary").files;
    const themeWhite = document.getElementById("theme_white").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("formErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi title
    if (!title) {
      errors.push("Title is required.");
    } else if (title.length > 255) {
      errors.push("Title cannot exceed 255 characters.");
    }

    // Validasi thumbnail
    if (thumbnail.length === 0) {
      errors.push("Thumbnail is required.");
    } else {
      const allowedMimeTypes = [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
        "image/svg+xml",
      ];
      const maxSize = 5048 * 1024; // 5048 KB

      if (!allowedMimeTypes.includes(thumbnail[0].type)) {
        errors.push(
          "Thumbnail must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (thumbnail[0].size > maxSize) {
        errors.push("Thumbnail size must not exceed 5MB.");
      }
    }

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Bisnis is required.");
    }

    // Validasi theme_primary
    if (themePrimary.length > 0) {
      const allowedMimeTypes = [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
        "image/svg+xml",
      ];
      const maxSize = 5048 * 1024; // 5048 KB

      for (let i = 0; i < themePrimary.length; i++) {
        if (!allowedMimeTypes.includes(themePrimary[i].type)) {
          errors.push(
            "Each Theme Primary photo must be an image with jpeg, png, jpg, gif, or svg format."
          );
        }
        if (themePrimary[i].size > maxSize) {
          errors.push("Each Theme Primary photo size must not exceed 5MB.");
        }
      }
    }

    // Validasi theme_white
    if (themeWhite.length > 0) {
      const allowedMimeTypes = [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
        "image/svg+xml",
      ];
      const maxSize = 5048 * 1024; // 5048 KB

      for (let i = 0; i < themeWhite.length; i++) {
        if (!allowedMimeTypes.includes(themeWhite[i].type)) {
          errors.push(
            "Each Theme White photo must be an image with jpeg, png, jpg, gif, or svg format."
          );
        }
        if (themeWhite[i].size > maxSize) {
          errors.push("Each Theme White photo size must not exceed 5MB.");
        }
      }
    }

    // Jika ada error, tampilkan pesan error di modal
    if (errors.length > 0) {
      errors.forEach((error) => {
        const errorDiv = document.createElement("div");
        errorDiv.className = "bg-red-100 text-red-700 px-4 py-3 rounded mb-2";
        errorDiv.innerHTML = `<span class="block sm:inline">${error}</span>`;
        errorContainer.appendChild(errorDiv);
      });
      errorContainer.classList.remove("hidden"); // Tampilkan container error
    } else {
      // Jika validasi berhasil, tampilkan spinner dan submit form
      const spinner = document.getElementById("loadingSpinner");
      spinner.classList.remove("hidden"); // Tampilkan spinner
      document.getElementById("addLogoForm").submit(); // Submit form
    }
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
  $("#editForm").attr("action", `/operator/logo/${id}`);

  // Panggil AJAX untuk mendapatkan data logo yang dipilih
  $.ajax({
    url: `/operator/logo/${id}/edit`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      // Set title dan field lainnya
      if ($("#editTitle").length > 0) {
        $("#editTitle").val(data.title);
      }

      if ($("#unit_id").length > 0) {
        $("#unit_id option").prop("selected", false); // Hapus atribut selected dari semua opsi
        $(`#unit_id option[value='${data.unit_id}']`).prop("selected", true);
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

  // Reset pesan error sebelumnya
  $("#formErrorsEdit").html("").addClass("hidden");

  // Tampilkan loading spinner
  $("#loadingSpinnerEdit").removeClass("hidden");

  // Lakukan submit via AJAX
  $.ajax({
    url: $(this).attr("action"), // Ambil URL dari action form
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      // Sembunyikan loading spinner
      $("#loadingSpinnerEdit").addClass("hidden");

      // Tampilkan SweetAlert sukses
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Logo successfully updated!",
        showConfirmButton: false, // Menyembunyikan tombol konfirmasi
        timer: 2000, // Timer untuk 2 detik
      }).then(() => {
        // Redirect ke halaman logo setelah alert
        window.location.href = "/operator/logo"; // Pastikan URL benar
      });
    },
    error: function (xhr, status, error) {
      // Sembunyikan loading spinner
      $("#loadingSpinnerEdit").addClass("hidden");

      // Tampilkan pesan error di modal
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors; // Ambil error dari response JSON
        let errorList = "<ul>";
        $.each(errors, function (key, value) {
          errorList += "<li class='text-red-500'>" + value[0] + "</li>";
        });
        errorList += "</ul>";
        $("#formErrorsEdit").html(errorList).removeClass("hidden"); // Tampilkan pesan error
      } else {
        // Tampilkan alert untuk error lain
        Swal.fire({
          icon: "error",
          title: "Gagal!",
          text: "Data gagal diperbarui. Silakan coba lagi.",
          confirmButtonText: "OK",
        });
      }
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

// Fungsi untuk menampilkan overlay loading
function showLoading() {
  const loadingOverlay = document.getElementById("loading-overlay");
  loadingOverlay.classList.remove("hidden"); // Tampilkan overlay loading

  // Setelah beberapa detik, sembunyikan loading (contohnya setelah 2 detik)
  setTimeout(function () {
    loadingOverlay.classList.add("hidden"); // Sembunyikan overlay setelah loading selesai
  }, 2000); // 2 detik atau sesuaikan dengan waktu yang diperlukan untuk memuat data
}

// Event listener untuk memunculkan overlay saat klik pagination link
document.querySelectorAll("a[href]").forEach((link) => {
  link.addEventListener("click", function (e) {
    showLoading(); // Tampilkan loader saat pagination diklik
  });
});

//*dropdown navbar
// Dropdown Logic
document.getElementById("userMenuButton").onclick = function (event) {
  const dropdown = document.getElementById("userDropdown");
  dropdown.classList.toggle("hidden");
  event.stopPropagation(); // Prevent event from bubbling up
};

// Close dropdown when clicking outside
window.onclick = function (event) {
  const dropdown = document.getElementById("userDropdown");
  const userMenuButton = document.getElementById("userMenuButton");

  // Check if the clicked target is outside the dropdown and button
  if (
    !userMenuButton.contains(event.target) &&
    !dropdown.contains(event.target)
  ) {
    dropdown.classList.add("hidden");
  }
};
