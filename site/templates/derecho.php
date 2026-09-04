<?php /** Landing para abogados (/derecho). Variables: $lang, $S, $t, $page */ declare(strict_types=1);
$h = fn(string $k, string $d = '') => iure_h($k, $d);
$mockup = iure_img((string) ($S['dashboard_mockup'] ?? ''), 'dashboard-mockup.png');
$shots = iure_screenshots();
$planes = iure_planes('derecho');
$equipo = cms_items('equipo');
$precios = cms_url('page:precios', $lang) . '/';
$seguridad = cms_url('page:seguridad', $lang) . '/';
?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg"></div>
        <canvas id="hero-shader" aria-hidden="true"></canvas>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title"><?= $h('d_hero_title', 'El derecho <span class="gradient-text">a un click</span> de distancia') ?></h1>
                <p class="hero-subtitle"><?= $h('d_hero_subtitle') ?></p>
                <div class="hero-ctas">
                    <a href="#contacto" class="btn btn-primary btn-lg">
                        <?= cms_e($t('d_hero_cta1', 'Solicitar Demo Gratuita')) ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
<?php if (iure_link('youtube_why_url')): ?>
                    <a href="<?= cms_e(iure_link('youtube_why_url')) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-youtube btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        <?= cms_e($t('d_hero_cta_youtube', '¿Por qué usar Iurefficient?')) ?>
                    </a>
<?php endif; ?>
                    <a href="#video" class="btn btn-secondary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        <?= cms_e($t('d_hero_cta2', 'Ver cómo funciona')) ?>
                    </a>
                </div>
            </div>

            <div class="hero-image" data-aos="fade-up" data-aos-delay="200">
                <div class="hero-mockup">
                    <img src="<?= cms_e($mockup) ?>" alt="Dashboard de Iurefficient">
                </div>
            </div>

            <div class="hero-social-proof" data-aos="fade-up" data-aos-delay="400">
                <div class="trust-badges">
                    <div class="trust-badge"><span class="trust-icon">🔒</span><span>Cifrado AES-256</span></div>
                    <div class="trust-badge"><span class="trust-icon">🔐</span><span>Servidores Privados</span></div>
                    <div class="trust-badge"><span class="trust-icon">⚡</span><span>99.9% Uptime</span></div>
                    <div class="trust-badge"><span class="trust-icon">🛡️</span><span>Seguridad Enterprise</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem/Solution Section -->
    <section class="problem-solution" id="problema">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_problem_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_problem_subtitle')) ?></p>
            </div>

            <div class="comparison-grid">
                <div class="comparison-card comparison-before" data-aos="fade-right">
                    <div class="comparison-header"><span class="comparison-icon">😫</span><h3>Sin Iurefficient</h3></div>
                    <ul class="comparison-list">
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Documentos dispersos en carpetas y mails</li>
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Plazos que se olvidan hasta el último momento</li>
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Horas buscando información en expedientes</li>
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Trabajo repetitivo que consume tu tiempo</li>
                    </ul>
                </div>

                <div class="comparison-arrow" data-aos="zoom-in">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>

                <div class="comparison-card comparison-after" data-aos="fade-left">
                    <div class="comparison-header"><span class="comparison-icon">😊</span><h3>Con Iurefficient</h3></div>
                    <ul class="comparison-list">
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Todo centralizado en una plataforma segura</li>
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Alertas automáticas de fechas importantes</li>
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> IA que encuentra lo que necesitas en segundos</li>
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Automatización que te libera para lo importante</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="caracteristicas">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_features_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_features_subtitle')) ?></p>
            </div>

            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                    <h3>Gestión Inteligente de Documentos</h3>
                    <p>Organiza, busca y analiza documentos legales con IA. Extrae cláusulas clave automáticamente.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></div>
                    <h3>Control Total de Clientes y Casos</h3>
                    <p>Centraliza expedientes, seguimiento de casos y comunicación con clientes en un solo lugar.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2a2 2 0 012 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 017 7h1a1 1 0 011 1v3a1 1 0 01-1 1h-1v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1H2a1 1 0 01-1-1v-3a1 1 0 011-1h1a7 7 0 017-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 012-2z"/><circle cx="9" cy="14" r="1"/><circle cx="15" cy="14" r="1"/></svg></div>
                    <h3>Asistente de IA Legal</h3>
                    <p>Pregunta en lenguaje natural sobre tus casos. Obtén respuestas basadas en tus documentos.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/></svg></div>
                    <h3>Calendario Legal Inteligente</h3>
                    <p>Nunca pierdas un término. Alertas automáticas de audiencias, vencimientos y fechas clave.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section" id="video">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_video_title', 'Mira Iurefficient <span class="gradient-text">en acción</span>') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_video_subtitle', 'Descubre cómo puedes ahorrar hasta 70% de tu tiempo')) ?></p>
            </div>
            <div class="video-wrapper" data-aos="zoom-in">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/<?= cms_e(iure_link('youtube_video_id')) ?>" title="Iurefficient - Beneficios" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots 3D Gallery -->
    <section class="screenshots" id="plataforma">
        <div class="gallery3d-wrapper" data-aos="fade-up">
            <div class="gallery3d-header">
                <h2 class="section-title"><?= $h('d_gallery_title', 'Conoce la <span class="gradient-text">plataforma</span>') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_gallery_subtitle', 'Una interfaz intuitiva diseñada para abogados')) ?></p>
            </div>
            <canvas id="gallery3d-canvas" data-images="<?= cms_e(implode(',', $shots)) ?>"></canvas>
            <div class="gallery3d-overlay">
                <p class="gallery3d-hint">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                    <?= cms_e($t('d_gallery_hint', 'Usa el scroll para explorar')) ?>
                </p>
            </div>
            <noscript>
                <div class="gallery3d-fallback">
<?php foreach ($shots as $i => $src): ?>
                    <img src="<?= cms_e($src) ?>" alt="Captura <?= $i + 1 ?>">
<?php endforeach; ?>
                </div>
            </noscript>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_benefits_title', 'Resultados que <span class="gradient-text">transforman</span>') ?></h2>
            </div>

            <div class="benefits-grid">
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="benefit-icon">⏱️</div>
                    <div class="benefit-content"><h4>Ahorra hasta 70% de tu tiempo</h4><p>En tareas administrativas y búsqueda de información</p></div>
                </div>
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="benefit-icon">📈</div>
                    <div class="benefit-content"><h4>Aumenta tu productividad 3x</h4><p>Más casos atendidos con la misma calidad y en menos tiempo</p></div>
                </div>
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="benefit-icon">🔒</div>
                    <div class="benefit-content"><h4>Seguridad de nivel bancario</h4><p>Tus datos y los de tus clientes siempre protegidos</p></div>
                </div>
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="benefit-icon">💡</div>
                    <div class="benefit-content"><h4>Decisiones informadas</h4><p>Datos y métricas de tu práctica en tiempo real</p></div>
                </div>
                <div class="benefit-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="benefit-icon">🎯</div>
                    <div class="benefit-content"><h4>Enfócate en tus clientes</h4><p>Dedica tu tiempo a lo que realmente importa</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="security" id="seguridad">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_security_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_security_subtitle')) ?></p>
            </div>

            <div class="security-grid">
                <div class="security-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>
                    <h4>Cifrado AES-256</h4>
                    <p>Todos tus documentos y conversaciones cifrados en reposo y en tránsito</p>
                </div>
                <div class="security-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <h4>Google Cloud Platform</h4>
                    <p>Infraestructura alojada en Google Cloud con controles de seguridad empresarial</p>
                </div>
                <div class="security-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path d="M9 12l2 2 4-4"/></svg></div>
                    <h4>Backups Automáticos</h4>
                    <p>Respaldos diarios con retención de 30 días para tu tranquilidad</p>
                </div>
                <div class="security-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                    <h4>Privacidad de IA</h4>
                    <p>Tus documentos nunca se usan para entrenar modelos externos</p>
                </div>
            </div>

            <div class="security-standards" data-aos="fade-up">
                <h4><?= cms_e($t('d_security_standards_title', 'Nuestros estándares de seguridad')) ?></h4>
                <div class="standards-logos">
                    <div class="standard-badge"><span class="standard-icon">🔐</span><span>SSL/TLS</span></div>
                    <div class="standard-badge"><span class="standard-icon">🛡️</span><span>Controles Enterprise</span></div>
                    <div class="standard-badge"><span class="standard-icon">🌐</span><span>GDPR Ready</span></div>
                    <div class="standard-badge"><span class="standard-icon">☁️</span><span>Basado en ISO 27001</span></div>
                </div>
                <a href="<?= $seguridad ?>" class="btn btn-outline"><?= cms_e($t('d_security_more', 'Conoce más sobre nuestra seguridad')) ?></a>
            </div>
        </div>
    </section>

    <!-- Team Section -->
<?php if ($equipo): ?>
    <section class="team" id="equipo">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_team_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_team_subtitle')) ?></p>
            </div>

            <div class="team-grid">
<?php $i = 0; foreach ($equipo as $m): $photo = iure_img((string) ($m['photo'] ?? ''), (string) ($S['team_placeholder'] ?? '')); ?>
                <div class="team-member" data-aos="fade-up" data-aos-delay="<?= $i++ * 100 ?>">
                    <div class="member-photo"><?php if ($photo): ?><img src="<?= cms_e($photo) ?>" alt="<?= cms_e($m['title'] ?? '') ?>"><?php endif; ?></div>
                    <h4><?= cms_e($m['title'] ?? '') ?></h4>
                    <p class="member-role"><?= cms_e($m['role'] ?? '') ?></p>
                    <p class="member-bio"><?= cms_e($m['bio'] ?? '') ?></p>
                </div>
<?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- Pricing Section -->
    <section class="pricing" id="precios">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('d_pricing_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('d_pricing_subtitle', 'Sin contratos forzosos. Cancela cuando quieras.')) ?></p>
            </div>

            <div class="pricing-grid">
<?php foreach ($planes as $i => $p) echo iure_plan_card($p, $i * 100), "\n"; ?>
            </div>

            <div class="pricing-footer" data-aos="fade-up">
                <p>¿Necesitas algo diferente? <a href="<?= $precios ?>"><?= cms_e($t('d_pricing_footer', 'Ver comparativa completa de planes')) ?></a></p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="contacto">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2><?= cms_e($t('d_cta_title', '¿Listo para transformar tu práctica legal?')) ?></h2>
                <p><?= cms_e($t('d_cta_text', 'Únete a cientos de abogados que ya optimizaron su trabajo')) ?></p>

                <?= iure_contact_form('derecho', (string) $t('d_cta_button', 'Solicitar Demo Gratuita')) ?>

                <p class="cta-note"><?= cms_e($t('d_cta_note', 'Sin compromiso • Setup en 24 horas • Soporte incluido')) ?></p>
            </div>
        </div>
    </section>
