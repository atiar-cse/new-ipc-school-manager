<?php

namespace App\Models\SchoolManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classes extends Model
{
    protected $table = "classes";
    protected $fillable = [
        'school_id', 'name', 'assistants', 'category', 'ipc_level'
    ];

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher', 'class_id', 'teacher_id');
    }
}
