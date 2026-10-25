<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use Filament\Widgets\ChartWidget;

class EmployeesByDepartmentChart extends ChartWidget
{
    protected ?string $heading = 'Employees by Department';

    protected ?string $description = 'Workforce distribution across departments';

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $departments = \App\Models\Department::query()
            ->withCount('employees')
            ->orderBy('name')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Employees',
                    'data' => $departments
                        ->pluck('employees_count')
                        ->map(fn($count) => (int) $count)
                        ->all(),

                    'backgroundColor' => [
                        '#3B82F6', // Blue
                        '#10B981', // Green
                        '#F59E0B', // Amber
                        '#8B5CF6', // Purple
                        '#F43F5E', // Rose
                        '#06B6D4', // Cyan
                        '#F97316', // Orange
                        '#64748B', // Slate
                    ],

                    'borderColor' => '#FFFFFF',
                    'borderWidth' => 2,
                ],
            ],

            'labels' => $departments
                ->pluck('name')
                ->all(),
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
}
