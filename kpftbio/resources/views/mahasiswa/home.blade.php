@extends('mahasiswa.main')
@section('content')
    <div class="container content-container">
        <div class="row">
            @foreach ($data as $d)
                <div class="col-md-3">
                    <div class="card">
                        <img src='{{ asset("images/jenis_alat/$d->gambar") }}' class="card-img-top card-img-fixed-height"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $d->nama }}</h5>
                            <p class="card-text">{{ $d->deskripsi }}</p>
                            <div class="d-grid gap-2">
                                <a href="{{ url('detailJenisAlat/' . $d->id) }}" class="btn btn-primary">Detail Alat</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> --}}
    </div>
@endsection
