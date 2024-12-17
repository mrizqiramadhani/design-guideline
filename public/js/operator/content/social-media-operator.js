function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteSocialMediaForm");
  deleteForm.action = `/operator/social-media/${id}`;
  document.getElementById("deleteSocialMediaModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path, type) {
  // Atur action URL form edit
  const form = document.getElementById("editSocialMediaForm");
  form.action = `/operator/social-media/${id}`;

  // Set unit ID terpilih
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId;

  // Set type terpilih
  const typeSelect = document.getElementById("editSocialMediaType");
  typeSelect.value = type;

  // Kosongkan input file (tidak bisa diatur secara programatik)
  const fileInput = document.getElementById("editImageSocialMedia");
  fileInput.value = "";

  // Tampilkan modal
  const modal = document.getElementById("editSocialMedia");
  modal.classList.remove("hidden");
}

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

//! Erro validasi tambah modal
document
  .querySelector("#addSocialMedia form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form langsung dikirimkan

    const errors = [];

    // Ambil data dari form
    const unitId = document.getElementById("unit_id").value;
    const type = document.getElementById("type").value;
    const path = document.getElementById("path").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("SocialErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Name is required.");
    }

    // Validasi type
    if (!type) {
      errors.push("Social Media Type is required.");
    }

    // Validasi path (gambar)
    if (path.length === 0) {
      errors.push("Social Media Image is required.");
    } else {
      const allowedMimeTypes = [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
        "image/svg+xml",
      ];
      const maxSize = 5048 * 1024; // 5048 KB

      if (!allowedMimeTypes.includes(path[0].type)) {
        errors.push(
          "Social Media Image must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (path[0].size > maxSize) {
        errors.push("Social Media Image size must not exceed 5MB.");
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
      // Jika validasi berhasil, submit form
      this.submit();
    }
  });

//! validasi error edit modal
document
  .querySelector("#editSocialMediaForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form langsung dikirimkan

    const errors = [];

    // Ambil data dari form
    const unitId = document.getElementById("editUnitName").value;
    const type = document.getElementById("editSocialMediaType").value;
    const path = document.getElementById("editImageSocialMedia").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("editSocialErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Name is required.");
    }

    // Validasi type
    if (!type) {
      errors.push("Social Media Type is required.");
    }

    // Validasi path (gambar) hanya jika file dipilih
    if (path.length > 0) {
      const allowedMimeTypes = [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
        "image/svg+xml",
      ];
      const maxSize = 5048 * 1024; // 5048 KB

      if (!allowedMimeTypes.includes(path[0].type)) {
        errors.push(
          "Social Media Image must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (path[0].size > maxSize) {
        errors.push("Social Media Image size must not exceed 5MB.");
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
      // Jika validasi berhasil, submit form
      this.submit();
    }
  });
