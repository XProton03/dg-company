<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Jobapplication;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\Storage;
use Filament\Infolists\Components\Split;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\JobapplicationExporter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JobapplicationResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\JobapplicationResource\RelationManagers;

class JobapplicationResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Jobapplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Jobs Application';
    protected static ?string $slug = 'jobs';
    public static ?string $label = 'Jobs';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any'
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail dan Jenis Pekerjaan')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('hour_type')
                            ->label('Tipe Kerja')
                            ->required()
                            ->searchable()
                            ->options([
                                'Penuh Waktu' => 'Penuh Waktu',
                                'Paruh Waktu' => 'Paruh Waktu',
                            ])
                            ->preload(),
                        Forms\Components\Select::make('employment_type')
                            ->label('Sistem Kerja')
                            ->required()
                            ->searchable()
                            ->options([
                                'Dikantor' => 'Dikantor',
                                'Remote' => 'Remote',
                                'Hybrid' => 'Hybrid',
                            ])
                            ->preload(),
                        Forms\Components\TextInput::make('location')
                            ->label('Lokasi')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Gaji')
                    ->description('Dengan menyertakan kisaran gaji yang jelas di lowongan pekerjaan Anda, Anda menarik kandidat yang sesuai dengan harapan Anda dan menyederhanakan proses perekrutan.')
                    ->schema([
                        Forms\Components\TextInput::make('salary_min')
                            ->label('Gaji Minimum')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('salary_max')
                            ->label('Gaji Maksimum')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Persyaratan Kerja')
                    ->schema([
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->required()
                            ->searchable()
                            ->options([
                                'Laki-Laki' => 'Laki-Laki',
                                'Perempuan' => 'Perempuan',
                                'Tanpa Referensi' => 'Tanpa Referensi',
                            ])
                            ->preload(),
                        Forms\Components\TextInput::make('age_level')
                            ->label('Usia')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('education_level')
                            ->label('Pendidikan Minimal')
                            ->required()
                            ->searchable()
                            ->options([
                                'SD' => 'SD',
                                'SMP' => 'SMP',
                                'SMA/SMK' => 'SMA/SMK',
                                'D1-D4' => 'D1-D4',
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ])
                            ->preload(),
                        Forms\Components\Select::make('experience_year')
                            ->label('Pengalaman Kerja Minimal')
                            ->required()
                            ->searchable()
                            ->options([
                                'Kurang dari setahun' => 'Kurang dari setahun',
                                '1 sampai 3 Tahun' => '1 sampai 3 Tahun',
                                '3 sampai 5 Tahun' => '3 sampai 5 Tahun',
                                '5 sampai 10 Tahun' => '5 sampai 10 Tahun',
                                '10 Tahun +' => '10 Tahun +',
                                'Tanpa Referensi' => 'Tanpa Referensi',
                            ])
                            ->preload(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Deskripsi Pekerjaan')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'Aktif' => 'Aktif',
                                'Draft' => 'Draft',
                                'Tidak Aktif' => 'Tidak Aktif',
                            ])
                            ->required()
                            ->default('Draft')
                            ->searchable()
                            ->preload(),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->label('Logo')
                            ->maxSize(1024)
                            ->openable()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi')
                            ->columnSpan(2)
                            ->required()
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->url(fn($record) => $record->image
                        ? asset('storage/' . $record->image)
                        : asset('storage/default/logoDG1.png')),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('hour_type'),
                Tables\Columns\TextColumn::make('employment_type')
                    ->formatStateUsing(fn($state): string => Str::headline($state)),
                Tables\Columns\TextColumn::make('salary_min')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('salary_max')
                    ->money('IDR'),
                //->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => [
                        'Aktif'         => 'success',
                        'Draft'         => 'warning',
                        'Tidak Aktif'   => 'danger',
                    ][$state] ?? 'secondary'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make(),
                    Action::make('activate')
                        ->label('Aktifkan')
                        ->visible(fn($record) => $record->status !== 'Aktif') // Tampilkan jika status bukan 'Aktif'
                        ->color('success')
                        ->action(fn($record) => $record->update(['status' => 'Aktif']))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle'),
                    Action::make('draft')
                        ->label('Draft')
                        ->visible(fn($record) => $record->status !== 'Draft') // Tampilkan jika status bukan 'Aktif'
                        ->color('warning')
                        ->action(fn($record) => $record->update(['status' => 'Draft']))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-archive-box'),
                    Action::make('deactivate')
                        ->label('Nonaktifkan')
                        ->visible(fn($record) => $record->status !== 'Tidak Aktif') // Tampilkan jika status adalah 'Aktif'
                        ->color('danger')
                        ->action(fn($record) => $record->update(['status' => 'Tidak Aktif']))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-x-circle'),
                    Tables\Actions\DeleteAction::make()->action(function ($record) {
                        // Hapus file dengan disk storage
                        if ($record->image && Storage::disk('public')->exists($record->image)) {
                            Storage::disk('public')->delete($record->image);
                        }
                        // Hapus data dari database
                        $record->delete();
                    }),
                    Action::make('activities')
                        ->url(fn($record) => JobapplicationResource::getUrl('activities', ['record' => $record]))
                        ->icon('heroicon-o-clock')
                        ->color('secondary')
                        ->label('Logs'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => 'Aktif'])))
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('draft')
                        ->label('Draft')
                        ->color('warning')
                        ->icon('heroicon-o-archive-box')
                        ->requiresConfirmation()
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => 'Draft'])))
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->requiresConfirmation()
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => 'Tidak Aktif'])))
                        ->deselectRecordsAfterCompletion(),
                    ExportBulkAction::make()
                        ->exporter(JobapplicationExporter::class),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Lowongan Kerja')
                    ->description()
                    ->schema([
                        Split::make([
                            Section::make([
                                ImageEntry::make('image')
                                    ->hiddenLabel()
                                    ->url(fn($record) => $record->image
                                        ? asset('storage/' . $record->image)
                                        : asset('storage/default/logoDG1.png'))
                                    ->circular(),
                                TextEntry::make('created_at')
                                    ->badge()
                                    ->dateTime(),
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'Draft' => 'gray',
                                        'Aktif' => 'success',
                                        'Tidak Aktif' => 'danger',
                                    }),
                            ])->grow(false),
                            Section::make([
                                Fieldset::make('Informasi Lowongan Kerja')
                                    ->schema([
                                        TextEntry::make('title')
                                            ->label('Judul'),
                                        TextEntry::make('location')
                                            ->label('Lokasi'),
                                        TextEntry::make('hour_type')
                                            ->badge()
                                            ->label('Jenis Pekerjaan'),
                                        TextEntry::make('employment_type')
                                            ->badge()
                                            ->label('Tipe Pekerjaan'),
                                        TextEntry::make('salary_min')
                                            ->label('Gaji Minimum')
                                            ->money('IDR', 0),
                                        TextEntry::make('salary_max')
                                            ->label('Gaji Maksimum')
                                            ->money('IDR', 0),

                                    ])->columns(3),
                                Fieldset::make('Persyaratan Pekerjaan')
                                    ->schema([
                                        TextEntry::make('gender')
                                            ->label('Jenis Kelamin'),
                                        TextEntry::make('age_level')
                                            ->label('Usia'),
                                        TextEntry::make('education_level')
                                            ->label('Pendidikan Terakhir'),
                                        TextEntry::make('experience_year')
                                            ->label('Pengalaman Kerja'),
                                    ]),
                                Fieldset::make('Deskripsi Pekerjaan')
                                    ->schema([
                                        TextEntry::make('description')
                                            ->hiddenLabel()
                                            ->columnSpan(3)
                                            ->markdown(),
                                    ])->columns(3),
                            ]),
                        ])->from('md'),
                    ]),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobapplications::route('/'),
            'create' => Pages\CreateJobapplication::route('/create'),
            'edit' => Pages\EditJobapplication::route('/{record}/edit'),
            'view' => Pages\ViewJobapplication::route('/{record}'),
            'activities' => Pages\ListJobapplicationActivities::route('/{record}/activities'),
        ];
    }
}
