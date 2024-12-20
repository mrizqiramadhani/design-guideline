<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Content Management</title>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header id="navbar" class="bg-black transition-colors duration-300 fixed top-0 left-0 right-0 z-10">
        <div class="mx-auto max-w-screen-xl px-4 py-3 sm:px-6 sm:py-4 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white sm:text-3xl cursor-pointer">
                    <a href="{{ route('admin.dashboard') }}">Shafwah Admin Panel</a>
                </h1>
                <div class="flex space-x-4">
                    <ul class="flex space-x-10 text-lg text-white font-bold">
                        <li class="group">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link relative inline-block text-white transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500"
                                style="color: #2076ff">
                                Dashboard
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('admin.show-operators') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Operator
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                    </ul>

                    <!-- User Icon with Dropdown -->
                    <div class="relative">
                        <button id="userMenuButton" class="focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white cursor-pointer"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A9 9 0 0112 2a9 9 0 016.879 15.804M12 12a3 3 0 100-6 3 3 0 000 6zm-5 7a5 5 0 0110 0H7z" />
                            </svg>
                        </button>

                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="flex min-h-screen">
        <aside class="w-1/5 bg-white border-r border-gray-200 font-bold">
            <div class="px-10 py-20">
                <nav class="my-8">
                    <ul class="space-y-6 text-lg text-gray-900 font-bold">
                        <li>
                            <a href="{{ route('admin.description') }}"
                                class="{{ request()->routeIs('admin.description', 'admin.dashboard') ? 'active' : '' }}">
                                Description
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logo') }}"
                                class="{{ request()->routeIs('admin.logo') ? 'active' : '' }}">
                                Logo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.color') }}"
                                class="{{ request()->routeIs('admin.color') ? 'active' : '' }}">
                                Color Palette
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.typography') }}"
                                class="{{ request()->routeIs('admin.typography') ? 'active' : '' }}">
                                Typography
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.illustration') }}"
                                class="{{ request()->routeIs('admin.illustration') ? 'active' : '' }}">
                                Illustration
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.social-media') }}"
                                class="{{ request()->routeIs('admin.social-media') ? 'active' : '' }}">
                                Social Media
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.iconography') }}"
                                class="{{ request()->routeIs('admin.iconography') ? 'active' : '' }}">
                                Iconography
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.campaign') }}"
                                class="{{ request()->routeIs('admin.campaign') ? 'active' : '' }}">
                                Campaign
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="w-4/5 p-8 bg-gray-100">
            <div class="mt-20 mb-5 flex items-center justify-between">
                <h2 class="text-4xl font-bold text-gray-900">Description</h2>
                <div class="flex space-x-4">
                    <button onclick="openModal('addDescription')"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Add New Description
                    </button>
                </div>
            </div>


            <!-- Modal Add Description -->
            <div id="addDescription"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">
                    <h2 class="text-2xl font-semibold mb-4">Add New Description</h2>
                    <form action="{{ route('admin.description.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="unit_id" class="block text-gray-700">Unit Name:</label>
                            <select id="unit_id" name="unit_id" class="w-full border border-gray-300 p-2 rounded"
                                required>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Title:</label>
                            <input type="text" id="title" name="title"
                                class="w-full border border-gray-300 p-2 rounded" placeholder="Enter title (optional)">
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block text-gray-700">Content:</label>
                            <textarea id="content" name="content" rows="4" class="w-full border border-gray-300 p-2 rounded"
                                placeholder="Enter content" required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModal('addDescription')"
                                class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Edit Description --}}
            <div id="editDescription"
                class="fixed inset-0 hidden bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">
                    <h2 class="text-2xl font-semibold mb-4">Edit Description</h2>
                    <form id="editDescriptionForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Untuk PUT method pada update -->
                        <div id="editDescriptionErrors" class="hidden mb-4"></div>

                        <div class="mb-4">
                            <label for="editUnitName" class="block text-gray-700">Unit Name:</label>
                            <select id="editUnitName" name="unit_id"
                                class="w-full border border-gray-300 p-2 rounded" required>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="editTitle" class="block text-gray-700">Title:</label>
                            <input type="text" id="editTitle" name="title"
                                class="w-full border border-gray-300 p-2 rounded">
                        </div>

                        <div class="mb-4">
                            <label for="editContent" class="block text-gray-700">Content:</label>
                            <textarea id="editContent" name="content" rows="4" class="w-full border border-gray-300 p-2 rounded"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="closeModal('editDescription')"
                                class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Content Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Unit</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Text Content</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($descriptions as $description)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-gray-900">{{ $description->title ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-gray-900">{{ $description->unit->name }}</td>
                                <td class="px-4 py-2 text-gray-900">{{ $description->content }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="javascript:void(0);"
                                            onclick="openEditDescriptionModal({{ $description->id }}, {{ $description->unit_id }}, '{{ $description->title }}', '{{ $description->content }}')"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>

                                        <form action="#" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this description?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500">No descriptions
                                    available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4 font-bold">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
    <script src="{{ asset('js/admin/db-script.js') }}"></script>
    <script src="{{ asset('js/admin/content/description-admin.js') }}"></script>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function openEditModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function openEditDescriptionModal(id, unitId, title, content) {
            // Atur action URL form edit
            const form = document.getElementById("editDescriptionForm");
            form.action = `/admin/description/${id}`; // Menggunakan ID untuk update

            // Set selected unit
            const unitSelect = document.getElementById("editUnitName");
            unitSelect.value = unitId; // Menyesuaikan pilihan unit

            // Set title dan content
            document.getElementById("editTitle").value = title;
            document.getElementById("editContent").value = content;

            // Tampilkan modal
            const modal = document.getElementById("editDescription");
            modal.classList.remove("hidden");
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
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
</body>

</html>
