//! Modal Tambah Logo
function showModal() {
  document.getElementById("addLogoModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("addLogoModal").classList.add("hidden");
}

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
              <img src="${e.target.result}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-md">
              <span class="text-sm text-gray-700 truncate w-32">${file.name}</span>
              <button type="button" onclick="removeTag(this)" class="absolute top-0 right-0 text-gray-600 hover:text-red-500 p-1">×</button>
          `;
        tagsContainer.appendChild(tag);
      };

      reader.readAsDataURL(file);
    }
  });

// Menangani upload gambar theme white
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
              <img src="${e.target.result}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-md">
              <span class="text-sm text-gray-700 truncate w-32">${file.name}</span>
              <button type="button" onclick="removeTag(this)" class="absolute top-0 right-0 text-gray-600 hover:text-red-500 p-1">×</button>
          `;
        tagsContainer.appendChild(tag);
      };

      reader.readAsDataURL(file);
    }
  });

// Fungsi untuk menghapus tag
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
//! Modal edit Logo
function openEditModal(id) {
  // Set the form action for editing
  $("#editForm").attr("action", `/admin/logo/${id}`);

  // Make an AJAX call to get the data for the selected logo
  $.ajax({
    url: `/admin/logo/${id}/edit`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      // Set the title and other fields in the modal
      if ($("#editTitle").length > 0) {
        $("#editTitle").val(data.title);
      }

      // Set the thumbnail preview in the modal
      if (data.thumbnail) {
        $("#thumbnailPreview").attr(
          "src",
          `/storage/thumbnails/${data.thumbnail}`
        );
      }

      // Set the theme primary images preview
      if (data.theme_primary.length > 0) {
        let preview = "";
        data.theme_primary.forEach(function (img) {
          // Hapus 'public/' dari path jika ada
          let imgPath = img.path.replace(/^public\//, "");
          preview += `
            <div class="relative inline-block">
              <img src="/storage/${imgPath}" alt="theme-primary" class="w-16 h-16 object-cover mr-2 mb-2 rounded-md">
              <button type="button" class="absolute top-0 right-0 text-white bg-red-600 rounded-full p-1" onclick="deleteImage('${img.id}', 'primary')">×</button>
            </div>`;
        });
        $("#themePrimaryPreview").html(preview);
      }

      // Set the theme white images preview
      if (data.theme_white.length > 0) {
        let preview = "";
        data.theme_white.forEach(function (img) {
          // Hapus 'public/' dari path jika ada
          let imgPath = img.path.replace(/^public\//, "");
          preview += `
            <div class="relative inline-block">
              <img src="/storage/${imgPath}" alt="theme-white" class="w-16 h-16 object-cover mr-2 mb-2 rounded-md">
              <button type="button" class="absolute top-0 right-0 text-white bg-red-600 rounded-full p-1" onclick="deleteImage('${img.id}', 'white')">×</button>
            </div>`;
        });
        $("#themeWhitePreview").html(preview);
      }

      // Show the modal
      $("#editModal").removeClass("hidden");
    },
    error: function (xhr, status, error) {
      console.error("Error fetching logo data:", error);
    },
  });
}

// Menambahkan token CSRF ke header untuk setiap permintaan AJAX
$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

// Function to delete image
function deleteImage(imageId, theme) {
  $.ajax({
    url: `/admin/logo/photo/${imageId}/delete`,
    method: "DELETE",
    data: { theme: theme },
    success: function (response) {
      if (response.success) {
        // Remove the image from the preview
        $(`#${theme}Image${imageId}`).remove();
      } else {
        alert("Failed to delete image");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error deleting image:", error);
    },
  });
}

function closeEditModal() {
  document.getElementById("editModal").classList.add("hidden");
}

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
