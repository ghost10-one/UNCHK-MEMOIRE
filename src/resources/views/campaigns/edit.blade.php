<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la campagne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                                <input type="text" name="titre" id="titre" value="{{ old('titre', $campaign->titre) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $campaign->description) }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $campaign->date_debut->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                </div>
                                <div>
                                    <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                    <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $campaign->date_fin->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="zone_id" class="block text-sm font-medium text-gray-700">Zone</label>
                                    <select name="zone_id" id="zone_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Sélectionnez une zone</option>
                                        @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}" {{ old('zone_id', $campaign->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="delegue_id" class="block text-sm font-medium text-gray-700">Délégué</label>
                                    <select name="delegue_id" id="delegue_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Sélectionnez un délégué</option>
                                        @foreach($delegues as $delegue)
                                            <option value="{{ $delegue->id }}" {{ old('delegue_id', $campaign->delegue_id) == $delegue->id ? 'selected' : '' }}>{{ $delegue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select name="statut" id="statut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="planifiee" {{ old('statut', $campaign->statut) == 'planifiee' ? 'selected' : '' }}>Planifiée</option>
                                    <option value="en_cours" {{ old('statut', $campaign->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="terminee" {{ old('statut', $campaign->statut) == 'terminee' ? 'selected' : '' }}>Terminée</option>
                                    <option value="annulee" {{ old('statut', $campaign->statut) == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>

                            <div>
                                <label for="digital_support" class="block text-sm font-medium text-gray-700">Support digital (PDF/MP4)</label>
                                <input type="file" name="digital_support" id="digital_support" accept="application/pdf,video/mp4" class="mt-1 block w-full text-sm text-gray-500" />
                                <p class="text-xs text-gray-500 mt-1">Laisser vide pour conserver le support existant.</p>
                                @if($campaign->digital_support_path)
                                    <p class="mt-2 text-sm text-gray-600">Support actuel : <a href="{{ Storage::url($campaign->digital_support_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Voir le fichier</a></p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('campaigns.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Annuler</a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
