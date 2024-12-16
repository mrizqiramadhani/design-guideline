function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteIllustrationForm");
  deleteForm.action = `/admin/illustration/${id}`;
  document.getElementById("deleteIllustrationModal").classList.remove("hidden");
}

function openEditModal(id, unitId, path) {
  // Atur action URL form edit
  const form = document.getElementById("editIllustrationForm");
  form.action = `/admin/illustration/${id}`;

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
