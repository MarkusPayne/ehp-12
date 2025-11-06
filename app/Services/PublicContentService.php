<?php

namespace App\Services;

use App\Models\Advisor;
use App\Models\Location;
use App\Models\News;
use App\Models\PublicContent;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class PublicContentService
{
    public function getContent(string $name): ?string
    {
        return PublicContent::query()
            ->where('name', $name)
            ->first()?->content;
    }

    public function getTeam(): Collection
    {
        return Team::where('active', 1)->get();
    }

    public function getAdvisors(): Collection
    {
        return Advisor::where('active', 1)->with('location')->orderBy('location_id', 'asc')->get();
    }

    public function getLocations(): Collection
    {
        return Location::where('active', 1)->with('advisors')->orderBy('id', 'asc')->get();
    }

    public function getNews(): Collection
    {
        return News::where('active', 1)->orderBy('news_date', 'desc')->get();
    }
}
