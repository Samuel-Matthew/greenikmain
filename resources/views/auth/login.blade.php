<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GREENIK - Home</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="stylesheet" href="./src/mycss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>


<body class="animated-bg min-h-screen">
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    <div class="floating-shape shape-4"></div>
    <div class="floating-shape shape-5"></div>
    <div class="floating-shape shape-6"></div>
    <div class="floating-shape shape-7"></div>



    <div class="min-h-screen flex items-center justify-center py-6 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="form-container rounded-2xl shadow-lg w-full max-w-sm bg-white p-6 sm:p-4">
            <!-- Header -->
            <div class="text-center mb-4">
                <!-- <div class="font-['Pacifico'] text-2xl text-primary mb-1">logo</div> -->
                <h1 class="text-xl font-bold text-gray-800 mb-1">Join Greenik</h1>
                <p class="text-gray-600 text-xs sm:text-sm">Create your account for clean energy solutions</p>
            </div>

            <!-- Form -->
            <form method="post" action="{{ route('login.store') }}" id="signUpForm" class="space-y-3">
                @csrf

                <!-- Server Error Message -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-4">
                        <p class="text-red-700 text-sm font-medium">Login Failed</p>
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-xs mt-1">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif



                <!-- Email -->
                <div>
                    <div class="floating-label">
                        <input type="email" id="signUpEmail" name="email" placeholder=""
                            class="w-full px-2 py-2 border border-gray-300 rounded-md bg-white" required>
                        <label for="signUpEmail" class="text-xs">Email Address</label>
                    </div>
                    <div class="text-red-500 text-xs mt-1 min-h-4" id="emailError"></div>
                </div>

                <!-- Password -->
                <div>
                    <div class="floating-label relative">
                        <input type="password" id="signUpPassword" name="password" placeholder=""
                            class="w-full px-2 py-2 pr-8 border border-gray-300 rounded-md bg-white" required>
                        <label for="signUpPassword" class="text-xs">Password</label>
                        <button type="button"
                            class="password-toggle absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="ri-eye-line ri-md"></i>
                        </button>
                    </div>
                    <div class="text-red-500 text-xs mt-1 min-h-4" id="passwordError"></div>
                </div>

                <!-- Remember Me -->
                <div class="flex w-full justify-between  mt-4">
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end  mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>




                <!-- Submit -->
                <button type="submit"
                    class="btn-primary w-full bg-primary text-white py-2 rounded-md text-sm font-medium">
                    Sign in
                </button>

                <!-- Social buttons -->
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <button type="button"
                        class="social-btn flex items-center justify-center px-2 py-2 border border-gray-300 rounded-md hover:bg-gray-50 text-xs">
                        <i class="ri-google-fill text-red-500 ri-md mr-1"></i> Google
                    </button>
                    <button type="button"
                        class="social-btn flex items-center justify-center px-2 py-2 border border-gray-300 rounded-md hover:bg-gray-50 text-xs">
                        <i class="ri-facebook-fill text-blue-600 ri-md mr-1"></i> Facebook
                    </button>
                </div>

                <!-- Switch to sign up -->
                <p class="text-center text-xs text-gray-600 mt-2">
                    Don't have an account? <a href="{{ route('register') }}" id="switchToSignIn"
                        class="text-primary hover:underline font-medium">Sign up here</a>
                </p>
            </form>


        </div>
    </div>

    <script id="form-interactions">
        document.addEventListener('DOMContentLoaded', function () {
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.className = 'ri-eye-off-line ri-md';
                    } else {
                        input.type = 'password';
                        icon.className = 'ri-eye-line ri-md';
                    }
                });
            });

            // Form validation for login
            const email = document.getElementById('signUpEmail');
            const password = document.getElementById('signUpPassword');
            const loginForm = document.getElementById('signUpForm');

            const errors = {
                email: document.getElementById('emailError'),
                password: document.getElementById('passwordError')
            };

            console.log('Login form errors:', errors);

            const fieldMap = {
                email: 'signUpEmail',
                password: 'signUpPassword'
            };

            function validateEmail(emailValue) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(emailValue);
            }

            function showError(field, message) {
                console.log('Showing error for:', field, message);
                if (errors[field]) {
                    errors[field].textContent = message;
                } else {
                    console.error('Error element not found for field:', field);
                }
                const inputElement = document.getElementById(fieldMap[field]);
                if (inputElement) {
                    inputElement.classList.add('border-red-500');
                    inputElement.classList.remove('border-gray-300');
                }
            }

            function clearError(field) {
                if (errors[field]) {
                    errors[field].textContent = '';
                }
                const inputElement = document.getElementById(fieldMap[field]);
                if (inputElement) {
                    inputElement.classList.remove('border-red-500');
                    inputElement.classList.add('border-gray-300');
                }
            }

            email.addEventListener('blur', function () {
                const emailValue = this.value.trim();
                if (!emailValue) {
                    showError('email', 'Email is required');
                } else if (!validateEmail(emailValue)) {
                    showError('email', 'Please enter a valid email address');
                } else {
                    clearError('email');
                }
            });

            password.addEventListener('blur', function () {
                if (!this.value) {
                    showError('password', 'Password is required');
                } else if (this.value.length < 6) {
                    showError('password', 'Password must be at least 6 characters');
                } else {
                    clearError('password');
                }
            });

            loginForm.addEventListener('submit', function (e) {
                let isValid = true;

                const emailValue = email.value.trim();
                if (!emailValue) {
                    showError('email', 'Email is required');
                    isValid = false;
                } else if (!validateEmail(emailValue)) {
                    showError('email', 'Please enter a valid email address');
                    isValid = false;
                } else {
                    clearError('email');
                }

                if (!password.value) {
                    showError('password', 'Password is required');
                    isValid = false;
                } else {
                    clearError('password');
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Handle server-side validation errors
            @if ($errors->any())
                @if ($errors->has('email'))
                    showError('email', '{{ $errors->first('email') }}');
                @endif
                @if ($errors->has('password'))
                    showError('password', '{{ $errors->first('password') }}');
                @endif
                @if ($errors->has('failed'))
                    showError('email', '{{ $errors->first('failed') }}');
                @endif
            @endif
        });
    </script>







</body>

</html>