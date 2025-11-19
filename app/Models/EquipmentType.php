<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'brand',
        'specifications',
        'warranty_months',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'warranty_months' => 'integer',
    ];

    // Relationships
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('equipment_types.is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return $this->brand ? "{$this->brand} {$this->name}" : $this->name;
    }

    public function getWarrantyYearsAttribute(): float
    {
        return round($this->warranty_months / 12, 1);
    }
}
