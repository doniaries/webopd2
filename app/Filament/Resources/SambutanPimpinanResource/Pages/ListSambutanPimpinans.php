<?php

namespace App\Filament\Resources\SambutanPimpinanResource\Pages;

use App\Filament\Resources\SambutanPimpinanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSambutanPimpinans extends ListRecords
{
    protected static string $resource = SambutanPimpinanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
