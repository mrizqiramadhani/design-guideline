<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Operator - Content Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
</head>

<body>
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
                    <a href="/admin/dashboard">Shafwah Admin Panel</a>
                </h1>
                <div class="hidden sm:flex space-x-4">
                    <ul class="flex space-x-10 text-lg text-white font-bold">
                        <li class="group">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link relative inline-block text-white transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Dashboard
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('admin.show-operators') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500"
                                style="color: #2076ff">
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
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <a href="{{ route('admin.show-operators') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Operator</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            onclick="openAdminSettingsModal()">Admin Settings</a>
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
                            <a href="{{ route('admin.description') }}"
                                class="{{ request()->routeIs('admin.description') ? 'active' : '' }}">
                                Description
                            </a>
                        </li> --}}
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
                                Pattern
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

        <main class="w-full p-8 bg-gray-100">
            <div class="mt-20 mb-5 md:flex md:items-center md:justify-between">
                <h2 class="text-4xl font-bold text-gray-900">Operator List</h2>
                <div class="flex space-x-4">
                    <button onclick="toggleModal()"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Add New Operator
                    </button>
                </div>
            </div>


            <!-- Content Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Password</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($operators as $operator)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-gray-900">{{ $operator->id }}</td>
                                <td class="px-4 py-2 text-gray-900">{{ $operator->name }}</td>
                                <td class="px-4 py-2 text-gray-900">{{ $operator->email }}</td>
                                <td class="px-4 py-2 text-gray-900">*************</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button data-id="{{ $operator->id }}"
                                            onclick="editOperatorModal(this.dataset.id)"
                                            class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                                        <button data-id="{{ $operator->id }}"
                                            onclick="showDeleteModal(this.dataset.id)"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal Admin Settings -->
                <div id="adminSettingsModal"
                    class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75">
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
                                    <label for="role"
                                        class="text-sm font-medium text-gray-700 w-1/3">Role:</label>
                                    <span id="role"
                                        class="text-sm font-semibold text-gray-900 w-2/3">Admin</span>
                                </div>

                                <!-- Display Email -->
                                <div class="flex items-center border-b pb-4 mt-4">
                                    <label for="email"
                                        class="text-sm font-medium text-gray-700 w-1/3">Email:</label>
                                    <div class="flex flex-col sm:flex-row items-center sm:space-x-4 w-2/3">
                                        @if (Auth::check() && Auth::user()->role === 'admin')
                                            <span id="email"
                                                class="text-sm font-semibold text-gray-900 flex-1 truncate">{{ Auth::user()->email }}</span>
                                            <button type="button" onclick="openChangeEmailModal()"
                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Change</button>
                                        @else
                                            <span id="email"
                                                class="text-sm font-semibold text-gray-900 flex-1">You do
                                                not have permission to change this.</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Display Password -->
                                <div class="flex items-center border-b pb-4 mt-4">
                                    <label for="password"
                                        class="text-sm font-medium text-gray-700 w-1/3">Password:</label>
                                    <div class="flex flex-col sm:flex-row items-center sm:space-x-4 w-2/3">
                                        <span id="password"
                                            class="text-sm font-semibold text-gray-900 flex-1 truncate">********</span>
                                        <button type="button" onclick="openChangePasswordModal()"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Change</button>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end space-x-2">
                                    <!-- Button Personal Information -->
                                    <a href="{{ route('personal.information') }}"
                                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
                                        Personal Information
                                    </a>
                                    <!-- Close Button -->
                                    <button type="button" onclick="closeAdminSettingsModal()"
                                        class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                                        Close
                                    </button>
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
                                    <input type="email" id="newEmail" name="email" value="{{ old('email') }}"
                                        required
                                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                                </div>
                                <div>
                                    <label for="oldPasswordChangeEmail"
                                        class="text-sm font-medium text-gray-700">Current
                                        Password:</label>
                                    <div class="relative">
                                        <input type="password" id="oldPasswordChangeEmail" name="old_password"
                                            required
                                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                            id="toggle-old-password-email">
                                            <span class="iconify" data-icon="mdi:eye" data-width="20"
                                                data-height="20"></span>
                                        </span>
                                    </div>
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
                                        <span
                                            class="block sm:inline">{{ $errors->first('password_confirmation') }}</span>
                                    </div>
                                @endif

                                <div>
                                    <label for="currentPasswordChangePassword"
                                        class="text-sm font-medium text-gray-700">Current Password:</label>
                                    <div class="relative">
                                        <input type="password" id="currentPasswordChangePassword"
                                            name="current_password" required
                                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                            id="toggle-current-password">
                                            <span class="iconify" data-icon="mdi:eye" data-width="20"
                                                data-height="20"></span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="newPassword" class="text-sm font-medium text-gray-700">New
                                        Password:</label>
                                    <div class="relative">
                                        <input type="password" id="newPassword" name="password" required
                                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                            id="toggle-new-password">
                                            <span class="iconify" data-icon="mdi:eye" data-width="20"
                                                data-height="20"></span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="confirmPassword" class="text-sm font-medium text-gray-700">Confirm
                                        Password:</label>
                                    <div class="relative">
                                        <input type="password" id="confirmPassword" name="password_confirmation"
                                            required
                                            class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-500">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                            id="toggle-confirm-password">
                                            <span class="iconify" data-icon="mdi:eye" data-width="20"
                                                data-height="20"></span>
                                        </span>
                                    </div>
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

                <!-- Modal Konfirmasi Hapus -->
                <div id="deleteModal"
                    class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white w-full max-w-sm sm:max-w-md rounded-lg p-6 sm:p-8 shadow-lg mx-4">
                        <h2 class="text-lg sm:text-2xl font-semibold mb-4 text-gray-800">Delete Confirmation</h2>
                        <p class="mb-6 text-sm sm:text-base text-gray-600">Are you sure you want to delete this
                            operator?</p>
                        <div class="flex justify-end gap-2">
                            <button onclick="closeDeleteModal()"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Cancel
                            </button>
                            <form id="deleteForm" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Modal tambah operator -->
                <!-- Modal tambah operator -->
                <div id="addOperatorModal"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white w-full max-w-md sm:max-w-lg rounded-lg p-6 shadow-lg mx-4">
                        <h2 class="text-lg font-bold mb-4">Add New Operator</h2>

                        <form id="addOperatorForm" action="{{ route('admin.addOperator') }}" method="POST">
                            @csrf
                            <!-- Error Messages -->
                            <div id="errorMessages" class="text-red-500 mb-4 hidden"></div>

                            <!-- Input for Name -->
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Name:</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-green-200">
                            </div>

                            <!-- Input for Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email:</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-green-200">
                            </div>

                            <!-- Input for Password -->
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password:</label>
                                <input type="password" name="password" id="password" required
                                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-green-200">
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="closeModal()"
                                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                    Add Operator
                                </button>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- Modal Edit Operator -->
                <div id="editOperatorModal"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg p-6">
                        <h2 class="text-lg font-bold mb-4">Edit Operator</h2>
                        <div id="editErrorMessages" class="text-red-500 mb-4 hidden"></div>

                        <form id="editOperatorForm" action="" method="POST">
                            @csrf
                            @method('PUT') <!-- Pastikan menggunakan method PUT untuk update -->
                            <div class="mb-4">
                                <label for="editName" class="block text-gray-700">Name:</label>
                                <input type="text" name="name" id="editName"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label for="editEmail" class="block text-gray-700">Email:</label>
                                <input type="email" name="email" id="editEmail"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label for="editPassword" class="block text-gray-700">Password (Kosongkan jika tidak
                                    ingin mengubah):</label>
                                <input type="password" name="password" id="editPassword"
                                    class="w-full border border-gray-300 p-2 rounded">
                            </div>
                            <div class="flex justify-end">
                                <button type="button" onclick="closeEditModal()"
                                    class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update
                                    Operator</button>
                            </div>
                        </form>
                    </div>
                </div>


                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 2000, // Pesan dari controller
                            showConfirmButton: false,
                        });
                    </script>
                @endif
            </div>
        </main>
    </div>
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4 font-bold">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
    <script src="{{ asset('js/admin/op-script.js') }}"></script>
    <script src="{{ asset('js/admin/settings-admin.js') }}"></script>
</body>

</html>
