<?php ob_start(); ?>

<div class="min-h-[70vh] flex flex-col justify-center sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create a new account</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-100">
            <?php if (isset($error)): ?>
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4">
                    <p class="text-red-700"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="/register" method="POST">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
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
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-secondary active:scale-95 transition-transform focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Register
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/login" class="text-sm font-medium text-primary hover:text-secondary">Already have an account? Sign in.</a>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/../layout.php'; 
?>
