<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;

class PostsPublishedChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 2;

    protected ?string $heading = 'Publikasi Berita (12 Bulan)';

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $labels[] = $month->translatedFormat('F Y');
            $data[] = Post::whereNotNull('published_at')
                ->whereMonth('published_at', $month->month)
                ->whereYear('published_at', $month->year)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Publikasi Berita',
                    'data' => $data,
                    'backgroundColor' => '#0F6E56',
                    'borderColor' => '#0F6E56',
                    'tension' => 0.3,
                    'fill' => false,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
