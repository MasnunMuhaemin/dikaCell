<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Filament\Resources\ShipmentResource\RelationManagers;
use App\Models\Shipment;
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

class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                Select::make('order_id')
                    ->relationship('order', 'total_price'),
                TextInput::make('shipment_date'),
                TextInput::make('alamat_lengkap'),
                TextInput::make('kota'),
                TextInput::make('kecamatan'),
                TextInput::make('desa'),
                TextInput::make('kode_pos'),
                TextInput::make('shipping_cost'),
                ToggleButtons::make('shipping_status')
                    ->label('Status')
                    ->inline()
                    ->default('belum dikirim')
                    ->options([
                        'belum dikirim' => 'Belum Dikirim',
                        'dikirim' => 'Dikirim',
                        'diterima' => 'Diterima',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'canceled' => 'heroicon-o-x-circle',
                    ])
                    ->colors([
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'canceled' => 'danger',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('order.total_price'),
                TextColumn::make('shipment_date'),
                TextColumn::make('alamat_lengkap'),
                TextColumn::make('kota'),
                TextColumn::make('kecamatan'),
                TextColumn::make('desa'),
                TextColumn::make('kode_pos'),
                TextColumn::make('shipping_cost'),
                TextColumn::make('shipping_status')
                    ->label('Status Paket')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'belum dikirim' => 'Belum Dikirim',
                            'dikirim' => 'Dikirim',
                            'diterima' => 'Diterima',
                        };
                    })
                    ->colors([
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'canceled' => 'danger',
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
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'view' => Pages\ViewShipment::route('/{record}'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
        ];
    }
}
