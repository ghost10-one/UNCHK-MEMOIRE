<x-app-layout>
    <div class="mb-6 flex justify-between items-start">
        <div>
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Visites</h2>
            <p class="text-sm text-gray-500">Connecté en tant que <span class="text-blue-600 font-medium">{{ Auth::user()->role ?? 'Délégué médical' }}</span></p>
        </div>
        <a href="{{ route('visites.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-blue-700 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvelle visite
        </a>
    </div>

    <!-- Toolbar: Search and Filter -->
    <form method="GET" action="{{ route('visites.index') }}" class="flex flex-wrap gap-4 mb-6 items-end">
        @if(request('statut'))
            <input type="hidden" name="statut" value="{{ request('statut') }}">
        @endif
        <div class="relative flex-1 min-w-[220px]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une visite, un médecin..." class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        </div>
        <div class="min-w-[180px]">
            <label for="date" class="sr-only">Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}" class="block w-full pl-3 pr-3 py-2 border border-gray-200 rounded-lg bg-white text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-blue-500">
        </div>
        <button type="submit" class="inline-flex items-center justify-center p-2 border border-gray-200 rounded-lg text-gray-400 hover:text-gray-500 bg-white shadow-sm">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
        </button>
    </form>

    <!-- Tabs -->
    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
        <a href="{{ route('visites.index', ['search' => request('search'), 'date' => request('date')]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('statut') ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} whitespace-nowrap">Toutes ({{ $stats['toutes'] }})</a>
        
        <a href="{{ route('visites.index', ['statut' => 'planifiee', 'search' => request('search'), 'date' => request('date')]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('statut') === 'planifiee' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} whitespace-nowrap">Planifiées ({{ $stats['planifiee'] }})</a>
        
        <a href="{{ route('visites.index', ['statut' => 'realisee', 'search' => request('search'), 'date' => request('date')]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('statut') === 'realisee' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} whitespace-nowrap">Réalisées ({{ $stats['realisee'] }})</a>
        
        <a href="{{ route('visites.index', ['statut' => 'annulee', 'search' => request('search'), 'date' => request('date')]) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('statut') === 'annulee' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} whitespace-nowrap">Annulées ({{ $stats['annulee'] }})</a>
    </div>

    <!-- List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 divide-y divide-gray-100">
        
        @forelse($visites as $visite)
            <a href="{{ route('visites.show', $visite) }}" class="block p-6 hover:bg-gray-50 transition">
                <div class="flex items-center gap-6">
                    <!-- Date Badge -->
                    <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-100 rounded-xl w-14 h-16 shrink-0">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $visite->date_visite->translatedFormat('M') }}</span>
                        <span class="text-xl font-bold text-gray-900">{{ $visite->date_visite->format('d') }}</span>
                    </div>
                    
                    <!-- Info -->
                    <div class="flex-1">
                        <h4 class="text-base font-bold text-gray-900 mb-1">
                            @if($visite->praticien)
                                {{ $visite->praticien->titre }} {{ $visite->praticien->prenom }} {{ $visite->praticien->nom }}
                            @else
                                Praticien Inconnu
                            @endif
                        </h4>
                        <p class="text-sm text-gray-500 mb-2">{{ $visite->praticien->specialite ?? 'N/A' }}</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $visite->praticien->etablissement ?? 'N/A' }} 
                            @if($visite->heure_debut)
                                - {{ $visite->heure_debut->format('H:i') }}
                            @endif
                        </div>
                    </div>

                    <!-- Status & Chevron -->
                    <div class="flex items-center gap-4 shrink-0">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $visite->statut_couleur }}">
                            {{ $visite->statut_label }}
                        </span>
                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
            </a>
        @empty
            <div class="p-6 text-center text-gray-500">
                Aucune visite trouvée.
            </div>
        @endforelse

    </div>
    
    <div class="mt-4">
        {{ $visites->links() }}
    </div>
</x-app-layout>
