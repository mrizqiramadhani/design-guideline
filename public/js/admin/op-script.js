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

//* Scramble effect --------------------------------------------------------------------- //*
const navLinks = document.querySelectorAll(".nav-link");

navLinks.forEach((link) => {
  const originalText = link.innerText;
  const delay = 30; // Waktu delay antara perubahan karakter

  link.addEventListener("mouseover", () => {
    const scrambledChars = originalText.split("");

    // Reset teks untuk animasi
    link.innerText = originalText;

    let index = 0; // Indeks karakter yang sedang diubah

    const scrambleNextChar = () => {
      if (index < scrambledChars.length) {
        const modifiedText = scrambledChars
          .map((char, i) => {
            if (i < index) {
              return char; // Kembalikan karakter asli yang sudah diperbaiki
            }
            // Cek apakah karakter adalah huruf
            if (/[a-zA-Z]/.test(char)) {
              return String.fromCharCode(Math.random() * (122 - 97 + 1) + 97); // Huruf kecil a-z
            }
            return char; // Kembalikan karakter asli jika bukan huruf
          })
          .join("");

        link.innerText = modifiedText;

        index++; // Pindah ke karakter berikutnya
        setTimeout(scrambleNextChar, delay); // Set delay untuk karakter berikutnya
      } else {
        // Setelah semua karakter diperbaiki, kembalikan ke teks asli
        link.innerText = originalText;
      }
    };

    scrambleNextChar(); // Mulai animas
  });
});

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
  modal.classList.toggle("flex");
}
function closeModal() {
  const modal = document.getElementById("addOperatorModal"); // Make sure to reference the correct modal ID
  modal.classList.remove("flex"); // Remove the 'flex' class to hide the modal
  modal.classList.add("hidden"); // Add the 'hidden' class to ensure it's not visible
}

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

function closeEditModal() {
  document.getElementById("editOperatorModal").classList.add("hidden"); // Sembunyikan modal
}
