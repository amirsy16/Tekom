<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_code',
        'organization_id',
        'unit',
        'site_id',
        'equipment_type_id',
        'serial_number',
        'installation_year',
        'condition',
        'quantity',
        'purchase_price',
        'last_maintenance',
        'next_maintenance',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'installation_year' => 'integer',
        'quantity' => 'integer',
        'purchase_price' => 'decimal:2',
        'last_maintenance' => 'date',
        'next_maintenance' => 'date',
    ];

    // Relationships
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function equipmentType(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('inventories.is_active', true);
    }

    public function scopeByCondition($query, $condition)
    {
        return $query->where('condition', $condition);
    }

    public function scopeNeedsMaintenance($query)
    {
        return $query->where('next_maintenance', '<=', now());
    }

    // Accessors
    public function getConditionLabelAttribute(): string
    {
        return match($this->condition) {
            'BB' => 'Baik',
            'RR' => 'Rusak Ringan',
            'RB' => 'Rusak Berat',
            default => 'Unknown'
        };
    }

    public function getConditionBadgeAttribute(): string
    {
        return match($this->condition) {
            'BB' => 'success',
            'RR' => 'warning', 
            'RB' => 'danger',
            default => 'secondary'
        };
    }

    public function getAgeYearsAttribute(): int
    {
        return now()->year - $this->installation_year;
    }

    public function getMaintenanceStatusAttribute(): string
    {
        if (!$this->next_maintenance) return 'Belum Dijadwalkan';
        
        $days = now()->diffInDays($this->next_maintenance, false);
        
        if ($days < 0) return 'Terlambat';
        if ($days <= 7) return 'Segera';
        if ($days <= 30) return 'Bulan Ini';
        
        return 'Terjadwal';
    }

    // Boot method untuk auto-generate asset code
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($inventory) {
            if (empty($inventory->asset_code)) {
                $year = now()->year;
                $count = static::whereYear('created_at', $year)->count() + 1;
                $inventory->asset_code = 'ALK-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
