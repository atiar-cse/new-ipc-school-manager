<?php

namespace App\Models\SchoolManager;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'school_id',
        'user_id',
        'title',
        'father_name',
        'mother_name',
        'street',
        'city',
        'state',
        'country',
        'phone_h',
        'phone_o',
        'mobile_m',
        'mobile_f',
        'email_m',
        'email_f',
        'lr_kin_name',
        'lr_relationship',
        'lr_address',
        'lr_phone_h',
        'lr_phone_w',
        'lr_email',
        'fp_kin_name',
        'fp_relationship',
        'fp_address',
        'fp_phone_h',
        'fp_phone_w',
        'fp_email',
        'sp_kin_name',
        'sp_relationship',
        'sp_address',
        'sp_phone_h',
        'sp_phone_w',
        'sp_email',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
