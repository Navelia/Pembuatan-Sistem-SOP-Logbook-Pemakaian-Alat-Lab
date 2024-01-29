@extends('mahasiswa.main')
@section('content')
  <div class="container detail-alat">
    <div class="row">
      <div class="col-md-5">
        <div class="image-container">
          <img src='{{ asset("images/jenis_alat/$data->gambar") }}' class="card-img-top img-fluid">
        </div>
      </div>
      <div class="col-md-5">
        <div class="informasi-alat">
          <h1>{{ $data->nama }}</h1>
          <p>{{ $data->deskripsi }}</p>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <h2 class="keterangan">Spesifikasi</h2>
      <table class="table table-striped">
        <tbody>
          @foreach ($dataSpesifikasi as $spek)
            <tr>
              <td>{{ $spek->nama }}</td>
              <td>{{ $spek->spesifikasi }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="row justify-content-center">
      <h2 class="keterangan">SOP</h2>
      <table class="table table-striped">
        <tbody>
          @foreach ($dataSop as $sop)
            <tr>
              <td>{{ $sop->urutan }}</td>
              <td>{{ $sop->sop }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="row justify-content-center">
      <h2>List Alat</h2>
      <ul>
        @foreach ($dataAlat as $alat)
          <li>
            <a class="detail-alat" href="{{ url('detailAlat/' . $alat->id) }}">{{ $data->nama }} - {{ $alat->nomor }} ({{ $alat->lab->nama }})</a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection
