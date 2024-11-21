<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Logo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/admin/content/deskripsi.css">
</head>

<style>
    * {
        font-family: Nohemi;
    }
</style>

<body>

    <!-- Navigation Header -->
    <nav class="bg-white py-0 flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('shafwah-holidays') }}"><img src="{{ asset('img/main-SH.png') }}" alt="Logo"
                    class="h-40 mr-4 bg-white-300"></a>
        </div>
    </nav>

    <header class="px-20 py-3">
        <div class="flex flex-col">
            <div class="relative flex space-x-4 mx-10">
                <ul class="flex space-x-12">
                    <li>
                        <!-- Menu Primary -->
                        <a href="{{ route('logo-primary-sh', $logo->id) }}"
                            class="transition-colors duration-300 text-gray-800 hover:text-blue-500">
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
            </div>
            <hr class="border-t-4 border-blue-500 mx-28 mt-7 z-10 w-32">
            <hr>
        </div>
    </header>

    <main class="px-20 py-12">
        <div class="grid grid-cols-5 gap-4">
            @php
                $photos = $logo->logoPhotos->where('theme', 'White');
            @endphp

            @foreach ($photos as $photo)
                <div
                    class="border border-gray-200 rounded-lg shadow-lg p-5 min-h-[210px] w-full hover:shadow-xl hover:bg-gray-50 transition duration-200 ease-in-out">
                    <div class="flex justify-between items-center mb-4">
                        <i class="fa-solid fa-image"></i>
                        <div class="flex-grow text-center">
                            <span class="font-medium text-gray-800">{{ $logo->name }}</span>
                        </div>
                    </div>
                    <div
                        class="bg-gray-100 p-2 rounded-lg overflow-hidden w-full h-[120px] flex items-center justify-center transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('storage/logo_photos/' . basename($photo->path)) }}" alt="Logo Photo"
                            class="h-auto object-cover max-h-full max-w-full rounded-lg shadow-md">
                    </div>
                </div>
            @endforeach

            @if ($photos->isEmpty())
                <!-- Centering the content in the grid when no photos are available -->
                <div class="col-span-5 flex items-center justify-center h-full min-h-[210px]">
                    <div class="flex flex-col items-center text-center">
                        <!-- GIF -->
                        <div class="w-full mb-3">
                            <img src="https://i.pinimg.com/originals/6a/f3/71/6af371f102361c0fd47619eb524bf4bb.gif"
                                alt="No Photo Available" class="h-32 w-auto rounded-lg mx-auto">
                        </div>
                        <!-- Text -->
                        <p class="text-gray-600 font-medium">Maaf, Photo White tidak ada :3</p>
                    </div>
                </div>
            @endif
        </div>
    </main>
    <script src="js/admin/content/logo-admin.js"></script>

</body>

</html>
