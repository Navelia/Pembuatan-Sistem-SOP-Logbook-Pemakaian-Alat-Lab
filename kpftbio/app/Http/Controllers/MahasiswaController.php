<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function welcome()
    {
        $data = Alat::all();

        return view("mahasiswa.welcome", ["data" => $data]);
    }

    public function detailAlat($id)
    {
        $data = Alat::find($id);

        $riwayat = $data->riwayat->sortByDesc("tanggal")->sortBy("jam_mulai");

        return view("mahasiswa.alat_detail", ["data" => $data, "riwayat" => $riwayat]);
    }
}
