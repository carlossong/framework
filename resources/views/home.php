<?php ob_start(); ?>

<div class="relative py-12 sm:py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center">
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-slate-900 mb-6">
                Eleve seu Desenvolvimento <br class="hidden sm:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-teal-400">em PHP Moderno.</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-600 mb-10 leading-relaxed">
                Um framework minimalista com as melhores práticas: PSR-4, MVC, Injeção de Dependências e estilização premium com Tailwind CSS v4.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/login" class="w-full sm:w-auto px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-xl shadow-primary/25 hover:bg-secondary hover:-translate-y-1 transition-all duration-300">
                    Começar agora
                </a>
                <a href="#" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 font-bold rounded-xl border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all duration-300">
                    Documentação
                </a>
            </div>
        </div>

        <!-- Dashboard Preview Mockup -->
        <div class="mt-20 relative">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent z-10"></div>
            <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden max-w-5xl mx-auto transform hover:scale-[1.02] transition-transform duration-500">
                <div class="h-8 bg-slate-50 border-b border-slate-100 flex items-center px-4 space-x-2">
                    <div class="w-2.5 h-2.5 bg-red-400 rounded-full"></div>
                    <div class="w-2.5 h-2.5 bg-amber-400 rounded-full"></div>
                    <div class="w-2.5 h-2.5 bg-green-400 rounded-full"></div>
                </div>
                <div class="p-8 sm:p-12 text-center bg-gradient-to-br from-white to-teal-50/30">
                    <div class="inline-flex p-3 rounded-2xl bg-teal-100 text-primary mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">Pronto para Produção</h3>
                    <p class="text-slate-500">Configurado para escalabilidade e performance excepcional.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="p-8 rounded-2xl border border-slate-100 hover:border-teal-100 hover:bg-teal-50/30 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center text-primary mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Banco de Dados</h3>
                <p class="text-slate-600 leading-relaxed">Abstração simples e segura usando PDO com suporte a múltiplas conexões.</p>
            </div>
            <!-- Feature 2 -->
            <div class="p-8 rounded-2xl border border-slate-100 hover:border-teal-100 hover:bg-teal-50/30 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center text-primary mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Segurança RBAC</h3>
                <p class="text-slate-600 leading-relaxed">Controle de acesso granular baseado em funções e permissões configuráveis.</p>
            </div>
            <!-- Feature 3 -->
            <div class="p-8 rounded-2xl border border-slate-100 hover:border-teal-100 hover:bg-teal-50/30 transition-all duration-300">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center text-primary mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.828 2.828a2 2 0 010 2.828l-8.486 8.486L5 19l1.414-5.657L11 7.343z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Tailwind CSS v4</h3>
                <p class="text-slate-600 leading-relaxed">Design system moderno e customizável utilizando a última versão do Tailwind.</p>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require __DIR__ . '/layout.php'; 
?>
