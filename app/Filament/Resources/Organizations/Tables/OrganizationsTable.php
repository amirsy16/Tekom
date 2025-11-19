<?php

namespace App\Filament\Resources\Organizations\Tables;

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

class OrganizationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Kode Satuan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Satuan Kerja')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                TextColumn::make('type')
                    ->label('Jenis Satuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'POLDA' => 'success',
                        'POLRESTA' => 'info',
                        'POLRES' => 'warning',
                        'POLSEK' => 'gray',
                        'SATUAN' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('parent.name')
                    ->label('Satuan Induk')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Tidak Ada'),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Jenis Satuan')
                    ->options([
                        'POLDA' => 'POLDA',
                        'POLRESTA' => 'POLRESTA',
                        'POLRES' => 'POLRES',
                        'POLSEK' => 'POLSEK',
                        'SATUAN' => 'SATUAN',
                    ])
                    ->multiple(),
                
                SelectFilter::make('parent_id')
                    ->label('Satuan Induk')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload(),
                
                TernaryFilter::make('is_active')
                    ->label('Status')
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
