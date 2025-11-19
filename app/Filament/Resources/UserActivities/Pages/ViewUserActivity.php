<?php

namespace App\Filament\Resources\UserActivities\Pages;

use App\Filament\Resources\UserActivities\UserActivityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserActivity extends ViewRecord
{
    protected static string $resource = UserActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
