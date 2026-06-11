<?php

namespace App\Filament\Widgets;

use App\Models\Announcement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveAnnouncementsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $count = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->count();

        return [
            Stat::make('Pengumuman Aktif', $count),
        ];
    }
}
