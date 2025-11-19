<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'region',
        'location',
        'ownership',
        'tower_height',
        'latitude',
        'longitude',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relationships
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function towers(): HasMany
    {
        return $this->hasMany(Tower::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByOwnership($query, $ownership)
    {
        return $query->where('ownership', $ownership);
    }

    // Accessors
    public function getFullLocationAttribute(): string
    {
        return "{$this->name} ({$this->location})";
    }

    public function getCoordinatesAttribute(): ?string
    {
        if ($this->latitude && $this->longitude) {
            return "{$this->latitude}, {$this->longitude}";
        }
        return null;
    }
}
