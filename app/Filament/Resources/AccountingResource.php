<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountingResource\Pages;
use App\Filament\Resources\AccountingResource\RelationManagers;
use App\Models\Accounting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Company;


class AccountingResource extends Resource
{
    protected static ?string $model = Accounting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
                Forms\Components\Select::make('user_id') // Adicione este campo
                ->relationship('user', 'name') // Assumindo que você tem uma relação 'user' no modelo Accounting e quer exibir o 'name' do usuário
                ->required()
                ->label('Responsável'),
                Forms\Components\Select::make('company_id')
                ->relationship('company', 'name')
                ->required()
                ->label('Empresa'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('Descrição'),
         Forms\Components\Select::make('type')
                ->required()
                ->options([
                    'Entrada' => 'Entrada',
                    'Saída' => 'Saída',
                ])
                ->label('Tipo'),
            Forms\Components\TextInput::make('value')
                ->numeric()
                ->prefix('R$ ')
                ->label('Valor de entrada'),
            Forms\Components\TextInput::make('amount')
                ->required()
                ->numeric()
                ->prefix('R$ ')
                ->label('Quantia Total'),
            Forms\Components\DatePicker::make('date')
                ->required()
                ->label('Data entrada'),
            Forms\Components\DatePicker::make('competence_month')
                ->required()
                ->label('Vencimento'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
 Tables\Columns\TextColumn::make('description')
 ->label('Nome'),
 Tables\Columns\TextColumn::make('date')
 ->label('Data'),
 Tables\Columns\TextColumn::make('value')
 ->label('Valor'),
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
            'index' => Pages\ListAccountings::route('/'),
            'create' => Pages\CreateAccounting::route('/create'),
            'edit' => Pages\EditAccounting::route('/{record}/edit'),
        ];
    }
}
