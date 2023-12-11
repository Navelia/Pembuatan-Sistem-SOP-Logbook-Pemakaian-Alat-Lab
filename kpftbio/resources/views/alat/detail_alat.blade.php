<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background: rgb(250, 205, 205);
            padding: 25px;
        }

        .image-container {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 500px;
        }

        .paragraphs-container {
            margin-top: 50px;
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="image-container">
            <img src="{{ $data->gambar }}" class="card-img-top img-fluid">
        </div>
        <div class="paragraphs-container">
            <h1>{{ $data->nama }}</h1>
        </div>
        <p>{{ $data->deskripsi }}</p>

        <h1>Ini Spesifikasi</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Spesifikasi</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataSpesifikasi as $spek)
                    <tr>
                        <td>
                            {{ $spek->nama }}
                        </td>
                        <td>
                            {{ $spek->spesifikasi }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h1>Ini SOP</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Urutan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataSop as $sop)
                    <tr>
                        <td>
                            {{ $sop->urutan }}
                        </td>
                        <td>
                            {{ $sop->sop }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h1>Ini Riwayat</h1>
        <table class="table table-striped">
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
                        <td>
                            {{ $riwayat->nama }}
                        </td>
                        <td>
                            {{ $riwayat->nrp }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($riwayat->tanggal)->format('d F Y') }}
                        </td>
                        <td>
                            {{ $riwayat->jam_mulai . ':00' }}
                        </td>
                        <td>
                            {{ $riwayat->jam_selesai . ':00' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-grid gap-2">
            <a href="#" class="btn btn-primary">Pinjam Alat</a>
            {{-- <a href="#" class="btn btn-primary">Riwayat Peminjaman</a> --}}
        </div>


    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
