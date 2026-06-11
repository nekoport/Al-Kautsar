<?php

namespace App\Filament\Widgets;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Postingan', Post::whereNotNull('published_at')->count())
                ->icon('heroicon-o-document-text')
                ->color('primary'),
            Stat::make('Pengumuman Aktif', Announcement::where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
                })
                ->count())
                ->icon('heroicon-o-megaphone')
                ->color('success'),
            Stat::make('Acara Bulan Ini', Event::where('is_active', true)
                ->whereMonth('start_date', now()->month)
                ->whereYear('start_date', now()->year)
                ->count())
                ->icon('heroicon-o-calendar-days')
                ->color('warning'),
            Stat::make('Total Pengguna', User::count())
                ->icon('heroicon-o-users')
                ->color('info'),
        ];
    }
}
