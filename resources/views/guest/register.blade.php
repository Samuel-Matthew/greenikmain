<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREENIK - Register</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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
            <form method="post" action="{{ route('register.store') }}" id="signUpForm" class="space-y-3">
                @csrf

                <!-- Name -->
                <div class="grid grid-cols-2 gap-2">
                    <div class="floating-label">
                        <input type="text" id="firstName" name="first_name" placeholder=" "
                            class="w-full px-2 py-2 border border-gray-300 rounded-md bg-white" required>
                        <label for="firstName" class="text-xs">First Name</label>
                    </div>
                    <div class="floating-label">
                        <input type="text" id="lastName" name="last_name" placeholder=" "
                            class="w-full px-2 py-2 border border-gray-300 rounded-md bg-white" required>
                        <label for="lastName" class="text-xs">Last Name</label>
                    </div>
                </div>

                <!-- Email -->
                <div class="floating-label">
                    <input type="email" id="signUpEmail" name="email" placeholder=""
                        class="w-full px-2 py-2 border border-gray-300 rounded-md bg-white" required>
                    <label for="signUpEmail" class="text-xs">Email Address</label>
                </div>

                <!-- Password -->
                <div class="floating-label relative">
                    <input type="password" id="signUpPassword" name="password" placeholder=""
                        class="w-full px-2 py-2 pr-8 border border-gray-300 rounded-md bg-white" required>
                    <label for="signUpPassword" class="text-xs">Password</label>
                    <button type="button"
                        class="password-toggle absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="ri-eye-line ri-md"></i>
                    </button>
                </div>

                <!-- Confirm Password -->
                <div class="floating-label relative">
                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder=""
                        class="w-full px-2 py-2 pr-8 border border-gray-300 rounded-md bg-white" required>
                    <label for="confirmPassword" class="text-xs">Confirm Password</label>
                    <button type="button"
                        class="password-toggle absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="ri-eye-line ri-md"></i>
                    </button>
                </div>

                <!-- Terms -->
                <div class="flex items-start space-x-2 text-xs text-gray-600">
                    <input type="checkbox" class="hidden" id="agreeTerms" required>
                    <div
                        class="custom-checkbox w-4 h-4 border-2 border-gray-300 rounded flex items-center justify-center mt-1 shrink-0">
                        <i class="ri-check-line text-white text-[10px] opacity-0"></i>
                    </div>
                    <span>
                        I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a
                            href="#" class="text-primary hover:underline">Privacy Policy</a>
                    </span>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="btn-primary w-full bg-primary text-white py-2 rounded-md text-sm font-medium">
                    Create Account
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

                <!-- Switch to sign in -->
                <p class="text-center text-xs text-gray-600 mt-2">
                    Already have an account? <a href="{{ route('login') }}" id="switchToSignIn"
                        class="text-primary hover:underline font-medium">Sign in here</a>
                </p>
            </form>
        </div>
    </div>





    

    <script id="form-interactions">
        document.addEventListener('DOMContentLoaded', function () {
            const customCheckboxes = document.querySelectorAll('.custom-checkbox');
            customCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function () {
                    const input = this.parentElement.querySelector('input[type="checkbox"]');
                    const icon = this.querySelector('i');

                    input.checked = !input.checked;

                    if (input.checked) {
                        this.classList.add('bg-primary', 'border-primary');
                        this.classList.remove('border-gray-300');
                        icon.classList.remove('opacity-0');
                        icon.classList.add('opacity-100');
                    } else {
                        this.classList.remove('bg-primary', 'border-primary');
                        this.classList.add('border-gray-300');
                        icon.classList.add('opacity-0');
                        icon.classList.remove('opacity-100');
                    }
                });
            });

            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.className = 'ri-eye-off-line ri-lg';
                    } else {
                        input.type = 'password';
                        icon.className = 'ri-eye-line ri-lg';
                    }
                });
            });

            const buttons = document.querySelectorAll('.btn-primary');
            buttons.forEach(button => {
                button.addEventListener('click', function (e) {
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>

    <!-- <script id="form-validation">
        document.addEventListener('DOMContentLoaded', function () {
            const signUpForm = document.getElementById('signUpForm');
            const emailInput = document.getElementById('signUpEmail');
            const passwordInput = document.getElementById('signUpPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');

            function showLoading(button) {
                const text = button.querySelector('.button-text');
                const spinner = button.querySelector('.loading-spinner');
                text.style.opacity = '0';
                spinner.classList.remove('hidden');
                button.disabled = true;
            }

            function hideLoading(button) {
                const text = button.querySelector('.button-text');
                const spinner = button.querySelector('.loading-spinner');
                text.style.opacity = '1';
                spinner.classList.add('hidden');
                button.disabled = false;
            }

            function showMessage(message, type = 'success') {
                const messageDiv = document.createElement('div');
                messageDiv.className = `${type}-message fixed top-6 right-6 px-6 py-4 rounded-lg text-white z-50 shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
                messageDiv.innerHTML = `
<div class="flex items-center space-x-2">
<div class="w-5 h-5 flex items-center justify-center">
<i class="ri-${type === 'success' ? 'check' : 'error-warning'}-line"></i>
</div>
<span>${message}</span>
</div>
`;
                document.body.appendChild(messageDiv);

                setTimeout(() => {
                    messageDiv.classList.add('show');
                }, 100);

                setTimeout(() => {
                    messageDiv.classList.remove('show');
                    setTimeout(() => {
                        messageDiv.remove();
                    }, 300);
                }, 4000);
            }

            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function validatePassword(password) {
                return password.length >= 8;
            }

            confirmPasswordInput.addEventListener('blur', function () {
                const password = passwordInput.value;
                const confirmPassword = this.value;

                if (confirmPassword && password !== confirmPassword) {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-300');
                }
            });

            signUpForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const firstName = document.getElementById('firstName').value.trim();
                const lastName = document.getElementById('lastName').value.trim();
                const email = emailInput.value.trim();
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const agreeTerms = document.getElementById('agreeTerms').checked;

                if (!firstName || !lastName) {
                    showMessage('Please fill in your full name', 'error');
                    return;
                }

                if (!validateEmail(email)) {
                    showMessage('Please enter a valid email address', 'error');
                    return;
                }

                if (!validatePassword(password)) {
                    showMessage('Password must be at least 8 characters long', 'error');
                    return;
                }

                if (password !== confirmPassword) {
                    showMessage('Passwords do not match', 'error');
                    return;
                }

                if (!agreeTerms) {
                    showMessage('Please agree to the Terms of Service and Privacy Policy', 'error');
                    return;
                }

                const submitButton = this.querySelector('button[type="submit"]');
                showLoading(submitButton);

                setTimeout(() => {
                 e.target.closest("form").submit();
                    hideLoading(submitButton);
                    showMessage('Welcome to GreenLink! Your account has been created successfully.');
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 2000);
                }, 2500);
            });
        });
    </script> -->

    <!-- <script id="navigation">
        document.addEventListener('DOMContentLoaded', function () {
            const signInBtn = document.getElementById('signInBtn');
            const switchToSignIn = document.getElementById('switchToSignIn');

            signInBtn.addEventListener('click', function () {
                window.location.href = '/signin';
            });

            switchToSignIn.addEventListener('click', function (e) {
                // e.preventDefault();
                window.location.href = '/signin';
            });
        });
    </script> -->



</body>

</html>