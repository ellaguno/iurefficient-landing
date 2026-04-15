<!-- CTA Section -->
<section class="cta" id="contacto">
    <!-- Animated gradient background -->
    <svg class="cta-svg-filter" aria-hidden="true">
        <defs>
            <filter id="cta-goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -8" result="goo"/>
                <feBlend in="SourceGraphic" in2="goo"/>
            </filter>
        </defs>
    </svg>
    <div class="cta-gradients" aria-hidden="true">
        <div class="cta-blob cta-blob--1"></div>
        <div class="cta-blob cta-blob--2"></div>
        <div class="cta-blob cta-blob--3"></div>
        <div class="cta-blob cta-blob--4"></div>
        <div class="cta-blob cta-blob--5"></div>
        <div class="cta-blob cta-blob--pointer"></div>
    </div>

    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>¿Listo para transformar tu práctica legal?</h2>
            <p>Únete a cientos de abogados que ya optimizaron su trabajo</p>

            <form class="cta-form" id="contactForm">
                <div class="form-row">
                    <input type="text" name="nombre" placeholder="Tu nombre" required>
                    <input type="email" name="email" placeholder="Tu email" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="telefono" placeholder="Tu teléfono (opcional)">
                    <select name="tamano">
                        <option value="">Tamaño de tu despacho</option>
                        <option value="1">Solo yo</option>
                        <option value="2-5">2-5 abogados</option>
                        <option value="6-20">6-20 abogados</option>
                        <option value="20+">Más de 20</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Solicitar Demo Gratuita
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>

            <p class="cta-note">Sin compromiso • Setup en 24 horas • Soporte incluido</p>
        </div>
    </div>
</section>
