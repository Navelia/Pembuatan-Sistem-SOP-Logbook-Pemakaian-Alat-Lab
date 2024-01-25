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
                        <td data-sort="{{ strtotime($riwayat['riwayat']->tanggal) }}">
                            {{ \Carbon\Carbon::parse($riwayat['riwayat']->tanggal)->isoFormat('LL') }}</td>
                        @if ($riwayat['riwayat']->jam_mulai < 10)
                            @if (fmod($riwayat['riwayat']->jam_mulai, 1) == 0)
                                <td>{{ '0' . $riwayat['riwayat']->jam_mulai . ':00' }}</td>
                            @else
                                <td>{{ '0' . ($riwayat['riwayat']->jam_mulai - 0.5) . ':30' }}</td>
                            @endif
                        @else
                            @if (fmod($riwayat['riwayat']->jam_mulai, 1) == 0)
                                <td>{{ $riwayat['riwayat']->jam_mulai . ':00' }}</td>
                            @else
                                <td>{{ $riwayat['riwayat']->jam_mulai - 0.5 . ':30' }}</td>
                            @endif
                        @endif
                        @if ($riwayat['riwayat']->jam_selesai < 10)
                            @if (fmod($riwayat['riwayat']->jam_selesai, 1) == 0)
                                <td>{{ '0' . $riwayat['riwayat']->jam_selesai . ':00' }}</td>
                            @else
                                <td>{{ '0' . ($riwayat['riwayat']->jam_selesai - 0.5) . ':30' }}</td>
                            @endif
                        @else
                            @if (fmod($riwayat['riwayat']->jam_selesai, 1) == 0)
                                <td>{{ $riwayat['riwayat']->jam_selesai . ':00' }}</td>
                            @else
                                <td>{{ $riwayat['riwayat']->jam_selesai - 0.5 . ':30' }}</td>
                            @endif
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
                    [3, "desc"],
                    [4, "asc"]
                ]
            });
        });
    </script>
@endsection
