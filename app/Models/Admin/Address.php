<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Schools\School;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // use HasFactory;
    protected $fillable = [
        'address', 'address2', 'city', 'zip', 'state', 'country'
    ];
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
