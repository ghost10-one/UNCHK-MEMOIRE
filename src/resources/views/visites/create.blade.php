<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Saisir un rapport de visite') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('visites.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Praticien Select (Eager Loaded) -->
                            <div class="md:col-span-2">
                                <label for="praticien_id" class="block text-sm font-medium text-gray-700">Praticien *</label>
                                <select name="praticien_id" id="praticien_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Sélectionnez un praticien</option>
                                    @foreach($praticiens as $praticien)
                                        <option value="{{ $praticien->id }}" {{ old('praticien_id') == $praticien->id ? 'selected' : '' }}>
                                            {{ $praticien->nom_complet }} - {{ $praticien->specialite }} ({{ $praticien->zone->nom ?? 'Zone N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="date_visite" class="block text-sm font-medium text-gray-700">Date de la visite *</label>
                                <input type="date" name="date_visite" id="date_visite" value="{{ old('date_visite', date('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700">Statut *</label>
                                <select name="statut" id="statut" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="realisee" {{ old('statut') == 'realisee' ? 'selected' : '' }}>Réalisée</option>
                                    <option value="planifiee" {{ old('statut') == 'planifiee' ? 'selected' : '' }}>Planifiée</option>
                                    <option value="confirmee" {{ old('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="annulee" {{ old('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                    <option value="manquee" {{ old('statut') == 'manquee' ? 'selected' : '' }}>Manquée</option>
                                </select>
                            </div>

                            <div>
                                <label for="duree_min" class="block text-sm font-medium text-gray-700">Durée (minutes)</label>
                                <input type="number" name="duree_min" id="duree_min" value="{{ old('duree_min') }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes / Compte rendu</label>
                                <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('notes') }}</textarea>
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('visites.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 mr-3">Annuler</a>
                            <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
