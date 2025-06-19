<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SambutanPimpinanResource\Pages;
use App\Filament\Resources\SambutanPimpinanResource\RelationManagers;
use App\Models\SambutanPimpinan;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SambutanPimpinanResource extends Resource
{
    protected static ?string $model = SambutanPimpinan::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    protected static ?string $modelLabel = 'Sambutan Pimpinan';

    protected static ?string $navigationGroup = 'Instansi';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('team_id')
                    ->default(fn() => Auth::user()->current_team_id),

                Forms\Components\RichEditor::make('isi_sambutan')
                    ->label('Isi Sambutan')
                    ->required()
                    ->columnSpanFull()
                    ->hint('Tuliskan sambutan pimpinan di sini'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('team_id', Auth::user()->current_team_id))
            ->columns([
                Tables\Columns\TextColumn::make('isi_sambutan')
                    ->label('Isi Sambutan')
                    ->limit(100)
                    ->html()
                    ->wrap(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
            'index' => Pages\ListSambutanPimpinans::route('/'),
            'create' => Pages\CreateSambutanPimpinan::route('/create'),
            'edit' => Pages\EditSambutanPimpinan::route('/{record}/edit'),
        ];
    }
}
