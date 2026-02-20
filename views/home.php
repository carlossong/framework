<?php ob_start(); ?>

<div class="px-4 py-6 sm:px-0">
    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex flex-col items-center justify-center bg-white shadow-sm">
        <h2 class="text-4xl font-extrabold text-secondary mb-4"><?= htmlspecialchars($title) ?></h2>
        <p class="text-lg text-gray-600 max-w-2xl text-center mb-8">
            You have successfully set up a PHP Mini Framework using PSR-4 autoloading, a custom MVC architecture, a simple database abstraction layer, and modern UI styling with Tailwind CSS.
        </p>
        <div class="flex space-x-4">
            <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-secondary shadow transition duration-150 ease-in-out">
                Get Started
            </a>
            <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 shadow transition duration-150 ease-in-out">
                Documentation
            </a>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/layout.php'; 
?>
