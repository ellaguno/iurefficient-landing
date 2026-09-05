<?php
/** Editor genérico de un elemento, guiado por el esquema del tipo. */
declare(strict_types=1);
$type = (string) ($_GET['type'] ?? '');
$def = cms_type($type);
if (!$def) { admin_flash('Tipo de contenido desconocido.', 'err'); admin_redirect(admin_url()); }
$fields = (array) ($def['fields'] ?? []);
$titleField = $def['title_field'] ?? 'title';
$dl = cms_default_lang();
$tree = !empty($def['tree']);

$orig = cms_slugify((string) ($_GET['slug'] ?? ''));
if ($tree) {
    // selector de página padre: todas las del tipo menos la propia y sus descendientes
    $all = cms_items($type, false);
    $opts = ['' => '— Raíz del sitio —'];
    $isDesc = function (string $slug) use ($all, $orig): bool { $n = 0; while ($slug !== '' && $n++ < 20) { if ($slug === $orig) return true; $slug = (string) ($all[$slug]['parent'] ?? ''); } return false; };
    $paths = [];
    foreach ($all as $sl => $it) $paths[$sl] = $it['path'] ?? $sl;
    asort($paths);
    foreach ($paths as $sl => $pth) if ($sl !== $orig && !$isDesc($sl)) $opts[$sl] = str_repeat('· ', substr_count($pth, '/')) . cms_f($all[$sl], $titleField, $dl) . '  (/' . $pth . ')';
    $fields = ['parent' => ['type' => 'select', 'label' => 'Página padre', 'sidebar' => true, 'options' => $opts, 'help' => 'La URL se forma con la ruta del padre + la URL de esta página.']] + $fields;
}
$item = $orig ? cms_item($type, $orig, false) : null;
$is_new = !$item;
if ($orig && !$item) { admin_flash('El elemento no existe.', 'err'); admin_redirect(admin_url('content', ['type' => $type])); }
if ($is_new) {
    $item = ['slug' => '', 'status' => 'draft'];
    foreach ($fields as $name => $fd) {
        $d = $fd['default'] ?? (($fd['type'] ?? '') === 'date' ? date('Y-m-d') : '');
        if ($name === 'order' && ($fd['type'] ?? '') === 'number' && !isset($fd['default'])) $d = count(cms_items($type, false)) + 1;
        $item[$name] = !empty($fd['i18n']) ? array_fill_keys(cms_langs(), $d) : $d;
    }
}

$errors = [];
if (admin_is_post() && admin_post('action') === 'restore' && !$is_new) {
    admin_csrf_check();
    $vf = cms_versions_dir($type, $orig) . '/' . preg_replace('/[^0-9-]/', '', admin_post('version')) . '.json';
    $old = is_file($vf) ? json_decode((string) file_get_contents($vf), true) : null;
    if (is_array($old) && !empty($old['slug'])) {
        $old['slug'] = $orig; $old['updated'] = date('Y-m-d');
        if (cms_item_save($type, $old)) { admin_flash('Versión restaurada (la que estaba quedó guardada como versión).'); admin_redirect(admin_url('edit', ['type' => $type, 'slug' => $orig])); }
    }
    admin_flash('No se pudo restaurar esa versión.', 'err');
    admin_redirect(admin_url('edit', ['type' => $type, 'slug' => $orig]));
}
if (admin_is_post()) {
    admin_csrf_check();
    $new = ['slug' => '', 'status' => admin_post('status') === 'published' ? 'published' : 'draft'];
    $new['publish_at'] = preg_match('/^\d{4}-\d{2}-\d{2}$/', admin_post('publish_at')) && admin_post('publish_at') > date('Y-m-d') ? admin_post('publish_at') : '';
    foreach ($fields as $name => $fd) $new[$name] = admin_read_field($name, $fd);
    $titleVal = $new[$titleField] ?? '';
    $titleMain = is_array($titleVal) ? ($titleVal[$dl] ?? '') : (string) $titleVal;
    $slug = cms_slugify(admin_post('slug') ?: $titleMain);
    if ($titleMain === '') $errors[] = 'El campo "' . admin_field_label($titleField, $fields[$titleField] ?? []) . '" es obligatorio' . (count(cms_langs()) > 1 ? ' en ' . strtoupper($dl) : '') . '.';
    foreach ($fields as $name => $fd) {
        if (empty($fd['required']) || $name === $titleField) continue;
        $v = $new[$name]; $v = is_array($v) && !isset($v[0]) ? ($v[$dl] ?? '') : $v;
        if ($v === '' || $v === []) $errors[] = 'El campo "' . admin_field_label($name, $fd) . '" es obligatorio.';
    }
    if ($slug === '') $errors[] = 'No se pudo generar la URL (slug).';
    if ($tree && ($new['parent'] ?? '') === '' && in_array($slug, cms_reserved_segments(), true)) $errors[] = 'La URL "' . $slug . '" está reservada por otra sección del sitio; elige otra o ponla bajo una página padre.';
    if ($tree && ($new['parent'] ?? '') === $slug) $new['parent'] = '';
    if ($slug && $slug !== $orig && is_file(cms_content_dir($type) . '/' . $slug . '.json')) $errors[] = 'Ya existe un elemento con la URL "' . $slug . '".';
    $new['slug'] = $slug;
    $new['seo_title'] = admin_read_field('seo_title', ['type' => 'text', 'i18n' => true]);
    $new['seo_desc'] = admin_read_field('seo_desc', ['type' => 'textarea', 'i18n' => true]);
    $new['created'] = $item['created'] ?? date('Y-m-d');
    $new['updated'] = date('Y-m-d');
    $item = $new + $item;
    if (!$errors) {
        if ($tree) { $all2 = cms_items($type, false); $all2[$slug] = $item; $item['path'] = cms_tree_path($type, $all2, $slug); }
        if (cms_item_save($type, $item)) {
            if ($orig && $orig !== $slug) {
                cms_item_delete($type, $orig);
                if (is_dir(cms_versions_dir($type, $orig)) && !is_dir(cms_versions_dir($type, $slug))) @rename(cms_versions_dir($type, $orig), cms_versions_dir($type, $slug));
                if ($tree) foreach (cms_items($type, false) as $ch) if (($ch['parent'] ?? '') === $orig) { $ch['parent'] = $slug; cms_json_write(cms_content_dir($type) . '/' . $ch['slug'] . '.json', $ch); }
            }
            if ($tree) cms_tree_rebuild($type);
            admin_flash('Guardado.');
            admin_redirect(admin_url('edit', ['type' => $type, 'slug' => $slug]));
        }
        $errors[] = 'No se pudo escribir en data/content/' . $type . '/. Revisa permisos.';
    }
}

$main = array_filter($fields, fn($f) => empty($f['sidebar']));
$side = array_filter($fields, fn($f) => !empty($f['sidebar']));
$singular = $def['label_singular'] ?? 'Elemento';
admin_header(($is_new ? 'Nuevo: ' : 'Editar: ') . $singular, 'content:' . $type);
foreach ($errors as $e) echo '<div class="ad-flash err">' . cms_e($e) . '</div>';
$titleInputName = !empty($fields[$titleField]['i18n']) ? $titleField . '[' . $dl . ']' : $titleField;
?>
<form method="post" class="ad-form ad-form-wide" data-slug-source="<?= cms_e($titleInputName) ?>">
  <?= admin_csrf_field() ?>
  <?php admin_lang_switch(); ?>
  <div class="ad-grid-main">
    <div>
<?php foreach ($main as $name => $fd) admin_field($name, $fd, $item[$name] ?? ''); ?>
    </div>
    <aside class="ad-sidebar">
      <?php admin_seo_fields($item); ?>
      <div class="ad-field"><label>Estado</label>
        <select name="status"><option value="draft"<?= $item['status'] !== 'published' ? ' selected' : '' ?>>Borrador</option><option value="published"<?= $item['status'] === 'published' ? ' selected' : '' ?>>Publicado</option></select></div>
      <div class="ad-field"><label>Publicar a partir de <small class="ad-help">(vacío = de inmediato)</small></label><input type="date" name="publish_at" value="<?= cms_e($item['publish_at'] ?? '') ?>" min="<?= date('Y-m-d', time() + 86400) ?>"></div>
      <div class="ad-field"><label>URL (slug)</label><input type="text" name="slug" value="<?= cms_e($item['slug']) ?>" data-slug placeholder="se genera del título"><p class="ad-help"><?php if ($tree): $pp = ($item['parent'] ?? '') !== '' ? (cms_items($type, false)[$item['parent']]['path'] ?? $item['parent']) . '/' : ''; $sg = cms_segment($def, $dl); ?>/<?= $sg !== '' ? cms_e($sg) . '/' : '' ?><span data-parent-path><?= cms_e($pp) ?></span><?php else: ?>/<?= cms_e(cms_segment($def, $dl)) ?>/<?php endif; ?><span data-slug-preview><?= cms_e($item['slug']) ?></span></p></div>
<?php foreach ($side as $name => $fd) admin_field($name, $fd, $item[$name] ?? ''); ?>
      <div class="ad-field ad-sticky-save">
        <button class="ad-btn" type="submit">Guardar</button>
        <a class="ad-btn ad-btn-light" href="<?= admin_url('content', ['type' => $type]) ?>">Volver</a>
<?php if (!$is_new): foreach (cms_active_langs() as $l): ?>        <a class="ad-btn ad-btn-light" href="<?= cms_e(cms_item_url($type, $item, $l)) ?>" target="_blank" rel="noopener"><?= cms_item_is_live($item) ? 'Ver' : 'Vista previa' ?> <?= strtoupper($l) ?></a>
<?php endforeach; endif; ?>
      </div>
<?php if (!$is_new): ?>      <p class="ad-help">Creado: <?= cms_e($item['created'] ?? '—') ?> · Actualizado: <?= cms_e($item['updated'] ?? '—') ?></p>
<?php $versions = cms_item_versions($type, $item['slug']); if ($versions): ?>
      <details class="ad-versions"><summary>Versiones anteriores (<?= count($versions) ?>)</summary>
        <ul class="ad-list">
<?php foreach ($versions as $v): ?>
          <li><span><?= cms_e($v['when']) ?> <small class="ad-help"><?= cms_e($v['status'] === 'published' ? 'publicado' : 'borrador') ?></small></span>
            <button class="ad-btn ad-btn-sm ad-btn-light" type="submit" form="restore-<?= cms_e($v['name']) ?>" data-confirm="¿Restaurar la versión del <?= cms_e($v['when']) ?>? La versión actual quedará guardada.">Restaurar</button></li>
<?php endforeach; ?>
        </ul>
      </details>
<?php endif; endif; ?>
    </aside>
  </div>
</form>
<?php if (!$is_new) foreach (cms_item_versions($type, $item['slug']) as $v): ?>
<form method="post" id="restore-<?= cms_e($v['name']) ?>" class="ad-inline" data-confirm="¿Restaurar la versión del <?= cms_e($v['when']) ?>? La versión actual quedará guardada."><?= admin_csrf_field() ?><input type="hidden" name="action" value="restore"><input type="hidden" name="version" value="<?= cms_e($v['name']) ?>"></form>
<?php endforeach; ?>
<?php admin_footer();
