<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;

class PostsPublishedChart extends ChartWidget
{
    protected ?string $heading = 'Publikasi Berita';

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
