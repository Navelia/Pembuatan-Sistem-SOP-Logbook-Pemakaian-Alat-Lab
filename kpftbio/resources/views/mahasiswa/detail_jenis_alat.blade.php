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
  <div class="container">
    <div class="image-container">
      <img src='{{ asset("images/jenis_alat/$data->gambar") }}' class="card-img-top img-fluid">
    </div>
    <div class="paragraphs-container">
      <h1>{{ $data->nama }}</h1>
      <p>{{ $data->deskripsi }}</p>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="paragraphs-container">
          <h2>Spesifikasi</h2>
        </div>
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

      <div class="col-md-6">
        <div class="paragraphs-container">
          <h2>SOP</h2>
        </div>
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
    </div>

    <div class="paragraphs-container">
      <h2>List Alat</h2>
    </div>
    <ul>
      @foreach ($dataAlat as $alat)
        <li>
          <a href="{{ url('detailAlat/' . $alat->id) }}">{{ $data->nama }} - {{ $alat->nomor }}</a>
        </li>
      @endforeach
    </ul>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {

    });
  </script>
</body>

</html>
