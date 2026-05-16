<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tableau de bord') }}
            </h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">{{ now()->translatedFormat('d F Y') }}</span>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                    + Nouvelle visite
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Visites du jour -->
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
                    <p class="text-sm font-medium text-slate-500 mb-2">Visites du jour</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['visits_today'] }}</h3>
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">+20% vs hier</span>
                    </div>
                </div>
                <!-- Visites cette semaine -->
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
                    <p class="text-sm font-medium text-slate-500 mb-2">Visites cette semaine</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['visits_week'] }}</h3>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">+12% vs sem. dernière</span>
                    </div>
                </div>
                <!-- Rapports en attente -->
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
                    <p class="text-sm font-medium text-slate-500 mb-2">Rapports en attente</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['pending_reports'] }}</h3>
                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded-full">À compléter</span>
                    </div>
                </div>
                <!-- Taux de réalisation -->
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
                    <p class="text-sm font-medium text-slate-500 mb-2">Taux de réalisation</p>
                    <div class="flex items-end justify-between">
                        <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['completion_rate'] }}%</h3>
                        <div class="w-16 h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full" style="width: {{ $stats['completion_rate'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Prochaines visites -->
                <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="font-bold text-lg text-slate-900">Prochaines visites aujourd'hui</h3>
                        <a href="#" class="text-sm font-bold text-blue-600 hover:underline">Voir tout</a>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse($upcomingVisits as $visit)
                            <div class="p-6 flex items-center gap-6 hover:bg-slate-50 transition">
                                <div class="text-sm font-bold text-slate-400 w-16">{{ $visit->visit_time }}</div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-900">{{ $visit->doctor->full_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $visit->doctor->specialty }} - {{ $visit->doctor->establishment->name }}</p>
                                </div>
                                <div>
                                    @php
                                        $statusClasses = [
                                            'confirmée' => 'bg-green-50 text-green-600',
                                            'planifiée' => 'bg-blue-50 text-blue-600',
                                            'annulée' => 'bg-red-50 text-red-600',
                                            'en attente' => 'bg-orange-50 text-orange-600',
                                        ];
                                        $class = $statusClasses[strtolower($visit->status)] ?? 'bg-slate-50 text-slate-600';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $class }}">
                                        {{ $visit->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-slate-400">
                                <p>Aucune visite prévue pour aujourd'hui.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Performance Chart Placeholder -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 space-y-6">
                    <h3 class="font-bold text-lg text-slate-900">Performance (Mai 2024)</h3>
                    
                    <div class="flex justify-center relative">
                        <!-- Circular progress simulation -->
                        <div class="w-32 h-32 rounded-full border-8 border-slate-100 flex items-center justify-center relative">
                            <div class="absolute inset-0 rounded-full border-8 border-blue-600 border-t-transparent -rotate-45"></div>
                            <div class="text-center">
                                <p class="text-2xl font-extrabold text-slate-900">{{ $stats['completion_rate'] }}%</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-slate-400">Objectif atteint</span>
                            <span class="text-slate-900">{{ $stats['completion_rate'] }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full" style="width: {{ $stats['completion_rate'] }}%"></div>
                        </div>
                    </div>

                    <!-- Small line chart simulation -->
                    <div class="pt-4 h-32 flex items-end justify-between gap-1">
                        @foreach([30, 45, 35, 60, 55, 80, 75] as $val)
                            <div class="bg-blue-100 w-full rounded-t-sm hover:bg-blue-500 transition-all cursor-pointer" style="height: {{ $val }}%"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
