/* ==========================================================================
   IUREFFICIENT - Main JavaScript
   ========================================================================== */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modules
    initAOS();
    initHeader();
    initMobileNav();
    initSwiper();
    initSmoothScroll();
    initContactForm();
});

/* --------------------------------------------------------------------------
   AOS - Animate on Scroll
   -------------------------------------------------------------------------- */
function initAOS() {
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 50,
        delay: 0,
    });
}

/* --------------------------------------------------------------------------
   Header - Scroll behavior
   -------------------------------------------------------------------------- */
function initHeader() {
    const header = document.getElementById('header');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        // Add/remove scrolled class
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    });
}

/* --------------------------------------------------------------------------
   Mobile Navigation
   -------------------------------------------------------------------------- */
function initMobileNav() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (!navToggle || !navMenu) return;

    navToggle.addEventListener('click', () => {
        navToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
    });

    // Close menu when clicking a link
    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!navMenu.contains(e.target) && !navToggle.contains(e.target)) {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

/* --------------------------------------------------------------------------
   Swiper - Screenshots Carousel
   -------------------------------------------------------------------------- */
function initSwiper() {
    const swiperElement = document.querySelector('.screenshots-swiper');

    if (!swiperElement) return;

    new Swiper('.screenshots-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        centeredSlides: true,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1.5,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 2.2,
                spaceBetween: 40,
            },
        },
    });
}

/* --------------------------------------------------------------------------
   Smooth Scroll for anchor links
   -------------------------------------------------------------------------- */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            // Skip if it's just "#"
            if (href === '#') return;

            const target = document.querySelector(href);

            if (target) {
                e.preventDefault();

                const headerHeight = document.getElementById('header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = targetPosition - headerHeight - 20;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/* --------------------------------------------------------------------------
   Contact Form
   -------------------------------------------------------------------------- */
function initContactForm() {
    const form = document.getElementById('contactForm');

    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        // Show loading state
        submitBtn.innerHTML = `
            <svg class="spinner" width="20" height="20" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none" opacity="0.25"/>
                <path d="M12 2a10 10 0 0 1 10 10" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="1s" repeatCount="indefinite"/>
                </path>
            </svg>
            Enviando...
        `;
        submitBtn.disabled = true;

        // Collect form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            // Here you would typically send to your backend
            // For now, we'll simulate a successful submission
            await simulateFormSubmission(data);

            // Show success message
            showFormMessage(form, 'success', '¡Gracias! Nos pondremos en contacto contigo pronto.');
            form.reset();

        } catch (error) {
            // Show error message
            showFormMessage(form, 'error', 'Hubo un error. Por favor intenta de nuevo o escríbenos a contacto@iurefficient.com');
        } finally {
            // Restore button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

function simulateFormSubmission(data) {
    return new Promise((resolve, reject) => {
        // Simulate network delay
        setTimeout(() => {
            // Log the data (in production, send to backend)
            console.log('Form submitted:', data);

            // Simulate success (90% of the time)
            if (Math.random() > 0.1) {
                resolve({ success: true });
            } else {
                reject(new Error('Simulated error'));
            }
        }, 1500);
    });
}

function showFormMessage(form, type, message) {
    // Remove existing message if any
    const existingMessage = form.querySelector('.form-message');
    if (existingMessage) {
        existingMessage.remove();
    }

    // Create message element
    const messageEl = document.createElement('div');
    messageEl.className = `form-message form-message-${type}`;
    messageEl.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            ${type === 'success'
                ? '<path d="M20 6L9 17l-5-5"/>'
                : '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>'
            }
        </svg>
        <span>${message}</span>
    `;

    // Add styles dynamically
    messageEl.style.cssText = `
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 0.5rem;
        font-size: 0.9375rem;
        ${type === 'success'
            ? 'background: rgba(16, 185, 129, 0.2); color: #34d399;'
            : 'background: rgba(239, 68, 68, 0.2); color: #f87171;'
        }
    `;

    // Insert after button
    const button = form.querySelector('button[type="submit"]');
    button.parentNode.insertBefore(messageEl, button.nextSibling);

    // Remove message after 5 seconds
    setTimeout(() => {
        messageEl.style.opacity = '0';
        messageEl.style.transition = 'opacity 0.3s ease';
        setTimeout(() => messageEl.remove(), 300);
    }, 5000);
}

/* --------------------------------------------------------------------------
   Utility: Throttle function for performance
   -------------------------------------------------------------------------- */
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/* --------------------------------------------------------------------------
   Intersection Observer for lazy animations
   -------------------------------------------------------------------------- */
function initLazyAnimations() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

/* --------------------------------------------------------------------------
   Counter Animation (for stats)
   -------------------------------------------------------------------------- */
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);

    const updateCounter = () => {
        start += increment;
        if (start < target) {
            element.textContent = Math.floor(start);
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target;
        }
    };

    updateCounter();
}

/* --------------------------------------------------------------------------
   Video Section - Lazy Load YouTube
   -------------------------------------------------------------------------- */
function initVideoLazyLoad() {
    const videoContainers = document.querySelectorAll('.video-container[data-video-id]');

    videoContainers.forEach(container => {
        const videoId = container.dataset.videoId;
        const thumbnail = document.createElement('div');
        thumbnail.className = 'video-thumbnail';
        thumbnail.innerHTML = `
            <img src="https://img.youtube.com/vi/${videoId}/maxresdefault.jpg" alt="Video thumbnail">
            <button class="play-button" aria-label="Reproducir video">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5 3 19 12 5 21 5 3"/>
                </svg>
            </button>
        `;

        thumbnail.addEventListener('click', () => {
            const iframe = document.createElement('iframe');
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;

            container.innerHTML = '';
            container.appendChild(iframe);
        });

        container.appendChild(thumbnail);
    });
}
