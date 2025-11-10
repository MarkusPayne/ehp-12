<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FundClass extends Model
{
    use HasTranslations;

    protected $fillable = [
        'fund_id',
        'fund_data_code',
        'fund_code',
        'fund_class_name',
        'inception_date',
        'currency',
        'management_fee',
        'performance_fee',
        'trailer',
        'minimum_initial',
        'minimum_additional',
        'registered_eligible',
        'active',
        'sort_order',
    ];

    public array $translatable = ['fund_class_name', 'currency'];

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('active', 1);
    }

    protected function casts(): array
    {
        return [
            'inception_date' => 'date',
            'registered_eligible' => 'boolean',
            'active' => 'boolean',
        ];
    }

    /**
     * Define the "growth" attribute for the model.
     *
     * Calculates the growth based on the Net Asset Value (NAV) of the fund over time,
     * considering distributions and NAV frequency. The calculation begins from the
     * fund's inception date and accumulates growth by grouping NAVs based on the
     * specified NAV frequency (e.g., daily or monthly). The result is a collection
     * of timestamped growth values.
     *
     * Steps:
     * - Initialize the variables `$lastNav` and `$lastGrowth` to track the previous NAV and growth.
     * - Fetch the NAV data starting from the fund's inception date, ordered by date in ascending order.
     * - Group the NAV data by the fund's NAV frequency.
     * - Iterate through the grouped NAVs to calculate growth:
     *   - For the initial investment, calculate the units and initial growth.
     *   - Calculate the cumulative effect of daily distributions using a distribution multiplier.
     *   - Compute growth using the current NAV, distribution multiplier, previous NAV, and previous growth.
     *   - Update tracking variables `$lastNav` and `$lastGrowth`.
     *   - Store the resulting growth value paired with the timestamp.
     * - Flatten the collection of grouped data into a structured array of growth values.
     */
    public function growth(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Initialize variables to track previous NAV and growth values
                $lastNav = null;
                $lastGrowth = null;

                return $this->fundClassNavs()
                    // Get NAVs from inception date onwards
                    ->whereDate('nav_date', '>=', $this->inception_date)
                    // Order by date ascending
                    ->oldest('nav_date')
                    ->get()
                    // Group NAVs by date according to fund's NAV frequency (e.g., daily, monthly)
                    ->mapToGroups(fn ($nav) => [$nav->nav_date->format($this->fund->nav_frequency) => $nav])
                    ->reduce(function ($carry, $navGroup) use (&$lastNav, &$lastGrowth) {
                        // Initial investment calculation
                        if (! $lastGrowth) {
                            $lastNav = $navGroup->first()->nav;
                            // Calculate initial units based on $100,000 investment
                            $units = 100000 / $lastNav;
                            $lastGrowth = $units * $lastNav;
                        }

                        // Get the most recent NAV in the current group
                        $lastGroupNav = $navGroup->sortByDesc('nav_date')->first();

                        // Calculate the cumulative effect of distributions
                        // Multiply (1 + distribution_rate) for each NAV in the group
                        $distributionMultiplier = $navGroup->reduce(
                            fn ($carry, $nav) => $carry * (1 + $nav->daily_distribution / $nav->nav),
                            1.0
                        );

                        // Calculate growth considering:
                        // 1. Current NAV plus distribution
                        // 2. Distribution multiplier effect
                        // 3. Previous NAV impact
                        // 4. Previous growth value
                        $growth = ((($lastGroupNav->daily_distribution + $lastGroupNav->nav) * $distributionMultiplier) / $lastNav) * $lastGrowth;

                        // Update tracking variables for the next iteration
                        $lastGrowth = $growth;
                        $lastNav = $lastGroupNav->nav;

                        // Store the result as [timestamp, growth_value]
                        $carry[$lastGroupNav->nav_date->getPreciseTimestamp(3)] = [
                            $lastGroupNav->nav_date->getPreciseTimestamp(3),
                            (float) $growth,
                        ];

                        return $carry;
                    }, collect())
                    // Flatten the collection to a simple array structure
                    ->flatMap(function ($group) {
                        return [$group];
                    });
            }
        );
    }

    public function returns(): Attribute
    {
        return Attribute::make(
            get: function () {

                // get the difference in days between inception date and last day of last month
                $months = $this->inception_date->diffInMonths(now()->startOfMonth()->subDay());

                $range = collect([3, 6, 12, 36, 60, 120, 180, 240, 300, 360])
                    ->filter(fn ($item) => $item <= $months)
                    ->map(function ($monthCnt) {

                        $startDate = Carbon::now()->startOfMonth()->subDay()->subMonthsNoOverflow($monthCnt)->endOfMonth()->getPreciseTimestamp(3);
                        $endDate = Carbon::now()->startOfMonth()->subDay()->endOfMonth()->getPreciseTimestamp(3);

                        $startValue = $this->growth->first(fn ($item) => $item[0] >= $startDate)[1];
                        $endValue = $this->growth->reverse()->first(fn ($item) => $item[0] <= $endDate)[1];

                        if ($monthCnt > 12) {
                            $returnValue = (($endValue / $startValue) ** (1 / ($monthCnt / 12))) - 1;
                        } else {
                            $returnValue = (($endValue - $startValue) / $startValue);
                        }

                        return [$monthCnt, $returnValue];
                    });

                return $range;
                // dd($range);
                // ->map(fn($item) => $item * 30)->toArray();

                //                $range = collect([
                //                    ['months' => 3, 'title' => '3M Return'],
                //                    ['months' => 6, 'title' => '6M Return'],
                //                    ['months' => 12, 'title' => '1Y Return'],
                //                    ['months' => 36, 'title' => '3Y Return'],
                //                    ['months' => 60, 'title' => '5Y Return'],
                //                    ['months' => 120, 'title' => '10Y Return'],
                //                    ['months' => 180, 'title' => '15Y Return'],
                //                    ['months' => 240, 'title' => '20Y Return'],
                //                    ['months' => 300, 'title' => '25Y Return'],
                //                    ['months' => 360, 'title' => '30Y Return'],
                //                ]);

            }
        );
    }

    protected function lastNav(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->fundClassNavs()->whereDate('nav_date', '>=', $this->inception_date)->latest()->first(),
        );
    }

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function fundClassNavs(): HasMany
    {
        return $this->hasMany(FundClassNav::class);
    }

    public function fundClassMonthly(): HasMany
    {
        return $this->hasMany(FundClassMonthly::class);
    }
}
