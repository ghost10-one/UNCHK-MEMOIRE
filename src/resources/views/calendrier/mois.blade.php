{{--
    ╔══════════════════════════════════════════════════════════════╗
    ║  SPRINT 2 · AB — Abibou Ndione · Carte Trello #4            ║
    ║  Vue calendrier/mois.blade.php                              ║
    ║                                                              ║
    ║  Checklist :                                                 ║
    ║    ✓ test affichage vide (aucune visite → message)          ║
    ║    ✓ test avec données (badges statut)                      ║
    ║    ✓ responsive                                             ║
    ╚══════════════════════════════════════════════════════════════╝
--}}
@extends('layouts.app')

@section('title', 'Calendrier — ' . $date->translatedFormat('F Y'))
@section('page-title', 'Calendrier')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Accueil</a> / Calendrier
@endsection

@section('header-actions')
    <a href="{{ route('visites.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle visite
    </a>
@endsection

@section('content')
<div class="flex gap-6">

    {{-- ── Colonne principale : Calendrier ─────────────────── --}}
    <div class="flex-1 min-w-0">

        {{-- Navigation mois --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-5">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">

                {{-- Navigation : Mois / Semaine / Jour --}}
                <div class="flex gap-1 p-1 bg-gray-100 rounded-xl">
                    @foreach ([
                        ['mois',    'Mois'],
                        ['semaine', 'Semaine'],
                        ['jour',    'Jour'],
                    ] as [$vue, $label])
                        <a href="{{ route('calendrier.index', ['vue' => $vue, 'date' => $date->format('Y-m-d')]) }}"
                           class="px-3 py-1.5 text-sm font-medium rounded-lg transition-all
                                  {{ request('vue', 'mois') === $vue
                                     ? 'bg-white text-blue-600 shadow-sm'
                                     : 'text-gray-500 hover:text-gray-700' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                {{-- Titre mois + flèches --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('calendrier.index', ['vue' => 'mois', 'date' => $moisPrecedent->format('Y-m-d')]) }}"
                       class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    <h2 class="text-lg font-bold text-gray-900 min-w-[160px] text-center">
                        {{ $date->translatedFormat('F Y') }}
                    </h2>

                    <a href="{{ route('calendrier.index', ['vue' => 'mois', 'date' => $moisSuivant->format('Y-m-d')]) }}"
                       class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                {{-- Aujourd'hui --}}
                <a href="{{ route('calendrier.index', ['vue' => 'mois', 'date' => now()->format('Y-m-d')]) }}"
                   class="px-3 py-1.5 text-sm font-medium border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    Aujourd'hui
                </a>
            </div>

            {{-- En-têtes jours --}}
            <div class="grid grid-cols-7 border-b border-gray-100">
                @foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $idx => $jour)
                    <div class="py-2 text-center text-xs font-semibold uppercase tracking-wider
                                {{ $idx >= 5 ? 'text-gray-300' : 'text-gray-400' }}">
                        {{ $jour }}
                    </div>
                @endforeach
            </div>

            {{-- Grille calendrier ─────────────────────────────── --}}
            <div class="grid grid-cols-7 divide-x divide-y divide-gray-100">
                @foreach ($grille as $semaine)
                    @foreach ($semaine as $jour)
                        @php
                            $jourKey       = $jour->format('Y-m-d');
                            $visitesJour   = $visites[$jourKey] ?? collect();
                            $estAujourdhui = $jour->isToday();
                            $estDuMois     = $jour->month === $date->month;
                            $estWeekend    = $jour->isWeekend();
                        @endphp

                        <a href="{{ route('calendrier.index', ['vue' => 'jour', 'date' => $jourKey]) }}"
                           class="min-h-[90px] p-2 hover:bg-gray-50 transition-colors group
                                  {{ !$estDuMois ? 'bg-gray-50/50' : '' }}">

                            {{-- Numéro du jour --}}
                            <div class="flex justify-end mb-1">
                                <span class="w-7 h-7 flex items-center justify-center text-sm font-semibold rounded-full
                                    {{ $estAujourdhui
                                        ? 'bg-blue-600 text-white'
                                        : ($estDuMois
                                            ? ($estWeekend ? 'text-gray-300' : 'text-gray-700')
                                            : 'text-gray-300') }}">
                                    {{ $jour->day }}
                                </span>
                            </div>

                            {{-- Visites du jour (indicateurs statut) --}}
                            <div class="space-y-0.5">
                                @foreach ($visitesJour->take(3) as $visite)
                                    <div class="flex items-center gap-1 px-1.5 py-0.5 rounded-md text-xs truncate
                                        {{ match($visite->statut) {
                                            'confirmee' => 'bg-green-100 text-green-800',
                                            'planifiee' => 'bg-blue-100 text-blue-800',
                                            'en_cours'  => 'bg-yellow-100 text-yellow-800',
                                            'realisee'  => 'bg-green-50 text-green-600',
                                            'annulee'   => 'bg-red-100 text-red-700',
                                            default     => 'bg-gray-100 text-gray-600',
                                        } }}">
                                        <span class="font-semibold flex-shrink-0">
                                            {{ $visite->date_visite->format('H:i') }}
                                        </span>
                                        <span class="truncate">
                                            {{ $visite->praticien?->nom }}
                                        </span>
                                    </div>
                                @endforeach

                                {{-- +N autres --}}
                                @if ($visitesJour->count() > 3)
                                    <div class="text-xs text-gray-400 px-1.5">
                                        +{{ $visitesJour->count() - 3 }} autres
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- Légende statuts --}}
        <div class="flex flex-wrap gap-3">
            @foreach ([
                ['confirmee', 'bg-green-100 text-green-800',  'Confirmée'],
                ['planifiee', 'bg-blue-100 text-blue-800',    'Planifiée'],
                ['en_cours',  'bg-yellow-100 text-yellow-800','En cours'],
                ['realisee',  'bg-green-50 text-green-600',   'Réalisée'],
                ['annulee',   'bg-red-100 text-red-700',      'Annulée'],
            ] as [$s, $classes, $label])
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $classes }}">
                    {{ $label }}
                </span>
            @endforeach
        </div>
    </div>

    {{-- ── Panneau latéral : Visites à venir ─────────────────── --}}
    <div class="w-72 flex-shrink-0 space-y-4">

        {{-- Visites à venir --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-900 mb-4">Visites à venir</h3>

            @if ($visitesAVenir->isEmpty())
                {{-- Checklist AB : test affichage vide --}}
                <div class="flex flex-col items-center py-6 text-gray-300">
                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-400 text-center">Aucune visite planifiée ce mois-ci</p>
                </div>
            @else
                {{-- Checklist AB : test avec données --}}
                <div class="space-y-3">
                    @foreach ($visitesAVenir as $visite)
                        <a href="{{ route('visites.show', $visite) }}"
                           class="flex gap-3 hover:bg-gray-50 -mx-2 px-2 py-2 rounded-xl transition-colors group">
                            {{-- Date --}}
                            <div class="w-10 text-center flex-shrink-0">
                                <div class="text-lg font-bold text-gray-800 leading-none">{{ $visite->date_visite->day }}</div>
                                <div class="text-xs text-gray-400 uppercase">{{ $visite->date_visite->format('M') }}</div>
                            </div>
                            {{-- Barre statut --}}
                            <div class="w-0.5 rounded-full flex-shrink-0"
                                 style="background: {{ match($visite->statut) {
                                     'confirmee' => '#22C55E', 'en_cours' => '#F59E0B', default => '#2F6BFF'
                                 } }}"></div>
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-blue-600">
                                    {{ $visite->praticien?->nom_complet }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    {{ $visite->date_visite->format('H:i') }}
                                    · {{ $visite->praticien?->specialite }}
                                </p>
                            </div>
                            {{-- Badge --}}
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full flex-shrink-0
                                {{ $visite->statut_couleur }}">
                                {{ $visite->statut_label }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Tournées du mois --}}
        @if ($tournees->isNotEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-bold text-gray-900 mb-4">Tournées — {{ $date->translatedFormat('F') }}</h3>
                <div class="space-y-3">
                    @foreach ($tournees as $tournee)
                        <a href="{{ route('tournees.show', $tournee) }}"
                           class="block hover:bg-gray-50 -mx-2 px-2 py-2 rounded-xl transition-colors">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ $tournee->titre_label }}
                                </p>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $tournee->statut_couleur }}">
                                    {{ $tournee->statut_label }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $tournee->date_debut->format('d/m') }} →
                                {{ $tournee->date_fin->format('d/m') }}
                                · {{ $tournee->nb_visites_prevues }} visites
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>
@endsection