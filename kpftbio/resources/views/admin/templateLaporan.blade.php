<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <img src="https://simlabftb.top/logo.png" alt="FTBio Ubaya">
    <h1>Laporan Peminjaman Alat</h1>
    <p>Nama Alat: {{ $alat->jenisAlat->nama }} - {{ $alat->nomor }} ({{ $alat->lab->nama }})</p>
    <p>Periode: {{ $bulan }} {{ $tahun }}</p>
    <table>
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
                        @if (fmod($riwayat->jam_mulai, 1) == 0)
                            <td>{{ '0' . $riwayat->jam_mulai . ':00' }}</td>
                        @else
                            <td>{{ '0' . ($riwayat->jam_mulai - 0.5) . ':30' }}</td>
                        @endif
                    @else
                        @if (fmod($riwayat->jam_mulai, 1) == 0)
                            <td>{{ $riwayat->jam_mulai . ':00' }}</td>
                        @else
                            <td>{{ $riwayat->jam_mulai - 0.5 . ':30' }}</td>
                        @endif
                    @endif
                    @if ($riwayat->jam_selesai < 10)
                        @if (fmod($riwayat->jam_selesai, 1) == 0)
                            <td>{{ '0' . $riwayat->jam_selesai . ':00' }}</td>
                        @else
                            <td>{{ '0' . ($riwayat->jam_selesai - 0.5) . ':30' }}</td>
                        @endif
                    @else
                        @if (fmod($riwayat->jam_selesai, 1) == 0)
                            <td>{{ $riwayat->jam_selesai . ':00' }}</td>
                        @else
                            <td>{{ $riwayat->jam_selesai - 0.5 . ':30' }}</td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
