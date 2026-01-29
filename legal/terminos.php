<?php
$base_path = '../';
$current_page = 'legal';
$page_title = 'Términos y Condiciones - Iurefficient';
$page_description = 'Términos y Condiciones de uso de Iurefficient. Conoce las reglas que rigen el uso de nuestra plataforma.';
$extra_css = [];
$extra_scripts = [];
$page_styles = <<<'CSS'
        .legal-page {
            padding: calc(80px + var(--spacing-3xl)) 0 var(--spacing-4xl);
        }

        .legal-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .legal-header {
            margin-bottom: var(--spacing-3xl);
            padding-bottom: var(--spacing-2xl);
            border-bottom: 1px solid var(--gray-200);
        }

        .legal-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: var(--spacing-md);
        }

        .legal-meta {
            color: var(--gray-500);
            font-size: 0.9375rem;
        }

        .legal-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-top: var(--spacing-3xl);
            margin-bottom: var(--spacing-md);
        }

        .legal-content h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-top: var(--spacing-xl);
            margin-bottom: var(--spacing-sm);
        }

        .legal-content p {
            color: var(--gray-600);
            margin-bottom: var(--spacing-md);
            line-height: 1.7;
        }

        .legal-content ul, .legal-content ol {
            color: var(--gray-600);
            margin-bottom: var(--spacing-md);
            padding-left: var(--spacing-xl);
        }

        .legal-content li {
            margin-bottom: var(--spacing-sm);
            line-height: 1.7;
        }

        .legal-content a {
            color: var(--primary-500);
        }

        .legal-content a:hover {
            text-decoration: underline;
        }

        .legal-toc {
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-3xl);
        }

        .legal-toc h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-md);
        }

        .legal-toc ol {
            padding-left: var(--spacing-lg);
        }

        .legal-toc li {
            margin-bottom: var(--spacing-xs);
        }

        .legal-toc a {
            color: var(--gray-600);
            font-size: 0.9375rem;
        }

        .highlight-box {
            background: var(--primary-50, #eef2ff);
            border-left: 4px solid var(--primary-500);
            padding: var(--spacing-lg);
            margin: var(--spacing-xl) 0;
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }

        .highlight-box p {
            margin-bottom: 0;
            color: var(--gray-700);
        }

        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: var(--spacing-lg);
            margin: var(--spacing-xl) 0;
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }

        .warning-box p {
            margin-bottom: 0;
            color: var(--gray-700);
        }
CSS;
?>
<!DOCTYPE html>
<html lang="es">
<?php include $base_path . 'includes/head.php'; ?>
<body>
<?php include $base_path . 'includes/header.php'; ?>

    <!-- Content -->
    <main class="legal-page">
        <div class="container">
            <div class="legal-content">
                <div class="legal-header">
                    <h1>Términos y Condiciones</h1>
                    <p class="legal-meta">Última actualización: Enero 2025</p>
                </div>

                <div class="legal-toc">
                    <h4>Contenido</h4>
                    <ol>
                        <li><a href="#aceptacion">Aceptación de los Términos</a></li>
                        <li><a href="#servicio">Descripción del Servicio</a></li>
                        <li><a href="#cuenta">Registro y Cuenta</a></li>
                        <li><a href="#uso">Uso Aceptable</a></li>
                        <li><a href="#propiedad">Propiedad Intelectual</a></li>
                        <li><a href="#contenido">Contenido del Usuario</a></li>
                        <li><a href="#pagos">Pagos y Facturación</a></li>
                        <li><a href="#cancelacion">Cancelación</a></li>
                        <li><a href="#garantias">Garantías y Limitaciones</a></li>
                        <li><a href="#responsabilidad">Limitación de Responsabilidad</a></li>
                        <li><a href="#modificaciones">Modificaciones</a></li>
                        <li><a href="#ley">Ley Aplicable</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ol>
                </div>

                <div class="highlight-box">
                    <p><strong>Resumen:</strong> Al usar Iurefficient, aceptas estos términos. Tú eres dueño de tu contenido. Nosotros te damos licencia del software. Puedes cancelar cuando quieras. Respeta las reglas de uso aceptable.</p>
                </div>

                <h2 id="aceptacion">1. Aceptación de los Términos</h2>
                <p>
                    Al acceder o utilizar los servicios de Iurefficient ("el Servicio"), usted acepta estar legalmente obligado por estos Términos y Condiciones ("Términos"). Si no está de acuerdo con alguna parte de estos Términos, no podrá acceder al Servicio.
                </p>
                <p>
                    Estos Términos constituyen un acuerdo legal vinculante entre usted (ya sea como individuo o en representación de una entidad) e Iurefficient.
                </p>

                <h2 id="servicio">2. Descripción del Servicio</h2>
                <p>Iurefficient es una plataforma de software como servicio (SaaS) que proporciona:</p>
                <ul>
                    <li>Gestión de casos y expedientes legales</li>
                    <li>Almacenamiento y organización de documentos</li>
                    <li>Herramientas de análisis con inteligencia artificial</li>
                    <li>Calendario y gestión de plazos</li>
                    <li>Funcionalidades de colaboración</li>
                </ul>
                <p>Nos reservamos el derecho de modificar, suspender o discontinuar cualquier aspecto del Servicio en cualquier momento, con previo aviso razonable cuando sea posible.</p>

                <h2 id="cuenta">3. Registro y Cuenta</h2>

                <h3>3.1 Requisitos</h3>
                <p>Para usar el Servicio, debe:</p>
                <ul>
                    <li>Ser mayor de 18 años</li>
                    <li>Proporcionar información precisa y completa</li>
                    <li>Mantener la seguridad de su contraseña</li>
                    <li>Notificarnos inmediatamente de cualquier uso no autorizado</li>
                </ul>

                <h3>3.2 Responsabilidad de la Cuenta</h3>
                <p>Usted es responsable de todas las actividades que ocurran bajo su cuenta. Iurefficient no será responsable por pérdidas causadas por el uso no autorizado de su cuenta.</p>

                <h2 id="uso">4. Uso Aceptable</h2>
                <p>Al usar el Servicio, usted acepta NO:</p>
                <ul>
                    <li>Violar leyes o regulaciones aplicables</li>
                    <li>Infringir derechos de propiedad intelectual de terceros</li>
                    <li>Cargar contenido ilegal, difamatorio o malicioso</li>
                    <li>Intentar acceder sin autorización a sistemas o datos</li>
                    <li>Interferir con el funcionamiento del Servicio</li>
                    <li>Usar el Servicio para enviar spam o malware</li>
                    <li>Realizar ingeniería inversa del software</li>
                    <li>Revender o sublicenciar el Servicio sin autorización</li>
                    <li>Compartir credenciales de acceso con terceros no autorizados</li>
                </ul>

                <div class="warning-box">
                    <p><strong>Advertencia:</strong> La violación de estas reglas puede resultar en la suspensión o terminación inmediata de su cuenta, sin derecho a reembolso.</p>
                </div>

                <h2 id="propiedad">5. Propiedad Intelectual</h2>

                <h3>5.1 Propiedad de Iurefficient</h3>
                <p>
                    El Servicio, incluyendo su software, diseño, logotipos, textos y demás elementos, es propiedad exclusiva de Iurefficient y está protegido por leyes de propiedad intelectual. Se le otorga una licencia limitada, no exclusiva, no transferible y revocable para usar el Servicio conforme a estos Términos.
                </p>

                <h3>5.2 Su Contenido</h3>
                <p>
                    Usted retiene todos los derechos sobre el contenido que cargue al Servicio. Al cargar contenido, nos otorga una licencia limitada para almacenar, procesar y mostrar dicho contenido únicamente con el fin de proporcionarle el Servicio.
                </p>

                <h2 id="contenido">6. Contenido del Usuario</h2>

                <h3>6.1 Responsabilidad</h3>
                <p>Usted es el único responsable del contenido que cargue, almacene o procese a través del Servicio. Garantiza que tiene los derechos necesarios sobre dicho contenido y que no viola derechos de terceros.</p>

                <h3>6.2 Confidencialidad</h3>
                <p>
                    Entendemos que su contenido puede incluir información confidencial de sus clientes. Nos comprometemos a mantener la confidencialidad de dicho contenido conforme a nuestra <a href="privacidad.php">Política de Privacidad</a> y las mejores prácticas de seguridad.
                </p>

                <h3>6.3 Uso de IA</h3>
                <p>
                    Cuando utiliza las funcionalidades de inteligencia artificial, su contenido es procesado para proporcionarle respuestas y análisis. Este contenido NO es utilizado para entrenar modelos de IA de terceros y es eliminado de la memoria inmediatamente después del procesamiento.
                </p>

                <h2 id="pagos">7. Pagos y Facturación</h2>

                <h3>7.1 Precios</h3>
                <p>Los precios del Servicio están publicados en nuestra <a href="../precios/">página de precios</a>. Los precios no incluyen impuestos, los cuales serán agregados según corresponda.</p>

                <h3>7.2 Ciclo de Facturación</h3>
                <p>La facturación es mensual o anual, según el plan seleccionado. El cobro se realiza al inicio de cada período. Los planes anuales se facturan por adelantado.</p>

                <h3>7.3 Métodos de Pago</h3>
                <p>Aceptamos tarjetas de crédito, débito, transferencia bancaria y PayPal. Usted autoriza el cargo automático según el ciclo de facturación seleccionado.</p>

                <h3>7.4 Cambios de Precio</h3>
                <p>Nos reservamos el derecho de modificar precios. Los cambios serán notificados con al menos 30 días de anticipación y aplicarán en el siguiente ciclo de facturación.</p>

                <h2 id="cancelacion">8. Cancelación</h2>

                <h3>8.1 Por el Usuario</h3>
                <p>Puede cancelar su suscripción en cualquier momento desde la configuración de su cuenta. La cancelación será efectiva al final del período de facturación actual. No se realizan reembolsos por períodos parciales, excepto dentro de los primeros 30 días (garantía de satisfacción).</p>

                <h3>8.2 Por Iurefficient</h3>
                <p>Podemos suspender o terminar su cuenta si:</p>
                <ul>
                    <li>Viola estos Términos</li>
                    <li>No realiza el pago correspondiente</li>
                    <li>Su uso representa un riesgo de seguridad</li>
                    <li>Es requerido por ley</li>
                </ul>

                <h3>8.3 Efecto de la Cancelación</h3>
                <p>Tras la cancelación, tendrá 30 días para exportar su contenido. Después de este período, su contenido será eliminado de nuestros servidores de forma segura.</p>

                <h2 id="garantias">9. Garantías y Limitaciones</h2>

                <h3>9.1 Garantía de Satisfacción</h3>
                <p>Ofrecemos una garantía de satisfacción de 30 días. Si no está satisfecho con el Servicio dentro de los primeros 30 días, le reembolsaremos el 100% de su pago.</p>

                <h3>9.2 Disponibilidad</h3>
                <p>Nos esforzamos por mantener una disponibilidad del 99.9% (para plan Despacho) y 99.5% (para otros planes). Sin embargo, el Servicio se proporciona "tal cual" y no garantizamos que esté libre de errores o interrupciones.</p>

                <h3>9.3 Exclusión de Garantías</h3>
                <p>En la máxima medida permitida por la ley, excluimos todas las garantías implícitas, incluyendo las de comerciabilidad, idoneidad para un propósito particular y no infracción.</p>

                <h2 id="responsabilidad">10. Limitación de Responsabilidad</h2>
                <p>En la máxima medida permitida por la ley aplicable:</p>
                <ul>
                    <li>Iurefficient no será responsable por daños indirectos, incidentales, especiales, consecuentes o punitivos</li>
                    <li>Nuestra responsabilidad total no excederá el monto pagado por usted en los últimos 12 meses</li>
                    <li>No somos responsables por pérdidas derivadas de decisiones tomadas basándose en el análisis de IA</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Nota:</strong> Las herramientas de IA son asistentes y no sustituyen el criterio profesional. Siempre verifique la información importante de forma independiente.</p>
                </div>

                <h2 id="modificaciones">11. Modificaciones a los Términos</h2>
                <p>
                    Podemos modificar estos Términos en cualquier momento. Los cambios sustanciales serán notificados con al menos 30 días de anticipación por correo electrónico y/o dentro del Servicio. El uso continuado del Servicio después de los cambios constituye aceptación de los nuevos Términos.
                </p>

                <h2 id="ley">12. Ley Aplicable y Jurisdicción</h2>
                <p>
                    Estos Términos se rigen por las leyes de los Estados Unidos Mexicanos. Cualquier disputa será sometida a la jurisdicción exclusiva de los tribunales competentes de la Ciudad de México.
                </p>
                <p>
                    Antes de iniciar cualquier procedimiento legal, las partes acuerdan intentar resolver la disputa mediante negociación de buena fe durante un período de 30 días.
                </p>

                <h2 id="contacto">13. Contacto</h2>
                <p>Para preguntas sobre estos Términos, contáctenos:</p>
                <ul>
                    <li><strong>Correo electrónico:</strong> <a href="mailto:legal@iurefficient.com">legal@iurefficient.com</a></li>
                    <li><strong>Correo general:</strong> <a href="mailto:contacto@iurefficient.com">contacto@iurefficient.com</a></li>
                </ul>

                <p style="margin-top: var(--spacing-3xl); padding-top: var(--spacing-xl); border-top: 1px solid var(--gray-200); font-size: 0.875rem; color: var(--gray-500);">
                    Al usar Iurefficient, usted reconoce haber leído, entendido y aceptado estos Términos y Condiciones.
                </p>
            </div>
        </div>
    </main>

<?php include $base_path . 'includes/footer.php'; ?>
<?php include $base_path . 'includes/scripts.php'; ?>
</body>
</html>
