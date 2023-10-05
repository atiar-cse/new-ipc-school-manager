<?php

namespace App\Models\Admin;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class School extends Model
{
    // use HasFactory;
    protected $fillable = [

        'name', 'position',

    ];

    public function address()
    {
        return $this->hasOne(Address::class, 'school_id');
    }

    public function mailaddress()
    {
        return $this->hasOne(MailAddress::class, 'school_id');
    }
}
