<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Create User</h2>
            <p class="mt-2 text-sm text-gray-600">Add a new user to the system.</p>
        </div>
        <a href="/users" class="text-sm font-medium text-primary hover:text-secondary">
            &larr; Back to users
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100 max-w-2xl">
        <div class="px-4 py-5 sm:p-6">
            <?php if (isset($error)): ?>
                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                    <p class="text-sm text-red-700"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form action="/users/create" method="POST" class="space-y-6">
                <?php component('input', ['name' => 'name', 'label' => 'Name', 'required' => true]); ?>
                <?php component('input', ['name' => 'email', 'type' => 'email', 'label' => 'Email address', 'autocomplete' => 'email', 'required' => true]); ?>
                <?php component('input', ['name' => 'password', 'type' => 'password', 'label' => 'Password', 'required' => true]); ?>

                <div class="pt-2">
                    <?php component('button', ['text' => 'Save User', 'class' => 'w-full']); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../../views/layout.php'; 
?>
