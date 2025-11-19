<?php

namespace App\Filament\Resources\Sites\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Schemas\Schema;

class TowersRelationManager extends RelationManager
{
    protected static string $relationship = 'towers';

    protected static ?string $recordTitleAttribute = 'repeater_type';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('repeater_type')
                ->label('Tipe Repeater')
                ->required()
                ->maxLength(255),
            Select::make('system')
                ->label('Sistem')
                ->options([
                    'CONV' => 'Konvensional',
                    'TRUNKING' => 'Trunking',
                    'DATA' => 'Data',
                ])
                ->native(false)
                ->searchable(),
            TextInput::make('frequency_rx')
                ->label('Frekuensi RX (MHz)')
                ->maxLength(32)
                ->placeholder('855.8125')
                ->helperText('Gunakan titik untuk desimal, contoh 855.8125'),
            TextInput::make('frequency_tx')
                ->label('Frekuensi TX (MHz)')
                ->maxLength(32)
                ->placeholder('810.8125')
                ->helperText('Gunakan titik untuk desimal, contoh 810.8125'),
            TextInput::make('tower_structure')
                ->label('Jenis Tower')
                ->maxLength(50),
            TextInput::make('tower_height')
                ->label('Tinggi Tower')
                ->maxLength(50),
            Select::make('site_status')
                ->label('Pemilik Site')
                ->options([
                    'POLRI' => 'POLRI',
                    'TELKOM' => 'TELKOM',
                    'TVRI' => 'TVRI',
                    'INDOSAT' => 'INDOSAT',
                    'SWASTA' => 'SWASTA',
                    'LAINNYA' => 'LAINNYA',
                ])
                ->native(false)
                ->searchable(),
            TextInput::make('condition_bb')
                ->label('Kondisi BB')
                ->numeric()
                ->minValue(0)
                ->placeholder('1'),
            TextInput::make('condition_rr')
                ->label('Kondisi RR')
                ->numeric()
                ->minValue(0)
                ->placeholder('0'),
            TextInput::make('condition_rb')
                ->label('Kondisi RB')
                ->numeric()
                ->minValue(0)
                ->placeholder('0'),
            TextInput::make('user')
                ->label('Pengguna')
                ->maxLength(255),
            TextInput::make('documentation')
                ->label('Dokumentasi')
                ->maxLength(255),
            Textarea::make('notes')
                ->label('Keterangan')
                ->maxLength(1000)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('repeater_type')
            ->columns([
                TextColumn::make('repeater_type')
                    ->label('Repeater')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('system')
                    ->label('Sistem')
                    ->badge()
                    ->sortable(),
                TextColumn::make('frequency_rx')
                    ->label('Frekuensi RX/TX (MHz)')
                    ->formatStateUsing(fn ($state, $record) => implode(' / ', array_filter([
                        $record->frequency_rx,
                        $record->frequency_tx,
                    ])) ?: '-')
                    ->sortable(),
                TextColumn::make('tower_structure')
                    ->label('Tower / Tinggi')
                    ->formatStateUsing(fn ($state, $record) => implode(' • ', array_filter([
                        $record->tower_structure,
                        $record->tower_height,
                    ])) ?: '-')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('site_status')
                    ->label('Pemilik')
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('condition_summary')
                    ->label('Kondisi')
                    ->toggleable(),
                TextColumn::make('user')
                    ->label('Pengguna')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('documentation')
                    ->label('Dokumentasi')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
