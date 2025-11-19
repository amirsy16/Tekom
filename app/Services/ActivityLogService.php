<?php

namespace App\Services;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    public static function log(
        string $action,
        string $description,
        ?string $module = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?Request $request = null
    ): void {
        $request = $request ?: request();
        
        UserActivity::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
            'url' => $request?->fullUrl(),
            'method' => $request?->method(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'performed_at' => now(),
        ]);
    }

    public static function logLogin(string $email): void
    {
        self::log(
            action: 'login',
            description: "User dengan email {$email} berhasil login",
            module: 'authentication'
        );
    }

    public static function logLogout(): void
    {
        $user = Auth::user();
        
        self::log(
            action: 'logout',
            description: "User {$user?->name} ({$user?->email}) logout dari sistem",
            module: 'authentication'
        );
    }

    public static function logCreate(string $model, string $name, ?string $module = null): void
    {
        self::log(
            action: 'created',
            description: "Membuat {$model} baru: {$name}",
            module: $module ?: self::getModuleFromModel($model)
        );
    }

    public static function logUpdate(string $model, string $name, array $oldValues = [], array $newValues = [], ?string $module = null): void
    {
        self::log(
            action: 'updated',
            description: "Mengupdate {$model}: {$name}",
            module: $module ?: self::getModuleFromModel($model),
            oldValues: $oldValues,
            newValues: $newValues
        );
    }

    public static function logDelete(string $model, string $name, ?string $module = null): void
    {
        self::log(
            action: 'deleted',
            description: "Menghapus {$model}: {$name}",
            module: $module ?: self::getModuleFromModel($model)
        );
    }

    public static function logView(string $model, string $name, ?string $module = null): void
    {
        self::log(
            action: 'viewed',
            description: "Melihat detail {$model}: {$name}",
            module: $module ?: self::getModuleFromModel($model)
        );
    }

    public static function logExport(string $type, ?string $module = null): void
    {
        self::log(
            action: 'exported',
            description: "Export data dalam format {$type}",
            module: $module ?: 'reports'
        );
    }

    private static function getModuleFromModel(string $model): string
    {
        return match(strtolower($model)) {
            'inventory', 'inventories' => 'inventories',
            'site', 'sites' => 'sites',
            'tower', 'towers' => 'towers',
            'organization', 'organizations' => 'organizations',
            'equipment type', 'equipment types', 'equipmenttype' => 'equipment-types',
            'user', 'users' => 'users',
            'role', 'roles' => 'roles',
            'permission', 'permissions' => 'permissions',
            default => 'system'
        };
    }
}