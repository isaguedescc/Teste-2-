<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxResource\Pages;
use App\Filament\Resources\TaxResource\RelationManagers;
use App\Models\Tax;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaxResource extends Resource
{
    protected static ?string $model = Tax::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
             Forms\Components\Select::make('user_id')
             ->relationship('user', 'name') 
             ->required()
             ->label('Responsável'), 
             Forms\Components\Select::make('company_id')
             ->relationship('company', 'name') 
             ->required()
             ->label('Empresa'),
             Forms\Components\Select::make('type')
             ->options([
             'ISS' => 'ISS',
             'ICMS' => 'CMS',
             'IRPJ' => 'IRPJ',
             'IPI' => 'IPI',
             ])
             ->required()
             ->label('Tipo'),
             Forms\Components\TextInput::make('value')
             ->numeric()
             ->prefix('R$ ')
             ->label('Valor de entrada'),
             Forms\Components\DatePicker::make('due_date')
             ->required()
             ->label('Data entrada'),
             Forms\Components\DatePicker::make('competence_month')
             ->required()
             ->label('Vencimento'),
             Forms\Components\Select::make('status')
             ->options([
             'status 1' => 'Pendente',
             'status 2' => 'Pago',
             'status 3' => 'Vencido',
             ])
             ->required()
             ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('user_id')
                    ->searchable()
                    ->label('Responsável'),
                    
                    Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label('Status'),
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
            'index' => Pages\ListTaxes::route('/'),
            'create' => Pages\CreateTax::route('/create'),
            'edit' => Pages\EditTax::route('/{record}/edit'),
        ];
    }
}
