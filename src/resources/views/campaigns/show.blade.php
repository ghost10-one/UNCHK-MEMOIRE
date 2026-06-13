<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la campagne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $campaign->titre }}</h3>
                            <p class="mt-2 text-sm text-gray-600">{{ $campaign->description }}</p>
                        </div>
                        <div class="text-right text-sm text-gray-500">
                            <div>{{ $campaign->date_debut->format('d/m/Y') }} → {{ $campaign->date_fin->format('d/m/Y') }}</div>
                            <div class="mt-1 capitalize">Statut : {{ str_replace('_', ' ', $campaign->statut) }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Zone</h4>
                                <p class="text-sm text-gray-900">{{ $campaign->zone->nom ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Délégué</h4>
                                <p class="text-sm text-gray-900">{{ $campaign->delegue->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Support digital</h4>
                                @if($campaign->digital_support_path)
                                    <a href="{{ Storage::url($campaign->digital_support_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Ouvrir le support</a>
                                @else
                                    <p class="text-sm text-gray-500">Aucun support associé.</p>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Créée le</h4>
                                <p class="text-sm text-gray-900">{{ $campaign->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($campaign->digital_support_path)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            @if(\Illuminate\Support\Str::endsWith($campaign->digital_support_path, '.pdf'))
                                <embed src="{{ Storage::url($campaign->digital_support_path) }}" type="application/pdf" width="100%" height="600px" />
                            @elseif(\Illuminate\Support\Str::endsWith($campaign->digital_support_path, '.mp4'))
                                <video controls class="w-full rounded-lg bg-black">
                                    <source src="{{ Storage::url($campaign->digital_support_path) }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture vidéo.
                                </video>
                            @else
                                <p class="text-sm text-gray-600">Type de fichier non prévisualisable.</p>
                            @endif
                        </div>
                    @endif

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('campaigns.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Retour</a>
                        @can('update', $campaign)
                            <a href="{{ route('campaigns.edit', $campaign) }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Modifier</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
