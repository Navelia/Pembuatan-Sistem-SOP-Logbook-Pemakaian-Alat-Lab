<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\JenisAlat;
use App\Models\Riwayat;
use App\Models\Sop;
use App\Models\Spesifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function welcome()
    {
        $data = JenisAlat::all();

        return view("mahasiswa.welcome", ["data" => $data]);
    }

    public function detailJenisAlat($id)
    {
        $data = JenisAlat::find($id);

        $spesifikasi = Spesifikasi::where("jenis_alat_id", $id)->get();
        $sop = Sop::where("jenis_alat_id", $id)->orderBy("urutan")->get();
        $alat = Alat::where("jenis_alat_id", $id)->orderBy("nomor")->get();

        return view("mahasiswa.detail_jenis_alat", ["data" => $data, "dataSpesifikasi" => $spesifikasi, "dataSop" => $sop, "dataAlat" => $alat]);
    }

    public function detailAlat($id)
    {
        $data = Alat::find($id);

        $jenis_alat = $data->jenisAlat;

        $spesifikasi = Spesifikasi::where("jenis_alat_id", $jenis_alat->id)->get();
        $sop = Sop::where("jenis_alat_id", $jenis_alat->id)->orderBy("urutan")->get();

        $riwayat = Riwayat::where("alat_id", $data->id)->orderBy("tanggal")->orderBy("jam_mulai")->get();

        return view("alat.detail_alat", ["data" => $jenis_alat, "dataSpesifikasi" => $spesifikasi, "dataSop" => $sop, "dataRiwayat" => $riwayat]);
    }
}
