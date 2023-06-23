<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function welcome()
    {
        $data = Alat::all();

        return view("welcome", ["data" => $data]);
    }
}
