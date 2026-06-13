<x-app-layout>
    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-5xl mx-auto space-y-6">
            
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 mb-6">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Campagnes</h1>
                        <p class="text-sm text-gray-500 mt-1">Gérez vos campagnes promotionnelles et suivez leur performance.</p>
                    </div>
                    @can('create', App\Models\Campaign::class)
                    <a href="{{ route('campaigns.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-sm">
                        + Nouvelle campagne
                    </a>
                    @endcan
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ $activesCount ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Campagnes actives</div>
                </div>
                
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ $totalObjectif ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Objectif total</div>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ $tauxReussite ?? 0 }}%</div>
                    <div class="text-sm text-gray-500">Taux de réussite</div>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ $joursRestants ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Jours restants</div>
                </div>
            </div>

            <!-- Tabs -->
            @php $currentStatut = request('statut', 'toutes'); @endphp
            <div class="flex items-center gap-2 mt-8 mb-6 overflow-x-auto pb-2">
                <a href="{{ route('campaigns.index') }}" class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap {{ $currentStatut === 'toutes' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">Toutes</a>
                <a href="{{ route('campaigns.index', ['statut' => 'en_cours']) }}" class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap {{ $currentStatut === 'en_cours' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">En cours</a>
                <a href="{{ route('campaigns.index', ['statut' => 'a_venir']) }}" class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap {{ $currentStatut === 'a_venir' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">À venir</a>
                <a href="{{ route('campaigns.index', ['statut' => 'terminees']) }}" class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap {{ $currentStatut === 'terminees' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">Terminées</a>
            </div>

            <!-- Campaign List -->
            <div class="space-y-4">
                @forelse($campaigns as $campaign)
                    @php
                        // Mocking dynamic calculations for each campaign
                        $obj = 100; // placeholder for real objective per campaign
                        $realised = 0; // placeholder
                        $progression = 0; // placeholder
                        
                        $isAVenir = $campaign->date_debut > now();
                        $isTerminee = $campaign->date_fin < now();
                        
                        $badgeClass = 'bg-gray-100 text-gray-800';
                        $badgeText = ucfirst(str_replace('_', ' ', $campaign->statut ?? 'Non défini'));
                        
                        if ($isAVenir) {
                            $badgeClass = 'bg-blue-50 text-blue-600';
                            $badgeText = 'À venir';
                        } elseif ($isTerminee) {
                            $badgeClass = 'bg-green-50 text-green-600';
                            $badgeText = 'Terminée';
                        } else {
                            $badgeClass = 'bg-yellow-50 text-yellow-600';
                            $badgeText = 'En cours';
                        }
                    @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative">
                    @can('delete', $campaign)
                    <div class="absolute top-6 right-6">
                        <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    @endcan

                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl font-bold text-gray-900">{{ $campaign->titre }}</h3>
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">{{ $badgeText }}</span>
                    </div>

                    <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $campaign->date_debut ? $campaign->date_debut->format('j M Y') : 'N/A' }} - {{ $campaign->date_fin ? $campaign->date_fin->format('j M Y') : 'N/A' }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            {{ $campaign->zone->nom ?? 'Toutes zones' }}
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="text-sm text-gray-500 mb-1">Objectif</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $obj }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="text-sm text-gray-500 mb-1">Réalisé</div>
                            <div class="text-2xl font-bold text-blue-600">{{ $realised }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <div class="text-sm text-gray-500 mb-1">Progression</div>
                            <div class="text-2xl font-bold text-emerald-500">{{ $progression }}%</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-sm text-gray-500">Avancement</span>
                            <span class="text-xs text-gray-400">{{ $realised }} / {{ $obj }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $progression }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('campaigns.show', $campaign) }}" class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm">
                            Voir détails
                        </a>
                        @can('update', $campaign)
                        <a href="{{ route('campaigns.edit', $campaign) }}" class="px-6 text-center py-2.5 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition-colors shadow-sm">
                            Modifier
                        </a>
                        @endcan
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center text-gray-500">
                    Aucune campagne trouvée.
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $campaigns->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
