<?php

namespace App\Providers;

use App\Listeners\LogAdminActivity;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\DonationInfo;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\MosqueProfile;
use App\Models\Official;
use App\Models\Post;
use App\Models\Streaming;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
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
            Post::class, Category::class, Event::class,
            Gallery::class, GalleryItem::class, Streaming::class,
            Announcement::class, Official::class,
            DonationInfo::class, MosqueProfile::class,
        ];

        foreach ($models as $model) {
            $model::created(fn ($m) => (new LogAdminActivity)->handle('created', $m));
            $model::updated(fn ($m) => (new LogAdminActivity)->handle('updated', $m));
            $model::deleted(fn ($m) => (new LogAdminActivity)->handle('deleted', $m));
        }
    }
}
