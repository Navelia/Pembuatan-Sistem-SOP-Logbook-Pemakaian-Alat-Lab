@extends('admin.home')
@section('content')
  @if (session('status'))
    <div class="alert alert-primary">
      <p>{{ session('status') }}</p>
    </div>
  @endif

  <div class="table-responsive">
    <h2>Data Lab</h2>
    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalTambahLab"> + Tambah Data Lab</button><br><br>
    <table class="table table-striped" id="labTable">
      <thead>
        <tr>
          <th scope="col">Nama Lab</th>
          <th scope="col">Ubah</th>
          <th scope="col">Hapus</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dataLab as $lab)
          <tr>
            <td>{{ $lab->nama }}</td>
            <td><button idLab="{{ $lab->id }}" namaLab="{{ $lab->nama }}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbahLab" onclick="openModal(this)">Ubah</button></td>
            <td><a href="{{ url('hapusLab/' . $lab->id) }}" class="btn btn-danger" onclick="return confirm('Hapus lab ({{ $lab->nama }}) dan seluruh datanya?')">Hapus</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Modal Tambah Lab --}}
  <div id="modalTambahLab" class="modal fade" tabindex="-1" role="basic">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close btn btn-danger" data-bs-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data Lab</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('tambahLab') }}" id="formPinjam">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  {{-- Modal Ubah Lab --}}
  <div id="modalUbahLab" class="modal fade" tabindex="-1" role="basic">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close btn btn-danger" data-bs-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ubah Data Lab</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('ubahLab') }}" id="formPinjam">
            @csrf
            <input type="hidden" id="idLab" name="idLab">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="namaLab" name="namaLab" required>
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
      $('#labTable').DataTable({});
    });

    function openModal(element) {
      var namaLab = element.getAttribute("namaLab");
      var idLab = element.getAttribute("idLab");

      document.getElementById("idLab").value = idLab;
      document.getElementById("namaLab").value = namaLab;
    };
  </script>
@endsection
