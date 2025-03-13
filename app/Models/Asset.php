<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'asset_code',
        'description',
        'category',
        'status',
        'purchase_price',
        'purchase_date',
        'warranty_expiry_date',
        'location',
        'manufacturer',
        'model',
        'serial_number',
        'department_id',
        'assigned_to'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry_date' => 'date',
        'purchase_price' => 'decimal:2'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}