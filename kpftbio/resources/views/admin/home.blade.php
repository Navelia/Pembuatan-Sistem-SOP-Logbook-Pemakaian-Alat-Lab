<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <style>
    html,
    body {
      height: 100%;
      font-size: 16px;
      font-family: Arial, sans-serif;
    }

    .imgJenis {
      max-width: 100px;
      max-height: 100px;
    }

    table {
      width: 100%;
    }
  </style>
</head>

<body>
  @if (session('status'))
    <div class="alert alert-primary">
      <p>{{ session('status') }}</p>
    </div>
  @endif
  <div class="table-responsive">
    <h2>Daftar Jenis Alat</h2><a href="{{ url('tambahJenisAlat/') }}" class="btn btn-primary">Tambah Jenis Alat</a>
    <table class="table table-striped" id="jenisAlatTable">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Gambar</th>
          <th scope="col">Nama</th>
          <th scope="col">Deskripsi</th>
          <th scope="col">Jumlah Alat</th>
          <th scope="col" colspan="3">Aksi</th>
          <th style="display: none"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $jenisAlat)
          <tr>
            <td>{{ $jenisAlat['data_jenis']->id }}</td>
            <td><img class="imgJenis" src='{{ asset('images/jenis_alat/' . $jenisAlat['data_jenis']->gambar) }}'></td>
            <td>{{ $jenisAlat['data_jenis']->nama }}</td>
            <td>{{ $jenisAlat['data_jenis']->deskripsi }}</td>
            <td>{{ $jenisAlat['jumlah_alat'] }}</td>
            <td><a href="{{ url('detailJenisAlat/' . $jenisAlat['data_jenis']->id) }}" class="btn btn-primary">Detail</a></td>
            <td><a href="{{ url('ubahJenisAlat/' . $jenisAlat['data_jenis']->id) }}" class="btn btn-warning">Ubah</a></td>
            <td><a href="{{ url('hapusJenisAlat/' . $jenisAlat['data_jenis']->id) }}" class="btn btn-danger" onclick="return confirm('Hapus jenis alat ({{$jenisAlat['data_jenis']->nama}}) dan seluruh datanya?')">Hapus</a></td>
            <td style="display: none"></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="table-responsive">
    <h2>Peminjaman Alat Hari Ini</h2>
    <table class="table table-striped" id="riwayatTable">
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
        @foreach ($dataRiwayat as $riwayat)
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
            <td><a href="{{ url('hapusRiwayat/' . $riwayat['riwayat']->id) }}" class="btn btn-danger" onclick="return confirm('Hapus peminjaman ini?')">Hapus</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#jenisAlatTable').DataTable();
      $('#riwayatTable').DataTable({
        "aaSorting": [
          [2, "desc"],
          [3, "asc"]
        ]
      });
    });
  </script>
</body>

</html>
