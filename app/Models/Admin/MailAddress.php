<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailAddress extends Model
{
    // use HasFactory;
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
