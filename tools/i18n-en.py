#!/usr/bin/env python3
"""Convierte el contenido de Iurefficient a bilingüe (es/en) y crea las páginas precios y seguridad del constructor.
   Repetible: los campos ya bilingües se conservan; solo se añade 'en' donde falta o se actualiza con lo de aquí."""
import json, glob, os, collections
ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
J = lambda p: json.load(open(p), object_pairs_hook=collections.OrderedDict)
def W(p, d):
    json.dump(d, open(p, 'w'), ensure_ascii=False, indent=2); open(p, 'a').write("\n")
def i18n(es, en=None):
    if isinstance(es, dict) and 'es' in es:
        if en is not None or 'en' not in es: es['en'] = en if en is not None else es['es']
        return es
    return collections.OrderedDict([('es', es), ('en', en if en is not None else es)])

# ------------------------------------------------------------------ textos fijos
EN = {
 'p_toggle_monthly': 'Monthly', 'p_toggle_annual': 'Annual', 'p_toggle_discount': 'Save 20%',
 'nav_btn_abogados': 'Law firms', 'nav_btn_demo_teams': 'Open the demo', 'nav_btn_demo_derecho': 'Try the demo',
 'footer_copy': '© {year} Iurefficient. All rights reserved.', 'footer_made': 'Made with ❤️ in Mexico', 'crumb_home': 'Home',
 'not_found_title': 'Page not found', 'not_found_text': 'The page you are looking for does not exist or has moved.', 'go_home': 'Go to the home page',
 'f_name_ph': 'Your name', 'f_email_ph': 'Your email', 'f_email_ph_teams': 'Your work email', 'f_phone_ph': 'Your phone (optional)',
 'f_size_teams': "Team size\n1-5|1-5 people\n6-20|6-20 people\n21-50|21-50 people\n50+|More than 50",
 'f_size_derecho': "Firm size\n1|Just me\n2-5|2-5 lawyers\n6-20|6-20 lawyers\n20+|More than 20",
 'home_meta_title': 'Iurefficient Teams: AI project management for teams',
 'home_meta_desc': 'Iurefficient Teams is project management software with artificial intelligence. Chat with iure, your AI assistant, and it generates tasks, dependencies and a schedule. Free 14-day trial.',
 'precios_meta_title': 'Iurefficient pricing and plans for lawyers and law firms',
 'precios_meta_desc': 'Plans and pricing for Iurefficient, the AI legal software for law firms. Basic, Professional and Enterprise, no long-term contracts, free trial included.',
 'seguridad_meta_title': 'Security, confidentiality and privacy of your legal data',
 'seguridad_meta_desc': "How Iurefficient protects your firm's and your clients' information: encryption, private servers, no AI training on your data, and compliance with Mexican data protection law.",
 'pg_cta_title': 'Want to see Iurefficient in action?', 'pg_cta_text': 'Book a demo or start your free trial today.', 'pg_cta_button': 'Request a demo',
 'toc_title': 'Contents', 'articulos_title': 'Articles', 'articulos_intro': '', 'articulos_empty': 'No articles published yet.',
 'articulos_meta_title': 'Articles', 'articulos_meta_desc': 'Iurefficient articles and guides on artificial intelligence for law firms and teams.',
 'proyectos_title': 'Projects', 'proyectos_intro': '', 'proyectos_empty': 'No projects published yet.', 'proyectos_meta_title': 'Projects', 'proyectos_meta_desc': 'Success stories and projects built with Iurefficient.',
 'published_on': 'Published on', 'by_author': 'by', 'read_more': 'Read more', 'back_to_list': 'Back to the index',
 'search_placeholder': 'Search the site…', 'search_button': 'Search', 'search_title': 'Search', 'search_results': '{n} results for “{q}”', 'search_one': '1 result for “{q}”',
 'search_empty': 'Nothing found for “{q}”. Try other words.', 'search_hint': 'Search articles, release notes, tutorials, FAQs and site pages.', 'buscar_meta_title': 'Search',
 't_footer_tagline': 'Project management powered by artificial intelligence.',
 't_footer_beta_note': 'Already using Iurefficient for your law firm? Your current account includes access to Teams at no extra cost during the beta.',
 'd_footer_tagline': 'Transforming legal practice with artificial intelligence.',
}
p = f'{ROOT}/data/strings.json'; S = J(p)
for k, v in EN.items():
    if k in S: S[k]['en'] = v
# claves de precios/seguridad que ya no usa el tema (ahora viven en las páginas): fuera
for k in [k for k in S if k.startswith('p_') and k not in ('p_toggle_monthly', 'p_toggle_annual', 'p_toggle_discount')] + [k for k in S if k.startswith('s_')]:
    del S[k]
W(p, S)
D = J(f'{ROOT}/site/defaults/strings.json')
for k, v in EN.items():
    if k in D: D[k]['en'] = v
for k in [k for k in D if (k.startswith('p_') and k not in ('p_toggle_monthly', 'p_toggle_annual', 'p_toggle_discount')) or k.startswith('s_')]: del D[k]
W(f'{ROOT}/site/defaults/strings.json', D)

# ------------------------------------------------------------------ menú y ajustes
for p in [f'{ROOT}/data/menu.json', f'{ROOT}/site/defaults/menu.json']:
    M = J(p)
    M['en'] = [collections.OrderedDict([('label', l), ('url', u)] + ([('new_tab', True)] if nt else [])) for l, u, nt in [
        ('Presentation', '/presentacion/', False), ('Articles', '/articulos/', False), ('Use cases', '/#equipos', False), ('Comparison', '/#comparativa', False), ('Pricing', '/precios', False), ('Security', '/#seguridad', False)]]
    W(p, M)
for p in [f'{ROOT}/data/settings.json', f'{ROOT}/site/defaults/settings.json']:
    if not os.path.exists(p): continue
    St = J(p)
    St['languages'] = collections.OrderedDict([('en', True)])
    St['menu_derecho_en'] = ['Features | /derecho#caracteristicas', 'Security | /derecho#seguridad', 'Team | /derecho#equipo', 'Blog | https://blog.iurefficient.com | 1', 'Pricing | /precios', 'Help | /help-portal/ | 1']
    W(p, St)

# ------------------------------------------------------------------ planes
PL = {
 'Básico': 'Basic', 'Profesional': 'Professional', 'Enterprise': 'Enterprise', 'Teams Starter': 'Teams Starter', 'Teams Pro': 'Teams Pro', 'Teams Enterprise': 'Teams Enterprise',
 'Pequeños despachos e independientes': 'Small firms and solo practitioners', 'Despachos en crecimiento': 'Growing firms', 'Grandes organizaciones': 'Large organizations',
 'Equipos pequenos': 'Small teams', 'Equipos medianos': 'Mid-sized teams', 'Más popular': 'Most popular', 'Mas popular': 'Most popular', 'MXN/mes': 'MXN/mo',
 'Comenzar prueba gratuita': 'Start free trial', 'Contactar ventas': 'Contact sales',
 '+$1,000/usuario, +$120.0/GB, +$50/caso, +$120/1000 IA': '+$1,000/user, +$120/GB, +$50/case, +$120 per 1,000 AI queries',
}
FE = {
 '2 usuarios incluidos': '2 users included', '7 usuarios incluidos': '7 users included', '12 usuarios incluidos': '12 users included',
 '50 casos/proyectos': '50 cases/projects', '200 casos/proyectos': '200 cases/projects', 'Casos ilimitados': 'Unlimited cases',
 '30 proyectos activos': '30 active projects', '100 proyectos activos': '100 active projects', 'Proyectos ilimitados': 'Unlimited projects',
 '500 consultas IA al mes': '500 AI queries per month', '2,000 consultas IA al mes': '2,000 AI queries per month', '5,000 consultas IA al mes': '5,000 AI queries per month',
 '10,000 consultas IA al mes': '10,000 AI queries per month', '15,000 consultas IA al mes': '15,000 AI queries per month',
 '2 GB almacenamiento': '2 GB storage', '4 GB almacenamiento': '4 GB storage', '10 GB almacenamiento': '10 GB storage',
 'Soporte por email': 'Email support', 'Soporte prioritario': 'Priority support', 'Soporte dedicado 24/7': 'Dedicated 24/7 support',
 'Integraciones': 'Integrations', 'Personalización': 'Customization', 'Personalizacion': 'Customization', 'Capacitación incluida': 'Training included', 'Capacitacion incluida': 'Training included',
 'Exportación de datos': 'Data export', 'SLA garantizado 99.9%': '99.9% guaranteed SLA', 'Reportes avanzados': 'Advanced reports', 'API access': 'API access',
}
for f in glob.glob(f'{ROOT}/data/content/planes/*.json'):
    d = J(f)
    for k in ['title', 'description', 'badge', 'period', 'overage', 'cta_text']:
        v = d.get(k, '')
        if isinstance(v, str): d[k] = i18n(v, PL.get(v, v))
    if isinstance(d.get('features'), list): d['features'] = i18n(d['features'], [FE.get(x, x) for x in d['features']])
    W(f, d)

# ------------------------------------------------------------------ preguntas frecuentes
FAQ = {
 'precios-hay-compromiso-de-permanencia': ('Is there a minimum commitment?', '<p>No. All our plans are contract-free. You can cancel whenever you want and keep access until the end of your paid period.</p>'),
 'precios-la-prueba-gratuita-requiere-tarjeta-de-credito': ('Does the free trial require a credit card?', '<p>No. The 14-day trial is completely free and requires no credit card. We only ask for payment details if you decide to continue.</p>'),
 'precios-ofrecen-descuentos-para-despachos-pequenos': ('Do you offer discounts for small firms?', '<p>Yes. Annual plans include one month free (about 8.3% off). We also have special programs for recent graduates and pro bono practices. Contact us for details.</p>'),
 'precios-puedo-cambiar-de-plan-en-cualquier-momento': ('Can I change plans at any time?', '<p>Yes, you can upgrade or downgrade whenever you want. Changes apply on your next billing cycle. If you upgrade, you only pay the prorated difference.</p>'),
 'precios-que-metodos-de-pago-aceptan': ('Which payment methods do you accept?', '<p>We accept credit and debit cards (Visa, Mastercard, American Express), bank transfer and PayPal. Invoicing is available for enterprise plans.</p>'),
 'precios-que-pasa-con-mis-datos-si-cancelo': ('What happens to my data if I cancel?', '<p>You have 30 days after cancelling to export all your data. After that period we securely delete it from our servers.</p>'),
 'seguridad-como-puedo-verificar-que-mis-datos-estan-seguros': ('How can I verify that my data is safe?', '<p>You can review the audit logs at any time to see who accessed which information. We also offer independent security audits and compliance reports on request.</p>'),
 'seguridad-la-ia-puede-inventar-informacion-sobre-mis-casos': ('Can the AI make up information about my cases?', '<p>The system is designed to minimize that risk. The AI answers only from the documents in your case, not from general knowledge. Every answer includes verifiable citations and a confidence indicator, and if there is not enough information the system says so clearly.</p>'),
 'seguridad-mis-archivos-estan-cifrados-en-el-servidor': ('Are my files encrypted on the server?', '<p>Yes. Since version 4.5.0 every uploaded file is automatically encrypted with <strong>AES-256-GCM</strong>, the most secure encryption standard available. Highlights:</p><ul><li><strong>Transparent encryption:</strong> files are encrypted on upload and decrypted on download automatically</li><li><strong>Per-case keys:</strong> each case uses a unique derived key (HKDF)</li><li><strong>GCM authentication:</strong> detects any tampering with the file</li><li><strong>Backward compatible:</strong> earlier files keep working normally</li></ul><p>Even with physical access to the server, files would be completely unreadable without the master encryption key.</p>'),
 'seguridad-mis-documentos-se-envian-a-servidores-externos': ('Are my documents sent to external servers?', '<p>No. Your full documents never leave your infrastructure. Only small, decontextualized fragments are sent to the AI APIs when you ask a question. Those fragments contain no client identifiers or information that could link them to a specific case.</p>'),
 'seguridad-openai-anthropic-pueden-ver-mis-datos': ('Can OpenAI or Anthropic see my data?', '<p>The enterprise APIs of these providers have strict no-retention and no-training policies. Data sent through the API is processed in real time and discarded immediately. It is neither stored nor used to improve their models, and this is guaranteed by contract.</p>'),
 'seguridad-puedo-usar-iurefficient-para-informacion-clasificada': ('Can I use Iurefficient for classified information?', '<p>For highly sensitive or classified information we recommend an on-premise deployment with local AI models (no connection to external APIs). This configuration is available for organizations with special security requirements.</p>'),
 'seguridad-que-pasa-si-hay-una-brecha-de-seguridad': ('What happens if there is a security breach?', '<p>We have an incident response protocol that includes automatic anomaly detection, immediate notification to those affected (within 72 hours, as GDPR requires), forensic analysis, remediation of vulnerabilities, and reporting to the authorities when required by law.</p>'),
}
for f in glob.glob(f'{ROOT}/data/content/faq/*.json'):
    d = J(f); en = FAQ.get(d['slug'])
    d['title'] = i18n(d['title'], en[0] if en else None); d['answer'] = i18n(d['answer'], en[1] if en else None)
    W(f, d)

# ------------------------------------------------------------------ equipo
TEAM = {
 'frida-velazquez-esquer': ('Co-founder', 'Lawyer with a diploma in Digital Law and Legaltech from the Centro de Estudios Jurídicos Carbonell. Our mission is to make legal practice more accessible through technology.'),
 'eduardo-llaguno-velasco': ('Co-founder', 'Passionate about the intersection of law and technology. We built Iurefficient to solve the problems we faced in our own practice.'),
}
for f in glob.glob(f'{ROOT}/data/content/equipo/*.json'):
    d = J(f); en = TEAM.get(d['slug'])
    d['role'] = i18n(d.get('role', ''), en[0] if en else None); d['bio'] = i18n(d.get('bio', ''), en[1] if en else None)
    W(f, d)

# ------------------------------------------------------------------ legales
PRIV_EN = """<h2>1. Data Controller</h2>
<p><strong>Iurefficient</strong>, with address at [Full address], Mexico City, Mexico, is responsible for the processing of your personal data under the Mexican Federal Law on the Protection of Personal Data Held by Private Parties (LFPDPPP) and its Regulations.</p>
<h2>2. Personal Data We Collect</h2>
<h3>2.1 Identification and Contact Data</h3>
<ul><li>Full name</li><li>Email address</li><li>Phone number</li><li>Name of the firm or organization</li><li>Position or role</li></ul>
<h3>2.2 Billing Data</h3>
<ul><li>Tax ID (RFC)</li><li>Tax address</li><li>Bank or credit card details (processed by PCI-DSS certified third parties)</li></ul>
<h3>2.3 Service Usage Data</h3>
<ul><li>Activity logs on the platform</li><li>Configuration preferences</li><li>IP address and device data</li><li>Cookies and similar technologies</li></ul>
<h3>2.4 User Content</h3>
<p>The documents, cases and other information you upload to the platform are treated as confidential information under strict security measures. This content is exclusively yours and is not used for any purpose other than providing you the service.</p>
<h2>3. Purposes of Processing</h2>
<h3>3.1 Primary Purposes (necessary)</h3>
<ul><li>Providing access to the Iurefficient platform</li><li>Processing and managing your subscription</li><li>Issuing invoices and tax receipts</li><li>Providing technical support and customer service</li><li>Sending service-related notifications</li><li>Complying with legal obligations</li></ul>
<h3>3.2 Secondary Purposes (with your consent)</h3>
<ul><li>Sending information about new features and updates</li><li>Running satisfaction surveys</li><li>Sending marketing communications</li><li>Preparing statistics and market studies (anonymized data)</li></ul>
<p>If you do not want your data processed for secondary purposes, you may say so by emailing <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a>.</p>
<h2>4. Data Transfers</h2>
<p>Your personal data may be transferred to:</p>
<ul><li><strong>Infrastructure providers:</strong> for hosting and operating the platform (servers in Mexico)</li><li><strong>Payment processors:</strong> to handle transactions (PCI-DSS certified)</li><li><strong>AI service providers:</strong> for artificial intelligence features (no data retention)</li><li><strong>Competent authorities:</strong> when required by law</li></ul>
<blockquote><p><strong>Important:</strong> we do not sell, rent or share your personal data with third parties for marketing purposes without your express consent.</p></blockquote>
<h2>5. ARCO Rights</h2>
<p>You have the right to:</p>
<ul><li><strong>Access:</strong> know which personal data we hold about you</li><li><strong>Rectification:</strong> request the correction of inaccurate or incomplete data</li><li><strong>Cancellation:</strong> request the deletion of your data</li><li><strong>Opposition:</strong> object to the processing of your data for certain purposes</li></ul>
<p>To exercise your ARCO rights, send a request to <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a> including:</p>
<ol><li>Full name and registered email address</li><li>A clear description of the right you wish to exercise</li><li>Documents proving your identity</li></ol>
<p>We will respond within a maximum of 20 business days.</p>
<h2>6. Use of Cookies</h2>
<p>We use cookies and similar technologies to:</p>
<ul><li>Keep your session active</li><li>Remember your preferences</li><li>Analyze platform usage (analytics)</li><li>Improve the user experience</li></ul>
<p>You can configure your browser to reject cookies, although this may affect the functionality of the platform.</p>
<h2>7. Security Measures</h2>
<p>We implement administrative, technical and physical security measures to protect your personal data, including:</p>
<ul><li>AES-256 encryption for data at rest</li><li>TLS 1.3 encryption for data in transit</li><li>Role-based access controls</li><li>Continuous security monitoring</li><li>Periodic security audits</li><li>Staff training in data protection</li></ul>
<p>For more information about our security practices, visit our <a href="/en/seguridad">security page</a>.</p>
<h2>8. Changes to this Privacy Notice</h2>
<p>We reserve the right to modify this Privacy Notice at any time. Changes will be notified through:</p>
<ul><li>Publication on our website</li><li>Email notification (for substantial changes)</li><li>A notice within the platform</li></ul>
<h2>9. Contact</h2>
<p>If you have questions or comments about this Privacy Notice or the processing of your data, you can contact us:</p>
<ul><li><strong>Email:</strong> <a href="mailto:contacto@iurefficient.com">contacto@iurefficient.com</a></li><li><strong>ARCO rights:</strong> <a href="mailto:privacidad@iurefficient.com">privacidad@iurefficient.com</a></li><li><strong>Phone:</strong> [Contact number]</li><li><strong>Address:</strong> [Full address]</li></ul>
<p>This Privacy Notice is issued in compliance with the Federal Law on the Protection of Personal Data Held by Private Parties (LFPDPPP), published in the Official Gazette of the Federation on July 5, 2010, and its Regulations.</p>"""
TERMS_EN = """<h2>1. Acceptance of the Terms</h2>
<p>By accessing or using the Iurefficient services ("the Service"), you agree to be legally bound by these Terms and Conditions ("Terms"). If you do not agree with any part of these Terms, you may not access the Service.</p>
<p>These Terms constitute a legally binding agreement between you (as an individual or on behalf of an entity) and Iurefficient.</p>
<h2>2. Description of the Service</h2>
<p>Iurefficient is a software-as-a-service (SaaS) platform that provides:</p>
<ul><li>Legal case and file management</li><li>Document storage and organization</li><li>Artificial intelligence analysis tools</li><li>Calendar and deadline management</li><li>Collaboration features</li></ul>
<p>We reserve the right to modify, suspend or discontinue any aspect of the Service at any time, with reasonable prior notice when possible.</p>
<h2>3. Registration and Account</h2>
<h3>3.1 Requirements</h3>
<p>To use the Service you must:</p>
<ul><li>Be at least 18 years old</li><li>Provide accurate and complete information</li><li>Keep your password secure</li><li>Notify us immediately of any unauthorized use</li></ul>
<h3>3.2 Account Responsibility</h3>
<p>You are responsible for all activity that occurs under your account. Iurefficient will not be liable for losses caused by unauthorized use of your account.</p>
<h2>4. Acceptable Use</h2>
<p>By using the Service, you agree NOT to:</p>
<ul><li>Violate applicable laws or regulations</li><li>Infringe third-party intellectual property rights</li><li>Upload illegal, defamatory or malicious content</li><li>Attempt to access systems or data without authorization</li><li>Interfere with the operation of the Service</li><li>Use the Service to send spam or malware</li><li>Reverse engineer the software</li><li>Resell or sublicense the Service without authorization</li><li>Share access credentials with unauthorized third parties</li></ul>
<blockquote class="warning-box"><p><strong>Warning:</strong> violating these rules may result in the immediate suspension or termination of your account, without refund.</p></blockquote>
<h2>5. Intellectual Property</h2>
<h3>5.1 Iurefficient Property</h3>
<p>The Service, including its software, design, logos, texts and other elements, is the exclusive property of Iurefficient and is protected by intellectual property laws. You are granted a limited, non-exclusive, non-transferable and revocable license to use the Service in accordance with these Terms.</p>
<h3>5.2 Your Content</h3>
<p>You retain all rights to the content you upload to the Service. By uploading content, you grant us a limited license to store, process and display that content solely for the purpose of providing you the Service.</p>
<h2>6. User Content</h2>
<h3>6.1 Responsibility</h3>
<p>You are solely responsible for the content you upload, store or process through the Service. You warrant that you have the necessary rights to that content and that it does not violate third-party rights.</p>
<h3>6.2 Confidentiality</h3>
<p>We understand that your content may include confidential information about your clients. We commit to keeping that content confidential in accordance with our <a href="/en/legal/privacidad">Privacy Notice</a> and security best practices.</p>
<h3>6.3 Use of AI</h3>
<p>When you use the artificial intelligence features, your content is processed to provide you with answers and analysis. This content is NOT used to train third-party AI models and is removed from memory immediately after processing.</p>
<h2>7. Payments and Billing</h2>
<h3>7.1 Prices</h3>
<p>Service prices are published on our <a href="/en/precios">pricing page</a>. Prices do not include taxes, which will be added where applicable.</p>
<h3>7.2 Billing Cycle</h3>
<p>Billing is monthly or annual, depending on the plan selected. Charges are made at the start of each period. Annual plans are billed in advance.</p>
<h3>7.3 Payment Methods</h3>
<p>We accept credit and debit cards, bank transfer and PayPal. You authorize automatic charges according to the selected billing cycle.</p>
<h3>7.4 Price Changes</h3>
<p>We reserve the right to modify prices. Changes will be notified at least 30 days in advance and will apply on the next billing cycle.</p>
<h2>8. Cancellation</h2>
<h3>8.1 By the User</h3>
<p>You may cancel your subscription at any time from your account settings. Cancellation takes effect at the end of the current billing period. No refunds are made for partial periods, except within the first 30 days (satisfaction guarantee).</p>
<h3>8.2 By Iurefficient</h3>
<p>We may suspend or terminate your account if:</p>
<ul><li>You violate these Terms</li><li>You do not make the corresponding payment</li><li>Your use represents a security risk</li><li>It is required by law</li></ul>
<h3>8.3 Effect of Cancellation</h3>
<p>After cancellation you will have 30 days to export your content. After that period, your content will be securely deleted from our servers.</p>
<h2>9. Warranties and Limitations</h2>
<h3>9.1 Satisfaction Guarantee</h3>
<p>We offer a 30-day satisfaction guarantee. If you are not satisfied with the Service within the first 30 days, we will refund 100% of your payment.</p>
<h3>9.2 Availability</h3>
<p>We strive to maintain 99.9% availability (Firm plan) and 99.5% (other plans). However, the Service is provided "as is" and we do not guarantee that it will be free of errors or interruptions.</p>
<h3>9.3 Disclaimer of Warranties</h3>
<p>To the maximum extent permitted by law, we disclaim all implied warranties, including those of merchantability, fitness for a particular purpose and non-infringement.</p>
<h2>10. Limitation of Liability</h2>
<p>To the maximum extent permitted by applicable law:</p>
<ul><li>Iurefficient will not be liable for indirect, incidental, special, consequential or punitive damages</li><li>Our total liability will not exceed the amount you paid in the last 12 months</li><li>We are not responsible for losses arising from decisions made based on AI analysis</li></ul>
<blockquote><p><strong>Note:</strong> AI tools are assistants and do not replace professional judgment. Always verify important information independently.</p></blockquote>
<h2>11. Changes to the Terms</h2>
<p>We may modify these Terms at any time. Substantial changes will be notified at least 30 days in advance by email and/or within the Service. Continued use of the Service after the changes constitutes acceptance of the new Terms.</p>
<h2>12. Governing Law and Jurisdiction</h2>
<p>These Terms are governed by the laws of the United Mexican States. Any dispute will be submitted to the exclusive jurisdiction of the competent courts of Mexico City.</p>
<p>Before starting any legal proceeding, the parties agree to try to resolve the dispute through good-faith negotiation for a period of 30 days.</p>
<h2>13. Contact</h2>
<p>For questions about these Terms, contact us:</p>
<ul><li><strong>Email:</strong> <a href="mailto:legal@iurefficient.com">legal@iurefficient.com</a></li><li><strong>General email:</strong> <a href="mailto:contacto@iurefficient.com">contacto@iurefficient.com</a></li></ul>
<p>By using Iurefficient, you acknowledge that you have read, understood and accepted these Terms and Conditions.</p>"""
LEGAL = {
 'privacidad': ('Privacy Notice', 'Last updated: January 2025', 'We collect the information needed to provide our services. We do not sell your data. Your documents are confidential and encrypted. You can exercise your ARCO rights at any time.', PRIV_EN),
 'terminos': ('Terms and Conditions', 'Last updated: January 2025', 'By using Iurefficient you accept these terms. You own your content. We license the software to you. You can cancel at any time. Respect the acceptable use rules.', TERMS_EN),
}
for slug, (t, u, sm, body) in LEGAL.items():
    f = f'{ROOT}/data/content/legal/{slug}.json'; d = J(f)
    d['title'] = i18n(d['title'], t); d['updated_label'] = i18n(d.get('updated_label', ''), u); d['summary'] = i18n(d.get('summary', ''), sm); d['body'] = i18n(d['body'], body)
    W(f, d)

# ------------------------------------------------------------------ páginas del constructor: portada y abogados
def sec(type_, data, style=None, sid=None):
    import hashlib
    return collections.OrderedDict([('id', sid or hashlib.md5((type_ + json.dumps(data, ensure_ascii=False)).encode()).hexdigest()[:6]), ('type', type_), ('data', data), ('style', style or {}), ('hidden', False)])

def translate_sections(sections, EN_BY_ID):
    """EN_BY_ID: {index: {campo: valor_en}} → convierte cada campo con traducción a i18n."""
    for i, s in enumerate(sections):
        en = EN_BY_ID.get(i, {})
        for k, v in list(s['data'].items()):
            if k in en: s['data'][k] = i18n(v, en[k])
    return sections

# --- inicio (Teams)
f = f'{ROOT}/data/content/paginas/inicio.json'; d = J(f)
d['title'] = i18n(d['title'], 'Teams home'); d['summary'] = i18n(d.get('summary', ''), EN['home_meta_desc'])
d['seo_title'] = i18n(d.get('seo_title', ''), EN['home_meta_title']); d['seo_desc'] = i18n(d.get('seo_desc', ''), EN['home_meta_desc'])
d['sections'] = translate_sections(d['sections'], {
 0: {'title': 'The project plan <span class="gradient-text">isn\'t written</span>, it\'s talked through', 'subtitle': 'Iurefficient Teams is the first project management platform where the AI chat automatically generates your tasks, dependencies and schedule. <em>Fewer clicks, more plan.</em>', 'buttons': ['Try free for 14 days | #contacto | primary', 'See how it works | #video | secondary'], 'badges': ['🤖 | Native AI', '📊 | Kanban + Gantt', '⚡ | A plan in minutes', '🔒 | Enterprise security']},
 1: {'title': 'Does your team spend more time <span class="gradient-text">organizing the work</span> than doing it?', 'subtitle': 'These problems are more common than you think.', 'before_title': 'Without Iurefficient Teams', 'before_items': ['Endless spreadsheets nobody updates', '40-minute meetings to decide who does what', 'Deadlines that collide without warning', 'Dependencies invisible until something slips'], 'after_title': 'With Iurefficient Teams', 'after_items': ['An executable plan generated by AI in minutes', 'Tasks and owners assigned automatically', 'A calendar that adjusts when something changes', 'Visible dependencies and real-time alerts']},
 2: {'title': 'From chaos to an executable plan <span class="gradient-text">in minutes</span>', 'subtitle': 'Iurefficient Teams brings together your project vision, your team\'s tasks, the calendar and communication in one place. What makes it different is <strong>iure</strong>, the AI assistant that understands your project and helps you build it by talking.', 'items': ['Chat with iure | Say what you need. The AI returns tasks, subtasks and dependencies ready to run. | chat', 'Smart calendar | Dates move automatically when something changes. No surprises or double bookings. | calendar', 'Live Kanban and Gantt | See the project the way you want. Both views always in sync. | grid', 'Attachments and comments | All the context of a task in one place. No digging through email or shared folders. | clip']},
 3: {'title': 'See Iurefficient <span class="gradient-text">in action</span>', 'subtitle': 'Find out how you can save up to 70% of your time'},
 4: {'title': 'Get to know the <span class="gradient-text">platform</span>', 'subtitle': 'An intuitive interface designed for real teams', 'hint': 'Scroll to explore'},
 5: {'title': 'Built for teams <span class="gradient-text">that execute</span>', 'subtitle': 'Not only for law firms. Iurefficient Teams adapts to any team that manages projects.', 'items': ['Construction and engineering | Project offices (PMOs) that coordinate several sites or initiatives at once. | 🏗️', 'Marketing and product | Teams that launch campaigns and products and need real-time visibility of progress. | 📈', 'Consultancies | Firms that manage multiple client initiatives and need order without bureaucracy. | 🏢', 'Academic coordinators | Research and academic coordination teams with complex deadlines and deliverables. | 🎓']},
 6: {'quote': 'At the construction company we run 12 sites at once. With Iurefficient I set up the structure of a new site in the time it took us to have coffee.', 'cite': 'Early adopter, early access program'},
 7: {'title': 'They bolted AI on top. <span class="gradient-text">We were born with AI inside.</span>', 'subtitle': 'The difference between a patch and an AI-native platform.', 'head': 'Feature | Monday / Asana / Jira | Iurefficient Teams', 'rows': ['Plan creation | Manual, task by task | Conversational, in minutes', 'Built-in AI | A patch on a legacy product | Native: understands dependencies and dates', 'Price (team of 8) | ~$10,000-15,000 MXN/month | From $1,499 MXN/month', 'Real focus | Generic, needs configuration | Ready for a PMO with no learning curve', 'AI assistant | Basic, limited features | iure: generates full plans from chat']},
 8: {'title': 'Plans for <span class="gradient-text">teams of any size</span>', 'subtitle': 'No long-term contracts. Cancel whenever you want.'},
 9: {'title': 'Your project data, <span class="gradient-text">always protected</span>', 'subtitle': 'We use the same infrastructure that hundreds of law firms already trust.', 'items': ['AES-256 encryption | All your documents and project data encrypted at rest and in transit | lock', 'Google Cloud Platform | Infrastructure hosted on Google Cloud with enterprise security controls | shield', 'Automatic backups | Daily backups with 30-day retention for your peace of mind | check', 'AI privacy | Your documents are never used to train external models | shield']},
 10: {'title': 'Ready for your next project plan to be made in a conversation?', 'button_text': 'I want to be an early adopter', 'note': 'No commitment · 14 days free · Support included'},
})
W(f, d)

# --- derecho (abogados)
f = f'{ROOT}/data/content/paginas/derecho.json'; d = J(f)
d['title'] = i18n(d['title'], 'Law firms'); d['summary'] = i18n(d.get('summary', ''), 'Iurefficient is AI legal software for lawyers and law firms in Mexico: case management, document analysis and assisted drafting. Save up to 70% of your time. Free demo.')
d['seo_title'] = i18n(d.get('seo_title', ''), 'AI case management software for lawyers and law firms'); d['seo_desc'] = i18n(d.get('seo_desc', ''), 'Iurefficient is AI legal software for lawyers and law firms in Mexico: case management, document analysis and assisted drafting. Save up to 70% of your time. Free demo.')
d['sections'] = translate_sections(d['sections'], {
 0: {'title': 'The law, <span class="gradient-text">one click</span> away', 'subtitle': 'Manage cases, analyze documents and power your legal practice with artificial intelligence. <strong>Save up to 70% of your time.</strong>', 'buttons': ['Request a free demo | #contacto | primary', 'Why use Iurefficient? | https://www.youtube.com/watch?v=2RqRNHPVC9U | youtube', 'See how it works | #video | secondary'], 'badges': ['🔒 | AES-256 encryption', '🔐 | Private servers', '⚡ | 99.9% uptime', '🛡️ | Enterprise security']},
 1: {'title': 'Modern lawyers, <span class="gradient-text">constant challenges</span>', 'subtitle': 'We know what you face every day. That is why we built Iurefficient.', 'before_title': 'Without Iurefficient', 'before_items': ['Documents scattered across folders and emails', 'Deadlines forgotten until the last minute', 'Hours searching for information in case files', 'Repetitive work that eats your time'], 'after_title': 'With Iurefficient', 'after_items': ['Everything centralized on a secure platform', 'Automatic alerts for important dates', 'AI that finds what you need in seconds', 'Automation that frees you for what matters']},
 2: {'title': 'Everything you need to <span class="gradient-text">power your practice</span>', 'subtitle': 'Tools designed specifically for legal professionals', 'items': ['Smart document management | Organize, search and analyze legal documents with AI. Extract key clauses automatically. | doc', 'Full control of clients and cases | Centralize case files, case tracking and client communication in one place. | users', 'Legal AI assistant | Ask about your cases in plain language. Get answers grounded in your documents. | bot', 'Smart legal calendar | Never miss a deadline. Automatic alerts for hearings, expirations and key dates. | calendar']},
 3: {'title': 'See Iurefficient <span class="gradient-text">in action</span>', 'subtitle': 'Find out how you can save up to 70% of your time'},
 4: {'title': 'Get to know the <span class="gradient-text">platform</span>', 'subtitle': 'An intuitive interface designed for lawyers', 'hint': 'Scroll to explore'},
 5: {'title': 'Results that <span class="gradient-text">transform</span>', 'items': ['Save up to 70% of your time | On administrative tasks and information searches | ⏱️', 'Triple your productivity | More cases handled with the same quality in less time | 📈', 'Bank-grade security | Your data and your clients\' data always protected | 🔒', 'Informed decisions | Data and metrics of your practice in real time | 💡', 'Focus on your clients | Spend your time on what really matters | 🎯']},
 6: {'title': 'Your information, <span class="gradient-text">always protected</span>', 'subtitle': 'We use the same infrastructure that hundreds of law firms already trust.', 'items': ['AES-256 encryption | All your documents and conversations encrypted at rest and in transit | lock', 'Google Cloud Platform | Infrastructure hosted on Google Cloud with enterprise security controls | shield', 'Automatic backups | Daily backups with 30-day retention for your peace of mind | check', 'AI privacy | Your documents are never used to train external models | shield']},
 7: {'title': 'Our security standards', 'items': ['🔐 | SSL/TLS', '🛡️ | Enterprise controls', '🌐 | GDPR ready', '☁️ | Based on ISO 27001'], 'button_text': 'Learn more about our security'},
 8: {'title': 'Built by lawyers, <span class="gradient-text">for lawyers</span>', 'subtitle': 'A team that understands the legal profession'},
 9: {'title': 'Plans that adapt to <span class="gradient-text">your practice</span>', 'subtitle': 'No long-term contracts. Cancel whenever you want.', 'footer_text': 'See the full plan comparison'},
 10: {'title': 'Ready to transform your legal practice?', 'text': 'Join hundreds of lawyers who have already streamlined their work', 'button_text': 'Request a free demo', 'note': 'No commitment • Set up in 24 hours • Support included'},
})
# la sección de insignias apunta a /seguridad (ruta relativa: el idioma lo resuelve el enlace)
W(f, d)

# ------------------------------------------------------------------ página precios
def I(es, en): return i18n(es, en)
precios = collections.OrderedDict([
 ('slug', 'precios'), ('status', 'published'), ('title', I('Precios', 'Pricing')), ('brand', 'teams'), ('parent', ''), ('path', 'precios'), ('order', 3), ('image', ''),
 ('summary', I(S['precios_meta_desc']['es'], EN['precios_meta_desc'])), ('seo_title', I(S['precios_meta_title']['es'], EN['precios_meta_title'])), ('seo_desc', I(S['precios_meta_desc']['es'], EN['precios_meta_desc'])),
 ('created', '2026-09-05'), ('updated', '2026-09-05'),
 ('sections', [
  sec('encabezado', collections.OrderedDict([('title', I('Planes transparentes, <span class="gradient-text">sin sorpresas</span>', 'Transparent plans, <span class="gradient-text">no surprises</span>')), ('text', I('Elige el plan que mejor se adapte a tu práctica. Sin contratos forzosos, cancela cuando quieras.', 'Choose the plan that best fits your practice. No long-term contracts, cancel whenever you want.')), ('note', I('', '')), ('dark', False)])),
  sec('planes', collections.OrderedDict([('title', I('Elige <span class="gradient-text">tu plan</span>', 'Choose <span class="gradient-text">your plan</span>')), ('subtitle', I('Todos incluyen 14 días de prueba gratuita.', 'All plans include a 14-day free trial.')), ('product', 'precios'), ('toggle', True), ('footer_text', I('', '')), ('footer_url', '')]), {'pad': 's', 'anchor': 'planes'}),
  sec('tabla', collections.OrderedDict([('title', I('Comparativa <span class="gradient-text">detallada</span>', 'Detailed <span class="gradient-text">comparison</span>')), ('subtitle', I('Todas las características lado a lado', 'Every feature side by side')), ('head', I('Característica', 'Feature')), ('product', 'precios'),
    ('rows', I(['Gestión de Casos:', 'Casos activos | 50 | 200 | Ilimitados', 'Gestión de clientes | si | si | si', 'Calendario legal | si | si | si', 'Alertas de plazos | si | si | si',
                'Inteligencia Artificial:', 'Consultas IA mensuales | 500 | 2,000 | 10,000', 'Análisis de documentos | si | si | si', 'Extracción de cláusulas | si | si | si', 'Resumen automático | si | si | si', 'Búsqueda semántica avanzada | no | si | si',
                'Almacenamiento y Documentos:', 'Almacenamiento | 2 GB | 4 GB | 40 GB', 'Versionado de documentos | si | si | si', 'OCR para PDFs escaneados | no | si | si',
                'Colaboración:', 'Usuarios incluidos | 3 | 15 | 100', 'Roles y permisos | no | si | si', 'Historial de actividad | 30 días | 90 días | Ilimitado',
                'Integraciones:', 'Google Calendar | no | si | si', 'Google Drive | no | si | si', 'Microsoft 365 | no | no | si', 'API acceso | no | si | si', 'Webhooks | no | no | si',
                'Soporte:', 'Tipo de soporte | Email | Prioritario | Dedicado 24/7', 'Tiempo de respuesta | 48 horas | 12 horas | 2 horas', 'Capacitación | Documentación | Webinars | Personalizada', 'SLA garantizado | no | 99.5% | 99.9%'],
               ['Case Management:', 'Active cases | 50 | 200 | Unlimited', 'Client management | yes | yes | yes', 'Legal calendar | yes | yes | yes', 'Deadline alerts | yes | yes | yes',
                'Artificial Intelligence:', 'Monthly AI queries | 500 | 2,000 | 10,000', 'Document analysis | yes | yes | yes', 'Clause extraction | yes | yes | yes', 'Automatic summaries | yes | yes | yes', 'Advanced semantic search | no | yes | yes',
                'Storage and Documents:', 'Storage | 2 GB | 4 GB | 40 GB', 'Document versioning | yes | yes | yes', 'OCR for scanned PDFs | no | yes | yes',
                'Collaboration:', 'Users included | 3 | 15 | 100', 'Roles and permissions | no | yes | yes', 'Activity history | 30 days | 90 days | Unlimited',
                'Integrations:', 'Google Calendar | no | yes | yes', 'Google Drive | no | yes | yes', 'Microsoft 365 | no | no | yes', 'API access | no | yes | yes', 'Webhooks | no | no | yes',
                'Support:', 'Support type | Email | Priority | Dedicated 24/7', 'Response time | 48 hours | 12 hours | 2 hours', 'Training | Documentation | Webinars | Custom', 'Guaranteed SLA | no | 99.5% | 99.9%']))]), {'anchor': 'comparativa'}),
  sec('faq', collections.OrderedDict([('title', I('Preguntas <span class="gradient-text">frecuentes</span>', 'Frequently asked <span class="gradient-text">questions</span>')), ('section', 'precios'), ('items', I([], []))]), {'anchor': 'faq'}),
  sec('testimonio', collections.OrderedDict([('quote', I('🛡️ Garantía de satisfacción de 30 días: si no estás completamente satisfecho con Iurefficient en los primeros 30 días, te devolvemos el 100% de tu dinero. Sin preguntas.', '🛡️ 30-day satisfaction guarantee: if you are not completely satisfied with Iurefficient in the first 30 days, we refund 100% of your money. No questions asked.')), ('cite', I('', ''))]), {'bg': 'light', 'pad': 'm'}),
  sec('cta', collections.OrderedDict([('title', I('¿Listo para empezar?', 'Ready to get started?')), ('text', I('Prueba Iurefficient gratis por 14 días. Sin tarjeta de crédito.', 'Try Iurefficient free for 14 days. No credit card required.')), ('form', False), ('origin', 'derecho'), ('button_text', I('Comenzar prueba gratuita', 'Start free trial')), ('button_url', '/derecho#contacto'), ('note', I('', '')), ('gradient', False)]), {'anchor': 'contacto'}),
 ]),
])
W(f'{ROOT}/data/content/paginas/precios.json', precios)

# ------------------------------------------------------------------ página seguridad
tocES = '<div class="toc-grid"><a href="#resumen" class="toc-item"><span>📋</span> Resumen ejecutivo</a><a href="#seguridad-datos" class="toc-item"><span>🔐</span> Seguridad de datos</a><a href="#confidencialidad" class="toc-item"><span>🤫</span> Confidencialidad</a><a href="#privacidad-ia" class="toc-item"><span>🤖</span> Privacidad e IA</a><a href="#infraestructura" class="toc-item"><span>🏗️</span> Infraestructura</a><a href="#cumplimiento" class="toc-item"><span>⚖️</span> Cumplimiento legal</a><a href="#derechos" class="toc-item"><span>✋</span> Tus derechos</a><a href="#faq" class="toc-item"><span>❓</span> Preguntas frecuentes</a></div>'
tocEN = '<div class="toc-grid"><a href="#resumen" class="toc-item"><span>📋</span> Executive summary</a><a href="#seguridad-datos" class="toc-item"><span>🔐</span> Data security</a><a href="#confidencialidad" class="toc-item"><span>🤫</span> Confidentiality</a><a href="#privacidad-ia" class="toc-item"><span>🤖</span> Privacy and AI</a><a href="#infraestructura" class="toc-item"><span>🏗️</span> Infrastructure</a><a href="#cumplimiento" class="toc-item"><span>⚖️</span> Legal compliance</a><a href="#derechos" class="toc-item"><span>✋</span> Your rights</a><a href="#faq" class="toc-item"><span>❓</span> FAQ</a></div>'
seguridad = collections.OrderedDict([
 ('slug', 'seguridad'), ('status', 'published'), ('title', I('Seguridad', 'Security')), ('brand', 'derecho'), ('parent', ''), ('path', 'seguridad'), ('order', 4), ('image', ''),
 ('summary', I(S['seguridad_meta_desc']['es'], EN['seguridad_meta_desc'])), ('seo_title', I(S['seguridad_meta_title']['es'], EN['seguridad_meta_title'])), ('seo_desc', I(S['seguridad_meta_desc']['es'], EN['seguridad_meta_desc'])),
 ('created', '2026-09-05'), ('updated', '2026-09-05'),
 ('sections', [
  sec('encabezado', collections.OrderedDict([('title', I('Seguridad, confidencialidad y <span class="gradient-text">privacidad</span>', 'Security, confidentiality and <span class="gradient-text">privacy</span>')), ('text', I('Información completa sobre cómo protegemos tu información y la de tus clientes. A diferencia de servicios de IA genéricos, tu información nunca sale de tu control.', 'Everything about how we protect your information and your clients\'. Unlike generic AI services, your information never leaves your control.')), ('note', I('Última actualización: Enero 2026 | Versión del documento: 1.0', 'Last updated: January 2026 | Document version: 1.0')), ('dark', True)])),
  sec('html', collections.OrderedDict([('code', I(tocES, tocEN))]), {'pad': 's'}),
  sec('texto', collections.OrderedDict([('body', I('<h2>Resumen <span class="gradient-text">ejecutivo</span></h2><blockquote><p><strong>Compromiso de seguridad.</strong> Iurefficient está diseñado desde su arquitectura para proteger la información confidencial de profesionales y sus clientes. A diferencia de servicios de IA genéricos, tu información <strong>nunca sale de tu control</strong>.</p></blockquote>', '<h2>Executive <span class="gradient-text">summary</span></h2><blockquote><p><strong>Security commitment.</strong> Iurefficient is designed from its architecture up to protect the confidential information of professionals and their clients. Unlike generic AI services, your information <strong>never leaves your control</strong>.</p></blockquote>'))]), {'anchor': 'resumen', 'width': 'narrow'}),
  sec('tarjetas', collections.OrderedDict([('title', I('', '')), ('subtitle', I('Puntos clave de seguridad', 'Key security points')), ('variant', 'security'), ('items', I(['Tus datos son tuyos | Todos los documentos, conversaciones y análisis permanecen en tu infraestructura. | ✅', 'Sin entrenamiento de IA | Tu información nunca se usa para entrenar modelos de inteligencia artificial. | ✅', 'Aislamiento por caso | Cada caso tiene su propia base de conocimiento aislada. Sin mezcla de información. | ✅', 'Cifrado completo | Cifrado en tránsito (TLS 1.3) y en reposo (AES-256) para toda la información. | ✅'], ['Your data is yours | Every document, conversation and analysis stays in your infrastructure. | ✅', 'No AI training | Your information is never used to train artificial intelligence models. | ✅', 'Isolation per case | Each case has its own isolated knowledge base. No mixing of information. | ✅', 'Full encryption | Encryption in transit (TLS 1.3) and at rest (AES-256) for all information. | ✅']))]), {'pad': 's'}),
  sec('tabla', collections.OrderedDict([('title', I('Comparación con servicios de <span class="gradient-text">IA públicos</span>', 'Comparison with <span class="gradient-text">public AI services</span>')), ('subtitle', I('Entiende la diferencia entre usar ChatGPT o Claude.ai directamente e Iurefficient', 'Understand the difference between using ChatGPT or Claude.ai directly and Iurefficient')), ('head', I('Característica | ChatGPT / Claude.ai | Iurefficient', 'Feature | ChatGPT / Claude.ai | Iurefficient')), ('product', ''),
    ('rows', I(['Ubicación de datos | Servidores de terceros (EE. UU.) | Tu infraestructura privada', 'Entrenamiento con tus datos | Posible (según configuración) | Nunca, solo procesamiento', 'Base de conocimiento | Conocimiento general público | Solo tus documentos (RAG local)', 'Aislamiento de datos | Compartido entre usuarios | Aislamiento por caso y cliente', 'Retención de conversaciones | Según políticas del proveedor | Tú lo controlas por completo', 'Auditoría y trazabilidad | Limitada | Completa, con registros detallados'],
               ['Data location | Third-party servers (USA) | Your private infrastructure', 'Training on your data | Possible (depends on settings) | Never, processing only', 'Knowledge base | General public knowledge | Only your documents (local RAG)', 'Data isolation | Shared among users | Isolated per case and client', 'Conversation retention | Per provider policy | Fully under your control', 'Audit and traceability | Limited | Complete, with detailed logs']))]), {'bg': 'light'}),
  sec('texto', collections.OrderedDict([('body', I('<h2>Seguridad de <span class="gradient-text">datos</span></h2><h3>Cifrado y protección</h3><ul><li><strong>Cifrado en tránsito:</strong> TLS 1.3 con certificados SSL válidos</li><li><strong>Cifrado en reposo:</strong> AES-256 para documentos, base de datos y respaldos</li><li><strong>Cifrado de archivos (v4.5.0+):</strong> AES-256-GCM con claves derivadas únicas por caso</li><li><strong>Tokens y credenciales:</strong> contraseñas con bcrypt, JWT con expiración corta</li><li>Llaves de cifrado gestionadas de forma segura y separada</li></ul><h3>Control de acceso</h3><ul><li><strong>Autenticación robusta:</strong> JWT de corta duración, soporte OAuth 2.0</li><li><strong>MFA disponible:</strong> autenticación multifactor opcional</li><li><strong>Roles y permisos:</strong> sistema granular (Admin, Abogado, Asistente, Solo lectura)</li><li><strong>Auditoría completa:</strong> registro de todas las acciones con marcas de tiempo</li><li>Registros inmutables para cumplimiento regulatorio</li></ul><h3>Respaldos y recuperación</h3><ul><li>Respaldos automáticos cada 6 horas</li><li>Retención de 30 días (90 en plan Despacho)</li><li>Respaldos cifrados y geográficamente distribuidos</li><li>Pruebas de restauración mensuales</li><li>RTO menor a 4 horas; RPO menor a 6 horas</li></ul><h3>Monitoreo y detección</h3><ul><li>Monitoreo 24/7 de infraestructura</li><li>Detección de anomalías con machine learning</li><li>Alertas automáticas de actividad sospechosa</li><li>Pruebas de penetración anuales y programa de bug bounty</li></ul><blockquote><p><strong>Registro de auditoría.</strong> Puedes acceder al registro completo desde <strong>Configuración → Registros de auditoría</strong>: todas las acciones del sistema con marcas de tiempo precisas.</p></blockquote>',
    '<h2>Data <span class="gradient-text">security</span></h2><h3>Encryption and protection</h3><ul><li><strong>In transit:</strong> TLS 1.3 with valid SSL certificates</li><li><strong>At rest:</strong> AES-256 for documents, database and backups</li><li><strong>File encryption (v4.5.0+):</strong> AES-256-GCM with unique derived keys per case</li><li><strong>Tokens and credentials:</strong> bcrypt-hashed passwords, short-lived JWT</li><li>Encryption keys managed securely and separately</li></ul><h3>Access control</h3><ul><li><strong>Strong authentication:</strong> short-lived JWT, OAuth 2.0 support</li><li><strong>MFA available:</strong> optional multi-factor authentication</li><li><strong>Roles and permissions:</strong> granular system (Admin, Lawyer, Assistant, Read-only)</li><li><strong>Full audit:</strong> every action logged with timestamps</li><li>Immutable logs for regulatory compliance</li></ul><h3>Backups and recovery</h3><ul><li>Automatic backups every 6 hours</li><li>30-day retention (90 on the Firm plan)</li><li>Encrypted, geographically distributed backups</li><li>Monthly restore tests</li><li>RTO under 4 hours; RPO under 6 hours</li></ul><h3>Monitoring and detection</h3><ul><li>24/7 infrastructure monitoring</li><li>Anomaly detection with machine learning</li><li>Automatic alerts on suspicious activity</li><li>Annual penetration tests and a bug bounty program</li></ul><blockquote><p><strong>Audit log.</strong> You can open the full log from <strong>Settings → Audit logs</strong>: every action in the system with precise timestamps.</p></blockquote>'))]), {'anchor': 'seguridad-datos', 'width': 'narrow'}),
  sec('texto', collections.OrderedDict([('body', I('<h2>Confidencialidad y <span class="gradient-text">aislamiento</span></h2><p>Cómo garantizamos que la información de cada caso permanezca completamente separada.</p><h3>🏢 Arquitectura multi-tenant</h3><ul><li>Cada organización tiene su propia instancia aislada</li><li>Base de datos separada por tenant</li><li>Almacenamiento de documentos aislado</li><li>Índices de búsqueda independientes</li></ul><h3>📁 Aislamiento por caso</h3><ul><li>Cada caso tiene su propia colección RAG (base de conocimiento)</li><li>El chat de IA solo accede a documentos del caso activo</li><li>Imposibilidad técnica de "filtración" entre casos</li><li>Permisos granulares por caso y usuario</li></ul><blockquote><p><strong>Secreto profesional.</strong> El diseño respeta el secreto profesional abogado-cliente: ni los administradores del sistema pueden acceder al contenido de los documentos sin autorización explícita y registrada.</p></blockquote><h3>Compartir documentos de forma segura</h3><ul><li>🔗 Enlaces temporales con expiración configurable</li><li>🔑 Protección opcional con contraseña</li><li>📊 Registro de cada acceso al documento compartido</li><li>⏰ Revocación instantánea del acceso cuando sea necesario</li></ul>',
    '<h2>Confidentiality and <span class="gradient-text">isolation</span></h2><p>How we guarantee that each case\'s information stays completely separate.</p><h3>🏢 Multi-tenant architecture</h3><ul><li>Each organization has its own isolated instance</li><li>Separate database per tenant</li><li>Isolated document storage</li><li>Independent search indexes</li></ul><h3>📁 Isolation per case</h3><ul><li>Each case has its own RAG collection (knowledge base)</li><li>The AI chat only accesses documents of the active case</li><li>Technically impossible to "leak" between cases</li><li>Granular permissions per case and user</li></ul><blockquote><p><strong>Professional secrecy.</strong> The design respects attorney-client privilege: not even system administrators can access document contents without explicit, logged authorization.</p></blockquote><h3>Sharing documents securely</h3><ul><li>🔗 Temporary links with configurable expiration</li><li>🔑 Optional password protection</li><li>📊 A log of every access to the shared document</li><li>⏰ Instant revocation of access when needed</li></ul>'))]), {'anchor': 'confidencialidad', 'width': 'narrow', 'bg': 'light'}),
  sec('tarjetas', collections.OrderedDict([('title', I('Privacidad e <span class="gradient-text">inteligencia artificial</span>', 'Privacy and <span class="gradient-text">artificial intelligence</span>')), ('subtitle', I('Cuando usas ChatGPT o Claude.ai directamente, tus conversaciones se envían a servidores de terceros y pueden usarse para mejorar sus modelos. Iurefficient funciona diferente: tu información se procesa localmente y a las APIs de IA solo se envían consultas procesadas, nunca documentos completos ni datos sensibles.', 'When you use ChatGPT or Claude.ai directly, your conversations are sent to third-party servers and may be used to improve their models. Iurefficient works differently: your information is processed locally, and only processed queries are sent to the AI APIs, never full documents or sensitive data.')), ('variant', 'security'), ('items', I(['Sin entrenamiento externo | Tus documentos y conversaciones NUNCA se usan para entrenar modelos de IA de terceros como OpenAI, Google o Anthropic. | 🚫', 'Procesamiento aislado | Cada consulta de IA se procesa en un entorno aislado. Los datos se eliminan de la memoria inmediatamente después. | 🔐', 'Servidores privados | Toda la infraestructura corre en servidores privados dedicados, conforme a la regulación de protección de datos aplicable. | 📍', 'Sin retención | No almacenamos el contenido de tus consultas de IA más allá del tiempo necesario para procesarlas y mostrarte la respuesta. | 🗑️'], ['No external training | Your documents and conversations are NEVER used to train third-party AI models such as OpenAI, Google or Anthropic. | 🚫', 'Isolated processing | Each AI query is processed in an isolated environment. Data is removed from memory immediately afterwards. | 🔐', 'Private servers | All infrastructure runs on dedicated private servers, in line with applicable data protection regulations. | 📍', 'No retention | We do not store the content of your AI queries beyond the time needed to process them and show you the answer. | 🗑️']))]), {'anchor': 'privacidad-ia', 'bg': 'dark', 'text': 'light'}),
  sec('texto', collections.OrderedDict([('body', I('<h2>¿Cómo funciona la <span class="gradient-text">IA en Iurefficient</span>?</h2><ol><li><strong>Indexación local.</strong> Tus documentos se procesan y almacenan en una base de datos vectorial dentro de tu infraestructura. Los embeddings se generan localmente o mediante APIs que no retienen datos.</li><li><strong>Búsqueda semántica local.</strong> Cuando preguntas, el sistema busca en tu base de conocimiento los fragmentos más relevantes. Esta búsqueda ocurre por completo en tu servidor.</li><li><strong>Consulta a la IA con contexto limitado.</strong> Solo los fragmentos relevantes, sin identificadores de clientes ni datos sensibles directos, se envían a la API de IA junto con tu pregunta.</li><li><strong>Respuesta con citas.</strong> La respuesta incluye referencias [1], [2]… a los documentos originales, para que verifiques la fuente de cada afirmación.</li></ol><h3>Políticas de los proveedores de IA</h3><ul><li>🟢 <strong>OpenAI (API):</strong> "We do not train on your business data (data sent through the API)". <a href="https://openai.com/enterprise-privacy" target="_blank" rel="noopener">Política de privacidad empresarial</a></li><li>🟢 <strong>Anthropic (Claude API):</strong> "We do not train our models on customer API data". <a href="https://www.anthropic.com/policies/privacy-policy" target="_blank" rel="noopener">Política de privacidad</a></li><li>🟢 <strong>OpenRouter:</strong> enrutador que respeta las políticas de privacidad de cada modelo. <a href="https://openrouter.ai/privacy" target="_blank" rel="noopener">Política</a></li><li>🟢 <strong>DeepSeek / Qwen:</strong> APIs empresariales con políticas de no retención de datos.</li></ul><blockquote><p><strong>Garantía anti-entrenamiento.</strong> Ningún proveedor de IA que utiliza Iurefficient entrena sus modelos con los datos enviados a través de sus APIs empresariales. Es una garantía contractual de cada proveedor.</p></blockquote><h3>Sistema anti-alucinación</h3><ul><li>✓ Respuestas basadas <strong>únicamente</strong> en tus documentos, no en conocimiento general</li><li>✓ Citas numeradas [1], [2] que puedes verificar</li><li>✓ Indicadores de confianza (excelente, alto, moderado, bajo)</li><li>✓ Alertas cuando no hay información suficiente para responder</li><li>✓ Validación automática de respuestas para detectar posibles alucinaciones</li></ul>',
    '<h2>How does <span class="gradient-text">AI work in Iurefficient</span>?</h2><ol><li><strong>Local indexing.</strong> Your documents are processed and stored in a vector database inside your infrastructure. Embeddings are generated locally or through APIs that retain no data.</li><li><strong>Local semantic search.</strong> When you ask a question, the system searches your knowledge base for the most relevant fragments. This search happens entirely on your server.</li><li><strong>AI query with limited context.</strong> Only the relevant fragments, with no client identifiers or direct sensitive data, are sent to the AI API together with your question.</li><li><strong>Answer with citations.</strong> The answer includes references [1], [2]… to the original documents so you can verify the source of every statement.</li></ol><h3>AI provider policies</h3><ul><li>🟢 <strong>OpenAI (API):</strong> "We do not train on your business data (data sent through the API)". <a href="https://openai.com/enterprise-privacy" target="_blank" rel="noopener">Enterprise privacy policy</a></li><li>🟢 <strong>Anthropic (Claude API):</strong> "We do not train our models on customer API data". <a href="https://www.anthropic.com/policies/privacy-policy" target="_blank" rel="noopener">Privacy policy</a></li><li>🟢 <strong>OpenRouter:</strong> a router that honors the privacy policy of each underlying model. <a href="https://openrouter.ai/privacy" target="_blank" rel="noopener">Policy</a></li><li>🟢 <strong>DeepSeek / Qwen:</strong> enterprise APIs with no-retention policies.</li></ul><blockquote><p><strong>No-training guarantee.</strong> No AI provider used by Iurefficient trains its models on data sent through its enterprise APIs. This is a contractual guarantee from each provider.</p></blockquote><h3>Anti-hallucination system</h3><ul><li>✓ Answers based <strong>only</strong> on your documents, not on general knowledge</li><li>✓ Numbered citations [1], [2] that you can verify</li><li>✓ Confidence indicators (excellent, high, moderate, low)</li><li>✓ Alerts when there is not enough information to answer</li><li>✓ Automatic validation of answers to detect possible hallucinations</li></ul>'))]), {'width': 'narrow'}),
  sec('tarjetas', collections.OrderedDict([('title', I('Infraestructura <span class="gradient-text">técnica</span>', 'Technical <span class="gradient-text">infrastructure</span>')), ('subtitle', I('Opciones de despliegue', 'Deployment options')), ('variant', 'audience'), ('items', I(['On-Premise | Instalación en tus propios servidores. Máximo control y cumplimiento con políticas internas de seguridad. | 🏠', 'Cloud privado | Despliegue en tu cuenta de AWS, Azure o GCP. Beneficios del cloud con control total. | ☁️', 'Cloud administrado | Nosotros gestionamos la infraestructura con SLA de seguridad y disponibilidad garantizados. | 🌍'], ['On-premise | Installed on your own servers. Maximum control and compliance with internal security policies. | 🏠', 'Private cloud | Deployed in your AWS, Azure or GCP account. Cloud benefits with full control. | ☁️', 'Managed cloud | We run the infrastructure with guaranteed security and availability SLAs. | 🌍']))]), {'anchor': 'infraestructura', 'bg': 'light'}),
  sec('texto', collections.OrderedDict([('body', I('<h3>Capas de protección</h3><ul><li>🌐 <strong>CDN y WAF:</strong> Cloudflare Enterprise con protección DDoS, firewall de aplicaciones web y limitación de tasa</li><li>🔒 <strong>Balanceador con SSL:</strong> terminación TLS 1.3, certificados renovados automáticamente, HSTS habilitado</li><li>🖥️ <strong>Servidores de aplicación:</strong> contenedores aislados en Kubernetes, autoescalado, actualizaciones sin interrupción</li><li>🗄️ <strong>Base de datos:</strong> MySQL/PostgreSQL con cifrado en reposo, réplicas en tiempo real, respaldos automáticos</li><li>📁 <strong>Almacenamiento de archivos:</strong> object storage cifrado con AES-256-GCM, redundancia geográfica, versionado automático</li></ul>',
    '<h3>Layers of protection</h3><ul><li>🌐 <strong>CDN and WAF:</strong> Cloudflare Enterprise with DDoS protection, web application firewall and rate limiting</li><li>🔒 <strong>Load balancer with SSL:</strong> TLS 1.3 termination, automatically renewed certificates, HSTS enabled</li><li>🖥️ <strong>Application servers:</strong> isolated containers on Kubernetes, autoscaling, zero-downtime updates</li><li>🗄️ <strong>Database:</strong> MySQL/PostgreSQL with encryption at rest, real-time replicas, automatic backups</li><li>📁 <strong>File storage:</strong> object storage encrypted with AES-256-GCM, geographic redundancy, automatic versioning</li></ul>'))]), {'width': 'narrow', 'pad': 's'}),
  sec('insignias', collections.OrderedDict([('title', I('Cumplimiento legal', 'Legal compliance')), ('items', I(['🔐 | SSL/TLS 1.2/1.3', '🛡️ | Controles Enterprise', '🌐 | GDPR Ready', '☁️ | Basado en ISO 27001', '🏛️ | Secreto profesional'], ['🔐 | SSL/TLS 1.2/1.3', '🛡️ | Enterprise controls', '🌐 | GDPR ready', '☁️ | Based on ISO 27001', '🏛️ | Professional secrecy'])), ('button_text', I('', '')), ('button_url', '')]), {'anchor': 'cumplimiento'}),
  sec('texto', collections.OrderedDict([('body', I('<h3>Secreto profesional</h3><p>Iurefficient está diseñado para respetar las obligaciones de secreto profesional de abogados, contadores y otros profesionales:</p><ul><li>✓ Aislamiento técnico que impide el acceso no autorizado a expedientes</li><li>✓ Cifrado que protege la información incluso de administradores de sistemas</li><li>✓ Registros de auditoría para demostrar cumplimiento</li><li>✓ Contratos de confidencialidad con proveedores de servicios</li></ul><h2 id="derechos">Tus <span class="gradient-text">derechos</span></h2><p>Derechos ARCO+ (Acceso, Rectificación, Cancelación, Oposición y Portabilidad):</p><ul><li>👁️ <strong>Acceso:</strong> puedes solicitar una copia de todos tus datos personales almacenados.</li><li>✏️ <strong>Rectificación:</strong> puedes corregir cualquier dato personal inexacto o incompleto.</li><li>🗑️ <strong>Cancelación:</strong> puedes solicitar la eliminación de tus datos cuando ya no sean necesarios.</li><li>🚫 <strong>Oposición:</strong> puedes oponerte al tratamiento de tus datos para fines específicos.</li><li>📦 <strong>Portabilidad:</strong> puedes solicitar tus datos en formato estructurado para llevarlos a otro servicio.</li></ul><blockquote><p><strong>¿Cómo ejercerlos?</strong> Contacta al administrador de tu organización o envía una solicitud desde <strong>Perfil → Privacidad</strong>. Respondemos en un plazo máximo de 20 días hábiles.</p></blockquote>',
    '<h3>Professional secrecy</h3><p>Iurefficient is designed to respect the professional secrecy obligations of lawyers, accountants and other professionals:</p><ul><li>✓ Technical isolation that prevents unauthorized access to case files</li><li>✓ Encryption that protects information even from system administrators</li><li>✓ Audit logs to demonstrate compliance</li><li>✓ Confidentiality agreements with service providers</li></ul><h2 id="derechos">Your <span class="gradient-text">rights</span></h2><p>ARCO+ rights (Access, Rectification, Cancellation, Opposition and Portability):</p><ul><li>👁️ <strong>Access:</strong> you can request a copy of all your stored personal data.</li><li>✏️ <strong>Rectification:</strong> you can correct any inaccurate or incomplete personal data.</li><li>🗑️ <strong>Cancellation:</strong> you can request the deletion of your data when it is no longer needed.</li><li>🚫 <strong>Opposition:</strong> you can object to the processing of your data for specific purposes.</li><li>📦 <strong>Portability:</strong> you can request your data in a structured format to move it to another service.</li></ul><blockquote><p><strong>How to exercise them?</strong> Contact your organization\'s administrator or send a request from <strong>Profile → Privacy</strong>. We respond within 20 business days.</p></blockquote>'))]), {'width': 'narrow'}),
  sec('faq', collections.OrderedDict([('title', I('Preguntas <span class="gradient-text">frecuentes</span>', 'Frequently asked <span class="gradient-text">questions</span>')), ('section', 'seguridad'), ('items', I([], []))]), {'anchor': 'faq', 'bg': 'light'}),
  sec('texto', collections.OrderedDict([('body', I('<h3>📧 ¿Tienes más preguntas?</h3><p>Nuestro equipo de seguridad está disponible para responder cualquier duda sobre cómo protegemos tu información: <a href="mailto:seguridad@iurefficient.com">seguridad@iurefficient.com</a>. Consulta también el <a href="/legal/privacidad">Aviso de Privacidad</a>.</p><p><small>Para reportar vulnerabilidades: <a href="mailto:security@iurefficient.com">security@iurefficient.com</a></small></p>',
    '<h3>📧 More questions?</h3><p>Our security team is available to answer any question about how we protect your information: <a href="mailto:seguridad@iurefficient.com">seguridad@iurefficient.com</a>. See also the <a href="/en/legal/privacidad">Privacy Notice</a>.</p><p><small>To report vulnerabilities: <a href="mailto:security@iurefficient.com">security@iurefficient.com</a></small></p>'))]), {'width': 'narrow', 'align': 'center'}),
  sec('cta', collections.OrderedDict([('title', I('Tu información está segura con nosotros', 'Your information is safe with us')), ('text', I('Prueba Iurefficient con la confianza de que tus datos están protegidos', 'Try Iurefficient knowing your data is protected')), ('form', False), ('origin', 'derecho'), ('button_text', I('Comenzar prueba gratuita', 'Start free trial')), ('button_url', '/derecho#contacto'), ('note', I('', '')), ('gradient', False)]), {'anchor': 'contacto'}),
 ]),
])
W(f'{ROOT}/data/content/paginas/seguridad.json', seguridad)
print('bilingüe listo')
