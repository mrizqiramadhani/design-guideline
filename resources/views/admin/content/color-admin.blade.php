<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Content Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/color.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
</head>

<body data-csrf-token="{{ csrf_token() }}">
    <!-- Header -->
    <header id="navbar" class="bg-black transition-colors duration-300 fixed top-0 left-0 right-0 z-10">
        <div class="mx-auto max-w-screen-xl px-4 py-3 sm:px-6 sm:py-4 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white sm:text-3xl cursor-pointer">
                    <a href="/admin/dashboard">Shafwah Admin Panel</a>
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
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                onclick="openAdminSettingsModal()">Admin Settings</a>
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
                                class="{{ request()->routeIs('admin.description') ? 'active' : '' }}">
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
                <h2 class="text-4xl font-bold text-gray-900">Color Palette</h2>
                <div class="flex space-x-4">
                    <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
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
                                <td class="px-4 py-2">{{ $color->user->name ?? 'N/A' }}</td>
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
                <!-- Cek apakah ada data untuk dipaginasi -->
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
                <!-- Tampilkan pesan jika tidak ada data -->
                <div class="flex flex-col items-center justify-center mt-5">
                    <img src="https://i.pinimg.com/originals/6a/f3/71/6af371f102361c0fd47619eb524bf4bb.gif"
                        alt="Empty Content" class="w-32 h-32">
                    <p class="text-gray-500 mt-3">Tidak ada konten untuk ditampilkan</p>
                </div>
            @endif
        </main>
    </div>

    <!-- Modal Admin Settings -->
    <div id="adminSettingsModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 space-y-6">
                <!-- Header Modal -->
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Account Settings</h2>
                    <button class="text-gray-400 hover:text-gray-600 focus:outline-none"
                        onclick="closeAdminSettingsModal()">
                        &times;
                    </button>
                </div>

                <!-- Content Modal -->
                <form>
                    <!-- Display Role -->
                    <div class="flex items-center border-b pb-4">
                        <label for="role" class="text-sm font-medium text-gray-700 w-1/3">Role:</label>
                        <span id="role" class="text-sm font-semibold text-gray-900 w-2/3">Admin</span>
                    </div>

                    <!-- Display Email -->
                    <div class="flex items-center border-b pb-4 mt-4">
                        <label for="email" class="text-sm font-medium text-gray-700 w-1/3">Email:</label>
                        <div class="flex flex-col sm:flex-row items-center sm:space-x-4 w-2/3">
                            @if (Auth::check() && Auth::user()->role === 'admin')
                                <span id="email"
                                    class="text-sm font-semibold text-gray-900 flex-1 truncate">{{ Auth::user()->email }}</span>
                                <button type="button" onclick="openChangeEmailModal()"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Change</button>
                            @else
                                <span id="email" class="text-sm font-semibold text-gray-900 flex-1">You do
                                    not have permission to change this.</span>
                            @endif
                        </div>
                    </div>

                    <!-- Display Password -->
                    <div class="flex items-center border-b pb-4 mt-4">
                        <label for="password" class="text-sm font-medium text-gray-700 w-1/3">Password:</label>
                        <div class="flex flex-col sm:flex-row items-center sm:space-x-4 w-2/3">
                            <span id="password"
                                class="text-sm font-semibold text-gray-900 flex-1 truncate">********</span>
                            <button type="button" onclick="openChangePasswordModal()"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Change</button>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button" onclick="closeAdminSettingsModal()"
                            class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Change Email -->
    <div id="changeEmailModal"
        class="{{ $errors->has('email') || $errors->has('old_password') ? '' : 'hidden' }} fixed inset-0 z-50 bg-gray-900 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 space-y-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Change Email</h2>
                <button class="text-gray-400 hover:text-gray-600 focus:outline-none"
                    onclick="closeChangeEmailModal()">&times;</button>
            </div>

            <!-- Content Modal -->
            <form id="changeEmailForm" action="{{ route('admin.changeEmail') }}" method="POST">
                @csrf
                <div class="space-y-4">

                    @if ($errors->has('email'))
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
                            <span class="block sm:inline">{{ $errors->first('email') }}</span>
                        </div>
                    @endif

                    @if ($errors->has('old_password'))
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
                            <span class="block sm:inline">{{ $errors->first('old_password') }}</span>
                        </div>
                    @endif

                    <div>
                        <label for="newEmail" class="text-sm font-medium text-gray-700">New Email:</label>
                        <input type="email" id="newEmail" name="email" value="{{ old('email') }}" required
                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="oldPasswordChangeEmail" class="text-sm font-medium text-gray-700">Current
                            Password:</label>
                        <input type="password" id="oldPasswordChangeEmail" name="old_password" required
                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    <button type="button" onclick="closeChangeEmailModal()"
                        class="ml-4 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Change Password -->
    <div id="changePasswordModal"
        class="{{ $errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation') ? '' : 'hidden' }} fixed inset-0 z-50 bg-gray-900 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 space-y-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Change Password</h2>
                <button class="text-gray-400 hover:text-gray-600 focus:outline-none"
                    onclick="closeChangePasswordModal()">&times;</button>
            </div>

            <!-- Content Modal -->
            <form id="changePasswordForm" action="{{ route('admin.changePassword') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    @if ($errors->has('current_password'))
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
                            <span class="block sm:inline">{{ $errors->first('current_password') }}</span>
                        </div>
                    @endif

                    @if ($errors->has('password'))
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
                            <span class="block sm:inline">{{ $errors->first('password') }}</span>
                        </div>
                    @endif

                    @if ($errors->has('password_confirmation'))
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
                            <span class="block sm:inline">{{ $errors->first('password_confirmation') }}</span>
                        </div>
                    @endif


                    <div>
                        <label for="currentPasswordChangePassword" class="text-sm font-medium text-gray-700">Current
                            Password:</label>
                        <input type="password" id="currentPasswordChangePassword" name="current_password" required
                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="newPassword" class="text-sm font-medium text-gray-700">New
                            Password:</label>
                        <input type="password" id="newPassword" name="password" required
                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="confirmPassword" class="text-sm font-medium text-gray-700">Confirm
                            Password:</label>
                        <input type="password" id="confirmPassword" name="password_confirmation" required
                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    <button type="button" onclick="closeChangePasswordModal()"
                        class="ml-4 bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addColorModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Add New Color</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.color.store') }}" method="POST">
                @csrf
                <!-- Dropdown for Selecting Unit -->
                <div class="mb-4">
                    <label for="unit_id" class="block text-sm font-semibold text-gray-700">Select Unit</label>
                    <select id="unit_id" name="unit_id" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200">
                        <option value="" disabled selected>Choose a unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input for Hex Code with add Color Picker -->
                <div class="mb-4">
                    <label for="colorHex" class="block text-sm font-semibold text-gray-700">Color HEX Code</label>
                    <div class="input-group">
                        <input type="text" id="colorHex" name="color" required placeholder="#000000"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200"
                            pattern="^#[A-Fa-f0-9]{6}$" title="Please enter a valid HEX code (e.g., #1A1A1A)" />
                        <input type="color" id="colorPicker" class="p-1">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="mr-2 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
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
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <div class="mb-4">
                <h2 class="text-xl font-bold">Confirm Delete</h2>
                <p>Are you sure you want to delete this color?</p>
            </div>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
                <button id="confirmDeleteBtn"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Color -->
    <div id="editColorModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Edit Color</h2>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <!-- Form Edit -->
            <form id="editColorForm" method="POST">
                @csrf
                @method('PUT') <!-- Ini penting untuk emulasi PUT -->

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
                    <div class="input-group">
                        <input type="text" id="editColorHex" name="color" required placeholder="#000000"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-200"
                            pattern="^#[A-Fa-f0-9]{6}$" title="Please enter a valid HEX code (e.g., #1A1A1A)" />
                        <input type="color" id="editColorPicker" class="p-1">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeEditModal()"
                        class="mr-2 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
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

    <script src="{{ asset('js/admin/content/color-admin.js') }}"></script>
    <script src="{{ asset('js/admin/settings-admin.js') }}"></script>
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4 font-bold">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
</body>

</html>
