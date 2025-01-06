<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shafwah Property</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/shafwah-property/style.css') }}" />
    <link rel="icon" href="{{ asset('img/main-SG.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</head>

<body>
    <!-- Header -->
    <header id="navbar" class="bg-black transition-colors duration-300 fixed top-0 left-0 right-0 z-10">
        <div class="mx-auto max-w-screen-xl px-4 py-4 sm:px-6 sm:py-8 lg:px-8">
            <div class="flex flex-col items-start gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white sm:text-3xl cursor-pointer">
                        <a href="{{ url('/') }}"> Shafwah Content</a>
                    </h1>
                </div>
                <div class="flex space-x-4 md:space-x-8">
                    <ul class="flex space-x-10 text-lg text-white font-bold">
                        <li class="group">
                            <a href="{{ route('shafwah-group') }}"
                                class="nav-link relative inline-block text-white transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Shafwah Group
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('shafwah-holidays') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500">
                                Shafwah Holidays
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                        <li class="group">
                            <a href="{{ route('shafwah-property') }}"
                                class="nav-link relative inline-block transition-transform duration-300 ease-in-out group-hover:scale-105 group-hover:text-blue-500"
                                style="color: #2076ff">
                                Shafwah Property
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transition-all duration-500 ease-in-out group-hover:w-full rounded-full"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Section -->
    <div class="w-full h-[800px] flex items-center justify-center bg-black">
        <img src="{{ asset('img/main-SRP.png') }}" alt="Shafwah Property" class="mx-auto bg-black" />
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside style="width: 430px; flex-shrink: 0"
            class="flex flex-col px-5 py-3 overflow-y-auto bg-white border-r border-black sidebar-sticky">
            <nav class="-mx-3 space-y-6">
                <div class="space-y-3">
                    <div class="flex justify-center ml-10">
                        <ul class="space-y-8 text-center mt-10 text-3xl capitalize text-black cursor-pointer font-bold">
                            <li><a href="#deskripsi">Description</a></li>
                            <li><a href="#logo">Logo</a></li>
                            <li><a href="#color-palette">Color Palette</a></li>
                            <li><a href="#typography">Typography</a></li>
                            <li><a href="#ilustration">Illustration</a></li>
                            <li><a href="#social-media">Social Media</a></li>
                            <li><a href="#iconography">Iconography</a></li>
                            <li><a href="#campaign">Campaign</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow px-5 py-8 text-2xl">
            <!-- Deskripsi Section -->
            <h2 id="deskripsi" class="uppercase font-bold text-3xl text-black pl-4 mb-4 section-heading">Description
            </h2>

            @foreach ($descriptions as $description)
                <div class="p-4 mb-2 bg-white">
                    @if ($description->title)
                        <!-- Periksa apakah ada title -->
                        <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $description->title }}</h3>
                    @endif
                    <p class="font-light text-gray-600 text-justify paragraf">
                        {{ $description->content }}
                    </p>
                </div>
            @endforeach

            <!-- Logo Section -->
            <div class="p-4 mb-8 min-h-[1000px] bg-white">
                <h2 id="logo" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Logo</h2>
                <p class="font-light text-gray-600 paragraf text-justify">
                    Logo Shafwah Group mencerminkan profesionalisme, keunggulan layanan, dan dedikasi kami dalam
                    memberikan nilai terbaik kepada pelanggan. Desain logo yang modern dan elegan ini
                    mencerminkan misi kami untuk tetap relevan dan berkembang bersama kebutuhan klien kami.
                </p>
                <h3 class="font-semibold text-2xl text-black mt-5 mb-4">The Logo</h3>
                <p class="font-light text-gray-600 paragraf text-justify">
                    Logo kami dibuat dengan cermat untuk menggambarkan visi dan nilai yang kami pegang. Warna dan
                    bentuk logo disesuaikan untuk memberikan kesan terpercaya, inovatif, dan berorientasi pada
                    pelanggan dalam setiap aspek bisnis kami.
                </p>
                <img src="{{ asset('img/main-SRP.png') }}" alt="Logo Shafwah Group"
                    class="w-full h-auto max-w-full mx-auto mt-4">


                {{-- download section --}}
                <h3 id="downloads" class="font-semibold text-2xl text-black mt-5 mb-10 download-anchor">Downloads</h3>
                <div class="flex flex-wrap -mx-2">
                    @foreach ($logos as $logo)
                        <div class="w-1/4 px-2 mb-4">
                            <div class="relative block h-52 rounded-lg overflow-hidden">
                                <div class="flex items-center justify-center h-full">
                                    <img src="{{ asset('storage/thumbnails/' . basename($logo->thumbnail)) }}"
                                        alt="{{ $logo->name }} Logo" class="max-h-full max-w-full object-contain" />
                                </div>
                                <div
                                    class="absolute inset-0 bg-black opacity-0 hover:opacity-80 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('logo-primary-srp', $logo->id) }}" class="button-custom">See
                                        More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Color Palette Section -->
                <div class="p-4 mb-8 min-h-[1000px] bg-white">
                    <h2 id="color-palette" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Color
                        Palette</h2>
                    <p class="font-light text-gray-600 paragraf text-justify">Lorem ipsum dolor sit amet, consectetur
                        adipiscing
                        elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
                    <h3 class="font-semibold text-2xl text-black mt-6 mb-4">Primary Color</h3>
                    <p class="font-light text-gray-600 paragraf mb-6 text-justify">Lorem ipsum dolor sit amet,
                        consectetur
                        adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                    <!-- Color Palette Display -->
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($colors as $color)
                            <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="{{ $color->color }}">
                                <div class="color-circle rounded-full mx-auto"
                                    style="background-color: {{ $color->color }};">
                                    <span class="copy-tooltip hidden">Copy Code</span>
                                </div>
                                <p class="text-lg mt-2 text-gray-600">{{ $color->color }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Notification -->
                    <div id="notification" class="notification hidden"></div>



                    <!-- Typography Section -->
                    <div class="p-4 mb-8 bg-white">
                        <h2 id="typography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Typography
                        </h2>
                        <p class="font-light text-gray-600 paragraf text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.
                        </p>
                        <h3 class="font-semibold text-2xl text-black mt-6 mb-4">Primary Typeface</h3>
                        <p class="font-light text-gray-600 paragraf mb-6 text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    
                        @if ($typographys->isNotEmpty())
                        <!-- Typography Section -->
                        <div class="mt-4 flex flex-col items-center space-y-8">
                            @foreach ($typographys as $typography)
                                <!-- Container Gambar dan Tombol -->
                                <div class="w-full flex flex-col items-center space-y-4">
                                    <!-- Gambar Typography -->
                                    <div class="h-[450px] relative flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $typography->path) }}" alt="Typography Image"
                                            class="h-full w-full object-contain rounded-sm" />
                                    </div>

                                    <!-- Tombol Download -->
                                    @if ($typography->font_name)
                                        <a href="{{ $typography->font_name }}" target="_blank" rel="noopener noreferrer" class="w-full relative z-10">
                                            <button type="button"
                                                class="w-full rounded-md border border-blue-600 bg-blue-600 px-6 py-3 text-sm font-medium text-white transition-all hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500 block z-20">
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
                    <div class="p-4 mb-8 bg-white">
                        <h2 id="ilustration" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Illustration
                        </h2>
                        <p class="font-light text-gray-600 paragraf text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis nostrum soluta assumenda
                            accusantium illo
                            laboriosam inventore, blanditiis facere illum ab doloremque cumque? Tempora facilis
                            necessitatibus,
                            voluptates doloribus quas perspiciatis temporibus.
                        </p>

                        @if ($illustrations->isNotEmpty())
                            <!-- Rectangle Container -->
                            <div id="masonry-grid" class="flex flex-wrap gap-4 mt-6">
                                @foreach ($illustrations as $illustration)
                                    <div class="overflow-hidden group w-full sm:w-[calc(50%-16px)] md:w-[calc(33.333%-16px)]"
                                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                        <img src="{{ asset('storage/' . $illustration->path) }}"
                                            alt="Illustration Image"
                                            class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-110 mb-5">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Social Media Section -->
                    <div class="p-4 mb-8 min-h-[1000px] bg-white">
                        <h2 id="social-media" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Social Media
                        </h2>
                        <p class="font-light text-gray-600 paragraf text-justify mb-10">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut reiciendis blanditiis unde.
                            Repellat omnis placeat vel voluptates sed laborum inventore, minima rerum aperiam soluta
                            dicta ex consequatur corrupti quos voluptatem!
                        </p>

                        <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">
                            Feed</h3>
                        <div class="grid grid-cols-1 gap-4 justify-items-center">
                            @php
                                $feedSocialMedias = $socialMedias->where('type', 'feed');
                            @endphp

                            @if ($feedSocialMedias->isEmpty())
                                <p class="text-center text-gray-500">No Social Media content available for feed.</p>
                            @else
                                @foreach ($feedSocialMedias as $socialMedia)
                                    <img src="{{ asset('storage/' . $socialMedia->path) }}" alt="Social Media Feed"
                                        class="w-[655px] h-[543px] rounded-md object-cover" />
                                @endforeach
                            @endif
                        </div>


                        <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Story</h3>

                        <div class="grid grid-cols-1 gap-4 justify-items-center">
                            @php
                                $storySocialMedias = $socialMedias->where('type', 'story');
                            @endphp

                            @if ($storySocialMedias->isEmpty())
                                <p class="text-center text-gray-500">No Social Media content available for story.</p>
                            @else
                                @foreach ($storySocialMedias as $socialMedia)
                                    <img src="{{ asset('storage/' . $socialMedia->path) }}" alt="Social Media Story"
                                        class="w-[655px] h-[543px] rounded-md object-cover" />
                                @endforeach
                            @endif
                        </div>

                        <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Reels</h3>

                        <div class="grid grid-cols-1 gap-4 justify-items-center">
                            @php
                                $reelsSocialMedias = $socialMedias->where('type', 'reels');
                            @endphp

                            @if ($reelsSocialMedias->isEmpty())
                                <p class="text-center text-gray-500">No Social Media content available for reels.</p>
                            @else
                                @foreach ($reelsSocialMedias as $socialMedia)
                                    <img src="{{ asset('storage/' . $socialMedia->path) }}" alt="Social Media Feed"
                                        class="w-[655px] h-[543px] rounded-md object-cover" />
                                @endforeach
                            @endif
                        </div>
                    </div>


                    <!-- Iconography Section -->
                    <div class="p-4 mb-8 min-h-[1000px] bg-white">
                        <h2 id="iconography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Iconography</h2>
                        <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Enim ipsum mollitia veniam! Perspiciatis dignissimos ducimus laboriosam
                            fugit doloribus inventore molestias omnis nesciunt, odit temporibus! Laborum vitae error vel
                            sapiente similique.</p>
                        {{-- image --}}
                        <div class="h-[450px] mt-4 relative flex items-center justify-center">
                            @foreach ($iconographys as $iconography)
                                <img src="{{ asset('storage/' . $iconography->path) }}" alt="Iconography Image"
                                    class="h-full w-full object-contain rounded-sm" />
                            @endforeach
                        </div>
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <button type="button"
                                class="w-full rounded-md border border-blue-600 bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500 mt-3 mr-5">
                                Download icon
                            </button>
                        </a>
                    </div>

                    <!-- Campaign Section -->
                    <div class="p-4 mb-8 min-h-[1000px] bg-white">
                        <h2 id="campaign" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Campaign
                        </h2>
                        <p class="font-light text-gray-600 paragraf">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim ipsum mollitia veniam! Perspiciatis dignissimos
                            ducimus laboriosam fugit doloribus inventore molestias omnis nesciunt, odit temporibus! Laborum vitae error vel
                            sapiente similique.
                        </p>

                        <!-- Rectangle Container -->
                        <div class="flex flex-wrap gap-4 mt-6 justify-between">
                            @foreach ($campaigns->where('status', 'publish') as $campaign)
                                <div
                                    class="relative bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md overflow-hidden group flex items-center justify-center 
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

    <script src="{{ asset('js/shafwah-property/script.js') }}"></script>
</body>

</html>
