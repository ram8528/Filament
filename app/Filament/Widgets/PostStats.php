<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostStats extends BaseWidget
{
    protected ?string $heading = 'Content Overview';

    protected ?string $description = 'Posts and publishing activity';

    protected function getStats(): array
    {
        $totalPosts = Post::count();

        $publishedPosts = Post::where('status', 'published')->count();

        $draftPosts = Post::where('status', 'draft')->count();

        $publishedThisMonth = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->whereBetween('published_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->count();

        return [
            Stat::make('Total Posts', $totalPosts)
                ->description('All posts')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Published', $publishedPosts)
                ->description('Live content')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Drafts', $draftPosts)
                ->description('Unpublished content')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('warning'),

            Stat::make('Published This Month', $publishedThisMonth)
                ->description('Based on published date')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
