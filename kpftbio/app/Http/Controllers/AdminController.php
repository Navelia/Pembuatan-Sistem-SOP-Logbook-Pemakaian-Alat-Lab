<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\JenisAlat;
use App\Models\Riwayat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        $jenisALat = JenisAlat::all();
        $data = [];

        foreach($jenisALat as $temp){
            $count = Alat::where('jenis_alat_id', $temp->id)->get();
            $count = count($count);
            array_push($data, ["data_jenis" => $temp, "jumlah_alat" => $count]);
        }

        $riwayat = Riwayat::where("tanggal", Carbon::now()->isoFormat('YYYY-MM-DD'))->orderBy("tanggal")->orderBy("jam_mulai")->get();
        $dataRiwayat = [];

        foreach($riwayat as $temp){
            $alat = Alat::find($temp->alat_id);
            $jenisALat = JenisAlat::find($alat->jenis_alat_id);
            array_push($dataRiwayat, ["riwayat" => $temp, "alat" => $alat, "jenisAlat" => $jenisALat]);
        }

        return view("admin.home", ["data" => $data, "dataRiwayat" => $dataRiwayat]);
    }

    public function hapusRiwayat($id)
    {
        $riwayat = Riwayat::find($id);
        $riwayat->delete();

        return redirect()->back()->with('status', 'Peminjaman alat berhasil dihapus');
    }
}
