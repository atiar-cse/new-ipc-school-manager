<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class School extends Model
{
    // use HasFactory;
    protected $fillable = [
        'name', 'position',
    ];
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }
    public function group(): BelongsTo
    {
        return $this->BelongsTo(Group::class, 'group_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'school_id');
    }

    public function mailaddress(): HasOne
    {
        return $this->hasOne(MailAddress::class, 'school_id');
    }
}
