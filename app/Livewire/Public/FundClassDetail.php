<?php

namespace App\Livewire\Public;

use App\Models\Fund;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.public')]
class FundClassDetail extends Component
{
    public int $fundId;

    #[Computed]
    public function fund()
    {
        return Fund::find($this->fundId);
    }
}
