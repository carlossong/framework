<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Mini Framework') ?></title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS Local -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-teal-100 selection:text-teal-900">
    <div class="min-h-screen flex flex-col relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-teal-50/50 to-transparent -z-10"></div>
        
        <header class="sticky top-0 z-40 w-full glass border-b border-slate-200/60 transition-all duration-300">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2 group">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform duration-300">M</div>
                    <span class="text-xl font-bold tracking-tight text-slate-900 group-hover:text-primary transition-colors duration-300">Mini Framework</span>
                </a>
                
                <nav class="hidden md:flex items-center space-x-1">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/dashboard" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-teal-50 transition-all duration-200">Painel</a>
                        
                        <?php if (is_admin()): ?>
                            <div class="relative group">
                                <button type="button" id="config-menu-button" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-teal-50 inline-flex items-center transition-all duration-200">
                                    Configurações
                                    <svg class="w-4 h-4 ml-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div id="config-menu" class="absolute right-0 mt-2 w-56 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 z-50">
                                    <div class="bg-white rounded-xl shadow-xl shadow-slate-200/50 py-2 border border-slate-200 overflow-hidden">
                                        <div class="px-4 py-2 border-b border-slate-50 mb-1">
                                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Administração</p>
                                        </div>
                                        <a href="/users" class="flex items-center space-x-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-teal-50 hover:text-primary transition-colors">
                                            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            <span>Usuários</span>
                                        </a>
                                        <a href="/roles" class="flex items-center space-x-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-teal-50 hover:text-primary transition-colors">
                                            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                            <span>Funções</span>
                                        </a>
                                        <a href="/permissions" class="flex items-center space-x-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-teal-50 hover:text-primary transition-colors">
                                            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                            <span>Permissões</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="h-4 w-px bg-slate-200 mx-2"></div>
                        
                        <div class="flex items-center space-x-4 pl-2">
                            <span class="text-sm text-slate-500">Olá, <span class="font-semibold text-slate-900"><?= htmlspecialchars($_SESSION['user_name']) ?></span></span>
                            <form action="/logout" method="POST" class="inline">
                                <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center space-x-2">
                            <a href="/login" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary transition-colors">Login</a>
                            <a href="/register" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-secondary shadow-lg shadow-primary/20 transition-all active:scale-95 duration-200">Começar</a>
                        </div>
                    <?php endif; ?>
                </nav>
            </div>
        </header>
        
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
                <?= $content ?? '' ?>
            </div>
        </main>
        
        <footer class="bg-white border-t border-slate-200 mt-auto py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:flex sm:justify-between items-center text-sm text-slate-500">
                <p>&copy; <?= date('Y') ?> Mini Framework. Produzido com paixão em PHP.</p>
                <div class="flex justify-center space-x-6 mt-4 sm:mt-0">
                    <a href="#" class="hover:text-primary transition-colors">GitHub</a>
                    <a href="#" class="hover:text-primary transition-colors">Documentação</a>
                </div>
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
