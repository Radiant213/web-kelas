<?php

namespace App\Filament\Resources\ClassStructures\Pages;

use App\Filament\Resources\ClassStructures\ClassStructureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageClassStructures extends ManageRecords
{
    protected static string $resource = ClassStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
