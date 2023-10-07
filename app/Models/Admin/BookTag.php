<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{
    protected $fillable = ['book_id', 'tag_id'];
}
