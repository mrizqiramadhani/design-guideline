<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Logo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap");
    @import url(https://db.onlinewebfonts.com/c/29ddb4605533a38e086b48fa105e0d12?family=Nohemi);

    * {
        font-family: Nohemi;
    }

    .dropdown-outside-card {
        top: 0;
        /* Posisi dropdown sejajar dengan atas card */
        right: -12px;
        /* Geser keluar ke kanan dari card */
        transform: translateX(100%);
        /* Pindahkan sepenuhnya ke kanan */
    }

    @media (max-width: 640px) {

        /* Untuk layar kecil (mobile) */
        .dropdown-outside-card {
            top: 100%;
            /* Geser dropdown ke bawah tombol */
            right: 0;
            /* Posisi dropdown sejajar dengan tombol */
            transform: translateX(0);
            /* Reset transformasi */
            width: 100%;
            /* Lebar dropdown penuh sesuai tombol */
        }
    }
</style>

<body>

    <!-- Navigation Header -->
    <nav class="bg-white py-2 flex items-center justify-between px-4 md:px-12">
        <div class="flex items-center">
            <a href="{{ route('shafwah-holidays') }}#downloads">
                <img src="{{ asset('img/main-SH.png') }}" alt="Logo" class="max-h-20 w-auto mr-4">
            </a>
        </div>
    </nav>

    <header class="px-20 py-3">
        <div class="flex flex-col">
            <div class="relative flex justify-between items-center mx-10">
                <!-- Bagian Kiri: Menu Primary dan White -->
                <ul class="flex space-x-12">
                    <li>
                        <!-- Menu Primary -->
                        <a href="{{ route('logo-primary-sh', $logo->id) }}"
                            class="transition-colors duration-300 text-blue-500 hover:text-blue-500">
                            Primary
                        </a>
                    </li>
                    <li>
                        <!-- Menu White -->
                        <a href="{{ route('logo-white-sh', $logo->id) }}"
                            class="transition-colors duration-300 text-gray-800 hover:text-blue-500">
                            White
                        </a>
                    </li>
                </ul>

                <!-- Bagian Kanan: Button Download All Logo -->
                <div class="hidden sm:block">
                    <a href="{{ route('logos.download', $logo->id) }}"
                        class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                        <span class="iconify" data-icon="mdi:download" style="font-size: 1.5rem;"></span>
                        <span>Download All Logo</span>
                    </a>
                </div>
            </div>
            <hr class="border-t-4 border-blue-500 mt-7 z-10 w-32">
            <hr>
            <div class="block sm:hidden mt-4">
                <a href="{{ route('logos.download', $logo->id) }}"
                    class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                    <span class="iconify" data-icon="mdi:download" style="font-size: 1.5rem;"></span>
                    <span>Download All Logo</span>
                </a>
            </div>
        </div>
    </header>
    <main class="px-4 md:px-20 py-5">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
                $photos = $logo->logoPhotos->where('theme', 'Primary');
            @endphp

            @foreach ($photos as $photo)
                <div
                    class="border border-gray-200 rounded-lg shadow-lg p-2 w-full hover:shadow-2xl hover:bg-gray-50 transition duration-200 ease-in-out relative">
                    <!-- Header card -->
                    <div class="flex items-center justify-between mb-2">
                        <!-- Ikon Add Photo menggunakan Iconify -->
                        <div class="flex items-center space-x-2">
                            <div class="p-1">
                                <span class="iconify" data-icon="material-symbols:add-photo-alternate-rounded"
                                    style="color: #000000; font-size: 1.5rem;"></span>
                            </div>
                            <!-- Nama -->
                            <span class="font-medium text-gray-800">{{ $logo->title }}</span>
                        </div>
                        <!-- Dropdown menu -->
                        <div class="relative">
                            <button class="text-black text-2xl hover:bg-gray-200 rounded-full p-2"
                                id="dropdownToggle-{{ $loop->index }}">
                                <span class="iconify" data-icon="mdi:dots-vertical" data-inline="false"></span>
                            </button>
                            <div id="dropdownMenu-{{ $loop->index }}"
                                class="hidden dropdown-outside-card absolute w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                <a href="{{ asset('storage/logo_photos/' . basename($photo->path)) }}"
                                    download="{{ $logo->title }}_logo_primary_{{ $loop->iteration }}.jpg"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <span class="iconify" data-icon="material-symbols:download-rounded"
                                        style="font-size: 1.25rem;"></span>
                                    <span class="ml-2 text-sm font-medium text-gray-700">Download Logo</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Konten gambar -->
                    <div
                        class="bg-slate-100 rounded-lg overflow-hidden w-full h-[140px] flex items-center justify-center transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('storage/logo_photos/' . basename($photo->path)) }}" alt="Logo Photo"
                            class="h-auto object-cover max-h-full max-w-full" />
                    </div>
                </div>
            @endforeach

            @if ($photos->isEmpty())
                <!-- Centering the content in the grid when no photos are available -->
                <div class="col-span-2 sm:col-span-3 lg:col-span-5 flex items-center justify-center h-full">
                    <div class="flex flex-col items-center text-center">
                        <!-- GIF -->
                        <div class="w-full mb-3">
                            <img src="{{ asset('img/No data-pana.png') }}" alt="No Photo Available"
                                class="h-48 w-auto rounded-lg mx-auto">
                        </div>
                        <!-- Text -->
                        <p class="text-gray-600 font-medium">Sorry, no primary photos available 😭</p>
                    </div>
                </div>
            @endif
        </div>
    </main>
    <script>
        document.addEventListener('click', function(event) {
            // Loop through all dropdown toggles
            document.querySelectorAll('[id^="dropdownToggle-"]').forEach(function(toggle) {
                const index = toggle.id.split('-')[1];
                const menu = document.getElementById(`dropdownMenu-${index}`);

                if (toggle.contains(event.target)) {
                    // Toggle the visibility of the dropdown menu
                    menu.classList.toggle('hidden');
                } else if (!menu.contains(event.target)) {
                    // Close the menu if clicked outside
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
