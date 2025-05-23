<?php

namespace App\Filament\Resources\CartsResource\Pages;

use App\Filament\Resources\CartsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCarts extends ViewRecord
{
    protected static string $resource = CartsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
