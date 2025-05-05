<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
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

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('payment_date'),
                TextInput::make('amount'),
                Select::make('order_id')
                    ->relationship('order', 'order_date'),
                ToggleButtons::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->inline()
                    ->options([
                        'transfer' => 'Transfer',
                        'COD' => 'COD',
                        'e-wallet' => 'Dompet Digital',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'canceled' => 'heroicon-o-x-circle',
                    ])
                    ->colors([
                        'transfer' => 'warning',
                        'COD' => 'success',
                        'e-wallet' => 'danger',
                    ]),
                ToggleButtons::make('payment_status')
                    ->label('Status Pembayaran')
                    ->inline()
                    ->default('pending')
                    ->options([
                        'pendig' => 'Menunggu Pembayaran',
                        'paid' => 'Dibayar',
                        'failed' => 'gagal',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'failed' => 'heroicon-o-x-circle',
                    ])
                    ->colors([
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('payment_date'),
                TextColumn::make('amount'),
                TextColumn::make('order.order_date'),
                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                        'transfer' => 'Transfer',
                        'COD' => 'COD',
                        'e-wallet' => 'Dompet Digital',
                        };
                    })
                    ->colors([
                        'transfer' => 'warning',
                        'COD' => 'success',
                        'e-wallet' => 'danger',
                    ]),
                TextColumn::make('payment_status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                        'pending' => 'Menunggu Pembayaran',
                        'paid' => 'Dibayar',
                        'failed' => 'gagal',
                        };
                    })
                    ->colors([
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'failed' => 'danger',
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
