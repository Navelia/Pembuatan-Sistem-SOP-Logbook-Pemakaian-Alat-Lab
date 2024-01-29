@extends('admin.home')
@section('content')
  @if (session('status'))
    <div class="alert alert-primary">
      <p>{{ session('status') }}</p>
    </div>
  @endif

  <form action="cetakLaporan" method="POST">
    @csrf
    <div class="mb-3">
      <label for="lab_id" class="form-label">Lab</label>
      <select class="form-select" id="lab_id" name="lab_id" required>
        <option value="" selected hidden>Pilih Lab</option>
        @foreach ($dataLab as $lab)
          <option value="{{ $lab->id }}">{{ $lab->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="alat_id" class="form-label">Alat</label>
      <select class="form-select" id="alat_id" name="alat_id" disabled required>
        <option value="" selected hidden>Pilih Lab Terlebih Dahulu</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="tahun" class="form-label">Tahun</label>
      <select class="form-select" id="tahun" name="tahun" disabled required>
        <option value="" selected hidden>Pilih Alat Terlebih Dahulu</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="bulan" class="form-label">Bulan</label>
      <select class="form-select" id="bulan" name="bulan" disabled required>
        <option value="" selected hidden>Pilih Bulan Terlebih Dahulu</option>
      </select>
    </div>
    <button type="button" class="btn btn-primary" onclick="tampilLaporan()">Tampilkan</button>
    <button type="submit" class="btn btn-primary">Cetak</button>
  </form>
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
    <tbody id="tableBody">

    </tbody>
  </table>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $('#riwayatTable').DataTable({
        "aaSorting": [
          [3, "desc"],
          [4, "asc"]
        ]
      });
    });

    $("#lab_id").change(function() {
      var lab_id = this.value;

      var tahun_select = document.getElementById('tahun');
      tahun_select.innerHTML = '<option value="" selected hidden>Pilih Alat Terlebih Dahulu</option>';
      $("#tahun").attr("disabled", true);

      var bulan_select = document.getElementById('bulan');
      bulan_select.innerHTML = '<option value="" selected hidden>Pilih Tahun Terlebih Dahulu</option>';
      $("#bulan").attr("disabled", true);

      if (lab_id == "") {
        var alat_select = document.getElementById('alat_id');
        alat_select.innerHTML = '<option value="" selected hidden>Pilih Lab Terlebih Dahulu</option>';
        $("#alat_id").attr("disabled", true);
      } else {
        $.ajax({
          url: '/changeLab/' + lab_id,
          method: 'GET',
          success: function(response) {
            $("#alat_id").attr("disabled", false);
            var alat_select = document.getElementById('alat_id');
            alat_select.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = "";
            optionElement.textContent = "Pilih Alat";
            optionElement.hidden = true;
            alat_select.appendChild(optionElement);

            response.forEach(function(option) {
              var optionElement = document.createElement('option');
              optionElement.value = option.value;
              optionElement.textContent = option.text;
              alat_select.appendChild(optionElement);
            });
          }
        });
      }
    });

    $("#alat_id").change(function() {
      var alat_id = this.value;

      var bulan_select = document.getElementById('bulan');
      bulan_select.innerHTML = '<option value="" selected hidden>Pilih Tahun Terlebih Dahulu</option>';
      $("#bulan").attr("disabled", true);

      if (alat_id == "") {
        var tahun_select = document.getElementById('tahun');
        tahun_select.innerHTML = '<option value="" selected hidden>Pilih Alat Terlebih Dahulu</option>';
        $("#tahun").attr("disabled", true);
      } else {
        $.ajax({
          url: '/changeAlat/' + alat_id,
          method: 'GET',
          success: function(response) {
            $("#tahun").attr("disabled", false);
            var tahun_select = document.getElementById('tahun');
            tahun_select.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = "";
            optionElement.textContent = "Pilih Tahun";
            optionElement.hidden = true;
            tahun_select.appendChild(optionElement);

            response.forEach(function(option) {
              var optionElement = document.createElement('option');
              optionElement.value = option.value;
              optionElement.textContent = option.text;
              tahun_select.appendChild(optionElement);
            });
          }
        });
      }
    });

    $("#tahun").change(function() {
      var tahun = this.value;
      var alat_id = document.getElementById('alat_id').value;

      if (tahun == "") {
        var bulan_select = document.getElementById('bulan');
        bulan_select.innerHTML = '<option value="" selected hidden>Pilih Tahun Terlebih Dahulu</option>';
        $("#bulan").attr("disabled", true);
      } else {
        $.ajax({
          url: '/changeTahun/' + alat_id + "/" + tahun,
          method: 'GET',
          success: function(response) {
            $("#bulan").attr("disabled", false);
            var bulan_select = document.getElementById('bulan');
            bulan_select.innerHTML = '';

            var optionElement = document.createElement('option');
            optionElement.value = "";
            optionElement.textContent = "Pilih Bulan";
            optionElement.hidden = true;
            bulan_select.appendChild(optionElement);

            response.forEach(function(option) {
              var optionElement = document.createElement('option');
              optionElement.value = option.value;
              optionElement.textContent = option.text;
              bulan_select.appendChild(optionElement);
            });
          }
        });
      }
    });

    function tampilLaporan() {
      var bulan = document.getElementById('bulan').value;
      var tahun = document.getElementById('tahun').value;
      var alat_id = document.getElementById('alat_id').value;

      if (bulan == "" || tahun == "" || alat_id == "") {
        window.alert("Pilih data yang ingin ditampilkan terlebih dahulu");
      } else {
        $.ajax({
          url: '/tampilLaporan/' + alat_id + "/" + tahun + "/" + bulan,
          method: 'GET',
          success: function(response) {
            var table_body = document.getElementById('tableBody');
            table_body.innerHTML = '';

            response.forEach(function(data) {
                var row = document.createElement("tr");

                var col1 = document.createElement("td");
                col1.textContent = data.nama;
                row.appendChild(col1);

                var col2 = document.createElement("td");
                col2.textContent = data.nrp;
                row.appendChild(col2);

                var col3 = document.createElement("td");
                col3.textContent = data.tanggal;
                row.appendChild(col3);

                var col4 = document.createElement("td");
                col4.textContent = data.mulai;
                row.appendChild(col4);

                var col5 = document.createElement("td");
                col5.textContent = data.selesai;
                row.appendChild(col5);

                table_body.appendChild(row);
            });
          }
        });
      }
    };
  </script>
@endsection
