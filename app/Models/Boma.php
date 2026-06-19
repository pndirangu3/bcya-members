<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boma extends Model
{
    protected $fillable = [
        'payam_id',
        'name'
    ];

    public function payam()
    {
        return $this->belongsTo(Payam::class);
    }
}
