function openModal(id) {
    document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
    const deleteForm = document.getElementById("deleteTypographyForm");
    deleteForm.action = `/admin/typography/${id}`;
    document.getElementById("deleteTypographyModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path, fontName) {
    // Atur action URL form edit
    const form = document.getElementById("editTypographyForm");
    form.action = `/admin/typography/${id}`;

    // Set selected unit
    const unitSelect = document.getElementById("editUnitName");
    unitSelect.value = unitId;

    // Info tambahan untuk file typography
    const fileInput = document.getElementById("editImageTypography");
    fileInput.value = ""; // Kosongkan file input karena tidak bisa diisi secara programatik

    // Set value untuk font_name
    const fontNameInput = document.getElementById("editFontName");
    fontNameInput.value = fontName || ""; // Jika fontName kosong, isi dengan string kosong

    // Tampilkan modal
    const modal = document.getElementById("editTypography");
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
document
    .querySelector("#addTypography form")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah form langsung dikirimkan

        const errors = [];

        // Ambil data dari form
        const unitId = document.getElementById("unit_id").value;
        const path = document.getElementById("path").files;
        const fontName = document.getElementById("font_name").value;

        // Reset pesan error sebelumnya
        const errorContainer = document.getElementById("typographyErrors");
        errorContainer.innerHTML = ""; // Hapus semua pesan error sebelumnya
        errorContainer.classList.add("hidden"); // Sembunyikan container error

        // Validasi unit_id
        if (!unitId) {
            errors.push("Unit Name is required.");
        }

        // Validasi path (gambar)
        if (path.length === 0) {
            errors.push("Image Typography is required.");
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
                    "Image Typography must be an image with jpeg, png, jpg, gif, or svg format."
                );
            }
            if (path[0].size > maxSize) {
                errors.push("Image Typography size must not exceed 5MB.");
            }
        }

        // Validasi font_name (optional)
        if (fontName && !/^https?:\/\/.+/.test(fontName)) {
            errors.push("Typography Link must be a valid URL.");
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
    .querySelector("#editTypographyForm")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah form langsung dikirimkan

        const errors = [];

        // Ambil data dari form
        const unitId = document.getElementById("editUnitName").value;
        const path = document.getElementById("editImageTypography").files;
        const fontName = document.getElementById("editFontName").value;

        // Reset pesan error sebelumnya
        const errorContainer = document.getElementById("editTypographyErrors");
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
                    "Image Typography must be an image with jpeg, png, jpg, gif, or svg format."
                );
            }
            if (path[0].size > maxSize) {
                errors.push("Image Typography size must not exceed 5MB.");
            }
        }

        // Validasi font_name (optional)
        if (fontName && !/^https?:\/\/.+/.test(fontName)) {
            errors.push("Typography Link must be a valid URL.");
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