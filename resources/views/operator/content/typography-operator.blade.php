<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Operator - Content Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" />
    <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
</head>

<body>
    <!-- Header -->
    <header id="navbar" class="bg-black transition-colors duration-300 fixed top-0 left-0 right-0 z-10">
        <div class="mx-auto max-w-screen-xl px-4 py-3 sm:px-6 sm:py-4 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white sm:text-3xl cursor-pointer">
                    <a href="index.html">Shafwah Operator Panel</a>
                </h1>
                <div class="flex space-x-4">
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
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="flex min-h-screen">
        <aside class="w-1/5 bg-white border-r border-gray-200 font-bold">
            <div class="px-10 py-20">
                <nav class="my-8">
                    <ul class="space-y-6 text-lg text-gray-900">
                        <li>
                            <a href="{{ route('operator.deskripsi') }}"
                                class="{{ request()->routeIs('operator.deskripsi') ? 'active' : '' }}">
                                Deskripsi
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

        <main class="w-4/5 p-8 bg-gray-100">
            <div class="mt-20 mb-5 flex items-center justify-between">
                <h2 class="text-4xl font-bold text-gray-900">Typography</h2>
                <div class="flex space-x-4">
                    <a href="#" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Add New
                        Content</a>
                </div>
            </div>


            <!-- Content Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Category</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Content Type</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Last Updated By</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-gray-900">Shafwah Group</td>
                            <td class="px-4 py-2 text-gray-900">Description</td>
                            <td class="px-4 py-2 text-gray-900">Text</td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="#"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                    <a href="#"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-gray-900">Shafwah Holidays</td>
                            <td class="px-4 py-2 text-gray-900">Description</td>
                            <td class="px-4 py-2 text-gray-900">Text</td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="#"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                    <a href="#"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-gray-900">Shafwah Property</td>
                            <td class="px-4 py-2 text-gray-900">Description</td>
                            <td class="px-4 py-2 text-gray-900">Text</td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <a href="#"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                    <a href="#"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
                                </div>
                            </td>
                        </tr>
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
    <script src="{{ asset('js/admin/script.js') }}"></script>
</body>

</html>
