<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Operator - Content Management</title>
    <link rel="stylesheet" href="{{ asset('css/operator/style.css') }}" />
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
                {{-- create hamburber menu button that will shown only on small screen --}}
                <div class="sm:hidden">
                    <button id="hamburgerButton" type="button" class="text-white focus:outline-none">
                        <svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <h1 class="text-2xl font-bold text-white sm:text-3xl cursor-pointer">
                    <a href="{{ route('operator.dashboard') }}">Shafwah Operator Panel</a>
                </h1>
                <div class="hidden sm:flex space-x-4">
                    <ul class="flex space-x-10 text-lg text-white font-bold">
                        <li class="group">
                            <a href="{{ route('operator.dashboard') }}"
                                class="nav-link relative inline-block text-white transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500"
                                style="color: #2076ff">
                                Dashboard
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
                <div class="sm:hidden relative">
                    <button id="profileMenuButton" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white cursor-pointer" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </button>

                    <div id="hamburgerDropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                        <a href="{{ route('operator.dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>

                <script>
                    document.getElementById('profileMenuButton').addEventListener('click', function() {
                        var dropdown = document.getElementById('hamburgerDropdown');
                        dropdown.classList.toggle('hidden');
                    });
                </script>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="flex min-h-screen">
        <aside id="sidebar"
            class="fixed sm:relative hidden sm:block h-full w-100 sm:w-1/5 bg-white border-r border-gray-200 font-bold">
            <script>
                const hamburgerButton = document.getElementById('hamburgerButton');
                const hamburgerIcon = document.getElementById('hamburgerIcon');
                const closeIcon = document.getElementById('closeIcon');

                hamburgerButton.addEventListener('click', function() {
                    var sidebar = document.getElementById('sidebar');
                    sidebar.classList.toggle('hidden');

                    // if hidden
                    if (sidebar.classList.contains('hidden')) {
                        hamburgerIcon.style.display = 'block';
                        closeIcon.style.display = 'none';
                    } else {
                        hamburgerIcon.style.display = 'none';
                        closeIcon.style.display = 'block';
                    }
                });
            </script>
            <div class="px-10 py-20">
                <nav class="my-8">
                    <ul class="space-y-6 text-lg text-gray-900 font-bold">
                        <li>
                            <a href="{{ route('operator.description') }}"
                                class="{{ request()->routeIs('operator.description', 'operator.dashboard') ? 'active' : '' }}">
                                Description
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.logo') }}"
                                class="{{ request()->routeIs('operator.logo') ? 'active' : '' }}">
                                Logo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.color') }}"
                                class="{{ request()->routeIs('operator.color') ? 'active' : '' }}">
                                Color Palette
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.typography') }}"
                                class="{{ request()->routeIs('operator.typography') ? 'active' : '' }}">
                                Typography
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.illustration') }}"
                                class="{{ request()->routeIs('operator.illustration') ? 'active' : '' }}">
                                Illustration
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.social-media') }}"
                                class="{{ request()->routeIs('operator.social-media') ? 'active' : '' }}">
                                Social Media
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.iconography') }}"
                                class="{{ request()->routeIs('operator.iconography') ? 'active' : '' }}">
                                Iconography
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('operator.campaign') }}"
                                class="{{ request()->routeIs('operator.campaign') ? 'active' : '' }}">
                                Campaign
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="w-full p-8 bg-gray-100">
            <div class="mt-20 mb-5 md:flex md:items-center md:justify-between">
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
                    <form action="{{ route('operator.description.store') }}" method="POST">
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
                                class="w-full border border-gray-300 p-2 rounded"
                                placeholder="Enter title (optional)">
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
                            <textarea id="editContent" name="content" rows="4" class="w-full border border-gray-300 p-2 rounded" required></textarea>
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

            <!-- Modal Delete Description -->
            <div id="deleteDescriptionModal"
                class="fixed inset-0 hidden bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg">
                    <!-- Header Modal -->
                    <h2 class="text-2xl font-semibold mb-4">Delete Description</h2>

                    <!-- Informasi Hapus -->
                    <p class="mb-4">Are you sure you want to delete this description and its associated content?</p>

                    <!-- Action buttons -->
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal('deleteDescriptionModal')"
                            class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancel
                        </button>
                        <form id="deleteDescriptionForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal View Description -->
            <div id="viewDescription"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">
                    <h2 id="modalTitle" class="text-2xl font-semibold mb-4">View Description</h2>
                    <div class="mb-4">
                        <label class="block text-gray-700">Title:</label>
                        <p id="descriptionTitle" class="text-gray-900 border border-gray-300 p-2 rounded bg-gray-100">
                        </p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Content:</label>
                        <textarea id="descriptionContent" class="w-full text-gray-900 border border-gray-300 p-2 rounded bg-gray-100"
                            rows="10" readonly></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal('viewDescription')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Close
                        </button>
                    </div>
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
                        @foreach ($descriptions as $description)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    @if ($description->title)
                                        <span class="text-gray-900">{{ $description->title }}</span>
                                    @else
                                        <span class="text-gray-500">No title desc</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-gray-900">{{ $description->unit->name }}</td>
                                <td class="px-4 py-2 text-gray-900">
                                    <span>
                                        @if (Str::length($description->content) > 40)
                                            {{ Str::limit($description->content, 40, '...') }}
                                            <button
                                                class="ml-2 text-sm text-black bg-gray-300 px-2 py-1 rounded hover:bg-gray-200"
                                                onclick="showModal('{{ $description->title }}', `{{ $description->content }}`)">
                                                See More
                                            </button>
                                        @else
                                            {{ $description->content }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button
                                            onclick="openEditDescriptionModal({{ $description->id }}, {{ $description->unit_id }}, '{{ $description->title }}', `{{ $description->content }}`)"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Edit
                                        </button>

                                        <button onclick="openDeleteDescriptionModal({{ $description->id }})"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Pagination -->
            @if ($descriptions->count() > 0)
                <div class="flex justify-center mt-5">
                    <ol class="flex justify-center gap-2 text-xs font-medium">
                        <!-- Previous Page -->
                        @if (!$descriptions->onFirstPage())
                            <li>
                                <a href="{{ $descriptions->previousPageUrl() }}"
                                    class="inline-flex items-center justify-center rounded border border-gray-200 bg-white text-black dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                                    <span class="sr-only">Prev Page</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        @endif

                        <!-- Page Numbers -->
                        @foreach ($descriptions->links()->elements[0] as $page => $url)
                            <li>
                                @if ($page == $descriptions->currentPage())
                                    <span
                                        class="block w-8 h-8 rounded bg-black text-center leading-8 text-white">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="block w-8 h-8 rounded border border-gray-200 bg-white text-center leading-8 text-black">
                                        {{ $page }}
                                    </a>
                                @endif
                            </li>
                        @endforeach

                        <!-- Next Page -->
                        @if ($descriptions->hasMorePages())
                            <li>
                                <a href="{{ $descriptions->nextPageUrl() }}"
                                    class="inline-flex items-center justify-center rounded border border-gray-200 bg-white text-black dark:border-gray-800 dark:bg-gray-900 dark:text-white">
                                    <span class="sr-only">Next Page</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ol>
                </div>
            @else
                <div class="flex flex-col items-center justify-center mt-5">
                    <img src="{{ asset('img/not found.png') }}" alt="Empty Content" class="w-32 h-32">
                    <p class="text-gray-800 font-bold text-lg">No Content Available</p>
                </div>
            @endif
        </main>
    </div>
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4 font-bold">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
    <script src="{{ asset('js/operator/content/description-operator.js') }}"></script>
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
