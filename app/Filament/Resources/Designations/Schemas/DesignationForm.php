<?php

namespace App\Filament\Resources\Designations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DesignationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Designation Information')
                ->columns(2)
                ->schema([
                    Select::make('department_id')
                        ->relationship(
                            name: 'department',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn ($query) => $query
                                ->where('is_active', true),
                        )
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->unique(
                            ignoreRecord: true,
                            modifyRuleUsing: fn ($rule, $state, $record) => $rule,
                        ),

                    Textarea::make('description')
                        ->rows(3)
                        ->maxLength(1000)
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true)
                        ->required(),
                ]),
        ]);
    }
}
