<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Manage Roles</h2>
            <p class="mt-2 text-sm text-gray-600">A list of all user roles in your application.</p>
        </div>
        <?php component('button', ['text' => 'Add Role', 'href' => '/roles/create', 'class' => 'inline-flex items-center']); ?>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($roles as $role): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($role['name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($role['description'] ?? '') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($role['created_at']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/roles/<?= $role['id'] ?>/edit" class="text-primary hover:text-secondary mr-3 transition">Edit / Permissions</a>
                                        <?php if ($role['id'] != 1): // Prevent deletion of root admin ?>
                                        <form action="/roles/<?= $role['id'] ?>/delete" method="POST" class="inline-block" onsubmit="confirmDeletion(event, this)">
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition">Delete</button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../layout.php'; 
?>
