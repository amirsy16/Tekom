<?php

namespace App\Filament\Resources\EquipmentTypes\Tables;

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

class EquipmentTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'REPEATER' => 'success',
                        'RADIO FIXED', 'RADIO_FIXED' => 'info',
                        'RADIO MOBILE', 'RADIO_MOBILE' => 'warning',
                        'HT', 'HANDY_TALKY' => 'danger',
                        'ANDROID' => 'primary',
                        'ROUTER' => 'gray',
                        'RGU' => 'purple',
                        'TOWER' => 'indigo',
                        'SHELTER' => 'cyan',
                        default => 'gray',
                    }),
                TextColumn::make('brand')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'REPEATER' => 'Repeater',
                        'RADIO FIXED' => 'Radio Fixed',
                        'RADIO MOBILE' => 'Radio Mobile',
                        'HT' => 'HT (Handy Talky)',
                        'ANDROID' => 'Android',
                        'ROUTER' => 'Router',
                        'RGU' => 'RGU',
                        'TOWER' => 'Tower',
                        'SHELTER' => 'Shelter',
                        'VEHICLE' => 'Vehicle',
                        'DRONE' => 'Drone',
                        'TRUNKING' => 'Trunking',
                    ])
                    ->multiple()
                    ->searchable(),
                
                SelectFilter::make('brand')
                    ->label('Brand')
                    ->options(function () {
                        return \App\Models\EquipmentType::query()
                            ->whereNotNull('brand')
                            ->where('brand', '!=', '')
                            ->distinct()
                            ->pluck('brand', 'brand')
                            ->toArray();
                    })
                    ->searchable(),
                
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
