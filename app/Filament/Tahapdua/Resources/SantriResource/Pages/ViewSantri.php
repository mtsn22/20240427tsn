<?php

namespace App\Filament\Tahapdua\Resources\SantriResource\Pages;

use App\Filament\Tahapdua\Resources\SantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSantri extends ViewRecord
{
    protected static string $resource = SantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
