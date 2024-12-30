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
