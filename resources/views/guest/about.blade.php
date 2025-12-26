<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREENIK - Home</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
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
    @include('components.guestheader');



    <section class="pt-24 pb-16 relative overflow-hidden" data-aos="fade-up"
        style="background-image: url('https://readdy.ai/api/search-image?query=modern%20renewable%20energy%20landscape%20with%20solar%20panels%20and%20wind%20turbines%20at%20sunrise%20professional%20photography%20clean%20energy%20facility%20sustainable%20technology%20panoramic%20view%20inspiring%20future%20vision%20left%20side%20darker%20for%20text%20overlay&amp;width=1920&amp;height=600&amp;seq=about-hero&amp;orientation=landscape'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <nav class="text-sm text-gray-400 mb-6">
                    <a href="https://readdy.ai/home/adfae9c0-0eff-4c6a-a12e-e1cb0bf419a4/a5457c79-4d63-4740-9d54-4291bc86fd44"
                        data-readdy="true" class="hover:text-primary">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-white">About</span>
                </nav>
                <h1 class="text-6xl font-bold mb-6 leading-tight">About GREENIK Solutions</h1>
                <p class="text-xl text-gray-300 leading-relaxed">Pioneering the future of clean energy with innovative
                    solutions that power sustainable communities worldwide. Join us in creating a greener tomorrow.</p>
            </div>
        </div>
    </section>


    <!-- leading the clean -->
    <section class="py-20 bg-black" data-aos="fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold mb-6">Leading the Clean Energy Revolution</h2>
                    <p class="text-lg text-gray-300 mb-6 leading-relaxed">For over a decade, GREENIK Solutions has
                        been at the forefront of renewable energy innovation. We specialize in providing comprehensive
                        solar, wind, and energy storage solutions that empower homes and businesses to achieve energy
                        independence.</p>
                    <p class="text-lg text-gray-300 mb-8 leading-relaxed">Our commitment extends beyond just selling
                        products – we're dedicated to creating a sustainable future through cutting-edge technology,
                        exceptional service, and unwavering dedication to environmental stewardship.</p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2 counter-animation" data-target="50000">
                                50,000</div>
                            <div class="text-sm text-gray-400">Homes Powered</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2 counter-animation" data-target="12">12
                            </div>
                            <div class="text-sm text-gray-400">Years Experience</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://readdy.ai/api/search-image?query=modern%20clean%20energy%20company%20office%20building%20with%20solar%20panels%20on%20roof%20professional%20corporate%20photography%20sustainable%20architecture%20glass%20facade%20green%20technology%20headquarters%20inspiring%20design&amp;width=600&amp;height=400&amp;seq=company-building&amp;orientation=landscape"
                        alt="GREENIK Solutions Headquarters" class="w-full h-96 object-cover object-top rounded-xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- our mission -->
    <section class="py-20 bg-[#309983]/10" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Our Mission &amp; Values</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Guided by our core principles, we're committed to
                    making clean energy accessible, affordable, and reliable for everyone.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class=" border border-[#309983]/10 rounded-xl backdrop-blur-lg shadow-[0_0_10px_rgba(48,153,131,0.15)] p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-leaf-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Sustainability</h3>
                    <p class="text-gray-400">Committed to reducing carbon footprints and promoting environmental
                        responsibility through innovative clean energy solutions.</p>
                </div>
                <div
                    class=" border border-[#309983]/10 rounded-xl backdrop-blur-lg shadow-[0_0_10px_rgba(48,153,131,0.15)] p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-lightbulb-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Innovation</h3>
                    <p class="text-gray-400">Continuously advancing technology to deliver cutting-edge renewable energy
                        products that exceed expectations.</p>
                </div>
                <div
                    class=" border border-[#309983]/10 rounded-xl backdrop-blur-lg shadow-[0_0_10px_rgba(48,153,131,0.15)] p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-shield-check-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Reliability</h3>
                    <p class="text-gray-400">Providing dependable energy solutions backed by industry-leading warranties
                        and comprehensive support services.</p>
                </div>
                <div
                    class=" border border-[#309983]/10 rounded-xl backdrop-blur-lg shadow-[0_0_10px_rgba(48,153,131,0.15)] p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-heart-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Customer Focus</h3>
                    <p class="text-gray-400">Delivering exceptional service and personalized solutions that meet the
                        unique needs of every customer.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- journey -->
    <section class="py-20 bg-black" data-aos="fade-right">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Our Journey</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">From humble beginnings to industry leadership,
                    discover the milestones that have shaped our commitment to clean energy.</p>
            </div>
            <div class="relative">
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full timeline-line"></div>
                <div class="space-y-16">
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-[#309983]/10 rounded-xl p-8 achievement-card">
                                <div class="text-primary font-semibold mb-2">2012</div>
                                <h3 class="text-xl font-bold mb-3">Company Founded</h3>
                                <p class="text-gray-400">GREENIK Solutions was established with a vision to make
                                    renewable energy accessible to residential customers across the nation.</p>
                            </div>
                        </div>
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-black">
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8"></div>
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-black">
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-[#309983]/10 rounded-xl p-8 achievement-card">
                                <div class="text-primary font-semibold mb-2">2015</div>
                                <h3 class="text-xl font-bold mb-3">First 1,000 Installations</h3>
                                <p class="text-gray-400">Reached our first major milestone by successfully installing
                                    solar systems for over 1,000 satisfied customers nationwide.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-[#309983]/10 rounded-xl p-8 achievement-card">
                                <div class="text-primary font-semibold mb-2">2018</div>
                                <h3 class="text-xl font-bold mb-3">Wind Energy Expansion</h3>
                                <p class="text-gray-400">Expanded our product portfolio to include residential wind
                                    turbines and comprehensive energy storage solutions.</p>
                            </div>
                        </div>
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-black">
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8"></div>
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-black">
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-[#309983]/10 rounded-xl p-8 achievement-card">
                                <div class="text-primary font-semibold mb-2">2021</div>
                                <h3 class="text-xl font-bold mb-3">EV Charging Solutions</h3>
                                <p class="text-gray-400">Launched our smart EV charging station line, completing our
                                    comprehensive clean energy ecosystem for modern homes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-[#309983]/10 rounded-xl p-8 achievement-card">
                                <div class="text-primary font-semibold mb-2">2024</div>
                                <h3 class="text-xl font-bold mb-3">50,000 Homes Powered</h3>
                                <p class="text-gray-400">Celebrating over 50,000 homes powered by our renewable energy
                                    solutions, preventing millions of tons of CO2 emissions.</p>
                            </div>
                        </div>
                        <div
                            class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-black">
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- team -->
    <section class="py-20 bg-[#309983]/10" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Leadership Team</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Meet the visionary leaders driving innovation and
                    excellence in renewable energy solutions.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-[#309983]/10 border border-[#309983]/10 rounded-xl overflow-hidden team-card">
                    <img src="https://readdy.ai/api/search-image?query=professional%20CEO%20portrait%20middle%20aged%20confident%20business%20leader%20in%20modern%20office%20setting%20clean%20energy%20executive%20corporate%20headshot%20professional%20lighting%20inspiring%20leadership&amp;width=400&amp;height=300&amp;seq=ceo-portrait&amp;orientation=landscape"
                        alt="Sarah Chen - CEO" class="w-full h-64 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Sarah Chen</h3>
                        <div class="text-primary font-medium mb-3">Chief Executive Officer</div>
                        <p class="text-gray-400 text-sm">With over 15 years in renewable energy, Sarah leads our vision
                            of making clean energy accessible worldwide. Former VP at SolarTech Industries.</p>
                    </div>
                </div>
                <div class="bg-[#309983]/10 border border-[#309983]/10 rounded-xl overflow-hidden team-card">
                    <img src="https://readdy.ai/api/search-image?query=professional%20CTO%20portrait%20technology%20executive%20engineer%20in%20modern%20tech%20environment%20renewable%20energy%20expert%20corporate%20headshot%20innovation%20leader%20professional%20photography&amp;width=400&amp;height=300&amp;seq=cto-portrait&amp;orientation=landscape"
                        alt="Michael Rodriguez - CTO" class="w-full h-64 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Michael Rodriguez</h3>
                        <div class="text-primary font-medium mb-3">Chief Technology Officer</div>
                        <p class="text-gray-400 text-sm">Michael drives our product innovation with expertise in solar
                            technology and energy storage systems. PhD in Electrical Engineering from MIT.</p>
                    </div>
                </div>
                <div class="bg-[#309983]/10 border border-[#309983]/10 rounded-xl overflow-hidden team-card">
                    <img src="https://readdy.ai/api/search-image?query=professional%20CFO%20portrait%20finance%20executive%20business%20leader%20in%20corporate%20office%20clean%20energy%20company%20financial%20expert%20corporate%20headshot%20professional%20attire&amp;width=400&amp;height=300&amp;seq=cfo-portrait&amp;orientation=landscape"
                        alt="Emily Johnson - CFO" class="w-full h-64 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Emily Johnson</h3>
                        <div class="text-primary font-medium mb-3">Chief Financial Officer</div>
                        <p class="text-gray-400 text-sm">Emily ensures sustainable growth and financial excellence.
                            Former finance director at GreenTech Ventures with 12 years in clean energy finance.</p>
                    </div>
                </div>
                <div class="bg-[#309983]/10 border border-[#309983]/10 rounded-xl overflow-hidden team-card">
                    <img src="https://readdy.ai/api/search-image?query=professional%20operations%20director%20portrait%20supply%20chain%20executive%20in%20warehouse%20setting%20renewable%20energy%20operations%20leader%20corporate%20headshot%20logistics%20expert&amp;width=400&amp;height=300&amp;seq=coo-portrait&amp;orientation=landscape"
                        alt="David Park - COO" class="w-full h-64 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">David Park</h3>
                        <div class="text-primary font-medium mb-3">Chief Operations Officer</div>
                        <p class="text-gray-400 text-sm">David oversees our nationwide operations and supply chain.
                            Expert in scaling renewable energy businesses with proven track record.</p>
                    </div>
                </div>
                <div class="bg-[#309983]/10 border border-[#309983]/10 rounded-xl overflow-hidden team-card">
                    <img src="https://readdy.ai/api/search-image?query=professional%20marketing%20director%20portrait%20brand%20executive%20in%20creative%20office%20environment%20clean%20energy%20marketing%20leader%20corporate%20headshot%20communications%20expert&amp;width=400&amp;height=300&amp;seq=cmo-portrait&amp;orientation=landscape"
                        alt="Lisa Thompson - CMO" class="w-full h-64 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Lisa Thompson</h3>
                        <div class="text-primary font-medium mb-3">Chief Marketing Officer</div>
                        <p class="text-gray-400 text-sm">Lisa leads our brand strategy and customer engagement
                            initiatives. Former marketing executive at Tesla Energy with expertise in clean tech.</p>
                    </div>
                </div>
                <div class="bg-[#309983]/10 border border-[#309983]/10 rounded-xl overflow-hidden team-card">
                    <img src="https://readdy.ai/api/search-image?query=professional%20engineering%20director%20portrait%20technical%20leader%20in%20research%20lab%20setting%20renewable%20energy%20engineer%20corporate%20headshot%20innovation%20expert%20development&amp;width=400&amp;height=300&amp;seq=ceo-portrait&amp;orientation=landscape"
                        alt="James Wilson - Head of Engineering" class="w-full h-64 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">James Wilson</h3>
                        <div class="text-primary font-medium mb-3">Head of Engineering</div>
                        <p class="text-gray-400 text-sm">James leads our product development and quality assurance
                            teams. 20+ years experience in renewable energy system design and optimization.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- achievements -->
    <section class="py-20 bg-black" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Achievements &amp; Recognition</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Our commitment to excellence has earned recognition
                    from industry leaders and environmental organizations worldwide.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="50000">50,000</div>
                    <div class="text-sm text-gray-400">Homes Powered</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="98">98</div>
                    <div class="text-sm text-gray-400">Customer Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="250000">250,000
                    </div>
                    <div class="text-sm text-gray-400">Tons CO2 Prevented</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="15">15</div>
                    <div class="text-sm text-gray-400">Industry Awards</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class=" border border-[#309983]/30 card-hover rounded-xl p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-yellow-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-award-line text-2xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Clean Energy Excellence Award</h3>
                    <p class="text-gray-400 mb-4">Recognized by the National Renewable Energy Association for
                        outstanding innovation in residential solar solutions.</p>
                    <div class="text-sm text-primary">2023 Winner</div>
                </div>
                <div class="border border-[#309983]/30 card-hover rounded-xl p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-leaf-line text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Environmental Impact Leader</h3>
                    <p class="text-gray-400 mb-4">Certified B-Corporation for meeting rigorous standards of social and
                        environmental performance, accountability, and transparency.</p>
                    <div class="text-sm text-primary">Certified 2022</div>
                </div>
                <div class="border border-[#309983]/30 card-hover rounded-xl p-8 text-center achievement-card">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-customer-service-line text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Customer Service Excellence</h3>
                    <p class="text-gray-400 mb-4">Awarded highest customer satisfaction rating in the renewable energy
                        industry for three consecutive years.</p>
                    <div class="text-sm text-primary">2022-2024</div>
                </div>
            </div>
        </div>
    </section>


    <!-- commitment -->
    <section class="py-20 bg-[#309983]/10" data-aos="fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Our Sustainability Commitment</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">We're not just selling clean energy – we're living
                    it. Our operations are carbon-neutral and powered entirely by renewable sources.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="space-y-8">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-medium">Carbon Footprint Reduction</span>
                                <span class="text-primary font-bold">85%</span>
                            </div>
                            <div class="w-full bg-black rounded-full h-3">
                                <div class="bg-primary h-3 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-medium">Renewable Energy Usage</span>
                                <span class="text-primary font-bold">100%</span>
                            </div>
                            <div class="w-full bg-black rounded-full h-3">
                                <div class="bg-primary h-3 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-medium">Waste Reduction</span>
                                <span class="text-primary font-bold">92%</span>
                            </div>
                            <div class="w-full bg-black rounded-full h-3">
                                <div class="bg-primary h-3 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-lg font-medium">Sustainable Packaging</span>
                                <span class="text-primary font-bold">78%</span>
                            </div>
                            <div class="w-full bg-black rounded-full h-3">
                                <div class="bg-primary h-3 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="https://readdy.ai/api/search-image?query=sustainable%20manufacturing%20facility%20with%20solar%20panels%20and%20wind%20turbines%20green%20factory%20operations%20clean%20energy%20production%20environmental%20responsibility%20modern%20industrial%20complex&amp;width=600&amp;height=400&amp;seq=sustainability&amp;orientation=landscape"
                        alt="Sustainable Operations" class="w-full h-96 object-cover object-top rounded-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- contact info -->
    <section class="py-20 bg-black" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Contact Information</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Ready to start your clean energy journey? Get in
                    touch with our expert team for personalized solutions.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-[#309983]/10 rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-map-pin-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-4">Headquarters</h3>
                    <p class="text-gray-400">1250 Clean Energy Drive<br>San Francisco, CA 94105<br>United States</p>
                </div>
                <div class="bg-[#309983]/10 rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-phone-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-4">Phone</h3>
                    <p class="text-gray-400">Sales: <a href="tel:+18005551234" class="text-primary hover:underline">+1
                            (800) 555-1234</a><br>Support: <a href="tel:+18005555678"
                            class="text-primary hover:underline">+1 (800) 555-5678</a><br>24/7 Emergency Line</p>
                </div>
                <div class="bg-[#309983]/10 rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-mail-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-4">Email</h3>
                    <p class="text-gray-400">General: <a href="mailto:info@GREENIK.com"
                            class="text-primary hover:underline">info@GREENIK.com</a><br>Sales: <a
                            href="mailto:sales@GREENIK.com"
                            class="text-primary hover:underline">sales@GREENIK.com</a><br>Support: <a
                            href="mailto:support@GREENIK.com"
                            class="text-primary hover:underline">support@GREENIK.com</a></p>
                </div>
                <div class="bg-[#309983]/10 rounded-xl p-8 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-time-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-4">Business Hours</h3>
                    <p class="text-gray-400">Monday - Friday<br>8:00 AM - 6:00 PM PST<br>Saturday: 9:00 AM - 4:00
                        PM<br>Sunday: Closed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    @include('components.footer')



       

        <!-- AOS JS -->
        <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1200,
            })
        </script>

</body>

</html>