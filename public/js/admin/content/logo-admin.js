//! Modal Tambah Logo
function showModal() {
  document.getElementById("addLogoModal").classList.remove("hidden");
}
function closeModal() {
  document.getElementById("addLogoModal").classList.add("hidden");
}

//* handle tambah logo

//! Modal edit Logo
function openEditModal(id) {
  $("#editForm").attr("action", `/admin/logo/${id}`);

  $.ajax({
    url: `/admin/logo/${id}/edit`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      console.log("Response data:", data);
      // console.log("Title to insert:", data.title);

      if ($("#editTitle").length > 0) {
        $("#editTitle").val(data.title);
      }

      if (data.theme_white && data.theme_white.length > 0) {
        $("#themeWhiteContainer").empty();
        data.theme_white.forEach((image) => {
          $("#themeWhiteContainer").append(`
            <img src="/storage/${image.path}" class="w-16 h-16 object-cover rounded border">
          `);
        });
      } else {
        $("#themeWhiteContainer").empty();
      }

      setTimeout(function () {
        $("#editModal").removeClass("hidden");
      }, 100);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching logo data:", error);
    },
  });
}

function closeEditModal() {
  document.getElementById("editModal").classList.add("hidden");
}
