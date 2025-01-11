//? Scroll Bar Effect
const links = document.querySelectorAll(".sidebar-sticky ul li a");
const sections = document.querySelectorAll("h2");

function setActiveLink() {
  const scrollPosition = window.scrollY + window.innerHeight / 2;

  sections.forEach((section) => {
    const sectionElement = section.parentElement; // Get the parent div
    const sectionTop = sectionElement.offsetTop;
    const sectionHeight = sectionElement.offsetHeight;

    // Check if the section is in the viewport
    if (
      scrollPosition >= sectionTop &&
      scrollPosition < sectionTop + sectionHeight
    ) {
      const id = section.getAttribute("id");
      links.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${id}`) {
          link.classList.add("active");
        }
      });
    }
  });
}

//! Smooth scrolling on click
links.forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default anchor click behavior
    const targetId = this.getAttribute("href"); // Get the target section ID
    const targetSection = document.querySelector(targetId); // Find the target section

    // Smooth scroll to the target section
    targetSection.scrollIntoView({
      behavior: "smooth", // Smooth scrolling
      block: "start", // Scroll to the top of the target section
    });

    // Set active class
    links.forEach((l) => l.classList.remove("active"));
    this.classList.add("active");
  });
});

window.addEventListener("scroll", setActiveLink);

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

//! Add Operator
function toggleModal() {
  const modal = document.getElementById("addOperatorModal");
  modal.classList.toggle("hidden");
  // modal.classList.toggle("flex");
}
function closeModal() {
  const modal = document.getElementById("addOperatorModal"); // Make sure to reference the correct modal ID
  modal.classList.remove("flex"); // Remove the 'flex' class to hide the modal
  modal.classList.add("hidden"); // Add the 'hidden' class to ensure it's not visible
}
document
  .getElementById("addOperatorForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman formulir biasa

    const formData = new FormData(this);
    const errorMessages = document.getElementById("errorMessages");

    fetch(this.action, {
      method: "POST",
      body: formData,
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
          .content, // Mengambil token dari meta
      },
    })
      .then((response) => response.json())
      .then((data) => {
        // Reset error messages
        errorMessages.innerHTML = "";
        errorMessages.classList.add("hidden"); // Sembunyikan pesan error sebelumnya

        if (data.errors) {
          errorMessages.classList.remove("hidden"); // Tampilkan elemen pesan error

          // Tampilkan semua pesan error
          for (const [key, value] of Object.entries(data.errors)) {
            value.forEach((error) => {
              errorMessages.innerHTML += `<div class="bg-red-100 text-red-700 px-4 py-3 rounded>
                    <span class="block sm:inline">${error}</span></div>`;
            });
          }
        } else if (data.success) {
          // Tampilkan pesan sukses dengan SweetAlert
          Swal.fire({
            title: "Success!",
            text: data.success,
            icon: "success",
            timer: 2000, // Pesan dari controller
            showConfirmButton: false,
          }).then(() => {
            location.reload(); // Reload halaman set  elah menambah operator
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

//todo Edit operator
function editOperatorModal(id) {
  fetch(`/admin/operator/edit/${id}`) // Ambil data operator
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      // Mengisi form dengan data operator
      document.getElementById("editName").value = data.name;
      document.getElementById("editEmail").value = data.email;
      document.getElementById("editPassword").value = ""; // Kosongkan input password

      // Set action form untuk mengupdate data
      document.getElementById(
        "editOperatorForm"
      ).action = `/admin/operator/update/${id}`; // Mengisi action dengan URL update

      // Tampilkan modal
      document.getElementById("editOperatorModal").classList.remove("hidden");
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}

// Handle form submit untuk update operator
document
  .getElementById("editOperatorForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman formulir biasa

    const formData = new FormData(this);
    const errorMessages = document.getElementById("editErrorMessages");

    fetch(this.action, {
      method: "POST",
      body: formData,
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
          .content, // Mengambil token dari meta
      },
    })
      .then((response) => {
        // Cek apakah response sukses atau error
        if (!response.ok) {
          // Jika gagal validasi, ambil error sebagai JSON
          return response.json().then((data) => {
            if (data.errors) {
              throw data.errors;
            } else {
              throw new Error("Unexpected error occurred");
            }
          });
        }
        // Jika response sukses, parse sebagai JSON
        return response.json();
      })
      .then((data) => {
        // Bersihkan pesan error sebelumnya
        errorMessages.innerHTML = "";
        errorMessages.classList.add("hidden");

        if (data.success) {
          // Tampilkan pesan sukses dengan SweetAlert
          Swal.fire({
            title: "Success!",
            text: data.success,
            icon: "success",
            timer: 2000, // Pesan dari controller
            showConfirmButton: false,
          }).then(() => {
            location.reload(); // Reload halaman setelah update operator
          });
        }
      })
      .catch((errors) => {
        console.error("Validation Errors:", errors);

        // Tampilkan pesan error validasi di dalam elemen errorMessages
        errorMessages.classList.remove("hidden"); // Tampilkan elemen pesan error
        errorMessages.innerHTML = ""; // Kosongkan pesan sebelumnya

        // Tampilkan semua pesan error
        for (const [field, messages] of Object.entries(errors)) {
          messages.forEach((error) => {
            errorMessages.innerHTML += `<div class="bg-red-100 text-red-700 px-4 py-3 rounded>
                    <span class="block sm:inline">${error}</span></div>`;
          });
        }
      });
  });

function closeEditModal() {
  document.getElementById("editOperatorModal").classList.add("hidden");
  document.getElementById("editErrorMessages").classList.add("hidden"); // Sembunyikan error messages saat modal ditutup
  document.getElementById("editErrorMessages").innerHTML = ""; // Bersihkan pesan error
}

//! Delete Modal
function showDeleteModal(id) {
  const deleteModal = document.getElementById("deleteModal");
  const deleteForm = document.getElementById("deleteForm");

  // Set the form action to delete the specific operator
  deleteForm.action = `/admin/operator/${id}`;

  // Show the modal
  deleteModal.classList.remove("hidden");
}

function closeDeleteModal() {
  const deleteModal = document.getElementById("deleteModal");
  deleteModal.classList.add("hidden");
}
