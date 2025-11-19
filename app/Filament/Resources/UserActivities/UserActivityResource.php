<?php

namespace App\Filament\Resources\UserActivities;

use App\Filament\Resources\UserActivities\Pages\CreateUserActivity;
use App\Filament\Resources\UserActivities\Pages\EditUserActivity;
use App\Filament\Resources\UserActivities\Pages\ListUserActivities;
use App\Filament\Resources\UserActivities\Pages\ViewUserActivity;
use App\Filament\Resources\UserActivities\Schemas\UserActivityForm;
use App\Filament\Resources\UserActivities\Schemas\UserActivityInfolist;
use App\Filament\Resources\UserActivities\Tables\UserActivitiesTable;
use App\Models\UserActivity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UserActivityResource extends Resource
{
    protected static ?string $model = UserActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'description';

    protected static ?string $navigationLabel = 'Aktivitas Pengguna';

    protected static ?string $modelLabel = 'Aktivitas Pengguna';

    protected static ?string $pluralModelLabel = 'Aktivitas Pengguna';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen User';

    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with(['user']);
    }

    public static function form(Schema $schema): Schema
    {
        return UserActivityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserActivityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserActivitiesTable::configure($table);
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
            'index' => ListUserActivities::route('/'),
            'create' => CreateUserActivity::route('/create'),
            'view' => ViewUserActivity::route('/{record}'),
            'edit' => EditUserActivity::route('/{record}/edit'),
        ];
    }
}
