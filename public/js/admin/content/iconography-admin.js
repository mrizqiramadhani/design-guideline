function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteIconographyForm");
  deleteForm.action = `/admin/iconography/${id}`;
  document.getElementById("deleteIconographyModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path) {
  // Atur action URL form edit
  const form = document.getElementById("editIconographyForm");
  form.action = `/admin/iconography/${id}`;

  // Set selected unit
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId;

  // Info tambahan untuk file Iconography
  const fileInfo = document.getElementById("editImageIconography");
  fileInfo.value = ""; // Kosongkan file input karena tidak bisa diisi secara programatik

  // Tampilkan modal
  const modal = document.getElementById("editIconography");
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
