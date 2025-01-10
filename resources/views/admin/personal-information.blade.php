<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personal Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
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
        <div class="mb-4">
            <button id="addQuestionButton" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Add Question
            </button>
        </div>

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
                <!-- Sample Row -->
                <tr>
                    <td class="border border-gray-300 px-4 py-2">1</td>
                    <td class="border border-gray-300 px-4 py-2">What is your favorite color?</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 mr-2"
                            onclick="openAnswerValidationModal('edit')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                            onclick="openModal('deleteConfirmationModal')">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Add Question Modal -->
    <div id="addQuestionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Add Security Question</h2>
            <form id="addQuestionForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Question</label>
                    <input type="text" name="question" class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Answer</label>
                    <input type="text" name="answer" class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded mr-2"
                        onclick="closeModal('addQuestionModal')">Cancel</button>
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
            <form id="answerValidationForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Answer</label>
                    <input type="text" name="answer" id="validationAnswerInput"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded mr-2"
                        onclick="closeModal('answerValidationModal')">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Validate</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Question Modal -->
    <div id="editQuestionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Edit Security Question</h2>
            <form id="editQuestionForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">New Question</label>
                    <input type="text" name="question" id="editQuestionInput"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">New Answer</label>
                    <input type="text" name="answer" id="editAnswerInput"
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded mr-2"
                        onclick="closeModal('editQuestionModal')">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-96 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Delete Security Question</h2>
            <p class="mb-4">Are you sure you want to delete this security question?</p>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded mr-2"
                    onclick="closeModal('deleteConfirmationModal')">Cancel</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="deleteQuestion()">Delete</button>
            </div>
        </div>
    </div>

    <script>
        const openModal = (modalId) => {
            document.getElementById(modalId).classList.remove('hidden');
        };

        const closeModal = (modalId) => {
            document.getElementById(modalId).classList.add('hidden');
        };

        const openAnswerValidationModal = (action) => {
            openModal('answerValidationModal');
            document.getElementById('answerValidationForm').onsubmit = (e) => {
                e.preventDefault();
                closeModal('answerValidationModal');
                if (action === 'edit') {
                    openModal('editQuestionModal');
                }
            };
        };

        const deleteQuestion = () => {
            console.log('Question deleted');
            closeModal('deleteConfirmationModal');
        };

        document.getElementById('addQuestionButton').addEventListener('click', () => {
            openModal('addQuestionModal');
        });

        document.getElementById('addQuestionForm').addEventListener('submit', (e) => {
            e.preventDefault();
            closeModal('addQuestionModal');
        });

        document.getElementById('editQuestionForm').addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Question edited');
            closeModal('editQuestionModal');
        });
    </script>
</body>

</html>
