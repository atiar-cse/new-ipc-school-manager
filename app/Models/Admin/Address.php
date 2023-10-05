<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Schools\School;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // use HasFactory;

    public function user()
    {
        return $this->belongsTo(School::class);
    }
}
