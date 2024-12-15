<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Jobapplication;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JobapplicationResource\Pages;
use App\Filament\Resources\JobapplicationResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

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
                                'Tidak Aktif' => 'Tidak Aktif',
                            ])
                            ->required()
                            ->default('Aktif')
                            ->searchable()
                            ->preload(),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->preserveFilenames()
                            ->maxSize(1024)
                            ->openable()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
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
                    ->url(fn($record) => asset('storage/' . $record->image)),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('hour_type'),
                Tables\Columns\TextColumn::make('employment_type')
                    ->formatStateUsing(fn($state): string => Str::headline($state)),
                Tables\Columns\TextColumn::make('salary_min')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('salary_max')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => $state === 'Aktif' ? 'success' : ($state === 'Tidak Aktif' ? 'danger' : 'secondary')),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
        ];
    }
}
