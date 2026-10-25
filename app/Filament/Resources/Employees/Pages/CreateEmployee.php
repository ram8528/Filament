<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    public function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success !')
            ->body('Your employee record has been created successfully');
    }
}
