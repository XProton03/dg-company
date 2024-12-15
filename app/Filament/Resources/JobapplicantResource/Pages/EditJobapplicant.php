<?php

namespace App\Filament\Resources\JobapplicantResource\Pages;

use App\Filament\Resources\JobapplicantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobapplicant extends EditRecord
{
    protected static string $resource = JobapplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
