<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovementResource\Pages;
use App\Filament\Resources\MovementResource\RelationManagers;
use App\Models\Movement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class MovementResource extends Resource
{
    protected static ?string $model = Movement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('type')
                    ->options([
                        'entrada' => 'Entrada',
                        'salida' => 'Salida',
                        'ajuste' => 'Ajuste'
                    ])
                    ->inline()
                    ->label('Tipo de Movimiento')
                    ->default('entrada')
                    ->required(),
                Select::make('product_id')
                    ->preload()
                    ->searchable()
                    ->relationship('product','name')
                    ->required()
		    ->label('Producto'),
                TextInput::make('stock')
                    ->label('Cantidad')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('person')
                    ->required()
                    ->maxLength(255)
                    ->default(null)
		    ->label('Persona'),
                Textarea::make('notes')
                    ->columnSpanFull()
		    ->label('Notas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
	    ->defaultPaginationPageOption(50)
            ->columns([
                Tables\Columns\TextColumn::make('type')
		    ->label('Tipo'),
                Tables\Columns\TextColumn::make('product.name')
                    ->sortable()
		    ->label('Producto'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
		    ->label('Cantidad'),
                Tables\Columns\TextColumn::make('person')
                    ->searchable()
		    ->label('Persona'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                ->options([
                    'entrada' => 'Entrada',
                    'salida' => 'Salida',
                    'ajuste' => 'Ajuste',
                ])
                ->label('Tipo')
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
            'index' => Pages\ListMovements::route('/'),
            'create' => Pages\CreateMovement::route('/create'),
            'edit' => Pages\EditMovement::route('/{record}/edit'),
        ];
    }

    public static function getNavigationIcon(): string {
        return 'heroicon-o-clipboard';
    }
    public static function getNavigationsort(): int {
        return 2;
    }
    public static function getLabel(): string
    {
        return 'Movimientos';
    }
}
