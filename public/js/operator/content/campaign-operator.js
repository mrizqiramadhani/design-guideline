function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteCampaignForm");
  deleteForm.action = `/operator/campaign/${id}`;
  document.getElementById("deleteCampaignModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path) {
  // Atur action URL form edit
  const form = document.getElementById("editCampaignForm");
  form.action = `/operator/campaign/${id}`;

  // Set selected unit
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId;

  // Info tambahan untuk file campaign
  const fileInfo = document.getElementById("editImageCampaign");
  fileInfo.value = ""; // Kosongkan file input karena tidak bisa diisi secara programatik

  // Tampilkan modal
  const modal = document.getElementById("editCampaign");
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

//! ERRor validasi modal tambah
document
  .querySelector("#addCampaign form") // Pilih form dalam modal addCampaign
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form dikirimkan langsung

    const errors = [];

    // Ambil data dari form
    const unitId = document.getElementById("unit_id").value;
    const path = document.getElementById("path").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("campaignErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Name is required.");
    }

    // Validasi path (gambar)
    if (path.length === 0) {
      errors.push("Campaign Image is required.");
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
          "Campaign Image must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (path[0].size > maxSize) {
        errors.push("Campaign Image size must not exceed 5MB.");
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

//! Validasi Error Modal edit
document
  .getElementById("editCampaignForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form dikirimkan langsung

    const errors = [];

    // Ambil data dari form
    const unitId = document.getElementById("editUnitName").value;
    const path = document.getElementById("editImageCampaign").files;

    // Reset pesan error sebelumnya
    const errorContainer = document.getElementById("editCampaignErrors");
    errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
    errorContainer.classList.add("hidden"); // Sembunyikan container error

    // Validasi unit_id
    if (!unitId) {
      errors.push("Unit Name is required.");
    }

    // Validasi path (gambar), jika ada file diupload
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
          "Campaign Image must be an image with jpeg, png, jpg, gif, or svg format."
        );
      }
      if (path[0].size > maxSize) {
        errors.push("Campaign Image size must not exceed 5MB.");
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
