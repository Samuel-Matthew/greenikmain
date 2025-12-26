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


    <section class="pt-24 pb-16 hero-bg relative overflow-hidden" data-aos="fade-up"
        style="background-image: url('https://readdy.ai/api/search-image?query=modern%20customer%20service%20center%20with%20renewable%20energy%20theme%20professional%20office%20environment%20clean%20technology%20communication%20hub%20solar%20panels%20visible%20in%20background%20corporate%20headquarters%20welcoming%20atmosphere&amp;width=1920&amp;height=600&amp;seq=contact-hero&amp;orientation=landscape'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <nav class="text-sm text-gray-400 mb-6">
                    <a href="https://readdy.ai/home/adfae9c0-0eff-4c6a-a12e-e1cb0bf419a4/3e63fb8a-ba5b-47d9-9e25-440b397f68af"
                        data-readdy="true" class="hover:text-primary">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-white">Contact</span>
                </nav>
                <h1 class="text-6xl font-bold mb-6 leading-tight">Contact GREENIK Solutions</h1>
                <p class="text-xl text-gray-300 leading-relaxed">Ready to start your clean energy journey? Our expert
                    team is here to help you find the perfect renewable energy solution for your home or business.</p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-black" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Get In Touch</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Choose your preferred way to connect with us. We're
                    available through multiple channels to provide you with the best support possible.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class=" border border-[#309983]/30 rounded-xl p-8 text-center contact-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-phone-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Call Us</h3>
                    <p class="text-gray-400 mb-6">Speak directly with our energy consultants for immediate assistance
                        and personalized recommendations.</p>
                    <button
                        class="w-full bg-primary text-black font-medium py-3 px-6 rounded-lg !rounded-lg whitespace-nowrap hover:bg-primary/90 transition-colors">Call
                        Now</button>
                </div>
                <div class=" border border-[#309983]/30 rounded-xl p-8 text-center contact-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-mail-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Email Support</h3>
                    <p class="text-gray-400 mb-6">Send us detailed questions and receive comprehensive responses from
                        our technical experts.</p>
                    <button
                        class="w-full bg-primary text-black font-medium py-3 px-6 rounded-lg whitespace-nowrap hover:bg-primary/90 transition-colors">Send
                        Email</button>
                </div>
                <div class=" border border-[#309983]/30 rounded-xl p-8 text-center contact-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-chat-3-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Live Chat</h3>
                    <p class="text-gray-400 mb-6">Get instant answers to your questions through our live chat support
                        available during business hours.</p>
                    <button
                        class="w-full bg-primary text-black font-medium py-3 px-6 !rounded-lg whitespace-nowrap hover:bg-primary/90 transition-colors"
                        onclick="toggleChat()">Start Chat</button>
                </div>
                <div class=" border border-[#309983]/30 rounded-xl p-8 text-center contact-card">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-map-pin-line text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Visit Office</h3>
                    <p class="text-gray-400 mb-6">Schedule an in-person consultation at one of our locations for
                        detailed project planning.</p>
                    <button
                        class="w-full bg-primary text-black font-medium py-3 px-6 !rounded-lg whitespace-nowrap hover:bg-primary/90 transition-colors">Find
                        Location</button>
                </div>
            </div>
        </div>
    </section>

    <!-- send a message -->
    <section class="py-20 bg-[#309983]/10" data-aos="fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-4xl font-bold mb-8">Send Us A Message</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Full Name *</label>
                                <input type="text" required=""
                                    class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary form-input"
                                    placeholder="Enter your full name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Email Address *</label>
                                <input type="email" required=""
                                    class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary form-input"
                                    placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Phone Number</label>
                                <input type="tel"
                                    class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary form-input"
                                    placeholder="Enter your phone number">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Service Interest</label>
                                <div class="relative">
                                    <button type="button"
                                        class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-left text-white focus:outline-none focus:border-primary form-input flex items-center justify-between"
                                        onclick="toggleDropdown()">
                                        <span id="selected-service">Select a service</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </button>
                                    <div id="service-dropdown"
                                        class="absolute top-full left-0 right-0 bg-[#309983]/10 border border-[#309983]/10 rounded-lg mt-1 hidden z-10">
                                        <div class="py-1">
                                            <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer"
                                                onclick="selectService('Solar Installation')">Solar Installation</div>
                                            <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer"
                                                onclick="selectService('Wind Turbines')">Wind Turbines</div>
                                            <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer"
                                                onclick="selectService('Battery Systems')">Battery Systems</div>
                                            <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer"
                                                onclick="selectService('EV Chargers')">EV Chargers</div>
                                            <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer"
                                                onclick="selectService('Consultation')">Consultation</div>
                                            <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer"
                                                onclick="selectService('Other')">Other</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Subject</label>
                            <input type="text"
                                class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary form-input"
                                placeholder="Enter message subject">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Message *</label>
                            <textarea required="" rows="5"
                                class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary form-input resize-none"
                                placeholder="Tell us about your project or questions..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Attach Files (Optional)</label>
                            <div class="border-2 border-dashed border-gray-700 rounded-lg p-6 text-center hover:border-primary transition-colors cursor-pointer"
                                onclick="document.getElementById('file-input').click()">
                                <i class="ri-upload-cloud-line text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-400">Click to upload files or drag and drop</p>
                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG up to 10MB</p>
                                <input type="file" id="file-input" class="hidden" multiple=""
                                    accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="privacy-consent"
                                class="mt-1 w-4 h-4 text-primary bg-gray-800 border-gray-700 rounded focus:ring-primary">
                            <label for="privacy-consent" class="text-sm text-gray-400">I agree to the <a href="#"
                                    class="text-primary hover:underline">Privacy Policy</a> and consent to being
                                contacted about GREENIK solutions.</label>
                        </div>
                        <button type="submit"
                            class="w-full bg-primary text-black font-semibold py-4 px-8 rounded-lg !rounded-lg whitespace-nowrap hover:bg-primary/90 transition-colors">Send
                            Message</button>
                    </form>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-8">Customer Service Hours</h3>
                    <div class="border border-[#309983]/30 card-hover rounded-xl p-8 mb-8">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-gray-700">
                                <span class="font-medium">Sales Department</span>
                                <span class="text-gray-400">Mon-Fri: 8AM-8PM PST</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-700">
                                <span class="font-medium">Technical Support</span>
                                <span class="text-gray-400">Mon-Fri: 7AM-7PM PST</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-gray-700">
                                <span class="font-medium">Customer Service</span>
                                <span class="text-gray-400">Mon-Sat: 8AM-6PM PST</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="font-medium">Emergency Support</span>
                                <span class="text-primary">24/7 Available</span>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#309983]/30 card-hover rounded-xl p-8">
                        <h4 class="text-xl font-semibold mb-6">Response Time Commitment</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Live Chat</span>
                                <span class="text-primary font-medium">&lt; 2 minutes</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Phone Calls</span>
                                <span class="text-primary font-medium">&lt; 30 seconds</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Email Support</span>
                                <span class="text-primary font-medium">&lt; 4 hours</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">Project Quotes</span>
                                <span class="text-primary font-medium">&lt; 24 hours</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-black" data-aos="fade-right">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Office Locations</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Visit us at one of our convenient locations for
                    in-person consultations and support services.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div class="relative bg-gray-900 rounded-xl overflow-hidden"
                    style="background-image: url('https://public.readdy.ai/gen_page/map_placeholder_1280x720.png'); background-size: cover; background-position: center; height: 400px;">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 map-marker">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <i class="ri-map-pin-fill text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="absolute top-1/3 right-1/4 transform -translate-x-1/2 -translate-y-1/2 map-marker"
                        style="animation-delay: 0.5s;">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <i class="ri-map-pin-fill text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="absolute bottom-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 map-marker"
                        style="animation-delay: 1s;">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <i class="ri-map-pin-fill text-white text-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="border border-[#309983]/30 card-hover rounded-xl p-6 contact-card">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <i class="ri-building-line text-primary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold mb-2">San Francisco Headquarters</h4>
                                <p class="text-gray-400 mb-3">1250 Clean Energy Drive, San Francisco, CA 94105</p>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Phone:</span>
                                        <p class="text-primary">(415) 555-0123</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Hours:</span>
                                        <p class="text-white">Mon-Fri: 8AM-6PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#309983]/30 card-hover rounded-xl p-6 contact-card">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <i class="ri-building-line text-primary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold mb-2">Los Angeles Office</h4>
                                <p class="text-gray-400 mb-3">8900 Sunset Boulevard, West Hollywood, CA 90069</p>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Phone:</span>
                                        <p class="text-primary">(323) 555-0156</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Hours:</span>
                                        <p class="text-white">Mon-Fri: 9AM-5PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#309983]/30 card-hover rounded-xl p-6 contact-card">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <i class="ri-building-line text-primary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold mb-2">Seattle Branch</h4>
                                <p class="text-gray-400 mb-3">2100 4th Avenue, Seattle, WA 98121</p>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Phone:</span>
                                        <p class="text-primary">(206) 555-0189</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Hours:</span>
                                        <p class="text-white">Mon-Fri: 8AM-5PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Book An Appointment</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Schedule a consultation with our renewable energy
                    experts to discuss your project requirements and get personalized recommendations.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <div class="bg-[#309983]/10 border border-[#309983]/10 card-hover rounded-xl p-8">
                        <h3 class="text-2xl font-semibold mb-6">Select Appointment Type</h3>
                        <div class="space-y-4 mb-8">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="appointment-type" value="consultation"
                                    class="w-4 h-4 text-primary bg-gray-700 border-gray-600 focus:ring-primary">
                                <span>Free Home Energy Consultation</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="appointment-type" value="site-survey"
                                    class="w-4 h-4 text-primary bg-gray-700 border-gray-600 focus:ring-primary">
                                <span>Site Survey &amp; Assessment</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="appointment-type" value="installation"
                                    class="w-4 h-4 text-primary bg-gray-700 border-gray-600 focus:ring-primary">
                                <span>Installation Planning Meeting</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="appointment-type" value="maintenance"
                                    class="w-4 h-4 text-primary bg-gray-700 border-gray-600 focus:ring-primary">
                                <span>Maintenance &amp; Support Visit</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Preferred Date</label>
                                <input type="date"
                                    class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Location</label>
                                <div class="relative">

                                    <!-- work on this later -->
                                    <button type="button"
                                        class="w-full bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-left text-white focus:outline-none focus:border-primary flex items-center justify-between">
                                        <span>Select Location</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Your Name"
                                class="bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary">
                            <input type="email" placeholder="Email Address"
                                class="bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-primary">
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold mb-6">Available Time Slots</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-[#309983]/10 rounded-xl p-4 text-center appointment-slot cursor-pointer"
                            onclick="selectTimeSlot(this)">
                            <div class="text-lg font-semibold mb-1">9:00 AM</div>
                            <div class="text-sm text-gray-400">Available</div>
                        </div>
                        <div class="bg-[#309983]/10 rounded-xl p-4 text-center appointment-slot cursor-pointer"
                            onclick="selectTimeSlot(this)">
                            <div class="text-lg font-semibold mb-1">11:00 AM</div>
                            <div class="text-sm text-gray-400">Available</div>
                        </div>
                        <div class="bg-[#309983]/10 rounded-xl p-4 text-center appointment-slot cursor-pointer"
                            onclick="selectTimeSlot(this)">
                            <div class="text-lg font-semibold mb-1">1:00 PM</div>
                            <div class="text-sm text-gray-400">Available</div>
                        </div>
                        <div class="bg-gray-700 rounded-xl p-4 text-center opacity-50">
                            <div class="text-lg font-semibold mb-1">3:00 PM</div>
                            <div class="text-sm text-gray-500">Booked</div>
                        </div>
                        <div class="bg-[#309983]/10 rounded-xl p-4 text-center appointment-slot cursor-pointer"
                            onclick="selectTimeSlot(this)">
                            <div class="text-lg font-semibold mb-1">4:00 PM</div>
                            <div class="text-sm text-gray-400">Available</div>
                        </div>
                        <div class="bg-[#309983]/10 rounded-xl p-4 text-center appointment-slot cursor-pointer"
                            onclick="selectTimeSlot(this)">
                            <div class="text-lg font-semibold mb-1">5:00 PM</div>
                            <div class="text-sm text-gray-400">Available</div>
                        </div>
                    </div>
                    <button
                        class="w-full mt-8 bg-primary text-black font-semibold py-4 px-8 rounded-lg !rounded-lg whitespace-nowrap hover:bg-primary/90 transition-colors">Confirm
                        Appointment</button>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="py-20 bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-6">Frequently Asked Questions</h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">Find quick answers to common questions about our
                        products, services, and installation process.</p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div class="space-y-4">
                        <div class="bg-gray-900 rounded-xl faq-item">
                            <button class="w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none"
                                onclick="toggleFAQ(this)">
                                <span class="text-lg font-semibold">How long does a typical solar installation take?</span>
                                <i class="ri-arrow-down-s-line text-xl transition-transform"></i>
                            </button>
                            <div class="faq-content px-8 pb-6">
                                <p class="text-gray-400">Most residential solar installations are completed within 1-3 days,
                                    depending on the system size and complexity. The entire process from initial
                                    consultation to final activation typically takes 4-8 weeks, including permitting and
                                    utility interconnection.</p>
                            </div>
                        </div>
                        <div class="bg-gray-900 rounded-xl faq-item">
                            <button class="w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none"
                                onclick="toggleFAQ(this)">
                                <span class="text-lg font-semibold">What financing options do you offer?</span>
                                <i class="ri-arrow-down-s-line text-xl transition-transform"></i>
                            </button>
                            <div class="faq-content px-8 pb-6">
                                <p class="text-gray-400">We offer multiple financing options including cash purchase, solar
                                    loans with competitive rates, leasing programs, and Power Purchase Agreements (PPAs).
                                    Our financing specialists will help you choose the best option for your budget and
                                    energy goals.</p>
                            </div>
                        </div>
                        <div class="bg-gray-900 rounded-xl faq-item">
                            <button class="w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none"
                                onclick="toggleFAQ(this)">
                                <span class="text-lg font-semibold">Do you provide warranty coverage?</span>
                                <i class="ri-arrow-down-s-line text-xl transition-transform"></i>
                            </button>
                            <div class="faq-content px-8 pb-6">
                                <p class="text-gray-400">Yes, we provide comprehensive warranty coverage including 25-year
                                    product warranties on solar panels, 10-year warranties on inverters, and 10-year
                                    workmanship warranties on all installations. We also offer extended warranty options for
                                    additional peace of mind.</p>
                            </div>
                        </div>
                        <div class="bg-gray-900 rounded-xl faq-item">
                            <button class="w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none"
                                onclick="toggleFAQ(this)">
                                <span class="text-lg font-semibold">Can I monitor my system's performance?</span>
                                <i class="ri-arrow-down-s-line text-xl transition-transform"></i>
                            </button>
                            <div class="faq-content px-8 pb-6">
                                <p class="text-gray-400">Absolutely! All our systems come with advanced monitoring
                                    capabilities through our mobile app and web portal. You can track energy production,
                                    consumption, savings, and system health in real-time from anywhere.</p>
                            </div>
                        </div>
                        <div class="bg-gray-900 rounded-xl faq-item">
                            <button class="w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none"
                                onclick="toggleFAQ(this)">
                                <span class="text-lg font-semibold">What happens during power outages?</span>
                                <i class="ri-arrow-down-s-line text-xl transition-transform"></i>
                            </button>
                            <div class="faq-content px-8 pb-6">
                                <p class="text-gray-400">Standard grid-tied systems will shut down during outages for safety
                                    reasons. However, if you add battery storage to your system, you can maintain power to
                                    essential loads during outages. We offer various battery backup solutions to meet your
                                    needs.</p>
                            </div>
                        </div>
                        <div class="bg-gray-900 rounded-xl faq-item">
                            <button class="w-full px-8 py-6 text-left flex items-center justify-between focus:outline-none"
                                onclick="toggleFAQ(this)">
                                <span class="text-lg font-semibold">How much can I save on my electricity bills?</span>
                                <i class="ri-arrow-down-s-line text-xl transition-transform"></i>
                            </button>
                            <div class="faq-content px-8 pb-6">
                                <p class="text-gray-400">Savings vary based on your location, energy usage, and system size,
                                    but most customers see 70-100% reduction in their electricity bills. Our energy
                                    consultants will provide a detailed savings analysis based on your specific situation
                                    and local utility rates.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

    <!-- FAQ Section -->
    <section class="py-20 bg-black" data-aos="zoom-in">
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
                        panel
                        performance
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
                        system
                        size. Most
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

    <!-- why choose -->
    <section class="py-20 " data-aos="fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-6">Why Choose GREENIK?</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Our commitment to excellence and customer
                    satisfaction sets us apart in the renewable energy industry.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="2">0</div>
                    <div class="text-sm text-gray-400">Minute Response Time</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="98">0</div>
                    <div class="text-sm text-gray-400">% Customer Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="50000">0</div>
                    <div class="text-sm text-gray-400">Happy Customers</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2 counter-animation" data-target="24">0</div>
                    <div class="text-sm text-gray-400">Hour Support</div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')


    <!-- live chat -->
    <div id="chat-widget" class="fixed bottom-6 right-6 z-50 hidden">
        <div class="bg-gray-900 rounded-xl shadow-2xl w-80 h-96 flex flex-col">
            <div class="bg-primary text-black p-4 rounded-t-xl flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-black/20 rounded-full flex items-center justify-center">
                        <i class="ri-customer-service-line"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Live Support</div>
                        <div class="text-xs opacity-80">Online - Avg response: 2 min</div>
                    </div>
                </div>
                <button onclick="toggleChat()"
                    class="w-6 h-6 flex items-center justify-center hover:bg-black/20 rounded">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="flex-1 p-4 overflow-y-auto">
                <div class="space-y-4">
                    <div class="flex items-start space-x-2">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center shrink-0">
                            <i class="ri-customer-service-line text-black text-sm"></i>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-3 max-w-xs">
                            <p class="text-sm">Hi! I'm Sarah from GREENIK. How can I help you with your clean energy
                                needs today?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-800">
                <div class="flex space-x-2">
                    <input type="text" placeholder="Type your message..."
                        class="flex-1 bg-[#309983]/10 border border-[#309983]/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-primary">
                    <button
                        class="w-10 h-10 bg-primary text-black rounded-lg flex items-center justify-center hover:bg-primary/90 transition-colors">
                        <i class="ri-send-plane-line"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed bottom-6 right-6 z-40">
        <button onclick="toggleChat()"
            class="w-16 h-16 bg-primary text-black rounded-full flex items-center justify-center shadow-lg hover:bg-primary/90 transition-all chat-widget">
            <i class="ri-chat-3-line text-2xl"></i>
        </button>
    </div>




    <script id="dropdown-functionality">
        function toggleDropdown() {
            const dropdown = document.getElementById('service-dropdown');
            dropdown.classList.toggle('hidden');
        }

        function selectService(service) {
            document.getElementById('selected-service').textContent = service;
            document.getElementById('service-dropdown').classList.add('hidden');
        }

        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('service-dropdown');
            const button = e.target.closest('button');
            if (!button || !button.onclick || button.onclick.toString().indexOf('toggleDropdown') === -1) {
                dropdown.classList.add('hidden');
            }
        });
    </script>






    <!-- <script id="counter-animation">
            document.addEventListener('DOMContentLoaded', function () {
                const counters = document.querySelectorAll('.counter-animation');
                const observerOptions = {
                    threshold: 0.5,
                    rootMargin: '0px 0px -100px 0px'
                };
                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const counter = entry.target;
                            const target = parseInt(counter.dataset.target);
                            const duration = 2000;
                            const increment = target / (duration / 16);
                            let current = 0;
                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= target) {
                                    current = target;
                                    clearInterval(timer);
                                }
                                if (target >= 1000) {
                                    counter.textContent = Math.floor(current).toLocaleString();
                                } else {
                                    counter.textContent = Math.floor(current);
                                }
                            }, 16);
                            observer.unobserve(counter);
                        }
                    });
                }, observerOptions);
                counters.forEach(counter => observer.observe(counter));
            });
        </script> -->

 

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
        })
    </script>

</body>

</html>