<x-app-layout>
    <div class="mb-6 flex justify-between items-start">
        <div>
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Visites</h2>
            <p class="text-sm text-gray-500">Connecté en tant que <span class="text-blue-600 font-medium">Délégué médical</span></p>
        </div>
        <a href="{{ route('visites.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-blue-700 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nouvelle visite
        </a>
    </div>

    <!-- Toolbar: Search and Filter -->
    <div class="flex items-center gap-4 mb-6">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <input type="text" placeholder="Rechercher une visite, un médecin..." class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        </div>
        <button class="p-2 border border-gray-200 rounded-lg text-gray-400 hover:text-gray-500 bg-white shadow-sm">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
        <a href="#" class="px-4 py-2 rounded-full text-sm font-medium bg-blue-600 text-white shadow-sm whitespace-nowrap">Toutes (5)</a>
        <a href="#" class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-gray-200 whitespace-nowrap">Planifiées (4)</a>
        <a href="#" class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-gray-200 whitespace-nowrap">Réalisées (0)</a>
        <a href="#" class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-600 hover:bg-gray-200 whitespace-nowrap">Annulées (1)</a>
    </div>

    <!-- List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 divide-y divide-gray-100">
        
        <!-- Item 1 -->
        <a href="#" class="block p-6 hover:bg-gray-50 transition">
            <div class="flex items-center gap-6">
                <!-- Date Badge -->
                <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-100 rounded-xl w-14 h-16 shrink-0">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Mai</span>
                    <span class="text-xl font-bold text-gray-900">16</span>
                </div>
                
                <!-- Info -->
                <div class="flex-1">
                    <h4 class="text-base font-bold text-gray-900 mb-1">Dr. Martin Pierre</h4>
                    <p class="text-sm text-gray-500 mb-2">Cardiologue</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Hôpital Fann - 09:00
                    </div>
                </div>

                <!-- Status & Chevron -->
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmée
                    </span>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <!-- Item 2 -->
        <a href="#" class="block p-6 hover:bg-gray-50 transition">
            <div class="flex items-center gap-6">
                <!-- Date Badge -->
                <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-100 rounded-xl w-14 h-16 shrink-0">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Mai</span>
                    <span class="text-xl font-bold text-gray-900">16</span>
                </div>
                
                <!-- Info -->
                <div class="flex-1">
                    <h4 class="text-base font-bold text-gray-900 mb-1">Dr. Awa Ndiaye</h4>
                    <p class="text-sm text-gray-500 mb-2">Pédiatre</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Clinique International - 11:30
                    </div>
                </div>

                <!-- Status & Chevron -->
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        En attente
                    </span>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <!-- Item 3 -->
        <a href="#" class="block p-6 hover:bg-gray-50 transition">
            <div class="flex items-center gap-6">
                <!-- Date Badge -->
                <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-100 rounded-xl w-14 h-16 shrink-0">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Mai</span>
                    <span class="text-xl font-bold text-gray-900">17</span>
                </div>
                
                <!-- Info -->
                <div class="flex-1">
                    <h4 class="text-base font-bold text-gray-900 mb-1">Dr. Bernard Sophie</h4>
                    <p class="text-sm text-gray-500 mb-2">Généraliste</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Cabinet Médical - 14:30
                    </div>
                </div>

                <!-- Status & Chevron -->
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Confirmée
                    </span>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <!-- Item 4 -->
        <a href="#" class="block p-6 hover:bg-gray-50 transition">
            <div class="flex items-center gap-6">
                <!-- Date Badge -->
                <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-100 rounded-xl w-14 h-16 shrink-0">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Mai</span>
                    <span class="text-xl font-bold text-gray-900">17</span>
                </div>
                
                <!-- Info -->
                <div class="flex-1">
                    <h4 class="text-base font-bold text-gray-900 mb-1">Dr. Fatou Diop</h4>
                    <p class="text-sm text-gray-500 mb-2">Pneumologue</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Polyclinique Dakar - 10:00
                    </div>
                </div>

                <!-- Status & Chevron -->
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Planifiée
                    </span>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <!-- Item 5 -->
        <a href="#" class="block p-6 hover:bg-gray-50 transition">
            <div class="flex items-center gap-6">
                <!-- Date Badge -->
                <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-100 rounded-xl w-14 h-16 shrink-0">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Mai</span>
                    <span class="text-xl font-bold text-gray-900">22</span>
                </div>
                
                <!-- Info -->
                <div class="flex-1">
                    <h4 class="text-base font-bold text-gray-900 mb-1">Dr. Moussa Fall</h4>
                    <p class="text-sm text-gray-500 mb-2">ORL</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Centre de Santé - 15:00
                    </div>
                </div>

                <!-- Status & Chevron -->
                <div class="flex items-center gap-4 shrink-0">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Annulée
                    </span>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

    </div>
</x-app-layout>
