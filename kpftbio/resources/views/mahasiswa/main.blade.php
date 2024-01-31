<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        :root {
            --primary: #3DA50C;
        }

        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        #navbar-logo {
            width: 75%;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1%;
        }

        .navbar-nav .nav-link {
            color: black;
        }

        .content-container {
            margin-top: 20px;
        }

        .btn {
            min-width: 40px;
            min-height: 40px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-img-fixed-height {
            height: 500px;
            object-fit: cover;
        }

        .keterangan {
            padding-top: 20px;
        }

        .image-container {
            width: 400px;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            margin-bottom: 20px;
            overflow: hidden;
            object-fit: cover;
        }

        .paragraphs-container {
            text-align: center;
        }

        table td {
            border: 1px solid #28a745;
        }

        .detail-alat {
            padding: 2%;
        }

        .informasi-alat {
            padding-left: 10%;
        }

        @media (max-width: 700px) {
            .card-title {
                text-align: center;
            }

            .card-text {
                text-align: justify;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-cLdFwIe6ZPmz3AJMPQ5OZpC6Lwyr6kZlEhAzL4dL2y1hFb93sfGcqsK3R4g2h5/VAIpeNqSvi9m0s2S6S2Y0jw=="
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}"><img id="navbar-logo"
                        src="https://simlabftb.top/logo.png" alt="FTBio Ubaya"></a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    @yield('script')
</body>

</html>
