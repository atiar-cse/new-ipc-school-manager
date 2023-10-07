<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = [
        'name', 'description', 'file', 'image', 'disabled'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function tag(): HasOne
    {
        return $this->hasOne(BookTag::class, 'book_id');
    }
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }
}
