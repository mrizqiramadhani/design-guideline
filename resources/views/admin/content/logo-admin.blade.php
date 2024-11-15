<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Content Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/content/logo.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h2 class="text-4xl font-bold text-gray-900">Logo</h2>
                <div class="flex space-x-4">
                    <button onclick="showModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Add New Logo
                    </button>
                </div>
            </div>

            <!-- Modal tambah logo -->
            <div id="addLogoModal"
                class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">

                    <!-- Header Modal -->
                    <h2 class="text-2xl font-semibold mb-4">Add New Logo</h2>

                    <form id="addLogoForm" method="POST" action="{{ route('admin.logo.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="text-red-500 mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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
                                <select name="unit_id" id="unit_id" class="w-full border border-gray-300 p-2 rounded"
                                    required>
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
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Logo</button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- Modal edit logo --}}
            <div id="editModal"
                class="fixed inset-0 hidden bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-8 shadow-lg relative">

                    <!-- Header Modal -->
                    <h2 class="text-2xl font-semibold mb-4">Edit Logo</h2>

                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                <td class="px-4 py-2 text-gray-900">{{ $logo->title }}</td>
                                <td class="px-4 py-2 text-gray-900">{{ $logo->unit->name ?? '' }}</td>
                                <td class="px-4 py-2 text-gray-900">
                                    <img src="{{ asset('storage/thumbnails/' . basename($logo->thumbnail)) }}"
                                        alt="Thumbnail" class="w-16 h-16 object-cover">
                                </td>

                                <!-- Tema Primary -->
                                <td class="px-4 py-2 text-gray-900">
                                    @if ($logo->logoPhotos->where('theme', 'Primary')->count() === 0)
                                        <span class="text-gray-500">No Primary Images</span>
                                    @else
                                        <div class="flex flex-wrap justify-start gap-2">
                                            @foreach ($logo->logoPhotos->where('theme', 'Primary') as $photo)
                                                <img src="{{ asset('storage/logo_photos/' . basename($photo->path)) }}"
                                                    alt="Theme Primary" class="w-10 h-10 object-cover rounded-md">
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <!-- Tema White -->
                                <td class="px-4 py-2 text-gray-900">
                                    @if ($logo->logoPhotos->where('theme', 'White')->count() === 0)
                                        <span class="text-gray-500">No White Images</span>
                                    @else
                                        <div class="flex flex-wrap justify-start gap-2">
                                            @foreach ($logo->logoPhotos->where('theme', 'White') as $photo)
                                                <img src="{{ asset('storage/logo_photos/' . basename($photo->path)) }}"
                                                    alt="Theme White" class="w-10 h-10 object-cover rounded-md">
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button onclick="openEditModal({{ $logo->id }})"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Edit
                                        </button>
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('admin.logo.destroy', $logo->id) }}')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}', // Pesan dari controller
                showConfirmButton: true,
            });
        </script>
    @endif
    <script src="{{ asset('js/admin/content/logo-admin.js') }}"></script>
</body>

</html>
