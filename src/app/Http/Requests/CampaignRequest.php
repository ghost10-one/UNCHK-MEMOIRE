<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date_debut' => ['required', 'date', 'before_or_equal:date_fin'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            'statut' => ['nullable', 'in:planifiee,en_cours,terminee,annulee'],
            'delegue_id' => ['required', 'exists:users,id'],
            'zone_id' => ['required', 'exists:zones,id'],
            'digital_support' => ['nullable', 'file', 'mimes:pdf,mp4', 'max:20480'],
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de la campagne est requis.',
            'date_debut.required' => 'La date de début est requise.',
            'date_fin.required' => 'La date de fin est requise.',
            'date_debut.before_or_equal' => 'La date de début doit être antérieure ou égale à la date de fin.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'delegue_id.required' => 'Le délégué responsable est requis.',
            'delegue_id.exists' => 'Le délégué sélectionné est invalide.',
            'zone_id.required' => 'La zone est requise.',
            'zone_id.exists' => 'La zone sélectionnée est invalide.',
            'digital_support.mimes' => 'Le support doit être un fichier PDF ou MP4.',
            'digital_support.max' => 'Le fichier doit être inférieur à 20 Mo.',
        ];
    }
}
