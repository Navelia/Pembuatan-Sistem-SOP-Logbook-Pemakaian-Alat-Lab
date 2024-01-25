@extends('admin.home')
@section('content')
    @if (session('status'))
        <div class="alert alert-primary">
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <div class="table-responsive">
        <h2>Daftar Jenis Alat</h2><a href="{{ url('tambahJenisAlat/') }}" class="btn btn-primary">+ Tambah Jenis Alat</a>
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
                        <td><img class="imgJenis"
                                src='{{ asset('images/jenis_alat/' . $jenisAlat['data_jenis']->gambar) }}'></td>
                        <td>{{ $jenisAlat['data_jenis']->nama }}</td>
                        <td>{{ $jenisAlat['data_jenis']->deskripsi }}</td>
                        <td>{{ $jenisAlat['jumlah_alat'] }}</td>
                        <td><a href="{{ url('detailJenisAlat/' . $jenisAlat['data_jenis']->id) }}"
                                class="btn btn-primary">Detail</a></td>
                        <td><a href="{{ url('ubahJenisAlat/' . $jenisAlat['data_jenis']->id) }}"
                                class="btn btn-warning">Ubah</a></td>
                        <td><a href="{{ url('hapusJenisAlat/' . $jenisAlat['data_jenis']->id) }}" class="btn btn-danger"
                                onclick="return confirm('Hapus jenis alat ({{ $jenisAlat['data_jenis']->nama }}) dan seluruh datanya?')">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#jenisAlatTable').DataTable({});
        });
    </script>
@endsection
