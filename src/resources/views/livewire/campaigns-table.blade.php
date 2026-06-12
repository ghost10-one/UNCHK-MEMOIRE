<div>
    <div class="mb-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex-1 bg-white rounded-lg shadow-sm p-4">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4" onsubmit="return false;">
                <div>
                    <label for="zone_id" class="block text-sm font-medium text-gray-700">Zone</label>
                    <select id="zone_id" wire:model="zone_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                        <option value="">Toutes</option>
                        @foreach($this->zones ?? \App\Models\Zone::all() as $zone)
                            <option value="{{ $zone->id }}">{{ $zone->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="delegue_id" class="block text-sm font-medium text-gray-700">Délégué</label>
                    <select id="delegue_id" wire:model="delegue_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                        <option value="">Tous</option>
                        @foreach($this->delegues ?? \App\Models\User::all() as $delegue)
                            <option value="{{ $delegue->id }}">{{ $delegue->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Début</label>
                    <input type="date" wire:model.lazy="date_debut" id="date_debut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                </div>
                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-700">Fin</label>
                    <input type="date" wire:model.lazy="date_fin" id="date_fin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                </div>
            </form>
        </div>

        @can('create', App\Models\Campaign::class)
            <div class="ml-0 lg:ml-4">
                <livewire:campaign-create-modal />
            </div>
        @endcan
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Délégué</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Période</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($campaigns as $campaign)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $campaign->titre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $campaign->zone->nom ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $campaign->delegue->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $campaign->date_debut?->format('d/m/Y') }} → {{ $campaign->date_fin?->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">{{ str_replace('_', ' ', $campaign->statut) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('campaigns.show', $campaign) }}" class="text-indigo-600 hover:text-indigo-900">Voir</a>
                                    @can('update', $campaign)
                                        <a href="{{ route('campaigns.edit', $campaign) }}" class="text-blue-600 hover:text-blue-900">Modifier</a>
                                    @endcan
                                    @can('delete', $campaign)
                                        <button wire:click="delete({{ $campaign->id }})" onclick="return confirm('Supprimer cette campagne ?')" class="text-red-600 hover:text-red-900">Supprimer</button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Aucune campagne trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $campaigns->links() }}
            </div>
        </div>
    </div>
</div>
