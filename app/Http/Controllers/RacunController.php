<?php

namespace App\Http\Controllers;

use App\Pregled;
use Illuminate\Http\Request;

class RacunController extends Controller
{
    public function showRacun() {
        return view('racun');
    }

    public function showRacunDetaljno() {
        //$pregled = Pregled::find(1)->firstorfail();
        return view('racun-detaljno');
    }
}
