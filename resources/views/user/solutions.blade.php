<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREENIK - Solutions</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- @if (Route::is('index'))
        @vite(['resources/js/search-functionality.js', 'resources/js/nav.js'])
    @endif -->
</head>

<body class="bg-black text-white font-sans overflow-x-hidden">
    @include('components.header');


    <!-- Hero Section -->
    <section class="relative pt-20 pb-20 hero-bg" data-aos="fade-up">
        <div class="absolute inset-0 bg-gradient-to-r from-black/100 via-black/80 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="w-full">
                <nav class="text-sm text-gray-200 mb-6">
                    <a href="index.html" class="hover:text-primary">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-white">Solutions</span>
                </nav>
                <div class="max-w-2xl">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Complete
                        Energy Solutions</h1>
                    <p class="text-base sm:text-lg text-gray-200 mb-8 leading-relaxed">From residential solar
                        installations to
                        commercial energy audits, we provide comprehensive sustainable energy solutions tailored to your
                        specific needs and budget.</p>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-primary text-black px-4 py-2 sm:px-8 sm:py-3 !rounded-lg font-semibold hover:bg-green-400 transition-colors whitespace-nowrap">Get
                            Free Consultation</button>
                        <button
                            class="border-2 border-white text-white px-4 py-2 sm:px-8 sm:py-3 !rounded-lg font-semibold hover:bg-white hover:text-black transition-colors whitespace-nowrap">View
                            Case Studies</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Solutions Categories -->
    <section class="py-20 bg-black" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-x-hidden">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Our Solution Categories</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Comprehensive energy solutions designed to meet
                    diverse needs across residential, commercial, and industrial sectors.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="border border-primary p-6 sm:p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="ri-home-4-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-4">Residential Solar Systems</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">Complete home solar solutions including panels,
                        inverters, batteries,
                        and professional installation with 25-year warranties.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Custom system design</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Professional installation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Monitoring &amp; maintenance</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Learn
                        More</button>
                </div>

                <div class="border border-primary p-6 sm:p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="ri-building-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-4">Commercial Installations</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">Large-scale renewable energy systems for
                        businesses, warehouses, and
                        industrial facilities with ROI optimization.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Feasibility analysis</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Financing options</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Performance guarantees</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Learn
                        More</button>
                </div>

                <div class="border border-primary p-6 sm:p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="ri-line-chart-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-4">Energy Consulting</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">Expert energy audits, efficiency assessments, and
                        strategic planning
                        to optimize your energy consumption and costs.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Energy audits</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Efficiency recommendations</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Cost-benefit analysis</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Learn
                        More</button>
                </div>

                <div class="border border-primary p-6 sm:p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="ri-tools-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-4">Maintenance Packages</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">Comprehensive maintenance and support services to
                        ensure optimal
                        performance and longevity of your energy systems.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Regular inspections</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Preventive maintenance</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">24/7 support</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Learn
                        More</button>
                </div>

                <div class="border border-primary p-6 sm:p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="ri-search-2-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-4">Custom Energy Audits</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">Detailed energy assessments using advanced
                        monitoring tools to
                        identify savings opportunities and system optimization potential.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Thermal imaging</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Usage analysis</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Savings projections</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Learn
                        More</button>
                </div>

                <div class="border border-primary p-6 sm:p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i class="ri-battery-charge-line text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-4">Energy Storage Solutions</h3>
                    <p class="text-sm sm:text-base text-gray-400 mb-6">Advanced battery systems and energy storage
                        solutions for backup
                        power, peak shaving, and grid independence.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Battery sizing</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Smart integration</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span class="text-sm">Grid-tie capabilities</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Learn
                        More</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Tiers -->
    <section class="py-20 bg-black" data-aos="fade-right">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-x-hidden">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4">Solution Packages</h2>
                <p class="text-base sm:text-lg text-gray-400 max-w-3xl mx-auto">Choose the perfect solution package that
                    fits your
                    energy needs and budget requirements.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-2xl shadow-[0_0_30px_rgba(48,153,131,0.15)] p-8 pricing-card">
                    <!-- <div class="bg-gray-900 rounded-xl "> -->
                    <div class="text-center mb-8">
                        <h3 class="text-xl md:text-2xl font-bold mb-2">Essential</h3>
                        <p class="text-sm sm:text-base text-gray-400 mb-6">Perfect for small homes and basic energy
                            needs</p>
                        <div class="text-3xl md:text-4xl font-bold text-primary mb-2">₦12,999</div>
                        <p class="text-gray-400">Starting from</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>5kW Solar System</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Basic Installation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>5-Year Warranty</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Energy Monitoring App</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Annual Maintenance</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 !rounded-lg font-medium transition-colors whitespace-nowrap">Get
                        Started</button>
                </div>

                <div
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-2xl shadow-[0_0_30px_rgba(48,153,131,0.15)] p-8 pricing-card">
                    <div
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-primary text-black px-4 py-1 rounded-full text-sm font-medium">
                        Most Popular</div>
                    <div class="text-center mb-8">
                        <h3 class="text-xl md:text-2xl font-bold mb-2">Professional</h3>
                        <p class="text-sm sm:text-base text-gray-400 mb-6">Comprehensive solution for medium to large
                            homes</p>
                        <div class="text-3xl md:text-4xl font-bold text-primary mb-2">₦24,999</div>
                        <p class="text-gray-400">Starting from</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>10kW Solar System</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Premium Installation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>10kWh Battery Storage</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>15-Year Warranty</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Smart Home Integration</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Priority Support</span>
                        </li>
                    </ul>
                    <button
                        class="w-full bg-primary text-black px-6 py-3 !rounded-lg font-medium hover:bg-green-400 transition-colors whitespace-nowrap">Get
                        Started</button>
                </div>

                <div
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-2xl shadow-[0_0_30px_rgba(48,153,131,0.15)] p-8 pricing-card">
                    <div class="text-center mb-8">
                        <h3 class="text-xl md:text-2xl font-bold mb-2">Enterprise</h3>
                        <p class="text-sm sm:text-base text-gray-400 mb-6">Complete commercial and industrial solutions
                        </p>
                        <div class="text-3xl md:text-4xl font-bold text-primary mb-2">Custom</div>
                        <p class="text-gray-400">Quote based</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Custom System Design</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Professional Installation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Scalable Battery Storage</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>25-Year Warranty</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>Dedicated Account Manager</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-check-line text-primary"></i>
                            </div>
                            <span>24/7 Monitoring</span>
                        </li>
                    </ul>
                    <button
                        class="w-full  border border-[#309983]/30 hover:bg-primary hover:text-black px-6 py-3 rounded-lg font-medium transition-colors whitespace-nowrap">Contact
                        Sales</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Case Studies -->
    <section class="py-20 bg-[#309983]/10" data-aos="fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Success Stories</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">Real projects, real results. See how our solutions
                    have transformed energy consumption for our clients.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-black rounded-xl overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=modern%20residential%20house%20with%20solar%20panels%20on%20roof%20beautiful%20suburban%20home%20clean%20energy%20installation%20professional%20architecture%20photography%20bright%20daylight%20blue%20sky%20green%20lawn%20sustainable%20living&amp;width=600&amp;height=300&amp;seq=case001&amp;orientation=landscape"
                        alt="Residential Solar Installation" class="w-full h-48 object-cover object-top">
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm">Residential</span>
                            <span class="text-gray-400 text-sm">Johnson Family Home</span>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">85% Energy Bill Reduction</h3>
                        <p class="text-gray-400 mb-6">Complete 8kW solar system with battery storage reduced the Johnson
                            family's monthly energy bills from ₦320 to ₦48, achieving energy independence and backup
                            power security.</p>
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">8kW</div>
                                <div class="text-sm text-gray-400">System Size</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">85%</div>
                                <div class="text-sm text-gray-400">Bill Reduction</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">6.2</div>
                                <div class="text-sm text-gray-400">Years ROI</div>
                            </div>
                        </div>
                        <blockquote class="border-l-4 border-primary pl-4 italic text-gray-300">"The installation was
                            seamless and the savings exceeded our expectations. We're now producing more energy than we
                            consume!"</blockquote>
                    </div>
                </div>

                <div class="bg-black rounded-xl overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=commercial%20warehouse%20building%20with%20large%20solar%20panel%20array%20on%20roof%20industrial%20renewable%20energy%20installation%20professional%20aerial%20photography%20modern%20business%20facility%20sustainable%20technology&amp;width=600&amp;height=300&amp;seq=case002&amp;orientation=landscape"
                        alt="Commercial Solar Installation" class="w-full h-48 object-cover object-top">
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm">Commercial</span>
                            <span class="text-gray-400 text-sm">TechCorp Manufacturing</span>
                        </div>
                        <h3 class="text-2xl font-semibold mb-4">₦180K Annual Savings</h3>
                        <p class="text-gray-400 mb-6">500kW commercial solar installation with smart energy management
                            system helped TechCorp reduce operational costs and achieve carbon neutrality goals ahead of
                            schedule.</p>
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">500kW</div>
                                <div class="text-sm text-gray-400">System Size</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">₦180K</div>
                                <div class="text-sm text-gray-400">Annual Savings</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">4.1</div>
                                <div class="text-sm text-gray-400">Years ROI</div>
                            </div>
                        </div>
                        <blockquote class="border-l-4 border-primary pl-4 italic text-gray-300">"This investment not
                            only reduced our energy costs but also strengthened our commitment to sustainability and
                            corporate responsibility."</blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Process -->
    <section class="py-20 bg-black" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4">Our Process</h2>
                <p class="text-base sm:text-lg text-gray-400 max-w-3xl mx-auto">From initial consultation to ongoing
                    support, we
                    guide you through every step of your energy transformation journey.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="process-step text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-black font-bold text-xl">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Consultation</h3>
                    <p class="text-gray-400">Free energy assessment and needs analysis to understand your requirements
                        and goals.</p>
                </div>

                <div class="process-step text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-black font-bold text-xl">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Design</h3>
                    <p class="text-gray-400">Custom system design with 3D modeling, energy projections, and financial
                        analysis.</p>
                </div>

                <div class="process-step text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-black font-bold text-xl">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Installation</h3>
                    <p class="text-gray-400">Professional installation by certified technicians with minimal disruption
                        to your routine.</p>
                </div>

                <div class="process-step text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-black font-bold text-xl">4</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Support</h3>
                    <p class="text-gray-400">Ongoing monitoring, maintenance, and support to ensure optimal system
                        performance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Consultation Booking -->
    <section class="py-20 bg-[#309983]/10" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-black rounded-2xl p-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold mb-6">Ready to Start Your Energy Journey?</h2>
                        <p class="text-xl text-gray-400 mb-8">Get a free consultation with our energy experts and
                            discover how much you can save with our sustainable solutions.</p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                    <i class="ri-phone-line text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Phone Consultation</h4>
                                    <p class="text-gray-400 text-sm">Speak directly with our experts</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                    <i class="ri-video-line text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Video Call</h4>
                                    <p class="text-gray-400 text-sm">Virtual site assessment available</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                    <i class="ri-map-pin-line text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold">On-Site Visit</h4>
                                    <p class="text-gray-400 text-sm">Detailed property evaluation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="consultation-form">
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2">First Name</label>
                                    <input type="text" class="w-full px-4 py-3 rounded-lg" placeholder="John">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Last Name</label>
                                    <input type="text" class="w-full px-4 py-3 rounded-lg" placeholder="Smith">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Email Address</label>
                                <input type="email" class="w-full px-4 py-3 rounded-lg"
                                    placeholder="john.smith@email.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Phone Number</label>
                                <input type="tel" class="w-full px-4 py-3 rounded-lg" placeholder="(555) 123-4567">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Project Type</label>
                                <select class="w-full px-4 py-3 rounded-lg">
                                    <option>Residential Solar System</option>
                                    <option>Commercial Installation</option>
                                    <option>Energy Audit</option>
                                    <option>Maintenance Service</option>
                                    <option>Battery Storage</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Budget Range</label>
                                <select class="w-full px-4 py-3 rounded-lg">
                                    <option>Under ₦15,000</option>
                                    <option>₦15,000 - ₦30,000</option>
                                    <option>₦30,000 - ₦50,000</option>
                                    <option>₦50,000 - ₦100,000</option>
                                    <option>Over ₦100,000</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Additional Information</label>
                                <textarea rows="4" class="w-full px-4 py-3 rounded-lg"
                                    placeholder="Tell us about your energy goals and any specific requirements..."></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-primary text-black px-6 py-4 !rounded-lg font-semibold hover:bg-green-400 transition-colors whitespace-nowrap">Schedule
                                Free Consultation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-black" data-aos="fade-right">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-xl text-gray-400">Get answers to common questions about our solutions and services.</p>
            </div>

            <div class="space-y-4">

                <details
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-lg shadow-[0_0_30px_rgba(48,153,131,0.15)] my-4 group">
                    <summary
                        class="p-4 flex justify-between cursor-pointer marker:hidden [&::-webkit-details-marker]:hidden">
                        <p>How long does a typical solar installation take?</p>
                        <span class="transition-transform duration-300 group-open:rotate-45"><i
                                class="ri-add-line text-[#99e39e] rotate-45"></i></span>

                    </summary>
                    <p class="text-gray-500 px-4 pb-4 text-left">Most residential installations are completed within 1-3
                        days, depending
                        on system size and complexity. Commercial projects typically take 1-4 weeks. The timeline
                        includes permitting, installation, and grid connection.</p>
                </details>

                <details
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-lg shadow-[0_0_30px_rgba(48,153,131,0.15)] my-4 group">
                    <summary
                        class="p-4 flex justify-between cursor-pointer marker:hidden [&::-webkit-details-marker]:hidden">
                        <p>What warranties do you provide?</p>
                        <span class="transition-transform duration-300 group-open:rotate-45"><i
                                class="ri-add-line text-[#99e39e] rotate-45"></i></span>

                    </summary>
                    <p class="text-gray-500 px-4 pb-4 text-left">We provide comprehensive warranties including 25-year
                        panel performance
                        warranty, 10-15 year inverter warranty, and 5-10 year installation workmanship warranty.
                        Battery systems come with 10-15 year warranties.</p>
                </details>

                <details
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-lg shadow-[0_0_30px_rgba(48,153,131,0.15)] my-4 group">
                    <summary
                        class="p-4 flex justify-between cursor-pointer marker:hidden [&::-webkit-details-marker]:hidden">
                        <p>Do you offer financing options?</p>
                        <span class="transition-transform duration-300 group-open:rotate-45"><i
                                class="ri-add-line text-[#99e39e] rotate-45"></i></span>

                    </summary>
                    <p class="text-gray-500 px-4 pb-4 text-left">Yes, we offer various financing options including solar
                        loans, leasing
                        programs, and power purchase agreements (PPAs). We also help with federal and state tax
                        incentive applications to maximize your savings.</p>
                </details>


                <details
                    class="bg-[#309983]/10 border border-[#309983]/30 backdrop-blur-md rounded-lg shadow-[0_0_30px_rgba(48,153,131,0.15)] my-4 group">
                    <summary
                        class="p-4 flex justify-between cursor-pointer marker:hidden [&::-webkit-details-marker]:hidden">
                        <p>How much can I save with solar energy?</p>
                        <span class="transition-transform duration-300 group-open:rotate-45"><i
                                class="ri-add-line text-[#99e39e] rotate-45"></i></span>

                    </summary>
                    <p class="text-gray-500 px-4 pb-4 text-left">Savings vary based on location, energy usage, and
                        system size. Most
                        customers see 70-90% reduction in electricity bills. With current incentives, typical
                        payback period is 4-8 years with 25+ years of free electricity thereafter.</p>
                </details>


                <details
                    class="bg-[#309983]/10 h-fit border border-[#309983]/30 backdrop-blur-md rounded-lg shadow-[0_0_30px_rgba(48,153,131,0.15)] my-4 group">
                    <summary
                        class="p-4 flex justify-between cursor-pointer marker:hidden [&::-webkit-details-marker]:hidden">
                        <p>What maintenance is required?</p>
                        <span class="transition-transform duration-300 group-open:rotate-45"><i
                                class="ri-add-line text-[#99e39e] rotate-45"></i></span>

                    </summary>
                    <p class="text-gray-500 px-4 pb-4 text-left">Solar systems require minimal maintenance. We recommend
                        annual
                        inspections, occasional cleaning, and monitoring system performance. Our maintenance
                        packages include all necessary services to ensure optimal performance.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')






    <script id="consultation-form">
        document.addEventListener('DOMContentLoaded', function () {
            const consultationForm = document.querySelector('.consultation-form form');
            consultationForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                submitButton.textContent = 'Scheduling...';
                submitButton.disabled = true;

                setTimeout(() => {
                    submitButton.textContent = 'Consultation Scheduled!';
                    submitButton.classList.add('bg-green-600');
                    setTimeout(() => {
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                        submitButton.classList.remove('bg-green-600');
                        this.reset();
                    }, 3000);
                }, 2000);
            });
        });
    </script>


    <!-- <script src="js/search-functionality.js"></script>
    <script src="js/nav.js"></script> -->

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
        })
    </script>

</body>

</html>