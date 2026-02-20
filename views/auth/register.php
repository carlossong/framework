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

            <form action="/register" method="POST" class="space-y-6">
                <?php component('input', ['name' => 'name', 'label' => 'Name', 'required' => true]); ?>
                <?php component('input', ['name' => 'email', 'type' => 'email', 'label' => 'Email address', 'autocomplete' => 'email', 'required' => true]); ?>
                <?php component('input', ['name' => 'password', 'type' => 'password', 'label' => 'Password', 'autocomplete' => 'new-password', 'required' => true]); ?>

                <div>
                    <?php component('button', ['text' => 'Register', 'class' => 'w-full']); ?>
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
