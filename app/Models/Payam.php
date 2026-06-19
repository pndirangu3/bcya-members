<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payam extends Model
{
    protected $fillable = ['name'];

    public function bomas()
    {
        return $this->hasMany(Boma::class);
    }
}
