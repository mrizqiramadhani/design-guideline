<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/shafwah-holidays/style.css')}}" />
    <link rel="icon" href="{{asset('img/main-SG.png')}}">
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
              <li><a href="{{route('shafwah-group')}}" class="nav-link">Shafwah Group</a></li>
              <li><a href="{{route('shafwah-holidays')}}" class="nav-link">Shafwah Holidays</a></li>
              <li><a href="{{route('shafwah-property')}}" class="nav-link">Shafwah Property</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <!-- Content Section -->
    <div class="w-full h-[800px] flex items-center justify-center bg-black">
      <img src="{{asset('img/main-SH.png')}}" alt="Shafwah Holidays" class="mx-auto bg-black" />
    </div>

    <div class="flex">
      <!-- Sidebar -->
      <aside style="width: 430px; flex-shrink: 0" class="flex flex-col px-5 py-3 overflow-y-auto bg-white border-r border-black sidebar-sticky">
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
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>

        <!-- Logo Section -->
        <div class="p-4 mb-8 min-h-[1000px] bg-white">
          <h2 id="logo" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Logo</h2>
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>

        <!-- color-palette Section -->
        <div class="p-4 mb-8 min-h-[1000px] bg-white">
          <h2 id="color-palette" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Color Palette</h2>
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>

        <!-- Typography Section -->
        <div class="p-4 mb-8 min-h-[1000px] bg-white">
          <h2 id="typography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Typography</h2>
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>

        <!-- Ilustration Section -->
        <div class="p-4 mb-8 min-h-[1000px] bg-white">
          <h2 id="ilustration" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Ilustration</h2>
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>

        <!-- Social Media Section -->
        <div class="p-4 mb-8 min-h-[1000px] bg-white">
          <h2 id="social-media" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Social Media</h2>
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>

        <!-- Iconography Section -->
        <div class="p-4 mb-8 min-h-[1000px] bg-white">
          <h2 id="iconography" class="uppercase font-bold text-3xl text-black mb-4 section-heading">Iconography</h2>
          <p class="font-light text-gray-600 paragraf">Lorem ipsum dolor sit amet...</p>
        </div>
      </div>
    </div>

    <script src="{{asset('js/shafwah-holidays/script.js')}}"></script>
  </body>
</html>
