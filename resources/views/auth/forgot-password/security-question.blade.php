<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <title>Security Question</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main id="content" role="main" class="w-full max-w-md p-6">
        <div class="bg-white rounded-xl shadow-lg border-2 border-indigo-300">
            <div class="p-6">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800">Security Question</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Answer the security question below to proceed with password reset.
                    </p>
                </div>

                <div class="mt-5">
                    <form action="{{ route('validate-security-question') }}" method="POST" id="securityQuestionForm">
                        @csrf
                        <div class="grid gap-y-4">
                            <!-- Security Question -->
                            <div>
                                <label for="security-question"
                                    class="block text-sm font-bold ml-1 mb-2">Question</label>
                                <p
                                    class="py-3 px-4 block w-full bg-gray-100 border-2 border-gray-200 rounded-md text-sm text-gray-800">
                                    {{ $question->security_question }}
                                </p>
                            </div>

                            <!-- Security Answer -->
                            <div>
                                <label for="security-answer" class="block text-sm font-bold ml-1 mb-2">Your
                                    Answer</label>
                                <div class="relative">
                                    <input type="text" id="security-answer" name="security_answer"
                                        class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required>
                                    @error('security_answer')
                                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">
                                Validate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
