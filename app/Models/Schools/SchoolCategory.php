<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
}
