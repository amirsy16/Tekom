<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tower extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'repeater_type',
        'system',
        'frequency_rx',
        'frequency_tx',
        'site_status',
        'tower_structure',
        'tower_height',
        'condition_bb',
        'condition_rr',
        'condition_rb',
        'documentation',
        'user',
        'notes',
    ];

    protected $casts = [
        'condition_bb' => 'integer',
        'condition_rr' => 'integer',
        'condition_rb' => 'integer',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function getConditionSummaryAttribute(): string
    {
        $parts = [];

        if (!is_null($this->condition_bb)) {
            $parts[] = 'BB: ' . $this->condition_bb;
        }
        if (!is_null($this->condition_rr)) {
            $parts[] = 'RR: ' . $this->condition_rr;
        }
        if (!is_null($this->condition_rb)) {
            $parts[] = 'RB: ' . $this->condition_rb;
        }

        return implode(', ', $parts);
    }
}
