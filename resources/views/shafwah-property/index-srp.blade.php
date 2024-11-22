<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/shafwah-property/style.css') }}" />
    <link rel="icon" href="{{ asset('img/main-SG.png') }}">
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
                    <ul class="flex space-x-10 text-lg text-white">
                        <li><a href="{{ route('shafwah-group') }}" class="nav-link">Shafwah Group</a></li>
                        <li><a href="{{ route('shafwah-holidays') }}" class="nav-link">Shafwah Holidays</a></li>
                        <li><a href="{{ route('shafwah-property') }}" class="nav-link">Shafwah Property</a></li>
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
                        <ul class="space-y-8 text-center mt-10 text-3xl capitalize text-black cursor-pointer">
                            <li><a href="#deskripsi">Deskripsi</a></li>
                            <li><a href="#logo">Logo</a></li>
                            <li><a href="#color-palette">Color Palette</a></li>
                            <li><a href="#typography">Typography</a></li>
                            <li><a href="#ilustration">Ilustration</a></li>
                            <li><a href="#social-media">Social Media</a></li>
                            <li><a href="#iconography">Iconography</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow px-5 py-8 text-2xl">
            <!-- Deskripsi Section -->
            <div class="p-4 mb-8 min-h-[1000px] bg-white">
                <h2 id="deskripsi" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Deskripsi</h2>
                <p class="font-light text-gray-600 text-justify paragraf">
                    Shafwah Group adalah perusahaan yang berdedikasi untuk menyediakan layanan berkualitas tinggi
                    di berbagai bidang seperti pariwisata, properti, dan lainnya. Kami bangga dengan komitmen
                    kami terhadap kepuasan pelanggan dan berusaha untuk memberikan pengalaman yang luar biasa
                    melalui berbagai unit bisnis kami.
                </p>
            </div>

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
                                <img src="{{ asset('storage/thumbnails/' . basename($logo->thumbnail)) }}"
                                    alt="{{ $logo->name }} Logo" class="h-full w-auto max-h object-contain" />
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
                        <!-- Color Circle with HEX code below -->
                        <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="#FFC300">
                            <div class="color-circle rounded-full mx-auto" style="background-color: #FFC300;">
                                <span class="copy-tooltip hidden"></i>Copy Code</span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">#FFC300</p>
                        </div>
                        <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="#581845">
                            <div class="color-circle rounded-full mx-auto" style="background-color: #581845;">
                                <span class="copy-tooltip hidden"></i>Copy Code</span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">#581845</p>
                        </div>
                        <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="#DAF7A6">
                            <div class="color-circle rounded-full mx-auto" style="background-color: #DAF7A6;">
                                <span class="copy-tooltip hidden"></i>Copy Code</span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">#DAF7A6</p>
                        </div>
                        <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="#C70039">
                            <div class="color-circle rounded-full mx-auto" style="background-color: #C70039;">
                                <span class="copy-tooltip hidden"></i>Copy Code</span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">#C70039</p>
                        </div>
                        <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="#C4E1F6">
                            <div class="color-circle rounded-full mx-auto" style="background-color: #C4E1F6;">
                                <span class="copy-tooltip hidden"></i>Copy Code</span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">#C4E1F6</p>
                        </div>
                        <div class="w-1/4 px-2 mb-4 text-center color-item" data-color="#536493">
                            <div class="color-circle rounded-full mx-auto" style="background-color: #536493;">
                                <span class="copy-tooltip hidden"></i>Copy Code</span>
                            </div>
                            <p class="text-lg mt-2 text-gray-600">#536493</p>
                        </div>
                    </div>

                    <!-- Notification -->
                    <div id="notification" class="notification hidden"></div>



                    <!-- Typography Section -->
                    <div class="p-4 mb-8 min-h-[1000px] bg-white">
                        <h2 id="typography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Typography</h2>
                        <p class="font-light text-gray-600 paragraf text-justify">Lorem ipsum dolor sit amet,
                            consectetur adipiscing
                            elit. Vivamus lacinia odio vitae vestibulum vestibulum.
                        </p>
                        <h3 class="font-semibold text-2xl text-black mt-6 mb-4">Primary Typeface</h3>
                        <p class="font-light text-gray-600 paragraf mb-6 text-justify">Lorem ipsum dolor sit amet,
                            consectetur
                            adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>

                        {{-- image --}}
                        <div class="h-[450px] mt-4 relative">
                            <img src="https://media.giphy.com/media/26vUucK24XyuAy9a0/giphy.gif?cid=790b7611ib14hw52te2ft44je5iphwu5evj8maz3lqx54psa&ep=v1_gifs_search&rid=giphy.gif&ct=g"alt="Typography Example"
                                class="h-full w-full object-cover rounded-sm" />
                        </div>
                        <a href="https://fonts.google.com/specimen/Montserrat" target="_blank"
                            rel="noopener noreferrer">
                            <button type="button"
                                class="w-full rounded-md border border-blue-600 bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500 mt-3 mr-5">
                                Download Font
                            </button>
                        </a>
                    </div>

                    <!-- Ilustration Section -->
                    <div class="p-4 mb-8 min-h-[1000px] bg-white">
                        <h2 id="ilustration" class="uppercase font-bold text-3xl text-black mb-4 section-heading">
                            Ilustration
                        </h2>
                        <p class="font-light text-gray-600 paragraf text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis nostrum soluta assumenda
                            accusantium illo
                            laboriosam inventore, blanditiis facere illum ab doloremque cumque? Tempora facilis
                            necessitatibus,
                            voluptates doloribus quas perspiciatis temporibus.
                        </p>

                        <!-- Rectangle Container -->
                        <div class="flex flex-wrap gap-4 mt-6 justify-between">
                            <!-- Image 1 -->
                            <img src="https://media1.giphy.com/media/AZRQtb6DA3fLq/200.webp?cid=790b76111dwt1sraxf00opjli7sjl837uqf5i121o1gppj3q&ep=v1_gifs_search&rid=200.webp&ct=g"
                                alt="Image 1" class="bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-cover">

                            <!-- Image 2 -->
                            <img src="https://media.giphy.com/media/rz1WOXXBJ1sZACwRSD/giphy.gif?cid=ecf05e47r35vril2f9ezsklop945zsza2t91vtpkpxtqld8f&ep=v1_gifs_related&rid=giphy.gif&ct=g"
                                alt="Image 2" class="bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-cover">

                            <!-- Image 3 -->
                            <img src="https://media.giphy.com/media/l0MYR64Gp8bQ2RGYo/giphy.gif?cid=ecf05e47mo9yz2ebk8spth7qb87chejl2oglv4s5hifhpp7u&ep=v1_gifs_related&rid=giphy.gif&ct=g"
                                alt="Image 3" class="bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-cover">

                            <!-- Image 4 -->
                            <img src="https://media.giphy.com/media/ErZ8hv5eO92JW/giphy.gif?cid=790b76117irugjg2qngqd076l3x3cow1r0jjden21tuvv2ab&ep=v1_gifs_search&rid=giphy.gif&ct=g"
                                alt="Image 4" class="bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-cover">

                            <!-- Image 5 -->
                            <img src="https://media.giphy.com/media/jFNTzpnwahSwg/giphy.gif?cid=ecf05e47qtfoidvajlihmq6zxiexzoxt1e877n44o02y4voe&ep=v1_gifs_search&rid=giphy.gif&ct=g"
                                alt="Image 5" class="bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-cover">

                            <!-- Image 6 -->
                            <img src="https://media.giphy.com/media/GDWhpl6PTEbkI/giphy.gif?cid=ecf05e47qtfoidvajlihmq6zxiexzoxt1e877n44o02y4voe&ep=v1_gifs_search&rid=giphy.gif&ct=g"
                                alt="Image 6" class="bg-gray-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-cover">
                        </div>

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

                        <div class="flex justify-center">
                            <img src="https://plus.unsplash.com/premium_vector-1724431910988-4de0021698ac?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxpbGx1c3RyYXRpb25zLWZlZWR8N3x8fGVufDB8fHx8fA%3D%3D"
                                alt="Social Media Feed" class="w-[655px] h-[543px] rounded-md object-cover" />
                        </div>

                        <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Story</h3>

                        <div class="flex justify-center">
                            <img src="https://plus.unsplash.com/premium_vector-1724431911049-5e5c9bd2fbc3?w=300&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1pbi1zYW1lLXNlcmllc3wzfHx8ZW58MHx8fHx8"
                                alt="Social Media Feed" class="w-[655px] h-[543px] rounded-md object-cover" />
                        </div>

                        <h3 class="font-semibold text-2xl text-black mt-20 mb-2 flex justify-center">Reels</h3>

                        <div class="flex justify-center">
                            <img src="https://plus.unsplash.com/premium_vector-1724431911126-2af198bc61f5?w=300&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1pbi1zYW1lLXNlcmllc3w0fHx8ZW58MHx8fHx8"
                                alt="Social Media Feed" class="w-[655px] h-[543px] rounded-md object-cover" />
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
                        <div class="h-[450px] mt-4 relative">
                            <img src="https://i.pinimg.com/564x/85/ab/16/85ab165d608fac66faa9c7dfde6c5b13.jpg"alt="Icongraphy Example"
                                class="h-full w-full object-cover rounded-sm" />
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
                            Campaign</h2>
                        <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Enim ipsum mollitia veniam! Perspiciatis dignissimos ducimus laboriosam
                            fugit doloribus inventore molestias omnis nesciunt, odit temporibus! Laborum vitae error vel
                            sapiente similique.</p>
                        <!-- Rectangle Container -->
                        <div class="flex flex-wrap gap-4 mt-6 justify-start">
                            <!-- Image 1 -->
                            <img src="{{ asset('img/Logo - Ada Jalan Menuju Kebaikan.png') }}" alt="Image 1"
                                class="bg-grey-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-contain mx-auto">

                            <!-- Image 2 -->
                            <img src="{{ asset('img/NiatAjaDulu-01.png') }}" alt="Image 2"
                                class="bg-grey-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-contain mx-auto">

                            <!-- Image 3 -->
                            <img src="{{ asset('img/WujudkanNiatmu-01.png') }}" alt="Image 3"
                                class="bg-grey-200 w-[calc(50%-0.5rem)] h-64 rounded-md object-contain mx-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/shafwah-property/script.js') }}"></script>
</body>

</html>
