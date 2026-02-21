<?php
$type = $type ?? 'text';
$name = $name ?? '';
$id = $id ?? $name;
$label = $label ?? ucfirst($name);
$value = $value ?? '';
$required = $required ?? false;
$class = $class ?? '';
$defaultClass = 'appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm';
$autocomplete = $autocomplete ?? '';
$placeholder = $placeholder ?? '';
?>
<div>
    <label for="<?= htmlspecialchars($id) ?>" class="block text-sm font-medium text-gray-700"><?= htmlspecialchars($label) ?></label>
    <div class="mt-1">
        <input 
            id="<?= htmlspecialchars($id) ?>" 
            name="<?= htmlspecialchars($name) ?>" 
            type="<?= htmlspecialchars($type) ?>" 
            value="<?= htmlspecialchars($value) ?>" 
            <?= $required ? 'required' : '' ?> 
            <?= $autocomplete ? 'autocomplete="' . htmlspecialchars($autocomplete) . '"' : '' ?>
            <?= $placeholder ? 'placeholder="' . htmlspecialchars($placeholder) . '"' : '' ?>
            class="<?= $defaultClass ?> <?= htmlspecialchars($class) ?>"
        >
    </div>
</div>
