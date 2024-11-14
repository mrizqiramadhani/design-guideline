//! Modal Tambah Logo
function showModal() {
  document.getElementById("addLogoModal").classList.remove("hidden");
}
function closeModal() {
  document.getElementById("addLogoModal").classList.add("hidden");
}

//! Modal edit Logo
function openEditModal(id) {
  // Set the form action for editing
  $("#editForm").attr("action", `/admin/logo/${id}`);

  // Make an AJAX call to get the data for the selected logo
  $.ajax({
    url: `/admin/logo/${id}/edit`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      // Set the title and other fields in the modal
      if ($("#editTitle").length > 0) {
        $("#editTitle").val(data.title);
      }

      // Set the thumbnail preview in the modal
      if (data.thumbnail) {
        $("#thumbnailPreview").attr(
          "src",
          `/storage/thumbnails/${data.thumbnail}`
        );
      }

      // Show the modal
      $("#editModal").removeClass("hidden");
    },
    error: function (xhr, status, error) {
      console.error("Error fetching logo data:", error);
    },
  });
}

function closeEditModal() {
  document.getElementById("editModal").classList.add("hidden");
}

//! open delete modal
// Fungsi untuk membuka modal
function openDeleteModal(actionUrl) {
  document.getElementById("deleteLogoModal").classList.remove("hidden");
  document.getElementById("deleteForm").action = actionUrl; // Set action URL form ke URL penghapusan yang sesuai
}

// Fungsi untuk menutup modal
function closeDeleteModal() {
  document.getElementById("deleteLogoModal").classList.add("hidden");
}
