function openAdminSettingsModal() {
  document.getElementById("adminSettingsModal").classList.remove("hidden");
  closeOtherModals("adminSettingsModal");
}

function closeAdminSettingsModal() {
  document.getElementById("adminSettingsModal").classList.add("hidden");
}

function openChangeEmailModal() {
  document.getElementById("changeEmailModal").classList.remove("hidden");
  closeOtherModals("changeEmailModal");
}

function closeChangeEmailModal() {
  document.getElementById("changeEmailModal").classList.add("hidden");
}

function openChangePasswordModal() {
  document.getElementById("changePasswordModal").classList.remove("hidden");
  closeOtherModals("changePasswordModal");
}

function closeChangePasswordModal() {
  document.getElementById("changePasswordModal").classList.add("hidden");
}

// Function to close other modals
function closeOtherModals(currentModal) {
  const modals = [
    "adminSettingsModal",
    "changeEmailModal",
    "changePasswordModal",
  ];
  modals.forEach((modal) => {
    if (modal !== currentModal) {
      document.getElementById(modal).classList.add("hidden");
    }
  });
}

function togglePassword(id, iconId) {
  const passwordInput = document.getElementById(id);
  const icon = document.getElementById(iconId).querySelector(".iconify");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.setAttribute("data-icon", "mdi:eye-off");
  } else {
    passwordInput.type = "password";
    icon.setAttribute("data-icon", "mdi:eye");
  }
}

// Add event listeners for toggling passwords
document
  .getElementById("toggle-old-password-email")
  .addEventListener("click", function () {
    togglePassword("oldPasswordChangeEmail", "toggle-old-password-email");
  });

document
  .getElementById("toggle-current-password")
  .addEventListener("click", function () {
    togglePassword("currentPasswordChangePassword", "toggle-current-password");
  });

document
  .getElementById("toggle-new-password")
  .addEventListener("click", function () {
    togglePassword("newPassword", "toggle-new-password");
  });

document
  .getElementById("toggle-confirm-password")
  .addEventListener("click", function () {
    togglePassword("confirmPassword", "toggle-confirm-password");
  });
