<x-app-layout>
    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-3xl mx-auto space-y-6">
            
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('campaigns.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 mb-6">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour aux campagnes
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Nouvelle campagne</h1>
                    <p class="text-sm text-gray-500 mt-1">Créez une nouvelle campagne et définissez ses paramètres.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm mb-6 border border-red-100">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre de la campagne</label>
                            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                            <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        </div>

                        <div>
                            <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                            <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        </div>

                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                            <select name="statut" id="statut" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                                <option value="planifiee" {{ old('statut') == 'planifiee' ? 'selected' : '' }}>Planifiée</option>
                                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="terminee" {{ old('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                                <option value="annulee" {{ old('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>

                        <div>
                            <label for="zone_id" class="block text-sm font-medium text-gray-700 mb-1">Zone</label>
                            <select name="zone_id" id="zone_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                                <option value="" disabled selected>Sélectionnez une zone</option>
                                @foreach($zones ?? \App\Models\Zone::all() as $zone)
                                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="delegue_id" class="block text-sm font-medium text-gray-700 mb-1">Délégué responsable</label>
                            <select name="delegue_id" id="delegue_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                                <option value="" disabled selected>Sélectionnez un délégué</option>
                                @foreach($delegues ?? \App\Models\User::role('delegate')->get() as $delegue)
                                    <option value="{{ $delegue->id }}" {{ old('delegue_id') == $delegue->id ? 'selected' : '' }}>{{ $delegue->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="digital_support" class="block text-sm font-medium text-gray-700 mb-1">Support digital (Optionnel)</label>
                            <input type="file" name="digital_support" id="digital_support"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('campaigns.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 transition-colors shadow-sm">
                            Annuler
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm">
                            Créer la campagne
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
