@extends('admin.home')
@section('content')
    @if (session('status'))
        <div class="alert alert-primary">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <h2>Data Semua Peminjaman Alat</h2>
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalTambahRiwayat"> + Tambah Data Peminjaman</button><br><br>
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
                        <td>{{ $riwayat['jenisAlat']->nama . ' - ' . $riwayat['alat']->nomor . " (" . $riwayat['alat']->lab->nama . ")" }}</td>
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

        $('#alat_id').change(function() {
            var tanggal = document.getElementById('tanggal');
            tanggal.value = "";

            var jamMulaiSelect = document.getElementById('jam_mulai');
            jamMulaiSelect.innerHTML = '<option value="" selected hidden>Pilih Tanggal Terlebih Dahulu</option>';
            $("#jam_mulai").attr("disabled", true);

            var jamSelesaiSelect = document.getElementById('jam_selesai');
            jamSelesaiSelect.innerHTML =
                '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
            $("#jam_selesai").attr("disabled", true);
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

                var jamSelesaiSelect = document.getElementById('jam_selesai');
                jamSelesaiSelect.innerHTML =
                    '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
            } else if (selectedJamMulai == "") {
                var jamSelesaiSelect = document.getElementById('jam_selesai');
                jamSelesaiSelect.innerHTML =
                    '<option value="" selected hidden>Pilih Jam Mulai Terlebih Dahulu</option>';
            } else {
                $.ajax({
                    url: '/changeJamSelesaiAdmin/' + alat_id + "/" + selectedTanggal + "/" +
                        selectedJamMulai,
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
