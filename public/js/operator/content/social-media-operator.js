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
