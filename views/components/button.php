<?php
$type = $type ?? 'submit';
$text = $text ?? 'Submit';
$class = $class ?? '';
$href = $href ?? null;
$defaultClass = 'flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-secondary active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary';
?>
<?php if ($href): ?>
<a href="<?= htmlspecialchars($href) ?>" class="<?= $defaultClass ?> <?= htmlspecialchars($class) ?>">
    <?= htmlspecialchars($text) ?>
</a>
<?php else: ?>
<button type="<?= htmlspecialchars($type) ?>" class="<?= $defaultClass ?> <?= htmlspecialchars($class) ?>">
    <?= htmlspecialchars($text) ?>
</button>
<?php endif; ?>
