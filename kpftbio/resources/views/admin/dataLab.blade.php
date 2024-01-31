@extends('admin.home')
@section('content')
    @if (session('status'))
        <div class="alert alert-primary">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <h2>Data Lab</h2>
        <table class="table table-striped" id="riwayatHariIniTable">
            <thead>
                <tr>
                    <th scope="col">Nama Lab</th>
                    <th scope="col">Ubah</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataRiwayatHariIni as $riwayat)
                    <tr>
                        <td>{{ $riwayat['riwayat']->nama }}</td>
                        
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
