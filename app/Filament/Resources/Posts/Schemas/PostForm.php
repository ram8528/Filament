<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn(Set $set, ?string $state) =>
                        $set('slug', Str::slug($state ?? ''))
                    ),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('excerpt'),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->image(),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                DateTimePicker::make('published_at'),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
