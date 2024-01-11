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

    .container {
      background: rgb(250, 205, 205);
      padding: 25px;
    }

    .image-container {
      width: 300px;
      height: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      margin-bottom: 20px;
    }

    .image-container img {
      max-width: 100%;
      height: auto;
    }

    .paragraphs-container {
      text-align: center;
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
  <div class="container">
    <div class="image-container">
      <img src='{{ asset("images/jenis_alat/$data->gambar") }}' class="card-img-top img-fluid">
    </div>
    <div class="paragraphs-container">
      <h1>{{ $data->nama }} - {{ $alat->nomor }}</h1>
      <p>{{ $data->deskripsi }}</p>
    </div>
    <div class="table-responsive">
      <h2>Riwayat</h2>
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
    <h1>Isi Data Peminjam</h1>
    <form method="POST" action="{{ route('simpanPinjamAlat') }}" id="formPinjam">
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
        <label for="tanggal" class="form-label">Tanggal</label>
        <select class="form-select" id="tanggal" name="tanggal" required>
          <option value="" selected hidden>Pilih Tanggal</option>
          @foreach ($tanggal as $item)
            <option value="{{ $item }}">{{ \Carbon\Carbon::parse($item)->isoFormat('LL') }}</option>
          @endforeach
        </select>
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
      <input type="hidden" class="form-control" id="alat_id" name="alat_id" value="{{ $alat->id }}" required>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#riwayatTable').DataTable({
        "aaSorting": [
          [2, "asc"],
          [3, "asc"]
        ]
      });
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
          url: '/changeJamSelesai/' + alat_id + "/" + selectedTanggal + "/" + selectedJamMulai,
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
