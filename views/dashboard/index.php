<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6">
        <h2 class="text-3xl font-extrabold text-gray-900">Painel de Controle</h2>
        <p class="mt-2 text-sm text-gray-600">Bem-vindo de volta, <?= htmlspecialchars($user_name) ?>!</p>
    </div>

    <!-- Stats/Cards Section -->
    <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <!-- Card 1 -->
        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Total de Usuários</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900"><?= $total_users ?></dd>
                </dl>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Sessões Ativas</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900"><?= $active_sessions ?></dd>
                </dl>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100 flex items-center justify-center bg-teal-50">
            <div class="px-4 py-5 sm:p-6 text-center">
                <p class="text-primary font-medium">Mini Framework rodando perfeitamente!</p>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../layout.php'; 
?>
