<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Auth\Login::class)
            ->loginRouteSlug('login')
            ->colors([
                'primary' => '#0F6E56',
            ])
            ->darkMode(false)
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => Blade::render('<style>
                    .fi-simple-layout {
                        background: linear-gradient(135deg, #0a5c47 0%, #0F6E56 50%, #1a8a6e 100%) !important;
                        min-height: 100vh !important;
                    }
                    .fi-simple-main-ctn { background: transparent !important; }
                    .fi-simple-main {
                        background: #ffffff !important;
                        border-radius: 1rem !important;
                        box-shadow: 0 20px 60px rgba(0,0,0,0.3) !important;
                        border: none !important;
                        overflow: hidden !important;
                        max-width: 420px !important;
                    }
                    .fi-simple-page {
                        background: #ffffff !important;
                        padding: 2rem !important;
                    }
                    .fi-simple-header { text-align: center !important; margin-bottom: 1.5rem !important; }
                    .fi-logo { color: #0F6E56 !important; font-weight: 700 !important; font-size: 1.1rem !important; }
                    .fi-simple-header-heading { color: #1a1a1a !important; font-size: 1.5rem !important; }
                    .fi-fo-field-label-content { color: #374151 !important; font-weight: 500 !important; }
                    .fi-fo-field-label-required-mark { color: #ef4444 !important; }
                    .fi-input-wrp {
                        background: #f9fafb !important;
                        border: 1.5px solid #d1d5db !important;
                        border-radius: 0.5rem !important;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #0F6E56 !important;
                        box-shadow: 0 0 0 3px rgba(15,110,86,0.15) !important;
                    }
                    .fi-input { color: #1a1a1a !important; background: transparent !important; }
                    .fi-checkbox-input + .fi-fo-field-label-content { color: #374151 !important; }
                    .fi-btn {
                        background: #0F6E56 !important;
                        color: #ffffff !important;
                        border-radius: 0.5rem !important;
                        font-weight: 600 !important;
                        padding: 0.75rem !important;
                        width: 100% !important;
                    }
                    .fi-btn:hover { background: #085041 !important; }
                </style>'),
            )
            ->brandName('Masjid Al-Kautsar')
            ->profile()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->navigationGroups([
                'Konten',
                'Manajemen',
                'Pengguna',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\DashboardStatsWidget::class,
                \App\Filament\Widgets\PostsPublishedChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
