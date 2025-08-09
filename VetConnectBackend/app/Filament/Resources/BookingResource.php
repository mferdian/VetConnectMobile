<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('vet_id')
                    ->relationship('vet', 'nama')
                    ->required(),
                Select::make('vet_date_id')
                    ->relationship('vetDate', 'tanggal')
                    ->required(),
                Select::make('vet_time_id')
                    ->relationship('vetTime', 'jam_mulai')
                    ->required(),
                Textarea::make('keluhan')
                    ->nullable(), // karena di migration juga nullable
                TextInput::make('total_harga')
                    ->numeric()
                    ->prefix('Rp ')
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'canceled' => 'Canceled',
                    ])
                    ->required(),
                Select::make('status_bayar')
                    ->options([
                        'berhasil' => 'Berhasil',
                        'gagal' => 'Gagal',
                        'pending' => 'Pending',
                    ])
                    ->required(),
                Select::make('metode_pembayaran')
                    ->options([
                        'transfer_bank' => 'Transfer Bank',
                        'e-wallet' => 'E-Wallet',
                        'cash' => 'Cash',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                TextInput::make('order_id')
                    ->required()
                    ->unique(Booking::class, 'order_id')
                    ->readOnlyOn('edit')
                    ->default(fn() => Booking::generateUniqueOrderId()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('vet.nama')->label('Dokter'),
                Tables\Columns\TextColumn::make('vetDate.tanggal')->label('Tanggal'),
                Tables\Columns\TextColumn::make('vetTime.jam')->label('Jam'),
                Tables\Columns\TextColumn::make('total_harga')
                    ->money('IDR')
                    ->label('Total Harga'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('status_bayar')->label('Status Bayar'),
                Tables\Columns\TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                Tables\Columns\TextColumn::make('order_id')->label('Order ID'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
