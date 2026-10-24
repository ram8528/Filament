<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Category Updated Successfully!')
            ->body('Your category changes have been saved.');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Delete Category')
                ->requiresConfirmation()
                ->successNotificationTitle('Category deleted successfully'),
        ];
    }
}