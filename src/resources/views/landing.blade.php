<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedRep - Plateforme de Gestion des Délégués Médicaux</title>
    <meta name="description" content="Optimisez vos tournées médicales, gérez vos visites et suivez vos performances avec MedRep.">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind & Alpine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .hero-gradient { background: radial-gradient(circle at top right, #EEF2FF 0%, #FFFFFF 100%); }
        .blue-gradient { background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%); }
    </style>
</head>
<body class="bg-white text-slate-900 selection:bg-blue-100 selection:text-blue-700">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass h-16 flex items-center px-6 lg:px-12 justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 blue-gradient rounded-lg flex items-center justify-center">
                <i data-lucide="plus" class="text-white w-5 h-5"></i>
            </div>
            <span class="text-xl font-bold tracking-tight">MedRep</span>
        </div>
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
            <a href="#features" class="hover:text-blue-600 transition">Fonctionnalités</a>
            <a href="#solutions" class="hover:text-blue-600 transition">Solutions</a>
            <a href="#about" class="hover:text-blue-600 transition">À propos</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-blue-600 transition">Connexion</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 blue-gradient text-white text-sm font-bold rounded-full hover:shadow-lg hover:shadow-blue-200 transition-all">S'inscrire</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6 lg:px-12 hero-gradient overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Nouveauté : Planification IA 2026
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight">
                    La plateforme <span class="text-blue-600">ultime</span> pour les délégués médicaux.
                </h1>
                <p class="text-lg text-slate-600 max-w-lg leading-relaxed">
                    MedRep centralise vos tournées, vos visites et vos rapports dans une interface intuitive conçue pour la performance et la simplicité.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 blue-gradient text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:scale-105 transition-transform">Démarrer gratuitement</a>
                    <a href="#" class="px-8 py-4 bg-white border border-slate-200 font-bold rounded-2xl hover:bg-slate-50 transition-colors flex items-center gap-2">
                        <i data-lucide="play-circle" class="w-5 h-5"></i>
                        Voir la démo
                    </a>
                </div>
            </div>
            
            <div class="relative lg:h-[600px] flex items-center justify-center">
                <!-- Mockup Elements inspired by user image -->
                <div class="relative w-full max-w-lg animate-float">
                    <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100 p-2 transform rotate-2">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&q=80&w=2070" alt="Dashboard Preview" class="rounded-[1.5rem] w-full">
                    </div>
                    <!-- Floating cards -->
                    <div class="absolute -top-10 -left-10 bg-white p-6 rounded-2xl shadow-xl border border-slate-50 space-y-3 transform -rotate-6 hidden md:block">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <i data-lucide="check-circle" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400">Objectif atteint</p>
                                <p class="text-lg font-bold">15 / 20 visites</p>
                            </div>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-green-500 h-full w-[75%]"></div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 bg-white p-6 rounded-2xl shadow-xl border border-slate-50 space-y-4 transform rotate-3 hidden md:block w-64">
                        <p class="text-sm font-bold">Prochaine visite</p>
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-12 bg-blue-500 rounded-full"></div>
                            <div>
                                <p class="font-bold">Dr. Martin Pierre</p>
                                <p class="text-xs text-slate-500 italic">Cardiologue - Hôpital Fann</p>
                                <p class="text-xs font-bold text-blue-600 mt-1">09:00 - Confirmée</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl font-extrabold">+12k</p>
                <p class="text-sm text-slate-400">Délégués actifs</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold">98%</p>
                <p class="text-sm text-slate-400">Satisfaction client</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold">+500</p>
                <p class="text-sm text-slate-400">Hôpitaux partenaires</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold">2.4M</p>
                <p class="text-sm text-slate-400">Visites gérées</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto space-y-16">
            <div class="text-center space-y-4">
                <h2 class="text-4xl font-bold tracking-tight">Tout ce dont vous avez besoin.</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Une suite d'outils puissants conçus spécifiquement pour les professionnels de la santé.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 bg-white rounded-[2rem] border border-slate-100 hover:shadow-2xl hover:shadow-blue-100 transition-all group">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="layout-dashboard" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Tableau de bord</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Visualisez vos KPIs, vos rapports en attente et vos performances en un coup d'œil.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div class="p-8 bg-white rounded-[2rem] border border-slate-100 hover:shadow-2xl hover:shadow-blue-100 transition-all group">
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i data-lucide="calendar" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Calendrier Intelligent</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Planifiez vos visites mensuelles, hebdomadaires ou journalières avec une ergonomie parfaite.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div class="p-8 bg-white rounded-[2rem] border border-slate-100 hover:shadow-2xl hover:shadow-blue-100 transition-all group">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i data-lucide="map" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Itinéraires Optimisés</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Gagnez du temps avec la cartographie intégrée et l'optimisation intelligente de vos tournées.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- App Showcase section (inspired by the mobile mockups in the user image) -->
    <section class="py-24 bg-slate-50 px-6 lg:px-12 overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative flex justify-center">
                <!-- Mobile Mockups -->
                <div class="relative z-10 w-64 transform -rotate-12 translate-x-12">
                     <div class="bg-slate-900 rounded-[3rem] p-3 shadow-2xl border-[6px] border-slate-800">
                         <div class="bg-white rounded-[2.5rem] overflow-hidden aspect-[9/19] p-4 space-y-4">
                             <div class="flex justify-between items-center">
                                 <i data-lucide="arrow-left" class="w-5 h-5"></i>
                                 <span class="font-bold">Nouvelle visite</span>
                                 <i data-lucide="more-vertical" class="w-5 h-5"></i>
                             </div>
                             <div class="space-y-4">
                                 <div class="space-y-1">
                                     <label class="text-[10px] uppercase font-bold text-slate-400">Médecin</label>
                                     <div class="p-2 border border-slate-100 rounded-lg text-sm bg-slate-50 font-medium">Dr. Martin Pierre</div>
                                 </div>
                                 <div class="space-y-1">
                                     <label class="text-[10px] uppercase font-bold text-slate-400">Établissement</label>
                                     <div class="p-2 border border-slate-100 rounded-lg text-sm bg-slate-50 font-medium">Hôpital Fann</div>
                                 </div>
                                 <button class="w-full py-3 blue-gradient text-white rounded-xl font-bold text-sm shadow-lg">Enregistrer</button>
                             </div>
                         </div>
                     </div>
                </div>
                <div class="relative z-20 w-64 transform rotate-6 -translate-x-12 mt-20">
                    <div class="bg-slate-900 rounded-[3rem] p-3 shadow-2xl border-[6px] border-slate-800">
                        <div class="bg-white rounded-[2.5rem] overflow-hidden aspect-[9/19] p-4 space-y-6">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-extrabold">Notifications</span>
                                <span class="text-blue-600 text-xs font-bold">Tout marquer</span>
                            </div>
                            <div class="space-y-4">
                                <div class="flex gap-3 p-3 bg-blue-50 rounded-2xl border border-blue-100">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                        <i data-lucide="bell" class="w-4 h-4"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold">Rappel visite</p>
                                        <p class="text-[10px] text-slate-500">Demain à 09:00...</p>
                                    </div>
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mt-1"></div>
                                </div>
                                <div class="flex gap-3 p-3 bg-white rounded-2xl border border-slate-100">
                                    <div class="w-8 h-8 bg-red-50 rounded-full flex items-center justify-center text-red-500">
                                        <i data-lucide="x-circle" class="w-4 h-4"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold">Visite annulée</p>
                                        <p class="text-[10px] text-slate-500">Dr. Moussa Fali...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-8">
                <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Une expérience <span class="text-blue-600">mobile-first</span>.
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed">
                    Accédez à vos données sur le terrain. MedRep est optimisé pour les tablettes et smartphones pour vous accompagner dans chaque établissement.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 font-semibold">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </div>
                        Synchronisation en temps réel
                    </li>
                    <li class="flex items-center gap-3 font-semibold">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </div>
                        Mode hors-ligne disponible
                    </li>
                    <li class="flex items-center gap-3 font-semibold">
                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </div>
                        Interface tactile fluide
                    </li>
                </ul>
                <div class="pt-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all">
                        Commencer maintenant
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-white border-t border-slate-100 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 blue-gradient rounded flex items-center justify-center">
                    <i data-lucide="plus" class="text-white w-4 h-4"></i>
                </div>
                <span class="text-lg font-bold">MedRep</span>
            </div>
            <p class="text-slate-400 text-sm">
                &copy; 2026 MedRep Platform. Tous droits réservés.
            </p>
            <div class="flex items-center gap-6 text-slate-400">
                <a href="#" class="hover:text-blue-600 transition"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                <a href="#" class="hover:text-blue-600 transition"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                <a href="#" class="hover:text-blue-600 transition"><i data-lucide="github" class="w-5 h-5"></i></a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</body>
</html>
