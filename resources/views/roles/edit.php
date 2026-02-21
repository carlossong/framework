<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6">
        <a href="/roles" class="text-sm font-medium text-primary hover:text-secondary transition">&larr; Voltar para funções</a>
    </div>

    <div class="max-w-2xl bg-white shadow overflow-hidden sm:rounded-lg border border-gray-100">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Editar Função</h3>
            <p class="mt-1 text-sm text-gray-500">Atualizar detalhes da função e permissões.</p>
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

            <form action="/roles/<?= $role['id'] ?>/edit" method="POST" class="space-y-6">
                <?php component('input', ['name' => 'name', 'label' => 'Nome da Função', 'value' => $role['name'], 'required' => true]); ?>
                <?php component('input', ['name' => 'description', 'label' => 'Descrição Amigável', 'value' => $role['description'] ?? '']); ?>

                <div class="pt-4 border-t border-gray-200 mt-4">
                    <h3 class="text-md font-medium text-gray-900 mb-4">Atribuir Permissões</h3>
                    <div class="bg-white rounded-md -space-y-px">
                        <?php if (empty($permissions)): ?>
                            <p class="text-sm text-gray-500">Nenhuma permissão disponível. Crie algumas primeiro.</p>
                        <?php else: ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <?php foreach ($permissions as $permission): ?>
                                    <div class="relative flex items-start py-4">
                                        <div class="min-w-0 flex-1 text-sm">
                                            <label for="perm_<?= $permission['id'] ?>" class="font-medium text-gray-700 select-none cursor-pointer"><?= htmlspecialchars($permission['name']) ?></label>
                                            <p id="perm_<?= $permission['id'] ?>_desc" class="text-gray-500"><?= htmlspecialchars($permission['description'] ?? '') ?></p>
                                        </div>
                                        <div class="ml-3 flex items-center h-5">
                                            <input id="perm_<?= $permission['id'] ?>" name="permissions[]" value="<?= $permission['id'] ?>" type="checkbox" <?= in_array($permission['id'], $rolePermissionIds ?? []) ? 'checked' : '' ?> class="focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded cursor-pointer">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-4">
                    <?php component('button', ['text' => 'Atualizar Função', 'class' => 'w-full']); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../layout.php'; 
?>
