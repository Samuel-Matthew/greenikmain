//   product filtering
document.addEventListener("DOMContentLoaded", function () {
    const categoryFilters = document.querySelectorAll(".category-filter");
    const productCards = document.querySelectorAll(".product-card");
    const productSearch = document.getElementById("product-search");
    const sortSelect = document.getElementById("sort-select");
    const resultsCount = document.getElementById("results-count");
    const priceRange = document.getElementById("price-range");
    const priceValue = document.getElementById("price-value");
    const clearFilters = document.getElementById("clear-filters");

    // Map filter buttons to product category values
    const categoryMap = {
        all: "all",
        solar: "solar solutions",
        wind: "wind power",
        ev: "ev chargers",
        batteries: "batteries",
        accessories: "accessories",
    };

    let activeFilters = {
        category: "all",
        search: "",
        minPrice: 0,
        maxPrice: 1000000,
        brands: [],
        ratings: [],
        capacity: [],
    };

    function updatePriceDisplay() {
        const value = parseInt(priceRange.value);
        priceValue.textContent = `₦${value.toLocaleString()}`;
        activeFilters.maxPrice = value;
        filterProducts();
    }

    function filterProducts() {
        let visibleCount = 0;
        productCards.forEach((card) => {
            const category = card.dataset.category;
            const price = parseInt(card.dataset.price);
            const rating = parseFloat(card.dataset.rating);
            const brand = card.dataset.brand;
            const productName = card
                .querySelector("h3")
                .textContent.toLowerCase();
            const productDesc = card
                .querySelector("p")
                .textContent.toLowerCase();
            let visible = true;

            // Category filter - compare to mapped category value
            if (activeFilters.category !== "all") {
                const mappedCategory =
                    categoryMap[activeFilters.category] ||
                    activeFilters.category;
                if (category !== mappedCategory) {
                    visible = false;
                }
            }

            if (
                activeFilters.search &&
                !productName.includes(activeFilters.search) &&
                !productDesc.includes(activeFilters.search)
            ) {
                visible = false;
            }

            if (price > activeFilters.maxPrice) {
                visible = false;
            }

            if (
                activeFilters.brands.length > 0 &&
                !activeFilters.brands.includes(brand)
            ) {
                visible = false;
            }

            if (activeFilters.ratings.length > 0) {
                const matchesRating = activeFilters.ratings.some(
                    (minRating) => rating >= minRating
                );
                if (!matchesRating) {
                    visible = false;
                }
            }

            card.style.display = visible ? "block" : "none";
            if (visible) visibleCount++;
        });
        resultsCount.textContent = `Showing ${visibleCount} of ${productCards.length} products`;
    }

    categoryFilters.forEach((filter) => {
        filter.addEventListener("click", function () {
            categoryFilters.forEach((f) => f.classList.remove("filter-active"));
            this.classList.add("filter-active");
            activeFilters.category = this.dataset.category;
            filterProducts();
        });
    });

    productSearch.addEventListener("input", function () {
        activeFilters.search = this.value.toLowerCase();
        filterProducts();
    });

    if (priceRange) {
        updatePriceDisplay();
        priceRange.addEventListener("input", updatePriceDisplay);
    }
    document.querySelectorAll("[data-brand]").forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const brand = this.dataset.brand;
            if (this.checked) {
                activeFilters.brands.push(brand);
            } else {
                activeFilters.brands = activeFilters.brands.filter(
                    (b) => b !== brand
                );
            }
            filterProducts();
        });
    });
    document.querySelectorAll("[data-rating]").forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const rating = parseFloat(this.dataset.rating);
            if (this.checked) {
                activeFilters.ratings.push(rating);
            } else {
                activeFilters.ratings = activeFilters.ratings.filter(
                    (r) => r !== rating
                );
            }
            filterProducts();
        });
    });
    clearFilters.addEventListener("click", function () {
        activeFilters = {
            category: "all",
            search: "",
            minPrice: 0,
            maxPrice: 1000000,
            brands: [],
            ratings: [],
            capacity: [],
        };
        productSearch.value = "";
        if (priceRange) {
            priceRange.value = 1000000;
            updatePriceDisplay();
        }
        document
            .querySelectorAll(".custom-checkbox")
            .forEach((cb) => (cb.checked = false));
        categoryFilters.forEach((f) => f.classList.remove("filter-active"));
        categoryFilters[0].classList.add("filter-active");
        filterProducts();
    });

    sortSelect.addEventListener("change", function () {
        const sortBy = this.value;
        const grid = document.getElementById("product-grid");
        const cards = Array.from(productCards);
        cards.sort((a, b) => {
            switch (sortBy) {
                case "price-low":
                    return (
                        parseInt(a.dataset.price) - parseInt(b.dataset.price)
                    );
                case "price-high":
                    return (
                        parseInt(b.dataset.price) - parseInt(a.dataset.price)
                    );
                case "rating":
                    return (
                        parseFloat(b.dataset.rating) -
                        parseFloat(a.dataset.rating)
                    );
                case "newest":
                    return Math.random() - 0.5;
                default:
                    return Math.random() - 0.5;
            }
        });
        cards.forEach((card) => grid.appendChild(card));
    });
    // Initialize - show all products on page load
    filterProducts();
});

//    cart functionality
document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartCountEl = document.getElementById("cart-count");
    // initialize from existing DOM if present, otherwise start at 0
    let cartItems = 0;
    if (cartCountEl) {
        const parsed = parseInt(cartCountEl.textContent);
        cartItems = Number.isNaN(parsed) ? 0 : parsed;
    }

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            // prevent any unintended form submits
            // if (e && typeof e.preventDefault === "function") e.preventDefault();

            const card = this.closest(".product-card");
            const productName = card
                ? card.querySelector("h3") &&
                  card.querySelector("h3").textContent
                : "";
            cartItems++;
            if (cartCountEl) cartCountEl.textContent = cartItems;
            this.textContent = "Added!";
            this.classList.add("bg-green-600");
            setTimeout(() => {
                this.textContent = "Add to Cart";
                this.classList.remove("bg-green-600");
            }, 2000);
        });
    });
});

// PREVENT PAGE REFRESH ON ADD TO CART
document.addEventListener("DOMContentLoaded", function () {
    // Prevent page refresh on add to cart
    const addToCartForms = document.querySelectorAll("#add-to-cart-form");

    addToCartForms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    // Handle success response
                    console.log("Added to cart:", data);
                    // You can show a success message here if needed
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    });
});

// document.addEventListener("DOMContentLoaded", function () {
//     // Prevent page refresh on add to cart
//     const addToCartForms = document.querySelectorAll("#add-to-cart-form");

//     addToCartForms.forEach((form) => {
//         form.addEventListener("submit", function (e) {
//             e.preventDefault();

//             const formData = new FormData(this);

//             fetch(this.action, {
//                 method: "POST",
//                 body: formData,
//                 headers: {
//                     "X-Requested-With": "XMLHttpRequest",
//                 },
//             })
//                 .then((response) => response.json())
//                 .then((data) => {
//                     // Handle success response
//                     console.log("Added to cart:", data);
//                     // You can show a success message here if needed
//                 })
//                 .catch((error) => {
//                     console.error("Error:", error);
//                 });
//         });
//     });
// });

// view toggle

document.addEventListener("DOMContentLoaded", function () {
    const gridView = document.getElementById("grid-view");
    const listView = document.getElementById("list-view");
    const productGrid = document.getElementById("product-grid");
    gridView.addEventListener("click", function () {
        productGrid.className =
            "grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8";
        gridView.classList.add("bg-primary", "text-black");
        gridView.classList.remove("text-gray-400");
        listView.classList.remove("bg-primary", "text-black");
        listView.classList.add("text-gray-400");
    });
    listView.addEventListener("click", function () {
        productGrid.className = "space-y-4 mb-8";
        listView.classList.add("bg-primary", "text-black");
        listView.classList.remove("text-gray-400");
        gridView.classList.remove("bg-primary", "text-black");
        gridView.classList.add("text-gray-400");
    });
});

// bact to top

document.addEventListener("DOMContentLoaded", function () {
    const backToTop = document.getElementById("back-to-top");
    backToTop.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});

// quick modal view
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("quick-view-modal");
    const closeModal = document.getElementById("close-modal");
    const quickViewButtons = document.querySelectorAll(".quick-view");
    const modalMainImage = document.getElementById("modal-main-image");
    const modalThumbs = document.querySelectorAll(".modal-thumb");
    const productData = {
        // "SolarMax Pro 5kW Complete Kit": {
        //     images: [
        //         "https://readdy.ai/api/search-image?query=premium%20residential%20solar%20panel%20kit%20with%20inverter%20and%20mounting%20system%20professional%20product%20photography%20clean%20white%20background%20modern%20design%20high%20efficiency%20monocrystalline%20panels%20complete%20installation%20package&width=600&height=400&seq=solar001a&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=solar%20panel%20installation%20diagram%20residential%20rooftop%20mounting%20system%20professional%20technical%20illustration%20clean%20white%20background%20detailed%20components&width=600&height=400&seq=solar001b&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=MPPT%20solar%20inverter%20control%20unit%20professional%20product%20photography%20clean%20white%20background%20modern%20design%20digital%20display&width=600&height=400&seq=solar001c&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=solar%20panel%20mounting%20hardware%20brackets%20and%20rails%20professional%20product%20photography%20clean%20white%20background%20installation%20kit&width=600&height=400&seq=solar001d&orientation=landscape",
        //     ],
        //     description:
        //         "Our flagship 5kW solar kit combines premium monocrystalline panels with advanced MPPT technology for maximum energy production. Perfect for medium-sized homes, this complete system includes everything needed for professional installation including mounting hardware, DC and AC disconnect switches, and comprehensive documentation.",
        //     specs: {
        //         "Power Output": "5kW",
        //         "Panel Type": "Monocrystalline",
        //         Efficiency: "22.1%",
        //         Inverter: "MPPT Technology",
        //         Warranty: "25 Years Panel/10 Years Inverter",
        //         Certification: "UL Listed, IEC Certified",
        //     },
        // },
        // "WindMax Vertical 3kW Turbine": {
        //     images: [
        //         "https://readdy.ai/api/search-image?query=residential%20wind%20turbine%20generator%203kW%20capacity%20modern%20vertical%20axis%20design%20professional%20product%20photography%20clean%20white%20background%20renewable%20energy%20equipment%20high%20quality%20realistic%20render&width=600&height=400&seq=wind001a&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=wind%20turbine%20installation%20tower%20foundation%20professional%20technical%20illustration%20clean%20white%20background%20detailed%20assembly&width=600&height=400&seq=wind001b&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=wind%20turbine%20control%20system%20inverter%20professional%20product%20photography%20clean%20white%20background%20modern%20electronics&width=600&height=400&seq=wind001c&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=wind%20turbine%20blade%20assembly%20vertical%20axis%20design%20professional%20product%20photography%20clean%20white%20background%20aerodynamic%20engineering&width=600&height=400&seq=wind001d&orientation=landscape",
        //     ],
        //     description:
        //         "Revolutionary vertical axis wind turbine designed for residential applications. Features ultra-quiet operation, low wind speed startup, and maintenance-free design. Perfect for areas with variable wind directions and urban environments.",
        //     specs: {
        //         "Power Output": "3kW",
        //         "Turbine Type": "Vertical Axis",
        //         "Cut-in Wind Speed": "2.5 m/s",
        //         "Rated Wind Speed": "12 m/s",
        //         "Noise Level": "<45dB",
        //         Warranty: "10 Years",
        //     },
        // },
        // "EcoCharge Smart Level 2 Charger": {
        //     images: [
        //         "https://readdy.ai/api/search-image?query=wall%20mounted%20electric%20vehicle%20charging%20station%20Level%202%20EV%20charger%20modern%20sleek%20design%20professional%20product%20photography%20clean%20white%20background%20smart%20connectivity%20features&width=600&height=400&seq=ev001a&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=EV%20charger%20mobile%20app%20interface%20smartphone%20screen%20showing%20charging%20status%20energy%20monitoring%20professional%20product%20photography%20clean%20background&width=600&height=400&seq=ev001b&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=electric%20vehicle%20charging%20cable%20connector%20J1772%20professional%20product%20photography%20clean%20white%20background%20high%20quality%20materials&width=600&height=400&seq=ev001c&orientation=landscape",
        //         "https://readdy.ai/api/search-image?query=EV%20charger%20installation%20electrical%20panel%20professional%20technical%20illustration%20clean%20background%20safety%20features&width=600&height=400&seq=ev001d&orientation=landscape",
        //     ],
        //     description:
        //         "Smart Level 2 EV charger with WiFi connectivity and mobile app control. Features intelligent scheduling, energy monitoring, and compatibility with all electric vehicles. Built-in safety features and weather-resistant design for outdoor installation.",
        //     specs: {
        //         "Charging Speed": "40A / 9.6kW",
        //         "Connector Type": "J1772",
        //         Connectivity: "WiFi + Bluetooth",
        //         Features: "Smart Scheduling",
        //         Safety: "UL Listed",
        //         Warranty: "3 Years",
        //     },
        // },
    };
    quickViewButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            const card = this.closest(".product-card");
            const productName = card.querySelector("h3").textContent;
            const productPrice = card.querySelector(".text-2xl").textContent;
            const productRating = card
                .querySelector(".star-rating")
                .parentElement.querySelector(".text-gray-400").textContent;
            const productCategory =
                card.querySelector(".bg-gray-800").textContent;
            const productBrand =
                card.querySelectorAll(".text-gray-400")[0].textContent;
            const productCapacity = card.querySelector(
                ".text-sm.text-gray-400:last-child"
            ).textContent;
            const mainImage = card.querySelector("img").src;
            document.getElementById("modal-product-title").textContent =
                productName;
            document.getElementById("modal-product-name").textContent =
                productName;
            document.getElementById("modal-price").textContent = productPrice;
            document.getElementById("modal-rating-text").textContent =
                productRating;
            document.getElementById("modal-category").textContent =
                productCategory;
            document.getElementById("modal-brand").textContent = productBrand;
            document.getElementById("modal-capacity").textContent =
                productCapacity;
            const badges = card.querySelector(".absolute.top-3.left-3");
            const modalBadges = document.getElementById("modal-badges");
            modalBadges.innerHTML = badges ? badges.outerHTML : "";
            const rating = parseFloat(card.dataset.rating);
            const modalRating = document.getElementById("modal-rating");
            modalRating.innerHTML = "";
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement("i");
                if (i <= Math.floor(rating)) {
                    star.className = "ri-star-fill text-sm";
                } else if (i === Math.ceil(rating) && rating % 1 !== 0) {
                    star.className = "ri-star-half-line text-sm";
                } else {
                    star.className = "ri-star-line text-sm";
                }
                modalRating.appendChild(star);
            }
            const data = productData[productName];
            if (data) {
                modalMainImage.src = data.images[0];
                modalMainImage.alt = productName;
                document.getElementById("modal-description").textContent =
                    data.description;
                modalThumbs.forEach((thumb, index) => {
                    if (data.images[index]) {
                        thumb.src = data.images[index];
                        thumb.alt = `${productName} view ${index + 1}`;
                        thumb.style.display = "block";
                    } else {
                        thumb.style.display = "none";
                    }
                });
                const specsContainer = document.getElementById("modal-specs");
                specsContainer.innerHTML = "";
                Object.entries(data.specs).forEach(([key, value]) => {
                    const specDiv = document.createElement("div");
                    specDiv.className = "flex justify-between";
                    specDiv.innerHTML = `
<span class="text-gray-400">${key}:</span>
<span>${value}</span>
`;
                    specsContainer.appendChild(specDiv);
                });
            } else {
                // Fallback: Use data from card attributes (from database)
                document.getElementById("modal-description").textContent =
                    card.dataset.productDesc ||
                    card.querySelector("p").textContent;

                // Populate images from database
                try {
                    const dbImages = JSON.parse(card.dataset.images || "[]");
                    if (dbImages.length > 0) {
                        modalMainImage.src = dbImages[0];
                        modalMainImage.alt = productName;
                        modalThumbs.forEach((thumb, index) => {
                            if (dbImages[index]) {
                                thumb.src = dbImages[index];
                                thumb.alt = `${productName} view ${index + 1}`;
                                thumb.style.display = "block";
                            } else {
                                thumb.style.display = "none";
                            }
                        });
                    } else {
                        modalMainImage.src = mainImage;
                        modalMainImage.alt = productName;
                        modalThumbs.forEach(
                            (thumb) => (thumb.style.display = "none")
                        );
                    }
                } catch (e) {
                    console.error("Error parsing images:", e);
                    modalMainImage.src = mainImage;
                    modalMainImage.alt = productName;
                    modalThumbs.forEach(
                        (thumb) => (thumb.style.display = "none")
                    );
                }

                // Populate specs from database
                const specsContainer = document.getElementById("modal-specs");
                specsContainer.innerHTML = "";
                try {
                    const dbSpecs = JSON.parse(card.dataset.specs || "{}");
                    if (Object.keys(dbSpecs).length > 0) {
                        Object.entries(dbSpecs).forEach(([key, value]) => {
                            const specDiv = document.createElement("div");
                            specDiv.className = "flex justify-between";
                            specDiv.innerHTML = `
<span class="text-gray-400">${key}:</span>
<span>${value}</span>
`;
                            specsContainer.appendChild(specDiv);
                        });
                    }
                } catch (e) {
                    console.error("Error parsing specs:", e);
                }
            }
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.style.overflow = "hidden";
        });
    });
    modalThumbs.forEach((thumb) => {
        thumb.addEventListener("click", function () {
            modalMainImage.src = this.src;
            modalThumbs.forEach((t) => t.classList.remove("border-primary"));
            this.classList.add("border-primary");
        });
    });
    function closeModalHandler() {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        document.body.style.overflow = "auto";
    }
    closeModal.addEventListener("click", closeModalHandler);
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            closeModalHandler();
        }
    });
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            closeModalHandler();
        }
    });
    document
        .getElementById("modal-add-cart")
        .addEventListener("click", function () {
            const cartCount = document.getElementById("cart-count");
            let count = parseInt(cartCount.textContent);
            cartCount.textContent = count + 1;
            this.textContent = "Added!";
            this.classList.add("bg-green-600");
            setTimeout(() => {
                this.textContent = "Add to Cart";
                this.classList.remove("bg-green-600");
            }, 2000);
        });
});

//  function addSpec() {
//      const wrapper = document.getElementById("specs-area");
//      const row = document.createElement("div");
//      row.classList.add("spec-row");
//      row.innerHTML = `
//       <div class="flex my-2 gap-4 spec-row">
//     <input name="spec_key[]" type="text"
//         class="bg-dark-bg border border-dark-border rounded p-2 text-white w-1/3"
//         placeholder="Option Name (e.g. Wattage)">
//     <input name="spec_value[]" type="text"
//         class="bg-dark-bg border border-dark-border rounded p-2 text-white flex-1"
//         placeholder="Values (e.g. 5KW, 10KW, 15KW)">
//         </div>
// `;
//      wrapper.appendChild(row);
//  }
