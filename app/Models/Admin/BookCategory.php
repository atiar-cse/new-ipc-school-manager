<?php

namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookCategory extends Model
{
    //use HasFactory;
    protected $table = "book_categories";

    protected $fillable = [
        'name', 'postion', 'icon', 'is_feature'
    ];




    // public function book(): BelongsTo
    // {
    //     return $this->belongsTo(Book::class);
    // }
}
