<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Informasi Surat {{ $number }} | eSurat Kabupaten Buleleng</title>
</head>
<style>

    .card-body {
        padding: 40px
    }

    .card-body table td{
        padding: 5px
    }

    @media (min-width: 576px) {
        .container {
            max-width:540px
        }

        .px-5 {
            padding-right: 0!important;
            padding-left : 0!important;
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width:720px
        }

        .px-5 {
            padding-right: 0!important;
            padding-left : 0!important;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width:960px
        }

        .px-5 {
            padding-right: 0!important;
            padding-left : 0!important;
        }
    }
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('logo-desa.png') }}" alt="Logo Desa Tembok" style="max-height: 150px;">
                                </div>
                                <div class="text-center mb-3">
                                    <h2 class="card-title">eSurat @php echo ucwords(strtolower(config('settings.village'))) @endphp</h2>
                                    <h4 class="card-subtitle">Informasi Surat</h4>
                                </div>

                                <div class="text-secondary">
                                    <table class="table-borderless">
                                        <tbody class="align-top">
                                            <tr>
                                                <td><strong>Nomor Surat</strong></td>
                                                <td> : </td>
                                                <td>{{ $number }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Surat</strong></td>
                                                <td> : </td>
                                                <td>{{ $created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Perihal</strong></td>
                                                <td> : </td>
                                                <td>{{ $type }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Asal Surat</strong></td>
                                                <td> : </td>
                                                <td>{{ $from }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Penandatangan</strong></td>
                                                <td> : </td>
                                                <td>{{ $signature }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ $file }}" class="btn btn-primary btn-center">Download Surat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
