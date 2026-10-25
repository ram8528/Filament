<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;

class PostsByStatusChart extends ChartWidget
{
    protected ?string $heading = 'Posts by Status';

    protected ?string $maxHeight = '300px';

    protected int|string|array $columnSpan = 1;

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $published = Post::where('status', 'published')->count();
        $draft = Post::where('status', 'draft')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => [$published, $draft],
                    'backgroundColor' => [
                        '#F59E0B',
                        '#64748B',
                    ],
                    'borderColor' => '#FFFFFF',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Published', 'Draft'],
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return 1;
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
