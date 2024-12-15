<?php

namespace App\Filament\Resources\JobapplicationResource\Pages;

use App\Filament\Resources\JobapplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobapplications extends ListRecords
{
    protected static string $resource = JobapplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
