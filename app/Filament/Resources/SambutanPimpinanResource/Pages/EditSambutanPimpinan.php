<?php

namespace App\Filament\Resources\SambutanPimpinanResource\Pages;

use App\Filament\Resources\SambutanPimpinanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSambutanPimpinan extends EditRecord
{
    protected static string $resource = SambutanPimpinanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
