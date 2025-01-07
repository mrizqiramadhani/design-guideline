function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteIconographyForm");
  deleteForm.action = `/operator/iconography/${id}`;
  document.getElementById("deleteIconographyModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path, link) {
  // Atur action URL form edit
  const form = document.getElementById("editIconographyForm");
  form.action = `/operator/iconography/${id}`;

  // Set selected unit
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId;

  // Info tambahan untuk file Iconography
  const fileInput = document.getElementById("editImageIconography");
  fileInput.value = ""; // Kosongkan file input karena tidak bisa diisi secara programatik

  // Set value untuk link
  const linkInput = document.getElementById("editLink");
  linkInput.value = link || ""; // Jika link kosong, isi dengan string kosong

  // Tampilkan modal
  const modal = document.getElementById("editIconography");
  modal.classList.remove("hidden");
}

// Dropdown navbar logic
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

// Validation for Modal Tambah
// Validation for Modal Tambah
document
  .querySelector("#addIconography form")
  .addEventListener("submit", function (event) {
      event.preventDefault(); // Mencegah form langsung dikirimkan

      const errors = [];

      // Ambil data dari form
      const unitId = document.getElementById("unit_id").value;
      const path = document.getElementById("path").files;
      const link = document.getElementById("link").value;

      // Reset pesan error sebelumnya
      const errorContainer = document.getElementById("iconographyErrors");
      errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
      errorContainer.classList.add("hidden"); // Sembunyikan container error

      // Validasi unit_id
      if (!unitId) {
          errors.push("Unit Name is required.");
      }

      // Validasi path (gambar)
      if (path.length === 0) {
          errors.push("Image Iconography is required.");
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
                  "Image Iconography must be an image with jpeg, png, jpg, gif, or svg format."
              );
          }
          if (path[0].size > maxSize) {
              errors.push("Image Iconography size must not exceed 5MB.");
          }
      }

      // Validasi link (optional)
      if (!link) {
          errors.push("Iconography Link is required.");
      } else if (link && !/^https?:\/\/.+/.test(link)) {
          errors.push("Iconography Link must be a valid URL.");
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

// Validation for Modal Edit
document
  .querySelector("#editIconographyForm")
  .addEventListener("submit", function (event) {
      event.preventDefault(); // Mencegah form langsung dikirimkan

      const errors = [];

      // Ambil data dari form
      const unitId = document.getElementById("editUnitName").value;
      const path = document.getElementById("editImageIconography").files;
      const link = document.getElementById("editLink").value;

      // Reset pesan error sebelumnya
      const errorContainer = document.getElementById("editIconographyErrors");
      errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
      errorContainer.classList.add("hidden"); // Sembunyikan container error

      // Validasi unit_id
      if (!unitId) {
          errors.push("Unit Name is required.");
      }

      // Validasi path (gambar) - hanya berlaku jika file diupload
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
                  "Image Iconography must be an image with jpeg, png, jpg, gif, or svg format."
              );
          }
          if (path[0].size > maxSize) {
              errors.push("Image Iconography size must not exceed 5MB.");
          }
      }

      // Validasi link (optional, jika diisi harus URL yang valid)
      if (link && !/^https?:\/\/.+/.test(link)) {
          errors.push("Iconography Link must be a valid URL.");
      } else if (!link) {
          errors.push("Iconography Link is required."); // Jika link kosong
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