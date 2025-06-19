<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanResource\Pages;
use App\Filament\Resources\PengaturanResource\RelationManagers;
use App\Models\Pengaturan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanResource extends Resource
{
    protected static ?string $model = Pengaturan::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Setting';
    protected static ?string $modelLabel = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Instansi')
                    ->schema([
                        Forms\Components\Hidden::make('nama_website')
                            ->default(fn($livewire) => 'Website ' . $livewire->record?->team?->name ?? 'Website')
                            ->dehydrated()
                            ->required(),
                        Forms\Components\Textarea::make('alamat_instansi')
                            ->required()
                            ->label('Alamat Instansi')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('no_telp_instansi')
                            ->required()
                            ->tel()
                            ->label('Nomor Telepon'),

                        Forms\Components\TextInput::make('email_instansi')
                            ->required()
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->label('Email Instansi'),

                        Forms\Components\FileUpload::make('logo_instansi')
                            ->image()
                            ->optimize('webp')
                            ->default('images/kabupaten-sijunjung.png')
                            ->required()
                            ->label('Logo Instansi'),

                        Forms\Components\FileUpload::make('favicon_instansi')
                            ->image()
                            ->default('images/favicon.png')
                            ->required()
                            ->label('Favicon Instansi'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_instansi')
                    ->hidden(),
                Tables\Columns\TextColumn::make('no_telp_instansi')
                    ->searchable()
                    ->label('No. Telp'),

                Tables\Columns\TextColumn::make('email_instansi')
                    ->searchable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('logo_instansi')
                    ->searchable()
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('favicon_instansi')
                    ->searchable()
                    ->label('Favicon'),
                Tables\Columns\TextColumn::make('facebook')
                    ->searchable()
                    ->label('Facebook'),
                Tables\Columns\TextColumn::make('twitter')
                    ->searchable()
                    ->label('Twitter'),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable()
                    ->label('Instagram'),
                Tables\Columns\TextColumn::make('youtube')
                    ->searchable()
                    ->label('Youtube'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add any filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // Add any relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturans::route('/'),
            'create' => Pages\CreatePengaturan::route('/create'),
            'edit' => Pages\EditPengaturan::route('/{record}/edit'),
        ];
    }
}
