document
  .getElementById("toggle-new-password")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("new-password");
    const icon = this.querySelector(".iconify");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.setAttribute("data-icon", "mdi:eye-off");
    } else {
      passwordInput.type = "password";
      icon.setAttribute("data-icon", "mdi:eye");
    }
  });

document
  .getElementById("toggle-confirm-password")
  .addEventListener("click", function () {
    const passwordInput = document.getElementById("confirm-password");
    const icon = this.querySelector(".iconify");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.setAttribute("data-icon", "mdi:eye-off");
    } else {
      passwordInput.type = "password";
      icon.setAttribute("data-icon", "mdi:eye");
    }
  });

document
  .getElementById("resetPasswordForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah form langsung dikirimkan

    let isValid = true;

    // Ambil elemen input dan error
    const newPassword = document.getElementById("new-password");
    const confirmPassword = document.getElementById("confirm-password");
    const newPasswordError = document.getElementById("new-password-error");
    const confirmPasswordError = document.getElementById(
      "confirm-password-error"
    );

    // Reset error sebelumnya
    newPasswordError.classList.add("hidden");
    confirmPasswordError.classList.add("hidden");
    newPassword.classList.remove("border-red-500");
    confirmPassword.classList.remove("border-red-500");

    // Validasi New Password
    if (newPassword.value.trim().length < 6) {
      newPasswordError.textContent = "Password must be at least 6 characters.";
      newPasswordError.classList.remove("hidden");
      newPassword.classList.add("border-red-500");
      isValid = false;
    }

    // Validasi Confirm Password
    if (confirmPassword.value.trim() !== newPassword.value.trim()) {
      confirmPasswordError.textContent = "Passwords do not match.";
      confirmPasswordError.classList.remove("hidden");
      confirmPassword.classList.add("border-red-500");
      isValid = false;
    }

    // Jika validasi berhasil, submit form
    if (isValid) {
      this.submit();
    }
  });
