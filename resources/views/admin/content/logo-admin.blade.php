<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Content Management</title>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/content/logo.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>
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
                    <a href="{{ route('admin.dashboard') }}">Shafwah Admin Panel</a>
                </h1>
                <div class="hidden sm:flex space-x-4">
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

        <main class="w-full p-8 bg-gray-100">
            <div class="mt-20 mb-5 md:flex md:items-center md:justify-between">
                <h2 class="text-4xl font-bold text-gray-900">Logo</h2>
                <div class="flex space-x-4">
                    <button onclick="showModal()"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Add New Logo
                    </button>
                </div>
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
                                <label for="password"
                                    class="text-sm font-medium text-gray-700 w-1/3">Password:</label>
                                <div class="flex flex-col sm:flex-row items-center sm:space-x-4 w-2/3">
                                    <span id="password"
                                        class="text-sm font-semibold text-gray-900 flex-1 truncate">********</span>
                                    <button type="button" onclick="openChangePasswordModal()"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Change</button>
                                </div>
                            </div>

                            <!-- Footer Buttons -->
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
                                <label for="oldPasswordChangeEmail" class="text-sm font-medium text-gray-700">Current
                                    Password:</label>
                                <div class="relative">
                                    <input type="password" id="oldPasswordChangeEmail" name="old_password" required
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
                                    <span class="block sm:inline">{{ $errors->first('password_confirmation') }}</span>
                                </div>
                            @endif

                            <div>
                                <label for="currentPasswordChangePassword"
                                    class="text-sm font-medium text-gray-700">Current Password:</label>
                                <div class="relative">
                                    <input type="password" id="currentPasswordChangePassword" name="current_password"
                                        required
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
                                    <input type="password" id="confirmPassword" name="password_confirmation" required
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

            <!-- Modal tambah logo -->
            <div id="addLogoModal"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">

                    <div id="loadingSpinner"
                        class="hidden absolute inset-0 bg-gray-900 bg-opacity-25 flex items-center justify-center z-10">
                        <div class="loader"></div>
                    </div>

                    <!-- Header Modal -->
                    <h2 class="text-2xl font-semibold mb-4">Add New Logo</h2>

                    <form id="addLogoForm" method="POST" action="{{ route('admin.logo.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div id="formErrors" class="hidden">
                        </div>

                        <!-- Modal Scrollable Content -->
                        <div class="modal-content max-h-[400px] overflow-y-auto pr-4 pb-8 relative">
                            <!-- Title -->
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700">Title:</label>
                                <input type="text" name="title" id="title"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>

                            <!-- Thumbnail -->
                            <div class="mb-4">
                                <label for="thumbnail" class="block text-gray-700">Thumbnail:</label>
                                <input type="file" name="thumbnail" id="thumbnail"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>

                            <!-- Unit Bisnis -->
                            <div class="mb-4">
                                <label for="unit_id" class="block text-gray-700">Unit Bisnis:</label>
                                <select name="unit_id" id="unit_id"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Photo Theme Primary (Multiple Upload) -->
                            <div class="mb-4">
                                <label for="theme_primary" class="block text-gray-700">Photo Theme Primary:</label>
                                <input type="file" name="theme_primary[]" id="theme_primary"
                                    class="w-full border border-gray-300 p-2 rounded" multiple>
                                <div id="themePrimaryTags"
                                    class="mt-2 flex space-x-2 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                                </div>
                            </div>

                            <!-- Photo Theme White (Multiple Upload) -->
                            <div class="mb-4">
                                <label for="theme_white" class="block text-gray-700">Photo Theme White:</label>
                                <input type="file" name="theme_white[]" id="theme_white"
                                    class="w-full border border-gray-300 p-2 rounded" multiple>
                                <div id="themeWhiteTags"
                                    class="mt-2 flex space-x-2 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                                </div>
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModal()"
                                class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <button type="submit" id="submitLogoForm"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Logo</button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- Modal edit logo --}}
            <div id="editModal"
                class="fixed inset-0 hidden bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">

                    <div id="loadingSpinnerEdit"
                        class="hidden absolute inset-0 bg-gray-900 bg-opacity-25 flex items-center justify-center z-10">
                        <div class="loader"></div>
                    </div>

                    <!-- Header Modal -->
                    <h2 class="text-2xl font-semibold mb-4">Edit Logo</h2>



                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Error Messages -->
                        <div id="formErrorsEdit" class="hidden bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                            <!-- Pesan error akan ditambahkan di sini oleh JavaScript -->
                        </div>

                        <!-- Modal Scrollable Content -->
                        <div class="modal-content max-h-[400px] overflow-y-auto pr-4 pb-8 relative">
                            <!-- Input Title -->
                            <div class="mb-4">
                                <label for="editTitle" class="block text-gray-700">Title:</label>
                                <input type="text" id="editTitle" name="title"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>

                            <!-- Unit Bisnis -->
                            <div class="mb-4">
                                <label for="unit_id" class="block text-gray-700">Unit Bisnis:</label>
                                <select name="unit_id" id="unit_id"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Thumbnail -->
                            <div class="mb-4">
                                <label for="thumbnail" class="block text-gray-700">Thumbnail:</label>
                                <input type="file" name="thumbnail" id="thumbnail"
                                    class="w-full border border-gray-300 p-2 rounded">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah thumbnail.
                                </p>
                            </div>

                            <!-- Photo Theme Primary (Multiple Upload) -->
                            <div class="mb-4">
                                <label for="theme_primary" class="block text-gray-700">Photo Theme Primary:</label>
                                <input type="file" name="theme_primary[]" id="theme_primary"
                                    class="w-full border border-gray-300 p-2 rounded" multiple>
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah theme primary
                                    images.</p>
                                <!-- Theme Primary Preview dengan scrollbar -->
                                <div id="themePrimaryPreview"
                                    class="flex mt-2 space-x-2 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                                    <!-- Gambar yang sudah ada akan ditampilkan di sini melalui JavaScript -->
                                </div>
                            </div>

                            <!-- Photo Theme White (Multiple Upload) -->
                            <div class="mb-4">
                                <label for="theme_white" class="block text-gray-700">Photo Theme White:</label>
                                <input type="file" name="theme_white[]" id="theme_white"
                                    class="w-full border border-gray-300 p-2 rounded" multiple>
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah theme white
                                    images.</p>
                                <!-- Theme White Preview dengan scrollbar -->
                                <div id="themeWhitePreview"
                                    class="flex mt-2 space-x-2 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                                    <!-- Gambar yang sudah ada akan ditampilkan di sini melalui JavaScript -->
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer (Buttons) -->
                        <div class="flex justify-end">
                            <button type="button" onclick="closeEditModal()"
                                class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Konfirmasi Hapus Logo -->
            <div id="deleteLogoModal"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4">Delete Logo</h2>

                    <p class="mb-4">Are you sure you want to delete this logo and its associated photos?</p>

                    <!-- Form penghapusan logo -->
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')

                        <!-- Action buttons -->
                        <div class="flex justify-end">
                            <button type="button" onclick="closeDeleteModal()"
                                class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
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
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Thumbnail</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Theme Primary</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Theme White</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logos as $logo)
                            <tr class="border-t">
                                <!-- Logo Title -->
                                <td class="px-4 py-2 text-gray-900">{{ $logo->title }}</td>

                                <!-- Unit Name -->
                                <td class="px-4 py-2 text-gray-900">{{ $logo->unit->name ?? '' }}</td>

                                <!-- Thumbnail -->
                                <td class="px-4 py-2 text-gray-900">
                                    <img src="{{ asset('storage/thumbnails/' . basename($logo->thumbnail)) }}"
                                        alt="Thumbnail" class="max-w-full h-32 p-2 object-contain rounded-md">
                                </td>

                                <!-- Tema Primary -->
                                <td class="px-4 py-2 text-gray-900">
                                    @if ($logo->logoPhotos->where('theme', 'Primary')->isEmpty())
                                        <span class="text-gray-500">No Primary Images</span>
                                    @else
                                        <div class="relative flex gap-2 overflow-hidden custom-scrollbar-wrapper">
                                            <div class="flex gap-2 overflow-x-auto custom-scrollbar-content">
                                                @foreach ($logo->logoPhotos->where('theme', 'Primary') as $photo)
                                                    <img src="{{ asset('storage/logo_photos/' . basename($photo->path)) }}"
                                                        alt="Theme Primary"
                                                        class="max-w-full h-24 object-contain rounded-md bg-slate-200">
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                <!-- Tema White -->
                                <td class="px-4 py-2 text-gray-900">
                                    @if ($logo->logoPhotos->where('theme', 'White')->isEmpty())
                                        <span class="text-gray-500">No White Images</span>
                                    @else
                                        <div class="relative flex gap-2 overflow-hidden custom-scrollbar-wrapper">
                                            <div class="flex gap-2 overflow-x-auto custom-scrollbar-content">
                                                @foreach ($logo->logoPhotos->where('theme', 'White') as $photo)
                                                    <img src="{{ asset('storage/logo_photos/' . basename($photo->path)) }}"
                                                        alt="Theme White"
                                                        class="max-w-full h-24 object-contain rounded-md bg-black">
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <button onclick="openEditModal({{ $logo->id }})"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('admin.logo.destroy', $logo->id) }}')"
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

            {{-- <div id="loading-overlay"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                <span class="loader-paginate"></span>
            </div> --}}

            <!-- Pagination -->
            @if ($logos->count() > 0)
                <!-- Cek apakah ada data untuk dipaginasi -->
                <div class="flex justify-center mt-5">
                    <ol class="flex justify-center gap-2 text-xs font-medium">
                        <!-- Previous Page -->
                        @if (!$logos->onFirstPage())
                            <li>
                                <a href="{{ $logos->previousPageUrl() }}"
                                    class="inline-flex items-center justify-center rounded border border-gray-200 bg-white text-black dark:border-gray-800 dark:bg-gray-900 dark:text-white"
                                    onclick="showLoading()">
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
                        @foreach ($logos->links()->elements[0] as $page => $url)
                            <li>
                                @if ($page == $logos->currentPage())
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
                        @if ($logos->hasMorePages())
                            <li>
                                <a href="{{ $logos->nextPageUrl() }}"
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
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4 font-bold">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
    <script src="{{ asset('js/admin/content/logo-admin.js') }}"></script>
    <script src="{{ asset('js/admin/settings-admin.js') }}"></script>
</body>

</html>
