<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREENIK - Login</title>
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
            <form method="post" action="{{ route('login.store') }}" id="signUpForm" class="space-y-3">
                @csrf

                

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





  



</body>

</html>