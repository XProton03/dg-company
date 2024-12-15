<?php

namespace App\Filament\Resources\JobapplicantResource\Pages;

use App\Filament\Resources\JobapplicantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobapplicants extends ListRecords
{
    protected static string $resource = JobapplicantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
