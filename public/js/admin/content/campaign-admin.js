// Fungsi untuk membuka modal
function openModal(id) {
  document.getElementById(id).classList.remove("hidden");
}

// Fungsi untuk menutup modal
function closeModal(id) {
  document.getElementById(id).classList.add("hidden");
}

// Fungsi untuk membuka modal konfirmasi hapus campaign
function openDeleteModal(id) {
  const deleteForm = document.getElementById("deleteCampaignForm");
  deleteForm.action = `/admin/campaign/${id}`;
  document.getElementById("deleteCampaignModal").classList.remove("hidden");
}

// Fungsi untuk membuka modal edit campaign
function openEditModal(id, unitId, path) {
  // Atur action URL form edit
  const form = document.getElementById("editCampaignForm");
  form.action = `/admin/campaign/${id}`;

  // Set selected unit pada dropdown unit
  const unitSelect = document.getElementById("editUnitName");
  unitSelect.value = unitId;

  // Kosongkan input file gambar karena tidak bisa diisi secara programatik
  const fileInfo = document.getElementById("editImageCampaign");
  fileInfo.value = "";

  // Set status campaign pada dropdown status
  const statusSelect = document.getElementById("editStatus");
  // Menambahkan logika untuk set status dari campaign yang dipilih
  if (path && path.includes('publish')) {
    statusSelect.value = "publish";
  } else {
    statusSelect.value = "private";
  }

  // Tampilkan modal
  const modal = document.getElementById("editCampaign");
  modal.classList.remove("hidden");
}

//*dropdown navbar
// Logic untuk membuka dan menutup dropdown navbar
document.getElementById("userMenuButton").onclick = function (event) {
  const dropdown = document.getElementById("userDropdown");
  dropdown.classList.toggle("hidden");
  event.stopPropagation(); // Mencegah event bubbling
};

// Tutup dropdown jika mengklik di luar dropdown
window.onclick = function (event) {
  const dropdown = document.getElementById("userDropdown");
  const userMenuButton = document.getElementById("userMenuButton");

  // Periksa jika target yang diklik berada di luar dropdown dan button
  if (
    !userMenuButton.contains(event.target) &&
    !dropdown.contains(event.target)
  ) {
    dropdown.classList.add("hidden");
  }
};
