<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Mini Framework') ?></title>
    <!-- Tailwind CSS Local -->
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
                        <a href="/dashboard" class="text-gray-600 hover:text-gray-900 font-medium self-center">Painel</a>
                        <?php if (is_admin()): ?>
                            <!-- Dropdown de Configuração -->
                            <div class="relative self-center">
                                <button type="button" id="config-menu-button" class="text-gray-600 hover:text-gray-900 font-medium inline-flex items-center focus:outline-none">
                                    Configurações
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <!-- Menu Dropdown -->
                                <div id="config-menu" class="absolute right-0 mt-2 w-48 z-50 hidden">
                                    <div class="bg-white rounded-md shadow-lg py-1 border border-gray-100">
                                        <a href="/users" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary transition">Usuários</a>
                                        <a href="/roles" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary transition">Funções</a>
                                        <a href="/permissions" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary transition">Permissões</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <span class="text-gray-400 self-center">|</span>
                        <span class="text-gray-600 self-center">Bem-vindo, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
                        <form action="/logout" method="POST" class="inline">
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Sair</button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="text-gray-600 hover:text-gray-900 font-medium">Login</a>
                        <a href="/register" class="bg-primary text-white px-3 py-1 rounded hover:bg-secondary font-medium transition">Cadastrar-se</a>
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
                &copy; <?= date('Y') ?> Mini Framework. Desenvolvido com PHP e Tailwind CSS.
            </div>
        </footer>

    <!-- Scripts Base Globais -->
    <script>
        // Lógica de alternância do dropdown
        document.addEventListener('click', function(event) {
            var menu = document.getElementById('config-menu');
            var button = document.getElementById('config-menu-button');
            if (!menu || !button) return;
            
            // Se clicar no botão, alterna o menu
            if (button.contains(event.target)) {
                menu.classList.toggle('hidden');
            } 
            // Se clicar fora do menu e do botão, fecha o menu
            else if (!menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        function confirmDeletion(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d9488', // cor primária teal
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
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
