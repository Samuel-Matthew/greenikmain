<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREENIK - Home</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-black text-white font-sans overflow-x-hidden">
    @include('components.header');

    <!-- hero -->
    <section class="relative min-h-screen hero-bg flex items-center" data-aos="fade-up">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative z-10 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center min-h-screen">
                    <div class="w-full lg:w-1/2 py-20">
                        <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6">
                            Power Your World with
                            <span class="text-primary">Clean Energy</span>
                        </h1>
                        <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                            Affordable solar, wind, and green accessories for every home.
                            Join the sustainable energy revolution today.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="products.html"
                                class="bg-primary block text-center text-black px-8 py-4 rounded-lg font-semibold hover:bg-green-400 transition-colors whitespace-nowrap">
                                Shop Now
                            </a>
                            <button
                                class="border-2 border-primary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-primary hover:text-black transition-colors whitespace-nowrap">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- why choose -->
    <section class="py-20 bg-black" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Why Choose Green Energy?</h2>
                <p class="text-gray-400 text-lg">Discover the benefits of sustainable power solutions</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class=" border border-primary p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-leaf-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Clean Energy</h3>
                    <p class="text-gray-400">100% renewable energy sources with zero emissions for a cleaner planet</p>
                </div>
                <div class=" border border-primary p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-money-dollar-circle-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Save Money</h3>
                    <p class="text-gray-400">Reduce electricity bills by up to 90% with our efficient energy systems</p>
                </div>
                <div class=" border border-primary p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-flashlight-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Reliable Power</h3>
                    <p class="text-gray-400">Consistent energy supply with advanced battery backup systems</p>
                </div>
                <div class=" border border-primary p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-earth-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Eco-Friendly Future</h3>
                    <p class="text-gray-400">Contribute to environmental protection and sustainable development</p>
                </div>
            </div>
        </div>
    </section>

    <!-- what we do -->
    <section class="py-20 bg-black" data-aos="fade-right">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">What We Do</h2>
                <p class="text-gray-400 text-lg">Comprehensive clean energy solutions for your home</p>
            </div>
            <div class="space-y-8">
                <div
                    class="border border-primary rounded-xl p-8 flex flex-col lg:flex-row items-center gap-8 card-hover" data-aos="fade-right">
                    <div class="lg:w-1/3">
                        <img src="https://readdy.ai/api/search-image?query=modern%20solar%20panel%20installation%20on%20residential%20rooftop%20with%20blue%20sky%20background%20professional%20photography%20clean%20minimalist%20composition%20bright%20natural%20lighting%20eco%20friendly%20sustainable%20technology%20high%20quality%20realistic%20render&amp;width=400&amp;height=300&amp;seq=solar001&amp;orientation=landscape"
                            alt="Solar Solutions" class="w-full h-64 object-cover object-top rounded-lg">
                    </div>
                    <div class="lg:w-2/3">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">Solar Solutions</h3>
                        <p class="text-gray-300 mb-6">Complete solar panel systems designed for maximum efficiency and
                            long-term savings. Our premium solar kits include high-performance panels, inverters, and
                            monitoring systems.</p>
                        <button
                            class="text-primary hover:text-green-400 font-semibold flex items-center gap-2 whitespace-nowrap">
                            Learn More <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
                <div
                    class="border border-primary rounded-xl p-8 flex flex-col lg:flex-row-reverse items-center gap-8 card-hover" data-aos="fade-left">
                    <div class="lg:w-1/3">
                        <img src="https://readdy.ai/api/search-image?query=modern%20wind%20turbine%20generator%20in%20green%20field%20with%20clear%20blue%20sky%20professional%20photography%20clean%20minimalist%20composition%20bright%20natural%20lighting%20renewable%20energy%20technology%20high%20quality%20realistic%20render&amp;width=400&amp;height=300&amp;seq=wind001&amp;orientation=landscape"
                            alt="Wind Power" class="w-full h-64 object-cover object-top rounded-lg">
                    </div>
                    <div class="lg:w-2/3">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">Wind Power</h3>
                        <p class="text-gray-300 mb-6">Harness the power of wind with our advanced turbine systems.
                            Perfect
                            for areas with consistent wind patterns, delivering clean energy day and night.</p>
                        <button
                            class="text-primary hover:text-green-400 font-semibold flex items-center gap-2 whitespace-nowrap">
                            Learn More <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
                <div
                    class="border border-primary rounded-xl p-8 flex flex-col lg:flex-row items-center gap-8 card-hover"data-aos="fade-right">
                    <div class="lg:w-1/3">
                        <img src="https://readdy.ai/api/search-image?query=electric%20vehicle%20charging%20station%20and%20green%20energy%20accessories%20modern%20design%20professional%20photography%20clean%20minimalist%20composition%20bright%20lighting%20eco%20friendly%20sustainable%20technology%20high%20quality%20realistic%20render&amp;width=400&amp;height=300&amp;seq=accessories001&amp;orientation=landscape"
                            alt="Green Accessories" class="w-full h-64 object-cover object-top rounded-lg">
                    </div>
                    <div class="lg:w-2/3">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">Green Accessories</h3>
                        <p class="text-gray-300 mb-6">Essential accessories to complement your clean energy setup. From
                            EV
                            chargers to smart monitoring systems, we have everything you need.</p>
                        <button
                            class="text-primary hover:text-green-400 font-semibold flex items-center gap-2 whitespace-nowrap">
                            Learn More <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
                <div
                    class="border border-primary rounded-xl p-8 flex flex-col lg:flex-row-reverse items-center gap-8 card-hover" data-aos="fade-left">
                    <div class="lg:w-1/3">
                        <img src="https://readdy.ai/api/search-image?query=home%20battery%20backup%20system%20installation%20modern%20residential%20setting%20professional%20photography%20clean%20minimalist%20composition%20bright%20lighting%20energy%20storage%20technology%20high%20quality%20realistic%20render&amp;width=400&amp;height=300&amp;seq=backup001&amp;orientation=landscape"
                            alt="Home Backup Kits" class="w-full h-64 object-cover object-top rounded-lg">
                    </div>
                    <div class="lg:w-2/3">
                        <h3 class="text-2xl font-semibold mb-4 text-primary">Home Backup Kits</h3>
                        <p class="text-gray-300 mb-6">Never worry about power outages again. Our backup systems provide
                            reliable emergency power and seamless integration with your existing setup.</p>
                        <button
                            class="text-primary hover:text-green-400 font-semibold flex items-center gap-2 whitespace-nowrap">
                            Learn More <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- how we help go green -->
    <section class="py-20 bg-[#111111]" data-aos="fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">How We Help You Go Green</h2>
                <p class="text-gray-400 text-lg">Empowering You with Clean Energy</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl font-bold text-black">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Choose a Product</h3>
                    <p class="text-gray-400">Browse our extensive catalog of solar panels, wind turbines, batteries, and
                        accessories. Our experts help you find the perfect solution for your energy needs.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl font-bold text-black">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">We Deliver &amp; Install</h3>
                    <p class="text-gray-400">Our certified technicians handle everything from delivery to professional
                        installation. We ensure your system is optimized for maximum performance and safety.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl font-bold text-black">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">You Enjoy Clean Power</h3>
                    <p class="text-gray-400">Start saving money immediately while contributing to a sustainable future.
                        Monitor your energy production and enjoy reliable, clean power for years to come.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- product categories -->
    <section class="py-20 bg-black" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Product Categories</h2>
                <p class="text-gray-400 text-lg">Explore our complete range of clean energy solutions</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <a href="{{ route('user.product', ['category' => 'solar']) }}"
                    class="rounded-xl p-6 text-center card-hover transition-colors">
                    <img src="https://readdy.ai/api/search-image?query=premium%20solar%20panel%20kit%20with%20inverter%20and%20mounting%20hardware%20professional%20product%20photography%20clean%20white%20background%20modern%20design%20high%20quality%20realistic%20render%20eco%20friendly%20technology&amp;width=300&amp;height=200&amp;seq=solarkit001&amp;orientation=landscape"
                        alt="Solar Kits" class="w-full h-40 object-cover object-top rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">Solar Kits</h3>
                    <p class="text-gray-400 text-sm">Complete solar solutions</p>
                </a>
                <a href="{{ route('user.product', ['category' => 'wind']) }}"
                    class="rounded-xl p-6 text-center card-hover transition-colors">
                    <img src="https://readdy.ai/api/search-image?query=residential%20wind%20turbine%20generator%20modern%20design%20professional%20product%20photography%20clean%20white%20background%20renewable%20energy%20equipment%20high%20quality%20realistic%20render&amp;width=300&amp;height=200&amp;seq=turbine001&amp;orientation=landscape"
                        alt="Wind Turbines" class="w-full h-40 object-cover object-top rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">Wind Turbines</h3>
                    <p class="text-gray-400 text-sm">Harness wind power</p>
                </a>
                <a href="{{ route('user.product', ['category' => 'ev']) }}"
                    class="rounded-xl p-6 text-center card-hover transition-colors">
                    <img src="https://readdy.ai/api/search-image?query=electric%20vehicle%20charging%20station%20wall%20mounted%20modern%20design%20professional%20product%20photography%20clean%20white%20background%20EV%20charger%20high%20quality%20realistic%20render&amp;width=300&amp;height=200&amp;seq=evcharger001&amp;orientation=landscape"
                        alt="EV Chargers" class="w-full h-40 object-cover object-top rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">EV Chargers</h3>
                    <p class="text-gray-400 text-sm">Charge your vehicle</p>
                </a>
                <a href="{{ route('user.product', ['category' => 'batteries']) }}"
                    class="rounded-xl p-6 text-center card-hover transition-colors">
                    <img src="https://readdy.ai/api/search-image?query=home%20battery%20storage%20system%20lithium%20ion%20modern%20design%20professional%20product%20photography%20clean%20white%20background%20energy%20storage%20solution%20high%20quality%20realistic%20render&amp;width=300&amp;height=200&amp;seq=battery001&amp;orientation=landscape"
                        alt="Batteries" class="w-full h-40 object-cover object-top rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">Batteries</h3>
                    <p class="text-gray-400 text-sm">Energy storage solutions</p>
                </a>
                <a href="{{ route('user.product', ['category' => 'accessories']) }}"
                    class="rounded-xl p-6 text-center card-hover transition-colors">
                    <img src="https://readdy.ai/api/search-image?query=renewable%20energy%20accessories%20inverters%20cables%20monitoring%20devices%20professional%20product%20photography%20clean%20white%20background%20modern%20design%20high%20quality%20realistic%20render&amp;width=300&amp;height=200&amp;seq=accessories002&amp;orientation=landscape"
                        alt="Accessories" class="w-full h-40 object-cover object-top rounded-lg mb-4">
                    <h3 class="text-lg font-semibold mb-2">Accessories</h3>
                    <p class="text-gray-400 text-sm">Essential components</p>
                </a>
            </div>
        </div>
    </section>

    <!-- footer -->
    @include('components.footer');






<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
    })


</script>



</body>

</html>