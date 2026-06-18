<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Tableau de bord de Productivité</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Cartes d'indicateurs clés (KPI) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Carte 1 : Visites du mois -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <!-- SVG pur style app.blade.php -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Visites ce mois-ci</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $visitesCeMois }}</p>
                </div>
            </div>

            <!-- Carte 2 : Taux de complétion -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <!-- SVG pur style app.blade.php -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500">Taux de complétion</p>
                    <div class="flex items-center gap-2">
                        <p class="text-2xl font-bold text-gray-900">{{ $tauxCompletion }}%</p>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 max-w-[100px]">
                            <div class="bg-emerald-600 h-2.5 rounded-full" style="width: {{ $tauxCompletion }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte 3 : Top Praticien -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <!-- SVG pur style app.blade.php -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Praticien le plus visité</p>
                    <p class="text-lg font-bold text-gray-900">{{ $topPraticien->praticien->nom ?? 'Aucun' }}</p>
                    <p class="text-xs text-gray-400">{{ $topPraticien->total ?? 0 }} visite(s) au total</p>
                </div>
            </div>

        </div>

        <!-- Section Évolution & Analyse -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Évolution de l'activité (par mois)</h3>
            
            @if($evolutionVisites->isEmpty())
                <p class="text-sm text-gray-500 py-4 text-center">Aucune donnée disponible pour le moment.</p>
            @else
                <div class="space-y-4">
                    @foreach($evolutionVisites as $data)
                        <div>
                            <div class="flex justify-between text-sm font-medium text-gray-700 mb-1 items-center gap-1">
                                <span class="flex items-center gap-2">
                                    <!-- SVG Calendrier miniature -->
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Mois : {{ $data->mois }}
                                </span>
                                <span>{{ $data->total }} visite(s)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-4">
                                @php
                                    $pourcentage = $totalVisites > 0 ? ($data->total / $totalVisites) * 100 : 0;
                                @endphp
                                <div class="bg-blue-600 h-4 rounded-full transition-all duration-500" style="width: {{ $pourcentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-app-layout>