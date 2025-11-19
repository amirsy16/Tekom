<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->copyMessageDuration(1500),
                TextColumn::make('organization.name')
                    ->label('Satuan Kerja')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('roles.name')
                    ->label('Peran')
                    ->badge()
                    ->color('primary')
                    ->separator(','),
                TextColumn::make('email_verified_at')
                    ->label('Status Verifikasi')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Belum Terverifikasi')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn ($state) => $state ? 'Terverifikasi' : 'Belum Terverifikasi'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->label('Peran')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                
                SelectFilter::make('organization')
                    ->label('Satuan Kerja')
                    ->relationship('organization', 'name')
                    ->searchable()
                    ->preload(),
                
                TernaryFilter::make('email_verified_at')
                    ->label('Status Verifikasi')
                    ->placeholder('Semua Status')
                    ->trueLabel('Terverifikasi')
                    ->falseLabel('Belum Terverifikasi')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('email_verified_at'),
                        false: fn (Builder $query) => $query->whereNull('email_verified_at'),
                    ),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat'),
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }
}
