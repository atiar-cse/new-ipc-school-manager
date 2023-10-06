<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolCategory extends Model
{
    protected $fillable = ['name'];

    public function school(): HasOne
    {
        return $this->hasOne(School::class, 'school_category_id');
    }
}
