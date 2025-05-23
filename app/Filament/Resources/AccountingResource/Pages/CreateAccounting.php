<?php

namespace App\Filament\Resources\AccountingResource\Pages;

use App\Filament\Resources\AccountingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccounting extends CreateRecord
{
    protected static string $resource = AccountingResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id(); // pega o usuário autenticado
        return $data;
    }
    
}
