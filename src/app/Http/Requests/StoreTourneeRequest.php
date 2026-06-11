<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Carte #3                                   ║
 * ║  StoreTourneeRequest — validation dates + chevauchement     ║
 * ╚══════════════════════════════════════════════════════════════╝
 */
class StoreTourneeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Tournee::class);
    }

    public function rules(): array
    {
        return [
            'titre'      => 'nullable|string|max:150',
            'zone_id'    => 'nullable|exists:zones,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
            'heure_debut'=> 'nullable|date_format:H:i',
            'heure_fin'  => 'nullable|date_format:H:i|after:heure_debut',
            'notes'      => 'nullable|string|max:1000',
            'visite_ids'          => 'nullable|array',
            'visite_ids.*'        => 'exists:visites,id',
        ];
    }

    public function messages(): array
    {
        return [
            'date_debut.required'       => 'La date de début est obligatoire.',
            'date_debut.after_or_equal' => 'La date de début doit être aujourd\'hui ou dans le futur.',
            'date_fin.required'         => 'La date de fin est obligatoire.',
            'date_fin.after_or_equal'   => 'La date de fin doit être égale ou postérieure à la date de début.',
            'heure_fin.after'           => 'L\'heure de fin doit être après l\'heure de début.',
        ];
    }
}