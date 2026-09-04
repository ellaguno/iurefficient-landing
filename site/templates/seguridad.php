<?php /** Seguridad, confidencialidad y privacidad (/seguridad). Variables: $lang, $S, $t, $page */ declare(strict_types=1);
$h = fn(string $k, string $d = '') => iure_h($k, $d);
$faq = iure_faq('seguridad');
$contact = cms_url('page:derecho', $lang) . '/#contacto';
$privacidad = cms_url('item:legal', $lang, 'privacidad');
$emailSec = 'seguridad@iurefficient.com';
$emailReport = 'security@iurefficient.com';
?>
    <!-- Hero -->
    <section class="security-hero">
        <div class="container">
            <h1 data-aos="fade-up"><?= $h('s_hero_title', 'Seguridad, Confidencialidad y <span style="color: var(--accent-400)">Privacidad</span>') ?></h1>
            <p data-aos="fade-up" data-aos-delay="100"><?= cms_e($t('s_hero_text')) ?></p>
<?php if ($t('s_hero_update')): ?>
            <p class="last-update" data-aos="fade-up" data-aos-delay="150"><?= cms_e($t('s_hero_update')) ?></p>
<?php endif; ?>
        </div>
    </section>

    <!-- Table of Contents -->
    <section class="toc-section">
        <div class="container">
            <div class="toc-grid" data-aos="fade-up">
                <a href="#resumen" class="toc-item"><span>📋</span> Resumen Ejecutivo</a>
                <a href="#seguridad-datos" class="toc-item"><span>🔐</span> Seguridad de Datos</a>
                <a href="#confidencialidad" class="toc-item"><span>🤫</span> Confidencialidad</a>
                <a href="#privacidad-ia" class="toc-item"><span>🤖</span> Privacidad e IA</a>
                <a href="#infraestructura" class="toc-item"><span>🏗️</span> Infraestructura</a>
                <a href="#cumplimiento" class="toc-item"><span>⚖️</span> Cumplimiento Legal</a>
                <a href="#derechos" class="toc-item"><span>✋</span> Tus Derechos</a>
                <a href="#faq" class="toc-item"><span>❓</span> Preguntas Frecuentes</a>
            </div>
        </div>
    </section>

    <!-- Executive Summary -->
    <section id="resumen" class="security-overview">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Resumen <span class="gradient-text">Ejecutivo</span></h2>
            </div>

            <div class="tip-box security" data-aos="fade-up">
                <span>🔒</span>
                <div>
                    <h4>Compromiso de Seguridad</h4>
                    <p><strong>Iurefficient</strong> esta diseñado desde su arquitectura para proteger la informacion confidencial de profesionales y sus clientes. A diferencia de servicios de IA genericos, tu informacion <strong>nunca sale de tu control</strong>.</p>
                </div>
            </div>

            <h3 class="section-subtitle" style="text-align: left; margin-top: var(--spacing-2xl);">Puntos Clave de Seguridad</h3>

            <div class="key-points" data-aos="fade-up">
                <div class="key-point"><div class="key-point-header"><span>✅</span><h4>Tus datos son tuyos</h4></div><p>Todos los documentos, conversaciones y analisis permanecen en tu infraestructura.</p></div>
                <div class="key-point"><div class="key-point-header"><span>✅</span><h4>Sin entrenamiento de IA</h4></div><p>Tu informacion nunca se usa para entrenar modelos de inteligencia artificial.</p></div>
                <div class="key-point"><div class="key-point-header"><span>✅</span><h4>Aislamiento por caso</h4></div><p>Cada caso tiene su propia base de conocimiento aislada. Sin mezcla de informacion.</p></div>
                <div class="key-point"><div class="key-point-header"><span>✅</span><h4>Cifrado completo</h4></div><p>Cifrado en transito (TLS 1.3) y en reposo (AES-256) para toda la informacion.</p></div>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="comparison-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Comparacion con Servicios de <span class="gradient-text">IA Publicos</span></h2>
                <p class="section-subtitle">Entiende la diferencia entre usar ChatGPT/Claude.ai directamente vs Iurefficient</p>
            </div>

            <div data-aos="fade-up" style="overflow-x: auto;">
                <table class="comparison-table">
                    <thead><tr><th>Caracteristica</th><th>ChatGPT / Claude.ai</th><th>Iurefficient</th></tr></thead>
                    <tbody>
                        <tr><td class="feature-name">Ubicacion de datos</td><td class="other-services">Servidores de terceros (EE.UU.)</td><td class="iurefficient">Tu infraestructura privada</td></tr>
                        <tr><td class="feature-name">Entrenamiento con tus datos</td><td class="other-services">Posible (segun configuracion)</td><td class="iurefficient">Nunca - solo procesamiento</td></tr>
                        <tr><td class="feature-name">Base de conocimiento</td><td class="other-services">Conocimiento general publico</td><td class="iurefficient">Solo tus documentos (RAG local)</td></tr>
                        <tr><td class="feature-name">Aislamiento de datos</td><td class="other-services">Compartido entre usuarios</td><td class="iurefficient">Aislamiento por caso/cliente</td></tr>
                        <tr><td class="feature-name">Retencion de conversaciones</td><td class="other-services">Segun politicas del proveedor</td><td class="iurefficient">Tu controlas completamente</td></tr>
                        <tr><td class="feature-name">Auditoria y trazabilidad</td><td class="other-services">Limitada</td><td class="iurefficient">Completa con logs detallados</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Data Security Section -->
    <section id="seguridad-datos" class="technical-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Seguridad de <span class="gradient-text">Datos</span></h2>
                <p class="section-subtitle">Detalles tecnicos sobre como protegemos tu informacion</p>
            </div>

            <div class="technical-grid">
                <div class="technical-block" data-aos="fade-up" data-aos-delay="0">
                    <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg> Cifrado y Proteccion</h3>
                    <ul>
                        <li><strong>Cifrado en transito:</strong> TLS 1.3 con certificados SSL validos</li>
                        <li><strong>Cifrado en reposo:</strong> AES-256 para documentos, base de datos y backups</li>
                        <li><strong>Cifrado de archivos (v4.5.0+):</strong> AES-256-GCM con claves derivadas unicas por caso</li>
                        <li><strong>Tokens y credenciales:</strong> Contraseñas hasheadas con bcrypt, JWT con expiracion corta</li>
                        <li>Llaves de cifrado gestionadas de forma segura y separada</li>
                    </ul>
                </div>
                <div class="technical-block" data-aos="fade-up" data-aos-delay="100">
                    <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Control de Acceso</h3>
                    <ul>
                        <li><strong>Autenticacion robusta:</strong> JWT con tokens de corta duracion, soporte OAuth 2.0</li>
                        <li><strong>MFA disponible:</strong> Autenticacion multifactor opcional</li>
                        <li><strong>Roles y permisos:</strong> Sistema granular (Admin, Abogado, Asistente, Solo lectura)</li>
                        <li><strong>Auditoria completa:</strong> Registro de todas las acciones con marcas de tiempo</li>
                        <li>Logs inmutables para cumplimiento regulatorio</li>
                    </ul>
                </div>
                <div class="technical-block" data-aos="fade-up" data-aos-delay="200">
                    <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path d="M9 12l2 2 4-4"/></svg> Respaldos y Recuperacion</h3>
                    <ul>
                        <li>Backups automaticos cada 6 horas</li>
                        <li>Retencion de 30 dias (90 dias en plan Despacho)</li>
                        <li>Backups cifrados y geograficamente distribuidos</li>
                        <li>Pruebas de restauracion mensuales</li>
                        <li>RTO (Recovery Time Objective): &lt; 4 horas</li>
                        <li>RPO (Recovery Point Objective): &lt; 6 horas</li>
                    </ul>
                </div>
                <div class="technical-block" data-aos="fade-up" data-aos-delay="300">
                    <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Monitoreo y Deteccion</h3>
                    <ul>
                        <li>Monitoreo 24/7 de infraestructura</li>
                        <li>Deteccion de anomalias con machine learning</li>
                        <li>Alertas automaticas de actividad sospechosa</li>
                        <li>Logs inmutables de auditoria</li>
                        <li>Pruebas de penetracion anuales</li>
                        <li>Programa de bug bounty</li>
                    </ul>
                </div>
            </div>

            <div class="tip-box info" data-aos="fade-up" style="max-width: 800px; margin: var(--spacing-2xl) auto 0;">
                <span>ℹ️</span>
                <div>
                    <h4>Registro de Auditoria</h4>
                    <p>Puedes acceder al registro de auditoria completo desde <strong>Configuracion → Registros de Auditoria</strong>. Alli veras todas las acciones realizadas en el sistema con marcas de tiempo precisas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidentiality Section -->
    <section id="confidencialidad" class="confidentiality-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Confidencialidad y <span class="gradient-text">Aislamiento</span></h2>
                <p class="section-subtitle">Como garantizamos que la informacion de cada caso permanezca completamente separada</p>
            </div>

            <div class="isolation-cards">
                <div class="isolation-card" data-aos="fade-up" data-aos-delay="0">
                    <h4><span>🏢</span> Arquitectura Multi-Tenant</h4>
                    <ul>
                        <li>Cada organizacion tiene su propia instancia aislada</li>
                        <li>Base de datos separada por tenant</li>
                        <li>Almacenamiento de documentos aislado</li>
                        <li>Indices de busqueda independientes</li>
                    </ul>
                </div>
                <div class="isolation-card" data-aos="fade-up" data-aos-delay="100">
                    <h4><span>📁</span> Aislamiento por Caso</h4>
                    <ul>
                        <li>Cada caso tiene su propia coleccion RAG (base de conocimiento)</li>
                        <li>El chat de IA solo accede a documentos del caso activo</li>
                        <li>Imposibilidad tecnica de "filtracion" entre casos</li>
                        <li>Permisos granulares por caso y usuario</li>
                    </ul>
                </div>
            </div>

            <div class="tip-box security" data-aos="fade-up" style="max-width: 800px; margin: var(--spacing-2xl) auto 0;">
                <span>🔒</span>
                <div>
                    <h4>Secreto Profesional</h4>
                    <p>El diseño de Iurefficient respeta el secreto profesional abogado-cliente. La arquitectura tecnica garantiza que incluso los administradores del sistema no pueden acceder al contenido de los documentos sin autorizacion explicita y registrada.</p>
                </div>
            </div>

            <div class="narrow-block" data-aos="fade-up">
                <h3>Compartir Documentos de Forma Segura</h3>
                <p>Cuando necesites compartir documentos con terceros:</p>
                <ul class="icon-list">
                    <li><span style="color: var(--primary-500);">🔗</span> Enlaces temporales con expiracion configurable</li>
                    <li><span style="color: var(--primary-500);">🔑</span> Proteccion opcional con contraseña</li>
                    <li><span style="color: var(--primary-500);">📊</span> Registro de cada acceso al documento compartido</li>
                    <li><span style="color: var(--primary-500);">⏰</span> Revocacion instantanea del acceso cuando sea necesario</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- AI Privacy Section -->
    <section id="privacidad-ia" class="ai-privacy-section">
        <div class="container">
            <div class="ai-privacy-content">
                <div class="section-header" data-aos="fade-up">
                    <h2 class="section-title" style="color: var(--white);">Privacidad e <span style="color: var(--accent-400);">Inteligencia Artificial</span></h2>
                    <p class="section-subtitle" style="color: rgba(255,255,255,0.8);">Entendemos la diferencia crucial entre servicios de IA genericos y nuestra plataforma</p>
                </div>

                <div class="tip-box warning" data-aos="fade-up" style="background: rgba(254, 243, 199, 0.2); border-color: rgba(252, 211, 77, 0.4);">
                    <span>⚠️</span>
                    <div>
                        <h4 style="color: #fcd34d;">Importante: Diferencia con ChatGPT y Claude.ai</h4>
                        <p style="color: rgba(255,255,255,0.9);">Cuando usas servicios como ChatGPT o Claude.ai directamente, tus conversaciones se envian a servidores de terceros y <em>pueden</em> ser utilizadas para mejorar sus modelos. <strong>Iurefficient funciona diferente:</strong> Tu informacion se procesa localmente y las llamadas a APIs de IA solo envian consultas procesadas, nunca documentos completos ni datos sensibles.</p>
                    </div>
                </div>

                <div class="ai-privacy-grid">
                    <div class="ai-privacy-card" data-aos="fade-up" data-aos-delay="0"><h4><span>🚫</span> Sin entrenamiento externo</h4><p>Tus documentos y conversaciones NUNCA se usan para entrenar modelos de IA de terceros como OpenAI, Google o Anthropic.</p></div>
                    <div class="ai-privacy-card" data-aos="fade-up" data-aos-delay="100"><h4><span>🔐</span> Procesamiento aislado</h4><p>Cada consulta de IA se procesa en un entorno aislado. Los datos se eliminan de la memoria inmediatamente despues del procesamiento.</p></div>
                    <div class="ai-privacy-card" data-aos="fade-up" data-aos-delay="200"><h4><span>📍</span> Servidores Privados</h4><p>Toda la infraestructura corre en servidores privados dedicados, cumpliendo con las regulaciones de proteccion de datos aplicables.</p></div>
                    <div class="ai-privacy-card" data-aos="fade-up" data-aos-delay="300"><h4><span>🗑️</span> Sin retencion</h4><p>No almacenamos el contenido de tus consultas de IA mas alla del tiempo necesario para procesarlas y mostrarte la respuesta.</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- RAG System -->
    <section class="rag-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">¿Como Funciona la <span class="gradient-text">IA en Iurefficient</span>?</h2>
                <p class="section-subtitle">Sistema RAG (Retrieval-Augmented Generation)</p>
            </div>

            <div class="rag-flow" data-aos="fade-up">
                <div class="rag-steps">
                    <div class="rag-step"><div class="rag-step-number">1</div><div class="rag-step-content"><h4>Indexacion Local</h4><p>Tus documentos se procesan y almacenan en una base de datos vectorial <strong>dentro de tu infraestructura</strong>. Los embeddings (representaciones numericas) se generan localmente o mediante APIs que no retienen datos.</p></div></div>
                    <div class="rag-step"><div class="rag-step-number">2</div><div class="rag-step-content"><h4>Busqueda Semantica Local</h4><p>Cuando haces una pregunta, el sistema busca en TU base de conocimiento local los fragmentos mas relevantes. Esta busqueda ocurre completamente en tu servidor.</p></div></div>
                    <div class="rag-step"><div class="rag-step-number">3</div><div class="rag-step-content"><h4>Consulta a IA con Contexto Limitado</h4><p>Solo los fragmentos relevantes (sin identificadores de clientes ni datos sensibles directos) se envian a la API de IA junto con tu pregunta. La IA genera una respuesta basada en ese contexto especifico.</p></div></div>
                    <div class="rag-step"><div class="rag-step-number">4</div><div class="rag-step-content"><h4>Respuesta con Citas</h4><p>La respuesta incluye referencias [1], [2], etc. a los documentos originales, permitiendote verificar la fuente de cada afirmacion.</p></div></div>
                </div>
            </div>

            <div class="section-header" data-aos="fade-up" style="margin-top: var(--spacing-4xl);">
                <h3 class="section-title" style="font-size: 1.5rem;">Politicas de los <span class="gradient-text">Proveedores de IA</span></h3>
                <p class="section-subtitle">Todos los proveedores seleccionados tienen politicas de no-entrenamiento con datos de API</p>
            </div>

            <div class="ai-providers-grid" data-aos="fade-up">
                <div class="ai-provider-card"><h4><span style="color: #10b981;">🟢</span> OpenAI (API)</h4><p>"We do not train on your business data (data sent through the API)"</p><a href="https://openai.com/enterprise-privacy" target="_blank" rel="noopener noreferrer">Ver politica de privacidad empresarial →</a></div>
                <div class="ai-provider-card"><h4><span style="color: #10b981;">🟢</span> Anthropic (Claude API)</h4><p>"We do not train our models on customer API data"</p><a href="https://www.anthropic.com/policies/privacy-policy" target="_blank" rel="noopener noreferrer">Ver politica de privacidad →</a></div>
                <div class="ai-provider-card"><h4><span style="color: #10b981;">🟢</span> OpenRouter</h4><p>Enrutador que respeta las politicas de privacidad de cada modelo subyacente.</p><a href="https://openrouter.ai/privacy" target="_blank" rel="noopener noreferrer">Ver politica →</a></div>
                <div class="ai-provider-card"><h4><span style="color: #10b981;">🟢</span> DeepSeek / Qwen</h4><p>APIs empresariales con politicas de no-retencion de datos.</p></div>
            </div>

            <div class="tip-box success" data-aos="fade-up" style="max-width: 800px; margin: var(--spacing-2xl) auto 0;">
                <span>✅</span>
                <div>
                    <h4>Garantia Anti-Entrenamiento</h4>
                    <p>Ningun proveedor de IA que utiliza Iurefficient entrena sus modelos con los datos enviados a traves de sus APIs empresariales. Esta es una garantia contractual de cada proveedor.</p>
                </div>
            </div>

            <div class="narrow-block" data-aos="fade-up" style="margin-top: var(--spacing-3xl);">
                <h3>Sistema Anti-Alucinacion</h3>
                <p>Iurefficient implementa multiples capas de proteccion contra "alucinaciones" de la IA (informacion inventada):</p>
                <ul class="icon-list">
                    <li><span style="color: var(--success-500);">✓</span> Respuestas basadas <strong>unicamente</strong> en tus documentos, no en conocimiento general</li>
                    <li><span style="color: var(--success-500);">✓</span> Citas numeradas [1], [2] que puedes verificar</li>
                    <li><span style="color: var(--success-500);">✓</span> Indicadores de confianza (excelente, alto, moderado, bajo)</li>
                    <li><span style="color: var(--success-500);">✓</span> Alertas cuando no hay informacion suficiente para responder</li>
                    <li><span style="color: var(--success-500);">✓</span> Validacion automatica de respuestas para detectar posibles alucinaciones</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Infrastructure Section -->
    <section id="infraestructura" class="infrastructure-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Infraestructura <span class="gradient-text">Tecnica</span></h2>
                <p class="section-subtitle">Despliegue seguro con multiples opciones</p>
            </div>

            <div class="deploy-options">
                <div class="deploy-card" data-aos="fade-up" data-aos-delay="0"><span>🏠</span><h4>On-Premise</h4><p>Instalacion en tus propios servidores. Maximo control y cumplimiento con politicas internas de seguridad.</p></div>
                <div class="deploy-card" data-aos="fade-up" data-aos-delay="100"><span>☁️</span><h4>Cloud Privado</h4><p>Despliegue en tu cuenta de AWS, Azure o GCP. Beneficios del cloud con control total.</p></div>
                <div class="deploy-card" data-aos="fade-up" data-aos-delay="200"><span>🌍</span><h4>Cloud Administrado</h4><p>Nosotros gestionamos la infraestructura con SLAs de seguridad y disponibilidad garantizados.</p></div>
            </div>

            <div class="infra-visual" data-aos="fade-up">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: var(--spacing-lg); text-align: center;">Capas de Proteccion</h3>
                <div class="infra-layers">
                    <div class="infra-layer"><span class="layer-icon">🌐</span><div class="layer-content"><h4>CDN &amp; WAF</h4><p>Cloudflare Enterprise con proteccion DDoS, firewall de aplicaciones web y rate limiting</p></div></div>
                    <div class="infra-layer"><span class="layer-icon">🔒</span><div class="layer-content"><h4>Load Balancer con SSL</h4><p>Terminacion SSL/TLS 1.3, certificados renovados automaticamente, HSTS habilitado</p></div></div>
                    <div class="infra-layer"><span class="layer-icon">🖥️</span><div class="layer-content"><h4>Servidores de Aplicacion</h4><p>Contenedores aislados en Kubernetes, auto-scaling, actualizaciones sin downtime</p></div></div>
                    <div class="infra-layer"><span class="layer-icon">🗄️</span><div class="layer-content"><h4>Base de Datos</h4><p>MySQL/PostgreSQL con cifrado en reposo, replicas en tiempo real, backups automaticos</p></div></div>
                    <div class="infra-layer"><span class="layer-icon">📁</span><div class="layer-content"><h4>Almacenamiento de Archivos</h4><p>Object storage cifrado con AES-256-GCM, redundancia geografica, versionado automatico</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Compliance Section -->
    <section id="cumplimiento" class="compliance-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Cumplimiento <span class="gradient-text">Legal</span></h2>
                <p class="section-subtitle">Nuestros estandares y compromisos de seguridad</p>
            </div>

            <div class="compliance-grid">
                <div class="compliance-badge" data-aos="fade-up" data-aos-delay="0"><div class="badge-icon">🔐</div><h4>SSL/TLS</h4><p>Cifrado en transito con TLS 1.2/1.3</p></div>
                <div class="compliance-badge" data-aos="fade-up" data-aos-delay="50"><div class="badge-icon">🛡️</div><h4>Controles Enterprise</h4><p>Controles de seguridad de nivel empresarial</p></div>
                <div class="compliance-badge" data-aos="fade-up" data-aos-delay="100"><div class="badge-icon">🌐</div><h4>GDPR Ready</h4><p>Arquitectura preparada para regulacion europea</p></div>
                <div class="compliance-badge" data-aos="fade-up" data-aos-delay="150"><div class="badge-icon">☁️</div><h4>Basado en ISO 27001</h4><p>Practicas alineadas al estandar internacional</p></div>
                <div class="compliance-badge" data-aos="fade-up" data-aos-delay="200"><div class="badge-icon">🏛️</div><h4>Secreto Profesional</h4><p>Diseñado para cumplir con etica legal</p></div>
            </div>

            <div class="narrow-block" data-aos="fade-up">
                <h3>Secreto Profesional</h3>
                <p>Iurefficient esta diseñado para respetar las obligaciones de secreto profesional de abogados, contadores y otros profesionales:</p>
                <ul class="icon-list">
                    <li><span style="color: var(--success-500);">✓</span> Aislamiento tecnico que impide acceso no autorizado a expedientes</li>
                    <li><span style="color: var(--success-500);">✓</span> Cifrado que protege la informacion incluso de administradores de sistemas</li>
                    <li><span style="color: var(--success-500);">✓</span> Logs de auditoria para demostrar cumplimiento</li>
                    <li><span style="color: var(--success-500);">✓</span> Contratos de confidencialidad con proveedores de servicios</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ARCO Rights Section -->
    <section id="derechos" class="arco-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Tus <span class="gradient-text">Derechos</span></h2>
                <p class="section-subtitle">Derechos ARCO+ (Acceso, Rectificacion, Cancelacion, Oposicion)</p>
            </div>

            <div class="arco-grid">
                <div class="arco-card" data-aos="fade-up" data-aos-delay="0"><span>👁️</span><div><h4>Acceso</h4><p>Puedes solicitar una copia de todos tus datos personales almacenados en el sistema.</p></div></div>
                <div class="arco-card" data-aos="fade-up" data-aos-delay="50"><span>✏️</span><div><h4>Rectificacion</h4><p>Puedes corregir cualquier dato personal inexacto o incompleto.</p></div></div>
                <div class="arco-card" data-aos="fade-up" data-aos-delay="100"><span>🗑️</span><div><h4>Cancelacion (Eliminacion)</h4><p>Puedes solicitar la eliminacion de tus datos cuando ya no sean necesarios.</p></div></div>
                <div class="arco-card" data-aos="fade-up" data-aos-delay="150"><span>🚫</span><div><h4>Oposicion</h4><p>Puedes oponerte al tratamiento de tus datos para fines especificos.</p></div></div>
                <div class="arco-card" data-aos="fade-up" data-aos-delay="200"><span>📦</span><div><h4>Portabilidad</h4><p>Puedes solicitar tus datos en formato estructurado para transferirlos a otro servicio.</p></div></div>
            </div>

            <div class="tip-box info" data-aos="fade-up" style="max-width: 800px; margin: var(--spacing-2xl) auto 0;">
                <span>ℹ️</span>
                <div>
                    <h4>¿Como ejercer estos derechos?</h4>
                    <p>Contacta al administrador de tu organizacion o envia una solicitud a traves de la seccion de <strong>Perfil → Privacidad</strong>. Responderemos en un plazo maximo de 20 dias habiles.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
<?php if ($faq): ?>
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?= $h('s_faq_title', 'Preguntas <span class="gradient-text">Frecuentes</span>') ?></h2>
            </div>

            <div class="faq-list" data-aos="fade-up">
<?php foreach ($faq as $q): ?>
                <details class="faq-item">
                    <summary><?= cms_e($q['title'] ?? '') ?></summary>
                    <div class="faq-answer"><?= cms_content((string) ($q['answer'] ?? '')) ?></div>
                </details>
<?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- Contact Security Team -->
    <section class="contact-security">
        <div class="container">
            <div class="contact-security-card" data-aos="fade-up">
                <h3><span>📧</span> <?= cms_e($t('s_contact_title', '¿Tienes mas preguntas?')) ?></h3>
                <p><?= cms_e($t('s_contact_text')) ?></p>
                <div class="contact-buttons">
                    <a href="mailto:<?= $emailSec ?>" class="primary"><span>✉️</span> <?= $emailSec ?></a>
                    <a href="<?= cms_e($privacidad) ?>" class="secondary"><span>📄</span> Aviso de Privacidad</a>
                </div>
                <p style="margin-top: var(--spacing-md); font-size: 0.875rem; color: var(--gray-500);">
                    <?= cms_e($t('s_contact_report', 'Para reportar vulnerabilidades:')) ?> <a href="mailto:<?= $emailReport ?>" style="color: var(--primary-500);"><?= $emailReport ?></a>
                </p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2><?= cms_e($t('s_cta_title', 'Tu informacion esta segura con nosotros')) ?></h2>
                <p><?= cms_e($t('s_cta_text')) ?></p>
                <a href="<?= cms_e($contact) ?>" class="btn btn-primary btn-lg"><?= cms_e($t('s_cta_button', 'Comenzar prueba gratuita')) ?></a>
            </div>
        </div>
    </section>
