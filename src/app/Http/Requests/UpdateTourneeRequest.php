<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateTourneeRequest — Carte #3 AB
 */
class UpdateTourneeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('tournee'));
    }

    public function rules(): array
    {
        return [
            'titre'               => 'nullable|string|max:150',
            'zone_id'             => 'nullable|exists:zones,id',
            'date_debut'          => 'required|date',
            'date_fin'            => 'required|date|after_or_equal:date_debut',
            'heure_debut'         => 'nullable|date_format:H:i',
            'heure_fin'           => 'nullable|date_format:H:i|after:heure_debut',
            'notes'               => 'nullable|string|max:1000',
            'visite_ids'          => 'nullable|array',
            'visite_ids.*'        => 'exists:visites,id',
        ];
    }
}