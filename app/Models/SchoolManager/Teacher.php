<?php

namespace App\Models\SchoolManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'school_id',
        'photo',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'phone_h',
        'phone_m',
        'email',
        'qualification',
        'ssn',
        'contribuinte_no',
        'passport_no',
        'nationality',
        'date_start',
        'emergency_name',
        'emergency_phone',
        'job_title',
        'basic_salary',
        'tax',
        'socail_security',
        'loan',
        'bonus',
        'advance',
        'gross_salary',
        'net_salary',
    ];
}
