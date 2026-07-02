<x-app-layout>
    @php
        $visitesDuJour = \App\Models\Visite::duJour()->count();
        $visitesSemaine = \App\Models\Visite::deLaSemaine()->count();
        $rapportsEnAttente = \App\Models\Visite::rapportsEnAttente()->count();
        
        $totalVisitesObj = 20;
        $realiseCount = \App\Models\Visite::realisees()->whereMonth('date_visite', now()->month)->count();
        $tauxRealisation = $totalVisitesObj > 0 ? round(($realiseCount / $totalVisitesObj) * 100) : 0;
        
        $prochainesVisites = \App\Models\Visite::with(['praticien'])
            ->aVenir()
            ->take(4)
            ->get();
    @endphp
    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Header section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Tableau de bord</h1>
                    <p class="text-slate-500 text-sm mt-1">Vue d'ensemble de vos activités et performances</p>
                </div>
            </div>

            <!-- KPI Cards matching Maquette Page 5 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Visites du jour -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Visites du jour</span>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $visitesDuJour }}</div>
                        <div class="flex items-center text-xs font-semibold text-emerald-600">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            Planifiées aujourd'hui
                        </div>
                    </div>
                </div>

                <!-- Visites totales / semaine -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Visites totales</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $visitesSemaine }}</div>
                        <div class="flex items-center text-xs font-semibold text-emerald-600">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            +18% vs sem. dernière
                        </div>
                    </div>
                </div>

                <!-- Rapports en attente -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Rapports en attente</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $rapportsEnAttente }}</div>
                        <div class="text-xs text-amber-700 font-semibold">À valider ou remplir</div>
                    </div>
                </div>

                <!-- Performance globale -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Performance globale</span>
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $tauxRealisation }}%</div>
                        <div class="text-xs text-slate-500 font-semibold">Objectifs atteints</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column (Prochaines visites) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 flex flex-col h-full">
                        <div class="p-6 flex items-center justify-between border-b border-slate-100">
                            <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Visites à venir</h3>
                            <a href="{{ route('visites.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700">Voir tout →</a>
                        </div>
                        
                        <div class="divide-y divide-slate-50 flex-1">
                            @forelse($prochainesVisites as $visite)
                            <div class="p-5 flex items-start gap-3 hover:bg-slate-50/50 transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                    {{ $visite->heure_debut ? $visite->heure_debut->format('H:i') : '09:00' }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-slate-900 text-sm truncate">{{ $visite->praticien->nom ?? 'Dr. Martin Pierre' }} {{ $visite->praticien->prenom ?? '' }}</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 mb-1.5 truncate">{{ $visite->praticien->specialite->nom ?? 'Médecin Généraliste' }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        {{ $visite->statut_label ?? 'Confirmée' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="p-5 flex items-start gap-3 hover:bg-slate-50/50 transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                    09:00
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-slate-900 text-sm truncate">Dr. Martin Pierre</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 mb-1.5 truncate">Cardiologue - Hôpital Fann</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        Confirmée
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex items-start gap-3 hover:bg-slate-50/50 transition-colors">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                    11:30
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-slate-900 text-sm truncate">Dr. Awa Ndiaye</h4>
                                    </div>
                                    <p class="text-xs text-slate-500 mb-1.5 truncate">Pédiatre - Clinique International</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                        En attente
                                    </span>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column (Performance & Progress) -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    <!-- Performance Chart -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col items-center">
                        <h3 class="text-lg font-extrabold text-slate-900 mb-4 self-start tracking-tight">Performance globale ({{ now()->translatedFormat('F Y') }})</h3>
                        
                        <div class="flex flex-col items-center justify-center py-4 w-full">
                            <div class="relative w-48 h-48">
                                <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-blue-600 transition-all duration-1000 ease-out" stroke-dasharray="{{ $tauxRealisation }}, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-4xl font-black text-slate-900 tracking-tight">{{ $tauxRealisation }}%</span>
                                    <span class="text-xs font-semibold text-slate-500 mt-1">Objectifs atteints</span>
                                </div>
                            </div>
                            <div class="mt-4 text-sm font-bold text-slate-700 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">{{ $realiseCount }} / {{ $totalVisitesObj }} visites complétées</div>
                        </div>
                    </div>

                    <!-- Progress Bars -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex-1">
                        <h4 class="text-sm font-bold text-slate-900 mb-5">Suivi par semaine</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="w-16 text-xs font-bold text-slate-500">Semaine 1</span>
                                <div class="flex-1 bg-slate-100 rounded-full h-3 mx-4 overflow-hidden">
                                    <div class="bg-blue-600 h-3 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="w-10 text-right text-xs font-extrabold text-slate-900">65%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-xs font-bold text-slate-500">Semaine 2</span>
                                <div class="flex-1 bg-slate-100 rounded-full h-3 mx-4 overflow-hidden">
                                    <div class="bg-blue-600 h-3 rounded-full" style="width: 80%"></div>
                                </div>
                                <span class="w-10 text-right text-xs font-extrabold text-slate-900">80%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-xs font-bold text-slate-500">Semaine 3</span>
                                <div class="flex-1 bg-slate-100 rounded-full h-3 mx-4 overflow-hidden">
                                    <div class="bg-blue-600 h-3 rounded-full" style="width: 75%"></div>
                                </div>
                                <span class="w-10 text-right text-xs font-extrabold text-slate-900">75%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-16 text-xs font-bold text-slate-500">Semaine 4</span>
                                <div class="flex-1 bg-slate-100 rounded-full h-3 mx-4 overflow-hidden">
                                    <div class="bg-blue-600 h-3 rounded-full" style="width: 92%"></div>
                                </div>
                                <span class="w-10 text-right text-xs font-extrabold text-slate-900">92%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
