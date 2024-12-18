<?php

namespace App\Filament\Resources\JobapplicantResource\Pages;

use Filament\Actions;
use App\Models\Jobapplicant;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobapplicantResource;

class ListJobapplicants extends ListRecords
{
    protected static string $resource = JobapplicantResource::class;

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
                ->badge(Jobapplicant::query()->count()),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(Jobapplicant::query()->where('created_at', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Jobapplicant::query()->where('created_at', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Jobapplicant::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
