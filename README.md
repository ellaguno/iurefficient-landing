# Iurefficient Landing Page

Landing page moderna y profesional para Iurefficient, creada con HTML5, CSS3 y JavaScript vanilla.

## Estructura del Proyecto

```
iurefficient-landing/
├── index.html              # Página principal (landing)
├── css/
│   └── styles.css          # Estilos completos
├── js/
│   └── main.js             # JavaScript (animaciones, carrusel, formulario)
├── precios/
│   └── index.html          # Página de precios detallados
├── seguridad/
│   └── index.html          # Página de seguridad y privacidad
├── legal/
│   ├── privacidad.html     # Aviso de privacidad
│   └── terminos.html       # Términos y condiciones
├── images/                 # ⚠️ IMÁGENES PENDIENTES (ver abajo)
└── README.md               # Este archivo
```

## Imágenes Requeridas

Coloca las siguientes imágenes en la carpeta `images/`:

### Logos (Requeridos)
| Archivo | Dimensiones | Descripción |
|---------|-------------|-------------|
| `logo.svg` | ~200x50px | Logo principal (fondo transparente) |
| `logo-white.svg` | ~200x50px | Logo versión blanca para footer |
| `favicon.png` | 32x32px | Favicon del sitio |
| `og-image.png` | 1200x630px | Imagen para compartir en redes sociales |

### Equipo (Requeridos)
| Archivo | Dimensiones | Descripción |
|---------|-------------|-------------|
| `eduardo.jpg` | 400x400px | Foto profesional de Eduardo Llaguno Velasco |
| `frida.jpg` | 400x400px | Foto de Frida Velázquez Esquer (ya existe en servidor actual como `/images/abogada1.png`) |

### Hero y Dashboard (Requeridos)
| Archivo | Dimensiones | Descripción |
|---------|-------------|-------------|
| `dashboard-mockup.png` | 1200x800px | Screenshot o mockup del dashboard principal |

### Screenshots del Carrusel (Requeridos)
| Archivo | Dimensiones | Descripción |
|---------|-------------|-------------|
| `screenshot-1.png` | 1200x800px | Dashboard - Centro de comando |
| `screenshot-2.png` | 1200x800px | Gestión de Casos |
| `screenshot-3.png` | 1200x800px | Análisis de Documentos (IA) |
| `screenshot-4.png` | 1200x800px | Asistente IA / Chat |
| `screenshot-5.png` | 1200x800px | Calendario Legal |
| `screenshot-6.png` | 1200x800px | Gestión de Clientes |
| `screenshot-7.png` | 1200x800px | Reportes y Métricas |

### Opcionales
| Archivo | Dimensiones | Descripción |
|---------|-------------|-------------|
| `trust-logo-1.png` a `trust-logo-4.png` | 100x40px | Logos de clientes/empresas que confían en Iurefficient |

## Cómo Subir al Servidor

### Opción 1: FTP
1. Conéctate a tu hosting HostGator vía FTP (FileZilla, etc.)
2. Navega a `public_html`
3. **Respalda** los archivos actuales (muévelos a una carpeta de backup)
4. Sube todo el contenido de `iurefficient-landing/`

### Opción 2: Administrador de Archivos (cPanel)
1. Accede a cPanel de HostGator
2. Abre "Administrador de Archivos"
3. Navega a `public_html`
4. Respalda archivos actuales
5. Sube el archivo ZIP y extráelo

## Configuración Post-Subida

### 1. Formulario de Contacto
El formulario actual simula el envío. Para que funcione de verdad, tienes dos opciones:

**Opción A: Servicio externo (recomendado)**
- Usar [Formspree](https://formspree.io/) (gratis hasta 50 envíos/mes)
- Cambiar el action del formulario a tu endpoint de Formspree

**Opción B: Script PHP propio**
- Crear un archivo `send-form.php` que procese y envíe emails
- Modificar el formulario para enviar a ese script

### 2. Google Analytics
Agregar antes de `</head>`:
```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=TU-ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'TU-ID');
</script>
```

### 3. SSL (HTTPS)
HostGator incluye SSL gratuito. Verifica que esté activo en cPanel → SSL/TLS.

## Tecnologías Utilizadas

- **HTML5** - Estructura semántica
- **CSS3** - Variables CSS, Flexbox, Grid, animaciones
- **JavaScript Vanilla** - Sin frameworks
- **AOS.js** - Animaciones al scroll (CDN)
- **Swiper.js** - Carrusel de screenshots (CDN)
- **Google Fonts** - Tipografía Inter

## Compatibilidad

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- iOS Safari 14+
- Chrome Android 90+

## Personalización

### Colores
Modifica las variables CSS en `css/styles.css`:
```css
:root {
    --primary-500: #4f46e5;  /* Color principal */
    --accent-500: #06b6d4;   /* Color de acento */
    --success-500: #10b981;  /* Color de éxito */
    /* ... más variables */
}
```

### Contenido
- Textos: Edita directamente en los archivos HTML
- Precios: Modifica en `index.html` y `precios/index.html`
- Información legal: Actualiza con tus datos reales en `legal/`

## Soporte

Para problemas o preguntas:
- Email: contacto@iurefficient.com

---

Creado con ❤️ para Iurefficient
