<?php ob_start(); ?>

<div class="py-6 sm:px-0">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Manage Users</h2>
            <p class="mt-2 text-sm text-gray-600">A list of all users in your application.</p>
        </div>
        <a href="/users/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Add User
        </a>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created At
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($user['name']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($user['email']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars(date('M j, Y H:i', strtotime($user['created_at']))) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/users/<?= $user['id'] ?>/edit" class="text-primary hover:text-secondary mr-3 text-medium">Edit</a>
                                        <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                            <form action="/users/<?= $user['id'] ?>/delete" method="POST" class="inline" onsubmit="confirmDeletion(event, this)">
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-400 cursor-not-allowed">Delete</span>
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
require __DIR__ . '/../../views/layout.php'; 
?>
