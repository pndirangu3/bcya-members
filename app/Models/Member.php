<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Member extends Model
{
protected $fillable = [
    'membership_no',
    'first_name',
    'middle_name',
    'last_name',
    'date_of_birth',
    'gender',
    'phone',
    'email',
    'national_id',
    'payam',
'boma',
'clan',
'section',
    'photo',
    'fingerprint_template',
    'status'
];

public function getAgeAttribute()
{
    return Carbon::parse($this->date_of_birth)->age;
}

}
