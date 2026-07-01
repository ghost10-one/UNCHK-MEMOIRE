<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedRep — Plateforme SaaS médicale #1 au Sénégal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

<!-- ===== NAVBAR ===== -->
<nav class="fixed top-0 w-full bg-white border-b border-gray-100 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <span class="w-7 h-7 bg-blue-600 rounded flex items-center
                         justify-center text-white font-bold text-sm">+</span>
            <span class="text-xl font-bold text-gray-900">MedRep</span>
        </div>
        <div class="hidden md:flex gap-8 text-sm text-gray-600">
            <a href="#" class="hover:text-blue-600 transition">Accueil</a>
            <a href="#fonctionnalites" class="hover:text-blue-600 transition">Fonctionnalités</a>
            <a href="#solutions" class="hover:text-blue-600 transition">Solutions</a>
            <a href="#tarifs" class="hover:text-blue-600 transition">Tarifs</a>
            <a href="#" class="hover:text-blue-600 transition">À propos</a>
            <a href="#contact" class="hover:text-blue-600 transition">Contact</a>
        </div>
        <div class="flex gap-3 items-center">
            <a href="#login" class="text-sm text-gray-700 hover:text-blue-600 transition">
                Connexion
            </a>
            <a href="#register"
               class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg
                      hover:bg-blue-700 transition">
                Créer un compte
            </a>
        </div>
    </div>
</nav>

<!-- ===== HERO ===== -->
<section class="pt-28 pb-20 bg-gradient-to-br from-slate-50 via-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-4xl mx-auto">
            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold
                         px-3 py-1 rounded-full mb-6">
                Plateforme SaaS médicale #1 au Sénégal
            </span>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                Optimisez le travail de vos<br>
                <span class="text-blue-600">délégués médicaux</span><br>
                avec une plateforme tout-en-un.
            </h1>
            <p class="text-lg text-gray-500 mb-8 max-w-2xl mx-auto leading-relaxed">
                Planifiez les visites, gérez vos équipes, suivez les performances,
                automatisez vos campagnes et améliorez vos relations avec les
                professionnels de santé.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="#register"
                   class="px-8 py-4 bg-blue-600 text-white rounded-xl text-base
                          font-semibold hover:bg-blue-700 transition shadow-lg
                          shadow-blue-200">
                    Commencer gratuitement →
                </a>
                <a href="#demo"
                   class="px-8 py-4 border border-gray-200 text-gray-700 rounded-xl
                          text-base hover:bg-gray-50 transition">
                    Voir la démonstration
                </a>
            </div>
            <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-500">
                <span class="flex items-center gap-1">
                    <span class="text-green-500">✓</span> 14 jours d'essai gratuit
                </span>
                <span class="flex items-center gap-1">
                    <span class="text-green-500">✓</span> Sans carte bancaire
                </span>
                <span class="flex items-center gap-1">
                    <span class="text-green-500">✓</span> RGPD conforme
                </span>
            </div>
        </div>

        <!-- Logos clients -->
        <div class="mt-16 text-center">
            <p class="text-sm text-gray-400 mb-6">Ils font confiance à MedRep</p>
            <div class="flex flex-wrap justify-center gap-8 items-center">
                <div class="bg-white border border-gray-100 rounded-lg px-5 py-2 shadow-sm text-sm font-semibold text-gray-400">BioPharma</div>
                <div class="bg-white border border-gray-100 rounded-lg px-5 py-2 shadow-sm text-sm font-semibold text-gray-400">MedTech</div>
                <div class="bg-white border border-gray-100 rounded-lg px-5 py-2 shadow-sm text-sm font-semibold text-gray-400">Novalab</div>
                <div class="bg-white border border-gray-100 rounded-lg px-5 py-2 shadow-sm text-sm font-semibold text-gray-400">HealthCare</div>
                <div class="bg-white border border-gray-100 rounded-lg px-5 py-2 shadow-sm text-sm font-semibold text-gray-400">PharmaPlus</div>
                <div class="bg-white border border-gray-100 rounded-lg px-5 py-2 shadow-sm text-sm font-semibold text-gray-400">LifeMed</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CHIFFRES CLÉS ===== -->
<section class="py-16 bg-white border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl font-bold text-blue-600 mb-2">10 000+</p>
                <p class="text-sm text-gray-500">Visites réalisées</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-blue-600 mb-2">500+</p>
                <p class="text-sm text-gray-500">Professionnels de santé</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-blue-600 mb-2">98%</p>
                <p class="text-sm text-gray-500">Taux de satisfaction</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-blue-600 mb-2">45%</p>
                <p class="text-sm text-gray-500">Gain de temps moyen</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== TÉMOIGNAGES ===== -->
<section id="temoignages" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                Témoignages
            </span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                Ce que disent nos clients
            </h2>
            <p class="text-gray-500 max-w-xl mx-auto">
                Plus de 200 laboratoires pharmaceutiques font confiance à MedRep
                pour optimiser leur force de vente.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex text-yellow-400 text-lg mb-4">★★★★★</div>
                <p class="text-gray-600 italic leading-relaxed mb-6">
                    "MedRep a transformé la gestion de nos 120 délégués médicaux. La visibilité en temps réel sur nos équipes est tout simplement révolutionnaire. Nous avons augmenté notre couverture de 42% en 6 mois."
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">S</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Dr. Sophie Martin</p>
                        <p class="text-xs text-gray-400">Directrice Commerciale BioPharma France</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex text-yellow-400 text-lg mb-4">★★★★★</div>
                <p class="text-gray-600 italic leading-relaxed mb-6">
                    "Grâce à MedRep, nos délégués passent moins de temps en planification et plus de temps sur le terrain. L'interface mobile est intuitive et le suivi GPS a changé notre façon de travailler."
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">T</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Thomas Dubois</p>
                        <p class="text-xs text-gray-400">Responsable des Ventes Novalab</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex text-yellow-400 text-lg mb-4">★★★★★</div>
                <p class="text-gray-600 italic leading-relaxed mb-6">
                    "La fonctionnalité de campagnes marketing intégrée nous permet de centraliser toute notre stratégie commerciale. Les rapports automatiques nous font gagner des heures chaque semaine."
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">M</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Marie Leclerc</p>
                        <p class="text-xs text-gray-400">VP Marketing HealthCare Solutions</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- ===== APERÇU PLATEFORME ===== --}}
<section id="demo" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                Aperçu de la plateforme
            </span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                Une interface pensée pour l'efficacité
            </h2>
            <p class="text-gray-500 max-w-xl mx-auto">
                Découvrez chaque module de MedRep : intuitif, puissant et 
                conçu pour les équipes terrain.
            </p>
        </div>

        {{-- Onglets --}}
        <div x-data="{ onglet: 'dashboard' }">
            <div class="flex justify-center gap-2 mb-8 flex-wrap">
                @foreach([
                    ['id' => 'dashboard', 'label' => 'Dashboard'],
                    ['id' => 'calendrier', 'label' => 'Calendrier'],
                    ['id' => 'visites', 'label' => 'Visites'],
                    ['id' => 'rapports', 'label' => 'Rapports'],
                    ['id' => 'campagnes', 'label' => 'Campagnes'],
                ] as $tab)
                <button @click="onglet = '{{ $tab['id'] }}'"
                        :class="onglet === '{{ $tab['id'] }}' 
                                ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' 
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-5 py-2 rounded-lg text-sm font-medium transition">
                    {{ $tab['label'] }}
                </button>
                @endforeach
            </div>

            {{-- Dashboard --}}
            <div x-show="onglet === 'dashboard'" 
                 x-transition
                 class="bg-gray-50 rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="bg-white rounded-xl p-4 mb-4 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-400">Dashboard Manager</p>
                        <p class="font-semibold text-gray-800">Bonjour, Dr. Ahmed • 27 Juin 2025</p>
                    </div>
                    <span class="w-8 h-8 bg-blue-600 rounded-full flex items-center 
                                 justify-center text-white font-bold text-sm">A</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @foreach([
                        ['label' => 'Visites ce mois', 'value' => '1 247', 'trend' => '+12%'],
                        ['label' => 'Délégués actifs', 'value' => '48', 'trend' => '+3 ce mois'],
                        ['label' => 'Couverture terrain', 'value' => '87%', 'trend' => '+5 pts'],
                        ['label' => 'Satisfaction', 'value' => '4.8/5', 'trend' => '★★★★★'],
                    ] as $kpi)
                    <div class="bg-white rounded-xl p-4 border border-gray-100">
                        <p class="text-xs text-gray-400 mb-1">{{ $kpi['label'] }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $kpi['value'] }}</p>
                        <p class="text-xs text-green-500 mt-1">{{ $kpi['trend'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100">
                    <p class="text-sm font-semibold text-gray-700 mb-3">
                        Visites récentes
                    </p>
                    @foreach([
                        ['nom' => 'Dr. Amrani Karima', 'spec' => 'Cardiologue', 'heure' => '09:30', 'statut' => 'Validée', 'couleur' => 'bg-green-100 text-green-700'],
                        ['nom' => 'Dr. Benali Rachid', 'spec' => 'Généraliste', 'heure' => '11:15', 'statut' => 'En cours', 'couleur' => 'bg-blue-100 text-blue-700'],
                        ['nom' => 'Dr. Chaoui Malak', 'spec' => 'Neurologue', 'heure' => '14:00', 'statut' => 'Planifiée', 'couleur' => 'bg-gray-100 text-gray-700'],
                    ] as $v)
                    <div class="flex items-center justify-between py-2 border-b 
                                border-gray-50 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center 
                                        justify-center text-blue-600 font-bold text-xs">
                                {{ substr($v['nom'], 3, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $v['nom'] }}</p>
                                <p class="text-xs text-gray-400">{{ $v['spec'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-gray-400">{{ $v['heure'] }}</span>
                            <span class="text-xs px-2 py-1 rounded-full {{ $v['couleur'] }}">
                                {{ $v['statut'] }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Calendrier --}}
            <div x-show="onglet === 'calendrier'"
                 x-transition
                 class="bg-gray-50 rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="bg-white rounded-xl p-6 text-center">
                    <p class="text-lg font-bold text-gray-800 mb-4">📅 Juin 2025</p>
                    <div class="grid grid-cols-7 gap-1 text-xs text-center">
                        @foreach(['L', 'M', 'M', 'J', 'V', 'S', 'D'] as $j)
                        <div class="py-2 text-gray-400 font-semibold">{{ $j }}</div>
                        @endforeach
                        @for($i = 1; $i <= 30; $i++)
                        <div class="py-2 rounded-lg text-sm
                            {{ $i == 27 ? 'bg-blue-600 text-white font-bold' : 
                               ($i % 6 == 0 ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100') }}">
                            {{ $i }}
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Visites --}}
            <div x-show="onglet === 'visites'"
                 x-transition
                 class="bg-gray-50 rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="bg-white rounded-xl p-4">
                    <p class="font-semibold text-gray-800 mb-4">📋 Liste des visites</p>
                    @foreach([
                        ['medecin' => 'Dr. Amrani Karima', 'date' => '27/06/2025', 'zone' => 'Dakar Centre', 'statut' => 'Validée', 'c' => 'text-green-600 bg-green-50'],
                        ['medecin' => 'Dr. Benali Rachid', 'date' => '27/06/2025', 'zone' => 'Plateau', 'statut' => 'En cours', 'c' => 'text-blue-600 bg-blue-50'],
                        ['medecin' => 'Dr. Chaoui Malak', 'date' => '28/06/2025', 'zone' => 'Almadies', 'statut' => 'Planifiée', 'c' => 'text-gray-600 bg-gray-50'],
                        ['medecin' => 'Dr. Diallo Fatou', 'date' => '28/06/2025', 'zone' => 'Pikine', 'statut' => 'Planifiée', 'c' => 'text-gray-600 bg-gray-50'],
                    ] as $v)
                    <div class="flex items-center justify-between py-3 border-b 
                                border-gray-50 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $v['medecin'] }}</p>
                            <p class="text-xs text-gray-400">{{ $v['zone'] }} • {{ $v['date'] }}</p>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full font-medium {{ $v['c'] }}">
                            {{ $v['statut'] }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Rapports --}}
            <div x-show="onglet === 'rapports'"
                 x-transition
                 class="bg-gray-50 rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="bg-white rounded-xl p-4">
                    <p class="font-semibold text-gray-800 mb-4">📊 Rapports disponibles</p>
                    @foreach([
                        ['titre' => 'Rapport mensuel — Juin 2025', 'type' => 'PDF', 'date' => '01/07/2025', 'c' => 'bg-red-100 text-red-600'],
                        ['titre' => 'Export visites — Semaine 26', 'type' => 'Excel', 'date' => '30/06/2025', 'c' => 'bg-green-100 text-green-600'],
                        ['titre' => 'Audit trail — Juin 2025', 'type' => 'CSV', 'date' => '30/06/2025', 'c' => 'bg-blue-100 text-blue-600'],
                    ] as $r)
                    <div class="flex items-center justify-between py-3 border-b 
                                border-gray-50 last:border-0">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $r['titre'] }}</p>
                            <p class="text-xs text-gray-400">Généré le {{ $r['date'] }}</p>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $r['c'] }}">
                            {{ $r['type'] }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Campagnes --}}
            <div x-show="onglet === 'campagnes'"
                 x-transition
                 class="bg-gray-50 rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="bg-white rounded-xl p-4">
                    <p class="font-semibold text-gray-800 mb-4">📢 Campagnes en cours</p>
                    @foreach([
                        ['nom' => 'Campagne CardioPlus', 'zone' => 'Dakar & banlieue', 'progress' => 75, 'c' => 'bg-blue-600'],
                        ['nom' => 'Lancement NovaMed', 'zone' => 'Thiès', 'progress' => 45, 'c' => 'bg-green-500'],
                        ['nom' => 'Promo VitaHealth', 'zone' => 'Saint-Louis', 'progress' => 20, 'c' => 'bg-purple-500'],
                    ] as $camp)
                    <div class="py-3 border-b border-gray-50 last:border-0">
                        <div class="flex justify-between mb-2">
                            <p class="text-sm font-medium text-gray-800">{{ $camp['nom'] }}</p>
                            <p class="text-xs text-gray-400">{{ $camp['zone'] }}</p>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="{{ $camp['c'] }} h-2 rounded-full transition-all"
                                 style="width: {{ $camp['progress'] }}%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">{{ $camp['progress'] }}% complété</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== TARIFS ===== -->
<section id="tarifs" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                Tarifs
            </span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                Un plan adapté à chaque laboratoire
            </h2>
            <p class="text-gray-500">
                Commencez gratuitement, évoluez selon vos besoins.<br>
                Aucun frais caché, résiliation à tout moment.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

            <!-- Starter -->
            <div class="border border-gray-200 rounded-2xl p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-1">Starter</h3>
                <p class="text-sm text-gray-400 mb-6">
                    Idéal pour les petites équipes jusqu'à 10 délégués.
                </p>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-gray-900">€149</span>
                    <span class="text-gray-400 text-sm">/ mois</span>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8">
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Jusqu'à 10 délégués</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Planification des visites</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Tracking GPS basique</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Rapports mensuels</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Application mobile iOS & Android</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Support email</li>
                    <li class="flex items-center gap-2 text-gray-300"><span>✕</span> Analytics avancés</li>
                    <li class="flex items-center gap-2 text-gray-300"><span>✕</span> Campagnes marketing</li>
                    <li class="flex items-center gap-2 text-gray-300"><span>✕</span> API access</li>
                </ul>
                <a href="#register"
                   class="block text-center py-3 border border-blue-600 text-blue-600
                          rounded-xl hover:bg-blue-50 transition font-semibold text-sm">
                    Essayer gratuitement
                </a>
            </div>

            <!-- Professional -->
            <div class="border-2 border-blue-600 rounded-2xl p-8 relative
                        shadow-xl shadow-blue-100">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                    <span class="bg-blue-600 text-white text-xs font-semibold
                                 px-4 py-1.5 rounded-full whitespace-nowrap">
                        ★ Le plus populaire
                    </span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Professional</h3>
                <p class="text-sm text-gray-400 mb-6">
                    La solution complète pour les équipes en pleine croissance.
                </p>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-gray-900">€399</span>
                    <span class="text-gray-400 text-sm">/ mois</span>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8">
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Jusqu'à 50 délégués</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Planification intelligente IA</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Tracking GPS temps réel</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Rapports automatiques PDF</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Analytics avancés</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Campagnes marketing</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> API access & webhooks</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Intégrations CRM</li>
                    <li class="flex items-center gap-2"><span class="text-green-500 font-bold">✓</span> Support prioritaire 24/7</li>
                </ul>
                <a href="#register"
                   class="block text-center py-3 bg-blue-600 text-white rounded-xl
                          hover:bg-blue-700 transition font-semibold text-sm shadow-lg
                          shadow-blue-200">
                    Commencer l'essai gratuit
                </a>
            </div>

            <!-- Enterprise -->
            <div class="border border-gray-200 rounded-2xl p-8 bg-gray-900">
                <h3 class="text-lg font-bold text-white mb-1">Enterprise</h3>
                <p class="text-sm text-gray-400 mb-6">
                    Pour les grands laboratoires avec des besoins spécifiques.
                </p>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-white">Sur devis</span>
                </div>
                <ul class="space-y-3 text-sm text-gray-300 mb-8">
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Délégués illimités</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Toutes les fonctionnalités Pro</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Infrastructure dédiée</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> SLA garanti 99.9%</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Onboarding personnalisé</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Account manager dédié</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Intégrations sur mesure</li>
                    <li class="flex items-center gap-2"><span class="text-blue-400 font-bold">✓</span> Formation équipe incluse</li>
                </ul>
                <a href="#contact"
                   class="block text-center py-3 border border-gray-600 text-white
                          rounded-xl hover:bg-gray-800 transition font-semibold text-sm">
                    Nous contacter
                </a>
            </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-6">
            Tous les prix sont HT. TVA applicable selon la législation en vigueur.
        </p>
    </div>
</section>

<!-- ===== FAQ ===== -->
<section id="faq" class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                FAQ
            </span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                Questions fréquentes
            </h2>
            <p class="text-gray-500">
                Tout ce que vous devez savoir avant de démarrer avec MedRep.
            </p>
        </div>
        <div class="space-y-3">

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Combien de temps faut-il pour déployer MedRep ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    MedRep peut être déployé en moins de 48 heures. Notre équipe vous accompagne lors de l'onboarding pour configurer votre espace, importer vos équipes et personnaliser vos objectifs.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">MedRep est-il compatible avec notre CRM existant ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    Oui, MedRep s'intègre avec les principaux CRM du marché via notre API et nos webhooks. Nous supportons Salesforce, HubSpot, et bien d'autres.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Comment fonctionne l'application mobile pour les délégués ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    L'application mobile est disponible sur iOS et Android. Les délégués peuvent consulter leur planning, valider leurs visites et être géolocalisés en temps réel.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Vos données sont-elles conformes au RGPD ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    Absolument. MedRep est hébergé en France et respecte toutes les exigences du RGPD. Vos données sont chiffrées avec AES-256.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Peut-on personnaliser les rapports selon nos besoins ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    Oui, tous les rapports sont 100% personnalisables avec des templates configurables et un envoi automatique par email.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Y a-t-il une période d'essai gratuite ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    Oui ! 14 jours d'essai gratuit sans carte bancaire. Toutes les fonctionnalités Professional sont accessibles.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Quel support technique proposez-vous ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    Support email pour Starter, support prioritaire 24/7 pour Professional et Enterprise avec account manager dédié.
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-medium text-gray-800 text-sm">Peut-on gérer plusieurs pays et langues dans MedRep ?</span>
                    <span class="text-blue-600 font-bold text-xl ml-4 flex-shrink-0" x-text="open ? '−' : '+'">+</span>
                </button>
                <div x-show="open" x-transition class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">
                    Oui, MedRep supporte plusieurs langues et devises avec des configurations régionales personnalisables.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="py-20 bg-blue-600">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <p class="text-blue-200 text-sm font-semibold mb-3">
            Rejoignez plus de 200 laboratoires
        </p>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Prêt à moderniser votre force de vente médicale ?
        </h2>
        <p class="text-blue-100 mb-8">
            Démarrez votre essai gratuit de 14 jours aujourd'hui.<br>
            Aucune carte bancaire requise. Configuration en moins de 48 heures.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#register"
               class="px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold
                      hover:bg-blue-50 transition">
                Créer un compte gratuit
            </a>
            <a href="#demo"
               class="px-8 py-4 border border-blue-400 text-white rounded-xl
                      font-semibold hover:bg-blue-700 transition">
                Demander une démonstration
            </a>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer id="contact" class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-10 mb-12">

            <!-- Logo & Description -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-7 h-7 bg-blue-600 rounded flex items-center
                                 justify-center text-white font-bold text-sm">+</span>
                    <span class="text-xl font-bold">MedRep</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    La plateforme intelligente de gestion des délégués médicaux.
                    Conçue pour les laboratoires pharmaceutiques exigeants.
                </p>
                <p class="text-xs text-gray-500 mb-2">Newsletter</p>
                <div class="flex gap-2">
                    <input type="email"
                           placeholder="votre@email.com"
                           class="flex-1 bg-gray-800 border border-gray-700 rounded-lg
                                  px-3 py-2 text-sm text-white placeholder-gray-500
                                  focus:outline-none focus:border-blue-500">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg
                                   text-sm hover:bg-blue-700 transition font-semibold">
                        OK
                    </button>
                </div>
            </div>

            <!-- Produit -->
            <div>
                <h4 class="font-semibold text-sm mb-4">Produit</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Fonctionnalités</a></li>
                    <li><a href="#" class="hover:text-white transition">Dashboard</a></li>
                    <li><a href="#" class="hover:text-white transition">Calendrier</a></li>
                    <li><a href="#" class="hover:text-white transition">Rapports</a></li>
                    <li><a href="#" class="hover:text-white transition">Campagnes</a></li>
                    <li><a href="#" class="hover:text-white transition">API</a></li>
                </ul>
            </div>

            <!-- Entreprise -->
            <div>
                <h4 class="font-semibold text-sm mb-4">Entreprise</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">À propos</a></li>
                    <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition">Carrières</a></li>
                    <li><a href="#" class="hover:text-white transition">Presse</a></li>
                    <li><a href="#" class="hover:text-white transition">Partenaires</a></li>
                    <li><a href="#" class="hover:text-white transition">Investisseurs</a></li>
                </ul>
            </div>

            <!-- Légal -->
            <div>
                <h4 class="font-semibold text-sm mb-4">Légal</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Confidentialité</a></li>
                    <li><a href="#" class="hover:text-white transition">Conditions d'utilisation</a></li>
                    <li><a href="#" class="hover:text-white transition">Mentions légales</a></li>
                    <li><a href="#" class="hover:text-white transition">RGPD</a></li>
                    <li><a href="#" class="hover:text-white transition">Cookies</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row
                    justify-between items-center gap-3">
            <p class="text-sm text-gray-500">
                © 2025 MedRep SAS. Tous droits réservés. Hébergé en France 🇫🇷
            </p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                <p class="text-sm text-gray-400">Tous les systèmes opérationnels</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>