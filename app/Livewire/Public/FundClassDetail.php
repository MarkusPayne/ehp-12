<?php

namespace App\Livewire\Public;

use App\Models\Fund;
use App\Models\FundClass;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FundClassDetail extends Component
{
    public int $fundId;

    public ?int $fundClassId = null;

    #[Computed]
    public function fund(): ?Fund
    {
        return Fund::find($this->fundId)->load(['fundClasses' => fn ($query) => $query->active()->orderBy('sort_order')]);
    }

    #[Computed]
    public function fundClass(): ?FundClass
    {

        if (! $this->fundClassId) {
            $this->fundClassId = $this->fund?->fundClasses?->first()->id;
        }

        return FundClass::find($this->fundClassId);
    }
}
