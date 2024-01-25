@extends('mahasiswa.main')
@section('content')
    @if (session('status'))
        <div class="alert alert-primary">
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <div class="container detail-alat">
        <div class="image-container">
            <img src='{{ asset("images/jenis_alat/$data->gambar") }}' class="card-img-top img-fluid">
        </div>
        <div class="paragraphs-container">
            <h1>{{ $data->nama }} - {{ $alat->nomor }}</h1>
            <p>{{ $data->deskripsi }}</p>
        </div>
        <div class="table-responsive">
            <h2>Peminjaman 7 Hari Kedepan</h2>
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
@endsection

@section('script')
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
            jamSelesaiSelect.innerHTML =
                '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
            $("#jam_selesai").attr("disabled", true);

            if (selectedTanggal == "") {
                var jamMulaiSelect = document.getElementById('jam_mulai');
                jamMulaiSelect.innerHTML =
                    '<option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>';
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
                jamMulaiSelect.innerHTML =
                    '<option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>';
                $("#jam_mulai").attr("disabled", true);

                var jamSelesaiSelect = document.getElementById('jam_selesai');
                jamSelesaiSelect.innerHTML =
                    '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
                $("#jam_selesai").attr("disabled", true);
            } else if (selectedJamMulai == "") {
                var jamSelesaiSelect = document.getElementById('jam_selesai');
                jamSelesaiSelect.innerHTML =
                    '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
                $("#jam_selesai").attr("disabled", true);
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
@endsection
