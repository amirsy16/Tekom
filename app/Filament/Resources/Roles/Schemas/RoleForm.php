<?php

namespace App\Filament\Resources\Roles\Schemas;

use App\Models\Permission;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Peran')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),
                
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Identifier unik untuk peran (auto-generate dari nama)')
                    ->columnSpan(1),
                
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required()
                    ->columnSpan(2),
                
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->maxLength(65535)
                    ->placeholder('Masukkan deskripsi peran...')
                    ->columnSpanFull(),

                CheckboxList::make('permissions')
                    ->label('Atur Hak Akses')
                    ->relationship('permissions', 'name')
                    ->options(function () {
                        return Permission::active()
                            ->orderBy('module')
                            ->orderBy('name')
                            ->get()
                            ->mapWithKeys(function ($permission) {
                                return [$permission->id => ucfirst($permission->module) . ': ' . $permission->name];
                            })
                            ->toArray();
                    })
                    ->descriptions(function () {
                        return Permission::active()
                            ->get()
                            ->pluck('description', 'id')
                            ->toArray();
                    })
                    ->columns(2)
                    ->gridDirection('row')
                    ->bulkToggleable()
                    ->searchable()
                    ->columnSpanFull()
                    ->helperText('Pilih hak akses yang akan diberikan kepada peran ini'),
            ])
            ->columns(2);
    }
}
