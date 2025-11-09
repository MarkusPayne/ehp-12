<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('content', function ($expression) {
            return "<?php echo \\App\\Facades\\PublicContentService::getContent($expression); ?>";
        });
        Blade::directive(
            'prettyDate',
            function ($value) {
                return "<?php if($value) echo ($value)->format('M d, Y'); else echo 'Not Set';?>";
            }
        );
    }
}
