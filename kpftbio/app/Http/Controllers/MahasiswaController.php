<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\JenisAlat;
use App\Models\Riwayat;
use App\Models\Sop;
use App\Models\Spesifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use DateTime;

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

        return view("alat.detail_alat", ["alat" => $data, "data" => $jenis_alat, "dataSpesifikasi" => $spesifikasi, "dataSop" => $sop, "dataRiwayat" => $riwayat]);
    }

    public function pinjamAlat($id)
    {
        $data = Alat::find($id);
        $jenis_alat = $data->jenisAlat;
        $riwayat = Riwayat::where("alat_id", $data->id)->where("tanggal", ">=", Carbon::now()->isoFormat('YYYY-MM-DD'))->orderBy("tanggal")->orderBy("jam_mulai")->get();

        $count = 7;
        $tanggal = [];
        $date = Carbon::now();
        $tanggal[] = $date->isoFormat('YYYY-MM-DD');

        for ($i = 0; $i < $count; $i++) {
            array_push($tanggal, $date->addDay()->isoFormat('YYYY-MM-DD'));
        }

        return view("alat.pinjam_alat", ["alat" => $data, "data" => $jenis_alat, "dataRiwayat" => $riwayat, "tanggal" => $tanggal]);
    }

    public function changeJamMulai($alat, $date)
    {
        $jamMulai = range(0, 23.5, 0.5);

        $riwayat = Riwayat::where("alat_id", $alat)->where("tanggal", $date)->orderBy("jam_mulai")->get();

        foreach ($riwayat as $item) {
            $mulai = $item->jam_mulai;
            $selesai = $item->jam_selesai;

            for ($i = $mulai; $i < $selesai; $i += 0.5) {
                unset($jamMulai[$i * 2]);
            }
        }
        $jamMulaiOptions = [];

        foreach ($jamMulai as $temp) {
            $text = "";
            if (fmod($temp, 1) == 0) {
                if ($temp < 10) {
                    $text = "0$temp";
                }
                else{
                    $text = "$temp";
                }
                $text = "$text:00";
            } else {
                $temp2 = $temp - 0.5;
                if ($temp < 10) {
                    $text = "0$temp2";
                }
                else{
                    $text = "$temp2";
                }
                $text = "$text:30";
            }
            $array = ['value' => $temp, 'text' => $text];
            array_push($jamMulaiOptions, $array);
        }

        return response()->json($jamMulaiOptions);
    }

    public function changeJamSelesai($alat, $date, $jamMulai)
    {
        $riwayat = Riwayat::where("alat_id", $alat)->where("tanggal", $date)->where("jam_mulai", ">", $jamMulai)->orderBy("jam_mulai")->get();
        $selesai = $jamMulai + 5;
        if ($selesai > 24) {
            $selesai = 24;
        }
        if (count($riwayat) > 0) {
            $temp = $riwayat[0]->jam_mulai;
            if ($selesai - $temp > 0) {
                $selesai = $temp;
            }
        }
        $jamSelesai = range($jamMulai + 0.5, $selesai, 0.5);

        $jamSelesaiOptions = [];

        foreach ($jamSelesai as $temp) {
            $text = "";
            if (fmod($temp, 1) == 0) {
                if ($temp < 10) {
                    $text = "0$temp";
                }
                else{
                    $text = "$temp";
                }
                $text = "$text:00";
            } else {
                $temp2 = $temp - 0.5;
                if ($temp < 10) {
                    $text = "0$temp2";
                }
                else{
                    $text = "$temp2";
                }
                $text = "$text:30";
            }
            $array = ['value' => $temp, 'text' => $text];
            array_push($jamSelesaiOptions, $array);
        }

        return response()->json($jamSelesaiOptions);
    }

    public function simpanPinjamAlat(Request $request)
    {
        $nama = $request->get("nama");
        $nrp = $request->get("nrp");
        $tanggal = $request->get("tanggal");
        $jam_mulai = $request->get("jam_mulai");
        $jam_selesai = $request->get("jam_selesai");
        $alat_id = $request->get("alat_id");

        $alat = Alat::where("id", $alat_id)->get();
        if (count($alat) == 0) {
            return redirect()->back()->with('status', 'Data alat tidak ditemukan');
        }

        $today = new DateTime();
        $temp = new DateTime($tanggal);
        $diff = $today->diff($temp)->format("%r%a");

        if ($diff > 7 || $diff < 0) {
            return redirect()->back()->with('status', 'Tanggal peminjaman diluar ketentuan (hari ini hingga 7 hari kedepan)');
        }

        if ($jam_mulai > $jam_selesai) {
            return redirect()->back()->with('status', 'Jam peminjaman tidak sesuai');
        }

        if ($jam_selesai - $jam_mulai > 5) {
            return redirect()->back()->with('status', 'Jam peminjaman melebihi batas peminjaman (5 jam). Silahkan hubungi laboran untuk meminjam lebih dari 5 jam');
        }

        $riwayat = Riwayat::where("alat_id", $alat)->where("tanggal", $tanggal)->where("jam_mulai", ">=", $jam_mulai)->where("jam_mulai", "<", $jam_selesai)->get();
        if (count($riwayat) > 0) {
            return redirect()->back()->with('status', 'Jadwal yang dipilih bertabrakan dengan jadwal lain');
        }

        $riwayat = new Riwayat();
        $riwayat->nama = $nama;
        $riwayat->nrp = $nrp;
        $riwayat->tanggal = $tanggal;
        $riwayat->jam_mulai = $jam_mulai;
        $riwayat->jam_selesai = $jam_selesai;
        $riwayat->alat_id = $alat_id;

        $riwayat->save();
        return redirect()->back()->with('status', 'Berhasil menambahkan data peminjaman baru');
    }
}
