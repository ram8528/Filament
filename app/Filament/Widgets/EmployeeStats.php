<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeStats extends BaseWidget
{
    protected ?string $heading = 'Human Resources Overview';

    protected ?string $description = 'A quick overview of your workforce.';

    protected function getStats(): array
    {
        $totalEmployees = Employee::count();

        $activeEmployees = Employee::where(
            'status',
            'active'
        )->count();

        $employeesOnLeave = Employee::where(
            'status',
            'on_leave'
        )->count();

        $monthlyPayroll = Employee::where(
            'status',
            'active'
        )->sum('salary');

        return [
            Stat::make('Total Employees', $totalEmployees)
                ->description('All employee records')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Active Employees', $activeEmployees)
                ->description('Currently active')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Employees on Leave', $employeesOnLeave)
                ->description('Currently on leave')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),

            Stat::make(
                'Estimated Monthly Payroll',
                '₹ ' . number_format((float) $monthlyPayroll, 2)
            )
                ->description('Active employees only')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            Stat::make(
                'Departments',
                Department::where('is_active', true)->count()
            )
                ->description('Active departments')
                ->color('primary'),

            Stat::make(
                'Designations',
                Designation::where('is_active', true)->count()
            )
                ->description('Active designations')
                ->color('primary'),
        ];
    }
}
