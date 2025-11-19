<?php

namespace App\Filament\Resources\Towers\Tables;

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

class TowersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site.name')
                    ->label('Site')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('repeater_type')
                    ->label('Tipe Repeater')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('system')
                    ->label('Sistem')
                    ->badge()
                    ->sortable(),
                TextColumn::make('frequency_rx')
                    ->label('RX (MHz)')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('frequency_tx')
                    ->label('TX (MHz)')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('tower_structure')
                    ->label('Tower')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('tower_height')
                    ->label('Tinggi')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('site_status')
                    ->label('Pemilik')
                    ->badge()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('condition_summary')
                    ->label('Kondisi')
                    ->wrap()
                    ->toggleable(),
                TextColumn::make('user')
                    ->label('Pengguna')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('site.is_active')
                    ->label('Site Aktif')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name')
                    ->searchable()
                    ->preload(),
                
                SelectFilter::make('system')
                    ->label('Sistem')
                    ->options([
                        'CONV' => 'Konvensional',
                        'TRUNKING' => 'Trunking',
                        'DATA' => 'Data',
                    ]),
                
                SelectFilter::make('site_status')
                    ->label('Pemilik')
                    ->options([
                        'POLRI' => 'POLRI',
                        'TELKOM' => 'TELKOM',
                        'TVRI' => 'TVRI',
                        'INDOSAT' => 'INDOSAT',
                        'SWASTA' => 'SWASTA',
                        'LAINNYA' => 'LAINNYA',
                    ]),
                
                SelectFilter::make('tower_structure')
                    ->label('Struktur Tower')
                    ->options(function () {
                        return \App\Models\Tower::query()
                            ->whereNotNull('tower_structure')
                            ->where('tower_structure', '!=', '')
                            ->distinct()
                            ->pluck('tower_structure', 'tower_structure')
                            ->toArray();
                    })
                    ->searchable(),
                
                TernaryFilter::make('is_active')
                    ->label('Status Site Aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Site Aktif')
                    ->falseLabel('Site Tidak Aktif')
                    ->queries(
                        true: fn (Builder $query) => $query->whereHas('site', fn ($q) => $q->where('is_active', true)),
                        false: fn (Builder $query) => $query->whereHas('site', fn ($q) => $q->where('is_active', false)),
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
            ])
            ->defaultSort('site.name');
    }
}
