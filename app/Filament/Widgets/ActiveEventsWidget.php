<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveEventsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $count = Event::where('is_active', true)
            ->whereMonth('start_date', now()->month)
            ->whereYear('start_date', now()->year)
            ->count();

        return [
            Stat::make('Acara Bulan Ini', $count),
        ];
    }
}
