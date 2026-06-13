<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Campaign;

class CampaignsTable extends Component
{
    use WithPagination;

    public $zone_id;
    public $delegue_id;
    public $date_debut;
    public $date_fin;

    protected $listeners = [
        'campaignCreated' => '$refresh',
    ];

    protected $queryString = [
        'zone_id' => ['except' => ''],
        'delegue_id' => ['except' => ''],
        'date_debut' => ['except' => ''],
        'date_fin' => ['except' => ''],
    ];

    public function updating($name, $value)
    {
        if (in_array($name, ['zone_id', 'delegue_id', 'date_debut', 'date_fin'])) {
            $this->resetPage();
        }
    }

    public function delete($id)
    {
        $campaign = Campaign::findOrFail($id);
        if (auth()->user()->can('delete', $campaign)) {
            $campaign->delete();
            $this->dispatchBrowserEvent('toast', ['message' => 'Campagne supprimée.']);
            $this->resetPage();
        } else {
            $this->dispatchBrowserEvent('toast', ['message' => 'Permission refusée.']);
        }
    }

    public function render()
    {
        $query = Campaign::with(['zone', 'delegue'])->orderBy('created_at', 'desc');

        if ($this->zone_id) {
            $query->where('zone_id', $this->zone_id);
        }
        if ($this->delegue_id) {
            $query->where('delegue_id', $this->delegue_id);
        }
        if ($this->date_debut) {
            $query->whereDate('date_debut', '>=', $this->date_debut);
        }
        if ($this->date_fin) {
            $query->whereDate('date_fin', '<=', $this->date_fin);
        }

        $campaigns = $query->paginate(10);

        return view('livewire.campaigns-table', [
            'campaigns' => $campaigns,
        ]);
    }
}
