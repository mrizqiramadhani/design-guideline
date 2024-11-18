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
                    <ul class="flex space-x-6 text-lg text-white">
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li><a href="{{ route('admin.show-operators') }}" class="nav-link">Operator</a></li>
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
    <div class="flex mt-20">
        <aside class="w-1/5 bg-white border-r border-gray-200">
            <div class="px-5 py-20">
                <nav>
                    <ul class="space-y-6 text-lg text-gray-900">
                        <li><a href="{{ route('admin.deskripsi') }}">Deskripsi</a></li>
                        <li><a href="{{ route('admin.logo') }}">Logo</a></li>
                        <li><a href="{{ route('admin.color') }}">Color Palette</a></li>
                        <li><a href="{{ route('admin.typography') }}">Typography</a></li>
                        <li><a href="{{ route('admin.illustration') }}">Illustration</a></li>
                        <li><a href="{{ route('admin.social') }}">Social Media</a></li>
                        <li><a href="{{ route('admin.iconography') }}">Iconography</a></li>
                        <li><a href="{{ route('admin.campaign') }}">Campaign</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="w-4/5 p-8 bg-gray-100">
            <!-- Success Notification -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

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
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Last Updated By</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colors as $color)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-2">{{ $color->unit->name }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block w-6 h-6 rounded-full" style="background-color: {{ $color->color }};"></span>
                            </td>
                            <td class="px-4 py-2">{{ $color->color }}</td>
                            <td class="px-4 py-2">{{ $color->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                <button type="button" onclick="openEditModal({{ $color->id }}, '{{ $color->unit_id }}', '{{ $color->color }}')" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    Edit
                                </button>
                                <button type="button" onclick="openDeleteModal({{ $color->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
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
                    @foreach($units as $unit)
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
                <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
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
<div id="deleteConfirmModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <div class="mb-4">
            <h2 class="text-xl font-bold">Confirm Delete</h2>
            <p>Are you sure you want to delete this color?</p>
        </div>
        <div class="flex justify-end space-x-4">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
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
                    @foreach($units as $unit)
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
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Update
                </button>
            </div>
        </form>                        
    </div>
</div>


@if(session('success'))
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
</body>

</html>
