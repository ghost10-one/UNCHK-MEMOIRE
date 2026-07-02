<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sama-Sante — Plateforme SaaS médicale #1 au Sénégal</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: '#2563eb', // blue-600
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2 cursor-pointer">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <span class="text-2xl font-bold text-gray-900 tracking-tight">Sama-Sante</span>
            </div>
            <div class="hidden lg:flex gap-8 text-sm font-medium text-gray-600">
                <a href="#" class="hover:text-blue-600 transition">Accueil</a>
                <a href="#features" class="hover:text-blue-600 transition">Fonctionnalités</a>
                <a href="#solutions" class="hover:text-blue-600 transition">Solutions</a>
                <a href="#pricing" class="hover:text-blue-600 transition">Tarifs</a>
                <a href="#" class="hover:text-blue-600 transition">À propos</a>
                <a href="#contact" class="hover:text-blue-600 transition">Contact</a>
            </div>
            <div class="flex gap-4 items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition hidden sm:block">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 transition shadow-md hover:shadow-lg shadow-blue-200">
                                Créer un compte
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-b from-blue-50/50 to-white relative overflow-hidden">
        <!-- Abstract Shapes -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100/50 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 mb-20 w-72 h-72 rounded-full bg-purple-100/50 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-xs font-semibold px-4 py-1.5 rounded-full mb-8 border border-blue-100">
                    <i class="fa-solid fa-sparkles text-blue-500"></i> Plateforme SaaS médicale #1 au Sénégal
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 leading-[1.1] mb-6 tracking-tight">
                    Optimisez le travail de vos<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">délégués médicaux</span><br/>
                    avec une plateforme tout-en-un.
                </h1>
                <p class="text-lg md:text-xl text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Planifiez les visites, gérez vos équipes, suivez les performances, automatisez vos campagnes et améliorez vos relations avec les professionnels de santé.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 text-white rounded-full text-base font-semibold hover:bg-blue-700 transition shadow-xl shadow-blue-200/50 flex items-center justify-center gap-2 group">
                        Commencer gratuitement <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#demo" class="px-8 py-4 bg-white border-2 border-gray-100 text-gray-700 rounded-full text-base font-semibold hover:border-gray-200 hover:bg-gray-50 transition flex items-center justify-center gap-2">
                        <i class="fa-regular fa-circle-play"></i> Voir la démonstration
                    </a>
                </div>
                <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-500 font-medium">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> 14 jours d'essai gratuit</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Sans carte bancaire</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> RGPD conforme</span>
                </div>
            </div>

            <!-- Dashboard Mockup -->
            <div class="mt-20 relative mx-auto max-w-5xl">
                <div class="rounded-2xl border border-gray-200/50 bg-white shadow-2xl shadow-gray-200/50 overflow-hidden ring-1 ring-gray-900/5 relative">
                    <!-- Fake Window Header -->
                    <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        <div class="mx-auto bg-white rounded-md px-3 py-1 flex items-center text-xs text-gray-400 border border-gray-200 w-64 justify-center gap-2">
                            <i class="fa-solid fa-lock text-[10px]"></i> app.sama-sante.fr/dashboard
                        </div>
                    </div>
                    <!-- Fake Content -->
                    <div class="p-8 grid grid-cols-1 md:grid-cols-4 gap-6 bg-gray-50/50">
                        <!-- Sidebar -->
                        <div class="hidden md:block col-span-1 space-y-4 border-r border-gray-100 pr-4">
                            <div class="h-10 bg-gray-200 rounded-lg w-3/4 mb-8"></div>
                            <div class="space-y-4 pt-4">
                                <div class="flex items-center gap-3 text-blue-600 bg-blue-50 px-3 py-2 rounded-lg font-medium text-sm"><i class="fa-solid fa-chart-pie"></i> Dashboard</div>
                                <div class="flex items-center gap-3 text-gray-500 px-3 py-2 text-sm"><i class="fa-regular fa-calendar"></i> Calendrier</div>
                                <div class="flex items-center gap-3 text-gray-500 px-3 py-2 text-sm"><i class="fa-solid fa-users"></i> Équipe</div>
                                <div class="flex items-center gap-3 text-gray-500 px-3 py-2 text-sm"><i class="fa-solid fa-file-lines"></i> Rapports</div>
                            </div>
                        </div>
                        <!-- Main -->
                        <div class="col-span-1 md:col-span-3 space-y-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Dashboard Manager</h3>
                                    <p class="text-xs text-gray-500">Bonjour, Dr. Ahmed • 27 Juin 2025</p>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white shadow flex items-center justify-center text-blue-700 font-bold">A</div>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="text-xs text-gray-500 mb-1">Visites ce mois</div>
                                    <div class="text-2xl font-bold text-gray-800">1 247</div>
                                    <div class="text-xs text-green-500 font-medium">+12%</div>
                                </div>
                                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="text-xs text-gray-500 mb-1">Délégués actifs</div>
                                    <div class="text-2xl font-bold text-gray-800">48</div>
                                    <div class="text-xs text-green-500 font-medium">+3 ce mois</div>
                                </div>
                                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="text-xs text-gray-500 mb-1">Couverture terrain</div>
                                    <div class="text-2xl font-bold text-gray-800">87%</div>
                                    <div class="text-xs text-green-500 font-medium">+5 pts</div>
                                </div>
                                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="text-xs text-gray-500 mb-1">Satisfaction</div>
                                    <div class="text-2xl font-bold text-gray-800">4.8/5</div>
                                    <div class="text-xs text-yellow-400 font-medium flex gap-0.5"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div>
                                </div>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm h-64 flex flex-col">
                                <div class="flex justify-between mb-4"><span class="font-bold text-sm text-gray-700">Visites — 7 derniers mois</span><span class="text-blue-600 text-xs font-semibold">Voir tout →</span></div>
                                <div class="flex-1 border-b border-l border-gray-100 relative">
                                    <!-- Fake Graph Line -->
                                    <svg class="absolute inset-0 w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                                        <path d="M0,80 Q10,70 20,50 T40,60 T60,30 T80,40 T100,10" fill="none" stroke="#2563eb" stroke-width="2" class="animate-[dash_3s_ease-out_forwards]" stroke-dasharray="300" stroke-dashoffset="300"></path>
                                        <style>
                                            @keyframes dash { to { stroke-dashoffset: 0; } }
                                        </style>
                                    </svg>
                                </div>
                                <div class="flex justify-between text-[10px] text-gray-400 mt-2">
                                    <span>Jan</span><span>Fév</span><span>Mar</span><span>Avr</span><span>Mai</span><span>Jun</span><span>Jul</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-8">Ils font confiance à Sama-Sante</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 items-center opacity-70 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="text-xl font-bold text-gray-400 flex items-center gap-2"><i class="fa-solid fa-leaf text-green-500"></i> BioPharma</div>
                <div class="text-xl font-bold text-gray-400 flex items-center gap-2"><i class="fa-solid fa-microscope text-blue-500"></i> MedTech</div>
                <div class="text-xl font-bold text-gray-400 flex items-center gap-2"><i class="fa-solid fa-flask text-purple-500"></i> Novalab</div>
                <div class="text-xl font-bold text-gray-400 flex items-center gap-2"><i class="fa-solid fa-heart-pulse text-red-500"></i> HealthCare</div>
                <div class="text-xl font-bold text-gray-400 flex items-center gap-2"><i class="fa-solid fa-pills text-teal-500"></i> PharmaPlus</div>
            </div>
        </div>
    </section>

    <!-- Pourquoi Sama-Sante Section -->
    <section class="py-24 bg-gray-50/50" id="features">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">Pourquoi Sama-Sante ?</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Tout ce dont votre force de vente médicale a besoin</h2>
                <p class="text-lg text-gray-600">Une plateforme unifiée qui couvre l'ensemble du cycle de visite médicale, de la planification au reporting.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Gestion des visites</h3>
                    <p class="text-gray-600">Planifiez, organisez et suivez chaque visite terrain avec précision et efficacité.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Calendrier intelligent</h3>
                    <p class="text-gray-600">Un calendrier adaptatif qui optimise les tournées selon la géolocalisation et les priorités.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-regular fa-file-pdf"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Rapports automatiques</h3>
                    <p class="text-gray-600">Générez des rapports professionnels PDF personnalisés en un seul clic.</p>
                </div>
                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Campagnes marketing</h3>
                    <p class="text-gray-600">Pilotez des campagnes ciblées pour vos délégués et professionnels de santé.</p>
                </div>
                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Notifications temps réel</h3>
                    <p class="text-gray-600">Restez informé instantanément avec des alertes contextuelles sur tous vos appareils.</p>
                </div>
                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Gestion des équipes</h3>
                    <p class="text-gray-600">Administrez vos délégués, définissez des objectifs et suivez les performances individuelles.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Aperçu de la plateforme -->
    <section class="py-24 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6" x-data="{ tab: 'dashboard' }">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">Aperçu de la plateforme</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Une interface pensée pour l'efficacité</h2>
                <p class="text-lg text-gray-600">Découvrez chaque module de Sama-Sante : intuitif, puissant et conçu pour les équipes terrain.</p>
            </div>
            
            <!-- Tabs -->
            <div class="flex justify-center mb-12 overflow-x-auto pb-4 hide-scrollbar">
                <div class="inline-flex bg-gray-100 p-1 rounded-full">
                    <button @click="tab = 'dashboard'" :class="{'bg-white shadow-sm text-gray-900': tab === 'dashboard', 'text-gray-500 hover:text-gray-700': tab !== 'dashboard'}" class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all">Dashboard</button>
                    <button @click="tab = 'calendrier'" :class="{'bg-white shadow-sm text-gray-900': tab === 'calendrier', 'text-gray-500 hover:text-gray-700': tab !== 'calendrier'}" class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all">Calendrier</button>
                    <button @click="tab = 'visites'" :class="{'bg-white shadow-sm text-gray-900': tab === 'visites', 'text-gray-500 hover:text-gray-700': tab !== 'visites'}" class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all">Visites</button>
                    <button @click="tab = 'rapports'" :class="{'bg-white shadow-sm text-gray-900': tab === 'rapports', 'text-gray-500 hover:text-gray-700': tab !== 'rapports'}" class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all">Rapports</button>
                    <button @click="tab = 'campagnes'" :class="{'bg-white shadow-sm text-gray-900': tab === 'campagnes', 'text-gray-500 hover:text-gray-700': tab !== 'campagnes'}" class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all">Campagnes</button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-4 md:p-8 relative min-h-[400px]">
                <div x-show="tab === 'dashboard'" x-transition.opacity class="flex flex-col items-center justify-center h-full w-full">
                    <div class="w-full max-w-4xl h-96 bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col overflow-hidden">
                        <div class="border-b bg-gray-50 p-4 font-semibold text-gray-700 flex justify-between items-center">
                            <span>Vue d'ensemble</span>
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div><div class="w-3 h-3 rounded-full bg-yellow-400"></div><div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                        </div>
                        <div class="flex-1 p-6 flex flex-col gap-6">
                            <div class="grid grid-cols-4 gap-4">
                                <div class="bg-blue-50/50 rounded-lg p-4 border border-blue-100"><div class="text-xs text-gray-500">Revenus</div><div class="text-xl font-bold">120K €</div></div>
                                <div class="bg-green-50/50 rounded-lg p-4 border border-green-100"><div class="text-xs text-gray-500">Croissance</div><div class="text-xl font-bold text-green-600">+15%</div></div>
                                <div class="bg-purple-50/50 rounded-lg p-4 border border-purple-100"><div class="text-xs text-gray-500">Nouveaux</div><div class="text-xl font-bold">45</div></div>
                                <div class="bg-yellow-50/50 rounded-lg p-4 border border-yellow-100"><div class="text-xs text-gray-500">Objectif</div><div class="text-xl font-bold">80%</div></div>
                            </div>
                            <div class="flex-1 bg-gray-50 rounded-lg border border-gray-100 flex items-end justify-around px-8 pt-8 pb-4 relative">
                                <!-- Bars -->
                                <div class="w-12 bg-blue-200 rounded-t-md h-1/4"></div>
                                <div class="w-12 bg-blue-300 rounded-t-md h-2/4"></div>
                                <div class="w-12 bg-blue-400 rounded-t-md h-3/4"></div>
                                <div class="w-12 bg-blue-500 rounded-t-md h-full"></div>
                                <div class="w-12 bg-blue-600 rounded-t-md h-4/5"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Other tabs -->
                <div x-show="tab === 'calendrier'" x-transition.opacity class="flex flex-col items-center justify-center h-full w-full" style="display: none;">
                     <div class="w-full max-w-4xl h-96 bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col p-6 text-center justify-center text-gray-500 bg-gradient-to-br from-white to-gray-50">
                         <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-500 text-3xl"><i class="fa-regular fa-calendar-days"></i></div>
                         <h3 class="text-xl font-bold text-gray-800 mb-2">Calendrier Intégré</h3>
                         <p class="max-w-md mx-auto">Planifiez vos journées avec précision et optimisez vos trajets grâce à notre IA.</p>
                     </div>
                </div>
                <div x-show="tab === 'visites'" x-transition.opacity class="flex flex-col items-center justify-center h-full w-full" style="display: none;">
                    <div class="w-full max-w-4xl h-96 bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col p-6 text-center justify-center text-gray-500 bg-gradient-to-br from-white to-gray-50">
                         <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 text-green-500 text-3xl"><i class="fa-solid fa-route"></i></div>
                         <h3 class="text-xl font-bold text-gray-800 mb-2">Gestion des Visites</h3>
                         <p class="max-w-md mx-auto">Suivez l'historique complet, les comptes rendus et la validation GPS en un seul endroit.</p>
                     </div>
                </div>
                <div x-show="tab === 'rapports'" x-transition.opacity class="flex flex-col items-center justify-center h-full w-full" style="display: none;">
                    <div class="w-full max-w-4xl h-96 bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col p-6 text-center justify-center text-gray-500 bg-gradient-to-br from-white to-gray-50">
                         <div class="w-20 h-20 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-6 text-purple-500 text-3xl"><i class="fa-solid fa-file-pdf"></i></div>
                         <h3 class="text-xl font-bold text-gray-800 mb-2">Générateur de Rapports</h3>
                         <p class="max-w-md mx-auto">Créez et exportez des rapports professionnels d'un simple clic.</p>
                     </div>
                </div>
                <div x-show="tab === 'campagnes'" x-transition.opacity class="flex flex-col items-center justify-center h-full w-full" style="display: none;">
                    <div class="w-full max-w-4xl h-96 bg-white rounded-xl border border-gray-200 shadow-sm flex flex-col p-6 text-center justify-center text-gray-500 bg-gradient-to-br from-white to-gray-50">
                         <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 text-red-500 text-3xl"><i class="fa-solid fa-bullseye"></i></div>
                         <h3 class="text-xl font-bold text-gray-800 mb-2">Pilotez vos Campagnes</h3>
                         <p class="max-w-md mx-auto">Centralisez le lancement de vos nouveaux produits et mesurez l'impact direct.</p>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10 Modules Section -->
    <section class="py-24 bg-gray-50" id="modules">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">Fonctionnalités</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Des outils pensés pour le terrain médical</h2>
                <p class="text-lg text-gray-600">10 modules complets pour couvrir l'intégralité du cycle de vente médicale.</p>
            </div>

            <div class="space-y-32">
                <!-- Module 01 -->
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1 order-2 md:order-1 relative">
                        <div class="absolute inset-0 bg-blue-100 blur-3xl rounded-full opacity-50 transform -translate-x-10 translate-y-10"></div>
                        <div class="bg-white p-12 rounded-3xl border border-gray-100 shadow-xl relative z-10 flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg mb-6"><i class="fa-solid fa-calendar-day"></i></div>
                            <h4 class="font-bold text-xl mb-2 text-blue-900">Planification intelligente</h4>
                            <div class="flex gap-1 mt-4"><div class="w-2 h-2 rounded-full bg-blue-600"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div></div>
                        </div>
                    </div>
                    <div class="flex-1 order-1 md:order-2">
                        <div class="text-sm font-bold text-blue-600 mb-2">Module 01</div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Planification intelligente</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Notre algorithme IA optimise automatiquement les tournées de vos délégués en tenant compte de la géolocalisation, des priorités médecins et des contraintes horaires.</p>
                        <ul class="space-y-3 text-gray-700 font-medium">
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-blue-600"></i> Optimisation automatique des itinéraires</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-blue-600"></i> Réduction de 35% des déplacements inutiles</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-blue-600"></i> Synchronisation en temps réel</li>
                        </ul>
                        <a href="#" class="inline-flex items-center gap-2 text-blue-600 font-semibold mt-8 hover:text-blue-700">En savoir plus <i class="fa-solid fa-chevron-right text-xs"></i></a>
                    </div>
                </div>

                <!-- Module 02 -->
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1">
                        <div class="text-sm font-bold text-green-600 mb-2">Module 02</div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Suivi GPS en temps réel</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Géolocalisez l'ensemble de vos délégués sur une carte interactive. Visualisez les positions, les zones couvertes et l'historique des déplacements.</p>
                        <ul class="space-y-3 text-gray-700 font-medium">
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Tracking GPS haute précision</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Carte interactive en temps réel</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Historique complet des tournées</li>
                        </ul>
                        <a href="#" class="inline-flex items-center gap-2 text-green-600 font-semibold mt-8 hover:text-green-700">En savoir plus <i class="fa-solid fa-chevron-right text-xs"></i></a>
                    </div>
                    <div class="flex-1 relative">
                        <div class="absolute inset-0 bg-green-100 blur-3xl rounded-full opacity-50 transform translate-x-10 translate-y-10"></div>
                        <div class="bg-white p-12 rounded-3xl border border-gray-100 shadow-xl relative z-10 flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-green-500 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg mb-6"><i class="fa-solid fa-location-dot"></i></div>
                            <h4 class="font-bold text-xl mb-2 text-green-900">Suivi GPS en temps réel</h4>
                            <div class="flex gap-1 mt-4"><div class="w-2 h-2 rounded-full bg-green-500"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div></div>
                        </div>
                    </div>
                </div>
                
                <!-- Module 03 -->
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1 order-2 md:order-1 relative">
                        <div class="absolute inset-0 bg-yellow-100 blur-3xl rounded-full opacity-50 transform -translate-x-10 translate-y-10"></div>
                        <div class="bg-white p-12 rounded-3xl border border-gray-100 shadow-xl relative z-10 flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-yellow-500 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg mb-6"><i class="fa-solid fa-clipboard-check"></i></div>
                            <h4 class="font-bold text-xl mb-2 text-yellow-900">Validation des visites</h4>
                            <div class="flex gap-1 mt-4"><div class="w-2 h-2 rounded-full bg-yellow-500"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div></div>
                        </div>
                    </div>
                    <div class="flex-1 order-1 md:order-2">
                        <div class="text-sm font-bold text-yellow-600 mb-2">Module 03</div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Validation des visites</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Chaque visite est validée automatiquement avec signature électronique, photos géolocalisées et horodatage, garantissant une conformité totale.</p>
                        <ul class="space-y-3 text-gray-700 font-medium">
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-yellow-500"></i> Signature numérique du médecin</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-yellow-500"></i> Preuve photo géolocalisée</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-yellow-500"></i> Conformité réglementaire garantie</li>
                        </ul>
                        <a href="#" class="inline-flex items-center gap-2 text-yellow-600 font-semibold mt-8 hover:text-yellow-700">En savoir plus <i class="fa-solid fa-chevron-right text-xs"></i></a>
                    </div>
                </div>

                 <!-- Module 04 -->
                 <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1">
                        <div class="text-sm font-bold text-pink-600 mb-2">Module 04</div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Gestion des médecins</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Centralisez toutes les informations sur vos professionnels de santé, leurs spécialités, historiques de visites et préférences d'interaction.</p>
                        <ul class="space-y-3 text-gray-700 font-medium">
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-pink-500"></i> Fiches médecins complètes</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-pink-500"></i> Segmentation par spécialité</li>
                            <li class="flex items-center gap-3"><i class="fa-solid fa-check text-pink-500"></i> Historique des interactions</li>
                        </ul>
                        <a href="#" class="inline-flex items-center gap-2 text-pink-600 font-semibold mt-8 hover:text-pink-700">En savoir plus <i class="fa-solid fa-chevron-right text-xs"></i></a>
                    </div>
                    <div class="flex-1 relative">
                        <div class="absolute inset-0 bg-pink-100 blur-3xl rounded-full opacity-50 transform translate-x-10 translate-y-10"></div>
                        <div class="bg-white p-12 rounded-3xl border border-gray-100 shadow-xl relative z-10 flex flex-col items-center text-center">
                            <div class="w-20 h-20 bg-pink-500 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg mb-6"><i class="fa-solid fa-user-doctor"></i></div>
                            <h4 class="font-bold text-xl mb-2 text-pink-900">Gestion des médecins</h4>
                            <div class="flex gap-1 mt-4"><div class="w-2 h-2 rounded-full bg-pink-500"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div><div class="w-2 h-2 rounded-full bg-gray-200"></div></div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="text-center mt-20">
                <p class="text-gray-500 italic">Et 6 autres modules complets (Rapports PDF, Notifications, Analytics, Campagnes marketing, Gestion utilisateurs, Permissions par rôle).</p>
            </div>
        </div>
    </section>

    <!-- Chiffres Clés -->
    <section class="py-20 bg-blue-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/5"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <span class="text-blue-200 text-xs font-bold tracking-widest uppercase mb-4 block">Chiffres clés</span>
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-16">Des résultats mesurables dès le premier mois</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4">
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-3xl mx-auto mb-6 backdrop-blur-sm border border-white/20"><i class="fa-solid fa-handshake"></i></div>
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">10 000+</div>
                    <div class="text-blue-100 font-medium">Visites réalisées</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-3xl mx-auto mb-6 backdrop-blur-sm border border-white/20"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">500+</div>
                    <div class="text-blue-100 font-medium">Professionnels de santé</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-3xl mx-auto mb-6 backdrop-blur-sm border border-white/20"><i class="fa-solid fa-star"></i></div>
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">98%</div>
                    <div class="text-blue-100 font-medium">Taux de satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-white text-3xl mx-auto mb-6 backdrop-blur-sm border border-white/20"><i class="fa-solid fa-arrow-trend-up"></i></div>
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">45%</div>
                    <div class="text-blue-100 font-medium">Gain de temps moyen</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comment ça fonctionne -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-24">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4"><i class="fa-solid fa-gears"></i> Comment ça fonctionne</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Opérationnel en 4 étapes simples</h2>
                <p class="text-lg text-gray-600">De l'inscription au premier rapport, Sama-Sante vous guide à chaque étape de votre transformation digitale.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative">
                <!-- Connecting Line (Desktop only) -->
                <div class="hidden md:block absolute top-12 left-[12%] right-[12%] h-0.5 bg-gray-100"></div>
                
                <div class="text-center relative">
                    <div class="text-7xl font-extrabold text-gray-50 absolute -top-8 left-1/2 -translate-x-1/2 -z-10 select-none">01</div>
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-6 shadow-xl shadow-blue-200 relative z-10"><i class="fa-solid fa-user-plus"></i></div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Créez votre compte</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Configurez votre espace en quelques minutes. Importez vos équipes, définissez vos territoires et personnalisez vos objectifs.</p>
                </div>
                <div class="text-center relative">
                    <div class="text-7xl font-extrabold text-gray-50 absolute -top-8 left-1/2 -translate-x-1/2 -z-10 select-none">02</div>
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-6 shadow-xl shadow-blue-200 relative z-10"><i class="fa-regular fa-calendar-check"></i></div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Planifiez les visites</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Utilisez notre planificateur intelligent pour organiser les tournées de vos délégués de manière optimale et efficace.</p>
                </div>
                <div class="text-center relative">
                    <div class="text-7xl font-extrabold text-gray-50 absolute -top-8 left-1/2 -translate-x-1/2 -z-10 select-none">03</div>
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-6 shadow-xl shadow-blue-200 relative z-10"><i class="fa-solid fa-route"></i></div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Effectuez les tournées</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Vos délégués suivent leur planning sur mobile, valident leurs visites et remontent les informations en temps réel.</p>
                </div>
                <div class="text-center relative">
                    <div class="text-7xl font-extrabold text-gray-50 absolute -top-8 left-1/2 -translate-x-1/2 -z-10 select-none">04</div>
                    <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-6 shadow-xl shadow-blue-200 relative z-10"><i class="fa-solid fa-chart-line"></i></div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Suivez les performances</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Analysez les KPIs en temps réel, générez des rapports automatiques et optimisez votre stratégie commerciale.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4"><i class="fa-solid fa-comment-dots"></i> Témoignages</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Ce que disent nos clients</h2>
                <p class="text-lg text-gray-600">Plus de 200 laboratoires pharmaceutiques font confiance à Sama-Sante pour optimiser leur force de vente.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm relative hover:shadow-md transition">
                    <div class="text-yellow-400 text-sm mb-4"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-700 italic mb-8">"Sama-Sante a transformé la gestion de nos 120 délégués médicaux. La visibilité en temps réel sur nos équipes est tout simplement révolutionnaire. Nous avons augmenté notre couverture de 42% en 6 mois."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden"><img src="https://ui-avatars.com/api/?name=Sophie+Martin&background=random" alt="Sophie"></div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Dr. Sophie Martin</div>
                            <div class="text-xs text-gray-500">Directrice Commerciale - BioPharma France</div>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm relative hover:shadow-md transition">
                    <div class="text-yellow-400 text-sm mb-4"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-700 italic mb-8">"Grâce à Sama-Sante, nos délégués passent moins de temps en planification et plus de temps sur le terrain. L'interface mobile est intuitive et le suivi GPS a changé notre façon de travailler."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden"><img src="https://ui-avatars.com/api/?name=Thomas+Dubois&background=random" alt="Thomas"></div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Thomas Dubois</div>
                            <div class="text-xs text-gray-500">Responsable des Ventes - Novalab</div>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm relative hover:shadow-md transition">
                    <div class="text-yellow-400 text-sm mb-4"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-gray-700 italic mb-8">"La fonctionnalité de campagnes marketing intégrée nous permet de centraliser toute notre stratégie commerciale. Les rapports automatiques nous font gagner des heures chaque semaine."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden"><img src="https://ui-avatars.com/api/?name=Marie+Leclerc&background=random" alt="Marie"></div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Marie Leclerc</div>
                            <div class="text-xs text-gray-500">VP Marketing - HealthCare Solutions</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tarifs -->
    <section class="py-24 bg-white" id="pricing">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4"><i class="fa-solid fa-tags"></i> Tarifs</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Un plan adapté à chaque laboratoire</h2>
                <p class="text-lg text-gray-600">Commencez gratuitement, évoluez selon vos besoins. Aucun frais caché, résiliation à tout moment.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto items-center">
                <!-- Starter -->
                <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                    <p class="text-gray-500 text-sm mb-6 h-10">Idéal pour les petites équipes jusqu'à 10 délégués.</p>
                    <div class="mb-6"><span class="text-4xl font-extrabold text-gray-900">€ 149</span> <span class="text-gray-500">/ mois</span></div>
                    <ul class="space-y-4 mb-8 text-gray-600 text-sm font-medium">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Jusqu'à 10 délégués</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Planification des visites</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Tracking GPS basique</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Rapports mensuels</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Application mobile iOS & Android</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Support email</li>
                        <li class="flex items-center gap-3 opacity-40"><i class="fa-solid fa-xmark text-gray-400"></i> Analytics avancés</li>
                        <li class="flex items-center gap-3 opacity-40"><i class="fa-solid fa-xmark text-gray-400"></i> Campagnes marketing</li>
                        <li class="flex items-center gap-3 opacity-40"><i class="fa-solid fa-xmark text-gray-400"></i> API access</li>
                        <li class="flex items-center gap-3 opacity-40"><i class="fa-solid fa-xmark text-gray-400"></i> Intégration CRM</li>
                    </ul>
                    <a href="#" class="block w-full py-3 px-4 border-2 border-gray-200 text-gray-700 text-center font-bold rounded-xl hover:bg-gray-50 transition">Essayer gratuitement</a>
                </div>
                
                <!-- Professional -->
                <div class="bg-blue-600 p-8 rounded-3xl border border-blue-500 shadow-2xl shadow-blue-600/30 relative transform md:-translate-y-4 text-white">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-yellow-400 text-yellow-900 text-xs font-bold px-4 py-1 rounded-full flex items-center gap-1 shadow-sm"><i class="fa-solid fa-star"></i> Le plus populaire</div>
                    <h3 class="text-2xl font-bold mb-2">Professional</h3>
                    <p class="text-blue-100 text-sm mb-6 h-10">La solution complète pour les équipes en pleine croissance.</p>
                    <div class="mb-6"><span class="text-4xl font-extrabold">€ 399</span> <span class="text-blue-200">/ mois</span></div>
                    <ul class="space-y-4 mb-8 text-blue-50 text-sm font-medium">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Jusqu'à 50 délégués</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Planification intelligente IA</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Tracking GPS temps réel</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Rapports automatiques PDF</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Analytics avancés</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Campagnes marketing</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> API access & webhooks</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Intégrations CRM</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-white"></i> Support prioritaire 24/7</li>
                    </ul>
                    <a href="#" class="block w-full py-3 px-4 bg-white text-blue-600 text-center font-bold rounded-xl hover:bg-blue-50 transition shadow">Commencer l'essai gratuit</a>
                </div>

                <!-- Enterprise -->
                <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                    <p class="text-gray-500 text-sm mb-6 h-10">Pour les grands laboratoires avec des besoins spécifiques.</p>
                    <div class="mb-6"><span class="text-4xl font-extrabold text-gray-900">Sur devis</span></div>
                    <ul class="space-y-4 mb-8 text-gray-600 text-sm font-medium">
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Délégués illimités</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Toutes les fonctionnalités Pro</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Infrastructure dédiée</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> SLA garanti 99.9%</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Onboarding personnalisé</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Account manager dédié</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Intégrations sur mesure</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-check text-green-500"></i> Formation équipe incluse</li>
                    </ul>
                    <a href="#" class="block w-full py-3 px-4 border-2 border-gray-200 text-gray-700 text-center font-bold rounded-xl hover:bg-gray-50 transition">Nous contacter</a>
                </div>
            </div>
            <p class="text-center text-xs text-gray-400 mt-8">Tous les prix sont HT. TVA applicable selon la législation en vigueur. <a href="#" class="text-blue-600 hover:underline">Voir les conditions détaillées</a></p>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-4"><i class="fa-solid fa-circle-question"></i> FAQ</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Questions fréquentes</h2>
                <p class="text-lg text-gray-600">Tout ce que vous devez savoir avant de démarrer avec Sama-Sante.</p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                <!-- Q1 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button @click="active = (active === 1 ? null : 1)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-gray-900">Combien de temps faut-il pour déployer Sama-Sante ?</span>
                        <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 1" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">La configuration initiale prend moins de 48 heures. Notre équipe vous accompagne pour importer vos données, structurer vos secteurs et former vos équipes.</div>
                    </div>
                </div>
                <!-- Q2 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button @click="active = (active === 2 ? null : 2)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-gray-900">Sama-Sante est-il compatible avec notre CRM existant ?</span>
                        <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 2" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">Oui, Sama-Sante s'intègre facilement avec les principaux CRM du marché via notre API sécurisée et nos webhooks.</div>
                    </div>
                </div>
                <!-- Q3 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button @click="active = (active === 3 ? null : 3)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-gray-900">Comment fonctionne l'application mobile pour les délégués ?</span>
                        <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 3" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">L'application fonctionne même hors ligne. Les délégués peuvent consulter leur planning, saisir leurs comptes rendus et les données se synchronisent automatiquement de retour en ligne.</div>
                    </div>
                </div>
                <!-- Q4 -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300">
                    <button @click="active = (active === 4 ? null : 4)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-gray-900">Vos données sont-elles conformes au RGPD ?</span>
                        <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300" :class="active === 4 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 4" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">Absolument. La sécurité et la confidentialité sont nos priorités. Sama-Sante est 100% conforme au RGPD avec des serveurs sécurisés HDS (Hébergeur de Données de Santé).</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-blue-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-indigo-700 opacity-90"></div>
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-white/10 blur-3xl"></div>
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <span class="text-blue-200 font-semibold tracking-wider text-sm mb-4 block"><i class="fa-solid fa-rocket"></i> Rejoignez plus de 200 laboratoires</span>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">Prêt à moderniser votre force de vente médicale ?</h2>
            <p class="text-xl text-blue-100 mb-10">Démarrez votre essai gratuit de 14 jours aujourd'hui. Aucune carte bancaire requise. Configuration en moins de 48 heures.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-blue-700 rounded-full text-base font-bold hover:bg-gray-50 transition shadow-xl">
                    Créer un compte gratuit <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a href="#demo" class="px-8 py-4 border-2 border-blue-400 text-white rounded-full text-base font-bold hover:bg-blue-500/30 transition">
                    Demander une démonstration
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 lg:gap-8 mb-12">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2 mb-6 text-white">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold"><i class="fa-solid fa-notes-medical"></i></div>
                    <span class="text-2xl font-bold tracking-tight">Sama-Sante</span>
                </div>
                <p class="text-sm text-gray-400 mb-6 max-w-sm">
                    La plateforme intelligente de gestion des délégués médicaux. Conçue pour les laboratoires pharmaceutiques exigeants.
                </p>
                
                <form class="mb-6 flex">
                    <input type="email" placeholder="votre@email.com" class="bg-gray-800 border border-gray-700 text-white px-4 py-2 rounded-l-lg focus:outline-none focus:border-blue-500 w-full text-sm">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg font-semibold text-sm transition">OK</button>
                </form>

                <div class="flex gap-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><i class="fa-brands fa-twitter text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><i class="fa-brands fa-linkedin-in text-sm"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><i class="fa-brands fa-instagram text-sm"></i></a>
                </div>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-6">Produit</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-blue-400 transition">Fonctionnalités</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Dashboard</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Calendrier</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Rapports</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Campagnes</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">API</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-6">Entreprise</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-blue-400 transition">À propos</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Blog</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Carrières</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Presse</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Partenaires</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Investisseurs</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold mb-6">Support & Légal</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-blue-400 transition">Documentation</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Centre d'aide</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Confidentialité</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Conditions d'utilisation</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Mentions légales</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">RGPD</a></li>
                </ul>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>&copy; 2026 Sama-Sante SAS. Tous droits réservés. Hébergé en France 🇫🇷</p>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-green-500"></div> Tous les systèmes opérationnels
            </div>
        </div>
    </footer>

</body>
</html>
