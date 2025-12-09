
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
