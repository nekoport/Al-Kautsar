<?php

namespace App\Providers;

use App\Models\MosqueProfile;
use App\Observers\AuditObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            View::share('mosque', MosqueProfile::first());
        } catch (\Exception $e) {
            View::share('mosque', null);
        }

        FilamentAsset::register([
            Css::make('admin-custom', public_path('css/admin.css')),
        ], 'admin');

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->input('email').'|'.$request->ip());
        });

        $models = [
            \App\Models\Post::class,
            \App\Models\Category::class,
            \App\Models\Event::class,
            \App\Models\Gallery::class,
            \App\Models\GalleryItem::class,
            \App\Models\Streaming::class,
            \App\Models\Announcement::class,
            \App\Models\Official::class,
            \App\Models\DonationInfo::class,
            \App\Models\MosqueProfile::class,
            \App\Models\User::class,
        ];

        foreach ($models as $model) {
            $model::observe(AuditObserver::class);
        }
    }
}
