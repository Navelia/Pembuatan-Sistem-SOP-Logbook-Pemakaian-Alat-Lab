<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\JenisAlat;
use App\Models\Riwayat;
use App\Models\Sop;
use App\Models\Spesifikasi;
use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function home()
    {
        $jenisALat = JenisAlat::all();
        $data = [];

        foreach ($jenisALat as $temp) {
            $count = Alat::where('jenis_alat_id', $temp->id)->get();
            $count = count($count);
            array_push($data, ["data_jenis" => $temp, "jumlah_alat" => $count]);
        }

        $riwayat = Riwayat::where("tanggal", Carbon::now()->isoFormat('YYYY-MM-DD'))->orderBy("tanggal")->orderBy("jam_mulai")->get();
        $dataRiwayatHariIni = [];

        foreach ($riwayat as $temp) {
            $alat = Alat::find($temp->alat_id);
            $jenisALat = JenisAlat::find($alat->jenis_alat_id);
            array_push($dataRiwayatHariIni, ["riwayat" => $temp, "alat" => $alat, "jenisAlat" => $jenisALat]);
        }

        $riwayat = Riwayat::all();
        $dataRiwayat = [];

        foreach ($riwayat as $temp) {
            $alat = Alat::find($temp->alat_id);
            $jenisALat = JenisAlat::find($alat->jenis_alat_id);
            array_push($dataRiwayat, ["riwayat" => $temp, "alat" => $alat, "jenisAlat" => $jenisALat]);
        }

        $alat = Alat::all();
        $dataAlat = [];

        foreach ($alat as $temp) {
            array_push($dataAlat, ["id" => $temp->id, "nama" => $temp->jenisAlat->nama . " - " . $temp->nomor]);
        }

        return view("admin.home", ["data" => $data, "dataRiwayatHariIni" => $dataRiwayatHariIni, "dataRiwayat" => $dataRiwayat, "dataAlat" => $dataAlat]);
    }

    public function tambahJenisAlat()
    {
        return view("admin.tambahJenisAlat");
    }

    public function simpanTambahJenisAlat(Request $request)
    {
        $jenisALat = new JenisAlat();

        $nomorId = JenisAlat::all()->last();
        if ($nomorId) {
            $nomorId = $nomorId->id + 1;
        } else {
            $nomorId = 1;
        }

        $filename = "jenisAlat_" . $nomorId . '.' . request()->gambarAlat->getClientOriginalExtension();
        request()->gambarAlat->move(public_path('images/jenis_alat'), $filename);
        $jenisALat->gambar = $filename;

        $jenisALat->nama = $request->namaAlat;
        $jenisALat->deskripsi = $request->deskripsiAlat;

        $jenisALat->save();

        $jenisALatId = $jenisALat->id;

        $namaSpesifikasi = $request->namaSpesifikasi;
        $spesifikasi = $request->spesifikasi;
        for ($i = 0; $i < count($namaSpesifikasi); $i++) {
            $newSpesifikasi = new Spesifikasi();
            $newSpesifikasi->nama = $namaSpesifikasi[$i];
            $newSpesifikasi->spesifikasi = $spesifikasi[$i];
            $newSpesifikasi->jenis_alat_id = $jenisALatId;
            $newSpesifikasi->save();
        }

        $sop = $request->sop;
        for ($i = 0; $i < count($sop); $i++) {
            $newSop = new Sop();
            $newSop->sop = $sop[$i];
            $newSop->urutan = $i + 1;
            $newSop->jenis_alat_id = $jenisALatId;
            $newSop->save();
        }

        $jumlahAlat = $request->jumlahAlat;
        for ($i = 0; $i < $jumlahAlat; $i++) {
            $newAlat = new Alat();
            $newAlat->nomor = $i + 1;
            $newAlat->jenis_alat_id = $jenisALatId;
            $newAlat->save();
        }

        return redirect("home")->with('status', 'Berhasil menambahkan data jenis alat baru');
    }

    public function ubahJenisAlat($id)
    {
        $data = JenisAlat::find($id);

        $spesifikasi = Spesifikasi::where("jenis_alat_id", $id)->get();
        $sop = Sop::where("jenis_alat_id", $id)->orderBy("urutan")->get();
        $alat = Alat::where("jenis_alat_id", $id)->orderBy("nomor")->get();

        return view("admin.ubahJenisAlat", ["dataJenisAlat" => $data, "dataSpesifikasi" => $spesifikasi, "dataSop" => $sop, "dataAlat" => $alat]);
    }

    public function ubahGambarJenisAlat(Request $request)
    {
        $idJenisAlat = $request->idJenisAlat;
        $jenisAlat = JenisAlat::find($idJenisAlat);

        $image_path = public_path("images/jenis_alat/$jenisAlat->gambar");
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $filename = "jenisAlat_" . $idJenisAlat . '.' . request()->gambarAlat->getClientOriginalExtension();
        request()->gambarAlat->move(public_path('images/jenis_alat'), $filename);
        $jenisAlat->gambar = $filename;

        $jenisAlat->save();

        return redirect()->back()->with('status', 'Berhasil mengubah gambar jenis alat');
    }

    public function simpanUbahJenisAlat(Request $request)
    {
        $jenisALatId = $request->idJenisAlat;
        $jenisALat = JenisAlat::find($jenisALatId);

        $jenisALat->nama = $request->namaAlat;
        $jenisALat->deskripsi = $request->deskripsiAlat;

        $jenisALat->save();

        Spesifikasi::where("jenis_alat_id", $jenisALatId)->delete();

        $namaSpesifikasi = $request->namaSpesifikasi;
        $spesifikasi = $request->spesifikasi;
        for ($i = 0; $i < count($namaSpesifikasi); $i++) {
            $newSpesifikasi = new Spesifikasi();
            $newSpesifikasi->nama = $namaSpesifikasi[$i];
            $newSpesifikasi->spesifikasi = $spesifikasi[$i];
            $newSpesifikasi->jenis_alat_id = $jenisALatId;
            $newSpesifikasi->save();
        }

        Sop::where("jenis_alat_id", $jenisALatId)->delete();

        $sop = $request->sop;
        for ($i = 0; $i < count($sop); $i++) {
            $newSop = new Sop();
            $newSop->sop = $sop[$i];
            $newSop->urutan = $i + 1;
            $newSop->jenis_alat_id = $jenisALatId;
            $newSop->save();
        }

        return redirect()->back()->with('status', 'Berhasil mengubah data jenis alat');
    }

    public function tambahAlat(Request $request)
    {
        $jenisALatId = $request->idJenisAlat;

        $nomorAkhir = Alat::where("jenis_alat_id", $jenisALatId)->orderBy("nomor")->get()->last();
        if ($nomorAkhir) {
            $nomorAkhir = $nomorAkhir->nomor + 1;
        } else {
            $nomorAkhir = 1;
        }

        $jumlahAlat = $request->jumlahAlat;
        for ($i = 0; $i < $jumlahAlat; $i++) {
            $newAlat = new Alat();
            $newAlat->nomor = $i + $nomorAkhir;
            $newAlat->jenis_alat_id = $jenisALatId;
            $newAlat->save();
        }

        return redirect()->back()->with('status', 'Berhasil menambah alat');
    }

    public function hapusRiwayat($id)
    {
        $riwayat = Riwayat::find($id);
        if ($riwayat) {
            $riwayat->delete();
            return redirect()->back()->with('status', 'Peminjaman alat berhasil dihapus');
        } else {
            return redirect("/home")->with('status', 'Peminjaman alat gagal dihapus');
        }
    }

    public function hapusAlat($id)
    {
        $alat = Alat::find($id);
        Riwayat::where("alat_id", $alat->id)->delete();
        $alat->delete();
        return redirect()->back()->with('status', 'Alat berhasil dihapus');
    }

    public function hapusJenisAlat($id)
    {
        $jenisAlat = JenisAlat::find($id);
        if ($jenisAlat) {
            $alats = Alat::where("jenis_alat_id", $jenisAlat->id)->get();
            foreach ($alats as $alat) {
                Riwayat::where("alat_id", $alat->id)->delete();
                $alat->delete();
            }
            Spesifikasi::where("jenis_alat_id", $jenisAlat->id)->delete();
            Sop::where("jenis_alat_id", $jenisAlat->id)->delete();
            $jenisAlat->delete();
            return redirect()->back()->with('status', 'Jenis alat berhasil dihapus');
        } else {
            return redirect("/home")->with('status', 'Jenis alat gagal dihapus');
        }
    }

    public function changeJamSelesaiAdmin($alat, $date, $jamMulai)
    {
        $riwayat = Riwayat::where("alat_id", $alat)->where("tanggal", $date)->where("jam_mulai", ">", $jamMulai)->orderBy("jam_mulai")->get();
        $selesai = 24;
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

    public function simpanPinjamAlatAdmin(Request $request)
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

        if ($jam_mulai > $jam_selesai) {
            return redirect()->back()->with('status', 'Jam peminjaman tidak sesuai');
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
