<?php

namespace App\Filament\Resources\UserResource\Pages;

use export;
use Filament\Actions;
use App\Filament\Exports\UserExporter;
use Filament\Tables\Actions\BulkAction;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
