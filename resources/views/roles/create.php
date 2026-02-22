<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6">
        <a href="/roles" class="text-sm font-medium text-primary hover:text-secondary transition">&larr; Voltar para funções</a>
    </div>

    <div class="max-w-5xl bg-white shadow-sm overflow-hidden sm:rounded-xl border border-slate-200">
        <div class="px-6 py-6 border-b border-slate-100 bg-slate-50/50">
            <h3 class="text-xl font-bold text-slate-900">Nova Função</h3>
            <p class="mt-1 text-sm text-slate-500">Crie uma nova função e defina suas permissões de acesso.</p>
        </div>
        
        <div class="px-6 py-8">
            <?php if (isset($error)): ?>
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0 text-red-500">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800"><?= htmlspecialchars($error) ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form action="/roles/create" method="POST" class="space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php component('input', ['name' => 'name', 'label' => 'Nome da Função', 'required' => true, 'placeholder' => 'Ex: Gerente']); ?>
                    <?php component('input', ['name' => 'description', 'label' => 'Descrição', 'placeholder' => 'Descreva as responsabilidades desta função']); ?>
                </div>

                <div class="pt-8 border-t border-slate-100">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-slate-900">Permissões</h3>
                        <p class="text-sm text-slate-500">Selecione as ações permitidas para esta função nos recursos do sistema.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <?php if (empty($groupedPermissions)): ?>
                            <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                <p class="text-slate-500">Nenhuma permissão disponível. Crie algumas primeiro.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($groupedPermissions as $resource => $perms): ?>
                                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden group hover:border-teal-200 transition-colors duration-300">
                                    <div class="px-5 py-4 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 group-hover:text-primary transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider"><?= ucfirst($resource) ?></h4>
                                        </div>
                                        <button type="button" onclick="selectAllInResource('<?= $resource ?>')" class="text-xs font-semibold text-primary hover:text-secondary transition-colors px-2 py-1 rounded hover:bg-teal-50">Selecionar Todos</button>
                                    </div>
                                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                        <?php foreach ($perms as $permission): ?>
                                            <label class="flex items-start cursor-pointer group/label">
                                                <div class="relative flex items-center group">
                                                    <input type="checkbox" id="perm_<?= $permission['id'] ?>" name="permissions[]" value="<?= $permission['id'] ?>" data-resource="<?= $resource ?>" class="peer sr-only">
                                                    <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-primary transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5 peer-checked:after:border-primary"></div>
                                                </div>
                                                <div class="ml-3">
                                                    <span class="text-sm font-medium text-slate-700 group-hover/label:text-slate-900 transition-colors"><?= ucfirst(str_replace(['manage_', $resource, '_'], ['', '', ' '], $permission['name'])) ?: $permission['name'] ?></span>
                                                    <p class="text-[10px] text-slate-400 leading-tight"><?= htmlspecialchars($permission['description'] ?? '') ?></p>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100 flex items-center justify-end space-x-4">
                    <a href="/roles" class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">Cancelar</a>
                    <button type="submit" class="px-8 py-2.5 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/25 hover:bg-secondary hover:scale-[1.02] active:scale-95 transition-all duration-200">
                        Criar Função
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function selectAllInResource(resource) {
        const checkboxes = document.querySelectorAll(`input[data-resource="${resource}"]`);
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
        checkboxes.forEach(cb => cb.checked = !allChecked);
    }
</script>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../layout.php'; 
?>
