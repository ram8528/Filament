<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),

                TextColumn::make('phone')
                    ->searchable()
                    ->copyable()
                    ->placeholder('—'),

                TextColumn::make('departmentRelation.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Not assigned'),

                TextColumn::make('designation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('salary')
                    ->label('Monthly Salary')
                    ->formatStateUsing(
                        fn($state): string =>
                        '₹ ' . number_format((float) $state, 2)
                    )
                    ->sortable()
                    ->alignment('end'),

                TextColumn::make('joining_date')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(
                        fn($state): string =>
                        match ($state) {
                            'active' => 'Active',
                            'on_leave' => 'On Leave',
                            'inactive' => 'Inactive',
                            default => ucfirst((string) $state),
                        }
                    )
                    ->color(fn($state): string => match ($state) {
                        'active' => 'success',
                        'on_leave' => 'warning',
                        'inactive' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->options([
                        'Engineering' => 'Engineering',
                        'Human Resources' => 'Human Resources',
                        'Finance' => 'Finance',
                        'Sales' => 'Sales',
                        'Marketing' => 'Marketing',
                        'Operations' => 'Operations',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'on_leave' => 'On Leave',
                        'inactive' => 'Inactive',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->successNotificationTitle(
                        'Employee deleted successfully!'
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->successNotificationTitle(
                            'Selected employees deleted successfully!'
                        ),
                ]),
            ]);
    }
}
