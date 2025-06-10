<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialResource\Pages;
use App\Filament\Resources\FinancialResource\RelationManagers;
use App\Models\Financial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select; // Adicione esta linha
use App\Filament\Resources\Company;
use App\Filament\Resources\User;


class FinancialResource extends Resource
{
    protected static ?string $model = Financial::class;

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
             'Tipo 1' => 'Fixo',
             'Tipo 2' => 'Variável',
             'Tipo 3' => 'Extraórdinário',
             ])
             ->required()
             ->label('Tipo'),
             Forms\Components\Textarea::make('description')
                ->required()
                ->label('Descrição'),
                Forms\Components\TextInput::make('value')
                ->numeric()
                ->prefix('R$ ')
                ->label('Valor de entrada'),
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
                //
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
            'index' => Pages\ListFinancials::route('/'),
            'create' => Pages\CreateFinancial::route('/create'),
            'edit' => Pages\EditFinancial::route('/{record}/edit'),
        ];
    }
}
