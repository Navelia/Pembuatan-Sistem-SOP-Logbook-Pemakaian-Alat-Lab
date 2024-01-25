@extends('admin.home')
@section('content')
    @if (session('status'))
        <div class="alert alert-primary">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <h2>Peminjaman Alat Hari Ini</h2>
        <table class="table table-striped" id="riwayatHariIniTable">
            <thead>
                <tr>
                    <th scope="col">Nama Peminjam</th>
                    <th scope="col">NRP</th>
                    <th scope="col">Alat</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Jam Berakhir</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataRiwayatHariIni as $riwayat)
                    <tr>
                        <td>{{ $riwayat['riwayat']->nama }}</td>
                        <td>{{ $riwayat['riwayat']->nrp }}</td>
                        <td>{{ $riwayat['jenisAlat']->nama . ' - ' . $riwayat['alat']->nomor }}</td>
                        <td>{{ \Carbon\Carbon::parse($riwayat['riwayat']->tanggal)->isoFormat('LL') }}</td>
                        @if ($riwayat['riwayat']->jam_mulai < 10)
                            <td>{{ '0' . $riwayat['riwayat']->jam_mulai . ':00' }}</td>
                        @else
                            <td>{{ $riwayat['riwayat']->jam_mulai . ':00' }}</td>
                        @endif
                        @if ($riwayat['riwayat']->jam_selesai < 10)
                            <td>{{ '0' . $riwayat['riwayat']->jam_selesai . ':00' }}</td>
                        @else
                            <td>{{ $riwayat['riwayat']->jam_selesai . ':00' }}</td>
                        @endif
                        <td><a href="{{ url('hapusRiwayat/' . $riwayat['riwayat']->id) }}" class="btn btn-danger"
                                onclick="return confirm('Hapus peminjaman ini?')">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#riwayatHariIniTable').DataTable({
                "aaSorting": [
                    [2, "desc"],
                    [3, "asc"]
                ]
            });
        });
    </script>
@endsection
