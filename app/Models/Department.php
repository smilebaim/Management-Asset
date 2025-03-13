<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'location',
        'manager_name',
        'contact_email',
        'contact_phone',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
}