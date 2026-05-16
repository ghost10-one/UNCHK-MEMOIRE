<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Liste des visites') }}
            </h2>
            <a href="{{ route('visits.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                + Planifier une visite
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <!-- Filters/Tabs simulated from the image -->
                <div class="p-4 border-b border-slate-50 flex gap-4 overflow-x-auto">
                    <button class="px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-full">Toutes</button>
                    <button class="px-4 py-2 bg-white text-slate-500 text-xs font-bold rounded-full border border-slate-100 hover:bg-slate-50">Planifiées</button>
                    <button class="px-4 py-2 bg-white text-slate-500 text-xs font-bold rounded-full border border-slate-100 hover:bg-slate-50">Réalisées</button>
                    <button class="px-4 py-2 bg-white text-slate-500 text-xs font-bold rounded-full border border-slate-100 hover:bg-slate-50">Annulées</button>
                </div>

                <div class="divide-y divide-slate-50">
                    @forelse($visits as $visit)
                        <div class="p-6 flex items-center gap-6 hover:bg-slate-50 transition">
                            <div class="text-center w-16">
                                <p class="text-xs font-extrabold text-blue-600 uppercase">{{ \Carbon\Carbon::parse($visit->visit_date)->translatedFormat('d') }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">{{ \Carbon\Carbon::parse($visit->visit_date)->translatedFormat('M') }}</p>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-slate-900">{{ $visit->doctor->full_name }}</p>
                                <p class="text-xs text-slate-500">{{ $visit->doctor->establishment->name }} • {{ $visit->visit_time }}</p>
                            </div>
                            <div>
                                @php
                                    $statusClasses = [
                                        'confirmée' => 'bg-green-50 text-green-600',
                                        'planifiée' => 'bg-blue-50 text-blue-600',
                                        'annulée' => 'bg-red-50 text-red-600',
                                        'réalisée' => 'bg-purple-50 text-purple-600',
                                        'en attente' => 'bg-orange-50 text-orange-600',
                                    ];
                                    $class = $statusClasses[strtolower($visit->status)] ?? 'bg-slate-50 text-slate-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $class }}">
                                    {{ $visit->status }}
                                </span>
                            </div>
                            <div class="flex gap-2">
                                <a href="#" class="p-2 text-slate-400 hover:text-blue-600"><i data-lucide="edit-2" class="w-4 h-4"></i></a>
                                <a href="#" class="p-2 text-slate-400 hover:text-red-500"><i data-lucide="trash" class="w-4 h-4"></i></a>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-slate-400">
                            <p>Aucune visite trouvée.</p>
                        </div>
                    @endforelse
                </div>

                <div class="p-6 bg-slate-50 border-t border-slate-100">
                    {{ $visits->links() }}
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</x-app-layout>
