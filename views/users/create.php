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
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-secondary active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Save User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../../views/layout.php'; 
?>
