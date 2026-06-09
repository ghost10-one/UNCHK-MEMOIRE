<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PraticienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled by Policies
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'titre' => ['nullable', 'string', 'max:50'],
            'specialite' => ['required', 'string', 'max:255'],
            'sous_specialite' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'email_secondaire' => ['nullable', 'email', 'max:255'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'ville' => ['nullable', 'string', 'max:255'],
            'code_postal' => ['nullable', 'string', 'max:20'],
            'hopital' => ['nullable', 'string', 'max:255'],
            'cabinet' => ['nullable', 'string', 'max:255'],
            'type_etablissement' => ['nullable', 'string', 'max:100'],
            'zone_id' => ['required', 'exists:zones,id'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'specialite.required' => 'La spécialité est obligatoire.',
            'zone_id.required' => 'La zone géographique est obligatoire.',
            'zone_id.exists' => 'La zone sélectionnée n\'existe pas.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
        ];
    }
}
