<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'praticien_id' => ['required', 'exists:praticiens,id'],
            'date_visite' => ['required', 'date'],
            'heure_debut' => ['nullable', 'date_format:H:i'],
            'statut' => ['required', 'string', 'in:planifiee,confirmee,en_cours,realisee,annulee,manquee'],
            'notes' => ['nullable', 'string'],
            'duree_min' => ['nullable', 'integer', 'min:1'],
            'adresse_visite' => ['nullable', 'string'],
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'praticien_id.required' => 'Le choix d\'un praticien est obligatoire.',
            'praticien_id.exists' => 'Le praticien sélectionné n\'existe pas.',
            'date_visite.required' => 'La date de la visite est obligatoire.',
            'statut.required' => 'Le statut de la visite est obligatoire.',
            'statut.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
