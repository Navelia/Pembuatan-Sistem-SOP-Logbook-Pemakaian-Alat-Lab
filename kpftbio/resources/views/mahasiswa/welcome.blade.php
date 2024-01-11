<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <div class="row">
      @foreach ($data as $d)
        <div class="col-md-3">
          <div class="card">
            <img src='{{ asset("images/jenis_alat/$d->gambar") }}' class="card-img-top" alt="...">
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
  </div>
</body>

</html>
