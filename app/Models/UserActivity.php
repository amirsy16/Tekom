<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'ip_address',
        'user_agent',
        'url',
        'method',
        'old_values',
        'new_values',
        'performed_at',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'performed_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByModule($query, string $module)
    {
        return $query->where('module', $module);
    }

    public function scopeByAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('performed_at', '>=', now()->subDays($days));
    }

    // Accessors
    public function getFormattedPerformedAtAttribute(): string
    {
        return $this->performed_at->format('d/m/Y H:i:s');
    }

    public function getActionBadgeAttribute(): string
    {
        return match($this->action) {
            'created' => 'success',
            'updated' => 'info',
            'deleted' => 'danger',
            'viewed' => 'secondary',
            'login' => 'success',
            'logout' => 'warning',
            default => 'primary'
        };
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            if (empty($activity->performed_at)) {
                $activity->performed_at = now();
            }
        });
    }
}