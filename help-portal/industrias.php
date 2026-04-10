<?php
$base_path = '../';
$current_help_page = 'industrias';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soluciones por Industria — Iurefficient</title>
  <meta name="description" content="Descubre como Iurefficient se adapta a tu industria: legal, contabilidad, consultoria, ingenieria, RRHH y mas.">
  <link rel="icon" type="image/png" href="<?= $base_path ?>images/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/includes/help-nav.php'; ?>

<div class="page-header">
  <div class="page-header-inner">
    <div class="breadcrumb"><a href="<?= $base_path ?>help-portal/">Ayuda</a> / Industrias</div>
    <h1>Soluciones por Industria</h1>
    <p>Iurefficient se adapta a tu profesion con terminologia, flujos de trabajo y bases de conocimiento especializadas.</p>
  </div>
</div>

<section class="section">
  <div class="tabs-container">
    <div class="tabs">
      <button class="tab-btn active" data-tab="tab-legal">Legal</button>
      <button class="tab-btn" data-tab="tab-contabilidad">Contabilidad</button>
      <button class="tab-btn" data-tab="tab-consultoria">Consultoria</button>
      <button class="tab-btn" data-tab="tab-ingenieria">Ingenieria</button>
      <button class="tab-btn" data-tab="tab-rrhh">Recursos Humanos</button>
      <button class="tab-btn" data-tab="tab-retail">Retail y Operaciones</button>
    </div>

    <!-- Legal -->
    <div id="tab-legal" class="tab-content active">
      <h2>Despachos Legales y Firmas de Abogados</h2>
      <h3>Tus desafios</h3>
      <ul>
        <li>60% del tiempo en investigacion legal y revision de documentos.</li>
        <li>Miles de paginas de expedientes imposibles de memorizar.</li>
        <li>Riesgo de pasar por alto jurisprudencia relevante.</li>
        <li>Presion por reducir costos sin sacrificar calidad.</li>
        <li>Dificultad para escalar sin contratar mas abogados junior.</li>
      </ul>

      <h3>Como Iurefficient te ayuda</h3>
      <ul>
        <li><strong>Investigacion legal instantanea:</strong> "Que dice el articulo 1902 del CC sobre este caso?" &rarr; Respuesta en 3 segundos con cita exacta + jurisprudencia relevante. <em>Ahorro: 2-3 horas por caso.</em></li>
        <li><strong>Memoria total del expediente:</strong> Chatea con 10,000 paginas de documentos como si los hubieras leido todos. "Que dijo el testigo sobre el accidente?" &rarr; Extracto exacto con pagina y fecha.</li>
        <li><strong>Generacion de documentos:</strong> Genera borradores de demandas, escritos, contratos e informes basados en tu estilo + legislacion vigente + precedentes. <em>Ahorro: 4-6 horas por documento.</em></li>
        <li><strong>Analisis de riesgo:</strong> "Que probabilidades tiene este argumento de prosperar?" &rarr; Analisis basado en casos similares y jurisprudencia.</li>
      </ul>

      <div class="info-box success">
        <strong>ROI tipico:</strong> Ahorro 15-20 horas/semana por abogado. ROI: 300-600%.
      </div>

      <h3>Ejemplo: Historia de uso real</h3>
      <p><strong>Maria, socia de un despacho</strong> recibe un caso nuevo de responsabilidad civil. En lugar de dedicar 3 horas leyendo expedientes:</p>
      <ol>
        <li><strong>Carga documentos</strong> (contrato, informe pericial, fotos, emails) &rarr; 2 minutos.</li>
        <li><strong>Pregunta "Resume el caso y dime que argumentos tenemos"</strong> &rarr; Respuesta completa en 5 segundos con fundamentos juridicos, jurisprudencia relevante y recomendacion de viabilidad.</li>
        <li><strong>Profundiza:</strong> "Que dice el contrato sobre estandares de calidad?" &rarr; Cita exacta con pagina y clausula.</li>
        <li><strong>Genera borrador de demanda</strong> &rarr; 8 paginas listas en 30 segundos. Maria revisa y ajusta en 45 minutos.</li>
      </ol>
      <p><strong>Resultado:</strong> Lo que antes tomaba 8-10 horas, ahora toma menos de 1 hora.</p>
    </div>

    <!-- Contabilidad -->
    <div id="tab-contabilidad" class="tab-content">
      <h2>Firmas de Contabilidad y Auditoria</h2>
      <h3>Tus desafios</h3>
      <ul>
        <li>Montanas de estados financieros y facturas que revisar.</li>
        <li>Normativas fiscales que cambian constantemente.</li>
        <li>Temporadas de impuestos con picos de trabajo insostenibles.</li>
        <li>Auditorias que requieren cruzar miles de transacciones.</li>
        <li>Junior staff que necesita supervision constante.</li>
      </ul>

      <h3>Como Iurefficient te ayuda</h3>
      <ul>
        <li><strong>Consultor fiscal instantaneo:</strong> "Como aplica la nueva norma de teletrabajo a la deduccion de gastos?" &rarr; Referencia exacta + interpretacion + casos practicos.</li>
        <li><strong>Analisis de estados financieros:</strong> Sube balance, P&amp;L, cash flow &rarr; Analisis automatico de ratios y banderas rojas.</li>
        <li><strong>Automatizacion de auditoria:</strong> "Revisa todas las facturas &gt;$10k del Q3 y verifica aprobaciones" &rarr; Genera workpapers automaticamente.</li>
        <li><strong>Preparacion de declaraciones:</strong> Asistente para IRPF, IS, IVA. Verifica que no falten deducciones aplicables.</li>
      </ul>

      <div class="info-box success">
        <strong>ROI tipico:</strong> Ahorro 10-15 horas/semana. Reduccion de errores: 60-80%. Payback &lt;2 meses.
      </div>
    </div>

    <!-- Consultoria -->
    <div id="tab-consultoria" class="tab-content">
      <h2>Consultoras y Project Management</h2>
      <h3>Tus desafios</h3>
      <ul>
        <li>Multiples proyectos paralelos con contextos diferentes.</li>
        <li>Propuestas y deliverables que consumen 40% del tiempo.</li>
        <li>Knowledge management caotico (info en emails, Slack, Drive).</li>
        <li>Reinventar la rueda en cada proyecto.</li>
        <li>Onboarding de nuevos consultores lento y costoso.</li>
      </ul>

      <h3>Como Iurefficient te ayuda</h3>
      <ul>
        <li><strong>Base de conocimiento institucional:</strong> Centraliza metodologias, templates, casos de exito. "Como resolvimos el problema de rotacion en el proyecto de Retail Corp?" &rarr; Acceso instantaneo a lecciones aprendidas.</li>
        <li><strong>Generacion de propuestas:</strong> "Genera propuesta para transformacion digital de empresa manufacturera" &rarr; De 8 horas a 1 hora por propuesta.</li>
        <li><strong>Asistente de proyecto:</strong> "Resume el status de los 5 workstreams" o "Que riesgos no hemos mitigado?".</li>
        <li><strong>Research competitivo:</strong> "Investiga tendencias en customer experience para sector bancario" &rarr; Informe con fuentes verificadas en minutos.</li>
        <li><strong>Onboarding acelerado:</strong> Nuevos consultores aprenden en dias lo que normalmente tomaria meses preguntando al sistema.</li>
      </ul>

      <div class="info-box success">
        <strong>ROI tipico:</strong> Ahorro 100+ horas/mes colectivas. Mejora win-rate propuestas: +15-25%. ROI: 400-800%.
      </div>
    </div>

    <!-- Ingenieria -->
    <div id="tab-ingenieria" class="tab-content">
      <h2>Ingenierias y Empresas Tecnicas</h2>
      <h3>Tus desafios</h3>
      <ul>
        <li>Codigos tecnicos (CTE, ISO, IEEE) extensos y complejos.</li>
        <li>Especificaciones de equipos y materiales que verificar.</li>
        <li>Documentacion tecnica que consume tiempo.</li>
        <li>Normativas de seguridad criticas (no puedes equivocarte).</li>
        <li>Ingenieros junior que necesitan guia constante.</li>
      </ul>

      <h3>Como Iurefficient te ayuda</h3>
      <ul>
        <li><strong>Consultor tecnico normativo:</strong> "Que dice el CTE DB-SE-AE sobre cargas de viento en Madrid?" &rarr; Cita exacta + interpretacion + calculos ejemplo.</li>
        <li><strong>Verificacion de diseno:</strong> Sube calculos y memoria &rarr; Verifica cumplimiento normativo. "Este diseno cumple con EHE-08 para HA-30?".</li>
        <li><strong>Generacion de memorias:</strong> Borradores de memorias tecnicas, pliegos y especificaciones. <em>Ahorro: 6-10 horas por memoria.</em></li>
        <li><strong>Gestion de proveedores:</strong> "Compara especificaciones de estos 3 equipos HVAC" &rarr; Decisiones tecnicas mas rapido.</li>
      </ul>

      <div class="info-box success">
        <strong>ROI tipico:</strong> Ahorro 12-18 horas/semana. Reduccion errores tecnicos: 50-70%. ROI: 350-550%.
      </div>
    </div>

    <!-- RRHH -->
    <div id="tab-rrhh" class="tab-content">
      <h2>Area de Recursos Humanos</h2>
      <h3>Tus desafios</h3>
      <ul>
        <li>Politicas de RRHH extensas que cambian frecuentemente.</li>
        <li>Normativa laboral compleja (Ley Federal del Trabajo, convenios).</li>
        <li>Consultas repetitivas de empleados.</li>
        <li>Documentacion de casos (disciplinarios, evaluaciones).</li>
        <li>Onboarding que requiere mucho tiempo de RRHH.</li>
      </ul>

      <h3>Como Iurefficient te ayuda</h3>
      <ul>
        <li><strong>Portal de autoservicio para empleados:</strong> "Cuantos dias de vacaciones me corresponden?" o "Como solicito permiso de paternidad?" &rarr; Reduce consultas a RRHH 70%.</li>
        <li><strong>Consultor laboral:</strong> Referencia a ley laboral + jurisprudencia + procedimiento interno para cada caso.</li>
        <li><strong>Gestion de performance:</strong> "Resume el historial de rendimiento de empleado X" &rarr; Decisiones basadas en datos completos.</li>
        <li><strong>Onboarding automatizado:</strong> Guia personalizada para cada nuevo empleado, responde preguntas 24/7.</li>
      </ul>

      <div class="info-box success">
        <strong>ROI tipico:</strong> Reduccion consultas: 70%. Ahorro tiempo RRHH: 15-20 horas/semana. ROI: 400-600%.
      </div>
    </div>

    <!-- Retail -->
    <div id="tab-retail" class="tab-content">
      <h2>Retail y Operaciones</h2>
      <h3>Tus desafios</h3>
      <ul>
        <li>Datos de ventas, inventario y clientes dispersos.</li>
        <li>Procesos operativos complejos con muchas excepciones.</li>
        <li>Necesidad de insights rapidos para decisiones diarias.</li>
        <li>Manuales operativos que nadie lee o actualiza.</li>
        <li>Alta rotacion de personal con onboarding costoso.</li>
      </ul>

      <h3>Como Iurefficient te ayuda</h3>
      <ul>
        <li><strong>Asistente operativo inteligente:</strong> "Cual es el procedimiento cuando un cliente devuelve producto abierto?" &rarr; Respuesta basada en politicas y casos anteriores.</li>
        <li><strong>Analisis de performance:</strong> Sube reportes &rarr; Analisis de tendencias y recomendaciones sin necesidad de analista.</li>
        <li><strong>Gestion de incidencias:</strong> Documenta incidencias, busca casos similares y soluciones aplicadas. Reduce tiempo de resolucion 60%.</li>
        <li><strong>Knowledge base de productos:</strong> 10,000 SKUs &rarr; Encuentra especificaciones en segundos.</li>
      </ul>

      <div class="info-box success">
        <strong>ROI tipico:</strong> Reduccion tiempo de entrenamiento: 50%. Mejora resolucion de incidencias: 40%. Payback: 2-3 meses.
      </div>
    </div>

  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="cta-banner">
    <h2>Tu industria no aparece?</h2>
    <p>Iurefficient se adapta a cualquier servicio profesional. Contactanos para una demo personalizada.</p>
    <a href="mailto:sales@iurefficient.com" class="btn-white">Contactar ventas</a>
  </div>
</section>

<?php include __DIR__ . '/includes/help-footer.php'; ?>

<script src="app.js"></script>
</body>
</html>
