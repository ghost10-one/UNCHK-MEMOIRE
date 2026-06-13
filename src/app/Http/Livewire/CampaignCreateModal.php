<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Zone;
use App\Models\User;
use App\Models\Campaign;

class CampaignCreateModal extends Component
{
    use WithFileUploads;

    public $show = false;
    public $zones;
    public $delegues;

    // form fields
    public $titre;
    public $description;
    public $date_debut;
    public $date_fin;
    public $zone_id;
    public $delegue_id;
    public $objectif;
    public $produits;
    public $digital_support;

    protected $rules = [
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date_debut' => 'nullable|date',
        'date_fin' => 'nullable|date|after_or_equal:date_debut',
        'zone_id' => 'nullable|integer|exists:zones,id',
        'delegue_id' => 'nullable|integer|exists:users,id',
        'objectif' => 'nullable|integer|min:0',
        'produits' => 'nullable|string',
        'digital_support' => 'nullable|file|max:20480|mimes:pdf,mp4',
    ];

    public function mount()
    {
        $this->zones = Zone::all();
        $this->delegues = User::all();
    }

    public function open()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
    }

    public function resetForm()
    {
        $this->titre = null;
        $this->description = null;
        $this->date_debut = null;
        $this->date_fin = null;
        $this->zone_id = null;
        $this->delegue_id = null;
        $this->objectif = null;
        $this->produits = null;
        $this->digital_support = null;
    }

    public function submit()
    {
        $this->validate();

        $campaign = new Campaign();
        $campaign->titre = $this->titre;
        $campaign->description = $this->description;
        $campaign->date_debut = $this->date_debut;
        $campaign->date_fin = $this->date_fin;
        $campaign->zone_id = $this->zone_id;
        $campaign->delegue_id = $this->delegue_id;
        $campaign->objectif = $this->objectif;
        $campaign->produits = $this->produits;

        if ($this->digital_support) {
            $path = $this->digital_support->store('campaigns', 'public');
            $campaign->digital_support = $path;
        }

        $campaign->save();
        $campaign->load('zone', 'delegue');

        session()->flash('success', 'Campagne créée avec succès.');
        $this->resetForm();
        $this->show = false;

        $this->emit('campaignCreated', [
            'id' => $campaign->id,
            'titre' => $campaign->titre,
            'zone' => $campaign->zone->nom ?? 'N/A',
            'delegue' => $campaign->delegue->name ?? 'N/A',
            'date_debut' => $campaign->date_debut ? $campaign->date_debut->format('d/m/Y') : null,
            'date_fin' => $campaign->date_fin ? $campaign->date_fin->format('d/m/Y') : null,
            'statut' => $campaign->statut ?? 'draft',
        ]);
    }

    public function render()
    {
        return view('livewire.campaign-create-modal');
    }
}
