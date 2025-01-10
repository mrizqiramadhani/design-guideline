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
        class="fixed top-4 left-4 flex items-center bg-gray-700 text-white px-4 py-3 rounded-full shadow-lg hover:bg-gray-800 transition duration-300">
        <span class="iconify" data-icon="mdi:arrow-left" data-inline="false"></span>
        <span class="ml-2 font-medium">Back</span>
    </a>

    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-lg p-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Personal Information</h1>
            <button id="addQuestionButton" onclick="openModal('addQuestionModal')"
                class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 shadow transition duration-300">
                + Add Question
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Question</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $index => $question)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-900">{{ $question->security_question }}</td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openAnswerValidationModal({{ $question->id }})"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                                    Edit
                                </button>
                                <button onclick="deleteQuestion({{ $question->id }})"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300 ml-2">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- add modal --}} <div id="addQuestionModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
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
                    <input type="text" name="security_answer" id="securityAnswerInput"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <span id="securityAnswerError" class="text-red-500 text-sm hidden"></span>
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
    <script src="{{ asset('js/admin/personal-question.js') }}"></script>
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
</body>

</html>
