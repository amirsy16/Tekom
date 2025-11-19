<?php

namespace App\Filament\Resources\Sites\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SitesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->label('Satuan Kerja')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Site')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('towers_count')
                    ->label('Tower')
                    ->counts('towers')
                    ->badge()
                    ->sortable(),
                TextColumn::make('ownership')
                    ->label('Status Site')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location')
                    ->label('Alamat / Koordinat')
                    ->wrap()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('organization')
                    ->label('Satuan Kerja')
                    ->relationship('organization', 'name')
                    ->searchable()
                    ->preload(),
                
                SelectFilter::make('ownership')
                    ->label('Status Kepemilikan')
                    ->options([
                        'POLRI' => 'POLRI',
                        'SEWA' => 'Sewa',
                        'KERJASAMA' => 'Kerjasama',
                        'HIBAH' => 'Hibah',
                        'PINJAM_PAKAI' => 'Pinjam Pakai',
                    ])
                    ->searchable(),
                
                SelectFilter::make('region')
                    ->label('Wilayah')
                    ->options(function () {
                        return \App\Models\Site::query()
                            ->whereNotNull('region')
                            ->where('region', '!=', '')
                            ->distinct()
                            ->pluck('region', 'region')
                            ->toArray();
                    })
                    ->searchable(),
                
                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_active', true),
                        false: fn (Builder $query) => $query->where('is_active', false),
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
