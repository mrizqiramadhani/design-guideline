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

// //* Scramble effect --------------------------------------------------------------------- //*
// const navLinks = document.querySelectorAll(".nav-link");

// navLinks.forEach((link) => {
//   const originalText = link.innerText;
//   const delay = 30; // Waktu delay antara perubahan karakter

//   link.addEventListener("mouseover", () => {
//     const scrambledChars = originalText.split("");

//     // Reset teks untuk animasi
//     link.innerText = originalText;

//     let index = 0; // Indeks karakter yang sedang diubah

//     const scrambleNextChar = () => {
//       if (index < scrambledChars.length) {
//         const modifiedText = scrambledChars
//           .map((char, i) => {
//             if (i < index) {
//               return char; // Kembalikan karakter asli yang sudah diperbaiki
//             }
//             // Cek apakah karakter adalah huruf
//             if (/[a-zA-Z]/.test(char)) {
//               return String.fromCharCode(Math.random() * (122 - 97 + 1) + 97); // Huruf kecil a-z
//             }
//             return char; // Kembalikan karakter asli jika bukan huruf
//           })
//           .join("");

//         link.innerText = modifiedText;

//         index++; // Pindah ke karakter berikutnya
//         setTimeout(scrambleNextChar, delay); // Set delay untuk karakter berikutnya
//       } else {
//         // Setelah semua karakter diperbaiki, kembalikan ke teks asli
//         link.innerText = originalText;
//       }
//     };

//     scrambleNextChar(); // Mulai animasi
//   });
// });

//* Copy code shafwah holidays
// Show notification function
function showNotification(message) {
  const notification = document.getElementById("notification");
  notification.textContent = message;
  notification.classList.remove("hidden");
  notification.classList.add("show");

  // Hide after 3 seconds
  setTimeout(() => {
    notification.classList.remove("show");
    notification.classList.add("hidden");
  }, 3000);
}

// Copy color code to clipboard
document.querySelectorAll(".color-item").forEach((item) => {
  item.addEventListener("click", function () {
    const colorCode = this.getAttribute("data-color");

    navigator.clipboard
      .writeText(colorCode)
      .then(() => {
        showNotification(`Color code ${colorCode} copied successfully!`);
      })
      .catch((err) => {
        console.error("Gagal menyalin kode warna:", err);
      });
  });

  // Show tooltip on hover
  item.addEventListener("mouseenter", function () {
    const tooltip = this.querySelector(".copy-tooltip");
    tooltip.classList.remove("hidden");
    tooltip.style.visibility = "visible";
    tooltip.style.opacity = "1";
  });

  item.addEventListener("mouseleave", function () {
    const tooltip = this.querySelector(".copy-tooltip");
    tooltip.style.visibility = "hidden";
    tooltip.style.opacity = "0";
  });
});

//! downloads logo smooth
document.addEventListener("DOMContentLoaded", function () {
  const hash = window.location.hash;

  if (hash) {
    const target = document.querySelector(hash);
    if (target) {
      const navbarHeight = document.querySelector("#navbar").offsetHeight;
      const elementPosition =
        target.getBoundingClientRect().top + window.scrollY;
      const offsetPosition = elementPosition - navbarHeight;

      // Scroll ke posisi yang disesuaikan
      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });

      // Hapus hash dari URL tanpa refresh
      history.replaceState(null, null, " ");
    }
  }
});

//! AOS Illustration
document.addEventListener("DOMContentLoaded", function () {
  AOS.init({
    duration: 1000, // Durasi animasi dalam ms
    once: true, // Animasi hanya muncul sekali
  });

  var masonryGrid = document.querySelector("#masonry-grid");
  if (masonryGrid) {
    new Masonry(masonryGrid, {
      itemSelector: ".group", // Elemen grid target
      columnWidth: masonryGrid.querySelector(".group"), // Dasar kolom
      percentPosition: true, // Posisi relatif persen
      gutter: 18, // Jarak antar elemen
    });
  }
});

//* hamburber and navbar

function toggleDrawer() {
  document.getElementById("drawer").classList.toggle("hidden");
}

document.addEventListener("DOMContentLoaded", () => {
  const navbar = document.getElementById("navbar");
  const hamburger = document.getElementById("hamburger-icon");
  const navbarLinks = navbar.querySelectorAll("a:not(#drawer-links a)");
  const drawerLinks = document.querySelectorAll("#drawer-links a"); // Drawer links

  // Fungsi untuk memeriksa posisi scroll dan mengatur navbar
  const handleScroll = () => {
    if (window.scrollY > 50) {
      navbar.classList.add("bg-black", "text-white", "navbar-scrolled");
      navbar.classList.remove("bg-transparent", "text-black", "navbar-default");
      hamburger.setAttribute("stroke", "white"); // Mengubah warna ikon hamburger menjadi putih
      navbarLinks.forEach((link) => link.classList.add("text-white"));
      drawerLinks.forEach((link) => link.classList.add("text-black")); // Drawer links tetap hitam
    } else {
      navbar.classList.add("bg-transparent", "text-black", "navbar-default");
      navbar.classList.remove("bg-black", "text-white", "navbar-scrolled");
      hamburger.setAttribute("stroke", "black"); // Mengubah warna ikon hamburger menjadi hitam
      navbarLinks.forEach((link) => link.classList.remove("text-white"));
      drawerLinks.forEach((link) => link.classList.add("text-black")); // Drawer links tetap hitam
    }
  };

  // Periksa posisi scroll saat halaman dimuat
  handleScroll();

  // Tambahkan event listener untuk scroll
  window.addEventListener("scroll", handleScroll);
});
