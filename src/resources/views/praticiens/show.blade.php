<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du Praticien') }}: {{ $praticien->nom_complet }}
            </h2>
            <div>
                <a href="{{ route('praticiens.edit', $praticien) }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 text-sm">Modifier</a>
                <a href="{{ route('praticiens.index') }}" class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700 text-sm ml-2">Retour à la liste</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Générales</h3>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nom Complet</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $praticien->nom_complet }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Spécialité</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $praticien->specialite }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $praticien->email ?? 'N/A' }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $praticien->telephone ?? 'N/A' }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Zone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $praticien->zone->nom ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Dernières Visites</h3>
                            @if($praticien->visites->count() > 0)
                                <ul class="divide-y divide-gray-200">
                                    @foreach($praticien->visites->take(5) as $visite)
                                        <li class="py-3">
                                            <p class="text-sm font-medium text-gray-900">Le {{ $visite->date_visite->format('d/m/Y') }} - {{ $visite->statut_label }}</p>
                                            <p class="text-sm text-gray-500">Par: {{ $visite->delegue->name ?? 'Délégué Inconnu' }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">Aucune visite enregistrée pour ce praticien.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
