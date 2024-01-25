@extends('mahasiswa.main')
@section('content')
    <div class="container detail-alat">
        <div class="row">
            <div class="col-md-5">
                <div class="image-container">
                    <img src='{{ asset("images/jenis_alat/$data->gambar") }}' class="card-img-top img-fluid">
                </div>
            </div>
            <div class="col-md-5">
                <div class="informasi-alat">
                    <h1>{{ $data->nama }} - {{ $alat->nomor }}</h1>
                    <p>{{ $data->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <h2 class="keterangan">Spesifikasi</h2>
            <table class="table table-striped">
                <tbody>
                    @foreach ($dataSpesifikasi as $spek)
                        <tr>
                            <td>{{ $spek->nama }}</td>
                            <td>{{ $spek->spesifikasi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row justify-content-center">
            <h2 class="keterangan">SOP</h2>
            <table class="table table-striped">
                <tbody>
                    @foreach ($dataSop as $sop)
                        <tr>
                            <td>{{ $sop->urutan }}</td>
                            <td>{{ $sop->sop }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <h2 class="keterangan">Riwayat Peminjaman</h2>
            <table class="table table-striped" id="riwayatTable">
                <thead>
                    <tr>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">NRP</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Jam Mulai</th>
                        <th scope="col">Jam Berakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataRiwayat as $riwayat)
                        <tr>
                            <td>{{ $riwayat->nama }}</td>
                            <td>{{ $riwayat->nrp }}</td>
                            <td>{{ \Carbon\Carbon::parse($riwayat->tanggal)->isoFormat('LL') }}</td>
                            @if ($riwayat->jam_mulai < 10)
                                <td>{{ '0' . $riwayat->jam_mulai . ':00' }}</td>
                            @else
                                <td>{{ $riwayat->jam_mulai . ':00' }}</td>
                            @endif
                            @if ($riwayat->jam_selesai < 10)
                                <td>{{ '0' . $riwayat->jam_selesai . ':00' }}</td>
                            @else
                                <td>{{ $riwayat->jam_selesai . ':00' }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-grid gap-2 mt-3">
            <a href="{{ url('pinjamAlat/' . $alat->id) }}" class="btn btn-primary">Pinjam Alat</a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#riwayatTable').DataTable({
                "aaSorting": [
                    [2, "desc"],
                    [3, "asc"]
                ]
            });
        });
    </script>
@endsection
