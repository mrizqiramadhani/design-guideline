<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personal Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 py-10">
    <!-- Back Button -->
    <a href="{{ route('admin.dashboard') }}"
        class="absolute top-4 left-4 flex items-center bg-gray-500 text-white px-3 py-2 rounded hover:bg-gray-600">
        <span class="iconify" data-icon="mdi:arrow-left" data-inline="false"></span>
        <span class="ml-2">Back</span>
    </a>

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">Personal Information</h1>

        <!-- Add Question Button -->
        <button id="addQuestionButton" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
            onclick="openModal('addQuestionModal')">
            Add Question
        </button>

        <!-- Table -->
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Question</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody id="questionTableBody">
                @foreach ($questions as $index => $question)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $question->security_question }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 mr-2"
                                onclick="openAnswerValidationModal({{ $question->id }})">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                onclick="deleteQuestion({{ $question->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- add modal --}}
    <div id="addQuestionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Add Security Question</h2>
            <form action="{{ route('security-questions.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="security_question" class="block text-gray-700 mb-1">Question</label>
                    <input type="text" id="security_question" name="security_question"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label for="security_answer" class="block text-gray-700 mb-1">Answer</label>
                    <input type="text" id="security_answer" name="security_answer"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                {{-- <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1">Current Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div> --}}
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('addQuestionModal')"
                        class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Answer Validation Modal -->
    <div id="answerValidationModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Answer Validation</h2>
            <form id="answerValidationForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Answer</label>
                    <input type="text" name="security_answer" class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    @error('security_answer')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('answerValidationModal')"
                        class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Validate</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Question Modal -->
    <div id="editQuestionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Edit Security Question</h2>
            <form id="editQuestionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">New Question</label>
                    <input type="text" id="editQuestionInput" name="security_question"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                    @error('security_question')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">New Answer</label>
                    <input type="text" id="editAnswerInput" name="security_answer"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                    @error('security_answer')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editQuestionModal')"
                        class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteConfirmationModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Delete Security Question</h2>
            <p class="mb-4">Are you sure you want to delete this security question?</p>
            <form id="deleteQuestionForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('deleteConfirmationModal')"
                        class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal dengan validasi tambahan
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) {
                console.error(`Modal with ID "${modalId}" not found.`);
                return;
            }
            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal dengan validasi tambahan
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) {
                console.error(`Modal with ID "${modalId}" not found.`);
                return;
            }
            modal.classList.add('hidden');
        }

        // Fungsi untuk membuka modal Answer Validation
        function openAnswerValidationModal(id) {
            console.log("Received ID in openAnswerValidationModal:", id); // Log ID
            const form = document.getElementById('answerValidationForm');
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
            console.log("Form action URL:", actionUrl); // Log URL
            form.action = actionUrl;

            // Tangani submit form
            form.onsubmit = function(e) {
                e.preventDefault();
                const formData = new FormData(form);

                fetch(actionUrl, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        },
                    })
                    .then(response => {
                        if (!response.ok) throw response;
                        return response.json();
                    })
                    .then(data => {
                        console.log("Validation successful:", data); // Debug log
                        closeModal('answerValidationModal'); // Tutup modal validasi
                        openEditModal(data.id, data); // Buka modal edit langsung
                    })
                    .catch(async (error) => {
                        if (error.json) {
                            const errData = await error.json();
                            alert(errData.error || 'Validation failed.');
                        } else {
                            console.error("Unexpected error:", error);
                            alert('An unexpected error occurred.');
                        }
                    });
            };

            openModal('answerValidationModal');
        }


        // Fungsi untuk membuka modal Edit Question
        function openEditModal(id, question) {
            const form = document.getElementById('editQuestionForm');
            if (!form) {
                console.error("Edit Question Form not found.");
                return;
            }

            // Atur action ke route update
            form.action = `/admin/security-questions/${id}`;
            document.getElementById('editQuestionInput').value = question?.security_question || '';
            document.getElementById('editAnswerInput').value = ''; // Kosongkan jawaban

            openModal('editQuestionModal');
        }

        function deleteQuestion(id) {
            console.log("Delete ID:", id); // Log ID untuk memastikan ID diterima
            const form = document.getElementById('deleteQuestionForm');
            if (!form) {
                console.error("Delete Question Form not found.");
                return;
            }
            // Atur action URL berdasarkan ID
            form.action = `/admin/security-questions/${id}`;
            openModal('deleteConfirmationModal'); // Buka modal delete
        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2000, // Pesan dari controller
                showConfirmButton: false,
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ $errors->first() }}',
            });
        </script>
    @endif
</body>

</html>
