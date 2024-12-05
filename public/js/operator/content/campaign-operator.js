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
