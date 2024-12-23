function openModal(modalId) {
  document.getElementById(modalId).classList.remove("hidden");
}

function openEditModal(modalId) {
  document.getElementById(modalId).classList.remove("hidden");
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.add("hidden");
}

function openEditDescriptionModal(id, unitId, title, content) {
  // Atur action URL form edit
  const form = document.getElementById("editDescriptionForm");
  form.action = `/operator/description/${id}`; // Menggunakan ID untuk update

  // Set selected unit
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId; // Menyesuaikan pilihan unit

  // Set title dan content
  document.getElementById("editTitle").value = title;
  document.getElementById("editContent").value = content;

  // Tampilkan modal
  const modal = document.getElementById("editDescription");
  modal.classList.remove("hidden");
}

function openDeleteDescriptionModal(id) {
  // Atur action URL form delete
  const form = document.getElementById("deleteDescriptionForm");
  form.action = `/operator/description/${id}`;

  // Tampilkan modal
  const modal = document.getElementById("deleteDescriptionModal");
  modal.classList.remove("hidden");
}

function showModal(title, content) {
  const descriptionTitleElement = document.getElementById("descriptionTitle");
  const descriptionContentElement =
    document.getElementById("descriptionContent");

  // Mengatur judul dengan logika if-else
  if (title) {
    descriptionTitleElement.innerText = title;
    descriptionTitleElement.classList.remove("text-gray-500"); // Warna default
    descriptionTitleElement.classList.add("text-gray-900"); // Warna untuk teks ada
  } else {
    descriptionTitleElement.innerText = "No title desc";
    descriptionTitleElement.classList.remove("text-gray-900"); // Warna teks ada
    descriptionTitleElement.classList.add("text-gray-500"); // Warna untuk teks kosong
  }

  // Mengatur konten menggunakan value
  descriptionContentElement.value = content || "N/A";

  // Menampilkan modal
  document.getElementById("viewDescription").classList.remove("hidden");
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
