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
        $departments = Department::query()
            ->withCount('employees')
            ->orderBy('name')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Employees',
                    'data' => $departments
                        ->pluck('employees_count')
                        ->map(fn ($count) => (int) $count)
                        ->all(),
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
