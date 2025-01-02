<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Password Reset Success</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main id="content" role="main" class="w-full max-w-md p-6 text-center">
        <div class="bg-white rounded-xl shadow-lg border-2 border-green-300 p-6">
            <!-- Success Icon -->
            <div class="flex justify-center">
                <svg class="w-16 h-16 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>

            <!-- Success Message -->
            <h1 class="mt-4 text-2xl font-bold text-gray-800">Password Successfully Reset</h1>
            <p class="mt-2 text-sm text-gray-600">You can now log in to your account with the new password.</p>

            <!-- Redirect Button -->
            <div class="mt-6">
                <a href="{{ route('login') }}"
                    class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">
                    Go to Login
                </a>
            </div>
        </div>
    </main>
</body>

</html>
