<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">Campagnes</h2>
        <button wire:click="open" class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Nouvelle campagne</button>
    </div>

    @if($show)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="relative w-full max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                    <div class="p-6 bg-white border-b border-gray-100 rounded-t-2xl">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Nouvelle campagne</h3>
                                <p class="text-sm text-gray-500 mt-1">Créez une nouvelle campagne et assignez une zone et un délégué</p>
                            </div>
                            <div>
                                <button wire:click="close" class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-50 text-gray-500 hover:bg-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-white">
                        <form wire:submit.prevent="submit" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="titre" class="block text-sm font-medium text-gray-700">Nom de la campagne</label>
                                    <input wire:model.defer="titre" type="text" id="titre" placeholder="Ex: Lancement Produit X" required class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                                    @error('titre') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                                        <input wire:model.defer="date_debut" type="date" id="date_debut" class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                                        @error('date_debut') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                        <input wire:model.defer="date_fin" type="date" id="date_fin" class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                                        @error('date_fin') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="objectif" class="block text-sm font-medium text-gray-700">Objectif de visites</label>
                                    <input wire:model.defer="objectif" type="number" id="objectif" placeholder="Ex: 150" class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                                    @error('objectif') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="produits" class="block text-sm font-medium text-gray-700">Produits concernés</label>
                                    <input wire:model.defer="produits" type="text" id="produits" placeholder="Ex: Produit X, Produit Y" class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                                    @error('produits') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea wire:model.defer="description" id="description" rows="4" placeholder="Décrivez les objectifs et détails de la campagne..." class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="zone_id" class="block text-sm font-medium text-gray-700">Zone</label>
                                        <select wire:model.defer="zone_id" id="zone_id" class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                            <option value="">Sélectionnez une zone</option>
                                            @foreach($zones as $zone)
                                                <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('zone_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="delegue_id" class="block text-sm font-medium text-gray-700">Délégué</label>
                                        <select wire:model.defer="delegue_id" id="delegue_id" class="mt-1 block w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                                            <option value="">Sélectionnez un délégué</option>
                                            @foreach($delegues as $delegue)
                                                <option value="{{ $delegue->id }}" {{ old('delegue_id') == $delegue->id ? 'selected' : '' }}>{{ $delegue->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('delegue_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="digital_support" class="block text-sm font-medium text-gray-700">Support digital (PDF/MP4)</label>
                                    <input wire:model="digital_support" type="file" id="digital_support" accept="application/pdf,video/mp4" class="mt-1 block w-full text-sm text-gray-500" />
                                    <p class="text-xs text-gray-500 mt-1">Fichier max 20 Mo. PDF / MP4 seulement.</p>
                                    @error('digital_support') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    <div wire:loading wire:target="digital_support" class="text-xs text-gray-500 mt-1">Téléchargement en cours...</div>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" wire:click="close" class="inline-flex items-center justify-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Annuler</button>
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
