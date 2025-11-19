<?php

namespace App\Http\Middleware;

use App\Services\ActivityLogService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log for authenticated users and specific routes
        if (Auth::check() && $this->shouldLog($request)) {
            $this->logActivity($request, $response);
        }

        return $response;
    }

    private function shouldLog(Request $request): bool
    {
        // Log only important admin activities
        $route = $request->route()?->getName();
        
        if (!$route) {
            return false;
        }

        // Log Filament admin activities
        if (str_starts_with($route, 'filament.admin.')) {
            // Skip dashboard and asset requests
            if (str_contains($route, 'dashboard') || 
                str_contains($route, 'asset') ||
                str_contains($route, 'livewire')) {
                return false;
            }
            
            return true;
        }

        return false;
    }

    private function logActivity(Request $request, Response $response): void
    {
        $route = $request->route()?->getName();
        $method = $request->method();
        
        // Skip non-successful responses
        if ($response->getStatusCode() >= 400) {
            return;
        }

        try {
            $this->determineAndLogAction($route, $method, $request);
        } catch (\Exception $e) {
            // Silent fail for logging errors
            logger()->error('Activity logging failed: ' . $e->getMessage());
        }
    }

    private function determineAndLogAction(string $route, string $method, Request $request): void
    {
        $routeParts = explode('.', str_replace('filament.admin.resources.', '', $route));
        
        if (count($routeParts) < 2) {
            return;
        }

        $resource = $routeParts[0];
        $action = $routeParts[1] ?? '';

        $resourceNames = [
            'inventories' => 'Inventaris',
            'sites' => 'Site',
            'towers' => 'Tower',
            'organizations' => 'Organisasi',
            'equipment-types' => 'Jenis Perangkat',
            'users' => 'User',
            'roles' => 'Role',
            'permissions' => 'Permission',
            'reports' => 'Laporan'
        ];

        $resourceName = $resourceNames[$resource] ?? ucfirst($resource);
        
        $description = match($action) {
            'index' => "Mengakses halaman daftar {$resourceName}",
            'create' => "Mengakses form tambah {$resourceName}",
            'edit' => "Mengakses form edit {$resourceName}",
            'view' => "Melihat detail {$resourceName}",
            default => "Mengakses {$resourceName} - {$action}"
        };

        ActivityLogService::log(
            action: $action,
            description: $description,
            module: $resource,
            request: $request
        );
    }
}
