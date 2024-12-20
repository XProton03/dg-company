<?php

namespace App\Filament\Exports;

use App\Models\Jobapplication;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class JobapplicationExporter extends Exporter
{
    protected static ?string $model = Jobapplication::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('image'),
            ExportColumn::make('title'),
            ExportColumn::make('description'),
            ExportColumn::make('location'),
            ExportColumn::make('age_level'),
            ExportColumn::make('education_level'),
            ExportColumn::make('gender'),
            ExportColumn::make('employment_type'),
            ExportColumn::make('hour_type'),
            ExportColumn::make('experience_year'),
            ExportColumn::make('salary_min'),
            ExportColumn::make('salary_max'),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your jobapplication export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
