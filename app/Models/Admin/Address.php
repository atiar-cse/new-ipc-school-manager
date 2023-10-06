<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Schools\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    // use HasFactory;
    protected $fillable = [
        'address', 'address2', 'city', 'zip', 'state', 'country'
    ];
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
