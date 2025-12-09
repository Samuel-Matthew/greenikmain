<!DOCTYPE html>
<html lang="en" x-data="{
    successOpen: true,
    init(){
        setTimeout(() => {
            window.location.href = '{{ route('login') }}'
        }, 4000)
    }
}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        greenik: {
                            bg: '#020408',
                            card: '#0d131a',
                            border: '#1e293b',
                            input: '#151d29',
                            primary: '#10B981',
                            primaryHover: '#059669',
                            dark: '#050B14'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0d131a;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #10B981;
        }

        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #151d29 inset !important;
            -webkit-text-fill-color: white !important;
        }

        /* Custom Checkbox Style for Dark Mode */
        .custom-checkbox {
            accent-color: #10B981;
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
        }
    </style> -->
</head>

<body class="min-h-screen overflow-hidden">
    <!-- Animated Background -->
    <div class="animated-bg fixed inset-0 z-0"></div>

    <!-- Floating Shapes -->
    <div class="shape-1 floating-shape"></div>
    <div class="shape-2 floating-shape"></div>
    <div class="shape-3 floating-shape"></div>
    <div class="shape-4 floating-shape"></div>
    <div class="shape-5 floating-shape"></div>
    <div class="shape-6 floating-shape"></div>
    <div class="shape-7 floating-shape"></div>

    <!-- Success Modal -->
    <!-- <div x-show="successOpen" x-cloak
        class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/90 backdrop-blur-md">

        <div class="bg-greenik-card border border-greenik-border rounded-2xl p-8 max-w-sm w-full text-center">
            <div
                class="w-16 h-16 bg-greenik-primary/20 rounded-full flex items-center justify-center mx-auto mb-4 text-greenik-primary">
                <i class="fa-solid fa-check text-3xl"></i>
            </div>

            <h2 class="text-2xl font-bold text-white mb-2">Registration successful</h2>
            <p class="text-gray-400 mb-6">You’ll be redirected shortly.</p>

            <button @click="window.location.href='{{ route('login') }}'"
                class="w-full bg-greenik-primary text-greenik-dark font-bold py-3 rounded-lg hover:bg-greenik-primaryHover transition">
                Go to login
            </button>
        </div>
    </div> -->

    <!-- ================= SUCCESS MODAL ================= -->
    <div x-show="successOpen" class="fixed inset-0 z-[60] flex items-center justify-center p-4" x-cloak>
        <div class="backdrop-blur-md bg-black/40 absolute inset-0"></div>

        <div
            class="relative bg-gradient-to-br from-gray-900/95 via-gray-800/90 to-gray-900/95 border border-green-500/30 rounded-3xl p-12 max-w-md w-full text-center shadow-2xl">
            <!-- Success Icon -->
            <div
                class="w-28 h-28 bg-gradient-to-br from-green-400 via-emerald-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg shadow-green-500/50">
                <i class="fa-solid fa-check text-6xl text-white"></i>
            </div>

            <!-- Heading -->
            <h2 class="text-5xl font-bold text-white mb-6 leading-tight">
                Registration Successful!
            </h2>

            <!-- Subtitle -->
            <p class="text-gray-200 mb-10 text-lg leading-relaxed">
                Thank you for going green with Greenik.
            </p>

            <!-- Button -->
            <button @click="window.location.href='{{ route('login') }}'"
                class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg shadow-green-500/50">
                Go to Login
            </button>
        </div>
    </div>

</body>

</html>