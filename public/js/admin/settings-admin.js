function openAdminSettingsModal() {
  document.getElementById("adminSettingsModal").classList.remove("hidden");
}

function closeAdminSettingsModal() {
  document.getElementById("adminSettingsModal").classList.add("hidden");
}

function openChangeEmailModal() {
  document.getElementById("changeEmailModal").classList.remove("hidden");
}

function closeChangeEmailModal() {
  document.getElementById("changeEmailModal").classList.add("hidden");
}

function openChangePasswordModal() {
  document.getElementById("changePasswordModal").classList.remove("hidden");
}

function closeChangePasswordModal() {
  document.getElementById("changePasswordModal").classList.add("hidden");
}

function closeChangeEmailModal() {
  const modal = document.getElementById("changeEmailModal");
  modal.classList.add("animate-slide-down-large");
  setTimeout(() => {
    modal.classList.add("hidden"); // Sembunyikan modal setelah animasi selesai
    modal.classList.remove("animate-slide-down-large");
  }, 500);
}

function closeChangePasswordModal() {
  const modal = document.getElementById("changePasswordModal");
  modal.classList.add("animate-slide-down-large");
  setTimeout(() => {
    modal.classList.add("hidden"); // Sembunyikan modal setelah animasi selesai
    modal.classList.remove("animate-slide-down-large");
  }, 500);
}

function openChangeEmailModal() {
  const modal = document.getElementById("changeEmailModal");
  modal.classList.remove("hidden");
  modal.classList.add("animate-slide-up-large");
}

function openChangePasswordModal() {
  const modal = document.getElementById("changePasswordModal");
  modal.classList.remove("hidden");
  modal.classList.add("animate-slide-up-large");
}
