<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dijagnoza extends Model
{
    public function zubi()
    {
        return $this->belongsToMany(Zub::class, 'zub_dijagnoze');
    }
}
