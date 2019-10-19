<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zub extends Model
{
    public function dijagnoze()
    {
        return $this->belongsToMany(Dijagnoza::class, 'zub_dijagnoze');
    }
}
