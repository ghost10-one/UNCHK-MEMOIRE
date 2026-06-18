<?php

namespace App\Http\Livewire;

use App\Models\Sample;
use Livewire\Component;

class CampaignMonitoring extends Component
{
    public function getTotalInitialProperty(): int
    {
        return Sample::sum('initial_quantity') ?? 0;
    }

    public function getTotalRemainingProperty(): int
    {
        return Sample::sum('remaining_quantity') ?? 0;
    }

    public function getTotalDistribueProperty(): int
    {
        return max(0, $this->totalInitial - $this->totalRemaining);
    }

    public function getProgressProperty(): int
    {
        if ($this->totalInitial === 0) {
            return 0;
        }

        return min(100, (int) round(($this->totalDistribue / $this->totalInitial) * 100));
    }

    public function getAlertStyleProperty(): string
    {
        if ($this->totalRemaining === 0) {
            return 'bg-red-50 text-red-700';
        }

        if ($this->totalRemaining < 50) {
            return 'bg-amber-50 text-amber-700';
        }

        return 'bg-blue-50 text-blue-700';
    }

    public function getAlertMessageProperty(): string
    {
        if ($this->totalRemaining === 0) {
            return 'Stock épuisé';
        }

        if ($this->totalRemaining < 50) {
            return 'Stock critique';
        }

        if ($this->totalRemaining < 150) {
            return 'Stock faible';
        }

        return 'Stock stable';
    }

    public function render()
    {
        return view('livewire.campaign-monitoring');
    }
}
