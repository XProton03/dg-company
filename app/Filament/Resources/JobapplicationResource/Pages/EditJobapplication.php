<?php

namespace App\Filament\Resources\JobapplicationResource\Pages;

use App\Filament\Resources\JobapplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobapplication extends EditRecord
{
    protected static string $resource = JobapplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
