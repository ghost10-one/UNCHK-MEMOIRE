<x-app-layout>
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Nouvelle visite</h2>
            <a href="{{ route('visites.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            @php
                $selectedPraticien = $selectedPraticien ?? null;
            @endphp
            <form action="{{ route('visites.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Médecin / Professionnel -->
                <div>
                    <label for="praticien_id" class="block text-sm font-medium text-gray-700 mb-1">Médecin / Professionnel</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <select name="praticien_id" id="praticien_id" required class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-blue-500 sm:text-sm text-gray-900 appearance-none bg-white">
                            <option value="" disabled {{ old('praticien_id') ? '' : 'selected' }}>Sélectionnez un professionnel</option>
                            @forelse($praticiens as $praticien)
                                <option value="{{ $praticien->id }}" {{ old('praticien_id') == $praticien->id ? 'selected' : '' }}>{{ $praticien->nom_complet }}</option>
                            @empty
                                <option value="" disabled>Aucun praticien actif trouvé</option>
                            @endforelse
                        </select>
                    </div>
                    @error('praticien_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Spécialité -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        </div>
                        <input type="text" readonly value="{{ old('praticien_id') ? $selectedPraticien?->specialite : '' }}" placeholder="Sélectionnez un professionnel" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500 sm:text-sm" />
                    </div>
                </div>

                <!-- Date & Time -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="date_visite" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            <input type="date" name="date_visite" id="date_visite" value="{{ old('date_visite') }}" required class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />
                        </div>
                        @error('date_visite')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="heure_debut" class="block text-sm font-medium text-gray-700 mb-1">Heure</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <input type="time" name="heure_debut" id="heure_debut" value="{{ old('heure_debut') }}" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />
                        </div>
                        @error('heure_debut')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Lieu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text" readonly value="{{ $selectedPraticien?->etablissement ?? '' }}" placeholder="Lieu chargé depuis le praticien" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500 sm:text-sm" />
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (optionnel)</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <textarea id="notes" name="notes" rows="4" placeholder="Objectifs de la visite, produits à présenter..." class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('notes') }}</textarea>
                    </div>
                </div>
                
                <!-- Hidden inputs required by previous logic -->
                <input type="hidden" name="statut" value="planifiee">

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-4">
                    <a href="{{ route('visites.index') }}" class="w-1/2 flex justify-center py-3 px-4 border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Annuler
                    </a>
                    <button type="submit" class="w-1/2 flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Créer la visite
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
