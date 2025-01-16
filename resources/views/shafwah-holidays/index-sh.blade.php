<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shafwah Holidays</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/shafwah-holidays/style.css') }}" />
    <link rel="icon" href="{{ asset('img/main-SG.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <style>
        #masonry-grid {
            display: block;
            overflow: visible;
        }

        .group {
            margin-bottom: 18px;
            /* Sama dengan gutter Masonry */
            overflow: hidden;
            /* Pastikan gambar tidak keluar */
            position: relative;
        }
    </style>

</head>

<body>
    <!-- Header -->
    <header id="navbar"
        class="bg-transparent text-black navbar-default transition-colors duration-300 fixed top-0 left-0 right-0 z-10">
        <div class="mx-auto max-w-screen-xl px-4 py-4 sm:px-6 sm:py-8 lg:px-8">
            <div class="flex flex-wrap items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <h1 class="text-2xl font-bold sm:text-3xl cursor-pointer">
                        <a href="{{ url('/') }}" id="navbar-logo">Shafwah Content</a>
                    </h1>
                </div>
                <!-- Navigation -->
                <div class="flex items-center space-x-4 md:space-x-8">
                    <ul class="hidden sm:flex space-x-10 text-lg font-bold">
                        <li class="group">
                            <a href="{{ route('shafwah-group') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Shafwah Group
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('shafwah-holidays') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500"
                                style="color:
                                #2076ff">
                                Shafwah Holidays
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('shafwah-property') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Shafwah Property
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                    </ul>
                    <!-- Hamburger Menu -->
                    <div class="sm:hidden">
                        <button id="hamburger" type="button"
                            class="text-black hover:text-gray-300 focus:outline-none focus:text-gray-300"
                            onclick="document.getElementById('drawer').classList.toggle('hidden');">
                            <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Drawer -->
        <div id="drawer" class="fixed inset-0 z-20 hidden bg-black bg-opacity-50">
            <div class="fixed top-0 right-0 w-64 bg-white h-full shadow-lg overflow-y-auto">
                <!-- Drawer Header -->
                <div class="p-4 border-b">
                    <button type="button" class="text-gray-600 hover:text-gray-900" onclick="toggleDrawer()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Drawer Navigation -->
                <ul class="p-4 space-y-4 text-black" id="drawer-links">
                    {{-- <li>
                        <a href="{{ route('shafwah-group') }}" class="block py-2 hover:bg-gray-100 rounded">Shafwah
                            Group</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('shafwah-holidays') }}" class="block py-2 hover:bg-gray-100 rounded">Shafwah
                            Holidays</a>
                    </li>
                    <li>
                        <a href="{{ route('shafwah-property') }}" class="block py-2 hover:bg-gray-100 rounded">Shafwah
                            Property</a>
                    </li>

                    <!-- Separator -->
                    <hr class="my-4 border-gray-300">

                    <!-- Tag li Section -->
                    <li>
                        <a href="#deskripsi" class="block py-2 hover:bg-gray-100 rounded">Description</a>
                    </li>
                    <li>
                        <a href="#logo" class="block py-2 hover:bg-gray-100 rounded">Logo</a>
                    </li>
                    <li>
                        <a href="#color-palette" class="block py-2 hover:bg-gray-100 rounded">Color Palette</a>
                    </li>
                    <li>
                        <a href="#typography" class="block py-2 hover:bg-gray-100 rounded">Typography</a>
                    </li>
                    <li>
                        <a href="#illustration" class="block py-2 hover:bg-gray-100 rounded">Pattern</a>
                    </li>
                    <li>
                        <a href="#social-media" class="block py-2 hover:bg-gray-100 rounded">Social Media</a>
                    </li>
                    <li>
                        <a href="#iconography" class="block py-2 hover:bg-gray-100 rounded">Iconography</a>
                    </li>
                    <li>
                        <a href="#campaign" class="block py-2 hover:bg-gray-100 rounded">Campaign</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>


    <!-- Header Image Section -->
    <div class="w-full h-[800px] flex items-center justify-center"
        style="background-image: url('{{ asset('img/index-img/img_1.jpg') }}'); background-size: cover; background-position: center;">
        <div class="w-full h-auto flex items-center justify-center">
            <div class="flex justify-center items-center w-full px-4 sm:px-10 h-auto relative">
                <img src="{{ asset('img/main-SH.png') }}" alt="Main SG Image"
                    class="h-auto max-h-[400px] w-full sm:max-w-[80%] object-contain" />
            </div>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside style="width: 430px; flex-shrink: 0"
            class="flex flex-col px-5 py-3 overflow-y-auto bg-white border-r border-black sidebar-sticky hidden sm:block">
            <nav class="-mx-3 space-y-6">
                <div class="space-y-3">
                    <div class="flex justify-center ml-10">
                        <ul class="space-y-8 text-center mt-10 text-3xl capitalize text-black cursor-pointer font-bold">
                            {{-- <li><a href="#deskripsi">Description</a></li> --}}
                            <li><a href="#logo">Logo</a></li>
                            <li><a href="#color-palette">Color Palette</a></li>
                            <li><a href="#typography">Typography</a></li>
                            <li><a href="#illustration">Pattern</a></li>
                            <li><a href="#social-media">Social Media</a></li>
                            <li><a href="#iconography">Iconography</a></li>
                            <li><a href="#campaign">Campaign</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow px-5 py-8 text-xl sm:text-2xl lg:px-10 lg:py-12">
            {{-- <!-- Deskripsi Section -->
            <h2 id="deskripsi" class="uppercase font-bold text-3xl text-black pl-4 mb-4 section-heading">Description
            </h2>

            @foreach ($descriptions as $description)
                <div class="p-4 mb-2">
                    @if ($description->title)
                        <!-- Periksa apakah ada title -->
                        <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $description->title }}</h3>
                    @endif
                    <p class="font-light text-gray-600 text-justify paragraf">
                        {{ $description->content }}
                    </p>
                </div>
            @endforeach --}}

            <!-- Logo Section -->
            <div class="p-4 mb-8 min-h-[1000px]">
                <h2 id="logo" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Logo</h2>
                <p class="font-light text-gray-600 paragraf text-justify">
                    Di bagian ini, kami akan menyajikan cerita di balik penciptaan logo kami, makna simbolis yang
                    terkandung dalam desainnya, serta panduan untuk memastikan penggunaannya yang konsisten dan efektif
                    untuk berbagai platform.
                </p>
                <h3 class="font-semibold text-2xl text-black mt-8 mb-4 text-center">Filosofi Logo</h3>

                <img src="{{ asset('img/filosofi-sh.png') }}" alt="Logo Shafwah Holidays"
                    class="w-full h-auto max-w-full mx-auto mt-4 mb-14">


                {{-- download section --}}
                <h3 id="downloads" class="font-semibold text-2xl text-black mt-5 mb-10 download-anchor">Downloads</h3>
                <div class="flex flex-wrap -mx-2">
                    @foreach ($logos as $logo)
                        <div class="w-1/2 sm:w-1/4 px-2 mb-4">
                            <div class="relative block aspect-square rounded-lg overflow-hidden">
                                <div class="flex items-center justify-center h-full">
                                    <img src="{{ asset('storage/thumbnails/' . basename($logo->thumbnail)) }}"
                                        alt="{{ $logo->name }} Logo" class="h-full w-full object-contain " />
                                </div>
                                <div
                                    class="absolute inset-0 bg-black opacity-0 hover:opacity-80 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('logo-primary-sh', $logo->id) }}" class="button-custom">See
                                        More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Color Palette Section -->
            <div class="p-4 mb-8">
                <h2 id="color-palette" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Color
                    Palette</h2>
                <p class="font-light text-gray-600 paragraf text-justify">Palet warna yang digunakan dalam berbagai
                    platform desain dan alat pemasaran berasal dari turunan warna logo brand Shafwah Holidays</p>
                <h3 class="font-semibold text-2xl text-black mt-6 mb-12">Primary Color</h3>

                <!-- Color Palette Display -->
                <div class="flex flex-wrap -mx-2">
                    @foreach ($colors as $color)
                        <div class="w-1/2 sm:w-1/4 px-2 mb-4 text-center color-item"
                            data-color="{{ $color->color }}">
                            <div class="color-circle rounded-full mx-auto"
                                style="background-color: {{ $color->color }}; position: relative; width: 100px; height: 100px;">
                                <span class="copy-tooltip hidden"
                                    style="font-size: 15px; font-weight: bold; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    Copy Code
                                </span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">{{ $color->color }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Notification -->
                <div id="notification" class="notification hidden"></div>
            </div>



            <!-- Typography Section -->
            <div class="p-4 mb-8">
                <h2 id="typography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                    Typography
                </h2>
                <p class="font-light text-gray-600 paragraf text-justify">
                    Dalam menyajikan setiap informasi, Shafwah Group konsisten menggunakan tiga pilihan font utama yang
                    disesuaikan dengan kebutuhan publikasi, yaitu Montserrat dan Poppins.
                </p>
                <h3 class="font-semibold text-2xl text-black mt-6 mb-4">Primary Typeface</h3>


                @if ($typographys->isNotEmpty())
                    <!-- Typography Section -->
                    <div class="mt-4 flex flex-col items-center space-y-8">
                        @foreach ($typographys as $typography)
                            <div class="w-full flex flex-col items-center space-y-4">
                                <div class=" relative flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $typography->path) }}" alt="Typography Image"
                                        class="h-full w-full object-contain rounded-sm" />
                                </div>
                                @if ($typography->font_name)
                                    <a href="{{ $typography->font_name }}" target="_blank" rel="noopener noreferrer"
                                        class="w-full">
                                        <button type="button"
                                            class="w-full rounded-md border border-blue-600 bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                            Download
                                        </button>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Ilustration Section -->
            <div class="p-4 mb-8">
                <h2 id="illustration" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                    Pattern
                </h2>
                <p class="font-light text-gray-600 paragraf text-justify">
                    Pattern yang digunakan untuk menyempurnakan tampilan visual merupakan pattern yang mewakili
                    nilai-nilai perusahaan.
                </p>

                @if ($illustrations->isNotEmpty())
                    <!-- Rectangle Container -->
                    <div id="masonry-grid" class="flex flex-wrap gap-4 mt-4">
                        @foreach ($illustrations as $illustration)
                            <div class="overflow-hidden group w-full sm:w-[calc(50%-16px)] md:w-[calc(33.333%-16px)]"
                                data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <img src="{{ asset('storage/' . $illustration->path) }}" alt="Illustration Image"
                                    class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-110 mb-5">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Social Media Section -->
            <div class="p-4 mb-2">
                <h2 id="social-media" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                    Social Media
                </h2>
                <p class="font-light text-gray-600 paragraf text-justify mb-10">
                    Berikut adalah beberapa contoh penggunaan logo, ikon, serta informasi lainnya di platform media
                    sosial.

                </p>
                <!-- Feed Section -->
                <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Feed</h3>
                <div class="grid grid-cols-1 gap-4 justify-items-center">
                    @php
                        $feedSocialMedias = $socialMedias->where('type', 'feed');
                    @endphp

                    @if ($feedSocialMedias->isEmpty())
                        <p class="text-center text-gray-500">No Social Media content available for feed.</p>
                    @else
                        @foreach ($feedSocialMedias as $socialMedia)
                            <div class="bg-black rounded-md">
                                <img src="{{ asset('storage/' . $socialMedia->path) }}" alt="Social Media Feed"
                                    class="rounded-md object-contain mx-auto"
                                    style="max-width: 100%; max-height: 100%;" />
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Story Section -->
                <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Story</h3>
                <div class="grid grid-cols-1 gap-4 justify-items-center">
                    @php
                        $storySocialMedias = $socialMedias->where('type', 'story');
                    @endphp

                    @if ($storySocialMedias->isEmpty())
                        <p class="text-center text-gray-500">No Social Media content available for story.</p>
                    @else
                        @foreach ($storySocialMedias as $socialMedia)
                            <div class="bg-black rounded-md">
                                <img src="{{ asset('storage/' . $socialMedia->path) }}" alt="Social Media Story"
                                    class="rounded-md object-contain mx-auto"
                                    style="max-width: 100%; max-height: 100%;" />
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Reels Section -->
                <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Reels</h3>
                <div class="grid grid-cols-1 gap-4 justify-items-center">
                    @php
                        $reelsSocialMedias = $socialMedias->where('type', 'reels');
                    @endphp

                    @if ($reelsSocialMedias->isEmpty())
                        <p class="text-center text-gray-500">No Social Media content available for reels.</p>
                    @else
                        @foreach ($reelsSocialMedias as $socialMedia)
                            <div class="bg-black rounded-md">
                                <img src="{{ asset('storage/' . $socialMedia->path) }}" alt="Social Media Reels"
                                    class="rounded-md object-contain mx-auto"
                                    style="max-width: 100%; max-height: 100%;" />
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>




            <!-- Iconography Section -->
            <div class="p-4 mb-8 bg-white">
                <h2 id="iconography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                    Iconography
                </h2>
                <p class="font-light text-gray-600 paragraf text-justify">
                    Ikonografi yang digunakan oleh Shafwah Group berupa ikon 2D sederhana dengan garis tepi (outline)
                    yang jelas, namun tetap efektif dalam mewakili visual yang ingin disampaikan.
                </p>


                @if ($iconographys->isNotEmpty())
                    <!-- iconography Section -->
                    <div class="mt-4 flex flex-col items-center space-y-8">
                        @foreach ($iconographys as $iconography)
                            <!-- Container Gambar dan Tombol -->
                            <div class="w-full flex flex-col items-center space-y-4">
                                <!-- Gambar iconography -->
                                <div class="relative flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $iconography->path) }}" alt="Iconography Image"
                                        class="h-full w-full object-contain rounded-sm" />
                                </div>

                                <!-- Tombol Download -->
                                @if ($iconography->link)
                                    <a href="{{ $iconography->link }}" target="_blank" rel="noopener noreferrer"
                                        class="w-full">
                                        <button type="button"
                                            class="w-full rounded-md border border-blue-600 bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                            Download
                                        </button>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Campaign Section -->
            <div class="p-4 mb-8 bg-white">
                <h2 id="campaign" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                    Campaign
                </h2>
                <p class="font-light text-gray-600 paragraf">
                    Berikut campaign marketing yang dijalankan untuk tahun ini
                </p>

                <!-- Rectangle Container -->
                <div class="flex flex-wrap gap-4 mt-6 justify-between">
                    @foreach ($campaigns->where('status', 'publish') as $campaign)
                        <div
                            class="relative bg-gray-200 w-full sm:w-[calc(50%-0.5rem)] h-64 rounded-md overflow-hidden group flex items-center justify-center 
                                    @if ($loop->last && $loop->remaining % 2 === 0) mx-auto @endif">

                            <!-- Image -->
                            <img src="{{ asset('storage/' . $campaign->path) }}" alt="Campaign Image"
                                class="object-contain max-w-full max-h-full rounded-md">

                            <!-- Hover Overlay -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('campaign.download', $campaign->id) }}"
                                    class="px-6 py-2 rounded-full border border-white text-white hover:bg-white hover:text-black transition-all duration-300">
                                    Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <footer class="bg-black text-white p-10 flex flex-col md:flex-row justify-between items-center">
        <aside class="flex flex-col items-center md:items-start mb-6 md:mb-0">
            <img src="{{ asset('img/main-SG.png') }}" class="w-40 h-auto mb-4" alt="Shafwah Group Logo">
            <p class="text-center md:text-left">
                All rights reserved by Shafwah Group
                <br />
                Copyright © 2024
            </p>
        </aside>
        <nav class="flex flex-col items-center md:items-end">
            <h6 class="text-lg font-semibold mb-4">Social</h6>
            <div class="flex gap-4">
                <a href="#" class="hover:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                        </path>
                    </svg>
                </a>
                <a href="https://www.facebook.com/ShafwahGroup/" class="hover:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                        </path>
                    </svg>
                </a>
                <a href="https://www.instagram.com/shafwahgroup/#" class="hover:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M12 2.163c-2.136 0-2.393.008-3.233.047-.84.039-1.418.173-1.921.37a4.601 4.601 0 00-1.675 1.07 4.601 4.601 0 00-1.07 1.675c-.197.503-.331 1.081-.37 1.921-.039.84-.047 1.097-.047 3.233s.008 2.393.047 3.233c.039.84.173 1.418.37 1.921.244.623.597 1.172 1.07 1.675.503.503 1.052.826 1.675 1.07.503.197 1.081.331 1.921.37.84.039 1.097.047 3.233.047s2.393-.008 3.233-.047c.84-.039 1.418-.173 1.921-.37a4.601 4.601 0 001.675-1.07 4.601 4.601 0 001.07-1.675c.197-.503.331-1.081.37-1.921.039-.84.047-1.097.047-3.233s-.008-2.393-.047-3.233c-.039-.84-.173-1.418-.37-1.921a4.601 4.601 0 00-1.07-1.675 4.601 4.601 0 00-1.675-1.07c-.503-.197-1.081-.331-1.921-.37-.84-.039-1.097-.047-3.233-.047zm0-2.163c2.216 0 2.485.008 3.363.048 1.872.085 3.191.39 4.354 1.083a6.606 6.606 0 012.41 2.41c.693 1.163.998 2.482 1.083 4.354.04.878.048 1.147.048 3.363s-.008 2.485-.048 3.363c-.085 1.872-.39 3.191-1.083 4.354a6.606 6.606 0 01-2.41 2.41c-1.163.693-2.482.998-4.354 1.083-.878.04-1.147.048-3.363.048s-2.485-.008-3.363-.048c-1.872-.085-3.191-.39-4.354-1.083a6.606 6.606 0 01-2.41-2.41c-.693-1.163-.998-2.482-1.083-4.354-.04-.878-.048-1.147-.048-3.363s.008-2.485.048-3.363c.085-1.872.39-3.191 1.083-4.354a6.606 6.606 0 012.41-2.41c1.163-.693 2.482-.998 4.354-1.083.878-.04 1.147-.048 3.363-.048zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.141a3.979 3.979 0 110-7.958 3.979 3.979 0 010 7.958zm6.406-10.974a1.44 1.44 0 11-2.881 0 1.44 1.44 0 012.881 0z">
                        </path>
                    </svg>
                </a>
            </div>
        </nav>
    </footer>
    <script src="{{ asset('js/shafwah-holidays/script.js') }}"></script>
</body>

</html>
