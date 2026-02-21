<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Edit User</h2>
            <p class="mt-2 text-sm text-gray-600">Update the details for <?= htmlspecialchars($user['name']) ?>.</p>
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

            <form action="/users/<?= $user['id'] ?>/edit" method="POST" class="space-y-6">
                <?php component('input', ['name' => 'name', 'label' => 'Name', 'value' => $user['name'], 'required' => true]); ?>
                <?php component('input', ['name' => 'email', 'type' => 'email', 'label' => 'Email address', 'value' => $user['email'], 'autocomplete' => 'email', 'required' => true]); ?>

                <div class="pt-4 border-t border-gray-200 mt-4">
                    <h3 class="text-md font-medium text-gray-900 mb-4">Change Password (Optional)</h3>
                    <?php component('input', ['type' => 'password', 'name' => 'password', 'label' => 'Password (leave blank to keep current)']); ?>

                <div class="space-y-1">
                    <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
                    <div class="mt-1">
                        <select id="role_id" name="role_id" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            <option value="">Select a role...</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= ($user['role_id'] == $role['id']) ? 'selected' : '' ?>><?= htmlspecialchars($role['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="pt-2">
                    <?php component('button', ['text' => 'Update User', 'class' => 'w-full active:scale-95 transition-all']); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../../views/layout.php'; 
?>
