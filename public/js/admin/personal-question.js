// Fungsi untuk membuka modal dengan validasi tambahan
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (!modal) {
    console.error(`Modal with ID "${modalId}" not found.`);
    return;
  }
  modal.classList.remove("hidden");
}

// Fungsi untuk menutup modal dengan validasi tambahan
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (!modal) {
    console.error(`Modal with ID "${modalId}" not found.`);
    return;
  }
  modal.classList.add("hidden");
}

// Fungsi untuk membuka modal Answer Validation
function openAnswerValidationModal(id) {
  //   console.log("Received ID in openAnswerValidationModal:", id); // Log ID
  const form = document.getElementById("answerValidationForm");
  const errorElement = document.getElementById("securityAnswerError");

  if (!form) {
    console.error("Answer Validation Form not found.");
    return;
  }
  if (!id) {
    console.error("ID is missing for Answer Validation.");
    return;
  }

  // Atur action ke route validate
  const actionUrl = `/admin/security-questions/${id}/validate`;
  //   console.log("Form action URL:", actionUrl); // Log URL
  form.action = actionUrl;

  // Reset error state
  errorElement.textContent = "";
  errorElement.classList.add("hidden");

  // Tangani submit form
  form.onsubmit = function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch(actionUrl, {
      method: "POST",
      body: formData,
      headers: {
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    })
      .then((response) => {
        if (!response.ok) throw response;
        return response.json();
      })
      .then((data) => {
        // console.log("Validation successful:", data); // Debug log
        closeModal("answerValidationModal"); // Tutup modal validasi
        openEditModal(data.id, data); // Buka modal edit langsung
      })
      .catch(async (error) => {
        if (error.json) {
          const errData = await error.json();
          // Tampilkan pesan error di bawah input
          errorElement.textContent = errData.error || "Validation failed.";
          errorElement.classList.remove("hidden");
        } else {
          console.error("Unexpected error:", error);
          errorElement.textContent = "An unexpected error occurred.";
          errorElement.classList.remove("hidden");
        }
      });
  };

  openModal("answerValidationModal");
}

// Fungsi untuk membuka modal Edit Question
function openEditModal(id, question) {
  const form = document.getElementById("editQuestionForm");
  if (!form) {
    console.error("Edit Question Form not found.");
    return;
  }

  // Atur action ke route update
  form.action = `/admin/security-questions/${id}`;
  document.getElementById("editQuestionInput").value =
    question?.security_question || "";
  document.getElementById("editAnswerInput").value = ""; // Kosongkan jawaban

  openModal("editQuestionModal");
}

function deleteQuestion(id) {
  console.log("Delete ID:", id); // Log ID untuk memastikan ID diterima
  const form = document.getElementById("deleteQuestionForm");
  if (!form) {
    console.error("Delete Question Form not found.");
    return;
  }
  // Atur action URL berdasarkan ID
  form.action = `/admin/security-questions/${id}`;
  openModal("deleteConfirmationModal"); // Buka modal delete
}
