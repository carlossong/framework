<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6">
        <a href="/permissions" class="text-sm font-medium text-primary hover:text-secondary transition">&larr; Back to permissions</a>
    </div>

    <div class="max-w-xl bg-white shadow overflow-hidden sm:rounded-lg border border-gray-100">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Permission</h3>
            <p class="mt-1 text-sm text-gray-500">Update permission details.</p>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            <?php if (isset($error)): ?>
                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-red-700"><?= htmlspecialchars($error) ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form action="/permissions/<?= $permission['id'] ?>/edit" method="POST" class="space-y-6">
                <?php component('input', ['name' => 'name', 'label' => 'Internal Name', 'value' => $permission['name'], 'required' => true]); ?>
                <?php component('input', ['name' => 'description', 'label' => 'Friendly Description', 'value' => $permission['description'] ?? '']); ?>

                <div class="pt-2">
                    <?php component('button', ['text' => 'Update Permission', 'class' => 'w-full']); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../layout.php'; 
?>
