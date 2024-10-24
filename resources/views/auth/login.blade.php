<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/auth/style.css') }}" />
  <link rel="icon" href="{{ asset('img/SG 2023-04.png') }}">
  <title>Auth</title>
</head>
<body>
  <section class="bg-white">
    <div class="mt-40">
      <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
        <div class="max-w-xl lg:max-w-3xl">
          <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
            Shafwah Login page 😳
          </h1>

          <!-- Pesan kesalahan jika ada -->
          @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
              <strong class="font-bold">Whoops!</strong>
              <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
          @endif

          <form action="{{ route('login') }}" method="POST" class="mt-4 space-y-4"> <!-- Changed to space-y-4 for uniform spacing -->
            @csrf <!-- Token CSRF untuk keamanan -->
            <div>
              <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
              <input
                type="email"
                id="Email"
                name="email"
                class="mt-1 w-full h-10 border-2 border-black bg-white text-lg text-black shadow-sm rounded-md px-3"
                required
              />
            </div>

            <div>
              <label for="Password" class="block text-sm font-medium text-gray-700">Password</label>
              <input
                type="password"
                id="Password"
                name="password"
                class="mt-1 w-full h-10 border-2 border-black bg-white text-lg text-black shadow-sm rounded-md px-3"
                required
              />
            </div>

            <div class="flex items-center justify-between">
              <button
                type="submit" 
                class="w-full rounded-md border border-blue-600 bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
              >
                Login
              </button>
            </div>
          </form>
        </div>
      </main>
    </div>
  </section>
</body>
</html>
