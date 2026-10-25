<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Personal Information')
                ->description('Basic employee details')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Full Name')
                        ->required()
                        ->maxLength(255)
                        ->autocomplete('name'),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->autocomplete('email'),

                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(20)
                        ->nullable(),

                    DatePicker::make('joining_date')
                        ->required()
                        ->native(false)
                        ->maxDate(now()),
                ]),

            Section::make('Job Details')
                ->description('Department, designation and employment status')
                ->icon('heroicon-o-briefcase')
                ->columns(2)
                ->schema([
                    Select::make('department_id')
                        ->label('Department')
                        ->relationship(
                            name: 'departmentRelation',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn(Builder $query) => $query
                                ->where('is_active', true),
                        )
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live(),

                    Select::make('designation')
                        ->options([
                            'Intern' => 'Intern',
                            'Junior Developer' => 'Junior Developer',
                            'Software Developer' => 'Software Developer',
                            'Senior Developer' => 'Senior Developer',
                            'Team Lead' => 'Team Lead',
                            'Manager' => 'Manager',
                        ])
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('salary')
                        ->label('Monthly Salary')
                        ->numeric()
                        ->prefix('₹')
                        ->minValue(0)
                        ->step(0.01)
                        ->required(),

                    Select::make('status')
                        ->options([
                            'active' => 'Active',
                            'on_leave' => 'On Leave',
                            'inactive' => 'Inactive',
                        ])
                        ->default('active')
                        ->required()
                        ->live(),
                ]),
        ]);
    }
}
