<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
          <th scope="col">Detail Alat</th>
          <th scope="col">Ubah Alat</th>
          <th scope="col">Hapus Alat</th>
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
            <td><a href="{{ url('hapusJenisAlat/' . $jenisAlat['data_jenis']->id) }}" class="btn btn-danger" onclick="return confirm('Hapus jenis alat ({{ $jenisAlat['data_jenis']->nama }}) dan seluruh datanya?')">Hapus</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

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
            <td><a href="{{ url('hapusRiwayat/' . $riwayat['riwayat']->id) }}" class="btn btn-danger" onclick="return confirm('Hapus peminjaman ini?')">Hapus</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="table-responsive">
    <h2>Data Semua Peminjaman Alat</h2>
    <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalTambahRiwayat">Tambah Data Peminjaman</a>
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

  {{-- Modal Tambah Riwayat --}}
  <div id="modalTambahRiwayat" class="modal fade" tabindex="-1" role="basic">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data Peminjaman Alat</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('simpanPinjamAlatAdmin') }}" id="formPinjam">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="nrp" class="form-label">NRP</label>
              <input type="text" class="form-control" id="nrp" name="nrp" required>
            </div>
            <div class="mb-3">
              <label for="alat_id" class="form-label">Alat</label>
              <select class="form-select" id="alat_id" name="alat_id" required>
                @foreach ($dataAlat as $alat)
                  <option value="{{ $alat['id'] }}">{{ $alat['nama'] }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
              <label for="jam_mulai" class="form-label">Jam Mulai</label>
              <select class="form-select" id="jam_mulai" name="jam_mulai" required disabled>
                <option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="jam_selesai" class="form-label">Jam Selesai</label>
              <select class="form-select" id="jam_selesai" name="jam_selesai" required disabled>
                <option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#riwayatHariIniTable').DataTable({
        "aaSorting": [
          [2, "desc"],
          [3, "asc"]
        ]
      });

      $('#riwayatTable').DataTable({
        "aaSorting": [
          [2, "desc"],
          [3, "asc"]
        ]
      });


      $('#jenisAlatTable').DataTable({});
    });

    $('#alat_id').change(function() {
      var tanggal = document.getElementById('tanggal');
      tanggal.value = "";

      var jamMulaiSelect = document.getElementById('jam_mulai');
      jamMulaiSelect.innerHTML = '<option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>';
      $("#jam_mulai").attr("disabled", true);

      var jamSelesaiSelect = document.getElementById('jam_selesai');
      jamSelesaiSelect.innerHTML = '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
      $("#jam_selesai").attr("disabled", true);
    });

    $('#tanggal').change(function() {
      var selectedTanggal = this.value;
      var alat_id = document.getElementById('alat_id').value;

      var jamSelesaiSelect = document.getElementById('jam_selesai');
      jamSelesaiSelect.innerHTML = '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
      $("#jam_selesai").attr("disabled", true);

      if (selectedTanggal == "") {
        var jamMulaiSelect = document.getElementById('jam_mulai');
        jamMulaiSelect.innerHTML = '<option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>';
        $("#jam_mulai").attr("disabled", true);
      } else {
        $.ajax({
          url: '/changeJamMulai/' + alat_id + "/" + selectedTanggal,
          method: 'GET',
          success: function(response) {
            $("#jam_mulai").attr("disabled", false);
            var jamMulaiSelect = document.getElementById('jam_mulai');
            jamMulaiSelect.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = "";
            optionElement.textContent = "Pilih Jam Mulai";
            optionElement.hidden = true;
            jamMulaiSelect.appendChild(optionElement);

            response.forEach(function(option) {
              var optionElement = document.createElement('option');
              optionElement.value = option.value;
              optionElement.textContent = option.text;
              jamMulaiSelect.appendChild(optionElement);
            });
          }
        });
      }
    });

    $('#jam_mulai').change(function() {
      var selectedTanggal = document.getElementById('tanggal').value;
      var selectedJamMulai = this.value;
      var alat_id = document.getElementById('alat_id').value;
      if (selectedTanggal == "") {
        var jamMulaiSelect = document.getElementById('jam_mulai');
        jamMulaiSelect.innerHTML = '<option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>';

        var jamSelesaiSelect = document.getElementById('jam_selesai');
        jamSelesaiSelect.innerHTML = '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
      } else if (selectedJamMulai == "") {
        var jamSelesaiSelect = document.getElementById('jam_selesai');
        jamSelesaiSelect.innerHTML = '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
      } else {
        $.ajax({
          url: '/changeJamSelesaiAdmin/' + alat_id + "/" + selectedTanggal + "/" + selectedJamMulai,
          method: 'GET',
          success: function(response) {
            $("#jam_selesai").attr("disabled", false);
            var jamSelesaiSelect = document.getElementById('jam_selesai');
            jamSelesaiSelect.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = "";
            optionElement.textContent = "Pilih Jam Selesai";
            optionElement.hidden = true;
            jamSelesaiSelect.appendChild(optionElement);

            response.forEach(function(option) {
              var optionElement = document.createElement('option');
              optionElement.value = option.value;
              optionElement.textContent = option.text;
              jamSelesaiSelect.appendChild(optionElement);
            });
          }
        });
      }
    });
  </script>
</body>

</html>
