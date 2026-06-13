<x-app-layout>
    @php
        $visitesDuJour = \App\Models\Visite::duJour()->count();
        $visitesSemaine = \App\Models\Visite::deLaSemaine()->count();
        $rapportsEnAttente = \App\Models\Visite::rapportsEnAttente()->count();
        
        $totalVisitesObj = 20; // Objectif statique pour le moment
        $realiseCount = \App\Models\Visite::realisees()->whereMonth('date_visite', now()->month)->count();
        $tauxRealisation = $totalVisitesObj > 0 ? round(($realiseCount / $totalVisitesObj) * 100) : 0;
        
        $prochainesVisites = \App\Models\Visite::with(['praticien'])
            ->aVenir()
            ->take(3)
            ->get();
    @endphp
    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Header section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Tableau de bord</h1>
                </div>
                <div class="flex items-center gap-4 hidden md:flex">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="w-64 rounded-lg border-gray-200 bg-white text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 pl-4 pr-10">
                    </div>
                    <button class="relative p-2 text-gray-500 hover:text-gray-700 bg-white rounded-full border border-gray-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm">
                        AD
                    </div>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Visites du jour -->
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-32">
                    <h3 class="text-sm font-medium text-gray-500">Visites du jour</h3>
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $visitesDuJour }}</div>
                        <div class="flex items-center text-xs font-medium text-emerald-600">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            +20% vs hier
                        </div>
                    </div>
                </div>

                <!-- Visites semaine -->
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-32">
                    <h3 class="text-sm font-medium text-gray-500">Visites cette semaine</h3>
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $visitesSemaine }}</div>
                        <div class="flex items-center text-xs font-medium text-emerald-600">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            +25% vs sem. dernière
                        </div>
                    </div>
                </div>

                <!-- Rapports en attente -->
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-32">
                    <h3 class="text-sm font-medium text-gray-500">Rapports en attente</h3>
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $rapportsEnAttente }}</div>
                        <div class="text-xs text-gray-500 font-medium">À compléter</div>
                    </div>
                </div>

                <!-- Taux de réalisation -->
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-32">
                    <h3 class="text-sm font-medium text-gray-500">Taux de réalisation</h3>
                    <div class="flex items-end justify-between">
                        <div class="text-3xl font-bold text-gray-900">{{ $tauxRealisation }}%</div>
                        <div class="flex items-end gap-1 mb-1">
                            <!-- Mini bar chart simulation -->
                            <div class="w-2 bg-blue-500 rounded-t-sm h-3"></div>
                            <div class="w-2 bg-blue-500 rounded-t-sm h-4"></div>
                            <div class="w-2 bg-blue-500 rounded-t-sm h-6"></div>
                            <div class="w-2 bg-blue-500 rounded-t-sm h-5"></div>
                            <div class="w-2 bg-blue-500 rounded-t-sm h-7"></div>
                            <div class="w-2 bg-blue-500 rounded-t-sm h-8"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column (Prochaines visites) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full">
                        <div class="p-6 flex items-center justify-between border-b border-gray-50">
                            <h3 class="text-lg font-bold text-gray-900 leading-tight">Prochaines visites<br>aujourd'hui</h3>
                            <a href="{{ route('visites.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 text-right">Voir toutes les<br>visites</a>
                        </div>
                        
                        <div class="divide-y divide-gray-50">
                            @forelse($prochainesVisites as $visite)
                            <!-- Visite -->
                            <div class="p-6 flex items-start gap-4">
                                <div class="flex items-center text-gray-500 text-sm font-medium mt-0.5">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $visite->heure_debut ? $visite->heure_debut->format('H:i') : 'N/A' }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-gray-900">{{ $visite->praticien->nom ?? 'Inconnu' }} {{ $visite->praticien->prenom ?? '' }}</h4>
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $visite->statut_couleur }}">{{ $visite->statut_label }}</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-1">{{ $visite->praticien->specialite->nom ?? 'Spécialité' }}</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $visite->adresse_visite ?? 'Non précisée' }}
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-6 text-sm text-gray-500 text-center">Aucune visite à venir aujourd'hui.</div>
                            @endforelse
                        </div>
                            <div class="p-6 flex items-start gap-4">
                                <div class="flex items-center text-gray-500 text-sm font-medium mt-0.5">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    09:00
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-gray-900">Dr. Martin Pierre</h4>
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Confirmée</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-1">Cardiologue</p>
                                    <div class="flex items-center text-sm text-gray-500">
                    </div>
                </div>

                <!-- Right Column (Performance) -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <!-- Performance Chart -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 self-start">Performance ({{ now()->translatedFormat('F Y') }})</h3>
                        
                        <div class="flex flex-col items-center justify-center py-6">
                            <div class="relative w-48 h-48">
                                <svg viewBox="0 0 36 36" class="w-full h-full">
                                    <path class="text-gray-100" stroke-width="4" stroke="currentColor" fill="none"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-blue-500" stroke-dasharray="{{ $tauxRealisation }}, 100" stroke-width="4" stroke-linecap="round" stroke="currentColor" fill="none"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-4xl font-bold text-gray-900">{{ $tauxRealisation }}%</span>
                                    <span class="text-xs text-gray-500 mt-1">Objectif atteint</span>
                                </div>
                            </div>
                            <div class="mt-4 text-sm text-gray-500 font-medium">{{ $realiseCount }} / {{ $totalVisitesObj }} visites</div>
                        </div>
                    </div>

                    <!-- Progress Bars -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex-1">
                        <div class="text-xs text-gray-400 mb-4">100%</div>
                        <div class="space-y-5">
                            <div class="flex items-center">
                                <span class="w-16 text-sm text-gray-600">Sem 1</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 mx-4">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="w-10 text-right text-sm font-medium text-gray-900">65%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-sm text-gray-600">Sem 2</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 mx-4">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="w-10 text-right text-sm font-medium text-gray-900">75%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-sm text-gray-600">Sem 3</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 mx-4">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 70%"></div>
                                </div>
                                <span class="w-10 text-right text-sm font-medium text-gray-900">70%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-sm text-gray-600">Sem 4</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 mx-4">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 85%"></div>
                                </div>
                                <span class="w-10 text-right text-sm font-medium text-gray-900">85%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-sm text-gray-600">Sem 5</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 mx-4">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="w-10 text-right text-sm font-medium text-gray-900">75%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
