<?php

namespace App\Filament\Resources\Towers;

use App\Filament\Resources\Towers\Pages\CreateTower;
use App\Filament\Resources\Towers\Pages\EditTower;
use App\Filament\Resources\Towers\Pages\ListTowers;
use App\Filament\Resources\Towers\Pages\ViewTower;
use App\Filament\Resources\Towers\Schemas\TowerForm;
use App\Filament\Resources\Towers\Schemas\TowerInfolist;
use App\Filament\Resources\Towers\Tables\TowersTable;
use App\Models\Tower;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TowerResource extends Resource
{
    protected static ?string $model = Tower::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rss';

    protected static ?string $navigationLabel = 'Tower Repeater';

    protected static ?string $pluralModelLabel = 'Tower Repeater';

    protected static ?string $modelLabel = 'Tower';

    protected static ?int $navigationSort = 25;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with(['site']);
    }

    public static function form(Schema $schema): Schema
    {
        return TowerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TowerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TowersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTowers::route('/'),
            'create' => CreateTower::route('/create'),
            'view' => ViewTower::route('/{record}'),
            'edit' => EditTower::route('/{record}/edit'),
        ];
    }
}
