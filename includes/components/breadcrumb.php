<?php
/**
 * Breadcrumb visual para paginas internas.
 *
 * Espera `$breadcrumbs` como lista de arrays con `label` y `url` opcional.
 *
 * @package MiLocalWeb\Clientes
 */

$breadcrumbs = $breadcrumbs ?? [];

if (empty($breadcrumbs)) {
    return;
}
?>
<nav class="breadcrumb" aria-label="Migas de pan">
    <ol class="breadcrumb-list">
        <?php foreach ($breadcrumbs as $item): ?>
        <li class="breadcrumb-item">
            <?php if (!empty($item['url'])): ?>
            <a href="<?= htmlspecialchars($item['url']) ?>"><?= htmlspecialchars($item['label'] ?? '') ?></a>
            <?php else: ?>
            <span aria-current="page"><?= htmlspecialchars($item['label'] ?? '') ?></span>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ol>
</nav>
