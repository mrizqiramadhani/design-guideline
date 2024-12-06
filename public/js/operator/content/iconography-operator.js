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
  
  function openEditModal(id, unitId, path) {
    // Atur action URL form edit
    const form = document.getElementById("editIconographyForm");
    form.action = `/operator/iconography/${id}`;
  
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
  