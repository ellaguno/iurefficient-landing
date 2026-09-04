<?php /** Portada: Iurefficient Teams. Variables: $lang, $S, $t, $page */ declare(strict_types=1);
$h = fn(string $k, string $d = '') => iure_h($k, $d);
$mockup = iure_img((string) ($S['dashboard_mockup'] ?? ''), 'dashboard-mockup.png');
$shots = iure_screenshots();
$planes = iure_planes('teams');
?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg"></div>
        <canvas id="hero-shader"></canvas>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title"><?= $h('t_hero_title', 'El plan de proyecto <span class="gradient-text">no se escribe</span>, se conversa') ?></h1>
                <p class="hero-subtitle"><?= $h('t_hero_subtitle') ?></p>
                <div class="hero-ctas">
                    <a href="#contacto" class="btn btn-primary btn-lg">
                        <?= cms_e($t('t_hero_cta1', 'Probar gratis 14 dias')) ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="#video" class="btn btn-secondary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"/>
                        </svg>
                        <?= cms_e($t('t_hero_cta2', 'Ver como funciona')) ?>
                    </a>
                </div>
            </div>

            <div class="hero-image" data-aos="fade-up" data-aos-delay="200">
                <div class="hero-mockup">
                    <img src="<?= cms_e($mockup) ?>" alt="Dashboard de Iurefficient Teams">
                </div>
            </div>

            <div class="hero-social-proof" data-aos="fade-up" data-aos-delay="400">
                <div class="trust-badges">
                    <div class="trust-badge"><span class="trust-icon">🤖</span><span>IA Nativa</span></div>
                    <div class="trust-badge"><span class="trust-icon">📊</span><span>Kanban + Gantt</span></div>
                    <div class="trust-badge"><span class="trust-icon">⚡</span><span>Plan en minutos</span></div>
                    <div class="trust-badge"><span class="trust-icon">🔒</span><span>Seguridad Enterprise</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pain Points Section -->
    <section class="problem-solution" id="problema">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_problem_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_problem_subtitle')) ?></p>
            </div>

            <div class="comparison-grid">
                <div class="comparison-card comparison-before" data-aos="fade-right">
                    <div class="comparison-header">
                        <span class="comparison-icon">😫</span>
                        <h3>Sin Iurefficient Teams</h3>
                    </div>
                    <ul class="comparison-list">
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Hojas de Excel interminables que nadie actualiza</li>
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Reuniones de 40 minutos para definir quien hace que</li>
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Fechas limite que se cruzan sin aviso</li>
                        <li><svg class="icon-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg> Dependencias invisibles hasta que algo se atrasa</li>
                    </ul>
                </div>

                <div class="comparison-arrow" data-aos="zoom-in">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>

                <div class="comparison-card comparison-after" data-aos="fade-left">
                    <div class="comparison-header">
                        <span class="comparison-icon">😊</span>
                        <h3>Con Iurefficient Teams</h3>
                    </div>
                    <ul class="comparison-list">
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Un plan ejecutable generado por IA en minutos</li>
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Tareas y responsables asignados automaticamente</li>
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Calendario que se ajusta cuando algo cambia</li>
                        <li><svg class="icon-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg> Dependencias visibles y alertas en tiempo real</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Solution Section -->
    <section class="features" id="solucion">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_solution_title') ?></h2>
                <p class="section-subtitle"><?= $h('t_solution_subtitle') ?></p>
            </div>

            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    </div>
                    <h3>Chatea con iure</h3>
                    <p>Dile que necesitas. La IA te devuelve tareas, subtareas y dependencias listas para ejecutar.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                        </svg>
                    </div>
                    <h3>Calendario inteligente</h3>
                    <p>Arrastra automaticamente las fechas cuando algo cambia. Sin sorpresas ni cruces de agenda.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                    </div>
                    <h3>Kanban y Gantt vivos</h3>
                    <p>Visualiza el proyecto como quieras. Ambas vistas siempre sincronizadas en tiempo real.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"/></svg>
                    </div>
                    <h3>Adjuntos y comentarios</h3>
                    <p>Todo el contexto de la tarea en un solo lugar. Sin buscar en correos ni carpetas compartidas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section" id="video">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_video_title', 'Mira Iurefficient <span class="gradient-text">en acción</span>') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_video_subtitle', 'Descubre cómo puedes ahorrar hasta 70% de tu tiempo')) ?></p>
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
                <h2 class="section-title"><?= $h('t_gallery_title', 'Conoce la <span class="gradient-text">plataforma</span>') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_gallery_subtitle')) ?></p>
            </div>
            <canvas id="gallery3d-canvas" data-images="<?= cms_e(implode(',', $shots)) ?>"></canvas>
            <div class="gallery3d-overlay">
                <p class="gallery3d-hint">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
                    <?= cms_e($t('t_gallery_hint', 'Usa el scroll para explorar')) ?>
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

    <!-- Audience Section -->
    <section class="benefits" id="equipos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_audience_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_audience_subtitle')) ?></p>
            </div>

            <div class="audience-grid" data-aos="fade-up">
                <div class="audience-card">
                    <div class="audience-icon">🏗️</div>
                    <h4>Constructoras e ingenieria</h4>
                    <p>Oficinas de proyectos (PMO) que coordinan multiples obras o iniciativas simultaneas.</p>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">📈</div>
                    <h4>Marketing y producto</h4>
                    <p>Equipos que lanzan campanas, productos y necesitan visibilidad del progreso en tiempo real.</p>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">🏢</div>
                    <h4>Consultoras</h4>
                    <p>Firmas que gestionan multiples iniciativas con clientes y necesitan orden sin burocracia.</p>
                </div>
                <div class="audience-card">
                    <div class="audience-icon">🎓</div>
                    <h4>Coordinadores academicos</h4>
                    <p>Equipos de investigacion y coordinacion academica con plazos y entregables complejos.</p>
                </div>
            </div>

<?php if ($t('t_testimonial')): ?>
            <blockquote class="teams-testimonial" data-aos="fade-up">
                <?= cms_e($t('t_testimonial')) ?>
                <cite><?= cms_e($t('t_testimonial_cite')) ?></cite>
            </blockquote>
<?php endif; ?>
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="security" id="comparativa">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_compare_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_compare_subtitle')) ?></p>
            </div>

            <div class="comparison-table-wrapper" data-aos="fade-up">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Caracteristica</th>
                            <th>Monday / Asana / Jira</th>
                            <th>Iurefficient Teams</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Creacion del plan</td><td data-label="Monday / Asana / Jira">Manual, tarea por tarea</td><td data-label="Iurefficient Teams">Conversacional, en minutos</td></tr>
                        <tr><td>IA integrada</td><td data-label="Monday / Asana / Jira">Parche sobre producto anterior</td><td data-label="Iurefficient Teams">Nativa, entiende dependencias y fechas</td></tr>
                        <tr><td>Precio (equipo de 8)</td><td data-label="Monday / Asana / Jira">~$10,000-15,000 MXN/mes</td><td data-label="Iurefficient Teams">Desde $1,499 MXN/mes</td></tr>
                        <tr><td>Enfoque real</td><td data-label="Monday / Asana / Jira">Generalista, requiere configuracion</td><td data-label="Iurefficient Teams">Listo para PMO sin curva de aprendizaje</td></tr>
                        <tr><td>Asistente de IA</td><td data-label="Monday / Asana / Jira">Funciones basicas, limitadas</td><td data-label="Iurefficient Teams">iure: genera planes completos desde chat</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="precios">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_pricing_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_pricing_subtitle', 'Sin contratos forzosos. Cancela cuando quieras.')) ?></p>
            </div>

            <div class="pricing-grid">
<?php foreach ($planes as $i => $p) echo iure_plan_card($p, $i * 100), "\n"; ?>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="security" id="seguridad">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('t_security_title') ?></h2>
                <p class="section-subtitle"><?= cms_e($t('t_security_subtitle')) ?></p>
            </div>

            <div class="security-grid">
                <div class="security-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>
                    <h4>Cifrado AES-256</h4>
                    <p>Todos tus documentos y datos de proyecto cifrados en reposo y en transito</p>
                </div>
                <div class="security-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <h4>Google Cloud Platform</h4>
                    <p>Infraestructura alojada en Google Cloud con controles de seguridad empresarial</p>
                </div>
                <div class="security-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path d="M9 12l2 2 4-4"/></svg></div>
                    <h4>Backups Automaticos</h4>
                    <p>Respaldos diarios con retencion de 30 dias para tu tranquilidad</p>
                </div>
                <div class="security-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="security-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                    <h4>Privacidad de IA</h4>
                    <p>Tus documentos nunca se usan para entrenar modelos externos</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="contacto">
        <div class="cta-gradient-bg">
            <div class="cta-blob cta-blob--1"></div>
            <div class="cta-blob cta-blob--2"></div>
            <div class="cta-blob cta-blob--pointer"></div>
        </div>
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2><?= cms_e($t('t_cta_title', 'Listo para que tu proximo plan de proyecto se haga en una conversacion?')) ?></h2>

                <?= iure_contact_form('teams', (string) $t('t_cta_button', 'Quiero ser early adopter')) ?>

                <p class="cta-note"><?= cms_e($t('t_cta_note', 'Sin compromiso - 14 dias gratis - Soporte incluido')) ?></p>
            </div>
        </div>
    </section>
