<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>operator - Content Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/operator/content/color.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
</head>

<body data-csrf-token="{{ csrf_token() }}">
    <!-- Header -->
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
                    <a href="/operator/dashboard">Shafwah Operator Panel</a>
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
                    <ul class="space-y-6 text-lg text-gray-900">
                        {{-- <li>
                            <a href="{{ route('operator.description') }}"
                                class="{{ request()->routeIs('operator.description') ? 'active' : '' }}">
                                Description
                            </a>
                        </li> --}}
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
                                Pattern
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
                <h2 class="text-4xl font-bold text-gray-900">Color Palette</h2>
                <div class="flex space-x-4">
                    <button onclick="openModal()"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Add New Color
                    </button>
                </div>
            </div>

            <!-- Content Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Unit</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Color</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Code HEX</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2">{{ $color->unit->name }}</td>
                                <td class="px-4 py-2">
                                    <span class="inline-block w-6 h-6 rounded-full"
                                        style="background-color: {{ $color->color }};"></span>
                                </td>
                                <td class="px-4 py-2">{{ $color->color }}</td>
                                <td class="px-4 py-2">
                                    <button type="button"
                                        onclick="openEditModal({{ $color->id }}, '{{ $color->unit_id }}', '{{ $color->color }}')"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Edit
                                    </button>
                                    <button type="button" onclick="openDeleteModal({{ $color->id }})"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($colors->count() > 0)
                <div class="flex justify-center mt-5">
                    <ol class="flex justify-center gap-2 text-xs font-medium">
                        <!-- Previous Page -->
                        @if (!$colors->onFirstPage())
                            <li>
                                <a href="{{ $colors->previousPageUrl() }}"
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
                        @foreach ($colors->links()->elements[0] as $page => $url)
                            <li>
                                @if ($page == $colors->currentPage())
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
                        @if ($colors->hasMorePages())
                            <li>
                                <a href="{{ $colors->nextPageUrl() }}"
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

    <!-- Add Modal -->
    <div id="addColorModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
        <div class="bg-white w-full max-w-md sm:max-w-lg rounded-lg shadow-lg p-6 mx-4 sm:mx-0">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg sm:text-2xl font-bold">Add New Color</h2>
                <button onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-700 text-lg sm:text-xl">&times;</button>
            </div>

            <!-- Form -->
            <form action="{{ route('operator.color.store') }}" method="POST">
                @csrf
                <!-- Dropdown for Selecting Unit -->
                <div class="mb-4">
                    <label for="unit_id" class="block text-sm font-semibold text-gray-700">Select Unit</label>
                    <select id="unit_id" name="unit_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200">
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input for Hex Code with add Color Picker -->
                <div class="mb-4">
                    <label for="colorHex" class="block text-sm font-semibold text-gray-700">Color HEX Code</label>
                    <div class="flex items-center gap-2">
                        <input type="text" id="colorHex" name="color" required placeholder="#000000"
                            class="flex-1 block px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200"
                            pattern="^#[A-Fa-f0-9]{6}$" title="Please enter a valid HEX code (e.g., #1A1A1A)" />
                        <input type="color" id="colorPicker" class="w-10 h-10 p-1 rounded-md border">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm sm:max-w-md mx-4">
            <div class="mb-4">
                <h2 class="text-lg sm:text-xl font-bold">Confirm Delete</h2>
                <p class="text-sm sm:text-base text-gray-600">Are you sure you want to delete this color?</p>
            </div>
            <div class="flex justify-end gap-2">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
                <button id="confirmDeleteBtn"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Color -->
    <div id="editColorModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
        <div class="bg-white w-full max-w-md sm:max-w-lg rounded-lg shadow-lg p-6 mx-4 sm:mx-0">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg sm:text-2xl font-bold">Edit Color</h2>
                <button onclick="closeEditModal()"
                    class="text-gray-500 hover:text-gray-700 text-lg sm:text-xl">&times;</button>
            </div>

            <!-- Form Edit -->
            <form id="editColorForm" method="POST">
                @csrf
                @method('PUT') <!-- Ini penting untuk emulasi PUT -->

                <!-- Dropdown for Selecting Unit -->
                <div class="mb-4">
                    <label for="edit_unit_id" class="block text-sm font-semibold text-gray-700">Select Unit</label>
                    <select id="edit_unit_id" name="unit_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200">
                        <option value="" disabled>Choose a unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input for Hex Code with edit Color Picker -->
                <div class="mb-4">
                    <label for="editColorHex" class="block text-sm font-semibold text-gray-700">Color HEX Code</label>
                    <div class="flex items-center gap-2">
                        <input type="text" id="editColorHex" name="color" required placeholder="#000000"
                            class="flex-1 block px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200"
                            pattern="^#[A-Fa-f0-9]{6}$" title="Please enter a valid HEX code (e.g., #1A1A1A)" />
                        <input type="color" id="editColorPicker" class="w-10 h-10 p-1 rounded-md border">
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <script src="{{ asset('js/operator/content/color-operator.js') }}"></script>
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4 font-bold">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
    <script src="{{ asset('js/operator/content/color-operator.js') }}"></script>

</body>

</html>
