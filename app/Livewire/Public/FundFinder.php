<?php

namespace App\Livewire\Public;

use App\Models\Fund;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FundFinder extends Component
{
    public ?int $fundTypeId = null;

    public ?int $fundLocationId = null;

    public ?int $riskLevelId = null;

    #[Computed]
    public function funds(): Collection
    {
        return Fund::active()->when($this->fundTypeId, fn ($query) => $query->where('fund_type_id', $this->fundTypeId))
            ->when($this->fundLocationId, fn ($query) => $query->where('fund_location_id', $this->fundLocationId))
            ->when($this->riskLevelId, fn ($query) => $query->where('risk_level_id', $this->riskLevelId))
            ->orderBy('name')
            ->get();
    }
}
