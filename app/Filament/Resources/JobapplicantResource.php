<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Jobapplicant;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JobapplicantResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use App\Filament\Resources\JobapplicantResource\RelationManagers;

class JobapplicantResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Jobapplicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Jobs Application';
    protected static ?string $slug = 'job-applicants';
    public static ?string $label = 'Applicants';
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
                Forms\Components\Section::make('Informasi Pelamar')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('age')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->numeric()
                            ->maxLength(3),
                        Forms\Components\TextInput::make('gender')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->numeric()
                            ->tel()
                            ->maxLength(15),
                        Forms\Components\TextInput::make('email')
                            ->unique(ignoreRecord: true)
                            ->email()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('address')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan(3),
                    ])
                    ->columns('3'),
                Forms\Components\Section::make('Pendidikan')
                    ->schema([
                        Forms\Components\TextInput::make('last_year_education')
                            ->label('Tahun')
                            ->required(),
                        Forms\Components\TextInput::make('last_level_education')
                            ->label('Level Pendidikan')
                            ->required(),
                        Forms\Components\TextInput::make('last_education')
                            ->label('Sekolah/Universitas')
                            ->required(),
                    ])
                    ->columns('3'),
                Forms\Components\Section::make('Riwayat Pekerjaan dan Keahlian')
                    ->schema([
                        Forms\Components\TextInput::make('last_year_position')
                            ->label('Tahun')
                            ->required(),
                        Forms\Components\TextInput::make('last_level_position')
                            ->label('Jabatan')
                            ->required(),
                        Forms\Components\TextInput::make('last_company')
                            ->label('Perusahaan')
                            ->required(),
                        Forms\Components\TextInput::make('experience')
                            ->required(),
                        Forms\Components\Select::make('on_working')
                            ->label('Masih Bekerja')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->options([
                                'yes' => 'Ya',
                                'no' => 'Tidak',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('skill')
                            ->label('Keahlian')
                            ->required(),
                    ])
                    ->columns('3'),
                Forms\Components\Section::make('Informasi Pekerjaan Yang Dilamar')
                    ->schema([
                        Forms\Components\Select::make('jobs_id')
                            ->relationship(name: 'jobapplications', titleAttribute: 'title')
                            ->label('Pekerjaan')
                            ->searchable()
                            ->preload()
                            ->disabled(),
                        Forms\Components\TextInput::make('salary')
                            ->label('Ekspektasi Gaji')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->options([
                                'New' => 'New',
                                'Interview' => 'Interview',
                                'Rejected' => 'Rejected',
                            ])
                            ->label('Status')
                            ->required(),
                    ])
                    ->columns('3'),
                Forms\Components\Section::make('File Attachment')
                    ->schema([
                        Forms\Components\FileUpload::make('cv')
                            ->required()
                            ->preserveFilenames()
                            ->maxSize(5120)
                            ->openable()
                            ->acceptedFileTypes(['application/pdf']),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->preserveFilenames()
                            ->maxSize(5120)
                            ->openable()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->circular()
                    ->url(fn($record) => asset('storage/' . $record->image)),
                Tables\Columns\TextColumn::make('jobapplications.title')
                    ->label('Job')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->extraAttributes(['class' => 'whitespace-wrap'])
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')
                    ->label('Umur')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('experience')
                    ->label('Pengalaman')
                    ->searchable(),
                Tables\Columns\TextColumn::make('on_working')
                    ->label('Sedang Bekerja')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn($state) => $state === 'yes' ? 'Ya' : ($state === 'no' ? 'Tidak' : '-'))
                    ->color(fn($state) => $state === 'yes' ? 'success' : ($state === 'no' ? 'info' : 'secondary')),
                Tables\Columns\TextColumn::make('salary')
                    ->label('Salary')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Melamar')
                    ->searchable()
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)->translatedFormat('d F Y H:i')),
            ])
            ->filters([
                SelectFilter::make('jobs_id')
                    ->relationship('jobapplications', 'title')
                    ->label('Lowongan Kerja')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = 'Created from ' . Carbon::parse($data['created_from'])->format('F d, Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = 'Created until ' . Carbon::parse($data['created_until'])->format('F d, Y');
                        }
                        return $indicators;
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('phone')
                    ->label('WA')
                    ->url(fn($record) => $record->phone ? 'https://wa.me/' . preg_replace('/\D/', '', $record->phone) : null) // Buat link WhatsApp
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-chat-bubble-oval-left')
                    ->color('success'),
                Tables\Actions\Action::make('cv')
                    ->label('CV')
                    ->url(fn($record) => $record->cv ? asset('storage/' . $record->cv) : null)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document')
                    ->color('primary'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->action(function ($record) {
                    // Hapus file dengan disk storage
                    if ($record->image && Storage::disk('public')->exists($record->image)) {
                        Storage::disk('public')->delete($record->image);
                    }

                    if ($record->cv && Storage::disk('public')->exists($record->cv)) {
                        Storage::disk('public')->delete($record->cv);
                    }

                    // Hapus data dari database
                    $record->delete();
                }),
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
            'index' => Pages\ListJobapplicants::route('/'),
            'create' => Pages\CreateJobapplicant::route('/create'),
            'edit' => Pages\EditJobapplicant::route('/{record}/edit'),
        ];
    }
}
