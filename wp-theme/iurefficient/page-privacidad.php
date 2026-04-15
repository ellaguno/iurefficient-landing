<?php
/* Template Name: Privacidad */
get_header();
?>

<style>
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
</style>

    <!-- Content -->
    <main class="legal-page">
        <div class="container">
            <div class="legal-content">
                <div class="legal-header">
                    <h1>Aviso de Privacidad</h1>
                    <p class="legal-meta">Ultima actualizacion: Enero 2025</p>
                </div>

                <div class="legal-toc">
                    <h4>Contenido</h4>
                    <ol>
                        <li><a href="#responsable">Identidad del Responsable</a></li>
                        <li><a href="#datos">Datos Personales que Recopilamos</a></li>
                        <li><a href="#finalidades">Finalidades del Tratamiento</a></li>
                        <li><a href="#transferencias">Transferencias de Datos</a></li>
                        <li><a href="#derechos">Derechos ARCO</a></li>
                        <li><a href="#cookies">Uso de Cookies</a></li>
                        <li><a href="#seguridad">Medidas de Seguridad</a></li>
                        <li><a href="#cambios">Cambios al Aviso</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ol>
                </div>

                <div class="highlight-box">
                    <p><strong>Resumen:</strong> Recopilamos informacion necesaria para proporcionar nuestros servicios. No vendemos tus datos. Tus documentos son confidenciales y estan cifrados. Puedes ejercer tus derechos ARCO en cualquier momento.</p>
                </div>

                <h2 id="responsable">1. Identidad del Responsable</h2>
                <p>
                    <strong>Iurefficient</strong>, con domicilio en [Direccion completa], Ciudad de Mexico, Mexico, es responsable del tratamiento de sus datos personales conforme a lo establecido en la Ley Federal de Proteccion de Datos Personales en Posesion de los Particulares (LFPDPPP) y su Reglamento.
                </p>

                <h2 id="datos">2. Datos Personales que Recopilamos</h2>

                <h3>2.1 Datos de Identificacion y Contacto</h3>
                <ul>
                    <li>Nombre completo</li>
                    <li>Correo electronico</li>
                    <li>Numero telefonico</li>
                    <li>Nombre del despacho u organizacion</li>
                    <li>Cargo o puesto</li>
                </ul>

                <h3>2.2 Datos de Facturacion</h3>
                <ul>
                    <li>RFC</li>
                    <li>Domicilio fiscal</li>
                    <li>Datos bancarios o de tarjeta de credito (procesados por terceros certificados PCI-DSS)</li>
                </ul>

                <h3>2.3 Datos de Uso del Servicio</h3>
                <ul>
                    <li>Registros de actividad en la plataforma</li>
                    <li>Preferencias de configuracion</li>
                    <li>Direccion IP y datos del dispositivo</li>
                    <li>Cookies y tecnologias similares</li>
                </ul>

                <h3>2.4 Contenido del Usuario</h3>
                <p>Los documentos, casos y demas informacion que usted cargue a la plataforma son tratados como informacion confidencial bajo estrictas medidas de seguridad. Este contenido es de su exclusiva propiedad y no es utilizado para fines distintos a proporcionarle el servicio.</p>

                <h2 id="finalidades">3. Finalidades del Tratamiento</h2>

                <h3>3.1 Finalidades Primarias (necesarias)</h3>
                <ul>
                    <li>Proporcionar acceso a la plataforma Iurefficient</li>
                    <li>Procesar y gestionar su suscripcion</li>
                    <li>Emitir facturas y comprobantes fiscales</li>
                    <li>Brindar soporte tecnico y atencion al cliente</li>
                    <li>Enviar notificaciones relacionadas con el servicio</li>
                    <li>Cumplir con obligaciones legales</li>
                </ul>

                <h3>3.2 Finalidades Secundarias (con su consentimiento)</h3>
                <ul>
                    <li>Enviar informacion sobre nuevas funcionalidades y actualizaciones</li>
                    <li>Realizar encuestas de satisfaccion</li>
                    <li>Enviar comunicaciones de marketing</li>
                    <li>Elaborar estadisticas y estudios de mercado (datos anonimizados)</li>
                </ul>

                <p>Si no desea que sus datos sean tratados para finalidades secundarias, puede manifestarlo enviando un correo a <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a>.</p>

                <h2 id="transferencias">4. Transferencias de Datos</h2>
                <p>Sus datos personales podran ser transferidos a:</p>
                <ul>
                    <li><strong>Proveedores de infraestructura:</strong> Para el alojamiento y operacion de la plataforma (servidores en Mexico)</li>
                    <li><strong>Procesadores de pago:</strong> Para gestionar transacciones (certificados PCI-DSS)</li>
                    <li><strong>Proveedores de servicios de IA:</strong> Para funcionalidades de inteligencia artificial (sin retencion de datos)</li>
                    <li><strong>Autoridades competentes:</strong> Cuando sea requerido por ley</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Importante:</strong> No vendemos, alquilamos ni compartimos sus datos personales con terceros para fines de marketing sin su consentimiento expreso.</p>
                </div>

                <h2 id="derechos">5. Derechos ARCO</h2>
                <p>Usted tiene derecho a:</p>
                <ul>
                    <li><strong>Acceso:</strong> Conocer que datos personales tenemos sobre usted</li>
                    <li><strong>Rectificacion:</strong> Solicitar la correccion de datos inexactos o incompletos</li>
                    <li><strong>Cancelacion:</strong> Pedir la eliminacion de sus datos</li>
                    <li><strong>Oposicion:</strong> Oponerse al tratamiento de sus datos para ciertas finalidades</li>
                </ul>

                <p>Para ejercer sus derechos ARCO, envie una solicitud a <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a> incluyendo:</p>
                <ol>
                    <li>Nombre completo y correo electronico registrado</li>
                    <li>Descripcion clara del derecho que desea ejercer</li>
                    <li>Documentos que acrediten su identidad</li>
                </ol>

                <p>Responderemos en un plazo maximo de 20 dias habiles.</p>

                <h2 id="cookies">6. Uso de Cookies</h2>
                <p>Utilizamos cookies y tecnologias similares para:</p>
                <ul>
                    <li>Mantener su sesion activa</li>
                    <li>Recordar sus preferencias</li>
                    <li>Analizar el uso de la plataforma (analytics)</li>
                    <li>Mejorar la experiencia del usuario</li>
                </ul>

                <p>Puede configurar su navegador para rechazar cookies, aunque esto puede afectar la funcionalidad de la plataforma.</p>

                <h2 id="seguridad">7. Medidas de Seguridad</h2>
                <p>Implementamos medidas de seguridad administrativas, tecnicas y fisicas para proteger sus datos personales, incluyendo:</p>
                <ul>
                    <li>Cifrado AES-256 para datos en reposo</li>
                    <li>Cifrado TLS 1.3 para datos en transito</li>
                    <li>Controles de acceso basados en roles</li>
                    <li>Monitoreo continuo de seguridad</li>
                    <li>Auditorias periodicas de seguridad</li>
                    <li>Capacitacion al personal en proteccion de datos</li>
                </ul>

                <p>Para mas informacion sobre nuestras practicas de seguridad, visite nuestra <a href="<?php echo esc_url(home_url('/seguridad/')); ?>">pagina de seguridad</a>.</p>

                <h2 id="cambios">8. Cambios al Aviso de Privacidad</h2>
                <p>Nos reservamos el derecho de modificar este Aviso de Privacidad en cualquier momento. Los cambios seran notificados a traves de:</p>
                <ul>
                    <li>Publicacion en nuestro sitio web</li>
                    <li>Notificacion por correo electronico (para cambios sustanciales)</li>
                    <li>Aviso dentro de la plataforma</li>
                </ul>

                <h2 id="contacto">9. Contacto</h2>
                <p>Si tiene dudas o comentarios sobre este Aviso de Privacidad o el tratamiento de sus datos, puede contactarnos:</p>
                <ul>
                    <li><strong>Correo electronico:</strong> <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a></li>
                    <li><strong>Derechos ARCO:</strong> <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a></li>
                    <li><strong>Telefono:</strong> [Numero de contacto]</li>
                    <li><strong>Domicilio:</strong> [Direccion completa]</li>
                </ul>

                <p style="margin-top: var(--spacing-3xl); padding-top: var(--spacing-xl); border-top: 1px solid var(--gray-200); font-size: 0.875rem; color: var(--gray-500);">
                    Este Aviso de Privacidad se elabora en cumplimiento de la Ley Federal de Proteccion de Datos Personales en Posesion de los Particulares (LFPDPPP) publicada en el Diario Oficial de la Federacion el 5 de julio de 2010 y su Reglamento.
                </p>
            </div>
        </div>
    </main>

<?php get_footer(); ?>
