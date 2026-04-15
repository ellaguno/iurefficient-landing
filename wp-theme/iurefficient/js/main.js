/* ==========================================================================
   IUREFFICIENT - Main JavaScript
   ========================================================================== */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modules
    initAOS();
    initHeader();
    initMobileNav();
    initSwiper();
    initGLightbox();
    initSmoothScroll();
    initContactForm();
    initScrollButton();
    initNewsTicker();
    initMockup3D();
    initHeroShader();
    initCtaGradient();
    initSpotlightCards();
    initGallery3D();
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
   Mockup 3D Perspective on Scroll
   -------------------------------------------------------------------------- */
function initMockup3D() {
    const mockup = document.querySelector('.hero-mockup');
    if (!mockup) return;

    const MAX_RX = 35;   // initial tilt in degrees
    const MIN_SCALE = 0.9;

    function update() {
        const rect = mockup.getBoundingClientRect();
        const winH = window.innerHeight;

        // progress: 0 when element enters viewport top, 1 when its top reaches ~40% from top
        const progress = Math.min(Math.max(1 - rect.top / (winH * 0.75), 0), 1);

        const rx = MAX_RX * (1 - progress);            // 35 → 0
        const s  = MIN_SCALE + (1 - MIN_SCALE) * progress; // 0.9 → 1

        mockup.style.setProperty('--mockup-rx', rx + 'deg');
        mockup.style.setProperty('--mockup-s', s);
    }

    window.addEventListener('scroll', update, { passive: true });
    update(); // run once on load
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
   GLightbox - Image Lightbox for Screenshots
   -------------------------------------------------------------------------- */
function initGLightbox() {
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: false,
        openEffect: 'zoom',
        closeEffect: 'fade',
        cssEfects: {
            fade: { in: 'fadeIn', out: 'fadeOut' },
            zoom: { in: 'zoomIn', out: 'zoomOut' }
        }
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
            // Send to Brevo via PHP backend
            const response = await fetch('/api/send-contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                // Show success message
                showFormMessage(form, 'success', '¡Gracias! Te hemos enviado un correo de confirmación. Nos pondremos en contacto contigo pronto.');
                form.reset();
            } else {
                throw new Error(result.error || 'Error al enviar');
            }

        } catch (error) {
            console.error('Form error:', error);
            // Show error message
            showFormMessage(form, 'error', 'Hubo un error. Por favor intenta de nuevo o escríbenos a contacto@iurefficient.com');
        } finally {
            // Restore button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
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
   Scroll Button - Go to top/bottom
   -------------------------------------------------------------------------- */
function initScrollButton() {
    const scrollBtn = document.getElementById('scrollBtn');
    if (!scrollBtn) return;

    const showThreshold = 300;

    function updateButtonState() {
        const scrollTop = window.pageYOffset;
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        const scrollBottom = documentHeight - scrollTop - windowHeight;

        // Show/hide button
        if (scrollTop > showThreshold) {
            scrollBtn.classList.add('visible');
        } else {
            scrollBtn.classList.remove('visible');
        }

        // Toggle between up/down arrows
        // Show up arrow when near the bottom (less than 200px from bottom)
        if (scrollBottom < 200) {
            scrollBtn.classList.add('at-bottom');
        } else {
            scrollBtn.classList.remove('at-bottom');
        }
    }

    // Initial state
    updateButtonState();

    // Update on scroll
    window.addEventListener('scroll', throttle(updateButtonState, 100));

    // Click handler
    scrollBtn.addEventListener('click', () => {
        if (scrollBtn.classList.contains('at-bottom')) {
            // Scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            // Scroll to bottom
            window.scrollTo({
                top: document.documentElement.scrollHeight,
                behavior: 'smooth'
            });
        }
    });
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
   Blog News Banner - Horizontal scrolling carousel
   -------------------------------------------------------------------------- */
function initNewsTicker() {
    const scroll = document.querySelector('.blog-banner__scroll');
    if (!scroll) return;

    // Set dynamic animation duration based on content width
    const contentWidth = scroll.scrollWidth / 2;
    const pixelsPerSecond = 40;
    const duration = Math.max(20, contentWidth / pixelsPerSecond);
    scroll.style.animationDuration = duration + 's';
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

/* --------------------------------------------------------------------------
   CTA Gradient - Interactive pointer blob
   -------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------
   Spotlight Cards - Glow effect that follows pointer
   -------------------------------------------------------------------------- */
function initSpotlightCards() {
    var grid = document.querySelector('.features-grid');
    if (!grid) return;

    var cards = grid.querySelectorAll('.feature-card');
    if (!cards.length) return;

    grid.addEventListener('mousemove', function(e) {
        // Update global pointer ratio for hue shift
        var xp = (e.clientX / window.innerWidth).toFixed(2);

        cards.forEach(function(card) {
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;

            card.style.setProperty('--card-x', x.toFixed(2));
            card.style.setProperty('--card-y', y.toFixed(2));
            card.style.setProperty('--xp', xp);
        });
    });
}

function initCtaGradient() {
    var pointer = document.querySelector('.cta-blob--pointer');
    var cta = document.querySelector('.cta');
    if (!pointer || !cta) return;

    var curX = 0, curY = 0, tgX = 0, tgY = 0;

    cta.addEventListener('mousemove', function(e) {
        var rect = cta.getBoundingClientRect();
        tgX = e.clientX - rect.left;
        tgY = e.clientY - rect.top;
    });

    function animate() {
        curX += (tgX - curX) / 20;
        curY += (tgY - curY) / 20;
        pointer.style.transform = 'translate(' + Math.round(curX) + 'px, ' + Math.round(curY) + 'px)';
        requestAnimationFrame(animate);
    }
    animate();
}

/* --------------------------------------------------------------------------
   Hero WebGL Shader Background
   -------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------
   3D Screenshot Gallery (Three.js)
   -------------------------------------------------------------------------- */
function initGallery3D() {
    var canvas = document.getElementById('gallery3d-canvas');
    if (!canvas || typeof THREE === 'undefined') return;

    var wrapper = canvas.parentElement;

    // Screenshot images
    var imagePaths = [
        'images/screenshot-1.png',
        'images/screenshot-2.png',
        'images/screenshot-3.png',
        'images/screenshot-4.png',
        'images/screenshot-5.png',
        'images/screenshot-6.png',
        'images/screenshot-7.png'
    ];

    // Settings
    var VISIBLE_COUNT = 10;
    var DEPTH_RANGE = 50;
    var HALF_RANGE = DEPTH_RANGE / 2;
    var AUTO_SPEED = 0.3;

    // Fade/blur settings
    var FADE_IN_START = 0.05, FADE_IN_END = 0.25;
    var FADE_OUT_START = 0.4, FADE_OUT_END = 0.43;
    var BLUR_IN_START = 0.0, BLUR_IN_END = 0.1;
    var BLUR_OUT_START = 0.4, BLUR_OUT_END = 0.43;
    var MAX_BLUR = 8.0;

    // Scene setup
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(55, wrapper.clientWidth / wrapper.clientHeight, 0.1, 100);
    camera.position.set(0, 0, 0);

    var renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
    renderer.setSize(wrapper.clientWidth, wrapper.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setClearColor(0x000000, 0);

    // Load textures
    var loader = new THREE.TextureLoader();
    var textures = [];
    var loadedCount = 0;

    imagePaths.forEach(function(path, i) {
        loader.load(path, function(tex) {
            tex.minFilter = THREE.LinearFilter;
            tex.magFilter = THREE.LinearFilter;
            textures[i] = tex;
            loadedCount++;
            if (loadedCount === imagePaths.length) startGallery();
        });
    });

    // Cloth shader
    var vertexShader = [
        'uniform float scrollForce;',
        'uniform float time;',
        'uniform float isHovered;',
        'varying vec2 vUv;',
        '',
        'void main() {',
        '    vUv = uv;',
        '    vec3 pos = position;',
        '',
        '    float curveIntensity = scrollForce * 0.3;',
        '    float distanceFromCenter = length(pos.xy);',
        '    float curve = distanceFromCenter * distanceFromCenter * curveIntensity;',
        '',
        '    float ripple1 = sin(pos.x * 2.0 + scrollForce * 3.0) * 0.02;',
        '    float ripple2 = sin(pos.y * 2.5 + scrollForce * 2.0) * 0.015;',
        '    float clothEffect = (ripple1 + ripple2) * abs(curveIntensity) * 2.0;',
        '',
        '    float flagWave = 0.0;',
        '    if (isHovered > 0.5) {',
        '        float wavePhase = pos.x * 3.0 + time * 8.0;',
        '        float dampening = smoothstep(-0.5, 0.5, pos.x);',
        '        flagWave = sin(wavePhase) * 0.1 * dampening;',
        '        flagWave += sin(pos.x * 5.0 + time * 12.0) * 0.03 * dampening;',
        '    }',
        '',
        '    pos.z -= (curve + clothEffect + flagWave);',
        '    gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.0);',
        '}'
    ].join('\n');

    var fragmentShader = [
        'uniform sampler2D map;',
        'uniform float opacity;',
        'uniform float blurAmount;',
        'uniform float scrollForce;',
        'varying vec2 vUv;',
        '',
        'void main() {',
        '    vec4 color = texture2D(map, vUv);',
        '',
        '    if (blurAmount > 0.0) {',
        '        vec2 texelSize = 1.0 / vec2(textureSize(map, 0));',
        '        vec4 blurred = vec4(0.0);',
        '        float total = 0.0;',
        '        for (float x = -2.0; x <= 2.0; x += 1.0) {',
        '            for (float y = -2.0; y <= 2.0; y += 1.0) {',
        '                vec2 offset = vec2(x, y) * texelSize * blurAmount;',
        '                float weight = 1.0 / (1.0 + length(vec2(x, y)));',
        '                blurred += texture2D(map, vUv + offset) * weight;',
        '                total += weight;',
        '            }',
        '        }',
        '        color = blurred / total;',
        '    }',
        '',
        '    float curveHighlight = abs(scrollForce) * 0.05;',
        '    color.rgb += vec3(curveHighlight * 0.1);',
        '',
        '    gl_FragColor = vec4(color.rgb, color.a * opacity);',
        '}'
    ].join('\n');

    // State
    var scrollVelocity = 0;
    var autoPlay = true;
    var lastInteraction = 0;
    var planes = [];
    var meshes = [];
    var materials = [];
    var clock = new THREE.Clock();
    var raycaster = new THREE.Raycaster();
    var mouse = new THREE.Vector2();
    var hoveredMesh = null;

    // Spatial positions (golden angle distribution)
    function generatePositions(count) {
        var positions = [];
        for (var i = 0; i < count; i++) {
            var hAngle = (i * 2.618) % (Math.PI * 2);
            var vAngle = (i * 1.618 + Math.PI / 3) % (Math.PI * 2);
            var hRadius = (i % 3) * 1.2;
            var vRadius = ((i + 1) % 4) * 0.8;
            positions.push({
                x: (Math.sin(hAngle) * hRadius * 8) / 3,
                y: (Math.cos(vAngle) * vRadius * 8) / 4
            });
        }
        return positions;
    }

    function startGallery() {
        var spatialPos = generatePositions(VISIBLE_COUNT);
        var totalImages = imagePaths.length;
        var geometry = new THREE.PlaneGeometry(1, 1, 32, 32);

        for (var i = 0; i < VISIBLE_COUNT; i++) {
            var imgIdx = i % totalImages;
            var mat = new THREE.ShaderMaterial({
                transparent: true,
                uniforms: {
                    map: { value: textures[imgIdx] },
                    opacity: { value: 1.0 },
                    blurAmount: { value: 0.0 },
                    scrollForce: { value: 0.0 },
                    time: { value: 0.0 },
                    isHovered: { value: 0.0 }
                },
                vertexShader: vertexShader,
                fragmentShader: fragmentShader
            });

            var tex = textures[imgIdx];
            var aspect = tex.image ? tex.image.width / tex.image.height : 16 / 10;
            var scaleX = aspect > 1 ? 3.5 * aspect : 3.5;
            var scaleY = aspect > 1 ? 3.5 : 3.5 / aspect;

            var mesh = new THREE.Mesh(geometry, mat);
            var z = ((DEPTH_RANGE / VISIBLE_COUNT) * i) % DEPTH_RANGE;
            mesh.position.set(spatialPos[i].x, spatialPos[i].y, z - HALF_RANGE);
            mesh.scale.set(scaleX, scaleY, 1);

            scene.add(mesh);
            meshes.push(mesh);
            materials.push(mat);
            planes.push({
                index: i,
                z: z,
                imageIndex: imgIdx,
                x: spatialPos[i].x,
                y: spatialPos[i].y
            });
        }

        // Event listeners
        canvas.addEventListener('wheel', function(e) {
            e.preventDefault();
            scrollVelocity += e.deltaY * 0.01;
            autoPlay = false;
            lastInteraction = Date.now();
        }, { passive: false });

        // Touch support
        var touchStartY = 0;
        canvas.addEventListener('touchstart', function(e) {
            touchStartY = e.touches[0].clientY;
            autoPlay = false;
            lastInteraction = Date.now();
        }, { passive: true });

        canvas.addEventListener('touchmove', function(e) {
            var deltaY = touchStartY - e.touches[0].clientY;
            touchStartY = e.touches[0].clientY;
            scrollVelocity += deltaY * 0.03;
            e.preventDefault();
        }, { passive: false });

        // Hover detection
        canvas.addEventListener('mousemove', function(e) {
            var rect = canvas.getBoundingClientRect();
            mouse.x = ((e.clientX - rect.left) / rect.width) * 2 - 1;
            mouse.y = -((e.clientY - rect.top) / rect.height) * 2 + 1;
        });

        // Auto-play resume
        setInterval(function() {
            if (Date.now() - lastInteraction > 3000) autoPlay = true;
        }, 1000);

        // Intersection observer - pause when not visible
        var isVisible = true;
        if (typeof IntersectionObserver !== 'undefined') {
            var observer = new IntersectionObserver(function(entries) {
                isVisible = entries[0].isIntersecting;
            }, { threshold: 0.1 });
            observer.observe(wrapper);
        }

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            if (!isVisible) return;

            var delta = clock.getDelta();
            var time = clock.getElapsedTime();

            // Auto-play
            if (autoPlay) scrollVelocity += AUTO_SPEED * delta;

            // Damping
            scrollVelocity *= 0.95;

            // Raycasting for hover
            raycaster.setFromCamera(mouse, camera);
            var intersects = raycaster.intersectObjects(meshes);
            var newHovered = intersects.length > 0 ? intersects[0].object : null;

            if (hoveredMesh !== newHovered) {
                if (hoveredMesh) {
                    hoveredMesh.material.uniforms.isHovered.value = 0.0;
                }
                hoveredMesh = newHovered;
            }
            if (hoveredMesh) {
                hoveredMesh.material.uniforms.isHovered.value = 1.0;
            }

            var imageAdvance = VISIBLE_COUNT % totalImages || totalImages;

            // Update planes
            for (var i = 0; i < planes.length; i++) {
                var plane = planes[i];
                var newZ = plane.z + scrollVelocity * delta * 10;
                var wrapsForward = 0, wrapsBackward = 0;

                if (newZ >= DEPTH_RANGE) {
                    wrapsForward = Math.floor(newZ / DEPTH_RANGE);
                    newZ -= DEPTH_RANGE * wrapsForward;
                } else if (newZ < 0) {
                    wrapsBackward = Math.ceil(-newZ / DEPTH_RANGE);
                    newZ += DEPTH_RANGE * wrapsBackward;
                }

                if (wrapsForward > 0) {
                    plane.imageIndex = (plane.imageIndex + wrapsForward * imageAdvance) % totalImages;
                }
                if (wrapsBackward > 0) {
                    var step = plane.imageIndex - wrapsBackward * imageAdvance;
                    plane.imageIndex = ((step % totalImages) + totalImages) % totalImages;
                }

                plane.z = ((newZ % DEPTH_RANGE) + DEPTH_RANGE) % DEPTH_RANGE;

                // Update mesh position
                meshes[i].position.z = plane.z - HALF_RANGE;

                // Update texture
                materials[i].uniforms.map.value = textures[plane.imageIndex];

                // Opacity calculation
                var norm = plane.z / DEPTH_RANGE;
                var opacity = 1;
                if (norm < FADE_IN_START) opacity = 0;
                else if (norm < FADE_IN_END) opacity = (norm - FADE_IN_START) / (FADE_IN_END - FADE_IN_START);
                else if (norm > FADE_OUT_END) opacity = 0;
                else if (norm > FADE_OUT_START) opacity = 1 - (norm - FADE_OUT_START) / (FADE_OUT_END - FADE_OUT_START);
                opacity = Math.max(0, Math.min(1, opacity));

                // Blur calculation
                var blur = 0;
                if (norm < BLUR_IN_START) blur = MAX_BLUR;
                else if (norm < BLUR_IN_END) blur = MAX_BLUR * (1 - (norm - BLUR_IN_START) / (BLUR_IN_END - BLUR_IN_START));
                else if (norm > BLUR_OUT_END) blur = MAX_BLUR;
                else if (norm > BLUR_OUT_START) blur = MAX_BLUR * ((norm - BLUR_OUT_START) / (BLUR_OUT_END - BLUR_OUT_START));

                // Update uniforms
                materials[i].uniforms.opacity.value = opacity;
                materials[i].uniforms.blurAmount.value = blur;
                materials[i].uniforms.scrollForce.value = scrollVelocity;
                materials[i].uniforms.time.value = time;
            }

            renderer.render(scene, camera);
        }

        animate();
    }

    // Resize handler
    window.addEventListener('resize', function() {
        var w = wrapper.clientWidth;
        var h = wrapper.clientHeight;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
    });
}

function initHeroShader() {
    var canvas = document.getElementById('hero-shader');
    if (!canvas) return;

    var gl = canvas.getContext('webgl');
    if (!gl) return; // silently fail if no WebGL

    // --- Shaders ---
    var vsSource = [
        'attribute vec4 aVertexPosition;',
        'void main() { gl_Position = aVertexPosition; }'
    ].join('\n');

    var fsSource = [
        'precision highp float;',
        'uniform vec2 iResolution;',
        'uniform float iTime;',
        '',
        'const float overallSpeed = 0.2;',
        'const float gridSmoothWidth = 0.015;',
        'const float axisWidth = 0.05;',
        'const float majorLineWidth = 0.025;',
        'const float minorLineWidth = 0.0125;',
        'const float majorLineFrequency = 5.0;',
        'const float minorLineFrequency = 1.0;',
        'const vec4 gridColor = vec4(0.5);',
        'const float scale = 5.0;',
        'const vec4 lineColor = vec4(0.31, 0.27, 0.9, 1.0);',
        'const float minLineWidth = 0.01;',
        'const float maxLineWidth = 0.2;',
        'const float lineSpeed = 1.0 * overallSpeed;',
        'const float lineAmplitude = 1.0;',
        'const float lineFrequency = 0.2;',
        'const float warpSpeed = 0.2 * overallSpeed;',
        'const float warpFrequency = 0.5;',
        'const float warpAmplitude = 1.0;',
        'const float offsetFrequency = 0.5;',
        'const float offsetSpeed = 1.33 * overallSpeed;',
        'const float minOffsetSpread = 0.6;',
        'const float maxOffsetSpread = 2.0;',
        'const int linesPerGroup = 16;',
        '',
        '#define drawCircle(pos, radius, coord) smoothstep(radius + gridSmoothWidth, radius, length(coord - (pos)))',
        '#define drawSmoothLine(pos, halfWidth, t) smoothstep(halfWidth, 0.0, abs(pos - (t)))',
        '#define drawCrispLine(pos, halfWidth, t) smoothstep(halfWidth + gridSmoothWidth, halfWidth, abs(pos - (t)))',
        '#define drawPeriodicLine(freq, width, t) drawCrispLine(freq / 2.0, width, abs(mod(t, freq) - (freq) / 2.0))',
        '',
        'float drawGridLines(float axis) {',
        '    return drawCrispLine(0.0, axisWidth, axis)',
        '        + drawPeriodicLine(majorLineFrequency, majorLineWidth, axis)',
        '        + drawPeriodicLine(minorLineFrequency, minorLineWidth, axis);',
        '}',
        '',
        'float drawGrid(vec2 space) {',
        '    return min(1.0, drawGridLines(space.x) + drawGridLines(space.y));',
        '}',
        '',
        'float random(float t) {',
        '    return (cos(t) + cos(t * 1.3 + 1.3) + cos(t * 1.4 + 1.4)) / 3.0;',
        '}',
        '',
        'float getPlasmaY(float x, float horizontalFade, float offset) {',
        '    return random(x * lineFrequency + iTime * lineSpeed) * horizontalFade * lineAmplitude + offset;',
        '}',
        '',
        'void main() {',
        '    vec2 fragCoord = gl_FragCoord.xy;',
        '    vec4 fragColor;',
        '    vec2 uv = fragCoord.xy / iResolution.xy;',
        '    vec2 space = (fragCoord - iResolution.xy / 2.0) / iResolution.x * 2.0 * scale;',
        '',
        '    float horizontalFade = 1.0 - (cos(uv.x * 6.28) * 0.5 + 0.5);',
        '    float verticalFade = 1.0 - (cos(uv.y * 6.28) * 0.5 + 0.5);',
        '',
        '    space.y += random(space.x * warpFrequency + iTime * warpSpeed) * warpAmplitude * (0.5 + horizontalFade);',
        '    space.x += random(space.y * warpFrequency + iTime * warpSpeed + 2.0) * warpAmplitude * horizontalFade;',
        '',
        '    vec4 lines = vec4(0.0);',
        '    vec4 bgColor1 = vec4(0.06, 0.04, 0.18, 1.0);',
        '    vec4 bgColor2 = vec4(0.18, 0.06, 0.30, 1.0);',
        '',
        '    for(int l = 0; l < linesPerGroup; l++) {',
        '        float normalizedLineIndex = float(l) / float(linesPerGroup);',
        '        float offsetTime = iTime * offsetSpeed;',
        '        float offsetPosition = float(l) + space.x * offsetFrequency;',
        '        float rand = random(offsetPosition + offsetTime) * 0.5 + 0.5;',
        '        float halfWidth = mix(minLineWidth, maxLineWidth, rand * horizontalFade) / 2.0;',
        '        float offset = random(offsetPosition + offsetTime * (1.0 + normalizedLineIndex)) * mix(minOffsetSpread, maxOffsetSpread, horizontalFade);',
        '        float linePosition = getPlasmaY(space.x, horizontalFade, offset);',
        '        float line = drawSmoothLine(linePosition, halfWidth, space.y) / 2.0 + drawCrispLine(linePosition, halfWidth * 0.15, space.y);',
        '',
        '        float circleX = mod(float(l) + iTime * lineSpeed, 25.0) - 12.0;',
        '        vec2 circlePosition = vec2(circleX, getPlasmaY(circleX, horizontalFade, offset));',
        '        float circle = drawCircle(circlePosition, 0.01, space) * 4.0;',
        '',
        '        line = line + circle;',
        '        lines += line * lineColor * rand;',
        '    }',
        '',
        '    fragColor = mix(bgColor1, bgColor2, uv.x);',
        '    fragColor *= verticalFade;',
        '    fragColor.a = 1.0;',
        '    fragColor += lines;',
        '',
        '    gl_FragColor = fragColor;',
        '}'
    ].join('\n');

    // --- Compile shader ---
    function loadShader(type, source) {
        var shader = gl.createShader(type);
        gl.shaderSource(shader, source);
        gl.compileShader(shader);
        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            console.error('Shader compile error:', gl.getShaderInfoLog(shader));
            gl.deleteShader(shader);
            return null;
        }
        return shader;
    }

    var vertexShader = loadShader(gl.VERTEX_SHADER, vsSource);
    var fragmentShader = loadShader(gl.FRAGMENT_SHADER, fsSource);
    if (!vertexShader || !fragmentShader) return;

    var program = gl.createProgram();
    gl.attachShader(program, vertexShader);
    gl.attachShader(program, fragmentShader);
    gl.linkProgram(program);
    if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
        console.error('Shader link error:', gl.getProgramInfoLog(program));
        return;
    }

    // --- Geometry (full-screen quad) ---
    var buffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([
        -1, -1,  1, -1,  -1, 1,  1, 1
    ]), gl.STATIC_DRAW);

    var aPos = gl.getAttribLocation(program, 'aVertexPosition');
    var uRes = gl.getUniformLocation(program, 'iResolution');
    var uTime = gl.getUniformLocation(program, 'iTime');

    // --- Resize canvas to match hero section ---
    var hero = canvas.closest('.hero');
    function resize() {
        var rect = hero.getBoundingClientRect();
        var dpr = Math.min(window.devicePixelRatio || 1, 2); // cap at 2x for performance
        canvas.width = rect.width * dpr;
        canvas.height = rect.height * dpr;
        gl.viewport(0, 0, canvas.width, canvas.height);
    }
    window.addEventListener('resize', resize);
    resize();

    // --- Render loop ---
    var startTime = performance.now();
    var animId;

    function render() {
        var elapsed = (performance.now() - startTime) / 1000;

        gl.clearColor(0, 0, 0, 1);
        gl.clear(gl.COLOR_BUFFER_BIT);
        gl.useProgram(program);

        gl.uniform2f(uRes, canvas.width, canvas.height);
        gl.uniform1f(uTime, elapsed);

        gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
        gl.vertexAttribPointer(aPos, 2, gl.FLOAT, false, 0, 0);
        gl.enableVertexAttribArray(aPos);
        gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);

        animId = requestAnimationFrame(render);
    }

    // Only animate when hero is visible (performance)
    var observer = new IntersectionObserver(function(entries) {
        if (entries[0].isIntersecting) {
            startTime = performance.now() - (startTime ? (performance.now() - startTime) : 0);
            render();
        } else {
            cancelAnimationFrame(animId);
        }
    }, { threshold: 0 });
    observer.observe(hero);
}
