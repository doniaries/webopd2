<?php

namespace App\Filament\Resources\RoleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('permissions')
                    ->relationship('permissions', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Permission')
                    ->formatStateUsing(fn (string $state): string => __(str($state)->headline()))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->whereDoesntHave('roles', function ($query) {
                        $query->where('id', $this->getOwnerRecord()->id);
                    })),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->hidden(fn ($record) => $this->getOwnerRecord()->name === 'super_admin'),
            ]);
    }
}
