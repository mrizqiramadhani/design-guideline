<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Forgot Password</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main id="content" role="main" class="w-full max-w-md p-6">
        <div class="bg-white rounded-xl shadow-lg border-2 border-indigo-300">
            <div class="p-6">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800">Forgot Password?</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Remember your password?
                        <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{ route('login') }}">
                            Login here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    <form id="forgot-password-form">
                        @csrf
                        <div class="grid gap-y-4">
                            <div>
                                <label for="email" class="block text-sm font-bold ml-1 mb-2">Email Address</label>
                                <div class="relative">
                                    <input type="email" id="email" name="email"
                                        class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required aria-describedby="email-feedback" oninput="validateEmail()">
                                </div>
                                <p class="hidden text-xs text-red-600 mt-2 flex items-center gap-2" id="email-error">
                                    <span class="iconify" data-icon="bx:x-circle"></span>
                                    <span>Email is invalid.</span>
                                </p>
                                <p class="hidden text-xs text-green-600 mt-2 flex items-center gap-2"
                                    id="email-success">
                                    <span class="iconify" data-icon="bx:check-circle"></span>
                                    <span>Email is valid.</span>
                                </p>
                            </div>
                            <button type="button" id="reset-button" disabled
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm disabled:bg-gray-400 disabled:cursor-not-allowed">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script>
    const emailInput = document.getElementById('email');
    const button = document.getElementById('reset-button');
    const errorElement = document.getElementById('email-error');
    const successElement = document.getElementById('email-success');

    let debounceTimeout;

    function validateEmail() {
        clearTimeout(debounceTimeout);

        debounceTimeout = setTimeout(async () => {
            try {
                const response = await fetch('{{ route('admin-email') }}', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });

                const data = await response.json();
                if (!response.ok) throw response;

                if (data.email === emailInput.value) {
                    successElement.classList.remove('hidden');
                    errorElement.classList.add('hidden');
                    button.removeAttribute('disabled');

                    button.onclick = async () => {
                        try {

                            const response = await fetch('{{ route('validate-email') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    email: emailInput.value
                                })
                            })

                            const data = await response.json();

                            if (!response.ok) throw response;


                            console.log(data);

                            window.location.href = data.redirect;
                        } catch (error) {
                            alert('Failed to validate email. Please try again later.');
                        }
                    };
                } else {
                    successElement.classList.add('hidden');
                    errorElement.classList.remove('hidden');
                    button.setAttribute('disabled', 'disabled');
                }
            } catch (error) {
                alert('Failed to validate email. Please try again later.');
            }

        }, 300); // Debounce delay 300ms
    }
</script>

</html>
