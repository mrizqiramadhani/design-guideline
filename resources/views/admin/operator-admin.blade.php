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
</head>

<body>
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
                                class="nav-link relative inline-block text-white transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Dashboard
                                <span class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('admin.show-operators') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500"
                                style="color: #2076ff">
                                Operator
                                <span class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
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
        <aside class="w-1/5 bg-white border-r border-gray-200">
            <div class="px-10 py-20">
                <nav class="my-8">
                    <ul class="space-y-6 text-lg text-gray-900">
                        <li>
                            <a href="{{ route('admin.deskripsi') }}" 
                               class="{{ request()->routeIs('admin.deskripsi') ? 'active' : '' }}">
                                Deskripsi
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

                <!-- Modal Konfirmasi Hapus -->
                <div id="deleteModal"
                    class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg w-1/3 p-8 shadow-lg">
                        <h2 class="text-2xl font-semibold mb-4">Delete Confirmation</h2>
                        <p class="mb-6">Are you sure you want to delete this operator?</p>
                        <div class="flex justify-end">
                            <button onclick="closeDeleteModal()"
                                class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <form id="deleteForm" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Modal tambah operator -->
                <div id="addOperatorModal"
                    class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden items-center justify-center">
                    <div class="bg-white rounded-lg w-1/3 p-8 shadow-lg">
                        <h2 class="text-2xl font-semibold mb-4">Add New Operator</h2>

                        <form id="addOperatorForm" action="{{ route('admin.addOperator') }}" method="POST">
                            @csrf
                            <div id="errorMessages" class="text-red-500 mb-4 hidden"></div>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Name:</label>
                                <input type="text" name="name" id="name"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email:</label>
                                <input type="email" name="email" id="email"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password:</label>
                                <input type="password" name="password" id="password"
                                    class="w-full border border-gray-300 p-2 rounded" required>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" onclick="closeModal()"
                                    class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add
                                    Operator</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- SweetAlert Success Message -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif


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
    <footer class="absolute bottom-0 left-0 w-full bg-black text-center text-white p-4">
        <aside>
            <p>Copyright © 2024 - All rights reserved by Shafwah Group</p>
        </aside>
    </footer>
    <script src="{{ asset('js/admin/op-script.js') }}"></script>
</body>

</html>
