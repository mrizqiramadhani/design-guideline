function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteIllustrationForm");
  deleteForm.action = `/operator/illustration/${id}`;
  document.getElementById("deleteIllustrationModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path) {
  // Atur action URL form edit
  const form = document.getElementById("editIllustrationForm");
  form.action = `/operator/illustration/${id}`;

  // Set selected unit
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId;

  // Info tambahan untuk file illustration
  const fileInfo = document.getElementById("editImageIllustration");
  fileInfo.value = ""; // Kosongkan file input karena tidak bisa diisi secara programatik

  // Tampilkan modal
  const modal = document.getElementById("editIllustration");
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

//! Validation Error Modal Tambah
document
  .querySelector("#addIllustration form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form langsung dikirimkan

    const errors = [];

    // Ambil data dari form
    const unitId = document.getElementById("unit_id").value;
    const path = document.getElementById("path").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("illustrationErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Name is required.");
    }

    // Validasi path (gambar)
    if (path.length === 0) {
      errors.push("Image Illustration is required.");
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
          "Image Illustration must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (path[0].size > maxSize) {
        errors.push("Image Illustration size must not exceed 5MB.");
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

//! Validation ERror edit
document
  .querySelector("#editIllustrationForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form langsung dikirimkan

    const errors = [];

    // Ambil data dari form
    const unitId = document.getElementById("editUnitName").value;
    const path = document.getElementById("editImageIllustration").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("editIllustrationErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Name is required.");
    }

    // Validasi path (gambar)
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
          "Image Illustration must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (path[0].size > maxSize) {
        errors.push("Image Illustration size must not exceed 5MB.");
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
