<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Mini Framework') ?></title>
    <!-- Local Tailwind CSS -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <a href="/" class="text-3xl font-bold tracking-tight text-primary hover:text-secondary transition">Mini Framework</a>
                <nav class="flex space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/dashboard" class="text-gray-600 hover:text-gray-900 font-medium self-center">Dashboard</a>
                        <?php if (is_admin()): ?>
                            <a href="/users" class="text-gray-600 hover:text-gray-900 font-medium self-center">Users</a>
                            <a href="/roles" class="text-gray-600 hover:text-gray-900 font-medium self-center">Roles</a>
                            <a href="/permissions" class="text-gray-600 hover:text-gray-900 font-medium self-center">Permissions</a>
                        <?php endif; ?>
                        <span class="text-gray-400 self-center">|</span>
                        <span class="text-gray-600 self-center">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
                        <form action="/logout" method="POST" class="inline">
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="text-gray-600 hover:text-gray-900 font-medium">Login</a>
                        <a href="/register" class="bg-primary text-white px-3 py-1 rounded hover:bg-secondary font-medium transition">Register</a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>
        
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <?= $content ?? '' ?>
            </div>
        </main>
        
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                &copy; <?= date('Y') ?> Mini Framework. Built with PHP and Tailwind CSS.
            </div>
    </div>

    <!-- Global SweetAlert triggers -->
    <script>
        function confirmDeletion(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d9488', // primary teal
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
    <?php if (isset($_SESSION['success_message'])): ?>
        <script>
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "<?= addslashes($_SESSION['success_message']) ?>",
              showConfirmButton: false,
              timer: 1500
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <script>
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "<?= addslashes($_SESSION['error_message']) ?>",
              showConfirmButton: false,
              timer: 2000
            });
        </script>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
</body>
</html>
