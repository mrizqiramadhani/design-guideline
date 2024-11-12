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
            <a href="#downloads"><img src="img/main-SG.png" alt="Logo" class="h-40 mr-4 bg-white-300"></a>
        </div>
    </nav>

    <header class="px-20 py-3">
        <div class="flex flex-col">
            <div class="relative flex space-x-4 mx-10">
                <ul class="flex space-x-12">
                    <li>
                        <!-- Menu Primary -->
                        <a href="{{ route('logo-primary') }}"
                            class="transition-colors duration-300 text-gray-800 hover:text-blue-500">
                            Primary
                        </a>
                    </li>
                    <li>
                        <!-- Menu White -->
                        <a href="{{ route('logo-white') }}"
                            class="transition-colors duration-300 text-gray-800 hover:text-blue-500">
                            White
                        </a>
                    </li>
                </ul>
            </div>
            <hr class="border-t-4 border-blue-500 mx-28 mt-7 z-10 w-32">
        </div>
    </header>

    <main class="px-20 py-12">
        <div class="grid grid-cols-5 gap-4">
            <!-- Sample card items -->
            <div
                class="border border-gray-200 rounded-lg shadow-lg p-5 min-h-[210px] w-64 hover:shadow-xl hover:bg-gray-50 transition duration-200 ease-in-out">
                <div class="flex justify-between items-center mb-4">
                    <i class="fa-solid fa-image"></i>
                    <div class="flex-grow text-center">
                        <span class="font-medium text-gray-800">Sample Photo 1</span>
                    </div>
                    <button
                        class="ml-2 text-gray-600 hover:text-gray-800 p-2 rounded-full hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <div
                    class="bg-gray-100 p-2 rounded-lg overflow-hidden w-full h-[120px] flex items-center justify-center transition-transform duration-300 hover:scale-105">
                    <img src="img/main-SH.png" alt="Uploaded Photo"
                        class="h-auto object-cover max-h-full max-w-full rounded-lg shadow-md">
                </div>
            </div>

            <div
                class="border border-gray-200 rounded-lg shadow-lg p-5 min-h-[210px] w-64 hover:shadow-xl hover:bg-gray-50 transition duration-200 ease-in-out">
                <div class="flex justify-between items-center mb-4">
                    <i class="fa-solid fa-image"></i>
                    <div class="flex-grow text-center">
                        <span class="font-medium text-gray-800">Sample Photo 2</span>
                    </div>
                    <button
                        class="ml-2 text-gray-600 hover:text-gray-800 p-2 rounded-full hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <div
                    class="bg-gray-100 p-2 rounded-lg overflow-hidden w-full h-[120px] flex items-center justify-center transition-transform duration-300 hover:scale-105">
                    <img src="img/main-SH.png" alt="Uploaded Photo"
                        class="h-auto object-cover max-h-full max-w-full rounded-lg shadow-md">
                </div>
            </div>

            <!-- Additional sample cards can be duplicated here -->
        </div>
    </main>
    <script src="js/admin/content/logo-admin.js"></script>

</body>

</html>
