<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    protected $fillable = ['name'];

    public function school(): HasMany
    {
        return $this->HasMany(School::class);
    }

    public function books(): BelongsToMany
    {
        return $this->BelongsToMany(Book::class);
    }
}
