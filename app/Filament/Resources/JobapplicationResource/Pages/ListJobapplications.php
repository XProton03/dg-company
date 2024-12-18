<?php

namespace App\Filament\Resources\JobapplicationResource\Pages;

use Filament\Actions;
use App\Models\Jobapplication;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobapplicationResource;

class ListJobapplications extends ListRecords
{
    protected static string $resource = JobapplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
                ->badge(Jobapplication::query()->count()),
            'Aktif' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', '=', 'Aktif'))
                ->badge(Jobapplication::query()->where('status', '=', 'Aktif')->count()),
            'Draft' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', '=', 'Draft'))
                ->badge(Jobapplication::query()->where('status', '=', 'Draft')->count()),
            'Tidak Aktif' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', '=', 'Tidak Aktif'))
                ->badge(Jobapplication::query()->where('status', '=', 'Tidak Aktif')->count()),
        ];
    }
}
