<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Reset Password</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main id="content" role="main" class="w-full max-w-md p-6">
        <div class="bg-white rounded-xl shadow-lg border-2 border-indigo-300">
            <div class="p-6">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800">Reset Password</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Enter your new password below to reset your account password.
                    </p>
                </div>

                <div class="mt-5">
                    <form action="{{ route('reset-password') }}" method="POST">
                        @csrf
                        <div class="grid gap-y-4">
                            <!-- New Password -->
                            <div>
                                <label for="new-password" class="block text-sm font-bold ml-1 mb-2">New Password</label>
                                <div class="relative">
                                    <input type="password" id="new-password" name="password"
                                        class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required>
                                </div>
                                <p class="hidden text-xs text-red-600 mt-2" id="new-password-error">Please enter a valid
                                    password.</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="confirm-password" class="block text-sm font-bold ml-1 mb-2">Confirm
                                    Password</label>
                                <div class="relative">
                                    <input type="password" id="confirm-password" name="password_confirmation"
                                        class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required>
                                </div>
                                <p class="hidden text-xs text-red-600 mt-2" id="confirm-password-error">Passwords do not
                                    match.</p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
