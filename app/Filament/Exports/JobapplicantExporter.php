<?php

namespace App\Filament\Exports;

use App\Models\Jobapplicant;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;

class JobapplicantExporter extends Exporter
{
    protected static ?string $model = Jobapplicant::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('jobapplications.title')
                ->label('Job'),
            ExportColumn::make('image'),
            ExportColumn::make('name'),
            ExportColumn::make('age'),
            ExportColumn::make('gender'),
            ExportColumn::make('email'),
            ExportColumn::make('phone'),
            ExportColumn::make('address'),
            ExportColumn::make('skill'),
            ExportColumn::make('last_year_education'),
            ExportColumn::make('last_level_education'),
            ExportColumn::make('last_education'),
            ExportColumn::make('last_year_position'),
            ExportColumn::make('last_level_position'),
            ExportColumn::make('last_company'),
            ExportColumn::make('experience'),
            ExportColumn::make('salary'),
            ExportColumn::make('on_working'),
            ExportColumn::make('cv'),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('ready_for_work'),
            ExportColumn::make('note'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your jobapplicant export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
