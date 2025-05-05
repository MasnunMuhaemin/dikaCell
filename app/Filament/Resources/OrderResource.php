<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('order_date'),
                TextInput::make('total_price'),
                ToggleButtons::make('status')
                    ->label('Status Order')
                    ->inline()
                    ->default('pending')
                    ->options([
                        'completed' => 'Dikonfirmasi',
                        'processing' => 'Diproses',
                        'pending' => 'Menunggu Konfirmasi',
                        'cancelled' => 'Di Batalkan',

                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'processing' => 'heroicon-o-check-circle',
                        'completed' => 'heroicon-o-check-circle',
                        'cancelled' => 'heroicon-o-x-circle',
                    ])
                    ->colors([
                        'pending' => 'warning',
                        'processing' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('order_date'),
                TextColumn::make('total_price'),
                TextColumn::make('status')
                    ->label('Status Order')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'completed' => 'Dikonfirmasi',
                            'processing' => 'Diproses',
                            'pending' => 'Menunggu Konfirmasi',
                            'cancelled' => 'Di batalkan'
                        };
                    })
                    ->colors([
                        'pending' => 'warning',
                        'pcompleted' => 'success',
                        'processing' => 'success',
                        'cancelled' => 'danger',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
